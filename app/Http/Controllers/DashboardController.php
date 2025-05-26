<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $qr = QrCode::size(250)->generate($user->email . '-' . $user->id);
        $sentence = $this->generateAISentence(
	        $user->email,
	        $user->created_at->format('Y-m-d'),
	        $user->email . '-' . $user->id
	    );

        return view('dashboard', compact('user', 'qr', 'sentence'));
    }

    public function generateAISentence($email, $createdAt, $qrString)
    {
        $context = $this->smallContextAwareModel($email);
        $prompt = "Generate a short, friendly, personalized sentence for a user with the following details:\n" .
              "Email: $email\n" .
              "Created At: $createdAt\n" .
              "QR Code: $qrString\n" .
              "Context info: $context\n\nSentence:";


        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.key'),
                'Content-Type' => 'application/json',
                'HTTP-Referer' => 'https://yourdomain.com', // Required by OpenRouter, replace with your real domain
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'openai/gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if ($response->ok()) {

                $data = $response->json();
                \Log::info("RESPONSE", ["RESPONSE" => $data]);
                return $data['choices'][0]['message']['content'] ?? 'No AI sentence generated.';
            }

            \Log::error('OpenRouter API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            \Log::error('OpenRouter exception', ['message' => $e->getMessage()]);
        }

        // Fallback in case of failure
        return "User with email {$email} registered on {$createdAt}, linked to QR: {$qrString}.";
    }

    protected function fallbackSentence($email, $createdAt, $qrString)
    {
        return "User with email {$email} registered on {$createdAt}, linked to QR: {$qrString}.";
    }

    protected function smallContextAwareModel($email)
    {
        $commonNames = ['aslam', 'john doe', 'jane doe', 'test user', 'test', 'anonymous', 'guest', 'admin', 'user', 'bob', 'alice'];
        $disposableDomains = [
            'mailinator.com', 'tempmail.com', '10minutemail.com', 'trashmail.com',
            'guerrillamail.com', 'yopmail.com', 'getnada.com', 'dispostable.com',
            'maildrop.cc', 'fakeinbox.com', 'mailcatch.com', 'throwawaymail.com'
        ];
        $genericPatterns = [
            '/user\d+/', '/test\d*/', '/guest\d*/', '/admin\d*/',
            '/demo\d*/', '/temp\d*/', '/fake\d*/', '/anon\d*/',
            '/^anon.*$/', '/^noreply.*$/', '/^no.reply.*$/', '/^bot.*$/'
        ];

        $score = 0;
        $notes = [];

        // Extract username and domain
        [$username, $domain] = explode('@', strtolower($email));
        $cleanUsername = str_replace(['.', '_', ' '], '', $username);

        // 1. Disposable domain check
        if (in_array($domain, $disposableDomains)) {
            $score += 2;
            $notes[] = "Uses a disposable email domain.";
        }

        // 2. Common/anonymous names check
        foreach ($commonNames as $name) {
            if (strpos($cleanUsername, str_replace(' ', '', strtolower($name))) !== false) {
                $score += 2;
                $notes[] = "Username matches common or anonymous names.";
                break;
            }
        }

        // 3. Generic username patterns check
        foreach ($genericPatterns as $pattern) {
            if (preg_match($pattern, $username)) {
                $score += 1;
                $notes[] = "Username looks generic or test-related.";
                break;
            }
        }

        // 4. Real name detection (dot or underscore separated)
        if (preg_match('/[._]/', $username)) {
            $parts = preg_split('/[._]/', $username);
            if (count($parts) >= 2) {
                $score -= 1;
                $notes[] = "Username looks like a real name: " . implode(' and ', $parts) . ".";
            }
        }

        // 5. Check if username is all lowercase or uppercase
        if (ctype_lower($username) || ctype_upper($username)) {
            $notes[] = "Username is all lowercase or uppercase.";
        }

        // 6. Check for repeated characters (aaa111, xxxx999)
        if (preg_match('/(.)\1{2,}/', $username)) {
            $score += 1;
            $notes[] = "Username contains repeated characters.";
        }

        // 7. Gender detection (basic)
        if (preg_match('/\b(test|john|bob|michael|david|robert|james)\b/', $username)) {
            $notes[] = "Likely male based on name.";
        } elseif (preg_match('/\b(jane|sara|mary|linda|emily)\b/', $username)) {
            $notes[] = "Likely female based on name.";
        }

        // 8. Final evaluation based on score
        if ($score >= 4) {
            $notes[] = "Overall: likely anonymous, disposable, or test user.";
        } elseif ($score >= 2) {
            $notes[] = "Overall: possibly generic or bot-related username.";
        } elseif ($score <= 0) {
            $notes[] = "Overall: username appears unique or genuine.";
        }

        return implode(' ', $notes);
    }
}


