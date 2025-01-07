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
    </style>
</head>
<body>
    <header>
        
    </header>

    <main>
        <section class="section1" id="section1">
            <div class="s_group">
              <strong class="desc">Admin Login </strong>
              <i class="warn" id="warn"></i>
                    <form action="login_process.php" method="post">
                      
                    <div class="input-container" id="mail_cont">
                        <input name="mail" id="mail" type="email" class="input-field" placeholder=" " required>
    
    <label class="label">Enter your email address</label>
</div>


<div class="input-container" id="password_cont" >
    <input name="password"  id="password" type="password" class="input-field" placeholder=" " required>
    <label class="label">Enter your password</label>
    
</div>
<label class="show" id="switch"><label for="show">Show password</label><input id="show" type="checkbox" ></label>
<button type="submit" id="create">Login</button>
<section class="links">
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
        pass.addEventListener("input",function(){
            if(pass.value==""){
                show.style.display="none";
                
            }
            else{
            show.style.display="flex";
            }
           
        })
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
        })
        mail.addEventListener("input",function(){
            let xhe=new XMLHttpRequest();
            xhe.open("GET","login_process.php?verify_mail=true&mail="+encodeURIComponent(mail.value),true);
            xhe.onreadystatechange=function(){
                if(xhe.status==200 && xhe.readyState==4){
                    if(xhe.responseText==""){
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
         pass.addEventListener("input",function(){
            
            let xhp=new XMLHttpRequest();
            xhp.open("GET","login_process.php?verify_password=true&password="+encodeURIComponent(pass.value)+"&mail="+encodeURIComponent(mail.value),true);
            xhp.onreadystatechange=function(){
                if(xhp.status==200 && xhp.readyState==4){
                    if(xhp.responseText==""){
                        warn.innerText=xhp.responseText;
                        sub.disabled=false;
                        sub.style.background="#4caf50";
                        
                    }
                    else{
                    warn.innerText=xhp.responseText;
                    sub.disabled=true;
                    sub.style.background="#a3d8a1";
                    }
                }
                else{
                    warn.innerText="error";
                }
            }
            xhp.send();
        })
    </script>
</body>
</html>