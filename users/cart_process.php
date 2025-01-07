<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
include_once 'haversine.php';
include_once 'script.php';
//include_once 'here.php';
$user_id=$_COOKIE['user_id'];

if(isset($_COOKIE['cart_id'])){
                        $cart_id=$_COOKIE['cart_id'];
                        
                        
                    }
                      else{
                          $cart_id="XGASSJMBVDSERTYUIKMBCXSERTYJ";
                      }
if(isset($_POST['delete_row'])){
    $id=mysqli_real_escape_string($conn,$_POST['id']);
    $delete="DELETE FROM `cart` WHERE `id`=$id";
    $deleted=mysqli_query($conn,$delete);
    if($deleted){
        echo "success";
    }
}
if(isset($_POST['update_address'])){
    $address=mysqli_real_escape_string($conn,$_POST['update_address']);
   $update="UPDATE `accounts` SET `address`='$address' WHERE `user_id`=$user_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
       //$response=here($address);
       echo $response;
       echo "success";
       exit;
   }
    else{
        echo "error";
        exit;
    }
}
// delivery fee
if(isset($_POST['calculate'])){
    $to=mysqli_real_escape_string($conn,$_POST['to']);
    $from=mysqli_real_escape_string($conn,$_POST['from']);
   function getRoadDistance($address1, $address2, $apiKey) {
    $address1 = urlencode($address1);
    $address2 = urlencode($address2);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$address1}&destinations={$address2}&key={$apiKey}";

    // Make the HTTP request
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Check for a valid response
    if ($data['status'] === 'OK') {
        $rows = $data['rows'][0]['elements'][0];
        if ($rows['status'] === 'OK') {
            // Distance in meters
            return $rows['distance']['value'] / 1609.34; // Convert to miles
            
        } else {
            throw new Exception("Error fetching road distance: " . $rows['status']);
        }
    } else {
        throw new Exception("Error fetching data: " . $data['status']);
    }
}

// Usage
$apiKey = 'AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c'; // Replace this with your actual API key
$address1 = $to;
$address2 = $from;
//$address1="1810 Forest Willow Court, Columbus, Ohio, 43229, USA";
//$address2="Along FMC Road, Apir, Makurdi, 970101, Benue State, Nigeria";

try {
    $distance = getRoadDistance($address1, $address2, $apiKey);

    echo round($distance, 2);// result outtput in miles
   
} catch (Exception $e) {
  
    echo $e->getMessage();
} 
}
// delivery fee sum
if(isset($_POST['sum'])){
   function getRoadDistance($address1, $address2, $apiKey) {
    $address1 = urlencode($address1);
    $address2 = urlencode($address2);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$address1}&destinations={$address2}&key={$apiKey}";

    // Make the HTTP request
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Check for a valid response
    if ($data['status'] === 'OK') {
        $rows = $data['rows'][0]['elements'][0];
        if ($rows['status'] === 'OK') {
            // Distance in meters
            return $rows['distance']['value'] / 1609.34; // Convert to miles
            
        } else {
            throw new Exception("Error fetching road distance: " . $rows['status']);
        }
    } else {
        throw new Exception("Error fetching data: " . $data['status']);
    }
}
$sum=0;
// Usage
$select="SELECT * FROM `accounts` WHERE  `user_id` IN(SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `uniqid`='$cart_id'))";
$selected=mysqli_query($conn,$select);
if($selected){
    
    while($fetch=mysqli_fetch_assoc($selected)){
        $apiKey = 'AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c'; // Replace this with your actual API key
$address1 = $fetch['address'];
$get="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
$gotten=mysqli_query($conn,$get);
$carry=mysqli_fetch_assoc($gotten);

$address2 = $carry['address'];
//$address1="1810 Forest Willow Court, Columbus, Ohio, 43229, USA";
//$address2="Along FMC Road, Apir, Makurdi, 970101, Benue State, Nigeria";

switch($_COOKIE['ip']){
    case "nigeria":
        $fixed=50;
        $fixed2=20;
        break;
        case "united_states":
        case "canada":
        $fixed="3";
        $fixed2=1.5;
        break;
        default:
        $fixed="30";
        $fixed2=15;
        break;
}


try {
    $distance = getRoadDistance($address1, $address2, $apiKey);
     $fee=round($distance, 2) + $fixed * $fixed2;
      if($distance==0){
         $fee=0;
         
     }
     $sum=$fee+$sum;
    
   
   
} catch (Exception $e) {
  
    echo $e->getMessage();
} 
    }
    
    echo $sum;// result outtput in miles
    
}

}

