<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
include_once 'general_process.php';
include_once 'haversine.php';
include_once 'script.php';
if(!isset($_COOKIE['user_id'])){
    header('Location:login');
    exit;
}
 if(isset($_COOKIE['cart_id'])){
      $uniqid=$_COOKIE['cart_id'];
      $select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid'";
      $selected=mysqli_query($conn,$select);
      $row=mysqli_num_rows($selected);
     if($row == 0){
         header('Location:products');
         exit;
     }
  }
   else{
     header('Location:products');
         exit;  
   }
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";

$select="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
$selected=mysqli_query($conn,$select);



if(isset($_COOKIE['city'])){
    $city=$_COOKIE['city'];
}
 else{
     $city="unset";
 }
 if(isset($_COOKIE['state'])){
     $state=$_COOKIE['state'];
     
 }
  else{
      $state="unset";
  }
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop groceries from anywhere worldwide">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php
    if(!isset($_GET['search'])){
        if(!isset($_GET['store'])){
        echo "All products";
        }
    }
    else{
        
        echo 'results in '.$_GET['search'].'';
        
    }
    if(isset($_GET['store'])){
        echo "All products from ".$_GET['store'];
    }
    ?></title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop the latest products at our store.">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="cart.css?v=4.4">
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="manifest" href="app.json">

     <style>
    *{
        
        
        

    }
        body,html{
            margin:0;
            padding:0;
            
        }
        body{
            background:whitesmoke;
            overflow-x:hidden; 
            font-family:Arial,sans-serif;
        }
        main{
           overflow-x:hidden; 
        }
        header{
        background:white;
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        align-items:center;
        justify-content:space-between;
       padding:5px 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
       width:100%;
       
        }
        *{
            box-sizing: border-box;
        }
        .logo{
            height:50px;
           
            display:flex;
            flex-direction:row;
            align-items:center;
            gap:5px;
            flex:1;
            
        }
        .logo .material-icons{
            background:#4caf50;
            color:white;
            border-radius:50%;
            padding:5px;
        }
         .site_logo{
            
        }
        .icon{
            background-image:url('../assets/kasoowa.png');
            background-size:cover;
            background-position:center;
            height:90%;
            width:70px;
           
        }
        *{
            outline:none;
        }
        input[type=search]{
            border:none;
            width:85%;
            height:100%;
        }
        .search{
            border:1px solid #767676;
            display:flex;
            flex-direction:row;
            align-items:center;
            border-radius:100px;
            overflow:hidden;
            width:100%;
            height:30px;
             order:2;
            padding-left:10px;
            
        }
        .search .material-icons{
            width:15%;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:center;
           height:100%;
           background:#4caf50;
           color:white;
           
        }
        .material-icons{
            user-select:none;
        }
        .search:hover{
            border-color:#4caf50;
        }
        .action_div{
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:flex-end;
            gap:20px;
            flex:1;
            padding:0px 5px;
            text-align:right;
        }
        .profile_section{
            position:relative;
        }
        .profile-links{ 
            position:absolute;
            right:0%;
            z-index:1000;
            background:white;
            height:100px;
            
            boorder:1px solid silver;
            display:none;
            flex-direction:column;
            align-items:center;
            justify-content:space-around;
            min-width:100px;
            padding:5%;
            border-radius:5px;
           box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile_section:hover .profile-links{
            display:flex;
        }
        .profile-links a{
            background:whitesmoke;
            width:90%;
            height:40px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            color:black;
            text-decoration:none;
             border-radius:5px;
             
        }
        .profile-links a:hover{
            background:#4caf50;
            color:white;
        }




main{
    padding-bottom:0px;
    flex:1 0 auto;
}

/* WebKit browsers (Chrome, Safari) */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1; /* Light background */
}

::-webkit-scrollbar-thumb {
    background: green; /* Thumb color */
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: darkgreen; /* Darker on hover */
}

/* Firefox */
body, html {
    scrollbar-width: thin;
    scrollbar-color: green #f1f1f1;
}

