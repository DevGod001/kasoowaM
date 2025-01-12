<?php
session_start();
include_once 'connect.php';
include_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $order_id = $_POST['order_id'];
    $reason = $_POST['reason'];
    $details = $_POST['details'];

    $insert = "INSERT INTO disputes (user_id, order_id, reason, details) VALUES ('$user_id', '$order_id', '$reason', '$details')";
    if (mysqli_query($conn, $insert)) {
        $message = "Dispute lodged successfully.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lodge Dispute</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #555;
        }

        .cart_checkout_div {
            text-align: center;
            margin-top: 20px;
        }

        .cart_checkout_div button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .cart_checkout_div button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Lodge a Dispute</h1>
    </header>
    <main>
        <section>
            <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
            <form action="dispute.php" method="POST">
                <div>
                    <label for="order_id">Order ID:</label>
                    <input type="text" id="order_id" name="order_id" required>
                </div>
                <div>
                    <label for="reason">Reason:</label>
                    <select id="reason" name="reason" required>
                        <option value="Damaged Item">Damaged Item</option>
                        <option value="Wrong Item">Wrong Item</option>
                        <option value="Late Delivery">Late Delivery</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label for="details">Details:</label>
                    <textarea id="details" name="details" rows="4" required></textarea>
                </div>
                <div>
                    <button type="submit">Submit Dispute</button>
                </div>
            </form>
        </section>
        <section class="section3">
            <div class="cart_checkout_div">
                <button onclick="window.location.href='cart'">Checkout</button>
                <button onclick="window.location.href='cart'">View Cart</button>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Kasoowa</p>
    </footer>
    <script>
        let toggle = document.getElementById("menu");
        let menu = document.getElementById("navigate");
        let device_width = window.innerWidth;
        toggle.addEventListener("click", function() {
            // Add your toggle functionality here
        });
    </script>
</body>
</html>