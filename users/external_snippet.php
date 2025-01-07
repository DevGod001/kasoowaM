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
       <a href="cart"><i class="material-icons">shopping_cart</i>Cart</a>
       <a href="account"><i class="material-icons">person</i>My Account</a>
      
       
        <a style="border-top:0.1px solid #4caf50;justify-content:center" href="logout"><i class="material-icons">exit_to_app</i>Logout</a></div></section>';
             }
        ?>
        <section class="cart_container"><i class="material-icons">shopping_cart</i>
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
       <div class="mobile_action_div"><section class="profile_section"><i class="material-icons" id="profile">menu</i><div class="profile-links">
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
        </div></section><section class="cart_container"><i class="material-icons">shopping_cart</i><div id="mobile_cart_number"><?php echo $cart_row; ?></div></section></div> 
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
   
   <!-- START -->
  
  
  
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
    <script src="cart.js"></script>
   
   
    </body>
   </html>