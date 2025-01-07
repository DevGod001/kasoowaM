<?php
session_start();
include_once 'connect.php';
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop groceries from anywhere worldwide">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Reset password</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop the latest products at our store.">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="login.css"> <!-- Link to your CSS file -->
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="manifest" href="app.json">
    <style>
        *{
            max-width:375px;
            font-family:Arial,sans-serif;
        }
        .section1{
            max-width:100vw;
        }
        .links{
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:0px;
        }
        .section1{
            border-radius:10px;
        }
        .warn{
            font-size:0.8rem;
        }
        button{
            cursor:pointer;
        }
        #use{
            display:none;
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
</head>
<body>
    <header>
        
    </header>

    <main>
         <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
        
        <section class="section1" id="section1">
            <div class="s_group">
              <strong class="desc">Reset your passsword</strong>
              <i class="warn" id="warn"></i>
              
                    <form id="get">
                      
                    <div class="input-container" id="mail_cont">
                        <input name="mail" id="mail" type="email" class="input-field" placeholder=" " required>
    
    <label class="label">Enter your registered email address</label>
</div>
<button id="request" type="button">Get OTP</button>



<section class="links"> <p>Remember password? <a href="login">back to Login</a></p>

              </form>
             
              
            </div>
        </section>
        
    </main>

    <footer>
        
    </footer>
   <script>
       let mail=document.getElementById("mail");
        let request=document.getElementById("request");
         let warn=document.getElementById("warn");
          let request_otp=document.getElementById("request");
          let get_otp=document.getElementById("get");
           let reset_pass=document.getElementById("use");
           let loading=document.querySelector("#loading");
        mail.addEventListener("input",function(){
             
            let xhm=new XMLHttpRequest();
            xhm.open("GET","password/request.php?reset=true&mail="+encodeURIComponent(mail.value),true);
            xhm.onreadystatechange=function(){
                if(xhm.status==200 && xhm.readyState==4){
                    warn.innerText=xhm.responseText;
                   
                }
            }
            xhm.send();
        })
      request_otp.addEventListener("click",function(){
          loading.style.display="flex";
        let xhs=new XMLHttpRequest();
            xhs.open("GET","password/request.php?send=true&mail="+encodeURIComponent(mail.value),true);
            xhs.onreadystatechange=function(){
                if(xhs.status==200 && xhs.readyState==4){
                    loading.style.display="none";
                    warn.innerText=xhs.responseText;
                   
                        window.location.href="verify";
                   
                   
                   
                }
            }
            xhs.send();
        })
   </script>
</body>
</html>