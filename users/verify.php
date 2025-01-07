<?php
session_start();
include_once 'connect.php';
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";

 $mail=$_SESSION['mail'];

if(isset($_GET['otp']) && isset($_GET['mail'])){
    $otp=$_GET['otp'];
    $mail=$_GET['mail'];
    $select="SELECT * FROM `otp` WHERE `otp_code`=$otp AND `mail`='$mail' AND `status`='active'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
    if($row == 0){
        header('Location:register');
        exit;
    }
    $update="UPDATE `otp` SET `status`='used' WHERE `otp_code`=$otp";
    $updated=mysqli_query($conn,$update);
    $update="UPDATE `users` SET `mail_verified`='true' WHERE `mail`='$mail'";
    $updated=mysqli_query($conn,$update);
    
    header('Location:login');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop groceries from anywhere worldwide">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Verify</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop the latest products at our store.">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="login.css"> <!-- Link to your CSS file -->
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="app.json">
     
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
        .resend{
           display:block;
            margin-left:auto;
            float:right;
            color:navy;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
    </style>
     <style>
            .loading{
            position:fixed;
            top:0;
            bottom:0;
            left:0;
            right:0;
            background:rgb(0,0,0,0.5);
            z-index:3000;
            display:none;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        .dots {
            display:flex;
            justify-content: center;
            align-items: center;
            font-size: 4rem; /* Adjust size of the dots */
        }
        .dot {
            animation: bounce 0.6s infinite alternate;
            margin: 0 5px;
            color:#4caf50;
        }
        .dot:nth-child(1) {
            animation-delay: 0.2s;
            color:orange;
        }
        .dot:nth-child(2) {
            animation-delay: 0.2s;
            
        }
        .dot:nth-child(3) {
            animation-delay: 0.4s;
            color:red;
        }
        @keyframes bounce {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-10px);
            }
        }
        .hide{
            display:none;
        }
        
        </style>
</head>
<body>
     <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
        
    <div class="container">
        <div class="header">Email Verification Required</div>
        <div class="message">Please verify your email address!</div>
        <a class="link" target="_blank" href="https://mail.google.com/mail/mu/mp/502/#tl/priority/%5Esmartlabel_personal">
            <span class="material-icons">email</span>
            Go to Inbox
        </a>
        <a onclick="show_loading()" class="resend" href="resend.php?mail=<?php echo $mail; ?>">Resend mail</a>
    </div>
    <script>
        let loading=document.querySelector("#loading");
        function show_loading(){
            loading.style.display="flex";
        }
    </script>
</body>
</html>