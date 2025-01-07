<?php
session_start();
if(!isset($_GET['next'])){
    header('Location:/');
    exit;
}
else{
    $next=$_GET['next'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  
    <title>Verifying location</title>
    <style>
     .verify_section{
        background:white;
        display:flex;
        align-items:center;
        flex-direction:column;
        text-align:center;
       
     }
     .load{
        width:30px;
        height:30px;
        border:5px solid silver;
        border-radius:50%;
        animation:rotate 1s linear infinite;
        border-top:5px solid #4caf50;
     }
     *{
        outline:none;
        user-select:none;
        box-sizing:border-box;
        font-family:poppins;
     }
     h2{
        color:#4caf50;
     }
     .message{
        color:#708090;
        font-size:0.8rem;
        padding:20px;
         }
         .iframe{
            position:fixed;
            bottom:-100%;
            left:0;
            right:0;
            width:100%;
            transition-duration:1s;
            height:60%;
            border-radius:25px 25px 0px 0px;
            border:0.1px solid silver;
         }
         .slide{
            bottom:0%;
         }
     @keyframes rotate{
        0%{
            transform:rotate(0deg);
        }
        100%{
            transform:rotate(360deg);
        }

     }
    </style>

</head>
<body>
   <section class="verify_section">
<div class="load">

</div>
<h2>Enhancing your  experience</h2>
<span class="message">
    We are verifying your location to ensure a seamless and personalized experience.Please hold on for a moment...
</span>

   </section> 
   <iframe class="iframe" src="map2.php">

   </iframe>
   <script>
    let iframe=document.querySelector(".iframe");
    function show_frame(){
        setTimeout(function(){
            iframe.classList.add("slide");
        },2000);
        window.addEventListener("message",function(event){
        setTimeout(function(){
            
                if(event.data.includes("success")){
               window.location.href="<?php echo $next; ?>";
                }
                 else{
                     alert(event.data);
                 }
        },10000);
        })
    }
    window.onload=function(){
        show_frame();
    }
    </script>
</body>
</html>