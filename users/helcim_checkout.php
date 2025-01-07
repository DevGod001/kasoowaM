<?php
session_start();;
include_once 'connect.php';

if(isset($_GET['token']) && isset($_SESSION['amount']) && isset($_SESSION['currency']) && isset($_SESSION['name']) && isset($_SESSION['helcim_id'])){
    $token=mysqli_real_escape_string($conn,$_GET['token']);
    $amount=mysqli_real_escape_string($conn,$_SESSION['amount']);
     $name=mysqli_real_escape_string($conn,$_SESSION['name']);
      $currency=mysqli_real_escape_string($conn,$_SESSION['currency']);
      $helcim_id=mysqli_real_escape_string($conn,$_SESSION['helcim_id']);
}
 else{
     header("Location:cart"); 
     exit;
 }
switch($currency){
    case "GBP":
    $curr="&euro;";
    break;
    default:
    $curr="$";
    break;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
    <title>Payment Page</title>
    <script type="text/javascript" src="https://secure.helcim.app/helcim-pay/services/start.js"></script>

    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        
        }

        /* Main Container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4caf50;
            margin-bottom: 20px;
        }

        .description {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #555;
            font-size:0.9rem;
        }

        .payment-details {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .payment-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-direction: column; /* Stack the buttons vertically */
        }

        .payment-button {
            padding: 15px 30px;
            background-color: purple;
            color: white;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            width: 80%; /* Ensure buttons take up some portion of the container width */
            border: none;
            position: relative;
            transition: background-color 0.3s ease;
            background: linear-gradient(to right, #6a0dad, #d8a0d8);
            display: flex;
            justify-content: center; /* Center the icon and text horizontally */
            align-items: center; /* Center the icon and text vertically */
        }

        .payment-button:hover {
            background-color: #45a049;
        }

        .cancel-button {
            background-color: #f44336;
        }

        .cancel-button:hover {
            background-color: #e53935;
        }

        /* Material Icon Animation */
        .payment-button i {
            position: absolute;
            left: 15px;
            opacity: 1;
            transition: left 0.5s ease;
        }

        .payment-button span {
            opacity: 0;
            position: relative;
            left: -100px;
            animation: slideText 0.5s forwards;
        }

        .payment-button.pay-with-card span {
            animation-delay: 0.3s;
        }

        .payment-button.cancel-payment span {
            animation-delay: 0.3s;
        }

        @keyframes slideText {
            0% {
                left: -100px;
                opacity: 0;
            }
            100% {
                left: 35px;
                opacity: 1;
            }
        }

        footer {
            text-align: center;
            margin-top: auto;
            font-size: 14px;
            flex:1 0 auto;
            
            
            color: #aaa;
            display:flex;
            align-items:center;
            flex-direction:column;
            justify-content:center;
        }

        footer a {
            color: #4caf50;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                margin-top:10vh;
            }
            .payment-buttons {
                flex-direction: column;
                display:flex;
                align-items:center;
                flex-direction:column;
                width:100%;
                
            }
            .payment-button {
                width: 100%; /* Full width on smaller screens */
                margin-bottom: 10px;
            }
        }
        @media(min-width:800px){
            .container{
                margin-top:10vh;
            }
            .payment-buttons {
                flex-direction: column;
                display:flex;
                align-items:center;
                flex-direction:column;
                width:100%;
               
            }
        }
        .cancel-payment{
           background: linear-gradient(to right, #f44336, #ff8a80);
        }
        .times{
            margin:10px;
            cursor:pointer;
            background:red;
            width:30px;
            height:30px;
            border-radius:50%;
            background:white;
            box-shadow:0px 4px 8px rgba(0,0,0,0.2);
            display:flex;
            align-items:center;
            justify-content:center;
            
        }
        .times_div{
            display:flex;
            align-items:center;
            justify-content:flex-start;
        }
    </style>
</head>
<body>
    <div class="times_div"> <span onclick="window.location.href='cart'" class="times">&times</span></div>
    
    <div class="container">
        <h1 style="font-size:1.5rem">Complete Your Purchase</h1>
        <p class="description">Pay securely with helcim.</p>

        <div class="payment-details">
            <p>Amount: <?php echo $curr.$amount; ?></p> 
            <p>Currency: <?php echo $currency; ?></p>
        </div>

        <!-- Payment Buttons -->
        <div class="payment-buttons">
            <button id="pay-now" class="payment-button pay-with-card">
                <i class="material-icons">payment</i>
                <span>Pay with Card</span>
            </button>
            <button style="display:none" class="payment-button cancel-payment">
                <i class="material-icons">cancel</i>
                <span>Cancel Payment</span>
            </button>
             </div>
    </div>

    <footer>
        <p>&copy; 2024 Kasoowa. All Rights Reserved. <br> <a href="mailto:support@kasoowa.com">Contact Us</a></p>
    </footer>
    <script>
    document.getElementById('pay-now').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    appendHelcimPayIframe('<?php  echo $token; ?>');
});
 </script>
 <script>
     window.addEventListener("message",function(){
         if(event.data.eventStatus){
         if(event.data.eventStatus === 'SUCCESS'){
             window.location.href="helcim_process.php?helcim_id=" + "<?php echo $helcim_id; ?>";
         }
        
        
         }
     })
 </script>
</body>
</html>
