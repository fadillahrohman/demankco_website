<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6; /* Background color for body */
            color: #1f2937; /* Default text color */
            margin: 0;
            padding: 0;
        }

        /* Logo */
        .logo {
            text-align: center;
            padding-top: 40px;
            font-size: 3rem;
            font-weight: 700;
            color: #1d4ed8; /* Blue color */
        }

        /* Main content container */
        .main-content {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Greeting */
        .greeting {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Instruction */
        .instruction {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        /* Verifikasi Button */
        .button-container {
            margin-top: 20px;
        }

        .verify-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #3b82f6; /* Tailwind blue-500 */
            color: #ffffff;
            font-size: 1.125rem;
            font-weight: 600;
            border-radius: 9999px; /* Rounded button */
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .verify-btn:hover {
            background-color: #2563eb; /* Tailwind blue-600 on hover */
        }

        /* Signature */
        .signature {
            margin-top: 30px;
            font-size: 0.875rem;
            color: #4b5563; /* Tailwind gray-600 */
        }

        /* Help Text */
        .help-text {
            margin-top: 20px;
            font-size: 0.875rem;
            color: #6b7280; /* Tailwind gray-500 */
        }

        .help-text .url {
            color: #3b82f6; /* Tailwind blue-500 */
            text-decoration: none;
        }

        .help-text .url:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 0.875rem;
            padding: 20px 0;
            color: #6b7280; /* Tailwind gray-500 */
            background-color: #ffffff;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- Logo -->
    <div class="logo">
        DEMANKCO
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="greeting">Selamat Datang, {{ $user->name }}</h2>
        <p class="instruction">Silakan klik tombol di bawah untuk memverifikasi alamat email Anda.</p>

        <!-- Verifikasi Button -->
        <div class="button-container">
            <a href="{{ $url }}" class="verify-btn">Verifikasi Email</a>
        </div>

        <p class="signature">
            Admin,<br>
            DEMANKCO
        </p>

        <!-- Help Text -->
        <div class="help-text">
            Jika Anda mengalami masalah saat mengeklik tombol "Verifikasi Email", salin dan tempel URL di bawah ini :<br>
            <a href="{{ $url }}" class="url">{{ $url }}</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        © {{ date('Y') }} DEMANKCO. All rights reserved.
    </div>

</body>
</html>