if(isset($_GET['currency'])){
   function getRoadDistance($address1, $address2, $apiKey) {
    $address1 = urlencode($address1);
    $address2 = urlencode($address2);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$address1}&destinations={$address2}&key={$apiKey}";

    // Make the HTTP request
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Check for a valid response
    if ($data['status'] === 'OK') {
        $rows = $data['rows'][0]['elements'][0];
        if ($rows['status'] === 'OK') {
            // Distance in meters
            return $rows['distance']['value'] / 1609.34; // Convert to miles
            
        } else {
            throw new Exception("Error fetching road distance: " . $rows['status']);
        }
    } else {
        throw new Exception("Error fetching data: " . $data['status']);
    }
}
$sum=0;
// Usage
$select="SELECT * FROM `accounts` WHERE  `user_id` IN(SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `uniqid`='$cart_id'))";
$selected=mysqli_query($conn,$select);
if($selected){
    
    while($fetch=mysqli_fetch_assoc($selected)){
        $apiKey = 'AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c'; // Replace this with your actual API key
$address1 = $fetch['address'];
$store1=$fetch['business_name'];
if(empty($store1)){
    $store1=$fetch['username'];
}
$get="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
$gotten=mysqli_query($conn,$get);
$carry=mysqli_fetch_assoc($gotten);

$address2 = $carry['address'];
$currency=mysqli_real_escape_string($conn,$_GET['currency']);
//$address1="1810 Forest Willow Court, Columbus, Ohio, 43229, USA";
//$address2="Along FMC Road, Apir, Makurdi, 970101, Benue State, Nigeria";

switch($_COOKIE['ip']){
    case "nigeria":
        $fixed=50;
        $fixed2=20;
        break;
        case "united_states":
        case "canada":
        $fixed="3";
        $fixed2=1.5;
        break;
        default:
        $fixed="30";
        $fixed2=15;
        break;
}


try {
    $distance = getRoadDistance($address1, $address2, $apiKey);
     $fee=round($distance, 2) + $fixed * $fixed2;
      if($distance==0){
         $fee=0;
         
     }
     $sum=$fee+$sum;
     $distance=round($distance,2);
    echo "<span style=\"font-size:0.7rem;font-family:sora\"> $store1 - $currency$fee($distance miles)</span>";
   
   
} catch (Exception $e) {
  
    echo $e->getMessage();
} 
    }
    
   
    
}

}
if(isset($_POST['delete_loop'])){
    $id=mysqli_real_escape_string($conn,$_POST['id']);
    $delete="DELETE FROM `cart` WHERE `id`=$id";
    $deleted=mysqli_query($conn,$delete);
    if($deleted){
        echo "success";
    }
        else{
            echo "error";
        }
    
}
if(isset($_GET['total'])){
    $select="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `uniqid`='$cart_id'";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $fetch=mysqli_fetch_assoc($selected);
        $total=$fetch['total'];
        echo $total;
    }
}
if(isset($_GET['subtotal'])){
    $fee=6/100;
   
   $select="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `uniqid`='$cart_id'";
   $selected=mysqli_query($conn,$select);
   if($selected){
       $fetch=mysqli_fetch_assoc($selected);
       $total=$fetch['total'];
       $service_fee=$total * $fee;
       $subtotal=$total + $service_fee;
       $headers=[
           'total' => number_format($total),
           'subtotal' => number_format($subtotal),
           'service_fee' => number_format($service_fee)
           ];
       echo json_encode($headers);
   }
}

