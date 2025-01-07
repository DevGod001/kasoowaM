<?php
session_start();
include_once 'connect.php';
include_once 'functions.php';
userlogin();
include_once 'general_process.php';
if($_COOKIE['account_type'] !== "seller"){
    header("Location:login");
    exit;
}
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
        z-index:201;
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
        flex-direction:column;
        z-index:200;
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
            .section2{
                height:100vw;
                width:100%;
            }
        </style>
        <style>
        :root{
            --primary-color:#4caf50;
            --font-size:0.9rem;
            
        }
        html,body{
            margin:0;
            padding:0;
        }
        *{
            box-sizing:border-box;
            outline:none;
        }
        .section2{
            width:100vw;
           background:linear-gradient(to top right,white,whitesmoke,rgba(144,255,144,0.5));
         padding:0px;
         margin-top:10vh;
        
        height:auto;
        }
        .store_group{
            width:100%;
            display:flex;
            align-items:center;
            gap:10px;
            
            padding:10px;
        }
        .store_image{
            height:100px;
            width:100px;
            border:2px solid #4caf50;
            border-radius:50%;
            background-image:url('https://test.kasoowa.com/users/pepper.jpg');
            background-size:cover;
            background-position:center;
           
        }
        .section_group{
          
            width:100%;
            
            display:flex;
            align-items:center;
            flex-direction:column;
            border-bottom:0.1px solid silver;
          
            gap:10px;
        }
        .stats{
            width:100%;
            display: flex;
            font-family:teachers;
            align-items:center;
            justify-content:space-between;
            border-bottom:0.1px solid silver;
            padding:10px;
            
        }
        .stats article{
            display:flex;
            flex-direction:column;
            align-items:center;
            user-select:none;
        }
        .stats article *:not(.nums){
            font-family:teachers;
            color:#708090;
            font-size:0.7rem;
        }
        .address{
            padding:10px;
            display:flex;
            align-items: center;
            justify-content:space-between;
            gap:10px;
            width:100%;
        }
        .address *:not(.material-icons){
            font-family: teachers;
            display:flex;
            align-items:center;
            margin-right:auto;
        }
        .address .material-icons{
            color:var(--primary-color);
            
        }
        .address *{
            user-select:none;
            
        }
        .store_link_house{
            padding:0px;
            border:0.1px solid silver;
            display:flex;
            align-items:center;
            overflow:hidden;
            gap:10px;
            height:40px;
        }
        .store_link_house *{
            padding:10px;
            
        }
        .store_link_house span{
            overflow:hidden;
           white-space:nowrap;
           
           margin-left:5px;
            
        }
        .store_link_house button{
            padding:10px 20px;
            border:none;
            background:linear-gradient(to top right,green,lightgreen);
            color:white;
            height:100%;
            border-radius:0px;
        }
        .highlight{
            background:lightblue;
        }
    * {
  
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* Internet Explorer 10+ */
}

*::-webkit-scrollbar {
  display: none; /* Webkit */
}
.edit_form{
    background:white;
    border-radius:4px;
    width:100%;
    z-index:2;
}
.edit_header{
    border-bottom:0.1px solid silver;
    padding:10px;
    font-family:poppins;
    display:flex;
    align-items:center;
}
.edit_form form{
    padding:10px;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:10px;
}
.cont{
    border:1px solid silver;
    width:100%;
    height:40px;
    border-radius:4px;
    position:relative;
}
.cont_input{
    width:98%;
    height:95%;
    border:none;
    border-radius:5px;
    font-family:teachers;
    padding:0 10px;
}
.float{
    position:absolute;
    top:25%;
    left:5%;
    font-family:teachers;
    transition-duration:0.5s;
    background:white;
    padding:0 5px;
    pointer-events:none;
    
}
.cont_input:focus + .float,.cont_input:not(:placeholder-shown) + .float{
    top:-25%;
    font-size:0.7rem;
    color:#4caf50;
}
.edit_submit{
    margin-right:auto;
    width:auto;
    padding:10px 25px;
    border-radius:0px;
    display:flex;
    align-items:center;
    background:linear-gradient(to right,green,lightgreen);
    
}
.parent{
    position:fixed;
    top:0;
    bottom:0;
    left:0;
    right:0;
    background:rgba(0,0,0,0.5);
    z-index:500;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}
