<?php
session_start();
include_once 'connect.php';
include_once 'functions.php';
userlogin();
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
             .header {
            background-color: #4caf50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        h1, h2 {
            color:white;
        }

        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            margin-left: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            margin: 0;
            border-radius: 4px;
        }

        .section-content {
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #4caf50;
            margin-top: 10px;
            border-radius: 4px;
            font-size:0.9rem;
        }

        .footer {
            background-color: #4caf50;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
            z-index:-200;
        }
        main{
            padding-top:10vh;
            min-height:100vh;
            padding-bottom:0;
            margin-bottom:0;
           
            height:100%;
        }
        .footer{
            footer {
  margin-bottom: 0;
 
}

        }
        </style>
        <style>
            @media(min-width:800px){
                main{
                margin-left:350px;
                width:calc(100vw - 350px);
                }
            }
        </style>
</head>
<body>
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
     <section class="cart_container"><i style="color:navy" class="material-icons">shopping_cart</i><div id="mobile_cart_number"><?php echo $cart_row; ?></div></section>
      <div class="notice_div" style="position:relative;margin-left:auto">
      <i id="notifications" class="material-icons">notifications</i><strong class="notify"><?php echo $notice_row; ?></strong>
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
    <main>
      <div class="header">
    <h1>Kasoowa Terms of Service</h1>
    <p>Effective Date: 11/30/2024 | Last Updated: 11/30/2024</p>
</div>

