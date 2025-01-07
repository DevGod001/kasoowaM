<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Required</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            transition: transform 0.3s;
        }
        .container:hover {
            transform: scale(1.02);
        }
        .header {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        .message {
            color: red;
            font-size: 20px;
            margin-bottom: 25px;
            animation: bounce 1s infinite;
        }
        .link {
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border: 2px solid #4CAF50;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .link:hover {
            background-color: #4CAF50;
            color: white;
        }
        .link .material-icons {
            margin-right: 8px;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Email Verification Required</div>
        <div class="message">Please verify your email address!</div>
        <a class="link" target="_blank" href="https://mail.google.com/mail/mu/mp/502/#tl/priority/%5Esmartlabel_personal">
            <span class="material-icons">email</span>
            Go to Inbox
        </a>
    </div>
</body>
</html>