<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
include_once 'functions.php';
userlogin();
include_once 'general_process.php';

$user_id=$_COOKIE['user_id'];
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";

$select_notifications="SELECT * FROM `notifications` WHERE `status`<>'read' AND `user_id`=$user_id LIMIT 5";
$notifications_selected=mysqli_query($conn,$select_notifications);
$notification_row=mysqli_num_rows($notifications_selected);

$select_notice="SELECT * FROM `notifications` WHERE `status`<>'read' AND `user_id`=$user_id ORDER BY `date` DESC";
$notice_selected=mysqli_query($conn,$select_notice);
$notice_row=mysqli_num_rows($notice_selected);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop groceries from anywhere worldwide">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php
    $uri=basename($_SERVER['REQUEST_URI']);
    $uri=explode('?',$uri);
    echo $uri[0];
    
    
    ?></title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop the latest products at our store.">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="login.css"> <!-- Link to your CSS file -->
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sora">
    <link rel="stylesheet" href="template.css?v=1.2">
    <link rel="stylesheet" href="orders.css?v=4.1"> 
    <link rel="manifest" href="app.json">
    <style>
        
         #notifications{
        margin-left:auto;
         margin-right:20px;
         color:navy;
         position:relative;
    }
    .notify{
        color:red;
        position:absolute;
        top:0;
        left:0;
        background:red;
        color:white;
        border-radius:50%;
        height:15px;
     width:15px;
     font-size:70%;
     display:<?php if($notice_row==0){ echo "none";
         
     }
     else{
         echo "flex";
     }
     ?>;
     flex-direction:column;
     align-items:center;
    justify-content:center;
    }
    .notice_div:hover .notice{
        display:block;
    }
    .notice{
        
        position:absolute;
        width:200px;
        right:0%;
        left:-200%;
        background:whitesmoke;
        border:1px solid silver;
        border-radius:5px;
        display:none;
        z-index:3000;
        }
    .notice strong{
        display:block;
        width:100%;
        background:navy;
        color:white;
text-align:center;
    }
    .notice button{
        margin-bottom:auto;
        margin:5%;
    }
    .notice a{
     color:black;
     padding:10px 2px;
     font-family:teachers;
    }
    hr{
       height:1px;
       margin:5px 5px;
        border:none;
        background:black;
    }
    </style>
   
    <style>
      header .material-icons:not(#menu){
          font-size:1.1rem;
      }
    .logo{
        height:120px;
        width:120px;
    }
    #menu{
        font-size:1.0rem;
    }
    </style>
    <style>
        .sectigon3{
            background:linear-gradient(to top right,white,whitesmoke,rgba(144,255,144,0.5));
        }
        .order_loop,.track_button{
             background:linear-gradient(to top right,white,whitesmoke,rgba(144,255,144,0.5));
             box-shadow:0px 4px 8px rgba(0,0,0,0.1);
        }
    </style>
     <style>
        .loader{
            position:fixed;
            top:0;
            bottom:0;
            left:0;
            right:0;
            background:white;
            z-index:8000;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .turn{
            height:50px;
            width:50px;
            border:4px solid silver;
            border-right:4px solid #4caf50;
            border-radius:50%;
            animation:turn 2s linear infinite;
        }
        @keyframes turn{
            0%{
                transform:rotate(0deg);
            }
            100%{
                transform:rotate(360deg);
            }
        }
    </style>
    <style>
        @media(min-width:800px){
            .section3{
                display:grid;
                grid-template-columns:1fr 1fr;
            }
            .section3_desc{
                grid-column:1/-1
            }
        }
    </style>
</head>
<body>
     <section class="loader">
        <div class="turn">
            
        </div>
    </section>
   <header>
      <a href="/"><div class="logo" ></div></a>
      <?php
        if(isset($_COOKIE['cart_id'])){
        $uniqid=$_COOKIE['cart_id'];
        }
         else{
             $uniqid="xxxxxxx";
         } 
        $select_cart="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `uniqid`='$uniqid'";
        $cart_selected=mysqli_query($conn,$select_cart);
        if($cart_selected){
        $extract=mysqli_fetch_assoc($cart_selected);
        $cart_row=$extract['total'];
        }
        if(empty($cart_row)){
            $cart_row=0;
        }
     
        ?>
     <section class="cart_container"><i style="color:navy" class="material-icons">&#128722;</i><div id="mobile_cart_number"><?php echo $cart_row; ?></div></section>
      <div class="notice_div" style="position:relative;margin-left:auto">
      <i id="notifications" class="material-icons">&#128276;</i><strong class="notify"><?php echo $notice_row; ?></strong>
      <section id="notice" class="notice">
          <strong>Notifications</strong>
          <?php
          if($notification_row > 0){
              while($fn=mysqli_fetch_assoc($notifications_selected)){
          echo '<a href="'.$fn['link'].'">'.$fn['message'].'</a>
          <hr>';
          }
          }
          ?>
          <button><a href="notifications" style="color:white">View All</a></button>
      </section>
      </div>
      <i id="menu" class="material-icons">menu</i>
      <nav id="navigate">
        <?php echo $nav; ?>
      </nav>
   </header>
   
   
    <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
        
   
   
   <section class="cart_section">
       <?php
       $select="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `uniqid`='$uniqid'";
       $selected=mysqli_query($conn,$select);
      if($selected){
       $fetch=mysqli_fetch_assoc($selected);
       $total=$fetch['total'];
      }
       if(empty($total)){
           $total=0;
       }
       
       ?>
       <div class="cart_head"><strong>My cart<span>(<span class="total_items"><?php echo $total; ?></span> items)</span></strong><span class="cart_hide">&times</span></div>
       <div class="cart_products">
           <?php
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
              <section class="cart_remove" style="margin-left:auto;user-select:none">&times</section>
              </div>
            ';   
                        }
                    }
          
           ?>
           
          <?php 
          $select="SELECT SUM(product_cost*quantity) AS `total` FROM `cart` WHERE `uniqid`='$uniqid'";
          $selected=mysqli_query($conn,$select);
          if($selected){
          $fetch=mysqli_fetch_assoc($selected);
          $cost=$fetch['total'];
          }
         $cost=$cost+(5 * $cost)/100;
         
          ?>
       </div>
       <div class="cart_actions" style="display:<?php
       if($row==0){
           echo "none";
       }
       
       ?>">
           <section style="width:100%">
         <div class="cart_action_div"><strong style="font-family:poppins">
             Subtotal
         </strong><span style="font-family:poppins"><span style="font-family:poppins"><?php
                    $select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid' ORDER BY `date` DESC LIMIT 50";
                    $selected=mysqli_query($conn,$select);
                    $row=mysqli_num_rows($selected);
                     $carry=mysqli_fetch_assoc($selected);
                    $currency=$carry['currency'];
         
         echo $currency; ?></span><span class="sub_cost"><?php echo $cost; ?></span><input type="hidden" id="hidden_sub_cost" value="<?php echo $cost; ?>"></span></div> 
         </section>
         <div class="cart_checkout_div">
             <button onclick="window.location.href='cart'">
            Checkout
        </button>
        <button onclick="window.location.href='cart'">
            View Cart
        </button> 
        
         
       </div>
       
       </div>
       
   </section>
    <main>
        <section class="section3">
            <strong class="section3_desc">My Orders</strong>
            <?php
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }
             else{
                 $page=1;
             }
             
            $per_page=20;
            $offset=($page-1) * $per_page;
            $select="SELECT * FROM `orders` WHERE `user_id`=$user_id ORDER BY `date` DESC LIMIT $per_page OFFSET $offset";
            $selected=mysqli_query($conn,$select);
            if($selected){
                $row=mysqli_num_rows($selected);
              if($row > 0){
                  while($fetch=mysqli_fetch_assoc($selected)){
                      if($fetch['status'] == "delivered"){
                          $color="#10b981";
                          $disabled='disabled';
                          $opacity=1;
                          $background="silver";
                          $innertext="order received";
                          
                      }
                       else{
                           $color="rgba(11, 134, 172, 0.8)";
                           $disabled="";
                           $opacity=1;
                           $innertext="mark as received";
                           $background="#10b981";
                       }
                      echo '<section class="order_loop">
   <span class="order_id"><strong style="font-family:monospace;font-weight:normal;font-size:0.8rem" class="order_code">'.$fetch['uniqid'].'</strong></span> 
   <span class="items_desc">Date:'.$fetch['date'].'</span>
   <span class="items_desc">Item: '.$fetch['product'].'</span>
   <span class="items_desc">Amount: '.$fetch['currency'].$fetch['cost'].'</span>
   <strong class="order_status" style="font-family:sora;color:'.$color.'">'.$fetch['status'].'</strong>
   <div class="button_div">
   <input type="hidden" class="hidden_id" value="'.$fetch['id'].'">
<button style="width:auto;background:'.$background.';opacity:'.$opacity.'" '.$disabled.' class="action mark_button">'.$innertext.'</button>
<section class="parent">
<div class="child">
    <span>Are you sure you want to mark this order as received,please ensure you have actually received your order first. </span>
<span class="button_span"><button class="order_button">Yes i have</button><button class="no" style="background:red">No i havent</button></span>
</div>
</section>
   </div>
   <div class="button_div">
<button onclick="window.location.href=\'track?oid='.$fetch['id'].'\'" style="background:linear-gradient(to top,green,lightgreen);color:white;box-shadow:0px 0px 8x rgba(0,0,0,0.1)" class="track_button">Track order</button>
<button style="background:linear-gradient(to top,red,lightcoral)">Lodge dispute</button>
   </div>
</section>
';
                  }
              }
              else{
                 echo '<section class="section_oops">
<span class="oops">
    &#9888;
</span>
<strong>
    Oops! No Data Found

</strong>
<span style="font-size:0.8rem;color:rgba(0,0,0,0.7)">
    You havent placed an order yet,click <a href="products">
        here
    </a> to start shopping on <a href="/">Kasoowa</a>
</span>
</section>
';
             }
            
            }
             
            ?>
            <?php
            $select="SELECT * FROM `orders` WHERE `user_id`=$user_id";
            $selected=mysqli_query($conn,$select);
            if($selected){
                $row=mysqli_num_rows($selected);
                if($row == 0){
                    $display="none";
                }
                  else{
                      $display="flex";
                  }
            }
            if($page <= 1){
                $page=1;
                $show_previous="none";
            }
             else{
                 $show_previous="flex";
             }
            $next=$page + 1;
            $previous=$page - 1;
            $ceil=ceil($row/$per_page);
            if($ceil <= $page){
                $show_next="none";
            }
             else{
                 $show_next="flex";
             }
            
            
            ?>
