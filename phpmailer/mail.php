<?php
// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function send($email, $name, $subject, $message) {
    // Create an instance of PHPMailer
    $phpMailer = new PHPMailer(true);

    try {
        // Server settings
        $phpMailer->isSMTP();                                           // Set  mailer to use SMTP
        $phpMailer->Host = 'mail.kasoowa.com';                           // Set the SMTP server to send through
        $phpMailer->SMTPAuth = true;                                     // Enable SMTP authentication
        $phpMailer->Username = 'support@kasoowa.com';                    // SMTP username
        $phpMailer->Password = '#David05.#';                             // SMTP password
        $phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Ensure STARTTLS is used for encryption
        $phpMailer->Port = 587;                                          // Use port 587 for TLS

        // Optionally disable SSL certificate verification (not recommended for production)
        $phpMailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Recipients
        $phpMailer->setFrom('support@kasoowa.com', 'Kasoowa Support');  // Set the sender email
        $phpMailer->addAddress($email, $name);                           // Add recipient

        // Define logo URL
        $http = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    $url = $http . "://" . $host . "/assets/kasoowa.png";

        // Email template with dynamic message
        $emailTemplate = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="manifest" href="app.json">
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
                    width:100%;
                    background-image: url("'.$url.'"); /* Use full URL */
                    background-size: cover;
                    background-position: center;
                    margin: 0 auto 20px;
                    color:#4caf50;
                    display:flex;
                    flex-direction:column;
                    align-items:center;
                    justify-content:center;
                    text-align:center;
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
                    width: 90%;
                    margin: auto;
                    max-width: 600px;
                }
                .icon {
                    background-color:transparent; /* Green footer */
                    color: green; /* White text */
                    font-size: 3rem;
                    text-align: center;
                    padding: 20px;
                    width: 90%;
                    margin: auto;
                    max-width: 600px;
                    font-weight:bold;
                    pointer-events:none;
                    color:green;
                    
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
                
                <div class="icon">
                <p>Kasoowa</p>
            </div>
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
        </html>';

        // Content
        $phpMailer->isHTML(true);                                        // Set email format to HTML
        $phpMailer->Subject = $subject;                                  // Email subject
        $phpMailer->Body    = $emailTemplate;                            // Email body with template

        // Send the email
        $phpMailer->send();
        
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$phpMailer->ErrorInfo}";
    }
}


?>
