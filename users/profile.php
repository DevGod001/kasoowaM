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
    <link rel="manifest" href="app.json">
    <style>
    body{
       font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
       height:100vh;
       display:flex;
       flex-direction:column;
       background:whitesmoke;
    }
    html,body{
        margin:0;
        padding:0;
    }
    main{
        flex:1 0 auto;
    }
    *{
        box-sizing:border-box;
    }
    header{
        position:fixed;
        top:0;
        left:0;
        right:0;
        height:10vh;
        background:white;
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:space-between;
        padding:0 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-bottom:1px solid silver;
        }
    .logo{
        width:100px;
        background-size:cover;
        background-position:center;
        background-image:url('../assets/kasoowa.png');
        height:50px;
    }
    #menu{
        background:#4caf50;
        color:white;
        border-radius:50%;
        padding:5px;
        cursor:pointer;
    }
    .material-icons{
        user-select:none;
    }
    nav{
        min-height:100vh;
        width:0px;
        background:#4caf50;
        position:absolute;
        top:100%;
        bottom:0;
        left:0;
        transition:width 0.5s;
        color:white;
        overflow:hidden;
         background:#2C3E50;
          display:flex;
          z-index:1900;
        flex-direction:column;
    }
    nav a{
        color:white;
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:flex-start;
        padding:10px;
        width:100%;
        gap:5px;
    }
    nav a:hover{
        background:#4caf50;
    }
    #logout{
        margin-top:auto;
        margin-bottom:10vh;
    }
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
    a{
        text-decoration:none;
    }
    @media(min-width:800px){
        
        nav{
            width:300px;
        }
        #menu{
            display:none;
            
        }
    }
     #cart_number,#mobile_cart_number{ 
         background:red;
         border-radius:50%;
         font-family:poppins;
         height:15px;
         width:15px;
         position:absolute;
         right:0;
         top:0;
         color:white;
         font-size:50%;
         display:flex;
         align-items:center;
         justify-content:center;
     }
     .cart_container{
            position:relative;
        }
    </style>
   <style>
        .cart_section{
           position:fixed;
           top:0%; 
           left:100%;
           bottom:0;
           right:0;
           background:whitesmoke;
           border-left:1px solid silver;
           display:flex;
           flex-direction:column;
           max-height:100vh;
           min-height:100vh;
           overflow:hidden;
           z-index:2000;
           transition:left 0.5s;
           min-width:90%;
        }
        .cart_head{
            width:100%;
            padding:10px;
            background:black;
            color:lightgreen; 
            display:flex;
            align-items:center;
            justify-content:space-between;
            
        }
        .cart_head strong{
       font-family:poppins;
        }
        .cart_head strong span{
            font-family:poppins;
            color:red; 
        }
        .cart_hide{
            
            background:white;
            height:30px;
            width:30px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:black;
            border-radius:50%;
            user-select:none;
        }
        .cart_products{
            padding:10px;
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:10px;
            overflow-y:auto;
        }
        .cart_product{
            min-height:100px;
            height:100px;
            width:100%;
            background:white;
            padding:5px;
            box-shadow:0px 4px 8px rgba(0,0,0,0.3);
            border-radius:3px;
            display:flex;
        }
        .cart_image{
            height:100%;
            width:100px;
            background-size:cover;
            background-position:center;
            border-radius:3px;
        }
        .cart_actions{
            width:100%;
            min-height:100px;
            background:white;
            margin-top:auto;
            padding:20px;
            display:flex;
            flex-direction:column;
            align-items:center;
            padding-bottom:100px;
        }
        .cart_action_div{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between; 
            
        }
        .cart_checkout_div{
            display:flex;
            flex-direction:column;
            gap:10px;
            padding:5px;
            background:white;
            width:100%;
            
            
        }
        .cart_checkout_div button{
            height:40px;
            width:100%;
            border:none;
            border-radius:5px;
            background:linear-gradient(to right,green,lightgreen);
            color:white;
            font-weight:bold;
            font-family:teachers;
        }
        .cart_product_details{
            display:flex;
            flex-direction:column;
            align-items:flex-start;
            justify-content:center;
            gap:5px;
            padding:5px;
        }
       .cart_product_details *{
           font-family:teachers;
       } 
       .cart_container *{
           user-select:none;
       }
            @media(min-width:800px){
                .cart_remove,.cart_hide,.cart_checkout_div button{
                    cursor:pointer;
                    
                }
                .cart_section{
                    min-width:30%;
                }
                .cart_container{
                    cursor:pointer;
                }
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
        <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

            .section2{
                width:100vw;
                margin-top:12vh;
                display:grid;
               grid-template-columns:1fr;
                
                height:100vh;
               
            }
            .section2_group{
                padding:10px;
                width:100%;
                display:flex;
                flex-direction:column;
                align-items:center;
                background:white;
               
              background: linear-gradient(to top right, #f5f0ff, #ffffff, #e6e0f8, #f5f0ff);
              background: linear-gradient(to top right, white, whitesmoke, rgba(144,255,144,0.2));
             
            }
            .profile_icon{
                width:100px;
                height:100px;
                border:2px solid #4caf50;
                border-radius:50%;
                background-size:cover;
                background-position:center;
                <?php
                $select="SELECT * FROM `users` WHERE `id`=$user_id";
                $selected=mysqli_query($conn,$select);
                $fetch=mysqli_fetch_assoc($selected);
                
                
                
                ?>
                background-image:url("<?php echo $fetch['profile']; ?>");
            }
            .account_name{
                display:flex;
                align-items:center;
            }
            .profile_image_section{
                width:100%;
                display:flex;
                flex-direction:row;
                gap:10px;
                
               
}
.settings{
    background:white;
    width:100%;
    margin:10px 0;
     border-radius:5px;
                
}
.settings a{
    color:black;
    display:flex;
    align-items:center;
    padding:20px 5px;
    gap:10px;
    
}
.settings a:hover{

    background:#4caf50;
    color:white;
}
.settings a *:not(.material-icons){
    font-family:poppins;
    font-size:0.9rem;
}
.settings .material-icons{
    font-size:0.9rem;
}
.password_div{
    width:100%;
    background:white;
    display:none;
    flex-direction:column;
    align-items:center;
    padding:5px;
   
    margin:10px 0;
}
.password_div_group{
    width:100%;
    display:flex;
    align-items:center;
    border-bottom:0.1px solid silver;
    padding:20px 0px;
}
.password_div_group:not(.material-icons){
    font-family:poppins;
}
.password_form{
    display:flex;
    align-items:center;
    flex-direction:column;
    width:100%;
    gap:10px;
}
.cont{
    width:100%;
    height:40px;
    border:1px solid silver;
    position:relative;
    border-radius:5px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    z-index:2;
   
}
.cont_input{
    height:90%;
    width:95%;
    border:none;
    padding:0 5px;
     border-radius:5px;
     font-family:teachers;
}
.float{
    position:absolute;
    top:25%;
    left:5%;
    pointer-events:none;
    color:#708090;
     font-family:teachers;
     background:white;
     padding:0 5px;
     transition-duration:0.5s;
    
     
}

.cont_input:focus + .float,.cont_input:not(:placeholder-shown) + .float{
    top:-25%;
    color:#4caf50;
}
.none{
    display:none;
}
.flex{
    display:flex;
}
.grid{
    display:grid;
}
a{
    user-select:none;
}
        </style>
        <style>
            @media(min-width:800px){
                .section2{
                    margin-left:350px;
                   
                    width: calc(100% - 350px);
                    grid-template-columns:1.3fr 0.7fr;
                  
                }
                .cont{
  
    height:50px;
    
}

 .password_div_group .material-icons{
     cursor:pointer;
 }
            }
        </style>
        <style>
            .photo_div{
               width:100%; 
               background:white;
               min-height:350px;
               display:none;
            }
            .photo_div form{
                width:100%;
                
            }
            .cover_section{
                background:silver;
                height:150px;
                width:100%;
                position:relative;
              
             
            }
            .photo_preview{
                height:120px;
                width:120px;
                border:2px solid #4caf50;
                border-radius:50%;
                background:#989898;
                display:flex;
                align-items:center;
                justify-content:center;
                font-family:poppins;
                position:absolute;
                background-size: cover;
    background-position: center;
               top: 50%; /* Position it at the bottom */
    left: 50%; /* Center horizontally */
    transform: translateX(-50%);
   
                margin:auto;
                
            }
            .photo_div_group{
    width:100%;
    display:flex;
    align-items:center;
    border-bottom:0.1px solid silver;
    padding:20px 0px;
}
.photo_div_group:not(.material-icons){
    font-family:poppins;
}
.update_submit{
    margin-top:100px;
    
}
#group2{
    display:none;
    background:white;
     border-radius:5px;
}
.recent_div{
    width:100%;
    display:flex;
    align-items:center;
    background:white;
    display:flex;
    flex-direction:column;
    max-height:100vh;
    overflow:auto;
   
}
.recent_div a{
    color:black;
    display:flex;
    align-items:center;
    padding:20px 10px;
    font-family:teachers;
    border-bottom:0.1px solid silver;
   width:100%;
}
.recent_div a:hover{
    background:rgba(144,255,144,0.3);
}
        </style>
        <style>
            @media(min-width:800px){
                .update_submit{
                    height:50px;
                }
                #group2{
    display:flex;
    flex-direction:column;
    
}

            }
        </style>
        <style>
            @media(min-width:800px){
                .update_submit{
                    height:50px;
                }
                #photo_return{
                    cursor:pointer;
                }
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
   
