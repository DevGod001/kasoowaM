<?php
session_start();
include_once 'connect.php';
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
    <title>HomePage</title>
    
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
            position:relative;
            
        }
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
            
            border:1px solid silver;
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
        .nav{
            width:100%;
            background:#4caf50;
            text-align:center;
            margin:auto;
          color:white;
          padding-bottom:20px;
        }
        .nav h2 {
    margin: 0;
    padding: 20px 0;
}
.nav_links{
    background-color: white;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
        transition: background-color 0.3s;
        border:none;
        font-weight:bold;
        min-width:150px;
        max-width:150px;
}
.nav_links:hover{
   background:#D6C700;
   color:white;
}
#link_grid{
   display:grid;
   grid-template-columns:1fr 1fr;
 place-items: center;
        max-width: 800px;
        gap: 10px;
        margin: 0 auto;
        
    
}
a{
    text-decoration:none;
    color:inherit;
}
#categories{
    position:relative;
}
.categories-dropdown{
    position:absolute;
    background:white;
    border: 1px solid #ccc;
    min-width: 200px;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 10;
    top: 100%;
    left: 0;
    max-height:300px;
    display:none;
    flex-direction:column;
    align-items:center;
    overflow-y:hidden;
}
.categories-dropdown a{
    padding:10px;
    display:block;
    width:100%;
}
#categories:hover .categories-dropdown{
    display:flex;
}
 .categories-dropdown a:hover {
            background-color: #4caf50;
            color:white;
        }
#categories:hover .categories-dropdown{
    color:black;
}
*{
    box-sizing:border-box;
}
.section2{
    background:white;
    width:95%;
    height:auto;
    overflow-x:auto;
    padding:15px 5px;
    display:grid;
    grid-template-columns:1fr 1fr;
    place-items:center;
    gap:5px;
   margin-bottom:20px;
  margin: 0 auto;
  grid-row-gap:20px;
}
.section2::-webkit-scrollbar-thumb{
    background:black;
}
.s2_div{
    height:100%;
   width:160px;
    padding:3%;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:space-between;
    gap:5px;
    border:1px solid silver;
    border-radius:10px;
    overflow:hidden;
    transition:transform 1s;
    box-shadow:0px 4px 8px rgba(0,0,0,0.1);
    
}
.s2_div:hover{
   transform:scale(1.02);
}

