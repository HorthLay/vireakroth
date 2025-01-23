<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
        }

        .cta-button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Email Verification</h2>
        <p>Hi,</p>
        <p>Please click the button below to verify your email address.</p>
        <p><a href="{{ $verificationUrl }}" class="cta-button">Verify Email</a></p>

        <p class="footer">If you did not request this email, you can safely ignore it.</p>
    </div>
</body>
</html>
