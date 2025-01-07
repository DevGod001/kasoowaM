<?php 

session_start();
include_once 'connect.php';
# functions 

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
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null; // Return null on error
    }
}





















$country=$_COOKIE['ip'];
 if(isset($_COOKIE['cart_id'])){
        $uniqid=$_COOKIE['cart_id'];
        }
         else{
             $uniqid="xxxxxxx";
         }
         
if(isset($_POST['remove_cart'])){
    $id=mysqli_real_escape_string($conn,$_POST['id']);
    $delete="DELETE FROM `cart` WHERE `id`=$id";
    $deleted=mysqli_query($conn,$delete);
    if($deleted){
        echo "deleted";
        exit;
    }
}

if(isset($_GET['update_cart_items'])){
    $select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid' ORDER BY `date` DESC LIMIT 50"; 
                    $selected=mysqli_query($conn,$select);
                    $row=mysqli_num_rows($selected);
                    
                    if($row > 0){
                        while($fetch=mysqli_fetch_assoc($selected)){
                         echo '<div class="cart_product" >
              <div class="cart_image" style="background-image:url(&quot;'.$fetch['product_photo'].'&quot;);">
                 <input value="'.$fetch['id'].'" type="hidden" class="curr_cart_id"> 
                 <input type="hidden" class="hidden_cart_cost" value="'.$fetch['product_cost'].'">
              </div><section class="cart_product_details"><span>-'.$fetch['size'].''.$fetch['unit'].'</span><br><strong><span class="cart_quantity">'.$fetch['quantity'].'</span> x <span><strong style="font-family:Arial;font-size:0.9rem" class="cart_currency">'.$fetch['currency'].'</strong><span class="cart_cost">'.$fetch['product_cost'].'</span></span></strong></section>
              <section onclick="window.location.reload()" class="cart_remove" style="margin-left:auto;user-select:none">&times</section>
              </div>
            ';   
                        }
                    }
          
}
#homepage search
if(isset($_GET['search_categories'])){
    $search=$_GET['search'];
     $search=trim($search);
     $search=explode(" ",$search);
     $tot=count($search);
     if(isset($_COOKIE['ip'])){
         $country=$_COOKIE['ip'];
     }
      else{
          $country="unset";
      }
     $condition=[];
     
     for($z=0;$z < $tot;$z++){
         $condition[]="`name` LIKE '%$search[$z]%'";
             
     }
     $condition=implode("AND",$condition);
    $select="SELECT * FROM `categories` WHERE $condition";
    $selected=mysqli_query($conn,$select);
    $rows=mysqli_num_rows($selected); 
    if($rows > 0){
        while($fetch=mysqli_fetch_assoc($selected)){
            echo '<a href="users/products?category='.$fetch['id'].'"><span>'.$fetch['name'].'</span><span>&#8594</span></a>
         ';
        }
    }
     
}


if(isset($_GET['search_categories'])){
    $search=$_GET['search'];
    $search=trim($search);
    $search=explode(" ",$search);
    $condition=[];
    $search_count=count($search);
    for($s=0;$s < $search_count;$s++){
        $match=$search[$s];
        $condition[]="`title` LIKE '%$match%'"; 
        
        
    }
    $condition=implode("AND",$condition);
    $select="SELECT * FROM `products` WHERE $condition AND `country`='$country' LIMIT 5";
    $selected=mysqli_query($conn,$select); 
    if(mysqli_num_rows($selected) > 0){
        while($fetch=mysqli_fetch_assoc($selected)){
            echo '<a href="users/products?query='.$fetch['title'].'"><span>'.$fetch['title'].'</span><span>&#8594</span></a>';
        }
    }
    
}

#product_page search
if(isset($_GET['search_store'])){
    $search=$_GET['search'];
    $country=$_COOKIE['ip'];
    $search=trim($search);
    $q=explode(" ",$search);
    $q_length=count($q);
    $condition=[];
     for($a=0;$a < $q_length;$a++){
          $loop=$q[$a];
          $loop=trim($loop);
         $condition[]="`address` LIKE '%$loop%'"; 
         
      } 
   $condition= implode("AND",$condition);
    $select="SELECT * FROM `products` WHERE `user_id` IN(SELECT `user_id` FROM `accounts` WHERE ($condition) AND `user_id` IN(SELECT `id` FROM `users` WHERE `country`='$country')) GROUP BY `user_id` LIMIT 10";
   
    
    $selected=mysqli_query($conn,$select);
    $rows=mysqli_num_rows($selected);
    

    if($rows > 0){
        while($fetch=mysqli_fetch_assoc($selected)){
            $id=$fetch['user_id'];
            $get="SELECT * FROM `accounts` WHERE `user_id`=$id";
            $gotten=mysqli_query($conn,$get);
            $carry=mysqli_fetch_assoc($gotten);
            $address=$carry['address'];
            $address=explode(",",$address);
            $count=count($address);
            $index=$count-1;
            $city=$address[$index-1];
            if($country !== 'nigeria'){
                 $city=$address[$index-2];
            }
            echo '<a href="products?store_id='.$carry['user_id'].'&store='.$carry['business_name'].'"><span>'.$carry['business_name'].'  - '.$city.','.$address[$index].'</span><span>&#8594</span></a>
         ';
        }
    }
     #else{
        # echo '<a><span>No categories found.....</span></a>';
         
     #}
}

