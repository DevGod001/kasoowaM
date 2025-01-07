<?php
include_once 'connect.php';
function userlogin(){
    if(!isset($_COOKIE['account_type'])){
        header('Location:login');
        exit;
    }
    if(!isset($_COOKIE['user_id']) || !isset($_COOKIE['user_key']) || !isset($_COOKIE['username'])){
        header('Location:login');
        exit;
    }
 
}

function convertCurrency($from, $to, $amount) {
    $apiKey = 'e2e06e10118b4acd96ced9fab0d37109'; // Your Open Exchange Rates API key
    $url = "https://openexchangerates.org/api/latest.json?app_id=$apiKey";

    try {
        // Fetch data using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Error fetching exchange rates: ' . curl_error($ch));
        }

        curl_close($ch);

        // Decode JSON response
        $data = json_decode($response, true);
        if (!isset($data['rates'][$to]) || !isset($data['rates'][$from])) {
            throw new Exception("$to or $from not found in rates. Check API response.");
        }

        // Debugging response
        // print_r($data); // Uncomment to see API response structure

        // Calculate exchange rate and converted amount
        $exchangeRate = $data['rates'][$to] / $data['rates'][$from];
        $convertedAmount = round($amount * $exchangeRate, 2);

        // Return the converted amount
        return $convertedAmount;
        $_SESSION['converted']=$convertedAmount;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null; // Return null on error
    }
}

 if(isset($_COOKIE['user_id'])){
     $id=$_COOKIE['user_id'];
     $select="SELECT * FROM `users` WHERE `id`=$id";
     $selected=mysqli_query($conn,$select);
     $fetch=mysqli_fetch_assoc($selected);
     $account_type=$fetch['account_type'];
     if($account_type == "seller"){
$nav='<a href="products"><i class="material-icons">store</i>Marketplace</a>
        <a href="orders"><i class="material-icons">shopping_bag</i>Orders</a>
         <a href="inbox"><i class="material-icons">message</i>Inbox</a>
         <a href="sell"><i class="material-icons">sell</i>Sell</a>
          <a href="cart"><i class="material-icons">shopping_cart</i>My Cart</a>
         <a href="transactions"><i class="material-icons">receipt</i>Transactions</a>
        <a href="wallet"><i class="material-icons">account_balance</i>Wallet </a>
        <a href="disputes"><i class="material-icons">gavel</i>My Disputes </a>
        <a href="history"><i class="material-icons">history</i>My Products</a>
         <a href="store"><i class="material-icons">store</i>My Store</a>
          
           <a href="profile"><i class="material-icons">account_circle</i>Profile </a>
       <a id="logout" href="logout"><i class="material-icons">exit_to_app</i>Logout</a>';

$account_nav='<a href="products"><i class="material-icons">store</i>Marketplace<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="orders"><i class="material-icons">shopping_bag</i>Orders<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
         <a href="inbox"><i class="material-icons">message</i>Inbox<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
         <a href="sell"><i class="material-icons">sell</i>Sell<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
          <a href="cart"><i class="material-icons">shopping_cart</i>My Cart<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
          <a href="transactions"><i class="material-icons">receipt</i>Transactions<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="wallet"><i class="material-icons">account_balance</i>Wallet <i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="disputes"><i class="material-icons">gavel</i>My Disputes <i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="history"><i class="material-icons">history</i>My products<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
         <a href="store"><i class="material-icons">store</i>My Store<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
          
           <a href="profile"><i class="material-icons">account_circle</i>Profile <i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
       <a id="logout" href="logout"><i class="material-icons">exit_to_app</i>Logout<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>';
}
 else{
    $nav='<a href="products"><i class="material-icons">store</i>Marketplace</a>
        <a href="orders"><i class="material-icons">shopping_bag</i>Orders</a>
         <a href="inbox"><i class="material-icons">message</i>Inbox</a>
          <a href="cart"><i class="material-icons">shopping_cart</i>My Cart</a>
           
         <a href="transactions"><i class="material-icons">receipt</i>Transactions</a>
        <a href="wallet"><i class="material-icons">account_balance</i>Wallet </a>
        <a href="disputes"><i class="material-icons">gavel</i>My Disputes </a>
        
           <a href="profile"><i class="material-icons">account_circle</i>Profile </a>
       <a id="logout" href="logout"><i class="material-icons">exit_to_app</i>Logout</a>';

$account_nav='<a href="products"><i class="material-icons">store</i>Marketplace<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="orders"><i class="material-icons">shopping_bag</i>Orders<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
         <a href="inbox"><i class="material-icons">message</i>Inbox<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
          <a href="cart"><i class="material-icons">shopping_cart</i>My Cart<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
           <a href="transactions"><i class="material-icons">receipt</i>Transactions<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="wallet"><i class="material-icons">account_balance</i>Wallet <i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
        <a href="disputes"><i class="material-icons">gavel</i>My Disputes <i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
          
           <a href="profile"><i class="material-icons">account_circle</i>Profile <i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>
       <a id="logout" href="logout"><i class="material-icons">exit_to_app</i>Logout<i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>';
 
 }
 
 
 
 
 
}
#queries

$update="UPDATE `products` SET `status`='out of stock',`in_stock`=0 WHERE `in_stock` <= 0";
$updated=mysqli_query($conn,$update); 
$delete="DELETE FROM `cart` WHERE `product_id` IN(SELECT `id` FROM `products` WHERE `status`='out of stock' OR `in_stock` <= 0)";
$deleted=mysqli_query($conn,$delete);





?>