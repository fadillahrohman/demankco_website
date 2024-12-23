<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">  
</head>

<body style="margin: 0; padding: 0; font-family: poppins, sans-serif; background-color: #f4f4f4;">
    <table role="presentation"
        style="width: 100%; max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; margin-top: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <tr>
            <td style="padding: 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h2 style="color:#60a5fa; background-color:black; border-radius: 15px; padding: 10px;">DEMANCKO</h2>
                </div>
                <div style="text-align: center;">
                    <h1 style="color: #60a5fa; font-size: 24px; margin: 0 0 20px 0;">Reset Password</h1>
                    <p style="color: #666666; font-size: 14px; line-height: 24px; margin-bottom: 30px;">
                        Klik tombol di bawah ini untuk mereset password Anda:
                    </p>
                    <div style="margin-bottom: 30px;">
                        <a href="{{ $resetLink }}" style="background-color: #60a5fa; color: #ffffff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Reset Password</a>
                    </div>
                    <p style="color: #666666; font-size: 14px; margin-bottom: 30px;">
                        Jika Anda tidak meminta reset password, abaikan email ini.
                    </p>
                    <div style="border-top: 1px solid #e5e5e5; padding-top: 20px;">
                        <p style="color: #999999; font-size: 13px; line-height: 1.6;">
                            Jika Anda mengalami masalah dengan tombol di atas, salin dan tempel URL berikut ke browser web Anda: <br>
                            <a href="{{ $resetLink }}" style="color: #60a5fa;">{{ $resetLink }}</a>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8f9fa; padding: 20px 30px; border-radius: 0 0 8px 8px;">
                <p style="color: #999999; font-size: 12px; text-align: center; margin: 0;">
                  Ini adalah pesan otomatis, mohon jangan membalas email ini.
                </p>
            </td>
        </tr>
    </table>
</body>

</html>