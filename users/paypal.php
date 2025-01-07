<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location:cart');
    exit;
}
// User ID and Cart ID from Cookies
$user_id = $_COOKIE['user_id'];
$cart_id = $_COOKIE['cart_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $_SESSION['address'] = $address;

    // Calculate Total Amount
    $select = "SELECT SUM(`product_cost` * `quantity`) AS `total` FROM `cart` WHERE `uniqid`='$cart_id'";
    $selected = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($selected);
    $total = $fetch['total'];

    if (!empty($discount)) {
        $amount = $total - ($discount * $total) / 100;
    } else {
        $amount = $total;
    }
    $amount = $amount + (5 * $total) / 100; // Add 5% tax or fee
}

// Get Currency based on User's Preference
$select = "SELECT * FROM `users` WHERE `id`=$user_id";
$selected = mysqli_query($conn, $select);
if (mysqli_num_rows($selected) > 0) {
    $fetch = mysqli_fetch_assoc($selected);
    $currency = $fetch['currency'];

    switch ($currency) {
        case "&#8358":
            $curr = "NGN";
            break;
        case "$":
            $curr = "USD";
            break;
        case "&#163":
            $curr = "GBP";
            break;
        case "&#8353":
            $curr = "GHC";
            break;
        case "XAF":
            $curr = "XAF";
            break;
        default:
            $curr = "NGN";
            break;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Checkout</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <script src="https://www.paypal.com/sdk/js?client-id=AcAfG7zScqqyXGLrFKzZilD84bwYvEbIp54cEhudjVXUvSDipJpeqqQhQbx4YRnf1MtL8E4p51e1ry55&components=buttons"></script>

    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            overflow:hidden;
            display:flex;
            flex-direction:column;
        }

        /* Main Container */
        .container {
            max-width: 100vh;
            margin: 10vh auto;
            padding: 20px;
            overflow:hidden;
            overflow-wrap:anywhere;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4caf50; /* PayPal's green */
            margin-bottom: 20px;
            font-family:poppins;
            font-size:2.0rem;
        }

        .description {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #555;
            font-family:teachers;
        }

        .paypal-button-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        footer {
            text-align: center;
            margin-top:50px;
            flex:1 0 auto;
            font-size: 14px;
            color: #aaa;
        }

        footer a {
            color: #4caf50;
            text-decoration: none;
        }
        @media(min-width:800px){
            .container {
            max-width:600px;
           
        }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Complete Your Purchase</h1>
        <p class="description">Securely pay with PayPal for your order. The total amount is <?php echo $curr; ?> <span id="amount"><?php echo $amount; ?></span>.</p>

        <!-- Hidden Inputs for amount and currency -->
        <input type="hidden" id="hidden-amount" value="<?php echo $amount; ?>">
        <input type="hidden" id="hidden-currency" value="<?php echo $curr; ?>">

        <div id="paypal-button-container" class="paypal-button-container"></div>
    </div>

    <footer>
        <p>&copy; 2024 Kasoowa. All Rights Reserved. <br> <a href="mailto:support@kasoowa.com">Contact Us</a></p>
    </footer>

    <script>
        paypal.Buttons({
            // Set up the transaction details
            createOrder: function(data, actions) {
                // Get the amount and currency from hidden inputs
                var amount = document.getElementById('hidden-amount').value;
                var currency = document.getElementById('hidden-currency').value;

                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount,  // Get the price dynamically from the hidden input
                            currency_code: currency  // Get the currency dynamically from the hidden input
                        }
                    }]
                });
            },
            // On successful transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Transaction details (like payer information, etc.)
                    var payerName = details.payer.name.given_name;
                    var transactionId = details.id;

                    // You can redirect to your PHP script with transaction data via query string
                    window.location.href = "paypal_process.php?transaction_id=" + transactionId + "&payer_name=" + payerName + "&amount=" + details.purchase_units[0].amount.value + "&currency=" + details.purchase_units[0].amount.currency_code;
                });
            },
            // Handle payment errors
            onError: function(err) {
                console.log(err);
                alert('There was an error with the payment.');
            }
        }).render('#paypal-button-container');  // Render the PayPal button inside the specified container
    </script>
</body>
</html>