<section style="display:<?php echo $display; ?>" class="paginate_section">
<a style="display:<?php echo $show_previous; ?>" href="?page=<?php echo $previous; ?>" class="material-icons">chevron_left</a><a><?php echo $page; ?></a><a style="display:<?php echo $show_next; ?>" href="?page=<?php echo $next; ?>" class="material-icons">chevron_right</a>
</section>
<!-- section3 closing tag -->
</section>
    </main>
    <footer>
        
    </footer>
</body>
  <script>
      let toggle=document.getElementById("menu");
       let menu=document.getElementById("navigate");
       let device_width=window.innerWidth;
      toggle.addEventListener("click",function(){
          
         
             if (menu.style.width === "0px" || menu.style.width === "") {
            menu.style.width = "300px"; // Open the menu
        } else {
            menu.style.width = "0px"; // Close the menu
        }
          
      })
      let notifications=document.getElementById("notifications");
      let notice=document.getElementById("notice");
      notifications.addEventListener("click",function(event){
          if(notice.style.display=="none"){
          notice.style.display="block";
          }
           else{
                notice.style.display="none";
           }
           event.stopPropagation();
      })
      document.addEventListener("click",function(){
         notice.style.display="none";
      })
      notice.addEventListener("click",function(event){
          event.stopPropagation();
      })
  </script> 
  <script>
      let nav_a=document.querySelectorAll("#navigate a");
      for(let n=0;n < nav_a.length;n++){
          nav_a[n].addEventListener("click",function(){
              nav_a[n].style.background="#4caf50";
          })
      }
  </script>
    <script>
       let cart_container=document.getElementsByClassName("cart_container");
       let cart=document.querySelectorAll(".cart_container .material-icons");
      let cart_section=document.querySelector(".cart_section");
      let cart_hide=document.querySelector(".cart_hide");
      let cart_remove=document.getElementsByClassName("cart_remove");
      let curr_cart_id=document.querySelectorAll(".curr_cart_id");
      let cart_product=document.querySelectorAll(".cart_product");
      let total_items=document.querySelector(".total_items");
      let cart_quantity=document.querySelectorAll(".cart_quantity");
      let cart_cost=document.querySelectorAll(".cart_cost");
      let hidden_cart_cost=document.querySelectorAll(".hidden_cart_cost");
      let sub_cost=document.querySelector(".sub_cost");
      let hidden_sub_cost=document.querySelector("#hidden_sub_cost");
     let cart_actions=document.querySelector(".cart_actions");
     let mobile_cart_number=document.getElementById("mobile_cart_number");
      
      sub_cost.innerText=parseInt(sub_cost.innerText).toLocaleString();
       for(let t=0;t < cart_container.length;t++){
         cart_container[t].addEventListener("click",function(){
             let device_width=window.innerWidth;
             if(device_width > 799){
                 cart_section.style.left="70%";
             }
              else{
            cart_section.style.left="10%" ;
              }
         })
     }
     cart_hide.addEventListener("click",function(){
         cart_section.style.left="100%";
     })
     for(let r=0;r < cart_remove.length;r++){
         cart_cost[r].innerText=parseInt(cart_cost[r].innerText).toLocaleString();
         cart_remove[r].addEventListener("click",function(){
             loading.style.display="flex";
             let remove_form=new FormData();
             remove_form.append("id",curr_cart_id[r].value);
             remove_form.append("remove_cart","cart");
             let xhv=new XMLHttpRequest();
             xhv.open("POST","general.php",true);
             xhv.onreadystatechange=function(){
                 if(xhv.readyState==4 && xhv.status==200){
                      loading.style.display="none";
                    cart_product[r].style.display="none";
                    total_items.innerText=parseInt(total_items.innerText) - parseInt(cart_quantity[r].innerText);
                    
                    let next_cost=parseInt(hidden_sub_cost.value) - (parseInt(hidden_cart_cost[r].value) * parseInt(cart_quantity[r].innerText));
                    next_cost=next_cost - (5 * parseInt(hidden_cart_cost[r].value))/100;
                    hidden_sub_cost.value=next_cost;
                    next_cost=next_cost.toLocaleString();
                    sub_cost.innerText=next_cost;
                    mobile_cart_number.innerText=parseInt(mobile_cart_number.innerText) - parseInt(cart_quantity[r].innerText);
                    if(total_items.innerText<=0){
                         total_items.innerText=0;
                         sub_cost.innerText=0;
                         cart_actions.style.display="none";
                    }
                 }
             }
             
             xhv.send(remove_form);
         })
     }
   </script> 
   <script src="orders.js?v=1.1">
       
   </script>
   <script>
   function turn(){
      let loader=document.querySelector(".loader");
      loader.style.display="none";
  }
       window.onload=function(){
           change_status();
           show_parent();
           turn();
       }
   </script>
    
</html>