<div class="content">
    <div class="section">
        <h2 class="section-title">1. Introduction</h2>
        <div class="section-content">
            <p>Welcome to Kasoowa! By accessing or using our website (<a href="/">www.kasoowa.com</a>) (the "Platform"), you agree to comply with and be bound by these Terms of Service ("Terms"). If you do not agree with these Terms, please do not use the Platform.
                  <p style="text-indent:30px">Kasoowa is an online marketplace connecting buyers with sellers offering foodstuffs from various locations, including Africa, the United States, the United Kingdom, and Canada. Our Platform facilitates transactions and provides escrow services for secure payments. Kasoowa does not own, handle, store, or ship any products listed on the Platform.</p></p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">2. Roles and Responsibilities</h2>
        <div class="section-content">
            <h3>A. Kasoowa’s Role</h3>
            <ul>
                <li>Acts solely as a technology platform to facilitate communication and transactions between buyers and sellers.</li>
                <li>Provides escrow payment services to protect both buyers and sellers during transactions.</li>
                <li>Does not inspect, verify, or guarantee the quality, safety, legality, or authenticity of the products listed by sellers.</li>
            </ul>

            <h3>B. Buyer Responsibilities</h3>
            <ul>
                <li>Buyers must carefully review product descriptions and seller information before making a purchase.</li>
                <li>Upon receiving a product, buyers are responsible for inspecting the item and reporting any disputes or issues within the dispute resolution window (<a href="#section7">see Section 7</a>).</li>
                <li>Buyers agree to comply with all applicable laws in their location when purchasing products through Kasoowa.</li>
            </ul>

            <h3>C. Seller Responsibilities</h3>
            <ul>
                <li>Sellers must ensure their products comply with all relevant laws and regulations in their country and the buyer's destination, including import, food safety, and labeling standards.</li>
                <li>Sellers must provide accurate product descriptions, ensure proper packaging, and arrange for timely shipping.</li>
                <li>Sellers are responsible for maintaining compliance with local and international food safety standards, such as FDA, USDA, or other regulatory requirements.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">3. Disclaimer of Liability</h2>
        <div class="section-content">
            <h3>A. General Disclaimer</h3>
            <ul>
                <li>Kasoowa is a neutral intermediary and is not a party to transactions between buyers and sellers.</li>
                <li>Kasoowa disclaims all liability for claims, damages, or disputes arising from transactions on the Platform, including:
                    <ul>
                        <li>Product quality or safety issues.</li>
                        <li>Delayed or failed deliveries.</li>
                        <li>Misrepresentation of products.</li>
                    </ul>
                </li>
            </ul>

            <h3>B. No Warranty</h3>
            <p>The Platform and all services are provided “as is” and “as available,” without warranties of any kind, express or implied. Kasoowa makes no representations or warranties regarding the accuracy, reliability, or legality of the sellers or their products.</p>

            <h3>C. Limitation of Liability</h3>
            <p>To the fullest extent permitted by law, Kasoowa is not liable for any direct, indirect, incidental, consequential, or punitive damages arising from your use of the Platform.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">4. Escrow Services</h2>
        <div class="section-content">
            <h3>A. Payment Process</h3>
            <p>Buyers’ payments are held in escrow until they confirm satisfactory receipt of the product or the dispute resolution window expires. Sellers will only receive funds once the transaction is completed or a dispute is resolved.</p>

            <h3>B. Dispute Management</h3>
            <p>Disputes must be submitted within the timeframe specified in <a href="#section7">Section 7.</a> Funds will remain in escrow until the dispute is resolved.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">5. Compliance and Prohibited Activities</h2>
        <div class="section-content">
            <h3>A. Compliance</h3>
            <p>Sellers are responsible for ensuring compliance with food safety and import/export regulations in their respective countries and the buyer's location. U.S.-based sellers must comply with FDA, USDA, and local health department regulations. International sellers shipping to the U.S. must meet FDA and U.S. Customs requirements, including prior notice for food shipments.</p>

            <h3>B. Prohibited Activities</h3>
            <ul>
                <li>Selling or purchasing illegal, unsafe, or fraudulent goods.</li>
                <li>Misrepresenting product details or engaging in fraudulent transactions.</li>
                <li>Violating any applicable laws or regulations.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">6. Privacy Policy</h2>
        <div class="section-content">
            <p>Refer to our <a href="#" style="color: #4caf50;">Privacy Policy</a> for details on how we collect, use, and protect your data.</p>
        </div>
    </div>

    <div class="section">
        <h2 id="section7" class="section-title">7. Dispute Resolution</h2>
        <div class="section-content">
            <h3>A. Reporting Issues</h3>
            <p>Buyers must report disputes related to product quality or delivery within 7 days of receiving the product.</p>

            <h3>B. Resolution Process</h3>
            <p>Kasoowa will mediate disputes between buyers and sellers but does not guarantee a specific outcome. If no resolution is reached, buyers and sellers must resolve disputes independently outside of Kasoowa.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">8. User Accounts</h2>
        <div class="section-content">
            <p>Users must provide accurate information during registration and maintain the confidentiality of their login credentials. You are responsible for all activities conducted under your account.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">9. Intellectual Property</h2>
        <div class="section-content">
            <p>All content on the Platform, including text, images, graphics, logos, and software, is the property of Kasoowa and protected under applicable intellectual property laws. Unauthorized use of our content is strictly prohibited.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">10. Termination</h2>
        <div class="section-content">
            <p>Kasoowa reserves the right to terminate or suspend your access to the Platform at any time, for any reason, including a violation of these Terms.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">11. Governing Law</h2>
        <div class="section-content">
            <p>These Terms are governed by and construed in accordance with the laws, without regard to its conflict of laws principles.</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">12. Contact Information</h2>
        <div class="section-content">
            <p>If you have any questions about these Terms, you can reach us at:</p>
            <p>Kasoowa</p>
            <p>Email: <a href="mailto:support@kasoowa.com" style="color: #4caf50;">support@kasoowa.com</a></p>
            <p>Phone: <a href="tel:+6144055997" style="color: #4caf50;">+1 614-4055-997</a></p>
        </div>
    </div>
</div>


   <section class="footer">
    <p>&copy; 2024 Kasoowa. All Rights Reserved.</p>
</section>
    </main>
   
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
     
</html>