if(isset($_GET['search_store'])){
    $search=$_GET['search'];
    $search=trim($search);
    $country=$_COOKIE['ip'];
    $search=explode(" ",$search);
    $count=count($search);
    $condition=[];
    for($i=0;$i < $count;$i++){
        $query=$search[$i];
        $query=trim($query);
        $condition[]="`title` LIKE '%$query%' ";
        }
        $condition=implode("AND",$condition);
    $select="SELECT * FROM `products` WHERE ($condition) AND `country`='$country' LIMIT 5";
    $selected=mysqli_query($conn,$select);
    $rows=mysqli_num_rows($selected);

    if($rows > 0){
        while($fetch=mysqli_fetch_assoc($selected)){
            
            echo '<a href="products?query='.$fetch['title'].'"><span>'.$fetch['title'].'</span><span>&#8594</span></a>
         ';
        }
    }
    
   #  else{
    #     echo '<a><span>No categories found.....</span></a>';
         
     #}
}

# discount code validator
 if(isset($_GET['discount'])){
     $user_id=$_COOKIE['user_id'];
     $code=mysqli_real_escape_string($conn,$_GET['code']);
     $cart_cost=mysqli_real_escape_string($conn,$_GET['cart_cost']);
     $subtotal=mysqli_real_escape_string($conn,$_GET['subtotal']);
     $cart_cost=str_replace(" ","",$cart_cost);
     $code=str_replace(' ',"",$code);
     $select="SELECT * FROM `discount` WHERE `code`='$code' AND `status`='active' AND `redeemed` < `limit`";
     $selected=mysqli_query($conn,$select);
     if($selected){
         $row=mysqli_num_rows($selected);
         if($row == 0){
             echo "invalid discount code";
             exit;
         }
     $fetch=mysqli_fetch_assoc($selected);
     $percentage=$fetch['percentage'];
    $minimum_checkout=$fetch['minimum_checkout'];
    $select="SELECT * FROM `users` WHERE `id`=$user_id";
    $selected=mysqli_query($conn,$select);
    if(mysqli_num_rows($selected) > 0){
        $fetch=mysqli_fetch_assoc($selected);
        $currency=$fetch['currency'];
       
        switch($currency){
             case "&#8358":
                 $curr="NGN";
                 break;
                 case "$":
                 $curr="USD";
                 break;
                 case "&#163":
                 $curr="GBP";
                 break;
                 case "&#8353":
                 $curr="GHC";
                 break;
                 case "XAF":
                 $curr="XAF";
                 break;
                 default:
                $curr="NGN";
                 break;
                 
    }
     
     convertCurrency($curr,"NGN",$minimum_checkout);
    $convertedAmount = convertCurrency( "NGN",$curr, $minimum_checkout);  // Capture the return value
if ($convertedAmount > $cart_cost){
    echo "minimum order amount for this code is $curr $convertedAmount";
    exit;
}
$response="success,".$percentage.",";
$response=$response.$subtotal - ($percentage * $cart_cost)/100;

echo $response;

     }
      else{
          echo mysqli_error($conn);
      }
 }
 }

if(isset($_GET['get_stores'])){
    if(!isset($_COOKIE['ip'])){
        echo "verify your country to see stores nearby";
        exit;
    }
 $country=$_COOKIE['ip'];
 if(isset($_COOKIE['state'])){
     $state=$_COOKIE['state'];
 }
  else{
      $state="unset";
  }
$select="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `user_id` FROM `products` WHERE `status`='active' AND `country`='$country') ORDER BY `business_name` ASC";
            $selected=mysqli_query($conn,$select);
            $row=mysqli_num_rows($selected);
            if($row > 0){
                while($fetch=mysqli_fetch_assoc($selected)){
                    $business_name=$fetch['business_name'];
                    if(empty($business_name) || $business_name=='NULL'){
                        $business_name=$fetch['username'];
                    }
                    $seller_id=$fetch['user_id'];
                    $get="SELECT * FROM `users` WHERE `id`=$seller_id";
                    $gotten=mysqli_query($conn,$get);
                    $carry=mysqli_fetch_assoc($gotten); 
                    $pix="users/".$carry['profile'];
                    if(empty($business_name)){
                        continue;
                    }
           echo '<li onclick="window.location.href=&quot;users/products?store_id='.$seller_id.'&store='.$business_name.'&quot;"><div style="background-image:url(&quot;'.$pix.'&quot;)" class="store_pic"></div><span>'.$business_name.'</span></li>';
            }
            }
             else{
                 echo '<li> No store(s) available to show</li>'; 
             }
     
}
     
     
?>