header *{
  
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
        $extract=mysqli_fetch_assoc($cart_selected);
        $cart_row=$extract['total'];
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
      <nav id="navigate" >
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
       $fetch=mysqli_fetch_assoc($selected);
       $total=$fetch['total'];
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
          $fetch=mysqli_fetch_assoc($selected);
          $cost=$fetch['total'];
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
    <?php
                $select="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
                $selected=mysqli_query($conn,$select);
                $fetch=mysqli_fetch_assoc($selected);
                $business_name=$fetch['business_name'];
                if(empty($business_name)){
                    $business_name=$fetch['username'];
                }
                
                
                ?>
    <main>
        <section class="section2">
            <section class="section2_group">
                
                 <section class="profile_image_section">
                <div class="profile_icon"></div>
                <div class="account_name">
                    <span style="font-family:poppins"><?php echo $business_name; ?><br><span style="font-family:teachers;font-size:0.8rem"></span></span>
                </div>
            </section>
            <section class="settings">
                <?php
                if($_COOKIE['account_type']=='seller'){
              echo '<a href="orders"><i class="material-icons">shopping_cart</i><span>My Orders</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="inbox"><i class="material-icons">chat</i><span>Inbox</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="store"><i class="material-icons">store</i><span>My Store</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="support"><i class="material-icons">support_agent</i><span>Chat with Support</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a id="photo_a" style="cursor:pointer"><i class="material-icons">add_a_photo</i><span>Update Store Barner</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
        
             <a id="password_a" style="cursor:pointer"><i class="material-icons">vpn_key</i><span>Update Password</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="transactions"><i class="material-icons">account_balance</i><span>Transaction History</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
             <a href="verified"><i class="material-icons">verified</i><span>Get Verified</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            
             <a href="privacy"><i class="material-icons">lock</i><span>Privacy Policy</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="about"><i class="material-icons">info</i><span>About Us</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>  
            <a href="terms"><i class="material-icons">policy</i><span>Terms of Use</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="faq"><i class="material-icons">help</i><span>FAQs</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="logout"><i class="material-icons">exit_to_app</i><span>Logout</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> ';
                } 
                else{
                    echo '<a href="orders"><i class="material-icons">shopping_cart</i><span>My Orders</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="inbox"><i class="material-icons">chat</i><span>Inbox</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
             <a href="support"><i class="material-icons">support_agent</i><span>Chat with Support</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a id="photo_a" style="cursor:pointer"><i class="material-icons">add_a_photo</i><span>Update profile picture</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
        
             <a id="password_a" style="cursor:pointer"><i class="material-icons">vpn_key</i><span>Update Password</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="transactions"><i class="material-icons">account_balance</i><span>Transaction History</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
             
             <a href="privacy"><i class="material-icons">lock</i><span>Privacy Policy</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="about"><i class="material-icons">info</i><span>About Us</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a>  
            <a href="terms"><i class="material-icons">policy</i><span>Terms of Use</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="faq"><i class="material-icons">help</i><span>FAQs</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> 
            <a href="logout"><i class="material-icons">exit_to_app</i><span>Logout</span><i style="margin-left:auto;color:#708090" class="material-icons">chevron_right</i></a> ';
              
                }
            ?>
            
            </section>
                <div class="password_div">
                    <section class="password_div_group">
                        <i id="password_return" class="material-icons">chevron_left</i>
                        <span>Update your password</span>
                        
                    </section>
                    <section class="password_div_group">
                        
                        <form class="password_form">
                            <i class="password_warning" style="color:red;font-size:0.7rem">
                           
                        </i>
                            <div class="cont">
                            <input required placeholder=" " class="cont_input" type="password">
                            <label class='float'>Enter Current password</label>
                        </div>
                        <div class="cont">
                            <input required placeholder=" " class="cont_input" type="password">
                            <label class='float'>Enter New password</label>
                        </div>
                        <div class="cont">
                            <input required placeholder=" " class="cont_input" type="password">
                            <label class='float'>Re-type New password</label>
                        </div>
                        <label style="font-size:0.8rem;display:flex;align-items:center;width:100%;gap:10px;user-select:none" class='show_password_house'><label for="show" class="show_password">Show password</label><input id="show" style="height:0.8rem" type="checkbox"></label>
                        <button class="change_password" style="background:linear-gradient(to right,green,lightgreen);width:100%" type="submit">Change Password</button>
                        </form>
                        
                        
                    </section>
                </div>
                <div class="photo_div">
                     <section class="photo_div_group">
                        <i id="photo_return" class="material-icons">chevron_left</i>
                        <span>Update your profile photo</span>
                        
                    </section>
                    <form class="photo_form">
                        <input style="display:none" type="file" accept="image/*" id="profile">
                        <section syle="z-index:200" class="cover_section">
                            <label for="profile" class="photo_preview"> 
                                <i class="material-icons">add_a_photo</i>
                            </label>
                        </section>
                        <button class="update_submit">Update Photo</button>
                    </form>
                </div>
            </section>
           <section id="group2" class="section2_group">
                 <div style="width:100%"> 
                <strong style="font-family:poppins" class="desc">Recent notifications</strong>
                </div>
                <div class="recent_div">
                <?php
                $select="SELECT * FROM `notifications` WHERE `status`<>'read' AND `user_id`=$user_id LIMIT 5";
$selected=mysqli_query($conn,$select);
$row=mysqli_num_rows($selected);

                
              
                if($row > 0){
                    while($fetch=mysqli_fetch_assoc($selected)){
                        echo '<a href="'.$fetch['link'].'"><span style="color:#708090" class="material-icons">'.$fetch['message'].'</span>Your order was completed</a>
                   ';
                    }
                }
                  else{
                      echo '<span style="margin:20px 0;font-size:5rem;color:#4caf50" class="material-icons">notifications_off</span>
                 <span style="font-family:teachers">You dont have any notifications</span>
';
                  }
                
                     ?>
                     
                 
                </div>
                
                
            </section>
            
            
            
            <!-- end of section 2 -->
        </section>
    </main>
    <footer>
        
    </footer>
</body>
<script>

    let password_a=document.getElementById("password_a");
    let photo_a=document.getElementById("photo_a");
    let show=document.querySelector("#show");
    let loading=document.getElementById("loading");
   let settings=document.querySelector(".settings");
    let password_form=document.querySelector(".password_form");
    let cont_input=document.querySelectorAll(".password_form .cont_input");
    let section2_group=document.querySelectorAll(".section2_group");
    let change_password=document.querySelector(".change_password");
    let password_warn=document.querySelector(".password_warning");
    let password_div=document.querySelector(".password_div");
    let password_return=document.querySelector("#password_return");
    let photo_preview=document.querySelector(".photo_preview");
    let profile=document.getElementById("profile");
    let photo_div=document.querySelector(".photo_div");
    let photo_return=document.getElementById("photo_return");
    let photo_form=document.querySelector(".photo_form");
    let prof=document.querySelector("#profile");
    let profile_icon=document.querySelector(".profile_icon");
    
    // function to submit photo
    photo_form.addEventListener("submit",function(event){
        if(prof.value==""){
            event.preventDefault();
            return;
        }
        event.preventDefault();
        loading.style.display="flex";
        let p_file=prof.files[0];
        let p_form=new FormData();
        p_form.append("photo",p_file);
        p_form.append("upload",true); 
        let xhf=new XMLHttpRequest();
        xhf.open("POST","profile_process.php",true);
        xhf.onreadystatechange=function(){
            if(xhf.readyState==4 && xhf.status==200){
                loading.style.display="none";
                if(xhf.responseText=="error"){
                    alert(xhf.responseText);
                    return;
                }
                  else{
                      
                      profile_icon.style.backgroundImage="url('" + xhf.responseText + "')";
                      return;
                  }
            }
        }
        xhf.send(p_form);
    })
    
    //function to preview photo
    function preview_photo(){
        profile.addEventListener("change",function(){
            let file=profile.files[0];
            if(file){
                let reader=new FileReader(); 
                reader.onload=function(){
                   photo_preview.style.backgroundImage="url('" + reader.result + "')";
                   photo_preview.innerHTML="";
                }
                reader.readAsDataURL(file)
            }
        })
    }
    //show photo div section
    photo_a.addEventListener("click",function(){
         settings.classList.add("none");
        photo_div.style.display="flex";
        photo_div.style.flexDirection="column";
        
        
    })
    photo_return.addEventListener("click",function(){
        photo_div.style.display="none";
        settings.classList.remove("none");
    })
    // show password div section
    password_a.addEventListener("click",function(){
        settings.classList.add("none");
        password_div.classList.add("flex");
    });
    password_return.addEventListener("click",function(){
        password_div.classList.remove("flex");
        settings.classList.remove("none");
    });
    show.addEventListener("click",function(){
        for(let t=0;t < cont_input.length;t++){
        if(show.checked){
          
             
                  cont_input[t].type="text";
             
                
           
        }  
        else{
            cont_input[t].type="password";
        }
        } 
    })
    // function to update password
    function update_password(){
      password_form.addEventListener("submit",function(event){
          event.preventDefault();
         loading.style.display="flex";
         let password_form=new FormData();
         password_form.append("current",cont_input[0].value);
         password_form.append("new",cont_input[1].value);
         password_form.append("confirm",cont_input[2].value);
         let xhp=new XMLHttpRequest();
         xhp.open("POST","profile_process.php",true);
         xhp.onreadystatechange=function(){
             if(xhp.readyState==4 && xhp.status==200){
                 loading.style.display="none";
                 if(xhp.responseText.includes("success")){
                     password_warn.style.color="#4caf50";
                 }
                  else{
                       password_warn.style.color="red";
                  }
                password_warn.innerText=xhp.responseText;
             }
         }
         xhp.send(password_form);
      })  
    }
    
  update_password();  
  
  preview_photo();
</script>
  <script>
      let toggle=document.getElementById("menu");
       let menu=document.getElementById("navigate");
       let device_width=window.innerWidth;
      toggle.addEventListener("click",function(){
             settings.classList.remove("none");
        photo_div.style.display="none";
        password_div.classList.remove("flex");
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
     function turn(){
      let loader=document.querySelector(".loader");
      loader.style.display="none";
  }
     window.onload=function(){
         turn();
     }
   </script> 
     
   
</html>