if(isset($_GET['progress'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
     $pid=mysqli_real_escape_string($conn,$_GET['pid']);
     //echo $pid;
     //exit;
    $select="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `id`=$id))";
    
    $selected=mysqli_query($conn,$select);
    if($selected){
        $fetch=mysqli_fetch_assoc($selected);
        $get="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `product_id` IN(SELECT `id` FROM `products` WHERE `id`=$id)";
        $gotten=mysqli_query($conn,$get);
        if($gotten){
            $limit=$fetch['minimum_order'];
            $carry=mysqli_fetch_assoc($gotten);
           $total=$carry['total'];
          // $width=$total
          echo $total;
        }
        
        
        
        
    }
}
if(isset($_GET['increase'])){
    $cid=mysqli_real_escape_string($conn,$_GET['cart_id']);
    $action=mysqli_real_escape_string($conn,$_GET['action']);
    if($action == "plus"){
    $select="SELECT * FROM `products` WHERE `id` IN (SELECT `product_id` FROM `cart` WHERE `id`=$cid)";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $fetch=mysqli_fetch_assoc($selected);
        $in_stock=$fetch['in_stock'];
        $pid=$fetch['id'];
        $get="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `product_id`=$pid AND `uniqid`='$cart_id'";
        $gotten=mysqli_query($conn,$get);
        if($gotten){
            $carry=mysqli_fetch_assoc($gotten);
            $current=$carry['total'];
        
        }
        if($current >= $in_stock){
            $data=[
                     'state' => 'error',
                     'message' => "error!there are currently 0 of this product in stock"
                    
                     
                     ];
            echo json_encode($data);
            exit;
        }
         else{
             $update="UPDATE `cart` SET `quantity`=quantity + 1 WHERE `id`=$cid";
             $updated=mysqli_query($conn,$update);
            
             if($updated){
                  $select="SELECT * FROM `cart` WHERE `id`=$cid";
             $selected=mysqli_query($conn,$select);
             if($selected){
                 $fetch=mysqli_fetch_assoc($selected);
                 $quantity=$fetch['quantity'];
                 $total=$fetch['product_cost'] * $quantity;
               
                 $data=[
                     'state' => 'success',
                     'quantity' => $quantity,
                     'total' =>number_format($total)
                     
                     ];
                 echo json_encode($data);
                 exit;
             }
                 
             }
         }
    }
    }
     else{
        
    $select="SELECT * FROM `products` WHERE `id` IN (SELECT `product_id` FROM `cart` WHERE `id`=$cid)";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $fetch=mysqli_fetch_assoc($selected);
        $in_stock=$fetch['in_stock'];
        $pid=$fetch['id'];
        $get="SELECT * FROM `cart` WHERE `id`=$cid AND `uniqid`='$cart_id'";
        $gotten=mysqli_query($conn,$get);
        if($gotten){
            $carry=mysqli_fetch_assoc($gotten);
            $current=$carry['quantity'];
        
        }
        if($current <= 1){
            $data=[
                     'state' => 'error',
                     'message' =>  "error!quantity cannot be less than one,use the delete button if you wish to remove this item"
                    
                     
                     ];
            echo json_encode($data);
            exit;
           
        }
         else{
             $update="UPDATE `cart` SET `quantity`=quantity - 1 WHERE `id`=$cid";
             $updated=mysqli_query($conn,$update);
             if($updated){
                $select="SELECT * FROM `cart` WHERE `id`=$cid";
             $selected=mysqli_query($conn,$select);
             if($selected){
                 $fetch=mysqli_fetch_assoc($selected);
                 $quantity=$fetch['quantity'];
                 $total=$fetch['product_cost'] * $quantity;
               
                 $data=[
                     'state' => 'success',
                     'quantity' => $quantity,
                     'total' => number_format($total)
                     
                     ];
                 echo json_encode($data);
                 exit;
             }
             }
         }
    }
    
     }
}
if(isset($_POST['progress'])){
    $response=[];
   $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id' ORDER BY `id` DESC";
   $selected=mysqli_query($conn,$select);
   if($selected){
       while($fetch=mysqli_fetch_assoc($selected)){
          $id=$fetch['id'];
          $pid=$fetch['product_id'];
          $currency=$fetch['currency'];
          $get="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `product_id`=$pid AND `uniqid`='$cart_id'";
          $gotten=mysqli_query($conn,$get);
         
          if($gotten){
              $carry=mysqli_fetch_assoc($gotten);
              // to be used in array
              $total=$carry['total'];
              $select_limit="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `user_id` FROM `products` WHERE `id`=$pid)";
              $limit_selected=mysqli_query($conn,$select_limit);
              if($limit_selected){
                  $limit_fetch=mysqli_fetch_assoc($limit_selected);
                  // to be used
                 $limit=$limit_fetch['minimum_order'];
                 $remaining=$limit - $total;
                 $width=$total / $limit * 100;
                  
              }
              
          }
          $response[]=[
              'total' => number_format($total),
              'remaining' => "add ".$currency.number_format($remaining)." more  to meet  minimum order amount",
              'width' => $width,
              'class' => $fetch['store_id']
              ];
       }
   }
  echo json_encode($response);
  exit;
}
if(isset($_GET['cart_totals'])){
    $select="SELECT * FROM `users` WHERE `id` IN( SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `uniqid`='$cart_id'))";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $delivery_fee_array=[];
     while($fetch=mysqli_fetch_assoc($selected)){
         $sid=$fetch['id'];
       $lat_from=$fetch['latitude'];
       $lng_from=$fetch['longitude'];
       $select_users="SELECT * FROM `users` WHERE `id`=$user_id";
       $users_selected=mysqli_query($conn,$select_users);
       if($users_selected){
           $fetch_users=mysqli_fetch_assoc($users_selected);
           $lat_to=$fetch_users['latitude'];
           $lng_to=$fetch_users['longitude'];
       }
       $response=fetch_miles($conn,$sid);
       $response=round($response,2);
       $country=$fetch_users['country'];
       $currency=$fetch_users['currency'];
       $data=mile_fees($country);
       $data=json_decode($data,true);
       $fee=$data['fee'];
       $fixed=$data['fixed'];
       $loop_sum=($fee + $response) * $fixed;
       $delivery_fee_array[]=$loop_sum;
      
     }
     
     $total_delivery_fee=array_sum($delivery_fee_array);
     $vip_fee=round($total_delivery_fee,2);
    
     if(isset($_SESSION['option']) && str_contains($_SESSION['option'],"door")){
         
         $total_delivery_fee=round($total_delivery_fee,2);
     }
      else{
           $total_delivery_fee=0;
      }
     $select_sum="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `uniqid`='$cart_id'";
     $sum_selected=mysqli_query($conn,$select_sum);
     if($sum_selected){
         $sum_fetch=mysqli_fetch_assoc($sum_selected);
         $subtotal=$sum_fetch['total'];
         $service_fee=(6 * $subtotal)/100;
         $grand_total=$subtotal + $total_delivery_fee + $service_fee;
         $grand_total=round($grand_total,2);
         $subtotal=round($subtotal,2);
         $service_fee=round($service_fee,2);
     }
     
    }
    $return=[
        'status' => 'success',
         'delivery fee' => number_format($total_delivery_fee),
         'currency' => $currency,
         'subtotal' => number_format($subtotal),
         'service fee' => number_format($service_fee),
         'grand total' => number_format($grand_total),
         'vip fee' => number_format($vip_fee)
         
        ];
        echo json_encode($return,true);
}
if(isset($_GET['option'])){
    $option=$_GET['option'];
    $_SESSION['option']=$option;
    $_SESSION['delivery_option']=$option;


    echo "success";
}

