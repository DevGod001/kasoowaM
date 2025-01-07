<?php
session_start();
include_once 'connect.php';
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";

if(isset($_COOKIE['user_id']) && isset($_COOKIE['home_user_id']) && isset($_COOKIE['account_type'])){
    header('Location:/'); 
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop groceries from anywhere worldwide">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop the latest products at our store.">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="login.css"> <!-- Link to your CSS file -->
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="app.json">
     
    <style>
        *{
            max-width:375px;
            font-family:roboto;
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
              <strong class="desc">Login to your account </strong>
              <i class="warn" id="warn"><?php if(isset($_SESSION['login'])){ 
              echo $_SESSION['login'];
              unset($_SESSION['login']);
              } ?></i>
                    <form onsubmit="show_loading()" action="login_process.php" method="post">
                      
                    <div class="input-container" id="mail_cont">
                        <input name="mail" id="mail" type="email" class="input-field" placeholder=" " required>
    
    <label class="label">Enter your registered email address</label>
</div>


<div class="input-container" id="password_cont" >
    <input name="password"  id="password" type="password" class="input-field" placeholder=" " required>
    <label class="label">Enter your password</label>
    
</div>
<label class="show" id="switch"><label for="show">Show password</label><input id="show" type="checkbox" ></label>
<button type="submit" id="create">Login</button>
<section class="links"> <p>Not yet signed up? <a href="register">Register</a></p>
<p>Forgot password? <a href="reset">Reset</a></p></section>
              </form>
            </div>
        </section>
        
    </main>

    <footer>
        
    </footer>
    <script>
        let pass=document.getElementById("password");
        let show=document.getElementById("switch");
        let show_password=document.getElementById("show");
        let pass_cont=document.getElementById("password_cont");
        let mail=document.getElementById("mail");
        let mail_cont=document.getElementById("mail_cont");
        let warn=document.getElementById("warn");
        let sub=document.getElementById("create");
        let loading=document.getElementById("loading");
        pass.addEventListener("input",function(){
            if(pass.value==""){
                show.style.display="none";
                
            }
            else{
            show.style.display="flex";
            }
           
        })
        function show_loading(){
            loading.style.display="flex";
        }
        show_password.addEventListener("input",function(){
            if(pass.type=="password"){
                pass.type="text";
            }
            else{
                pass.type="password";
            }
        })
        mail.addEventListener("input",function(){
            
            if(mail.value==""){
            mail_cont.style.borderColor="red";
        }
        else{
            mail_cont.style.borderColor="#4caf50";
        }
        })
        pass.addEventListener("input",function(){
            
            if(pass.value==""){
            pass_cont.style.borderColor="red";
        }
        else{
            pass_cont.style.borderColor="#4caf50";
        }
        })
        mail.addEventListener("input",function(){
            let xhe=new XMLHttpRequest();
            xhe.open("GET","login_process.php?verify_mail=true&mail="+encodeURIComponent(mail.value),true);
            xhe.onreadystatechange=function(){
                if(xhe.status==200 && xhe.readyState==4){
                    if(xhe.responseText.trim()==""){
                        warn.innerText=xhe.responseText;
                        sub.disabled=false;
                        sub.style.background="#4caf50";
                        
                    }
                    else{
                    warn.innerText=xhe.responseText;
                    sub.disabled=true;
                    sub.style.background="#a3d8a1";
                    }
                }
            }
            xhe.send();
        })
         
    </script>
</body>
</html>