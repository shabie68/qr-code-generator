QR Code Generator - Laravel 8 Project
This is a Laravel 8-based fullstack project that provides QR code generation functionality on a user dashboard. The project uses Laravel Sanctum for authentication and simplesoftwareio/simple-qrcode for QR code generation.

Features*****

User authentication with Laravel Sanctum and Breeze

QR code generation with simple-qrcode package

Responsive frontend with JavaScript

Database-driven user & QR code management


Requirements*****

	- PHP 7.3 or higher (tested on PHP 8.0+)

	- Composer

	- Node.js and npm

	- MySQL or other supported database


Installation Instructions*****

Clone the repository:

	- git clone https://github.com/shabie68/qr-code-generator.git

	- cd qr-code-generator


Install PHP dependencies:

	- composer install


Install JavaScript dependencies:

	- npm install


Set up environment*****

	- cp .env.example .env

	- Update .env with your database credentials and other config.


Generate app key*****

	- php artisan key:generate


Run database migrations*****

	- php artisan migrate


Compile frontend assets*****

	- npm run dev


Start the development server*****

	- php artisan serve


Open your browser to http://localhost:8000 and register or log in to start generating QR codes.


Dependencies*****

	- Laravel Framework 8.x

	- Laravel Sanctum for API authentication

	- Laravel Breeze for authentication scaffolding

	- Simple QrCode (simplesoftwareio/simple-qrcode) for generating QR codes

	- GuzzleHttp for HTTP client functionality


OpenRouter AI API Key Setup*****

	- To enable AI-powered personalized sentence generation on the dashboard, you need to:

	- Register for an API key at OpenRouter.ai

	- Add the API key to your .env file under the OPENROUTER_KEY variable

	- Make sure your local environment has internet access for API calls

NOTE***** 

It also include the SYSTEM ARCHITECTURE AND DATA FLOW DIAGRAM in the root directory

	- data-flow-diagram.png

	- system-architecture-design.png

