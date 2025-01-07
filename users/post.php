<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
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

$top=7;
$best=30;
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        z-index:2000;
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
    </style>
    <style>
         main{
        width:100vw;
        display:flex;
        flex-direction :column;
        align-items:center;
    }
    .section1{
        width:100%;
        padding:0px 15px;
        
        margin-top:0vh;
    }
      
      .custom_select{
            width:100%;
            border:1px solid silver;
            height:40px;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:space-between;
            border-radius:5px;
           padding:0px 5px;
           position: relative;
           
           
        }
        .dropdown{
            background:whitesmoke;
            position:fixed;
            left:0;
            right:0;
            bottom:0;
           top:0;
            border:1px solid silver;
           display:none;
           flex-direction:column;
           align-items:center;
           justify-content:flex-start;
          z-index:2300;
           border-left:1px solid #4caf50;
        }
        *{
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }
        main{
            padding:5% 0%;
            flex:1 0 auto;
            
        }
        
    }
    main{
        width:1000px;
        background:white;
           display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:flex_start;
        margin:20px;
            border-radius:10px;
            padding:0%;
    }
    
   .dropdown{
            background:whitesmoke;
            position: absolute;
            left:0;
            right:0;
            bottom:0;
           top:100%;
            border:1px solid silver;
           display:none;
           flex-direction:column;
           align-items:center;
           justify-content:flex-start;
          z-index:1000;
           border-left:1px solid #4caf50;
        }
         .description{
            
         
          border-radius:5px;
            margin-top:2%;
            
        }
       .custom_select{
            
            height:50px;
          
           
        } 
      .options,.subs{
            width:100%;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:flex-start;
            height:50px;
            gap:20px;
            padding:2%;
            border:1px solid silver;
            cursor:pointer;
             background:white;
        }
        .icon{
            max-height:40px;
            border-radius:50%;
        }
        .icon{
            height:40px;
            width:40px;
            background-size:cover;
            background-position:center;
        }
        .subs .material-icons,.options .material-icons{
           margin-left:auto;
        }
        .description{
           margin-top:12vh;
           
            background:#4caf50;
            color:white;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            width:90%;
            font-family:poppins;
                    }
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
        
        #product_photos{
            display:none;
        }
        .products_photos_label{
            height:100px;
            width:100px;
            border:none;
            display:flex;
            align-items:center;
            justify-content:center;
            background:rgba(144,238,144,0.6);
            border-radius:5px;
            color:green;
        }
        .files_section{
            width:100%;
            margin-top:0px;
            display:grid;
            grid-template-columns:1fr 1fr 1fr;
            gap:5px;
        }
        .guide{
            font-size:0.7rem;
            color:#708090;
            width:100%;
        }
        .photos{
            height:100px;
            width:100px;
            border:1px solid silver;
            background-size:cover;
            background-position:center;
        }
        .shake{
            animation:shake 0.3s forwards;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }
        
        
        @media only screen and (min-width: 800px) {
            
   .section1{
        width:600px;
        max-width:600px;
        margin-left:350px;
        
   }
    .description{
           
            height:10vh;
           
            background:#4caf50;
            color:white;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            width:600px;
            margin-left:350px;
                    }
                   .files_section{
            width:100%;
            margin-top:20px;
            display:grid;
            grid-template-columns:1fr 1fr 1fr 1fr 1fr;
            gap:5px;
        } 
        .guide{
            font-size:0.8rem;
            
        }
}
@media only screen and (max-width:799px){
    .description{
        font-size:0.7rem;
    }
}

    </style>
   <style>
       .input-container {
            position: relative;
            margin:10px 0;
            display: inline-block;
           width:100%;
          border: 1px solid #ccc;
          border-radius:5px;
          height:50px;
         
          background:white;
        }
        .input-container:hover{
            border:1px solid #4caf50;
        }
        .input-field {
            padding: 10px;
            border: 1px solid #ccc;
          border:none;
            border-radius: 5px;
            width: 100%;
            height:100%;
            outline: none;
            font-size: 16px;
            z-index:11;
        }
        .label {
            position: absolute;
            left: 12px;
            top: 15px;
            background: white;
            padding: 0 5px;
            color: #aaa;
            transition: 0.2s ease all;
            pointer-events: none;
            z-index:1;
        }
        .input-field:focus + .label,
        .input-field:not(:placeholder-shown) + .label {
            top: -10px;
            font-size: 12px;
            color: #4caf50;
            
        }
        #currency{
            display:none;
        }
        .promotion{
            width:100%;
            background:white;
            padding:10px 5px;
        }
        
   </style>
   <style>
        .notify_parent{
            position:fixed;
            top:0;
            bottom:0;
            right:0;
            left:0;
            background:rgba(0,0,0,0.5);
            display:none;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            z-index:2000;
            transition:opacity 0.5s;
            
        }
        .notify_child{
            width:85%;
           padding:30px 5%;
           background:white;
           border-radius:5px;
            
        }
        .heading{
            color:#4caf50;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .notify_details{
        display:block;
            margin-top:20px;
        }
        .notify_buttons{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-top:20px;
        }
        .notify_buttons button{
            background:#4caf50;
            color:white;
            border:none;
            width:120px;
            height:50px;
            padding:10px;
            border-radius:5px;
            cursor:pointer;
        }
        .units{
            width:100%;
            height:50px;
            border:1px solid silver;
            margin:5px 0px;
            border-radius:5px;
            overflow:hidden;
            
            flex-direction:row;
            align-items:center;
            display:none;
        }
        .units_house{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .remove{
            font-weight:bolder;
            cursor:pointer;
            user-select:none;
            padding:2px;
            font-family:poppins;
            height:30px;
            width:30px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
        }
        .flex{
            display:flex;
        }
        .units select,.units input{
            width:100%;
            height:100%;
            border:none;
            padding:0px 5px;
        }
        #measurement,.measurements{
            width:60%;
        }
        #mass-units,.mass-units{
            width:40%;
            background:rgba(144,238,144,0.3)
        }
        .units:nth-of-type(2){
            border-radius:100px;
        }
        #add_more{
            width:auto;
            margin-left:auto;
            padding-left:10px;
             padding-right:10px;
             border-radius:100px;
             display:none;
             align-items:center; 
             cursor:pointer;
        
        }
        #add_guide{
            display:none;
        }
        @media(min-width:800px){
            .notify_child{
            width:500px;
            max-width:500px;
           padding:30px 5%;
           background:white;
           border-radius:5px;
            
        }
        
        }
        @media(max-width:799px){
            .measurement::placeholder{
            font-size:0.6rem;
        }
        
        }
    </style>
    <style>
        .selects{
            height:50px;
            width:100%;
            border:1px solid silver;
            border-radius:5px;
            background:white;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0px 10px;
            position:relative;
            margin:10px 0;
        }
        .selects_options{
            background:white;
            height:100px;
            flex-direction:column;
            position:absolute;
            top:100%;
            left:0;
            right:0;
            border:1px solid silver;
            z-index:1800;
            display:none;
        }
         .category_options{
            width:100%;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:flex-start;
            height:50px;
            gap:20px;
            padding:2%;
            border:1px solid silver;
            cursor:pointer;
             background:white;
             
        }
        .category_options .material-icons{
            margin-left:auto;
        }
        .selects .material-icons{
            margin-left:auto;
           
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
    .drop-down{  
    z-index:1000;
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
      <nav id="navigate">
        <?php echo $nav; ?>
      </nav>
   </header> 
    <main>
       <div class="description"><h2>Sell on Kasoowa</h2></div>
    <main>
       
    <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
                         
    <section class="section1">
        <i class="warn" style="color:red;font-size:0.7rem"><?php
        if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        }
        ?></i>
        <form id="form" action="post_process.php" method="post" enctype="multipart/form-data">
            <input type ="hidden" name="category" id="category">
            <!-- Custom select start-->
         <input type ="hidden" name="category_id" id="category_id">
         <input type ="hidden" name="subcategory_id" id="subcategory_id">
        <div class="selects">
            <span class="selects_heading">Select category</span><section class="selects_options">
               <?php
                    $select="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
                    $selected=mysqli_query($conn,$select);
                    while($fetch=mysqli_fetch_assoc($selected)){
                   echo  '<label data-key="categories" class="category_options"><div class="icon" style="background-image:url(&quot;'.$fetch['icon'].'&quot;)"></div><input type ="hidden" value="'.$fetch['id'].'" class="hidden_cat_id"><span class="category_name">'.$fetch['name'].'</span><i class="material-icons">chevron_right</i></label></label>';
                    }
                         ?>  
            </section><i  class="material-icons">arrow_drop_down</i>
            
        </div>
         <div class="selects" style="display:none">
            <span class="selects_heading">Select subcategory</span><section class="selects_options" style="z-index:1700">
               
            </section><i  class="material-icons">arrow_drop_down</i>
            
        </div>
        
        
        
        
        
        <!-- Custom select end -->
            <div class="custom_select" style="display:none">
                <span id="select_heading">select category </span>
                <i class="material-icons">arrow_drop_down</i>
                <section class="dropdown" id="dropdown">
                    <?php
                    $select="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
                    $selected=mysqli_query($conn,$select);
                    while($fetch=mysqli_fetch_assoc($selected)){
                   echo  '<label class="options"><div class="icon" style="background-image:url(&quot;'.$fetch['icon'].'&quot;)"></div><input type ="hidden" value="'.$fetch['id'].'" data-key="category_id">'.$fetch['name'].'<i class="material-icons">chevron_right</i></label></label>';
                    }
                         ?>
                         <input name="category" type="hidden" id="selected_category" >
                         <input name="subgcategory" type="hidden" id="selected_subcategory">
                </section>
                
            </div>
            
            <section class="units">
                
            </section>
            <span id="add_guide" class="guide">Add each available size in stock by clicking the button below. Only add sizes you have ready to sell.</span>
            <div class="units_house"><section style="border-radius:100px" class="units">
               <select required name="mass_unit[]" id="mass-units">
                   <option value="">Select mass unit</option>
    <option value="kg">Kilogram (kg)</option>
    <option value="g">Gram (g)</option>
    <option value="mg">Milligram (mg)</option>
    <option value="µg">Microgram (µg)</option>
    <option value="t">Metric Ton (t)</option>
    <option value="lb">Pound (lb)</option>
    <option value="oz">Ounce (oz)</option>
    <option value="st">Stone (st)</option>
    <option value="ct">Carat (ct)</option>
    <option value="tonne">Tonne (tonne)</option>
</select><input step="0.000000000000001" required id="measurement" name="measurement[]" type="number" placeholder="">

            </section>
            
            </div>
            <button type="button" id="add_more"><i style=" font-size:1.0rem" class="material-icons">add</i></label>Add more sizes</button>
            <span class="guide" style='margin-top:10px'>Add at least one photo</span>
            <section id="files_section" class="files_section">
            <input name="uploads[]" required type="file" id="product_photos" accept="image/*" multiple>
            
            
            <label for="product_photos" class="products_photos_label"><i class="material-icons">add</i></label>
            
            
            
             </section> 
            <span class="guide"><strong>Note:</strong>First picture is the title picture<br>Pictures must not exceed 2MB</span>
            <div style="margin-bottom:0" class="input-container" >
    <input id="title" name="title" type="text" class="input-field" placeholder=" " required>
    <label class="label">Enter Product Title</label>
    
</div>
<span class="guide">Write a clear and brief title for your product(s)</span>
 <div style="height:150px;margin-bottom:0" id="text_cont" class="input-container" >
    <textarea name="description" id="text" style="height:90%" class="input-field" placeholder=" "></textarea>
    <label class="label">Enter Product description</label>
    
</div>
<span style="display:flex;gap:10px" class="guide">Please provide a detailed and accurate description of the item, including condition(fresh, frozen etc), and any other special notes.Intergrity is essential to build trust with your buyers.<span id='text_guide'><span id="count">0</span><span>/<span id="total">850</span></span></span></span>
      <div id="stock_cont" style="margin-bottom:0;display:none" class="input-container" >
          
    <input name="in_stock"   type="number" class="input-field" placeholder=" " required>
    <label id="stock_label" class="label">Enter quantity in stock</label>
    
</div>  
<span id="stock_guide" style="display:none" class="guide"><strong>Note:</strong>Only add the quantity <span class="stock_guide"></span> of <span class="stock_guide"></span> currently available in stock. Adding more than the available stock violates our  <a target="_blank" style="color:#4caf50;text-decoration:none" href="terms">terms and conditions.</a></span>
      <div   style="margin-bottom:0" class="input-container" >
          
    <input name="price[]" id="price"   type="number" class="input-field" placeholder=" " required>
    <label class="label" id="main_label">price( <?php
         $select_cur="SELECT * FROM `users` WHERE `id`='$user_id'";
         $cur_selected=mysqli_query($conn,$select_cur);
         $fetch_cur=mysqli_fetch_assoc($cur_selected);
         echo $fetch_cur['currency'];
         
         
         ?>)</label>
    
</div>  
         <span class="guide" ><span id="spans"></span> 
         <?php
         $select_cur="SELECT * FROM `users` WHERE `id`='$user_id'";
         $cur_selected=mysqli_query($conn,$select_cur);
         $fetch_cur=mysqli_fetch_assoc($cur_selected);
        
         ?>
         </span>
         <?php
         $currency=$fetch_cur['currency'];
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
         ?>
        <section class="promotion" style="display:flex;flex-direction:column;gap:10px">
            <span style="color:black" class="guide">Choose a promotion type for your product</span>
            <label class="labels" for="free" style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;width:100%;border:1px solid silver;padding:5px;border-radius:5px"><span>No promotion yet</span><span>free<input type="hidden" name="validity" value="0"><input required value="0" id="free" type="radio" name="featured"></span></label>
       <label class="labels" for="3000" style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;width:100%;border:1px solid silver;padding:5px;border-radius:5px"><span>Top deal(<?php echo $top; ?> days)<input type="hidden" name="validity" value="<?php  echo $top; ?>"></span><span><input type="hidden" class="currency_from" value="<?php echo "NGN"; ?>"><input type="hidden" class="currency_to" value="<?php echo $promotion_currency; ?>"><input type="hidden" class="promo_amount" value="<?php echo 3000; ?>"><?php echo $promotion_currency; ?> <span class="show_amount"></span><input class="radios"  id="3000" type="radio" name="featured"></span></label>
     <label class="labels" for="10000" style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;width:100%;border:1px solid silver;padding:5px;border-radius:5px"><span>Best deal(<?php echo $best; ?> days)<input type="hidden" name="validity" value="<?php  echo $best; ?>"></span><span><input type="hidden" class="currency_from" value="<?php echo "NGN"; ?>"><input type="hidden" class="currency_to" value="<?php echo $promotion_currency; ?>"><input type="hidden" class="promo_amount" value="<?php echo 10000; ?>"><?php echo $promotion_currency; ?> <span class="show_amount"></span><input class="radios" id="10000" type="radio" name="featured"></span></label>
     <span class="guide">Promote your product: Enhance your visibility and achieve sales growth 10x greater than your competitors.</span>
     <input type="hidden" name="duration" id="duration">
     </section>
        <button name="action" value="neutral" id="submit" style="width:100%" type="submit">Add Product</button>
        <section class="notify_parent">
        <div class="notify_child">
            <span class="heading">
                
            
            <i class="material-icons">
                notifications
            </i>
            <strong>
                System Notification 
            </strong>
            </span>
            <span class="notify_details">
                Your account balance is not sufficient to promote this product.
<br>
Would you like to proceed with a deposit to enhance your visibility and sales?
            </span>
            <span class="notify_buttons">
                <button name="action" type="submit" value="pending">Make A Deposit </button>
                <button type="submit" name="action" value="false">
                    Continue for free
                </button>
            </span>
        </div>
    </section>
        </form>
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
    </main>
    <footer>
        
    </footer>
</body>
<script>
        let notify_parent=document.getElementsByClassName("notify_parent");
        let notify_child=document.getElementsByClassName("notify_child");
        for(let y=0;y < notify_parent.length;y++){
            notify_parent[y].addEventListener("click",function(){
                notify_parent[y].style.display="none";
            })
            notify_child[y].addEventListener("click",function(){
                event.stopPropagation();
            })
        }
    </script>
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
  let add_more=document.getElementById("add_more");
  let add_guide=document.getElementById("add_guide");
        let price=document.getElementById("price");
         let spans=document.getElementById("spans");
        let custom_select=document.getElementsByClassName("custom_select");
        let units=document.getElementsByClassName("units");
      let loading=document.getElementById("loading");
      let options=document.getElementsByClassName("options");
      let s_category=document.getElementById("selected_category");
      let dropdown=document.getElementsByClassName("dropdown");
      let drop_down=document.getElementById("dropdown");
      let category=document.getElementById("category")
      let category_id=document.getElementsByClassName("hidden_cat_id");
      let select_heading=document.getElementById("select_heading");
      let selected_subcategory=document.getElementById("selected_subcategory");
      let sale_form = document.getElementById("form");
       let measurement= document.getElementById("measurement");
  let warn=document.getElementsByClassName("warn");
  let stock_guide=document.getElementsByClassName("stock_guide");
  let stock_span=document.getElementById("stock_guide");
  let stock_cont=document.getElementById("stock_cont");
  let title=document.getElementById("title");
  let submit_buttons=document.querySelectorAll("button[type='submit']");
    
    </script>
    
   <script>
        let product_photos=document.getElementById("product_photos");
        let files_section=document.getElementById("files_section");
        product_photos.addEventListener("change",function(){
           
            while(files_section.children.length > 2){
                files_section.removeChild( files_section.lastChild);
            }
        for(let p=0;p < product_photos.files.length;p++){
            let file=product_photos.files[p];
          if(file){
              warn[0].innerText="";
              let read=new FileReader();
              read.onload=function(){
                  let div=document.createElement("div");
                  div.className="photos";
                 div.style.backgroundImage="url('" + read.result +"')";
                 files_section.appendChild(div);
                 }
              read.readAsDataURL(file);
        }
    }
});

let counting=document.getElementById("count");
let tot=document.getElementById("total");
let test=document.getElementById("text");
let test_cont=document.getElementById("text_cont");
let text_guide=document.getElementById("text_guide");
let submit_product=document.getElementById("submit");
test.addEventListener("input",function(){
    counting.innerText=test.value.length;
    if(test.value.length > tot.innerText){
        test_cont.style.borderColor="red";
        text_guide.style.color="red";
        text_guide.classList.add("shake");
        submit_product.disabled=true;
        submit_product.style.background="#a4d3a2";
    }
    else{
        test_cont.style.borderColor="#4caf50";
         text_guide.style.color="";
          text_guide.classList.remove("shake");
          submit_product.disabled=false;
          submit_product.style.background="";
    }
})
    </script>
    
    <script>
    // function to get stock label
    function get_stock_label(){
        title.addEventListener("input",function(){
            stock_guide[1].innerText=title.value;
            if(title.value==""){
                stock_span.style.display="none";
                stock_cont.style.display="none";
            }
             else{
                 stock_span.style.display="";
                
                stock_cont.style.display="";
             }
        })
    }
    get_stock_label();
</script>

    
    <script>
   
        let currency_from=document.getElementsByClassName("currency_from");
         let currency_to=document.getElementsByClassName("currency_to");
         let promo_amount=document.getElementsByClassName("promo_amount");
         let show_amount=document.getElementsByClassName("show_amount");
         let labels=document.getElementsByClassName("labels");
         let radios=document.querySelectorAll(".labels input[type=radio]");
         let selection=document.getElementsByClassName("radios");
         
         for(let l=0;l < labels.length;l++){
             radios[l].addEventListener("change",function(){
                for (let j = 0; j < labels.length; j++) {
            labels[j].style.borderColor = "silver";
        }
                 if(radios[l].checked==true){
                     labels[l].style.borderColor="#4caf50";
                 }
                 else{
                     labels[l].style.borderColor="";
                 }
             })
         }
         for(let m=1;m < radios.length;m++){
             radios[m].addEventListener("change",function(){
                 if(radios[m].checked){
                    
                     let xhm=new XMLHttpRequest();
                     xhm.open("GET","post_process.php?cost=" + encodeURIComponent(radios[m].value),true);
                     xhm.onreadystatechange=function(){
                         if(xhm.status==200 && xhm.readyState==4){
                             
                         if(xhm.responseText.includes("insufficient")){
                         notify_parent[0].style.display="flex";
                           
                           
                         }
                         
                         }
                     }
                     xhm.send();
                
                 }
             })
         }
         function add_duration(){
             let duration=document.getElementById("duration");
             let validity=document.querySelectorAll("input[name=validity]");
           for(let v=0;v < radios.length;v++){
               radios[v].addEventListener("change",function(){
                   if(radios[v].checked){
                      duration.value=validity[v].value;
                     
                   }
               })
           }
         }
         add_duration();
    </script>
    
    
    <script>
        let currency=document.getElementById("currency");
        
        price.addEventListener("click",function(){
            currency.style.display="flex";
        })
    </script>
    <script src="functions.js"></script>
    
 <script>
    //variables
    let selects=document.getElementsByClassName("selects");
    let selects_options=document.getElementsByClassName("selects_options");
    let selects_heading=document.getElementsByClassName("selects_heading");
    let categories_label=document.querySelectorAll("label[data-key='categories']");
    let category_name=document.getElementsByClassName("category_name");
     let hidden_category_id=document.querySelectorAll("input[data-key='category_id']");
      let selected_category_id=document.getElementById("category_id");
      let selected_subcategory_id=document.getElementById("subcategory_id");
      let mass_unit=document.getElementById('mass-units');
      for (let iv = 0; iv < selects_options.length; iv++) {
        selects_options[iv].style.display = "none";
    }
      //function to show categories
      function show_categories(){
        for(let g=0;g < selects.length;g++){
            selects[g].addEventListener("click",function(){
               selects[g].style.borderColor="silver";
                if(selects_options[g].style.display=="none"){
                selects_options[g].style.display="flex";
                }
                else{
                    selects_options[g].style.display="none";
                }
            })
            
        } 
        for(let h=0;h < category_name.length;h++){
        categories_label[h].addEventListener("click",function(){
            loading.style.display="flex";
            selects_heading[1].innerText="Select subcategory";
           selected_category_id.value=hidden_category_id[h].value;
             selects_heading[0].innerText=category_name[h].innerText;
             selected_subcategory_id.value="";
             let sub_form=new FormData();
             sub_form.append("category",selected_category_id.value);
             let xhh=new XMLHttpRequest();
             xhh.open("POST","categories.php",true);
             xhh.onreadystatechange=function(){
                 if(xhh.status==200 && xhh.readyState==4){
                      loading.style.display="none";
                      selects[1].style.display="flex";
                      selects_options[1].innerHTML=xhh.responseText;
                     if(selects_options[1].querySelectorAll(".subs")){
                         let subs_data=document.querySelectorAll(".subs");
                          let subs_name=document.querySelectorAll(".sub_name");
                          let subs_id=document.querySelectorAll(".hidden_subcat_id");
                         for(let j=0;j < subs_data.length;j++){
                           
                            subs_data[j].addEventListener("click",function(){
                                selects_heading[1].innerText=subs_name[j].innerText;
                               selected_subcategory_id.value=subs_id[j].value;
                               units[0].style.display="flex";
                               units[0].innerText="Fetching units,please wait....";
                               let xhu=new XMLHttpRequest();
                      
                      xhu.open("GET","post_process.php?unit=true&sub_id=" + encodeURIComponent(selected_subcategory_id.value),true);
                        xhu.onreadystatechange=function(){
                            if(xhu.status==200 && xhu.readyState==4){
                                if(xhu.responseText.includes("error")){
                                    units[0].innerText="No unit available for this category";
                                    return;
                                }
                                let select_element=document.createElement("select");
                                select_element.id="unit";
                                select_element.name="unit";
                                select_element.required=true;
                                select_element.innerHTML=`<option value="" disabled selected>
                        please select unit of measurement
                    </option>` + xhu.responseText;
                               units[0].innerHTML='';
                               units[0].appendChild(select_element);
                     select_element.addEventListener("change",function(){
                         stock_guide[0].innerText="in " + select_element.value;
                         if(select_element.value=="kilogram" || select_element.value=="kilograms"){
                             mass_unit.value="kg";
                         }
                         else{
                          if(select_element.value=="gram" || select_element.value=="grams"){
                             mass_unit.value="g";
                         }
                         else{
                             mass_unit.value="";
                         }
                         }
                         add_guide.style.display="flex";
                         units[1].style.display="flex";
                         add_more.style.display='flex';
                        measurement.placeholder="Enter weight (e.g 2)";
                        measurement.addEventListener("input",function(){
                            let main_label=document.getElementById("main_label");
                            
                        main_label.innerText="Enter price per " + measurement.value +mass_unit.value; 
                        
                        });
                        mass_unit.addEventListener("input",function(){
                            let main_label=document.getElementById("main_label"); 
                            
                        main_label.innerText="Enter price per " + measurement.value +mass_unit.value; 
                        
                        })
                     })
                            }
                        }
                      xhu.send();
          
                            })
                         }
                     }
                 }
             }
             xhh.send(sub_form);
            })   
        }
      }
     // function to submit form
    function submit_form(){
        for(let m=0;m < submit_buttons.length;m++){
            submit_buttons[m].addEventListener("click",function(){
                selects[0].classList.remove("shake");
                if(selected_category_id.value == ""){
                    selects[0].style.borderColor="red";
                    selects[0].classList.add("shake");
                }
                else{
                    if(selected_subcategory_id.value == ""){
                    selects[1].style.borderColor="red";
                    selects[1].classList.add("shake");
                } 
                }
            })
            sale_form.addEventListener("submit",function(){
                loading.style.display="flex";
            })
            
        }
        
    }
    // function to add more
    function add_more_sizes(){
        add_more.addEventListener("click",function(){
            let create_house=document.createElement("div");
            create_house.classList.add("units_house");
            
            
            create_house.innerHTML=`<section class="units" style="display:flex;border-radius:100px"><select style="width:67%" class="mass-units" required name="mass_unit[]">
                   <option value="">Select size</option>
    <option value="kg">Kilogram (kg)</option>
    <option value="g">Gram (g)</option>
    <option value="mg">Milligram (mg)</option>
    <option value="µg">Microgram (µg)</option>
    <option value="t">Metric Ton (t)</option>
    <option value="lb">Pound (lb)</option>
    <option value="oz">Ounce (oz)</option>
    <option value="st">Stone (st)</option>
    <option value="ct">Carat (ct)</option>
    <option value="tonne">Tonne (tonne)</option>
</select><input class="measurement" step="0.000000000000001" required name="measurement[]" type="number" placeholder="Enter product weight (eg. 50)kg"></section> <span class="remove">&times</span>
`;
add_more.parentNode.insertBefore(create_house,add_more);
let selected_masses=create_house.querySelector(".mass-units");
let measures=create_house.querySelector(".measurement");
selected_masses.addEventListener("change",function(){
    measures.placeholder="Enter product weight (eg. 50)"+selected_masses.value;
});
let create_cont=document.createElement("div"); 
   create_cont.classList.add("input-container");
   
   create_cont.innerHTML=`<input name="price[]"   type="number" class="input-field" placeholder=" " required>
    <label class="label">price( <?php
         $select_cur="SELECT * FROM `users` WHERE `id`='$user_id'";
         $cur_selected=mysqli_query($conn,$select_cur);
         $fetch_cur=mysqli_fetch_assoc($cur_selected);
         echo $fetch_cur['currency'];
         
         
         ?>)</label>`;
          let spans=document.getElementById("spans");
         spans.parentNode.insertBefore(create_cont,spans); 
create_house.querySelector(".remove").addEventListener("click", function() {
            create_house.remove();
            create_cont.remove();
        });
        measures.addEventListener("input",function(){
          create_cont.querySelector(".label").innerText="Enter price per "+measures.value+selected_masses.value;
        });
        selected_masses.addEventListener("input",function(){
          create_cont.querySelector(".label").innerText="Enter price per "+measures.value+selected_masses.value;
        });
        });
        
    }
 </script>
 <script>
     show_categories();
     submit_form();
     add_more_sizes();
 </script>
 
   <script>

    for(let r=0;r < currency_from.length;r++){
        convertCurrency(currency_from[r].value,currency_to[r].value,promo_amount[r].value)
        .then(function(result){
            if(result){
                show_amount[r].innerText=result;
                selection[r].value=result;
            }
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