import sys
from nameparser import HumanName
import gender_guesser.detector as gender

def classify_name(name_string):
    # Parse name
    name = HumanName(name_string)
    full_name = f"{name.first} {name.last}".strip()

    # Guess gender
    d = gender.Detector()
    guessed_gender = d.get_gender(name.first) if name.first else 'unknown'

    # Simple rules
    if not name.first and not name.last:
        return f"{name_string} does not look like a real name."

    if guessed_gender in ['male', 'female']:
        return f"The user's name appears to be a real name ({full_name}) and is likely {guessed_gender}."
    elif guessed_gender in ['mostly_male', 'mostly_female']:
        return f"The user's name ({full_name}) might be a real name, probably {guessed_gender.replace('_', ' ')}."
    else:
        return f"The user's name is {full_name}, but its origin or type could not be determined."

if __name__ == '__main__':
    email = sys.argv[1]
    username = email.split('@')[0]
    username = username.replace('.', ' ').replace('_', ' ')
    result = classify_name(username)
    print(result)