.child{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    background:white;
    width:95%;
    border-radius:4px;
    box-shadow:0px 4px 8px rgba(0,0,0,0.5);
    padding:10px;
    margin:auto;
    
}
.add_form{
    display:flex;
    flex-direction:column;
    gap:10px;
    padding:10px 0;
}
    </style>
    <style>
        @media(min-width:800px){
            .section2{
                margin-left:350px;
                width:calc(100vw - 350px);
                display:grid;
                grid-template-columns:1.3fr 0.7fr;
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
        <?php
        $select="SELECT * FROM `users` WHERE `id`=$user_id";
        $selected=mysqli_query($conn,$select);
        if($selected){
            $fetch=mysqli_fetch_assoc($selected);
            
        }
        
        
        ?>
         <section class="section2">
        <section class="section_group">
        <div class="store_group" style="flex-direction:column;">
            <div class="store_image" style="background-image:url('<?php echo $fetch['profile']; ?>')">
                
            </div>
            <?php
            $get="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
            $gotten=mysqli_query($conn,$get);
            if($gotten){
                
                $carry=mysqli_fetch_assoc($gotten);
            }
            
            ?>
            <span style="font-family:poppins">
                <?php echo $carry['business_name']; ?>
            </span>
        </div>
       
        <div class="stats">
            <article>
                <span class="nums" style="font-family:poppins"> <?php
        $select_stat="SELECT * FROM `products` WHERE `user_id`=$user_id";
        $stat_selected=mysqli_query($conn,$select_stat);
        if($stat_selected){
            $stat_row=mysqli_num_rows($stat_selected);
            echo $stat_row;
        }
        
        
        ?></span>
                <span>products added</span>
            </article>
               <article>
                <span class="nums" style="font-family:poppins"> <?php
        $select_stat="SELECT * FROM `products` WHERE `user_id`=$user_id AND `status`='active'";
        $stat_selected=mysqli_query($conn,$select_stat);
        if($stat_selected){
            $stat_row=mysqli_num_rows($stat_selected);
            echo $stat_row;
        }
        
        
        ?></span>
                <span>in stock</span>
            </article>
               <article>
                <span class="nums" style="font-family:poppins"> <?php
        $select_stat="SELECT * FROM `products` WHERE `user_id`=$user_id AND `status` <> 'active'";
        $stat_selected=mysqli_query($conn,$select_stat);
        if($stat_selected){
            $stat_row=mysqli_num_rows($stat_selected);
            echo $stat_row;
        }
        
        
        ?></span>
                <span>out of stock</span>
            </article>
        </div>
        <div class="address" style="border-bottom:0.1px solid silver">
            
            <span><i style="color:#708090" class="material-icons">location_on</i><span class="address_span"><?php 
            $address=$carry['address'];
            echo $address;
            
            ?></span></span></span><i class="material-icons action">edit</i>
            <section style="display:none" class="parent">
                  <div class="child">
            <strong style='font-family:poppins'>Update Address </strong>
            <form class="add_form">
                <div class="cont">
                    <input required type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter your street address</label>
                </div>
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Apartment, suite etc (optional)</label>  
                </div>
                <div class="cont">
                    <input required type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter your City</label>
                </div>
                <?php 
                     $select_users="SELECT * FROM `users` WHERE `id`=$user_id";
                    $users_selected=mysqli_query($conn,$select_users);
                    $fetch_users=mysqli_fetch_assoc($users_selected);
                    $country=$fetch['country'];
                    
                    
                    switch($country){
                        case "nigeria":
                        $zip_code= '';
                        break;
                        default:
                            $zip_code=' <div class="cont">
                    <input required type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter zip code</label>
                    
                </div>';
                break;
                       }
                    echo $zip_code;
                    ?>
               
                <div class="cont">
                    <?php 
                    $select_users="SELECT * FROM `users` WHERE `id`=$user_id";
                    $users_selected=mysqli_query($conn,$select_users);
                    $fetch_users=mysqli_fetch_assoc($users_selected);
                    $country=$fetch['country'];
                   
                    switch($country){ 
                        case "nigeria":
                        $label="Select State";    
                    $states='<option value="" selected disabled>--- Click to select state ---</option>
                <option value="Abia">Abia</option>
                <option value="Abuja">Abuja</option>
<option value="Adamawa">Adamawa</option>
<option value="Akwa Ibom">Akwa Ibom</option>
<option value="Anambra">Anambra</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Enugu">Enugu</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nasarawa">Nasarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun">Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau">Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba">Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>';
                 break;   
                    case "united_states":
        $label="Select State";
        $states='<option value="" selected disabled>--- Click to select state ---</option>
<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>';
break; 
        case "ghana":
          $label="Select Region";
          $states='<option selected disabled>--- Click to select region ---</option>
<option value="Ahafo">Ahafo</option>
<option value="Ashanti">Ashanti</option>
<option value="Bono">Bono</option>
<option value="Bono East">Bono East</option>
<option value="Central">Central</option>
<option value="Eastern">Eastern</option>
<option value="Greater Accra">Greater Accra</option>
<option value="Northern">Northern</option>
<option value="Oti">Oti</option>
<option value="Savannah">Savannah</option>
<option value="Western">Western</option>
<option value="Western North">Western North</option>
<option value="Upper East">Upper East</option>
<option value="Upper West">Upper West</option>
<option value="Volta">Volta</option>
<option value="North East">North East</option>';
           break;
            case "cameroon":
         $label="Select Region";
         $states='<option selected disabled>--- Click to select region ---</option>
<option value="Adamawa">Adamawa</option>
<option value="Central">Central</option>
<option value="East">East</option>
<option value="Far North">Far North</option>
<option value="Littoral">Littoral</option>
<option value="North">North</option>
<option value="North West">North West</option>
<option value="South">South</option>
<option value="South West">South West</option>
<option value="West">West</option>';
           break;
           case "canada":
           $label="Select Province/territory";
           $states='<option selected disabled>--- Click to select province/territory ---</option>
<option value="Alberta">Alberta</option>
<option value="British Columbia">British Columbia</option>
<option value="Manitoba">Manitoba</option>
<option value="New Brunswick">New Brunswick</option>
<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
<option value="Nova Scotia">Nova Scotia</option>
<option value="Ontario">Ontario</option>
<option value="Prince Edward Island">Prince Edward Island</option>
<option value="Quebec">Quebec</option>
<option value="Saskatchewan">Saskatchewan</option>
<option value="Northwest Territories">Northwest Territories</option>
<option value="Nunavut">Nunavut</option>
<option value="Yukon">Yukon</option>';
            break;
            case "united_kingdom":
           $label="Select Country";
          $states='<option selected disabled>--- Click to select country ---</option>
<option value="England">England</option>
<option value="Scotland">Scotland</option>
<option value="Wales">Wales</option>
<option value="Northern Ireland">Northern Ireland</option>';
        break;
                    } 
                    ?>
                    <select required class="cont_input"> 
                       <?php echo $states; ?>
                    </select>
                    <label class="float"><?php echo $label; ?></label>
                    
                </div>
             <button style="font-weight:normal;font-family:poppins" class="edit_submit" type="submit">
                   Update Address <i class="material-icons" style="color:white;">chevron_right</i>
                </button>
            </form>
        </div>
    
            </section>
        </div>
        <section class="section_group">
             <span style="font-family:poppins;font-size:0.8rem">My store link:</span>
            <div class="store_group">
               
                <section class="store_link_house" style="margin:auto">
                    <span style="font-family:poppins;font-size:0.9rem"><?php echo $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/users/stores?sid=".$user_id; ?></span>
                    <button style="font-weight:normal;font-family:poppins">copy</button>
                </section>
            </div>
        </section>
        <section class="edit_form">
            <div class="edit_header"><i class="material-icons">chevron_left</i><span>Edit Store Details</span></div>
            <form onsubmit="load()" action="my_store_process.php" method="post">
                <div class="cont">
                    <input name="name" required value="<?php echo $carry['business_name']; ?>" class="cont_input" type="text" placeholder=" ">
                    <label class="float">Update store name</label>
                </div>
                <div class="cont">
                    <input name="minimum_order" value="<?php echo $carry['minimum_order']; ?>" class="cont_input" type="text" placeholder=" ">
                    <?php
                    $select_users="SELECT * FROM `users` WHERE `id`=$user_id";
                    $users_selected=mysqli_query($conn,$select_users);
                    $users_fetch=mysqli_fetch_assoc($users_selected);
                    ?>
                    <label class="float">Update store minimum order in <?php echo $users_fetch['currency']; ?></label>
                </div>
                
                <div class="cont">
                    <input name="mobile" value="<?php echo $carry['mobile']; ?>" class="cont_input" type="text" placeholder=" ">
                    <label class="float">Update store contact number</label>
                </div>
                <div class="cont">
                    <input name="mail" value="<?php echo $carry['mail']; ?>" class="cont_input" type="text" placeholder=" ">
                    <label class="float">Update store contact mail</label>
                </div>
                
                <button style="font-weight:normal;font-family:poppins" class="edit_submit" type="submit">
                    Save Changes <i class="material-icons">chevron_right</i>
                </button>
            </form>
                
            </div>
            
        </section>
        </section>
        <!-- GROUP 2 -->
        <section class="section_group">
            
        </section>
        
        
        
    </section>
    </main>
    <footer>
        
    </footer>
</body>
<script src="my_store.js?v=1.1">
    
</script>
<script>
function turn(){
      let loader=document.querySelector(".loader");
      loader.style.display="none";
  }
    window.onload=function(){
        turn();
        toggle_parent();
        update_address();
    }
</script>
   
</html>