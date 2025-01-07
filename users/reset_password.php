<?php
session_start();
include_once 'connect.php';
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/logo.png";




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
    <link rel="shortcut icon" href="../logo.png" type="image/png">
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
              <strong class="desc">Reset your passsword</strong>
              <i class="warn" id="warn"><?php if(isset($_SESSION['notify'])){
                  echo $_SESSION['notify'];
                  unset($_SESSION['notify']);
              }
              ?></i>
              
                   
             
              <form action="request.php" method="post" id="use">
                      
                    <div class="input-container">
                        <input name="otp" type="number" class="input-field" placeholder=" " required>
    
    <label class="label">Enter one time pin</label>
</div>
<div class="input-container"  >
    <input id="password" name="password"  type="password" class="input-field" placeholder=" " required>
    <label class="label">Enter new password</label>
    
</div>
<div class="input-container"  >
    <input id="confirm" name="confirm"  type="password" class="input-field" placeholder=" " required>
    <label class="label">Confirm password</label>
    
</div>
<label class="show" id="switch"><label for="show">Show password</label><input id="show" type="checkbox" ></label>
<button type="submit">Reset password</button>



<section class="links"> <p>Remember password? <a href="login">back to Login</a></p>

              </form>
            </div>
        </section>
        
    </main>

    <footer>
        
    </footer>
 <script>
 let pass=document.getElementById("password");
 let confirm=document.getElementById("confirm");
        let show=document.getElementById("switch");
        let show_password=document.getElementById("show");
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
                confirm.type="text";
            }
            else{
                pass.type="password";
                confirm.type="password";
            }
        })
 </script>
</body>
</html>