if(isset($_POST['exists'])){
    $sid=$_POST['id'];
    $select="SELECT * FROM `cart` WHERE `product_id` IN(SELECT `id` FROM `products` WHERE `user_id`=$sid) AND `uniqid`='$cart_id'";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $row=mysqli_num_rows($selected);
        if($row == 0){
            echo "empty";
        }
         else{
             echo "success";
         }
    }
}
//echo "error";
//exit;
if(isset($_POST['list'])){
    $sid=$_POST['sid'];
   $select="SELECT * FROM `users` WHERE `id`=$sid";
   $selected=mysqli_query($conn,$select);
   if($selected){
      $fetch=mysqli_fetch_assoc($selected);
      $lat1=$fetch['latitude'];
      $lng1=$fetch['longitude'];
      $select_user="SELECT * FROM `users` WHERE `id`=$user_id";
      $user_selected=mysqli_query($conn,$select_user);
      if($user_selected){
          $fetch_user=mysqli_fetch_assoc($user_selected);
          $lat2=$fetch_user['latitude'];
          $lng2=$fetch_user['longitude'];
      }
      $response=fetch_miles($conn,$sid);
      $mile=round($response,2);
      $mile_fees=mile_fees($fetch_user['country']);
      $mile_fees=json_decode($mile_fees,true);
      $fee=$mile_fees['fee'];
     
      $fixed=$mile_fees['fixed'];
      $fee=($fee + $mile) * $fixed;
       $fee=round($fee,2);
     
   }
   $select="SELECT * FROM `accounts` WHERE `user_id`=$sid";
   $selected=mysqli_query($conn,$select);
   if($selected){
       $fetch=mysqli_fetch_assoc($selected);
       $business_name=$fetch['business_name'];
       if(empty($business_name)){
           $business_name=$fetch['username'];
       }
   }
   $select="SELECT * FROM `cart` WHERE `product_id` IN(SELECT `id` FROM `products` WHERE `user_id`=$sid) AND `uniqid`='$cart_id'";
   $selected=mysqli_query($conn,$select);
   if($selected){
       $row=mysqli_num_rows($selected);
       $list='';
       while($fetch=mysqli_fetch_assoc($selected)){
           $list = $list.'<li>'.$fetch['product_title'].'</li>';
       }
   }
  // $list="test";
   
   $return=[
       'fee' => $fee,
       'miles' => $mile,
       'business name' => $business_name,
       'list' => $list,
       'row' => $row
       
       ];
       echo json_encode($return);
}
if(isset($_GET['check_rows'])){
    $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id'";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $row=mysqli_num_rows($selected);
        echo $row;
    }
}
if(isset($_GET['checkout'])){
    $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id' GROUP BY `store_id`";
    $selected=mysqli_query($conn,$select);
    if($selected){
        while($fetch=mysqli_fetch_assoc($selected)){
           $cost=$fetch['product_cost'];
           $sid=$fetch['store_id'];
           $sum="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `store_id`=$sid AND `uniqid`='$cart_id'";
           $summed=mysqli_query($conn,$sum);
           $carry=mysqli_fetch_assoc($summed);
           $total=$carry['total'];
           $get="SELECT * FROM `accounts` WHERE `user_id`=$sid";
           $gotten=mysqli_query($conn,$get);
           $carry=mysqli_fetch_assoc($gotten);
           $business_name=$carry['business_name'];
           if(empty($business_name)){
               $business_name=$carry['username'];
           }
           $limit=$carry['minimum_order'];
           $remaining=$limit - $total;
           $get="SELECT * FROM `users` WHERE `id`=$sid";
           $gotten=mysqli_query($conn,$get);
         //$limit=10;
           if($gotten){
               $carry=mysqli_fetch_assoc($gotten);
               $currency=$carry['currency'];
           }
           $link="products?store_id=$sid&store=".urlencode($business_name);
          if($limit > $total){
               $limit=number_format($limit,2);
           $remaining=number_format($remaining,2);
              echo "<li onclick='window.location.href=\"$link\"'>$business_name requires a minimum of <span>$currency</span>$limit to shop their store, add <span>$currency</span>$remaining more to continue</li>";
              
          }
           else{
               echo "";
           }
        }
    }
}
if(isset($_GET['verify_option'])){
    if(isset($_SESSION['option'])){
        echo "set";
        
        exit;
    }
     else{
         echo "unset";
         exit;
     }
}
// function to reset cart
if(isset($_GET['reset_cart'])){
   $delete="DELETE FROM `cart` WHERE `uniqid`='$cart_id'";
   $deleted=mysqli_query($conn,$delete);
   if($deleted){
       echo "success";
   }
    else{
        echo "error";
    }
}
if(isset($_GET['single_checkout'])){
    $id=$_GET['id'];
   
   $select="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `store_id` FROM `cart` WHERE `id`=$id)";
   $selected=mysqli_query($conn,$select);
       $fetch=mysqli_fetch_assoc($selected);
       $limit=$fetch['minimum_order'];
       $business_name=$fetch['business_name'];
       if(empty($business_name)){
           $business_name=$fetch['username'];
       }
       $sid=$fetch['user_id'];
       $select="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `store_id` IN(SELECT `store_id` FROM `cart` WHERE `id`=$id)";
       $selected=mysqli_query($conn,$select);
       $fetch=mysqli_fetch_assoc($selected);
       $total=$fetch['total'];
       $remaining=$limit - $total;
       $store=urlencode($business_name);
       $link="products?store_id=$sid&store=$store";
       $select="SELECT * FROM `users` WHERE `id`=$user_id";
       $selected=mysqli_query($conn,$select);
       $fetch=mysqli_fetch_assoc($selected);
       $currency=$fetch['currency'];
      if($total < $limit){
          $limit=number_format($limit);
          $total=number_format($total);
          $remaining=number_format($remaining);
          echo "<li onclick='window.location.href=\"$link\"'>$business_name requires a minimum of <span>$currency</span>$limit to shop their store, add <span>$currency</span>$remaining more to continue</li>";
              
      }
       else{
           echo "success";
       }
   
}
if(isset($_GET['get_stores'])){
    $uniqid=$cart_id;

            $select="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `store_id` FROM `cart` WHERE `uniqid`='$uniqid')";
            $selected=mysqli_query($conn,$select);
            if(mysqli_num_rows($selected) > 0){
         while($fetch=mysqli_fetch_assoc($selected)){
             $business_name=$fetch['business_name'];
             if(empty($business_name)){
                 $business_name=$fetch['username'];
             }
             $minimum_order=$fetch['minimum_order'];
             $sid=$fetch['user_id'];
             $get="SELECT * FROM `users` WHERE `id`=$sid";
             $gotten=mysqli_query($conn,$get);
             $carry=mysqli_fetch_assoc($gotten);
             $currency=$carry['currency'];
            $get="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `store_id`=$sid";
            $gotten=mysqli_query($conn,$get);
            $carry=mysqli_fetch_assoc($gotten);
            $total=$carry['total'];
            $remain=$minimum_order - $total;
            $link="products?store_id=$sid&store=$business_name";
            $width=($total/$minimum_order) * 100;
        if($remain <= 0){
            $display="none";
        }
         else{
             $display="";
         }
             echo '<div class="stores">
                    <span>'.$business_name.'</span> 
                    <section class="stores_det_section">
                        <div class="details_div"><span>minimum order :'.$currency.''.$minimum_order.'</span><span>'.$currency.''.$total.' of '.$currency.''.$minimum_order.'</span></div>
                        <div class="stores_progress_parent">
                            <div style="width:'.$width.'%" class="stores_progress_child">
                                
                            </div>
                        </div>
                        <div style="display:'.$display.';" class="details_div"><span style="font-size:0.7rem;color:red">Add '.$currency.''.$remain.' more to meet the minimum order amount</span></div>
                        <div style="padding:10px 0;">
                            <button onclick="window.location.href=&quot;'.$link.'&quot;" class="shop_this_store">
                                Shop this Store
                            </button>
                        </div>
                    </section>
                </div>
                ';
         }
            }
             else{
                 echo "";
             }
}  
if(isset($_GET['store_details'])){
    $sid=$_GET['sid'];
    $select="SELECT * FROM `accounts` JOIN `users` ON `users`.`id`=`accounts`.`user_id` WHERE `accounts`.`user_id`=$sid";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $business_name=$fetch['business_name'];
    if(empty($business_name)){
        $business_name=$fetch['username'];
    }
    $store=$business_name;
    $store_id=$sid;
    $minimum_order=$fetch['minimum_order'];
    $currency=$fetch['currency'];
    // select for cart sum
    $select="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `store_id`=$sid";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $total=$fetch['total'];
    $remaining=$minimum_order - $total;
     $width=$total/$minimum_order * 100;
     $link="products?store_id=".$sid."&store=".urlencode($store);
                          if($remaining <= 0){
                              $display="none";
                          }
                            else{
                                $display="flex"; 
                            }
                            echo '<input type="hidden" value="'.$store_id.'" class="hidden_sid">
                    <span style="background:#001f3f;color:white;padding:10px">'.$store.'</span> 
                    <section class="stores_det_section">
                        <div class="details_div"><span>minimum order: '.$currency.$minimum_order.'</span><span>'.$currency.$total.' of '.$currency.$minimum_order.'</span></div>
                        <div class="stores_progress_parent">
                            <div style="width:'.$width.'%" class="stores_progress_child">
                                
                            </div>
                        </div>
                        <div style="display:'.$display.';" class="details_div"><span style="font-size:0.7rem;color:red">Add '.$currency.$remaining.' more to meet the minimum order amount</span></div>
                        <div style="display:flex;justify-content:space-between;padding:10px 0">
                            <button onclick="window.location.href=&quot;'.$link.'&quot;" class="shop_this_store pointer">
                                Shop this Store
                            </button>
                            <button onclick="store_checkout_details('.$store_id.')" class="shop_this_store pointer">
                               Checkout
                            </button>
                        </div>
                    </section>';
    
}
if(isset($_GET['store_checkout'])){
    $sid=$_GET['sid'];
   
     if(!isset($_SESSION['option'])){
        echo "error! select delivery option";
        exit;
    }
     $option=$_SESSION['option'];
   
    $select="SELECT `accounts`.*,`users`.`currency`,`users`.`country` FROM `accounts` JOIN `users` ON `users`.`id`=`accounts`.`user_id` WHERE `accounts`.`user_id`='$sid'";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $store=$fetch['business_name'];
    if(empty($store)){
        $store=$fetch['username'];
    }
    $minimum_order=$fetch['minimum_order'];
    $currency=$fetch['currency']; 
    $country=$fetch['country'];
    
    // selecting all products from cart on the store
    $select="SELECT * FROM `cart` WHERE `store_id`=$sid AND `uniqid`='$cart_id'";
    $selected=mysqli_query($conn,$select);
    $products="";
    
    while($fetch=mysqli_fetch_assoc($selected)){
        $products=$products.$fetch['product_title'].",";
        $miles=$fetch['miles'];
       
    }
    
    $products=trim($products,",");
  
  
    // selecting sum of the items
     $select="SELECT SUM(product_cost*quantity) AS `total` FROM `cart` WHERE `store_id`=$sid AND `uniqid`='$cart_id'";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $total=$fetch['total'];
    $remaining=$minimum_order - $total;

    $total=$total + ($total * 6)/100;
    $service=(6 * $total)/100;
    if($minimum_order > $total){
        $remaining=number_format($remaining);
        $minimum_order=number_format($minimum_order);
        $variable=' <div class="checkout_child">
          <div class="checkout_head"><strong style="font-family:sora">⚠ Error!</strong></div>
          <div class="checkout_det">
              <ul>
              <li style="font-family:sora">'.$store.' requires a minimum of <span>'.$currency.'</span>'.$minimum_order.' to shop their store, add <span>'.$currency.'</span>'.$remaining.' more to continue</li>
                </ul>  
          </div>
          <div class="checkout_buttons">
              <button class="close">
                  Close
              </button>
              
          </div>
      </div>';
      echo $variable;
      exit;
    }
    if(str_contains($option,"doorstep")){
        $delivery_fee="";
        $fees=mile_fees($country);
        $fees=json_decode($fees,true);
        $fee=$fees['fee'];
        $fixed=$fees['fixed'];
        
     $delivery_fee=($miles + $fee) * $fixed;
     
     $formatted_delivery_fee=number_format($delivery_fee);
        $li='<li>
                      Delivery fee:'.$currency.$formatted_delivery_fee.'
                  </li>';
    }
     else{
         $li="";
         $delivery_fee=0;
     }
     $final=$total + $delivery_fee;
     $final=number_format($final);
     $total=number_format($total);
     $service=number_format($service);
     $response=payment_method($country);
     $key=uniqid("pay_");
    $response=$response."?key=$key&store_checkout=true&sid=$sid";
    $variable=' <div class="checkout_child">
          <div class="checkout_head"><strong>Checkout Details</strong></div>
          <div class="checkout_det">
              <ul>
                  <li>
                      Store:'.$store.'
                  </li>
                  <li>
                      items:'.$products.'
                  </li>
                  <li>
                      Delivery option:'.$option.'
                  </li>
                  <li>
                    Total price:'.$currency.$total.'
                  </li>
                   <li>
                  Service Charge:'.$currency.$service.'
                  </li>
                  
                  '.$li.'
                  <li>
                      Total:'.$currency.$final.'
                  </li>
              </ul>
          </div>
          <div class="checkout_buttons">
              <button class="close">
                  Close
              </button>
              <button class="proceed" onclick="store_checkout(\''.$response.'\')">
                Proceed to Checkout
              </button>
          </div>
      </div>';
      echo $variable;
}
?>