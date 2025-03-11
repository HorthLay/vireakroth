<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
        }
        .header img {
            height: 40px;
        }
        .message {
            font-size: 16px;
            color: #333333;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #5a97ff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            color: #888888;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons img {
            height: 20px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://www.dropbox.com/s/0tv4284b6m95386/vireakroth.png?raw=1" alt="Image" width="auto" height="auto">
        </div>
        <div class="message">
            <p><strong>Troubles logging in? Let's get you a new password.</strong></p>
            <p>We got a request to change your password to your anima account. If you didn't request a reset, you can safely ignore this email.</p>
        </div>
        <a href="{{ route('reset.password', $token) }}" class="button">Reset Password</a>
        <div class="footer">
            <p>Anima is a design-to-development platform.</p>
            <div class="social-icons">
                <img src="{{ asset('pic/facebook.png') }}" alt="Facebook">
                <img src="{{ asset('pic/instagram.png') }}" alt="Instagram">
            </div>
        </div>
    </div>
</body>
</html>
