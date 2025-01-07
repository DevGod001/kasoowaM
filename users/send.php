<?php
// Function to send email
function sendEmail($to, $subject, $message, $headers) {
    // Use mail() function to send email
    if (mail($to, $subject, $message, $headers)) {
        return "Email sent successfully.";
    } else {
        return "Email failed to send.";
    }
}

// Email parameters
$to = 'techie5961@gmail.com'; // Recipient
$subject = 'Test Email from Kasoowa'; // Subject

// HTML Email Template
$message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasoowa Email</title>
    <link rel="manifest" href="app.json">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
        .logo{
            backgound-image:url("pepper.jpg");
            background-size:cover;
            background-position:center;
            height:50px;
            width:200px;
            background:orange
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo"></div>
        </div>
        <div class="content">
            <h2>Hello!</h2>
            <p>This is a test email sent from Kasoowa Support.</p>
            <p>Thank you for reaching out!</p>
        </div>
        <div class="footer">
            <p>&copy; ' . date("Y") . ' Kasoowa. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
';

// Headers
$headers = 'MIME-Version: 1.0' . "\r\n" .
           'Content-type:text/html;charset=UTF-8' . "\r\n" .
           'From: support@kasoowa.com' . "\r\n" .
           'Reply-To: support@kasoowa.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Call the sendEmail function
$result = sendEmail($to, $subject, $message, $headers);

// Output the result
echo $result;
?>
