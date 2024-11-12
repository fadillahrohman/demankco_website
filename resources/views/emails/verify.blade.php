<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Email Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #4a5568;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2d3748;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #718096;
        }
        .help-text {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="logo">
        DEMANKCO
    </div>

    <div>
        <h2>Hello!</h2>
        
        <p>Please click the button below to verify your email address.</p>

        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
        </div>

        <p>If you did not create an account, no further action is required.</p>

        <p>
            Regards,<br>
            DEMANKCO
        </p>

        <div class="help-text">
            If you're having trouble clicking the "Verify Email Address" button, copy and paste
            the URL below into your web browser: <br>
            <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
        </div>
    </div>

    <div class="footer">
        © {{ date('Y') }} DEMANKCO. All rights reserved.
    </div>
</body>
</html>