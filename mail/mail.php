
<?php
function send($mail, $message) {
    // Define the recipient email address
    $to = $mail;

    // Define the subject of the email
    $subject = 'Kasoowa Customer Support';
    
    // Construct the URL for the logo
    $http = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    $url = $http . "://" . $host . "/assets/kasoowa.png";

    $content = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background-color:white; /* Light background */
                color: #333; /* Dark text */
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .container {
                width: 90%;
                max-width: 600px;
                margin: auto;
                background-color: white; /* White background for container */
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .logo {
                height: 150px;
                width: 200px;
                background-image: url("'.$url.'"); /* Use full URL */
                background-size: cover;
                background-position: center;
                margin: 0 auto 20px;
            }
            p {
                color: #333; /* Dark text */
            }
            .footer {
                background-color: #4CAF50; /* Green footer */
                color: white; /* White text */
                font-size: 14px;
                text-align: center;
                padding: 20px;
                width: 100%;
                margin: auto;
                max-width: 600px;
            }
            table a {
                color: #4CAF50; /* Green links */
                text-decoration: none;
            }
            .footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo"></div>
            ' . $message . '
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td>
                        <p>Contact us: <a href="mailto:support@kasoowa.com">support@kasoowa.com</a></p>
                        <p>Visit us: <a href="https://www.kasoowa.com" target="_blank">www.kasoowa.com</a></p>
                        <p>&copy; ' . date('Y') . ' Kasoowa. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Thank you for choosing Kasoowa!</p>
        </div>
    </body>
    </html>
    ';

    // Define the email headers
    $headers = 'From: support@kasoowa.com' . "\r\n" .
               'Reply-To: support@kasoowa.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion() . "\r\n" .
               'Content-Type: text/html; charset=UTF-8';

    // Send the email and check if it was successful
    return mail($to, $subject, $content, $headers);
}


send("techie5961@gmail.com","good day blaady");
?>