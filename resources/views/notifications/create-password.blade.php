<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .email-content {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 30px;
            width: 600px;
            text-align: start;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .email-content h1 {
            font-size: 24px;
            color: #333333;
            text-align: center;
        }
        .email-content p {
            font-size: 16px;
            color: #666666;
            line-height: 1.6;
        }
        .button-container {
            display: flex;
            justify-content: center; 
        }
        .reset-button {
            background-color: #333333;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
            font-size: 16px;
        }
        .reset-button:hover {
            background-color: #444444;
        }
        .email-footer {
            font-size: 12px;
            color: #aaaaaa;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        
        <div class="email-content">
            <h1>SaaS</h1>
            <h2>Hello, {{ $user->name }}</h2>
            
            <p>
                Anda telah didaftarkan sebagai {{ $user->role->name }} pada CMS.
                <br />Agar dapat login, silahkan buat password terlebih dahulu 
                <br />klik tombol di bawah ini.
            </p>

            <div class="button-container">
                <a href="{{ $url }}" class="reset-button">Buat Password</a>
            </div>
            
            <p>Link membuat password baru akan kadaluarsa dalam 60 menit.</p>
            <p>Hormat kami,<br>{{ config('app.name') }}</p>
       
            <p class="email-footer">© 2024 SaaS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
