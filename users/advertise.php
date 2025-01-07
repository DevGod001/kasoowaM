<?php
include_once 'functions.php';
include_once 'connect.php';
userlogin();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width+device-width,initial-scale=1.0">
    <title>Page title</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="manifest" href="app.json">

    <style>
    body{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        background:whitesmoke;
        min-height:100vh;
    }
    html,body{
        padding:0;
        margin:0;
        
    }
    main{
        width:100vw;
    }
    .section1{
        width:100%;
        padding:0px 5px;
        margin-top:12vh;
    }
      
      .custom_select{
            width:100%;
            border:1px solid silver;
            height:40px;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:space-between;
            border-radius:5px;
           padding:0px 5px;
           position: relative;
           
           
        }
        .dropdown{
            background:whitesmoke;
            position:fixed;
            left:0;
            right:0;
            bottom:0;
           top:0;
            border:1px solid silver;
           display:none;
           flex-direction:column;
           align-items:center;
           justify-content:flex-start;
          z-index:2300;
           border-left:1px solid #4caf50;
        }
        *{
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }
        main{
            padding:5% 0%;
            flex:1 0 auto;
            
        }
        .options,.subs{
            width:100%;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:flex-start;
            height:50px;
            gap:20px;
            padding:2%;
            border:1px solid silver;
            cursor:pointer;
             
        }
        .icon{
            max-height:100%;
            border-radius:5px;
        }
        .icon{
            height:100%;
            width:40px;
            background-size:cover;
            background-position:center;
        }
        .subs .material-icons,.options .material-icons{
           margin-left:auto;
        }
        .description{
            position:fixed;
            top:0;
            left:0;
            right:0;
            background:white;
            height:10vh;
            z-index:2000;
            background:#4caf50;
            color:white;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
                    }
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
        
        
        
        
        
        
        @media only screen and (min-width: 800px) {
            
   .section1{
        width:500px;
    }
    main{
        width:1000px;
        background:white;
           display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:flex_start;
        margin:20px;
            border-radius:10px;
            padding:0%;
    }
    
   .dropdown{
            background:whitesmoke;
            position: absolute;
            left:0;
            right:0;
            bottom:0;
           top:100%;
            border:1px solid silver;
           display:none;
           flex-direction:column;
           align-items:center;
           justify-content:flex-start;
          
           border-left:1px solid #4caf50;
        }
         .description{
            position:relative;
          width:1000px;
          border-radius:5px;
            margin-top:2%;
            
        }
       .custom_select{
            
            height:50px;
          
           
        } 
      
}

    </style>
</head>
<body>
    <div class="description"><h2>Sell on Kasoowa</h2></div>
    <main>
       
    <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
                         
    <section class="section1">
        <form>
            <input type ="hidden" name="category" id="category">
            
            <div class="custom_select">
                <span>select category </span>
                <i class="material-icons">arrow_drop_down</i>
                <section class="dropdown" id="dropdown">
                    <label class="options"><div class="icon" style="background-image:url('https://test.kasoowa.com/users/pepper.jpg')"></div><input type ="hidden" value="category_id" class="hidden_cat_id">Spices and seasoning<i class="material-icons">chevron_right</i></label></label>
                      <label class="options"><div class="icon" style="background-image:url('https://test.kasoowa.com/users/fruits.jpg')"></div><input type ="hidden" value="category_id" class="hidden_cat_id">Fruits and Meals<i class="material-icons">chevron_right</i></label></label>
                        <label class="options"><div class="icon" style="background-image:url('https://test.kasoowa.com/users/drinks.jpg')"></div><input type ="hidden" value="category_id" class="hidden_cat_id">Drinks and Beverages<i class="material-icons">chevron_right</i></label></label>
                         <label class="options"><div class="icon" style="background-image:url('https://test.kasoowa.com/users/yam.jpg')"></div><input type ="hidden" value="category_id" class="hidden_cat_id">Root Vegetables <i class="material-icons">chevron_right</i></label>
                         
                         
                </section>
            </div>
        </form>
    </section>
    </main>
    <script>
        
        let custom_select=document.getElementsByClassName("custom_select");
      let loading=document.getElementById("loading");
      let options=document.getElementsByClassName("options");
      let subs=document.getElementsByClassName("subs");
      let dropdown=document.getElementsByClassName("dropdown");
      let drop_down=document.getElementById("dropdown");
      let category=document.getElementById("category")
      let category_id=document.getElementsByClassName("hidden_cat_id");
      for(let i=0;i < options.length;i++){
          options[i].addEventListener("click",function(){
          loading.style.display="flex";
          category.value=category_id[i].value;
            let xhs=new XMLHttpRequest();
            xhs.open("GET","categories.php",true);
            xhs.onreadystatechange=function(){
                if(xhs.readyState==4 && xhs.status==200){
                    loading.style.display="none";
                   for(let j=0;j < dropdown.length;j++){
                   dropdown[j].innerHTML=xhs.responseText;
                    
                   }
                }
            }
            xhs.send();
          })
         
           
           
          }
          for(let d=0;d < custom_select.length;d++){
              custom_select[d].addEventListener("click",function(){
                 
                  dropdown[d].style.display="flex";
              })
              
          }
          
         document.addEventListener("click", function (e) {
    if (e.target.classList.contains("subs")) {
        dropdown[0].style.display = "none";  // Close the dropdown when a .subs element is clicked
    }
});
          
          
    </script>
</body>
</html>