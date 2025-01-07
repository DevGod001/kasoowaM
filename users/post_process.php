<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();
include_once 'connect.php';
$user_id=$_COOKIE['user_id'];
if(isset($_GET['cost'])){
    $cost=mysqli_real_escape_string($conn,$_GET['cost']);
    $user_id=$_COOKIE['user_id'];
    $select="SELECT * FROM `users` WHERE `id`=$user_id";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $balance=$fetch['balance'];
    if($cost > $balance){
        echo "insufficient balance";
        
    }
}
if(isset($_GET['unit'])){
    $id=mysqli_real_escape_string($conn,$_GET['sub_id']);
    $select="SELECT * FROM `subcategories` WHERE `id`=$id";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $units=$fetch['units'];
    if(empty($units)){
        echo "error";
        exit;
    }
    $units=strtolower($units);
    $units=explode(",",$units);
    $total=count($units);
  for($u=0;$u < $total;$u++){
      echo '<option value="'.$units[$u].'">
                       '.$units[$u].'
                    </option>';
  }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $category=mysqli_real_escape_string($conn,$_POST['category_id']);
    $in_stock=mysqli_real_escape_string($conn,$_POST['in_stock']);
    $subcategory=mysqli_real_escape_string($conn,$_POST['subcategory_id']);
    $unit=mysqli_real_escape_string($conn,$_POST['unit']);
    $weight=[];
    $total_weight=count($_POST['measurement']);
   for($w=0;$w < $total_weight;$w++){
       $weight[]=mysqli_real_escape_string($conn,$_POST['measurement'][$w]);
   }
   $weight=implode(',',$weight);
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);
   $price=[];
   $total_price=count($_POST['price']);
   for($p=0;$p < $total_price;$p++){
       $price[]=mysqli_real_escape_string($conn,$_POST['price'][$p]);
   }
   $price=implode(',',$price);
    $feature_cost=mysqli_real_escape_string($conn,$_POST['featured']);
    $action=mysqli_real_escape_string($conn,$_POST['action']);
    $validity=mysqli_real_escape_string($conn,$_POST['duration']);
    $select="SELECT * FROM `users` WHERE `id`=$user_id";
   $selected=mysqli_query($conn,$select);
   $fetch=mysqli_fetch_assoc($selected);
   
    $country=$fetch['country'];
   $select="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
   $selected=mysqli_query($conn,$select);
   $fetch=mysqli_fetch_assoc($selected);
   $address=$fetch['address'];
   $address=explode(", ",$address);
   $total_address=count($address);
   $state_count=$total_address-1;
   $city_count=$state_count-2;
   if($country=="nigeria"){
       $city_count=$state_count-1;
   }
   $state=$address[$state_count];
   $city=$address[$city_count];
   $state=str_replace('.',"",$state);
   $state=str_replace(' state',"",$state);
   
   $total_mass=count($_POST['mass_unit']);
   $mass_unit=[];
   for($m=0;$m < $total_mass;$m++){
       $mass_unit[]=mysqli_real_escape_string($conn,$_POST['mass_unit'][$m]);
   }
   $mass_unit=implode(',',$mass_unit);
   
   
    if($action=="pending"){
        $featured="false";
    }
    if($action=="false"){
        $featured="false";
        $validity=0;
        $feature_cost=0;
        $status='active';
    }
    if($action=="neutral" && $feature_cost==0){
        $featured="false";
    }
    else{
        $featured="false";
    }
    if($action=="false"){
        $featured="false";
        
    }
    $key=array_merge(range('A','Z'),range(0,9));
    shuffle($key);
    $key=implode("",$key);
    $key=substr($key,0,20);
     if(isset($_FILES['uploads'])){
          $dir="../uploads";
         if(!is_dir($dir)){
             mkdir($dir,0777,true);
         }
         $list=[];
         $allowed=['jpg','jpeg','png','gif','webp','bmp'];
         $max_size=2 * 1024 *1024;
  $count=count($_FILES['uploads']['name']);
    
   for($i=0;$i < $count;$i++){
       $tmp=$_FILES['uploads']['tmp_name'][$i];
       $name=$_FILES['uploads']['name'][$i];
       $size=$_FILES['uploads']['size'][$i];
       $ext=strtolower(pathinfo($name,PATHINFO_EXTENSION));
       if(!in_array($ext,$allowed)){
           $_SESSION['error']='invalid image format';
           header('Location:sell');
           exit;
       }
       if($size > $max_size){
         $_SESSION['error']='image must not be more than 2mb in size';
           header('Location:sell');
           exit;   
       }
       
       $dest=$dir."/".$name;
       if(move_uploaded_file($tmp,$dest)){
           $list[]=$dest;
       }
   }
   #remember to derive status based on featured and balance
   
   $list=implode(',',$list);
   $select="SELECT * FROM `users` WHERE `id`=$user_id";
   $selected=mysqli_query($conn,$select);
   $fetch=mysqli_fetch_assoc($selected);
   $currency=$fetch['currency'];
   $country=$fetch['country'];
   switch($currency){
             case "&#8358":
                 $promotion_currency="NGN";
                 break;
                 case "$":
                 $promotion_currency="USD";
                 break;
                 case "&#163":
                 $promotion_currency="GBP";
                 break;
                 case "&#8353":
                 $promotion_currency="GHC";
                 break;
                 case "XAF":
                 $promotion_currency="XAF";
                 break;
                 default:
                $promotion_currency="NGN";
                 break;
                 
         }
   $balance=$fetch['balance'];
   if($feature_cost > $balance){
       $url="pay_promotion.php";
       $status="active";
       $_SESSION['amount']=$feature_cost;
       $_SESSION['currency']=$promotion_currency;
       $_SESSION['mail']=$fetch['mail'];
       $_SESSION['ad_key']=$key;
   }
   else{
        $url="history";
       $status="active";
       $update="";
   }
   if($feature_cost==0){
       $featured="false";
   }
   $insert="INSERT INTO `products`(`category_id`,`in_stock`,`subcategory_id`,`unit`,`weight`,`photos`,`title`,`description`,`price`,`currency`,`featured`,`feature_validity`,`user_id`,`status`,`mass_unit`,`key`,`country`,`city`,`state`) VALUES($category,'$in_stock',$subcategory,'$unit','$weight','$list','$title','$description','$price','$currency','$featured',$validity,$user_id,'$status','$mass_unit','$key','$country','$city','$state')";
   $inserted=mysqli_query($conn,$insert);
   if($inserted){
       header('Location:'.$url.'');
   }
   else{
       echo mysqli_error($conn);
   }
}




}


?>