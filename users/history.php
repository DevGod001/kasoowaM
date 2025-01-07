<?php
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
$per_page=10;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
 else{
     $page=1;
 }
$offset=($page-1)*$per_page;
$update="UPDATE `products` SET `status`='out of stock' WHERE `in_stock` <= 0";
$updated=mysqli_query($conn,$update); 

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
        z-index:2000;
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
                *{
            box-sizing:border-box;
        }
       .section2{
           width:100vw;
           height:100vh;
           background:whitesmoke;
           display:flex;
           flex-direction:column;
           align-items:center;
           margin-top:10vh;
       }
       .history_section{
           width:95%;
           background:white;
           text-align:center;
           display:flex;
           flex-direction:column;
           align-items:center;
           margin:5%;
           border-radius:8px;
           box-shadow:0px 2px 10px rgba(0,0,0,0.1);
           padding:5% 5px;
           
       }
       .heading{
           font-size:1.5rem;
          
       }
       .order_div{
           
           width:95%;
           display:flex;
           flex-direction:column;
           
       }
       .order_div_group,.order_button_group{
           display:flex;
           flex-direction:row;
           margin:10px 0;
           gap:5px;
           min-height:150px;
           width:100%;
          
       }
       .product_image{
           width:100px;
           height:100px;
           background-size:cover;
           background-position:center;
           border-radius:5px;
           margin-top:auto;
           
       }
       .product_details{
          
           text-align:start;
           display:flex;
           flex-direction:column;
           justify-content:space-between;
       }
       .order_details{
           color:#545454;
           font-size:0.9rem;
       }
       .action,.action_buttons{
           min-width:60px;
           width:auto;
           height:30px;
           color:white;
           border-radius:5px;
           border:none;
           background:green;
           cursor:pointer;
           
            font-size:0.9rem;
           font-family:teachers;
        
       }
       *{
           outline:none;
           user-select:none;
       }
        
    </style>
    <style>
        @media(min-width:800px){
             .section2{
           width:1000px;
           height:100vh;
           margin-left:350px;
           background:whitesmoke;
           display:flex;
         flex-direction:column;
           align-items:center;
           margin-top:10vh;
       }
        .container{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:100px;
            width:90%;
            margin:20px 0px;
            
        }
        
        .house{
            background:rgba(144,238,144,0.25);
            padding:10px;
            border-radius:8px;
            border:1px solid rgba(0,0,0,0.1);
            transition:transform 0.5s;
        }
        .house:hover{
            transform:scale(1.05);
           
        }
        .title{
            font-size:0.9rem;
           font-family:teachers;
        }
        }
        @media(max-width:1300px) and (min-width:601px){
             .section2{
           width:900px;
           height:100vh;
           margin-left:350px;
           background:whitesmoke;
           display:flex;
         flex-direction:column;
           align-items:center;
           margin-top:10vh;
       }
        .container{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:100px;
            width:90%;
             margin:20px 0px;
        }
        .house{
            background:rgba(144,238,144,0.25);
            padding:10px;
            border-radius:8px;
            border:1px solid rgba(0,0,0,0.1);
        }
        .title{
            font-size:0.9rem;
           font-family:teachers;
        }
        }
        @media(max-width:799px){
            .house{
            background:rgba(144,238,144,0.25);
            padding:10px;
            border-radius:8px;
            border:1px solid rgba(0,0,0,0.1);
        }
        .container{
            display:flex;
            flex-direction:column;
            gap:10px;
            width:100%;
             margin:20px 0px;
        }
        .container *{
            font-size:0.8rem;
        }
        .title{
            font-size:0.9rem;
           font-family:teachers;
        }
        }
        
    </style>
    <style>
        
        .modal {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            width:100%;
        }
        .modal h2 {
            color: #d9534f; /* Bootstrap danger color */
            margin-bottom: 15px;
        }
        .modal p {
            margin-bottom: 20px;
            color: #555;
        }
        .modal button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            transition: background 0.3s, color 0.3s;
            width:auto;
        }
        .modal .confirm,.modal .conf{
            background: #d9534f; /* Danger color */
            color: white;
        }
        .modal .confirm:hover {
            background: #c9302c; /* Darker shade */
        }
        .modal .conf:hover {
            background: #c9302c; /* Darker shade */
        }
        .modal .cancel {
            background: #f0ad4e; /* Warning color */
            color: white;
        }
        .modal .cancel:hover {
            background: #ec971f; /* Darker shade */
        }
        .modal .canc:hover {
            background: #ec971f; /* Darker shade */
        }
        .modal .canc {
            background: #f0ad4e; /* Warning color */
            color: white;
        }
       .parent{
         position:fixed;
         top:0;
         bottom:0;
         left:0;
         right:0;
         background:rgba(0,0,0,0.2);
         display:flex;
         flex-direction:column;
         align-items:center;
         justify-content:center;
         z-index:3200;
         transition:opacity 0.5s;
         opacity:0;
         visibility:hidden;
     }
     .child{
         padding:10px;
         background:white;
         width:90%;
         border-radius:5px;
         box-shadow:0px 4px 8px rgba(0,0,0,0.5);
     }
     .sales{
         margin:5vh 10px;
         border:1px solid silver;
         border-radius:5px;
         background:linear-gradient(to top right,white,rgba(144,238,144,0.9));
         transition:transform 0.5s;
         display:block;
        
     }
     .sales:hover{
         transform:scale(1.05);
     }
     .sales a{
         color:blue;
     }
     @media(min-width:800px){
         .child{
         padding:10px;
         background:white;
         width:500px;
         border-radius:5px;
     }
      .sales{
         margin:auto;
         border:1px solid silver;
         border-radius:5px;
         background:linear-gradient(to top right,white,rgba(144,238,144,0.9));
         transition:transform 0.5s;
         display:block;
        
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
            z-index:4000;
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
    .paginate-section{
     display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
    }
    
    .paginate-section a{
        height:100%;
        width:100%;
    }
   .paginate-buttons,.page{
        height:30px;
        width:30px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:lightgreen;
        color:green;
        box-shadow:0px 4px 8px rgba(0,0,0,0.2);
    }
    .page{
        background:transparent;
        border:1px solid green;
    }
    .paginate-buttons:hover{
        background:#4caf50;
        color:white;
    }
    .paginate-section a:hover{
        color:white;
    }
    
    @media(min-width:800px){
        .paginate-section{
    margin-left:350px;
    }
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
        <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
                         
       <section class="section2">
        <section class="history_section">
            <strong class="heading">My products </strong>
            
            <section class="container">
                <?php
                $select="SELECT * FROM `products` WHERE `user_id`=$user_id ORDER BY `date` DESC LIMIT $per_page OFFSET $offset";
                $selected=mysqli_query($conn,$select);
                $row=mysqli_num_rows($selected);
                
                if($row > 0){ 
                    while($fetch=mysqli_fetch_assoc($selected)){
                       switch($fetch['featured']){
                           case 'true':
                               $featured="Yes";
                               $col="#4caf50";
                               break;
                           case 'false':
                               $featured="No";
                               $col="red";
                               break;    
                       } 
                       switch($fetch['status']){
                           case strpos($fetch['status'],'active') !== false:
                               $color="#007bff";
                                $opacity=1;
                               $disabled="";
                               $background="brown";
                               $innertext="Pause";
                               break;
                               case strpos($fetch['status'],'pending') !==false:
                                case strpos($fetch['status'],'pause') !==false:   
                               $color="brown";
                               $opacity=1;
                               $disabled="";
                               $background="#4caf50";
                               $innertext="Resume";
                               break;
                               case strpos($fetch['status'],'delete') !==false:
                               case strpos($fetch['status'],'reject') !==false:
                               $color="red";
                               $opacity=0.5;
                               $disabled="disabled";
                               break;
                               case strpos($fetch['status'],'success') !==false:
                               case strpos($fetch['status'],'complete') !==false:
                               $color="green";
                               $opacity=0.5;
                               $disabled="disabled";
                               break;
                               case "out of stock":
                                    $color="#708090";
                                   
                               $opacity=0.5;
                               $disabled="disabled";
                               $background="brown";
                               $innertext="Pause";
                               break;
                               default:
                                   $color="#708090";
                                   
                               $opacity=1;
                               $disabled="";
                               $background="brown";
                               $innertext="Pause";
                               break;
                       }
                       $photos=$fetch['photos'];
                       $photos=explode(",",$photos);
                       $price=$fetch['price'];
                       $price=explode(",",$price);
                       $min_price=min($price);
                       $max_price=max($price);
                       $total_price=count($price);
                       if($total_price == 1){
                           $dis="none";
                       } 
                         else{ 
                            $dis="";
                             
                         }
               echo  '<div class="house">
            <div class="order_div">
                <section class="order_div_group">
                    <div style="background-image:url(&quot;'.$photos[0].'&quot;)" class="product_image">
                        
                    </div>
                    <div class="product_details">
                        <p ><strong class="title">Order</strong> <span class="title" onclick="navigator.clipboard.writeText(this.innerText)" style="color:#545454">'.$fetch['key'].'</span></p>
                        <span class="order_details"><strong>'.$fetch['title'].'</strong></span>
                        <span class="order_details"><strong>Date: </strong>'.$fetch['date'].'</span>
                        
                        <span class="order_details"><strong>Status: </strong><span class="status" style="color:'.$color.'">'.$fetch['status'].'</span></span>
                        <span class="order_details"><strong>Promoted: </strong><span style="color:'.$col.'">'.$featured.'</span></span>
                        <span style="display:flex;white-space:nowrap;height:40px;align-items:center;width:100%;overflow:hidden" class="order_details"><strong>In stock: </strong><form style="height:100%;display:flex;flex-direction:row;align-items:center;flex 1 0 auto"><input class="stock_input" style="height:100%;width:50%;border:0.1px solid silver;font-family:teachers;font-size:90%;text-align:center" type="number" value="'.$fetch['in_stock'].'" ><button class="stock_button" style="font-family:poppins;font-weight:normal;height:100%;border-radius:0px;margin-left:0px">update</button></form></span>
                    
                       <span class="order_details"><strong>Price: </strong><span style="color:navy"><span>'.$fetch['currency'].' </span><span class="min">'.$min_price.'</span></span> <span style="display:'.$dis.';color:navy">- '.$fetch['currency'].'</span><span class="max" style="display:'.$dis.';color:navy">'.$max_price.'</span></span>
                       </div>
                    </div>
                    <div style ="min-height:auto; display:flex;flex-direction:row;justify-content:space-between;border-bottom:1px solid silver; padding-bottom:10px;" class="order_button_group">
                        <button style="opacity:'.$opacity.'" '.$disabled.' class="action_buttons">Edit</button>
                          <button style="background:#007bff;opacity:'.$opacity.'" '.$disabled.' class="action_buttons">Promote</button>
                          <button style="background:'.$background.';opacity:'.$opacity.'"  '.$disabled.' data-group="3" class="action_buttons">'.$innertext.'</button>
                         <button style="background:red;opacity:'.$opacity.'" '.$disabled.' class="action">Delete</button>
                         <section class="parent">
                   <div class="child">
                   
                   <div class="modal">
                   <i class="echo"></i>
    <h2><span class="material-icons" style="vertical-align: middle;">delete</span> Delete Confirmation</h2>
    <p>Are you sure you want to trash this product? This action cannot be undone.</p>
    <input class="conf_id" type="hidden" value="'.$fetch['id'].'">
    <button class="conf" >Yes, Delete</button>
    <button class="cancel">Cancel</button>
</div>
                   </div>
               </section> 
                         </div>
                        
                    </div>';
                    }
                }
                 else{
                     echo '<div class="sales"><p>You havent added any product yet,click <a href="sell">here</a> to add a product and start making sales  </p></div>';
                 }
                   ?>
                    <!-- end -->
                </section>
                
                
                
           </section>
            <?php   
            $select="SELECT * FROM `products` WHERE `user_id`=$user_id";
            $selected=mysqli_query($conn,$select);
            $row=mysqli_num_rows($selected);
            $ceil=ceil($row/$per_page);
            ?>
            <section class="paginate-section" style="visibility:<?php 
    if($row <= $per_page){
        echo "hidden";
    }
    ?>">
    <button class="paginate-buttons" style="visibility:<?php 
    if($page <= 1){
        echo "hidden";
    }
    ?>">
       <a href="?page=<?php echo $page-1; ?>">  <i class="material-icons">chevron_left</i></a>
    </button>
    <button class="page"><?php echo $page; ?></button>
     <button class="paginate-buttons" style="visibility:<?php 
    if($page >= $ceil){
        echo "hidden";
    }
    ?>">
         <a href="?page=<?php echo $page+1; ?>"> <i class="material-icons">chevron_right</i></a>
    </button>
    
    
</section>
        </section>
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
<!-- script tag for functions and variables -->  
  <script>
      //functions and variables
      //variables
      let parent=document.getElementsByClassName('parent');
      let action=document.getElementsByClassName('action');
      let child=document.getElementsByClassName('child');
      let cancel_delete=document.getElementsByClassName('cancel');
      let confirm_delete=document.getElementsByClassName('conf');
      let product_id=document.getElementsByClassName("conf_id");
      let loading=document.getElementById("loading");
      let status=document.getElementsByClassName("status");
      let action_buttons_group=document.querySelectorAll(".order_button_group");
      let action_buttons=document.querySelectorAll(".action_buttons");
     
      let pause_buttons=document.querySelectorAll("button[data-group='3']");
      let house=document.getElementsByClassName("house");
      let mobile_cart_number=document.getElementById("mobile_cart_number");
      let stock_input=document.querySelectorAll(".stock_input");
      let stock_button=document.querySelectorAll(".stock_button");
      // function to update stock number
function update_stock_quantity(){
    
    for(let d=0;d < stock_button.length;d++){
        stock_button[d].addEventListener("click",function(event){
            event.preventDefault();
            loading.style.display="flex";
            let xhd=new XMLHttpRequest();
            xhd.open("GET","history_process.php?update_stock=true&amount=" + stock_input[d].value + "&id=" + product_id[d].value,true);
            xhd.onreadystatechange=function(){
                if(xhd.readyState==4 && xhd.status==200){
                    loading.style.display="none";
                    status[d].innerText=xhd.responseText;
                    if(xhd.responseText== "active"){
                        
                        status[d].style.color="#007bff";
                        for(let n=0;n < action_buttons.length;n++){
                            action_buttons[n].style.opacity="1";
                            action_buttons[n].disabled=false;
                        }
                    }
                     else{
                         status[d].style.color="#708090";  
                         for(let m=0;m < action_buttons.length;m++){
                            action_buttons[m].style.opacity="0.5";
                            action_buttons[m].disabled=true;
                        }
                     }
                }
            }
            xhd.send();
            
        })
    }
}

update_stock_quantity();
      // function to show parent 
      function show_parent(){
         for(let i=0;i < action.length;i++){
             action[i].addEventListener("click",function(){
                 parent[i].style.opacity=1;
                 parent[i].style.visibility="visible";
             })
             parent[i].addEventListener("click",function(){
                 parent[i].style.opacity=0;
                 parent[i].style.visibility="hidden";
             })
             child[i].addEventListener("click",function(event){
                 event.stopPropagation();
             })
             cancel_delete[i].addEventListener("click",function(){
                 parent[i].style.opacity=0;
                 parent[i].style.visibility="hidden";
             })
         }
      }
     h
      // function to delete product
      function delete_product(){
          for(let c=0;c < confirm_delete.length;c++){
          confirm_delete[c].addEventListener("click",function(){
              loading.style.display="flex";
              let c_data=new FormData();
              c_data.append("delete_id",product_id[c].value);
              let xhc=new XMLHttpRequest();
              xhc.open("POST","history_process.php",true);
              xhc.onreadystatechange=function(){
                  if(xhc.status==200 && xhc.readyState==4){
                      loading.style.display="none";
                      house[c].style.display="none";
                      parent[c].style.display="none";
                   
                  }
              }
              xhc.send(c_data);
          })
      }
      
      }
      
      // function to pause product status
      function pause_product(){
          for(let p=0;p < pause_buttons.length;p++){
              pause_buttons[p].addEventListener("click",function(){
                  loading.style.display="flex";
                let pause_form=new FormData();
                pause_form.append("pause_id",product_id[p].value);
                pause_form.append("status",status[p].innerText);
                let xhp=new XMLHttpRequest();
                xhp.open("POST","history_process.php",true);
                xhp.onreadystatechange=function(){
                    if(xhp.status==200 && xhp.readyState==4){
                        loading.style.display="none";
                        status[p].innerText=xhp.responseText;
                        
                        if(xhp.responseText.includes("paused")){
                            status[p].style.color="brown";
                            pause_buttons[p].style.background="#4caf50";
                            pause_buttons[p].innerText="Resume";
                        }
                        else{
                            status[p].style.color="#007bff";
                            pause_buttons[p].style.background="brown";
                             pause_buttons[p].innerText="Pause";
                        }
                    }
                }
                xhp.send(pause_form);
                
              })
          }
      }
      // function to locale prices
      function locale_prices(cur_price){
          let min=document.getElementsByClassName(cur_price);
          for(let l=0;l < min.length;l++){
          min_int=parseInt(min[l].innerText);
          
          min[l].innerText=min_int.toLocaleString();
          }
      }
      
  </script>
 <!-- script tag for calling functions --> 
  <script>
    show_parent();
    locale_prices("min");
    locale_prices("max");
    delete_product();
    pause_product();
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