.product-img{
   width:100%;
   border-radius:10px;
   height:100px;
   background-size:cover;
   background-position:center;
}
.price{
    font-weight:bold;
    margin-bottom:5px;
    width:100%;
    font-family:poppins;
    display:flex;
    flex-direction:row;
    align-items:center;
    justify-content:center;
}
.add_to_cart{
    background:#4caf50;
    color:white;
    border:none;
    border-radius:5px
    display:block;
    width:100%;
    height:40px;
    border-radius:100px;
    font-weight:bold;
}
h3{
    padding:0px 10px;
     padding-left:4vw;
}
.product_name{
    margin-top:auto;
    width:100%;
     font-family:lato;
     font-size:0.8rem;
     font-family:poppins;
}
.product_detail{
     display:flex;
    flex-direction:row;
    align-items:center;
    justify-content:space-between;
    width:100%;
    
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
     .categories_card{
         
        
         width:100%;
         max-width:100%;
         height:200px;
         background:white;
         box-shadow:0px 4px 8px rgba(0,0,0,0.2);
         display:flex;
         flex-direction:row;
         align-items:center;
         justify-content:space-between;
         padding:5px 7px;
         background-size:cover;
         background-position:center;
         background-image:url('../assets/WhatsApp Image 2024-10-26 at 21.43.43_3bf58dc7.jpg');
         transition:transform 0.5s;
     } 
     .categories_card:hover{
         transform:scale(1.02);
     }
     .section2{
         display:flex;
         flex-direction:column;
         align-items:center;
         background:transparent;
         gap:10px;
     }
     .category-icon{
         width:100px;
         height:100px;
         background-size:cover;
         background-position:center;
         background-image:url('../icons/ei_1729967614764-removebg-preview.png');
         float:right;
         border-radius:50%;
         
     }
     .shop_now{
         max-width:100px;
         height:auto;
         padding:2px;
         background:lightgreen;
         border:1px solid green;
         border-radius:100px;
         color:black;
         font-family:poppins;
         overflow:hidden;
     }
     .name_div{
         display:flex;
         flex-direction:column;
         width:150px;
     }
     .name_cat{
         font-family:poppins;
     }
     
     .anchor{
         width:100%;
     }
     .flyers{
         height:220px;
         overflow:hidden;
         margin:5px 0px;
     }
     .banner{
         width:100%;
         height:100%;
         background-size:cover;
         
         background-position:center;
         
         animation:change 5s linear infinite;
     }
     #colorSection {
            width: 94%;
            height: 200px;
            position: relative;
            overflow: hidden;
            margin:10px auto;
        }

        .colorDiv {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            transition: left 1s ease;
            background-position:center;
            background-size:cover;
            background-size:100% 100%;
        }
    .pc_only{
        display:none;
    }
    .pc_steps{
            display:flex;
            flex-direction:column;
           
           
            width:100%;
            padding:5px;
            
            
            
        }
        .pc_steps:hover{
            background:rgba(144,238,144,0.1);
        }
        .pcheader{
            display:flex;
            align-items:center;
            gap:20px;
            
        }
        .pcheader .material-icons{
            background:green;
            color:white;
            border-radius:50%;
            padding:10px;
        }
        .pcheader .material-icons:hover{
            background:lightgreen;
        }
        .pclinks{
            width:100vw;
            height:auto;
            background:white;
            box-shadow:0px 4px 8px rgba(0,0,0,0.2);
            border-radius:5px;
            display:flex;
            gap:5px;
            flex-direction:column;
            align-items:center;
            justify-content:space-between;
            padding:10px;
        }
        .pc_steps:hover{
            background:rgba(144,238,144,0.1);
        }
        .pcheader .material-icons:hover{
            background:lightgreen;
        }
      @media(min-width:800px){
         #colorSection{
            display:none;
        }
      #pc_Section {
            width: 60%;
            height: 400px;
            position: relative;
            overflow: hidden;
            margin:10px auto;
        }
        .pc_only{
            width:100%;
           
            display:flex;
           
            align-items:center;
            justify-content:space-between;
            padding:0vw 2.5vw;
        }
        .pc_steps{
            display:flex;
            flex-direction:column;
            
           
            width:100%;
            height:100px;
            padding:5px;
           
            
            
        }
        .pc_steps:hover{
            background:rgba(144,238,144,0.1);
        }
        .pcheader{
            display:flex;
            align-items:center;
            gap:20px;
            
        }
        .pcheader .material-icons{
            background:green;
            color:white;
            border-radius:50%;
            padding:10px;
        }
        .pcheader .material-icons:hover{
            background:lightgreen;
        }
        .pclinks{
            
            flex-direction:row;
            
            
        }

        .pc_Div {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            transition: left 1s ease;
            background-position:center;
            background-size:cover;
            background-size:100% 100%;
        }
      .section2{
         display:grid;
        grid-template-columns:1fr 1fr 1fr;
        
        gap:20px;
        overflow:hidden;
                 max-width:100vw;
               
     }
      .categories_card{
         
         width:100%;
         max-width:100%;
         
         
     } 
     .anchor{
         width:100%;
     }
     .ads{
         width:100%;
         height:220px;
     }
      }
     @media(max-width:799px){
         .section2 > *:nth-child(3) {
    margin-bottom: 20px;
}
.section2 >*:nth-child(6)[
margin-bottom:20px;
     }
    </style>
    <style>
    

        .chat-container {
            position: fixed;
            bottom: 70px; /* Adjust to be above the floating icon */
            right: 20px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: none; /* Initially hidden */
            z-index: 1000; /* Ensure it appears above other content */
        }

        .chat-header {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            cursor: pointer;
            text-align: center;
        }

        .chat-messages {
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px; /* Space between messages */
        }

        .message {
            padding: 8px;
            border-radius: 5px;
            max-width: 70%;
        }

        .sent {
            background-color: #dcf8c6; /* Light green for sent messages */
            align-self: flex-end; /* Align to the right */
        }

        .received {
            background-color: #f1f1f1; /* Light gray for received messages */
            align-self: flex-start; /* Align to the left */
        }

        .chat-input {
            display: flex;
            padding: 10px;
        }

        .chat-input input {
            flex: 1;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 100px); /* Adjust width */
        }

        .chat-input button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px; /* Spacing */
        }

        .chat-input button:hover {
            background-color: #45a049;
        }

        .floating-chat {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4caf50;
            color: white;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000; /* Ensure it appears above other content */
        }

        .floating-chat:hover {
            background-color: #45a049;
        }

        .quick-replies {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin: 10px;
        }

        .quick-reply {
            background-color: #e0e0e0;
            padding: 5px 10px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .quick-reply:hover {
            background-color: #d0d0d0;
        }
        .submit_message{
            border-radius:50%;
        }
    </style>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
            display:flex;
            flex-direction:column;
        }

        /* Remove page container for banner */
        .banner-wrapper {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            background: #fff;
            padding: 20px 0;
        }

        .banner-container {
            width: 100%;
            height: 250px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .banner-slider {
            display: flex;
            width: 400%;
            height: 100%;
            animation: slide 50s infinite;
        }

        .banner-slide {
            width: 25%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
        }

        .banner-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            25% { transform: translateX(-25%); }
            50% { transform: translateX(-50%); }
            75% { transform: translateX(-75%); }
            100% { transform: translateX(0); }
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .banner-container {
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .banner-container {
                height: 180px;
            }
             .page-container{
                display:none;
            }
        }

        @media (max-width: 480px) {
            .banner-container {
                height: 150px;
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
.order-process *{
    font-style:normal;
    white-space:wrap;
}
        .order-process {
            width: 100%;
            background-color: #f8f9fa;
            padding: 2.5rem 0;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .process-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 4rem;
            padding: 0 2rem;
        }

        .process-step {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s ease;
        }

        .process-step:hover {
            transform: translateY(-2px);
        }

        .step-icon {
            background-color: #008800;
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .step-icon i {
            font-size: 1.25rem;
        }

        .process-step:hover .step-icon {
            background-color: #006600;
            box-shadow: 0 4px 12px rgba(0, 136, 0, 0.2);
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            color: #008800;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            transition: color 0.2s ease;
        }

        .process-step:hover .step-title {
            color: #006600;
        }

        .step-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.4;
            margin: 0;
        }

        @media (max-width: 768px) {
            .process-container {
                flex-direction: column;
                gap: 2rem;
                padding: 0 1.5rem;
            }

            .process-step {
                width: 100%;
            }

            .step-icon {
                width: 40px;
                height: 40px;
            }

            .step-icon i {
                font-size: 1rem;
            }
        }
    </style>
<style>
        .shops_name_section{
            background:white;
            position:fixed;
            top:0;
            bottom:0;
            right:100%;
            box-shadow:0px 4px 8px rgba(0,0,0,0.2);
            padding:10px;
            overflow-y:auto;
            transition:right 0.5s;
           
            right:100%;
            z-index:3000;
            color:black;
        }
        .shops_list{
            width:100%;
            height:100%;
           
        }
        .shops_list strong{
            color:#4caf50;
            font-family:poppins;
        }
        .stores_ul{
            Padding:0;
           list-style-type:none;
           font-family:poppins;
        }
        .store_pic{
            width:40px;
            height:40px;
            min-height:40px;
            min-width:40px;
            border:2px solid #4caf50;
            border-radius:50%;
            background-size:cover;
            background-position:center;
        }
        .stores_ul li{
            display:flex;
            align-items:center;
            gap:5px;
            border-bottom:1px solid silver;
            padding:10px 0;
        }
        .stores_ul li span{
            text-align:start;
            font-family:teachers;
        }
        .stores_ul li:hover{
            background:#f1f1f1;
        }
        .shops_head{
            width:100%;
            display:flex;
            align-items: center;
            justify-content:space-between;
        }
        .shops_hide{
            color:#4caf50;
            font-size:1.5rem;
            cursor:pointer;
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
        .section_d{
            background:white;
            padding:10px;
            position:fixed;
            top:0;
            left:0;
            right:0;
            box-shadow:0px 4px 8px rgba(0,0,0,0.2);
            display :flex;
            flex-direction:row;
            align-items:center;
            gap:20px;
             z-index:1000;
        }
        .download_logo{
            height:30px;
        }
        .download_site_logo{
            height:40px;
            width:100px;
            background-image:url('https://test.kasoowa.com/assets/kasoowa.png');
            background-position:center;
            background-size:cover;
        }
        .download_button{
            padding:10px 20px;
            background:linear-gradient(to right,green,lightgreen);
            border:none;
            border-radius:5px;
            color:white;
            font-weight:bold;
            margin-left:auto;
        }
        .download_span{
            font-family:teachers;
            font-size:0.8rem;
        }
        .cart_container{
            position:relative;
        }
        @media(min-width:800px){
            .section_d{
                display:none;
            }
        }
        @media(display-mode:standalone){
            .section_d{
                display:none;
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
        .cart_section *{
            font-style:normal;
            font-size:0.9rem;
             
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
         .cart_products *{
             color:black;
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
                .profile_section{
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
        }
         .search_suggest a *{
           
            font-family:teachers;
            color:#708090;
        }
        .search_suggest a:hover{
            background:rgba(144,255,144,0.3);
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
                window.location.href="users/products?query="+ encodeURIComponent(search_product.value);
            }
        }
    </script>
<body>
     <section class="loader">
        <div class="turn">
            
        </div>
    </section>
    <header>
        <section class="logo"><img onclick="window.location.href='/'" class="site_logo" style="height:100px" src="../assets/kasoowa.png"></section>
       <form action="users/products" class="search_position"><label class="search"> <input name="query" class='search_input' type="search" placeholder="Search for categories, brands or products...."><i onclick="search_product('.search_input')" class="material-icons">search</i>
        </label>
        <section class="search_suggest">
        
        </section>
      </form>
       <div class="action_div">
           <?php
           if(!isset($_COOKIE['home_user_id'])){
           echo '<section class="profile_section"><i style="font-size:1.0rem" class="material-icons" id="profile">&#128100;</i><div class="profile-links"> <a href="users/register"><i class="material-icons">person_add</i>
Sign up</a>
      
       
        <a href="users/login"><i class="material-icons">login</i>
Login</a></div></section>';
           }
             else{
       echo '<section class="profile_section"><i id="check" class="material-icons">verified</i><i class="material-icons entity" id="profile">&#128100;</i><div id="logged_profile_links" class="profile-links">
       <a href="users/products"><i class="material-icons">shop</i>Shop</a>
       <a href="users/cart"><i class="material-icons entity">&#128722;</i>Cart</a>
       <a href="users/account"><i class="material-icons">person</i>My Account</a>
      
       
        <a style="border-top:0.1px solid #4caf50;justify-content:center" href="users/logout"><i class="material-icons">exit_to_app</i>Logout</a></div></section>';
             }
        ?>
         <?php
        if(isset($_COOKIE['home_cart_id'])){
        $uniqid=$_COOKIE['home_cart_id'];
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
        <section class="cart_container"><i class="material-icons entity">&#128722;</i><div id="mobile_cart_number"><?php echo $cart_row; ?></div></section> 
        
        
        
        </div>
    </header><main>
        <section class="section_d">
       <span class="download_cancel">&times</span> 
       
       <div class="download_site_logo">
           
       </div>
       <span class="download_span">Download our app and enjoy real time notifications on your orders</span>
       <button onclick="window.location.href='users/app'" class="download_button">
           DOWNLOAD
       </button>
    </section>
    <section class="nav">
        <h2 style="margin:0px 4vw;">Discover Authentic Intercontinental Flavors</h2>
        <div id="link_grid">
            <button class="nav_links"><a href="users/products">Marketplace</a></button>
   <button class="nav_links"><a href="users/register">Sell on Kasoowa</a></button>
   <button id="show_shops_button" class="nav_links"><a>Shop by Store</a></button>
   <section class="shops_name_section">
        <div class="shops_list">
            <span class="shops_head"><strong>Select a Store</strong><span class="shops_hide">&times</span> </span>
        <ul class="stores_ul">
           
        </ul>
        </div>
    </section>
       <button class="nav_links"><a href="#">Shop by Origin</a></button>
     <button class="nav_links" id="categories">Categories
     <div class="categories-dropdown">
          
         <?php
         $select="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
$selected=mysqli_query($conn,$select);

         while($fetch=mysqli_fetch_assoc($selected)){
                       
                       echo '<a href="users/products?category='.$fetch['id'].'">'.$fetch['name'].'</a>';
                        
                       
         }
                        ?>
                    </div>
     </button>
      <button class="nav_links"><a href="#">New Arrivals</a></button>
       <button class="nav_links"><a href="#">Top products</a></button>
       
     <button class="nav_links">Drive for Kasoowa</button>
      
    </div>
    </section>
    <section id="colorSection" onclick="window.location.href='users/products'">
        <div class="colorDiv" style="background-image:url('../banners/mob1.jpg'); left: 0;"></div>
        <div class="colorDiv" style="background-image:url('../banners/mob2.jpg'); left: 100%;"></div>
        <div class="colorDiv" style="background-image:url('../banners/mob3.jpg'); left: 100%;"></div>
        <div class="colorDiv" style="background-image:url('../banners/mob4.jpg'); left: 100%;"></div>
    </section>
   
        <div class="page-container">
        <div class="banner-wrapper">
            <div class="banner-container">
                <div class="banner-slider" onclick="window.location.href='users/products'">
                    <div class="banner-slide">
                        <img src="../banners/des1.jpg" alt="Placeholder 1"/>
                    </div>
                    <div class="banner-slide">
                        <img src="../banners/des2.jpg" alt="Placeholder 2"/>
                    </div>
                    <div class="banner-slide">
                        <img src="../banners/des3.jpg" alt="Placeholder 3"/>
                    </div>
                    <div class="banner-slide">
                        <img src="../banners/des4.jpg" alt="Placeholder 4"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
           
 <section class="pc_only">
    <section style="display:none" id="pc_Section">
        <div class="pc_Div" style="background-image:url('../banners/desktop1.jpg'); left: 0;"></div>
        <div class="pc_Div" style="background-image:url('../banners/banner2.jpg'); left: 100%;"></div>
        <div class="pc_Div" style="background-image:url('../banners/banner3.jpg'); left: 100%;"></div>
        <div class="pc_Div" style="background-image:url('../banners/flyer1.jpg'); left: 100%;"></div>
    </section>
    <div style="display:none" class="pclinks">
        <div class="pc_steps">
            <span class="pcheader">
          <i class="material-icons entity" >
              &#128722;
          </i><strong style="font-family:poppins;">Place an Order</strong>
          </span>
          <p style="color:#666;font-family:poppins;font-size:0.8rem">Choose your preferred items and add them to your cart.</p>
        </div>
        
        <div class="pc_steps">
            <span class="pcheader">
          <i class="material-icons" >
              payment
          </i><strong style="font-family:poppins;">Secure Payment</strong>
          </span>
          <p style="color:#666;font-family:poppins;font-size:0.8rem">Checkout your order with our secure payment options.</p>
        </div>
        <div class="pc_steps">
            <span class="pcheader">
          <i class="material-icons" >
              local_shipping
          </i><strong style="font-family:poppins;">Delivery Options</strong>
          </span>
          <p style="color:#666;font-family:poppins;font-size:0.8rem">Select your preferred method:pickup or have it delivered to your doorstep instantly.</p>
        </div>
    </div>
    </section>
    <h3>Top Categories</h3>
    <section class="section2">
        <?php
        $select="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC LIMIT 6";
        $selected=mysqli_query($conn,$select);
        while($fetch=mysqli_fetch_assoc($selected)){
        echo '<a href="users/products?category='.$fetch['id'].'&search='.$fetch['name'].'" class="anchor">
        <div class="categories_card">
            <div class="name_div">
                <span class="name_cat">'.$fetch['name'].'</span>
            <button class="shop_now">Shop Now</button>
            
            </div>
            <div class="category-icon" style="background-image:url(&quot;'.$fetch['icon'].'&quot;)"></div>
        </div>
        </a>';
        }
        ?>
    </section>
    <div class="floating-chat" onclick="toggleChat()">
        <span class="material-icons">chat</span>
    </div>

    <div class="chat-container" id="chatBox">
        <div class="chat-header">
           Kasoowa Customer Support
        </div>
        <div class="quick-replies" id="quickReplies">
            <div class="quick-reply" onclick="setMessage('Hello! How can I help you?')">Hello!</div>
            <div class="quick-reply" onclick="setMessage('I have a question about my order.')">Order Question</div>
            <div class="quick-reply" onclick="setMessage('Can you help me with my account?')">Account Help</div>
        </div>
        <div class="chat-messages" id="messages"></div>
        <div class="chat-input">
            <textarea id="messageInput" ></textarea>
            <button id="send_support" style="border:none;background:transparent;border-radius:50%;display:flex;align-items:center;justify-content:center" class="submit_message" ><i style="color:green;" class="material-icons">send<i></button>
        </div>
    </div>
   
   
   
   <div class="order-process">
        <div class="process-container">
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">Place an Order</div>
                    <p class="step-description">Choose your preferred items and add them to your cart.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">Secure Payment</div>
                    <p class="step-description">Checkout your order with our secure payment options.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">Delivery Options</div>
                    <p class="step-description">Select pickup or doorstep delivery for your order.</p>
                </div>
            </div>
        </div>
    </div>
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
         <div class="cart_action_div"><strong style="font-family:poppins;color:black">
             Subtotal
         </strong><span style="font-family:poppins"><span style="font-family:poppins;color:black"><?php
                    $select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid' ORDER BY `date` DESC LIMIT 50";
                    $selected=mysqli_query($conn,$select);
                    $row=mysqli_num_rows($selected);
                     $carry=mysqli_fetch_assoc($selected);
                    $currency=$carry['currency'];
         
         echo $currency; ?></span><span style="color:black" class="sub_cost"><?php echo $cost; ?></span><input type="hidden" id="hidden_sub_cost" value="<?php echo $cost; ?>"></span></div> 
         </section>
         <div class="cart_checkout_div">
             <button onclick="window.location.href='users/cart'">
            Checkout
        </button>
        <button onclick="window.location.href='users/cart'">
            View Cart
        </button> 
        
         
       </div>
       
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
                        <li><a href="users/terms">Terms and Conditions</a></li>
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
    <script>
        let search_input=document.querySelector(".search_input");
        let search_suggest=document.querySelector(".search_suggest");
        
           search_input.addEventListener("input",function(){
               if(search_input.value==""){
                   search_suggest.style.display="none";
                   return;
               }
           let xhl=new XMLHttpRequest();
           xhl.open("GET","users/general.php?search_categories=true&search="+encodeURIComponent(search_input.value),true);
           xhl.onreadystatechange=function(){
               if(xhl.readyState==4 && xhl.status==200){
                   
                   search_suggest.style.display="flex";
                   if(xhl.responseText==""){
                       search_suggest.innerHTML=`<a><span>No result found.....</span></a>`;
                       return;
                   }
                   search_suggest.innerHTML=xhl.responseText;
               }
           }
           xhl.send();
           });
           
    </script>
    <script>
        let download_cancel=document.querySelector(".download_cancel");
        let section_d=document.querySelector(".section_d");
        download_cancel.addEventListener("click",function(){
            section_d.style.display="none";
        })
    </script>
   
    <script>
    
        let currentIndex = 0;
        const divs = document.querySelectorAll('.colorDiv');

        function showNextDiv() {
            divs[currentIndex].style.left = '-100%'; // Slide out the current div

            currentIndex = (currentIndex + 1) % divs.length; // Update index

            divs[currentIndex].style.left = '100%'; // Start next div off-screen
            setTimeout(() => {
                divs[currentIndex].style.left = '0'; // Slide into view
            }, 10); // Allow a brief moment before sliding in
        }

        setInterval(showNextDiv, 4000); // Change every 3 seconds
    </script>
     
     <script>
       let currentPCIndex = 0;
const pcDivs = document.querySelectorAll('.pc_Div');

// Initial setup for positioning all divs offscreen to the right, except the first one
pcDivs.forEach((div, index) => {
    div.style.left = index === 0 ? '0' : '100%';
});

function showNextPCDiv() {
    // Move the current div out of view to the left
    pcDivs[currentPCIndex].style.left = '-100%';

    // Update index to the next div and loop back if at the end
    currentPCIndex = (currentPCIndex + 1) % pcDivs.length;

    // Reset the position of the new current div to off-screen on the right
    pcDivs[currentPCIndex].style.left = '100%';

    // Allow a brief delay, then bring the new current div into view
    setTimeout(() => {
        pcDivs[currentPCIndex].style.left = '0';
    }, 10); 
}

// Change every 4 seconds
setInterval(showNextPCDiv, 4000);

     </script>
     <script>
        function autosend(message){
           document.getElementById("send_text").value=message;
        }
    </script>
    
    <script>
        let firstMessageSent = false; // Track if the first message has been sent

        function toggleChat() {
            const chatBox = document.getElementById('chatBox');
            chatBox.style.display = (chatBox.style.display === 'none' || chatBox.style.display === '') ? 'block' : 'none';

            // Clear input when chat box opens
            if (chatBox.style.display === 'block') {
                document.getElementById('messageInput').value = '';
            }
        }

        function setMessage(message) {
            document.getElementById('messageInput').value = message;
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const messages = document.getElementById('messages');

            if (input.value.trim() !== '') {
                const message = document.createElement('div');
                message.className = 'message sent'; // Set class for sent message
                message.textContent = input.value;
                messages.appendChild(message);
                input.value = '';
                messages.scrollTop = messages.scrollHeight; // Scroll to bottom

                // Auto-reply on the first message
                if (!firstMessageSent) {
                    firstMessageSent = true; // Mark first message as sent
                    setTimeout(() => {
                        receiveMessage("Thank you for your message! a support agent would get in touch with you soon,you can go through our faqs while waiting <a style='color:blue' href='faq'>https://test.kasoowa.com/users/faq</a>");
                    }, 500); // Delay for effect
                }
            }
        }

        function receiveMessage(content) {
            const messages = document.getElementById('messages');
            const message = document.createElement('div');
            message.className = 'message received'; // Set class for received message
            message.innerHTML= content;
            messages.appendChild(message);
            messages.scrollTop = messages.scrollHeight; // Scroll to bottom
        }
    </script>
    <script>
    let send_support=document.getElementById("send_support");
    send_support.addEventListener("click",function(){
        messages.appendChild("<div class='messages'>
        just a test
    </div>
")
        
    })
    </script>
     <script>
        let shops_name_section=document.querySelector(".shops_name_section");
        function hide_shops(){
            let shops_hide=document.querySelector('.shops_hide');
           shops_hide.addEventListener("click",function(){
               shops_name_section.style.right="100%";
               shops_name_section.style.left="100%";
               
               
           })
        }
        function show_shops(){
            let butt=document.querySelector("#show_shops_button");
            butt.addEventListener("click",function(){
                if(window.innerWidth < 800 ){
                    
                
                shops_name_section.style.right="20%";
                shops_name_section.style.left="0%";
                }
                 else{
                     shops_name_section.style.right="70%"; 
                shops_name_section.style.left="0%";
                 }
            })
        }
        hide_shops();
        show_shops();
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
     let loading=document.getElementById("loading");  
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
             xhv.open("POST","users/general.php",true);
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
   <script>
   function turn(){
      let loader=document.querySelector(".loader");
      loader.style.display="none";
  }
       // function to get stores
       let stores_ul=document.querySelector(".stores_ul");
       function get_stores(){
           let xhs=new XMLHttpRequest();
           xhs.open("GET","users/general.php?get_stores=true",true);
           xhs.onreadystatechange=function(){
               if(xhs.readyState==4 && xhs.status==200){
                   stores_ul.innerHTML=xhs.responseText;
               }
           }
           xhs.send();
       }
       window.onload=function(){
           turn();
           get_stores();
       }
           
       
   </script>
    </body>
   
</html>