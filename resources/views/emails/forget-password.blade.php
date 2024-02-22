{{-- <h1>Verander wachtwoord</h1>
<p>Klik op de onderstaande link om je wachtwoord te veranderen van je account</p>
<a href="{{ Route('Resetpwd', $token) }}">Verander wachtwoord</a> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            background-color: #f3f4f6;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .headline {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
        }

        .reset-link {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #3490dc;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            border-radius: 9999px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="headline">Verander Wachtwoord</div>

        <div class="message">
            <p>Je hebt een aanvraag gedaan voor je huidige wachtwoord te wijzigen. Klik op de onderstaande link dit te doen:</p>
            <a href="{{ Route('Resetpwd', $token) }}" class="reset-link">Verander Wachtwoord</a>
            
            <p>Heb je deze aanvraag niet gedaan? Neem dan contact met ons op.</p>
        </div>


    </div>

</body>
</html>