body, html {
    scrollbar-width: thin; 
    scrollbar-color: green #f1f1f1; 
}

        @media(min-width:1024px){
            .search{
              
                width:500px;
                height:40px;
                order:3;
             flex:2;
             order:2;
            }
            header{
       
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:space-between;
       
        
        }
       
          .action_div{
            flex:1;
            order:2;
        }
         .logo{
            height:100%;
            width:100px;
            flex:1;
             order:1;
        }
         .search .material-icons{
            width:10%;
            
           height:100%;
           background:#4caf50;
           
        }
          input[type=search]{
            border:none;
            width:90%;
            height:100%;
        }
        #link_grid{
            grid-template-columns:1fr 1fr 1fr 1fr;
        }
        .s2_div{
    height:100%;
    width:200px;
    padding:3%;
}
    
      h3{
    padding-left:3vw;
}  
        
        
        
        }
        
       
    </style>
    
    <style>
    .footer{
    min-height:100px;
        width:100vw;
        background:#4caf50;
        margin-bottom:0;
        box-sizing:border-box;
   
    }
     .footer {
            background-color: #4CAF50;
            background: linear-gradient(145deg, #4CAF50, #45a049);
            width: 100%;
            padding: 4rem 0 2rem 0;
            color: white;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
        }

    .footer *{
        font-style:normal;
        white-space:wrap;
    }
    
 .footer {
            background-color: #4CAF50;
            background: linear-gradient(145deg, #4CAF50, #45a049);
            width: 100%;
            padding: 4rem 0 2rem 0;
            color: white;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
        }

        .footer-content {
            width: 100%;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer-brand {
            grid-column: span 1;
        }

        .footer-brand h2 {
            font-size: 1.8rem;
            margin: 0 0 1rem 0;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .footer-brand p {
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
            margin: 0;
        }

        .footer-links {
            grid-column: span 2;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .footer-links h3 {
            font-size: 1rem;
            margin: 0 0 1.2rem 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }

        .footer-links a:hover {
            opacity: 1;
        }

        .footer-payment {
            grid-column: span 1;
        }

        .footer-payment h3 {
            font-size: 1rem;
            margin: 0 0 1.2rem 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .payment-methods {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .payment-icon {
            background: rgba(255, 255, 255, 0.9);
            padding: 0.7rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .payment-icon:hover {
            transform: translateY(-2px);
        }

        .payment-icon i {
            font-size: 1.8rem;
            color: #2d2d2d;
        }

        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            color: white;
            font-size: 1.2rem;
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }

        .social-links a:hover {
            opacity: 1;
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-brand, .footer-links, .footer-payment {
                grid-column: span 2;
            }
        }

        @media (max-width: 640px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-brand, .footer-links, .footer-payment {
                grid-column: span 1;
            }

            .footer-links {
                grid-template-columns: 1fr;
            }

            .payment-methods {
                justify-content: center;
            }
        }

</style>

<style>
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
         font-size:90%;
         display:flex;
         align-items:center;
         justify-content:center;
     }
     .cart_container{
         position:relative;
     }
     .categories_section{
         background:white;
         border-bottom:1px solid silver;
         display:flex;
         flex-direction:row;
         align-items:center;
         justify-content:center;
     }
     .anchor{
         text-decoration:none;
         color:green;
         font-family:teachers;
         width:auto;
         
        
     }
     .others_a{
         text-decoration:none;
         color:green;
         font-family:teachers;
         width:auto;
         
        
     }
     .anchor_div{
         height:50px;
         display:flex;
        gap:10px;
        
     }
     .a_div{
         height:100%;
         padding:5px;
         
         display:flex;
         align-items:center;
         
         
     }
     .other_div{
         height:100%;
         padding:5px;
         
         display:flex;
         align-items:center;
         position:relative;
         
     }
     .a_div:hover{
         background:linear-gradient(to top right,green,lightgreen);
         color:white;
         
     }
     
      .other_div:hover{
         background:linear-gradient(to top right,green,lightgreen);
         color:white;
         
     }
      .a_div:hover .anchor{
         
         color:white;
         
     }
      .a_div:hover .others_a{
         
         color:white;
         
     }
      .other_div:hover .anchor{
         z-index:200;
         color:white;
         
     }
     .others_show{
         z-index:200;
     }
     .other_div .material-icons{
         
         color:#4caf50;
         
     }
     .other_div:hover i{
         
         color:white;
         
     }
     
     .anchor:hover{
        
         color:white;
         
     }
     .a_div i{
         color:green;
     }
     .others_show{
         
         position:absolute;
         background:white;
         top:100%;
         left:0;
         min-height:50px;
         box-shadow:0px 4px 8px rgba(144,238,144,0.5);
         right:0;
         display:none;
         
     }
     .others_show .anchor{
         color:black;
     }
     .other_div:hover .others_show{
         display:flex;
         flex-direction:column;
     }
      .a_div:hover span{
         
         color:white;
         
     }
    
     </style>
<style>
    @media(min-width:800px){
        
     .filter_container{
         margin-right:92px;
     }
     .current_sort{
         margin-left:82px;
     }
     header{
         padding:0 88px;
     }
      .mobile_action_div{
          display:none;
      }
    }
@media(max-width:800px){
    .categories_section{
        display:none;
     }
     .add_to_cart_button{
         width:100%;
     }
         
     .action_div{
         display:none;
     }
     
     
     .mobile_action_div{
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:flex-end;
            gap:20px;
            flex:1;
            padding:0px 5px;
            text-align:right;
        }
        .profile-links{ 
            position:absolute;
            
            height:auto;
            
            min-width:200px;
            
        }
         .profile-links a{
             background:white;
         }
         
}
@media(min-width:768px) and (max-width:1024px){
    
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
</style>

        <style>
        .cart_section{
           position:fixed;
           top:0%;
           left:100%;
           bottom:0;
           right:0;
           background:whitesmoke;
           border:1px solid silver;
           display:flex;
           flex-direction:column;
           max-height:100vh;
           min-height:100vh;
           overflow:hidden;
           z-index:200;
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
           .search_position{
           border:none;
            display:flex;
            flex-direction:row;
            align-items:center;
            border-radius:100px;
           
            width:100%;
            height:30px;
             order:2;
            
            position:relative;
            
        }
        .search_suggest{
            position:absolute;
            
             left:0;
             right:0;
             top:100%;
             background:white;
             border-radius:0 0 5px 5px;
             border:0.1px solid silver;
             border-top:none;
             display:none;
             flex-direction:column;
             padding:10px;
             z-index:1000;
             
        }
        .search_suggest a{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:4px;
            font-family:teachers;
            text-decoration:none;
        }
         .search_suggest a *{
           
            font-family:teachers;
            color:#708090;
        }
        .search_suggest a:hover{
            background:rgba(144,255,144,0.3);
        }
        @media(min-width:800px){
            .search_position{
           border:none;
            display:flex;
            flex-direction:row;
            align-items:center;
            border-radius:100px;
           
            width:500px;
                height:40px;
             order:2;
            
            position:relative;
            
        }
        .profile_section{
            cursor:pointer;
        }
        }
        </style>
        <style>
        .section_nav{
            height:50px;
            background:#4caf50;
            display: grid;
            place-items:center;
            grid-template-columns:1fr 1fr 1fr 1fr;
            box-shadow:0px 4px 8px rgba(0,0,0,0.2)
        }
        .section_nav a{
            width:100%;
            height:100%;
            color:white;
            text-decoration:none;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:5px;
            user-select:none;
            font-family:poppins;
        }
        .section_nav a span{
            font-size:0.9rem;
            font-family:poppins;
        }
        .section_nav a:hover{
            background:linear-gradient(to top right,white,whitesmoke,rgba(144,255,144,0.5));
            color:green;
        }
        .profile-links{ 
            position:absolute;
            right:0%;
            z-index:1000;
            background:white;
            height:auto;
           overflow:hidden;
            
            display:none;
            flex-direction:column;
            align-items:center;
            justify-content:space-around;
            min-width:100px;
            padding:5%;
            border-radius:5px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            min-width:150px;
            border:none;
            width:auto;
            padding:0;
            gap:0px;
        }
        .profile_section:hover .profile-links{
            display:flex;
            
        }
        .profile-links a{
            background:whitesmoke;
            width:90%;
            height:40px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            color:black;
            text-decoration:none;
             border-radius:5px;
              white-space:nowrap;
           font-family:poppins;
           align-items:flex-start;
           padding:5px 10px;
           margin:0;
           background:white;
           width:100%;
           border-radius:0px;
           display:flex;
           flex-direction:row;
           align-items:center;
           justify-content:flex-start;
           gap:10px;
           font-size:0.8rem;
        }
        .profile-links .material-icons{
            font-size:1.0rem;
        }
        .profile-links a:hover{
            background:#4caf50;
            color:white;
            background:rgba(144,255,144,0.3);
            color:green;
        }

        #logged_profile_links{
            min-width:150px;
            width:auto;
            padding:0;
            gap:0px;
        }
        #logged_profile_links a{
           white-space:nowrap;
           font-family:poppins;
           align-items:flex-start;
           padding:5px 10px;
           margin:0;
           background:white;
           width:100%;
           border-radius:0px;
           display:flex;
           flex-direction:row;
           align-items:center;
           justify-content:flex-start;
           gap:10px;
        }
        #logged_profile_links a:hover{
            background:rgba(144,255,144,0.3);
            color:green;
        }
        @media(min-width:800px){
            .section_nav{
                height:70px;
               display:none;
               padding:0 88px;
               grid-template-columns:1fr 1fr 1fr 1fr;
            }
             .section_nav a{
                  font-family:teachers;
             }
        }
    </style>
    <style>
        #check{
            font-size:0.5rem;
            position:absolute;
            top:40%;
            right:0%;
            background:white;
            color:green;
            padding:5%;
            border-radius:50%;
        }
        .continue{
            background:red;
        }
    </style>
    <style>
    .progress_group{
    background:whitesmoke;
}
        @media(min-width:800px){
  .cart_page_group{
    display:flex;
   flex-direction:row;
} 
.cart_page_group{
    padding:0px 88px;
    
}
.checkout_button{
        height:50px;
    }
    .section3{
        background:white;
    }
   .section4{
       background:whitesmoke;
   }
   .cart_page_group{
       display:grid;
      
       grid-template-columns:1.2fr 0.8fr;
   }
   .progress_group{
       background:rgba(144,255,144,0.2);
   }
   .section3 *:not(.material-icons){
       font-family:poppins;
   }
   .section3{
       max-height:500px;
       overflow:auto;
   }

}
.loop_head{
    background:red;
}
    </style>
   <style>
   .confirm_reset_section *{
           user-select:none;
       }
        @media(max-width:799px){
       .reset_button{
           margin-left:auto;
           background:rgba(255,0,0,0.7);
           border:none;
           height:40px;
           padding:25px 30px;
           color:white;
           display:flex;
           align-items:center;
           cursor:pointer;
           gap:10px;
       }
       
      
       .confirm_reset_section{
           position:fixed;
           top:0;
           bottom:0;
           right:0;
           left:0;
           z-index:900;
           background:rgba(0,0,0,0.5);
           display:none;
       }
       .confirm_reset_child{
           position:absolute;
           left:0;
           right:0;
          height:60%;
           overflow:hidden;
           background:white;
           border-radius:26px 26px 0px 0px;
           bottom:0;
           display:flex;
           flex-direction:column;
           align-items:center;
           padding:10px;
           font-family:poppins; 
           justify-content:flex-end;
           user-select:none;
           
       }
       }
       .confirm_times{
           user-select:none;
       }
       .confirm_icon{
           font-size:4rem;
         text-shadow:0px 4px 8px rgba(0,0,0,0.2);
       }
       .confirm_reset_child button{
           margin-top:20px;
           border:none;
           background:red;
           color:white;
           width:100%;
           height:40px;
           border-radius:4px;
           cursor:pointer;
       }
       .confirm_reset_child button:nth-of-type(2n){
           background:white;
           color:red;
           border:1px solid red;
           margin-bottom:20px;
       }
        .entity{
            font-size:1.1rem;
            
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
        .round{
            height:50px;
            width:50px;
            border:4px solid silver;
            border-right:4px solid #4caf50;
            border-radius:50%;
            animation:turn 2s linear infinite;
        }
        @keyframes round{
            0%{
                transform:rotate(0deg);
            }
            100%{
                transform:rotate(360deg);
            }
        }
       

    </style>
    <!-- transfer to css  file -->
    <style>
         @media(min-width:800px){
            .stores_section{
               /* order:3; */
                background:white;
            }
             .confirm_reset_section{
           position:fixed;
           top:0;
           bottom:0;
           left:0;
           right:0;
           background:rgba(0,0,0,0.5);
           z-index:2900;
           display:flex;
           flex-direction:column;
           align-items:center;
           justify-content:center;
           display:none;
       }
       .confirm_reset_child{
          background:white;
          width:500px;
          border-radius:5px;
          box-shadow:0px 4px 8px rgba(0,0,0,0.9);
          padding:10px;
          display:flex;
          flex-direction:column;
          align-items:center;
          font-family:poppins;
           
       }
       .confirm_reset_child button{
             font-family:poppins;
       }
       .confirm_times{
           cursor:pointer;
       }
       .reset_button{
           margin-left:auto;
           background:rgba(255,0,0,0.7);
           border:none;
           padding:10px 30px;
           color:white;
           display:flex;
           align-items:center;
           cursor:pointer;
           gap:10px;
       }
       .pointer{
           cursor:pointer;
       }
        }
        
    </style>
    </head>
    <script>
        function search_product(input1){
            let search_product=document.querySelector(input1);
        
            if(search_product.value == ""){
                return;
            } 
            else{
                window.location.href="?query="+ encodeURIComponent(search_product.value);
            }
        }
    </script>
<body>
     <section class="loader">
        <div class="turn">
            
        </div>
    </section>
    <header>
        <section class="logo"><img onclick="window.location.href='/'" class="site_logo" style="height:100px;cursor:pointer" src="../assets/kasoowa.png"></section>
       <form class="search_position"><label class="search"> <input name="query" class='search_input' type="search" placeholder="Search by zip code, store address or cities nearby...."><i style="cursor:pointer" class="material-icons" onclick="search_product('.search_input')">search</i>
        </label>
        <section class="search_suggest">
        
        </section>
      </form>
       <div class="action_div">
           <?php
           if(!isset($_COOKIE['user_id'])){
           echo '<section class="profile_section"><i class="material-icons" id="profile">person</i><div class="profile-links"> <a href="register"><i class="material-icons">person_add</i>
Sign up</a>
      
       
        <a href="login"><i class="material-icons">login</i>
Login</a></div></section>';
           }
             else{
       echo '<section class="profile_section"><i id="check" class="material-icons">verified</i><i class="material-icons" id="profile">person</i><div id="logged_profile_links" class="profile-links">
       <a href="/"><i class="material-icons">home</i>Home</a>
       <a href="cart"><i class="material-icons entity">&#128722;</i>Cart</a>
       <a href="account"><i class="material-icons">person</i>My Account</a>
      
       
        <a style="border-top:0.1px solid #4caf50;justify-content:center" href="logout"><i class="material-icons">exit_to_app</i>Logout</a></div></section>';
             }
        ?>
        <section class="cart_container"><i class="material-icons entity">&#128722;</i>
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
        <div id="cart_number"><?php echo $cart_row; ?></div></section></div>
     <!--Mobile action div-->
       <div class="mobile_action_div"><section class="profile_section"><i class="material-icons entity" id="profile" style="margin-top:5px;">&#9776;</i><div class="profile-links">
           <?php 
           $select="SELECT * FROM `categories` WHERE 1";
           $selected=mysqli_query($conn,$select);
           $row=mysqli_num_rows($selected);
           
           
           
           
           ?>
           <?php
           if($row > 0){
               while($fetch=mysqli_fetch_assoc($selected)){
           echo '<a href="?category='.$fetch['id'].'&search='.$fetch['name'].'">'.$fetch['name'].'</a>';
            }
            }
            ?>
        </div></section><section class="cart_container"><i class="material-icons entity">&#128722;</i><div id="mobile_cart_number"><?php echo $cart_row; ?></div></section></div> 
    </header><main>
        
        <section class="categories_section">
           <div class="anchor_div">
               <?php 
               $select="SELECT * FROM `categories` WHERE 1 ORDER BY `name` DESC LIMIT 3";
               $selected=mysqli_query($conn,$select);
               $row=mysqli_num_rows($selected);
               
               
               ?>
               <?php
               if($row > 0){
                  while($fetch=mysqli_fetch_assoc($selected)){
              echo '<div class="a_div"><a href="?category='.$fetch['id'].'&search='.$fetch['name'].'" class="anchor">'.$fetch['name'].'</a> </div>';
                  }
               }
             ?> 
              
               
                <div class="other_div"><a class="anchor pointer">Other Categories</a><i class="material-icons" >arrow_drop_down</i> <section class="others_show">
                    <?php 
               $select="SELECT * FROM `categories` ORDER BY `name` DESC LIMIT 2900000000000000 OFFSET 3 ";
               $selected=mysqli_query($conn,$select);
               $row=mysqli_num_rows($selected);
               
               
               ?>
               <?php
               if($row > 0){
                  while($fetch=mysqli_fetch_assoc($selected)){
                   echo '<div class="a_div"><span class="material-icons">chevron_right</span><a href="?category='.$fetch['id'].'&search='.$fetch['name'].'" class="others_a">'
                   .$fetch['name'].'</a> </div>
                    ';
                  }
               }
             ?> 
                    
                </section></div>
                 
            
           </div>
        </section>
        
       <section class="section_nav">
        <a href="/">
            <span>Home</span>
            <span>&raquo;</span>
        </a>
        <?php
        if(isset($_COOKIE['user_id']) && isset($_COOKIE['account_type'])){
       echo '<a href="account">
            <span>Account</span>
            <span>&raquo;</span>
        </a>';
        }   
         else{
             echo '<a href="register">
            <span>Signup</span>
            <span>&raquo;</span>
        </a>';
         }
        ?>
        <a href="cart">
            <span>Cart</span>
            <span>&raquo;</span>
        </a>
        <?php
        if(isset($_COOKIE['user_id']) && isset($_COOKIE['account_type'])){
        echo '<a href="logout">
            <span>Logout</span>
            <span>&#8594;</span>
        </a>';
        } 
         else{
             echo '<a href="login">
            <span>Login</span>
            <span>&#8594;</span>
        </a>';
         }
        ?>
    </section>
   
   <!-- START -->
  
  <section class="cart_page_group">
        <section class="section3">
            <button onclick="show_confirm()" class="reset_button"><span style="font-size:1.2rem;">&#8635;</span><span>reset cart</span></button>
            <!-- START -->
            <?php 
            $select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid' ORDER BY `date` DESC";
            $selected=mysqli_query($conn,$select);
            if($selected){
                $row=mysqli_num_rows($selected);
                if($row > 0){
                  while($fetch=mysqli_fetch_assoc($selected)){
                      $pid=$fetch['product_id'];
                      $get="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `user_id` FROM `products` WHERE `id`=$pid)";
                      $gotten=mysqli_query($conn,$get);
                      if($gotten){
                          $carry=mysqli_fetch_assoc($gotten);
                         $store=$carry['business_name'];
                         $minimum_order=$carry['minimum_order'];
                            $sid=$carry['user_id'];
                         if(empty($store)){
                             $store=$carry['username'];
                             
                         }
                      }
                      $select_sum="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `uniqid`='$uniqid' AND `product_id` IN(SELECT `id` FROM `products` WHERE `user_id`=$sid)";
                      $sum_selected=mysqli_query($conn,$select_sum);
                      if($sum_selected){
                          $sum_fetch=mysqli_fetch_assoc($sum_selected);
                          $total=$sum_fetch['total'];
                          $remaining=$minimum_order - $total;
                          $width=$total/$minimum_order * 100;
                          if($remaining <= 0){
                              $display="none";
                          }
                            else{
                                $display="flex"; 
                            }
                      }
                      // all js ids
                      $link="products?store_id=".$fetch['store_id']."&store=".urlencode($store);
                      echo ' <div class="cart_loop">
                      <input class="hidden_cart_id" type="hidden" value="'.$fetch['id'].'">
                        <input class="hidden_product_id" type="hidden" value="'.$fetch['product_id'].'">
        <section style="background:silver;color:black" class="loop_group loop_head">
        <strong>'.$store.'</strong>
        </section>
        <section style="border-bottom:0.1px solid silver;padding:10px 0;margin:0 10px;width:calc(100% - 20px)" class="loop_group">
            <div style="background-image:url(\''.$fetch['product_photo'].'\')"class="product_photo">

            </div>
            <span>
               '.$fetch['product_title'].' <span class="span_details">'.$fetch['size'].''.$fetch['unit'].'</span>
            </span>
        </section>
        <section style="align-items:flex-start" class="loop_group">
            <span class="span_house"><div class="price_group"><span>'.$fetch['currency'].'</span><span class="forever_span">'.$fetch['product_cost'] * $fetch['quantity'].'</span></div>
                <i class="material-icons delete" >
                    delete_forever
                </i>
            </span>
           <span class="counter_div">
                <button>-</button>
                <span style="font-size:0.8rem;color:#708090">'.$fetch['quantity'].'</span>
                <button>+</button>
            </span>
        </section>
        <section style="display:none;flex-direction:column" class="loop_group progress_group">
       <div class="progress_details" style="display:none">
        <span >
            minimum order: '.$fetch['currency'].''.$minimum_order.'
        </span>
        <span>
            '.$fetch['currency'].'<span class="total_span of_span">'.$total.'</span> of '.$fetch['currency'].''.$minimum_order.'
        </span>
       </div>
       <div style="display:none" class="progress_bar bar_'.$fetch['store_id'].'">
        <div style="width:'.$width.'%" class="progress_child">

        </div>
       </div>
       <span style="display:none" class="span_details required">Add '.$fetch['currency'].''.$remaining.'  more  to meet  minimum order amount</span>
       <div class="button_div" style="display:none;">
        <button onclick="window.location.href=\''.$link.'\'" style="background:white;color:#4caf50;border:1px solid #4caf50">Continue shopping</button>
        <button class="single_checkout"><i class="material-icons">credit_card</i>Checkout</button> 
       </div>
        </section>

        </div>';
                  }
                }
            }
            ?>
            
            </section>
       
             <section class="stores_section">
               <div class="stores_section_header">
                   Stores Progress to Checkout
               </div>
               <div class="stores_house">
               <?php
            $select="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `store_id` FROM `cart` WHERE `uniqid`='$uniqid')";
            $selected=mysqli_query($conn,$select);
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
                        <div style="padding:10px 0">
                            <button onclick="window.location.href=&quot;'.$link.'&quot;" class="shop_this_store pointer">
                                Shop this Store
                            </button>
                        </div>
                    </section>
                </div>
                ';
         }
               
               ?>
                </div>
                
            </section>
         <section class="section4">
             <?php
$user_id=$_COOKIE['user_id'];
$select_fee="SELECT * FROM `users` WHERE `id` IN(SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `uniqid`='$uniqid'))";
$fee_selected=mysqli_query($conn,$select_fee);
if($fee_selected){
    $arr=[];
   while($fee_fetch=mysqli_fetch_assoc($fee_selected)){
       $lat_from=$fee_fetch['latitude'];
       $lng_from=$fee_fetch['longitude'];
       
    $select_users="SELECT * FROM `users` WHERE `id`=$user_id";
    $users_selected=mysqli_query($conn,$select_users);
    $users_fetch=mysqli_fetch_assoc($users_selected);
    $lat_to=$users_fetch['latitude'];
    $lng_to=$users_fetch['longitude'];
    $cou=$users_fetch['country'];
    $sid=$fee_fetch['id'];
       $res=fetch_miles($conn,$sid);
      
       $tot_miles=round($res,2);
       $m_fee=mile_fees($cou);
       $m_fee=json_decode($m_fee,true);
       $add=$m_fee['fee'];
       $times=$m_fee['fixed'];
       $calc=($tot_miles + $add) * $times;
       $arr[]=$calc;

}
$arr_sum=array_sum($arr);

}
?>


<section class="section_4_dropdown pickup_dropdown">
    <div class="dropdown_div"><span class="drop_desc">Delivery Options</span></div>
    <div class="dropdown_div"><strong class="selected_pickup">Select Delivery Option</strong><span class="select_delivery_icon">&#x25BC;</span>
    </div>
    <div class="options_dropdown">
        <label class="pickup_group pointer">
            <input name="deliver" id="self" type="radio">
            <label class="pickup_label pointer" for="self">Self pickup(no fee)</label>
            
</label>
<label class="pickup_group pointer">
            <input name="deliver" id="doorstep" type="radio">
            <label class="pickup_label pointer" for="doorstep">Deliver to doorstep<span style="display:none">( <?php
            echo '<span>'.$users_fetch['currency'].'</span>'."<span class='deliver_fee vip_fee'>$arr_sum</span>"; 
            ?>) </span>
            </label>
            
</label>
<hr>

<section style="display:none" class="entice_section">
    <strong style="font-size:0.9rem;">Do You Know?</strong>
    <ul>
        <li>With self pickup, you can save <?php echo '<span>'.$users_fetch['currency'].'</span>'."<span class='deliver_fee vip_fee'>$arr_sum</span>"; ?> on delivery fees.</li>
        <li>With self pickup, you can pickup your order at a time that is most convenient for you.</li>
    </ul>
</section>
    </div>
</section>
<?php
$user_id=$_COOKIE['user_id'];
$select="SELECT * FROM `users` WHERE `id` = $user_id";
$selected=mysqli_query($conn,$select);
if($selected){
    $fetch=mysqli_fetch_assoc($selected);
    $country=$fetch['country'];
    
}
$response=get_states($country);
$data=json_decode($response,true);
$label=$data['label'];
$states=$data['states'];
$select="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
$selected=mysqli_query($conn,$select);
if($selected){
    $fetch=mysqli_fetch_assoc($selected);
    $address=$fetch['address'];
}
?>
<section class="delivery_address_section deliver_to_doorstep">
<div class="address_section_group"><span class="drop_desc address_desc"><?php echo str_replace('.',',',$address).", ".$country; ?></span></div>
<div class="address_section_group toggle_address"><strong>&#9998;Update Delivery Address</strong><span class="address_entity">&#x25bc;</span></div>
<section class="update_section">
    <div class="cont">
        <input class="cont_input" type="text" placeholder=" ">
        <label class="float">Enter street address</label>
    </div>
    <div class="cont">
        <input class="cont_input" type="text" placeholder=" ">
        <label class="float">Apartment, suite etc(optional)</label>
    </div>
    <div class="cont">
        <input class="cont_input" type="text" placeholder=" ">
        <label class="float">Enter Zip Code</label>
    </div>
    <div class="cont">
        <input class="cont_input" type="text" placeholder=" ">
        <label class="float">Enter your city</label>
    </div>
    <div class="cont">
        <select class="cont_input">
       <?php echo $states; ?>
        </select>
        <label class="float"><?php echo $label; ?></label>
    </div>
    <button class="update_address_button pointer">UPDATE ADDRESS</button>

</section>


<!-- DELIVERY SECTION CLOSING TAG -->
</section>
<section class="breakdown_section deliver_to_doorstep">
    <?php
    $select="SELECT * FROM `users` WHERE `id` IN(SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `uniqid`='$uniqid'))";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $tot_fee=[];
        while($fetch=mysqli_fetch_assoc($selected)){
         $latitude1=$fetch['latitude'];
         $longitude1=$fetch['longitude'];
         $get="SELECT * FROM `users` WHERE `id`=$user_id";
         $nation=$fetch['country'];
         $response=mile_fees($nation);
         $data=json_decode($response,true);
         $fee=$data['fee'];
         $fixed=$data['fixed'];
         $gotten=mysqli_query($conn,$get);
         if($gotten){
             $carry=mysqli_fetch_assoc($gotten);
             $latitude2=$carry['latitude'];
             $longitude2=$carry['longitude'];
         }
        $distance=fetch_miles($conn,$fetch['id']);
        $distance=round($distance,2);
       $distance=($distance + $fee) * $fixed;
        $tot_fee[]=$distance;
        
       
        }
        $fee_sum=array_sum($tot_fee);
        $fee_sum=round($fee_sum,2);
        $currency=$carry['currency'];
        
       
    }
    
    
    ?>
<div class="breakdown_div"><span class="drop_desc">Delivery Fee</span> </div>
<div class="breakdown_div toggle_breakdown"><strong><?php echo "<span>".$currency."</span>"."<span class='deliver_fee'>$fee_sum</span>";?></strong><span class="breakdown_icon">&#x25bc;</span></div>
<section class="breakdown">
<!-- loop start -->
<?php
$select="SELECT * FROM `accounts` WHERE `user_id` IN(SELECT `user_id` FROM `products` WHERE `id` IN(SELECT `product_id` FROM `cart` WHERE `uniqid`='$uniqid'))";
$selected=mysqli_query($conn,$select);
if($selected){
   while($fetch=mysqli_fetch_assoc($selected)){
       $business_name=$fetch['business_name'];
       if(empty($business_name)){
           $business_name=$fetch['username'];
       }
       
       echo '<div class="store_loop">
       <input type="hidden" value="'.$fetch['user_id'].'" class="store_ids">
        <section class="store_loop_group">
        <div style="display:flex;align-items:center"><i style="color:#708090" class="material-icons store_details">
            store
        </i>
        <strong class="store_details">
            '.$business_name.'
        </strong>
</div>';
$sid=$fetch['user_id'];
$get="SELECT * FROM `users` WHERE `id`=$sid";
$gotten=mysqli_query($conn,$get);
if($gotten){
    $carry=mysqli_fetch_assoc($gotten);
    $lat1=$carry['latitude'];
    $long1=$carry['longitude'];
    $lat2=$latitude2;
    $long2=$longitude2;
}
$ind_dis=fetch_miles($conn,$sid);
$ind_dis=round($ind_dis,2);
$ind_fee=($fee + $ind_dis) * $fixed;
$ind_fee=round($ind_fee,2);
           echo '<div style="font-weight:bolder">
                <span><span>'.$currency.'</span><span class="ind_fee">'.$ind_fee.'</span></span>
</div>
</section>
<section class="store_loop_group">
    
<div style="text-indent:1rem;gap:0" class="drop_desc ind_miles">'.$ind_dis.' miles away</div>
</section>';
echo '<section class="store_loop_group inner_drop">
    
<div style="width:100%;display:flex;flex-direction:row;color:rgba(12,78,100.1);text-indent:1rem;font-size:0.7rem" class="drop_desc view_drop">';
$sid=$fetch['user_id'];
       $get="SELECT * FROM `cart` WHERE `product_id` IN(SELECT `id` FROM `products` WHERE `user_id`=$sid) AND `uniqid`='$uniqid'";
       $gotten=mysqli_query($conn,$get);
       if($gotten){
           $row=mysqli_num_rows($gotten);
       }
          
      
   echo '<span class="view ind_view pointer">view '.$row.' items</span><span class="view_icon">&#x25bc;</span>

</div>
<ul class="ind_ul">';
 while($carry=mysqli_fetch_assoc($gotten)){
   echo '<li>'.$carry['product_title'].'</li>';
 }
echo '</ul>
</section>

    </div>';
      
       
   }
}

?>
    
    <hr>
    <span class="drop_desc">Delivery fees are calculated based on distance from each store</span>
    <section class="entice_section save_tips" style="display:flex;flex-direction:column;">
    <strong style="font-size:0.9rem;"><span>&#127991;</span>Save on Delivery</strong>
    <span>Get all items from kevin stores and save $5 on delivery fees!</span>
    <span style="display:flex;flex-direction:row;align-items:center;color:green"><i style="font-size:0.9rem" class="material-icons">check</i>All items available at this store</span>
    <a style="color:inherit;font-size:0.7rem;font-weight:bold" href="#">View all items at kevin stores</a>
    
</section>

<!-- LOOP END -->

</section>
</section>
<?php
$fee=6;
$select="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `uniqid`='$uniqid'";
$selected=mysqli_query($conn,$select);
if($selected){
    $fetch=mysqli_fetch_assoc($selected);
    
}

$total=$fetch['total'];
$select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid'";
$selected=mysqli_query($conn,$select);
if($selected){
    $fetch=mysqli_fetch_assoc($selected);
    
}
$fee_sum=0;
$service_fee=($fee * $total)/100;
$grand=$service_fee + $total + round($fee_sum,2);
?>
<section class="subtotal_section">
<div class="subtotal_div"><span>Subtotal:</span><span><?php echo $fetch['currency']."<span class='total'>$total</span>"; ?></span></div>
<div class="subtotal_div"><span>Service Fee:</span><span><?php echo $fetch['currency']."<span class='service_fee'>$service_fee</span>"; ?></span></div>
<div class="subtotal_div deliver_to_doorstep"><span>Delivery Fee:</span><span><?php echo "<span>".$currency."</span>"."<span class='deliver_fee'>$fee_sum</span>";?></span></div>
<hr>
<div class="subtotal_div grand_total"><strong>Grand Total:</strong><strong><?php echo $fetch['currency']."<span class='all_total'>$grand</span>"; ?></strong></div>
<button class="checkout_button pointer"><span>&#128179;</span>PROCEED TO CHECKOUT</button>
</section>
        <!-- SECTION 4 CLOSING TAG -->
        </section> 
        

        <!-- END -->
    
  </section>
    <!-- END -->
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
         $cost=$cost+(6 * $cost)/100;
         
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
  <input type="hidden" value="" class="send_update_status">
  <section class="limit_parent">
       
      <div class="limit_child">
            <span class="warn"> &#9888;</span>
            <ul>
                
                
            </ul>
            <div class="limit_button_div">
                <button>Understood</button>
                <button style="background:red">Close</button>
                </div>
      </div>
    </section>
    <section class="confirm_reset_section">
        <div class="confirm_reset_child">
            <span style="margin-bottom:auto;width:100%;text-align:end;"><span  onclick="hide_confirm()" class="confirm_times">&#10006;</span></span>
            <span style="margin-top:25px" class="confirm_icon">&#128465;</span> 
            <strong>
                Are you sure you want to empty your cart?
            </strong>
            <span style="color:#708090;font-size:0.9rem">
                Please note:you would empty your cart, there is no way to undo this action.
            </span>
            <button onclick="reset_cart()">Yes, Empty Cart</button>
            <button onclick="hide_confirm()">
                Cancel
            </button>
        </div>
    </section>
     <section class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h2>Kasoowa</h2>
                <p>Discover authentic Intercontinental flavors and products, delivered right to your doorstep. Your trusted marketplace for quality African goods.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <div class="footer-links">
                <div>
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="#">Marketplace</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Top Products</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Sell on Kasoowa</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                         <li><a href="terms">Terms and Conditions</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-payment">
                <h3>Secure Payments</h3>
                <div class="payment-methods">
                    <div class="payment-icon">
                        <i class="fa-brands fa-cc-visa"></i>
                    </div>
                    <div class="payment-icon">
                        <i class="fa-brands fa-cc-mastercard"></i>
                    </div>
                    <div class="payment-icon">
                        <span style="font-weight: 600; color: #2d2d2d;">VERVE</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2024 Kasoowa. All rights reserved.</p>
        </div>
    </section>
    
    </main>
    <script src="cart.js?v=6.0"></script> 
   <script>
       function turn(){
      let loader=document.querySelector(".loader");
      loader.style.display="none";
  }
        window.onload=function(){
            turn();
     delete_loop(delete_icon);
     delete_loop(cart_remove);
    counter();
     delivery_dropdown();
    select_delivery();
    view_items();
    toggle_breakdown();
   toggle_delivery_address();
   update_address("<?php echo $country; ?>");
   <?php
   switch($country){
       case 'nigeria':
        case 'ghana':
        case 'cameroon':
        $url="checkout.php";
        break;
        default:
        $url="helcim.php";
        break;
   }
   
   
   
   ?>
    checkout("<?php echo $url; ?>");
    hide_limit_parent();
    loop_checkout("<?php echo $url; ?>");
     }
   </script>
   
    </body>
   </html>