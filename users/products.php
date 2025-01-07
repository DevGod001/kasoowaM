<?php
session_start();
include_once 'connect.php';
include_once 'general_process.php';
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
    
    
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="manifest" href="app.json">

     <style>
    *{
        font-family:Arial,sans-serif;
        font-family:Roboto;
         font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;

    }
        body,html{
            margin:0;
            padding:0;
        }
        body{
            background:whitesmoke;
            overflow-x:hidden; 
            
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

.section2::-webkit-scrollbar-thumb{
    background:black;
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
    .section2{
        display:grid;
    grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;
    place-items:center;
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
   .current_sort{
      padding:15px;
       width:100%;
       background:whitesmoke;
       display:flex;
       align-items:center;
       flex-direction:row;
   } 
    
     .current_sort span{
        color:#525252;
        font-size:0.8rem;
    }
    .filter_container{
        width:180px;
        height:40px;
        background:white;
        border:1px solid silver;
        margin:20px;
        margin-left:auto;
        display:flex;
        flex-direction:row;
        align-items:center;
        Justify-content:space-between;
        padding:5px;
        font-family:teachers ;
        position:relative;
        border-radius:5px;
    }
    .filter_container span{
        font-family:teachers ;
    }
    .filter_options{
        
        position:absolute;
        top:100%;
        left:0;
        right:0;
        border:1px solid silver;
        padding::5px;
        background:white;
        display:none;
        z-index:900;
    }
    .filter_container:hover .filter_options{
      display:flex;
      flex-direction:column;
    }
     .filter_options a{
         width:100%;
         border-bottom:1px solid silver;
         display:block;
         padding:5px;
         text-decoration:none;
         color:black;
         font-family:teachers;
         color:#545454;
         font-size:0.9rem;
     }
     .filter_options a:hover{
         background:#4caf50;
         color:white;
         border-color:white;
     }
     .products_card{
         width:170px;
         height:200px;
         border:1px solid silver;
         margin:10px 0;
         border-radius:5px;
         box-shadow:0px 4px 8px rgba(0,0,0,0.1);
         display:flex;
         flex-direction:column;
         align-items:center;
         padding:5px;
         
     }
     .section2{
         display:grid;
         grid-template-columns:1fr 1fr; 
         padding:20px 0px;
         
         place-items:center;
         background:white;
        
     }
     .product_image{
         width:100%;
         height:100px;
         
         border-radius:5px;
         background-size:cover;
         background-position:center;
         background-image:url('pepper.jpg');  
         position:relative;
     }
     .add_to_cart_button{
         width:60%;
         padding:5px;
         margin-top:auto;
         background:rgba(144,238,144,0.5);
         color:black;
         border:none;
         border-radius:100px;
         cursor:pointer;
         font-family:poppins;
         overflow:hidden;
         
     }
     .add_to_cart_button .material-icons{
         font-size:100%;
         color:black;
     }
      @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
     .product_title{
         width:100%;
         font-family:teachers;
         white-space:nowrap;
     }
     .product_price{
         margin-top:auto;
         font-family:poppins;
     }
     .featured{
         position:absolute;
         top:0%;
         right:-5%;
         background:gold;
         display:flex;
         align-items:center;
         padding:2px;
        border-radius:5px;
        
     }
     .featured *{
         user-select:none;
     }
     .featured span{
         font-family:teachers; 
         font-size:0.9rem; 
     }
     .featured .material-icons{
         font-size:0.9rem; 
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
         
         color:white;
         
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
     .stock{
         font-size:0.7rem;
         display:flex;
         align-items:center;
         justify-content:center;
         font-weight:bold;
         color:#545454;
         font-family:poppins;
         user-select:none;
     }
      .stock .material-icons{
         font-size:0.7rem;
         color:#4caf50;
     }
     </style>
<style>
    @media(min-width:800px){
        .section2{
         display:grid;
         grid-template-columns:1fr 1fr 1fr 1fr;
         padding:20px 88px;
         place-items:center;
         background:white;
         gap:30px;
        }
        .products_card{
         width:100%;
         height:340px;
         border:1px solid silver;
     }
     .product_image{
         width:100%;
         height:200px;
         
     }
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
          .section2{
         
         gap:0px; 
         
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
     .section2{
        
         grid-template-columns:1fr 1fr;
         
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
</style>
<style>
    .location_section{
        background:rgba(0,0,0,0.5);
        position:fixed;
        top:0;
        bottom:0;
        left:0;
        right:0;
         display:<?php 
        if(isset($_COOKIE['ip'])){
            echo "none";
        }
         else{
       echo "flex";
         }
        ?>;
        align-items:center;
        justify-content:center;
    }
    .location_div{
        padding:10px;
        background:white;
        width:90%;
        display:flex;
        flex-direction:column;
        align-items:center;
        border-radius:5px;
        box-shadow:0px 4px 8px rgba(0,0,0,0.5);
    }
   
    .location_div .material-icons{
        color:blue;
        text-shadow:0px 4px 8px rgba(0,0,0,0.3);
        animation:jump 2.5s linear infinite;
        
    }
    .location_div p{
        color:#708090;
        font-family:teachers;
    }
    .location_div h3{
        font-family:poppins;
        
    }
    @keyframes jump{
        0%,100%{
            transform:translateY(0px);
        }
        25%,75%{
            transform:translateY(5px);
        }
        50%{
            transform:translateY(10px);
        }
    }
    @media(min-width:800px){
     .location_div{
        
        width:500px;
    }   
    }
</style>
<style>
        .no-products-card {
            background: rgba(76, 175, 80, 0.2); /* Transparent primary color */
            color: #4caf50;
            padding: 20px;
            text-align: center;
            border: 1px solid #4caf50;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            width:200%;
            max-width: 400px;
            margin: 20px auto;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .no-products-card h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .no-products-card p {
            font-size: 1em;
            margin: 10px 0;
            line-height: 1.4;
        }

        .no-products-card .material-icons {
            font-size: 48px;
            color: #ff5722; /* Sad face color */
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .no-products-card .material-icons:hover {
            transform: scale(1.2); /* Reaction-like zoom */
            color: #e91e63; /* Change color on hover */
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
       <div class="mobile_action_div"><section class="profile_section"><i  style="margin-top:5px" class="material-icons entity" id="profile">&#9776;</i><div class="profile-links">
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
              
               
                <div class="other_div"><a class="anchor">Other Categories</a><i class="material-icons" >arrow_drop_down</i> <section class="others_show">
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
   <div class="filter_container">
       <span>Filter</span>
       <i class="material-icons">
           
           arrow_drop_down
       </i>
       <section class="filter_options">
           <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Default sorting</a>
           <a href="?featured=true&range=DESC">Best Selling</a>
           <a href="?sort=date&range=DESC">Sort by Latest</a>
           <a href="?price=DESC&sort=price&range=DESC">Sort by price:high to low</a>
           <a href="?price=ASC&sort=price&range=ASC">Sort by price:low to high</a>
       </section>
   </div>
   <section class="section2">
       <?php 
       if(!isset($_COOKIE['ip'])){
       if(!isset($_GET['sort'])){
       $select="SELECT * FROM `products` WHERE status='active' ORDER BY `featured`  DESC,RAND()";
       } 
        else{
            $sort=$_GET['sort'];
            $range=$_GET['range'];
            $select="SELECT * FROM `products` WHERE status='active' ORDER BY `featured`  DESC,$sort $range,RAND()";
        }
        if(isset($_GET['featured'])){
        $select="SELECT * FROM `products` WHERE `featured`='true' AND status='active' ORDER BY RAND()";
        }
        if(isset($_GET['category'])){
            $category_id=$_GET['category'];
            $select="SELECT * FROM `products` WHERE `category_id`=$category_id  AND status='active' ORDER BY `featured`  DESC,RAND()";
        }
        if(isset($_GET['store'])){
            $store_id=$_GET['store_id'];
           $select="SELECT * FROM `products` WHERE `user_id`=$store_id AND status='active' ORDER BY `featured`  DESC,RAND()"; 
        }
        
       }
        else{
            $ip=$_COOKIE['ip'];
            
            
            if(!isset($_GET['sort'])){
       $select="SELECT * FROM `products` WHERE (`city`='$city' OR `state`='$state' OR `country`='$ip') AND `country`='$ip' AND status='active' ORDER BY CASE 
       WHEN `city`='$city' THEN 1
       WHEN `state`='$state' THEN 2
       ELSE 3
       END,
       `featured`  DESC,RAND()"; 
       } 
        else{
            $sort=$_GET['sort'];
            $range=$_GET['range']; 
            $select="SELECT * FROM `products` WHERE (`city`='$city' OR `state`='$state' OR `country`='$ip') AND  status='active' ORDER BY
            CASE 
       WHEN `city`='$city' THEN 1
       WHEN `state`='$state' THEN 2
       ELSE 3
       END,`featured`  DESC,$sort $range,RAND()";
        }
        if(isset($_GET['price'])){
             $select="SELECT * FROM `products` WHERE (`city`='$city' OR `state`='$state' OR `country`='$ip') AND  status='active' ORDER BY
            CASE 
       WHEN `city`='$city' THEN 1
       WHEN `state`='$state' THEN 2
       ELSE 3
       END,`featured`  DESC,CAST(SUBSTRING_INDEX(`$sort`,',',1) AS UNSIGNED) $range,RAND()";
        }
        if(isset($_GET['featured'])){
        $select="SELECT * FROM `products` WHERE (`city`='$city' OR `state`='$state' OR `country`='$ip') AND `featured`='true' AND status='active' AND `country`='$ip' ORDER BY CASE 
       WHEN `city`='$city' THEN 1
       WHEN `state`='$state' THEN 2
       ELSE 3
       END,RAND()";
        }
        if(isset($_GET['category'])){
            $category_id=$_GET['category'];
            $select="SELECT * FROM `products` WHERE (`city`='$city' OR `state`='$state' OR `country`='$ip') AND `category_id`=$category_id  AND status='active' AND `country`='$ip'  ORDER BY CASE 
       WHEN `city`='$city' THEN 1
       WHEN `state`='$state' THEN 2
       ELSE 3
       END,`featured`  DESC,RAND()";
        }
        if(isset($_GET['store'])){
            $store_id=$_GET['store_id'];
           $select="SELECT * FROM `products` WHERE (`city`='$city' OR `state`='$state' OR `country`='$ip') AND `user_id`=$store_id AND status='active' AND `country`='$ip'  ORDER BY CASE 
       WHEN `city`='$city' THEN 1
       WHEN `state`='$state' THEN 2
       ELSE 3
       END,`featured`  DESC,RAND()"; 
        } 
        if(isset($_GET['query'])){
            $query=$_GET['query'];
            $query=trim($query);
            $explode=explode(" ",$query);
            $length=count($explode);
            $condition=[];
             for($i=0;$i < $length;$i++){
                 $condition[]="`title` LIKE '%$explode[$i]%'";
                 
             } 
             $condition=implode("AND",$condition);
             $select="SELECT * FROM `products` WHERE ($condition) AND `status`='active' AND `country`='$ip' ORDER BY CASE
             WHEN `city`='$city' THEN 1
             WHEN `state`='$state' THEN 2
             ELSE 3
             END,`featured` DESC,RAND()";
            
        }
        }
        
       $selected=mysqli_query($conn,$select);
       $row=mysqli_num_rows($selected);
       if($row > 0){
       while($fetch=mysqli_fetch_assoc($selected)){
          
       $photos=$fetch['photos'];
       $photos=explode(",",$photos);
       switch($fetch['featured']){
           case 'true':
           $display="flex"; 
           break;
           default:
               $display="none";
               break; 
       }
       if(isset($_COOKIE['cart_id'])){
        $uniqid=$_COOKIE['cart_id'];
        }
         else{
             $uniqid="xxxxxxx";
         }
         
       $product_id=$fetch['id'];
       $select_cart="SELECT * FROM `cart` WHERE `uniqid`='$uniqid' AND `product_id`=$product_id";
       $cart_selected=mysqli_query($conn,$select_cart);
       $cart_row=mysqli_num_rows($cart_selected);
       if($cart_row > 0){
           $color="rgba(238,144,144,0.3)";
           $innerText='<i class="material-icons">shopping_cart</i>Remove from Cart';
       }
        else{
             $color="rgba(144,238,144,0.3)";
             $innerText='<i class="material-icons">shopping_cart</i>Add to Cart';
        }
       $price=$fetch['price'];
       $price=explode(',',$price);
       $min=min($price);
       $max=max($price);
       $tot=count($price);
       if($tot == 1){
           $dis="none";
           $dash="";
       }
         else{
             $dis="";
             $dash=" - ";
         }
         
       echo '<div style="cursor:pointer" class="products_card" onclick="window.location.href=&quot;product_details?pid='.$fetch['id'].'&search='.$fetch['title'].'&quot;">
           <div class="product_image" style="background-image:url(&quot;'.$photos[0].'&quot;)">
           <input class="photo" type="hidden"  value="'.$photos[0].'">
               <span class="featured" style="display:'.$display.'">
                   <i class="material-icons">diamond</i><span>Best selling</span>
                   <input type="hidden" value="'.$fetch['id'].'" class="product_id">
               </span>
           </div>
           <strong style="color:green;"  class="product_title">
               '.$fetch['title'].'
           </strong>
           <span class="stock"><i class="material-icons">check_circle</i>In stock</span>
           <span class="product_price"><span class="currency" style="color:black;font-size:0.8rem">'.$fetch['currency'].'</span><span style="font-size:0.8rem" class="product_cost">'.$min.'</span>'.$dash.'<span class="currency" style="display:'.$dis.';color:black;font-size:0.8rem">'.$fetch['currency'].'</span><span style="display:'.$dis.';font-size:0.8rem" class="product_cost">'.$max.'</span></span>
           <button class="add_to_cart_button" onclick="window.location.href=&quot;product_details?pid='.$fetch['id'].'&search='.$fetch['title'].'&quot;"><i style="font-size:0.7rem;" class="material-icons">shopping_cart</i>Select Options</button>
       </div>';
       }
       }
        else{
            echo '<div class="no-products-card">
        <i class="material-icons">sentiment_very_dissatisfied</i>
        <h2>No Products Available</h2>
        <p>Sorry, we could not find any products in this category from your region.</p>
    </div>';
        }
       
       ?>
      
   </section>
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
   <section class="location_section">
    <div class="location_div">
        <i class="material-icons">
            location_on
        </i>
        <h3>Verifying Region</h3>
     <p>verifying your location to better show you products from your region,please wait....</p>
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
    
   <!-- script for variables and functions -->
   <script>
     //variables
     let product_card=document.getElementsByClassName("products_card");
     let product_title=document.getElementsByClassName("product_title");
     let add_button=document.getElementsByClassName("add_to_cart_button");
     let product_image=document.getElementsByClassName("product_image");
     let product_cost=document.getElementsByClassName("product_cost");
     let product_id=document.getElementsByClassName("product_id");
     let product_currency=document.getElementsByClassName("currency");
     let photo=document.getElementsByClassName("photo");
     let cart_number=document.getElementById("cart_number");
     let mobile_cart_number=document.getElementById("mobile_cart_number");
     let loading=document.getElementById("loading");  
     //function to fit title
     function fit_title(){
         for(let p=0;p < product_card.length;p++){
             let max_width=product_card[p].offsetWidth  - 10;
             
             if(product_title[p].scrollWidth > max_width){
                 let inner_text=product_title[p].innerText;
                 while(product_title[p].scrollWidth > max_width && inner_text.length > 0){
                     inner_text=inner_text.slice(0,-1);
                    product_title[p].innerText=inner_text + "....";
                     
                 }
             }
         }
     }
  // function to format price
  function format_price(){
      for(let f=0;f < product_cost.length;f++){
          let new_number=parseInt(product_cost[f].innerText);
          product_cost[f].innerText=new_number.toLocaleString(); 
      }
  }
     
     
     
   </script>
    <script>
        let search_input=document.querySelector(".search_input");
        let search_suggest=document.querySelector(".search_suggest");
        
           search_input.addEventListener("input",function(){
               if(search_input.value==""){
                   search_suggest.style.display="none";
                   return;
               }
           let xhl=new XMLHttpRequest();
           xhl.open("GET","general.php?search_store=true&search="+encodeURIComponent(search_input.value),true);
           xhl.onreadystatechange=function(){
               if(xhl.readyState==4 && xhl.status==200){
                   search_suggest.style.display="flex";
                   if(xhl.responseText.trim()==""){
                       search_suggest.innerHTML=`<a><span>No results found.....</span></a>`;
                       return;
                   }
                   search_suggest.innerHTML=xhl.responseText;
               }
           }
           xhl.send();
           });
           
    </script>
   <!-- script tag for calling functions -->
   <script>
       fit_title();
       format_price();
   </script>
   <script>
        // Function to initialize location and alert the country
        
        function initializeLocation() {
            fetch('https://ipapi.co/json/')
                .then(response => response.json())
                .then(data => {
                    // Get country from the response
                    const country = data.country_name;
let xhc=new XMLHttpRequest();
xhc.open("GET","product_process.php?location=" + encodeURIComponent(country),true);
xhc.onreadystatechange=function(){
    if(xhc.status==200 && xhc.readyState==4){ 
        if(xhc.responseText.includes("error")){
            window.location.href="about:blank";
            return;
        }
        
        let location_section=document.querySelector(".location_section");
        if(xhc.responseText.includes("success")){
            window.location.reload();
           
        }
        
    }
}
xhc.send();
                    // country output end
                })
                .catch(error => {
                    console.error("Error fetching location:", error);
                    alert("Unable to detect location automatically");
                    window.location.href="about:blank";
            return;
                });
        }

        // Call the function when the page loads
     
        let ip_cookie_set=document.cookie.split(";");
        let ip_cookie_isset=false; 
        for(let q=0;q < ip_cookie_set.length;q++){
            if(ip_cookie_set[q].trim().startsWith("ip=")){
               ip_cookie_isset=true; 
            }
        }
        if(!ip_cookie_isset){
            
           initializeLocation(); 
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
                    cart_product[r].style.display="none";
                     loading.style.display="none";
                    total_items.innerText=parseInt(total_items.innerText) - parseInt(cart_quantity[r].innerText);
                    
                    let next_cost=parseInt(hidden_sub_cost.value) - (parseInt(hidden_cart_cost[r].value) * parseInt(cart_quantity[r].innerText));
                    next_cost=next_cost - (5 * parseInt(hidden_cart_cost[r].value))/100;
                    hidden_sub_cost.value=next_cost;
                    next_cost=next_cost.toLocaleString();
                    sub_cost.innerText=next_cost;
                     mobile_cart_number.innerText=parseInt(mobile_cart_number.innerText) - parseInt(cart_quantity[r].innerText);
                    
                     cart_number.innerText=parseInt(cart_number.innerText) - parseInt(cart_quantity[r].innerText);
                    
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
   
    </body>
   </html>