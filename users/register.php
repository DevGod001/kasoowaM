<?php
session_start();
include_once 'connect.php';
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";

if(isset($_COOKIE['user_id']) && isset($_COOKIE['home_user_id'])){
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
    <title>Register</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop groceries worldwide and safely">
    <meta property="og:image" content="<?php echo $image; ?>"> <!-- Link to your image -->
    <meta property="og:url" content="<?php echo $url; ?>"> <!-- Your website URL -->
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="register.css"> <!-- Link to your CSS file -->
    <link rel="icon" href="kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="app.json">

    <style>
        *{
            font-family:Arial,sans-serif;
             font-family:roboto;
        }
        button{
            cursor:pointer;
        
            
        }
        .s_group{
            border-radius:10px;
        }
        .warn{
            font-size:0.8rem;
        }
        *{
          max-width:375px;
          
          
      
      }
      .section1{
          max-width:100vw;
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
              <strong class="desc">Create an account </strong>
              <i class="warn" id="warn1"></i>
                    <form>
                      
                    <div class="input-container" id="mail_cont">
                        <input id="mail" type="email" class="input-field" placeholder=" " required>
    
    <label class="label">Enter your email address</label>
</div>

<div class="input-container" id="name_cont">
    <input id="name" type="text" class="input-field" placeholder=" " required>
    <label class="label">Enter your full name</label>
</div>
<div class="input-container" id="number_cont">
    <input id="number" type="number" class="input-field" placeholder=" " required>
    <label class="label">Enter your mobile number</label>
</div>
<div class="input-container" id="password_cont" >
    <input  id="password" type="password" class="input-field" placeholder=" " required>
    <label class="label">Enter your desired password</label>
    
</div>
<label class="show" id="switch"><label for="show">Show password</label><input id="show" type="checkbox" ></label>
<button type="button" id="create">Create Account</button>
<p>Already have an account? <a href="login">Log in</a></p>
              </form>
            </div>
        </section>
        <section class="section1" id="section2">
            <div class="s_group">
              <strong class="desc">Create an account </strong>
                    <form  onsubmit="show_loading()" action="register_process.php" method="post">
                        <i class="warn" id="warn2"></i>
                      
                    


    <select required id="country" name="country" class="select">
    <option value="" disabled selected>--Select Country--</option>
    <option value="nigeria">Nigeria</option>
    <option value="united_states">United States</option>
    <option value="united_kingdom">United Kingdom</option>
    <option value="canada">Canada</option>
    <option value="ghana">Ghana</option>
   
    <option value="cameroon">Cameroon</option>
 

   
</select>

<button type="submit" id="submit">Complete Signup</button>
<p>Already have an account? <a href="login">Log in</a></p>
              </form>
            </div>
        </section>
    </main>

    <footer>
        
    </footer>
    <script>
        let section1=document.getElementById("section1");
        let section2=document.getElementById("section2");
        let password=document.getElementById("password");
        let show=document.getElementById("show");
        let swi=document.getElementById("switch");
        let loading=document.getElementById("loading");
        password.addEventListener("input",function(){
            if(password.value==""){
                swi.style.display="none";
                
            }
            else{
                swi.style.display="block";
            }
        })
        show.addEventListener("input",function(){
            if(password.type=="password"){
                password.type="text";
            }
            else{
                password.type="password";
            }
        })
    </script>
    <script>
        let create=document.getElementById("create");
        let mail=document.getElementById("mail");
        let mail_cont=document.getElementById("mail_cont");
        
        function show_loading(){
            loading.style.display="flex";
        }
        mail.addEventListener("input",function(){
        if(mail.value==""){
            mail_cont.style.borderColor="red";
        }
         else{
            mail_cont.style.borderColor="#4caf50";
            }
        })
        let name=document.getElementById("name");
        let name_cont=document.getElementById("name_cont");
        name.addEventListener("input",function(){
        if(name.value==""){
            name_cont.style.borderColor="red";
        }
         else{
            name_cont.style.borderColor="#4caf50";
            }
        })
        let num=document.getElementById("number");
        let num_cont=document.getElementById("number_cont");
        let warn1=document.getElementById("warn1");
        let warn2=document.getElementById("warn2");
        
     let sub=document.getElementById("submit");
     
 let nex=document.getElementById("create");
 
 
 mail.addEventListener("input",function(){
     let xhm=new XMLHttpRequest();
     xhm.open("GET","register_process.php?gmail=true&mail="+encodeURIComponent(mail.value),true);
     xhm.onreadystatechange=function(){
         if(xhm.status==200 && xhm.readyState==4){
             if(xhm.responseText.trim()==""){
                 warn1.innerText="";
                 nex.disabled=false;
                 nex.style.background="#4caf50";
             }
              else{
             warn1.innerText=xhm.responseText;
             nex.disabled=true;
             nex.style.background="#a3d8a1";
              }
         }
     }
     xhm.send();
 })
 
 
 
       num.addEventListener("input",function(){
       if(num.value==""){
           num_cont.style.borderColor="red";
       }
       else{
           num_cont.style.borderColor="#4caf50";
           }
       })
       let pass=document.getElementById("password");
       let pass_cont=document.getElementById("password_cont");
       pass.addEventListener("input",function(){
       if(pass.value==""){
           pass_cont.style.borderColor="red";
       }
       else{
           pass_cont.style.borderColor="#4caf50";
           }
       })
        create.addEventListener("click",function(){
            loading.style.display="flex";
            if(mail.value==""){
                mail_cont.style.borderColor="red";
                return;
            }
            if(name.value==""){
                name_cont.style.borderColor="red";
                return;
            }
            if(num.value==""){
                num_cont.style.borderColor="red";
                return;
            }
            if(pass.value==""){
                pass_cont.style.borderColor="red";
                return;
            }
          let xhr=new XMLHttpRequest();
          xhr.open("GET","register_process.php?session=true&mail="+encodeURIComponent(mail.value)+"&name="+encodeURIComponent(name.value)+"&number="+encodeURIComponent(num.value)+"&password="+encodeURIComponent(pass.value),true);
          xhr.onreadystatechange=function(){
              if(xhr.readyState==4 && xhr.status==200){
                  loading.style.display="none";
                  warn2.innerText=xhr.responseText;
                  section1.style.display="none";
                  section2.style.display="flex";
              }
          }
          xhr.send()
         
        })
    </script>
</body>
</html>