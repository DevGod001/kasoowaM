<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$image=$url."/assets/kasoowa.png";

$select_notifications="SELECT * FROM `notifications` WHERE `status`<>'read' LIMIT 5";
$notifications_selected=mysqli_query($conn,$select_notifications);
$notification_row=mysqli_num_rows($notifications_selected);

$select_notice="SELECT * FROM `notifications` WHERE `status`<>'read'";
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        z-index:1000;
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
    </style>
     <style>
        *{
            outline:none;
        }
        .section2{
            width:100vw;
           
            box-shadow:0px 4px 8px rgba(0,0,0,0.2);
            padding:10px;
            border-radius:5px;
            margin:12vh auto;
            display:flex;
            flex-direction:column;
            align-items:center;
            background:white;
        }
        .section2 *,.section2 form *{
            font-size:0.9rem;
        }
        .section2 strong{
            margin-right:auto;
        }
        .section2 form{
            display:flex;
            flex-direction:column;
            align-items:center;
            width:100%;
            margin:20px 0;
            gap:10px;
        }
        .cont{
            width:100%;
            border:1px solid silver;
            height:40px;
            border-radius:5px;
            position:relative;
            
            
        }
        .cont_input{
            height:90%;
            border:none;
            border-radius:5px;
            width:95%;
           font-family:teachers;
           background:transparent;
        }
        .float{
            position:absolute;
            top:25%;
            left:5%;
            pointer-events:none;
            font-family:teachers;
           
            padding:0 5px;
            transition-duration:0.5s;
        }
        .cont:hover{
            border-color:#4caf50;
        }
        .cont_input:focus +.float,.cont_input:not(:placeholder-shown) + .float{
            top:-25%;
            color:#4caf50;
             background:white;
        }
        .generate_cont{
             width:100%;
            border:0.1px solid silver;
            height:40px;
            border-radius:5px;
            display:grid;
            overflow:hidden;
            grid-template-columns:2fr 1fr ;
            padding:0;
            place-items:center;
            
        }
        .generate_cont input{
            height:100%;
           width:100%;
           border:none;
            font-family:teachers;
        }
        .generate_cont button{
            height:100%;
            width:100%;
            border:none;
            background:linear-gradient(to right,green,lightgreen);
            color:white;
            font-weight:bold;
            font-family:teachers;
            white-space:nowrap;
            font-size:0.8rem;
            border-radius:0px;
        }
        button[type=submit]{
            margin-right:auto;
            border:none;
            height:40px;
             padding:0 30px;
             display:flex;
             align-items:center;
             justify-content:space-between;
             gap:10px;
             background:linear-gradient(to right,green,lightgreen);
             color:white;
             font-family:teachers;
        }
        .table_section{
           width:100%;
           overflow:auto;
           
        }
        thead th{
            white-space:nowrap;
           padding:10px;
            color:white;
            border-left:0.1px solid silver;
            min-width:100px;
            font-family:poppins;
        }
        thead{
            background:#4caf50;
        }
        table{
            border-collapse:collapse;
           
        }
        tbody td{
            font-family:teachers;
            padding:10px;
            border-bottom:0.1px solid silver;
            text-align:center;
            font-size:0.9rem;
        }
        td button{
            border:none;
            color:white;
            padding:10px 20px;
            font-family:teachers;
            border-radius:2px;
           
        }
        tbody tr:hover{
            background:rgba(144,255,144,0.2)
        }
        
    </style>
    <style>
        @media(min-width:800px){
            .section2{
                width:calc(100% - 350px);
                margin-left:350px;
            }
             .section2 form{
                 width:500px;
                 margin-right:auto;
             }
             .cont{
                 height:50px;
             }
              .generate_cont{
                  height:50px;
              }
               button[type=submit]{
                   height:50px;
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
            z-index:3500;
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
        .shake{
            animation:shake 0.5s linear;
            border-color:red;
        }
        @keyframes shake{
            0%,50%,100%{
                transform:translateX(0px);
            }
            25%,75%{
                transform:translateX(5px);
            }
            
        }
    </style>
    <style>
     .end{
           margin:60px auto;
           display:flex;
           flex-direction:column;
           align-items:center;
           color:#708090;
           text-shadow:0px 4px 8px rgba(0,0,0,0.5)
           
       }
    .paginate-section{
     display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
    }
    
    .paginate-section a{
        height:100%;
        width:100%;
    }
   .paginate-buttons,.page{
        height:30px;
        width:30px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:lightgreen;
        color:green;
        box-shadow:0px 4px 8px rgba(0,0,0,0.2);
    }
    .page{
        background:transparent;
        border:1px solid green;
    }
    .paginate-buttons:hover{
        background:#4caf50;
        color:white;
    }
    .paginate-section a:hover{
        color:white;
    }
    
    @media(min-width:800px){
        .paginate-section{
    margin-left:350px;
    }
    }
</style>
</head>
<body>
   <header>
      <a href="/"><div class="logo" ></div></a>
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
        <a href="dashboard"><i class="material-icons">home</i>Dashboard</a>
        <a href="users"><i class="material-icons">group</i>Users</a>
         <a href="categories"><i class="material-icons">category</i>Categories</a>
          <a href="orders"><i class="material-icons">shopping_cart</i>Orders</a>
           <a href="discount"><i class="material-icons">discount</i>Discount Codes</a>
         <a href="chat"><i class="material-icons">message</i>Live Chats </a>
        <a href="transactions"><i class="material-icons">receipt</i>Transactions </a>
        <a href="disputes"><i class="material-icons">report</i>Disputes </a>
        <a href="logs"><i class="material-icons">assignment</i>System logs </a>
         <a href="admins"><i class="material-icons">admin_panel_settings</i>Manage Admins </a>
          <a href="settings"><i class="material-icons">settings</i>Settings </a>
           <a href="profile"><i class="material-icons">account_circle</i>Profile </a>
       <a id="logout" href="logout"><i class="material-icons">exit_to_app</i>Logout</a>
      </nav>
   </header>
    <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
    <main>
         <section class="section2">
        <strong style="font-family:poppins;">Create Discount Code</strong>
        <i style="color:red;margin-right:auto"><?php
        if(isset($_SESSION['notice'])){
            echo $_SESSION['notice'];
            unset($_SESSION['notice']);
        }
        ?></i>
        <form id="create_form" action="discount_process.php" method="post">
            <div class="cont">
                <input required name="name" type ="text" class="cont_input" placeholder =" ">
                <label class="float">Enter Code Name</label>
            </div>
            <div class="generate_cont">
                <input required name="code" class="generate_input" value="" readonly type ="text"><button class="generate_button" type ="button">Generate Code</button>
            </div>
              <div class="cont">
                <input required name="percentage" type ="number" class="cont_input" placeholder =" ">
                <label class="float">Enter discount percentage</label>
            </div>
            <div class="cont">
                <input readonly value="1" required name="limit" type ="number" class="cont_input" placeholder =" ">
                <label class="float">Max usage Allowed </label>
            </div>
            <div class="cont">
                <input required name="minimum_checkout" type ="number" class="cont_input" placeholder =" ">
                <label class="float">Minimum Checkout Amount Allowed in naira</label>
            </div>
            <button type="submit" name="create">
                CREATE CODE <i class="material-icons">chevron_right</i>
            </button>
        </form>
        <strong style="font-family:poppins">Code History</strong>
        <section class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Code Name</th>
                        <th>Code</th>
                        <th>Discount percentage</th>
                        <th>Redeemed</th>
                        <th>Max Users Allowed</th>
                        <th>Minimum Checkout</th>
                        <th>Status</th>
                        <th>Pause</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $per_page=20;
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                    }
                     else{
                         $page=1;
                     }
                     $offset=($page-1) * $per_page;
                     $select="SELECT * FROM `discount` WHERE 1";
                     $selected=mysqli_query($conn,$select);
                     $row=mysqli_num_rows($selected);
                     $ceil=ceil($row/$per_page);
                    $select="SELECT * FROM `discount` WHERE 1 ORDER BY `date` DESC LIMIT $per_page OFFSET $offset";
                    $selected=mysqli_query($conn,$select);
                    $rows=mysqli_num_rows($selected);
                    
                    if($rows > 0){
                        $null="";
                        while($fetch=mysqli_fetch_assoc($selected)){
                            switch($fetch['status']){
                                case "active":
                                $inner="PAUSE";
                                $color="orange";
                                break;
                                case "paused":
                                    $inner="RESUME";
                                    $color="#4caf50";
                                    break;
                                    default:
                                        $inner=strtoupper($fetch['status']);
                                        $color="silver";
                                        break;
                            }
                    echo '<tr class="rows">
                        <td>'.$fetch['name'].'</td>
                        <td class="code_row" style="white-space:nowrap"><span class="code_span">'.$fetch['code'].'</span> <i class="material-icons">content_copy</i></td>
                        <td>'.$fetch['percentage'].'%</td>
                        <td>'.$fetch['redeemed'].'</td>
                        <td>'.$fetch['limit'].'</td>
                        <td>&#8358 '.$fetch['minimum_checkout'].'</td>
                        <td class="status_row">'.$fetch['status'].'</td>
                        <input type="hidden" class="row_id" value="'.$fetch['id'].'">
                        <td><button class="pause" style="background:'.$color.';font-size:0.8rem;">'.$inner.'</button></td>
                        <td><button class="delete" style="background:red;font-size:0.8rem;">DELETE</button></td>
                    </tr>';
                    }
                    }
                      else{
                          $null="<span class='end'>------ NO DATA TO SHOW ------</span>";
                      }
                    ?>
                   
                </tbody>
            </table>
            <?php
            echo $null;
            ?>
        </section>
         <section class="paginate-section" style="visibility:<?php 
    if($row <= $per_page){
        echo "hidden";
    }
    ?>">
    <button class="paginate-buttons" style="visibility:<?php 
    if($page <= 1){
        echo "hidden";
    }
    ?>">
       <a href="?page=<?php echo $page-1; ?>">  <i class="material-icons">chevron_left</i></a>
    </button>
    <button class="page"><?php echo $page; ?></button>
     <button class="paginate-buttons" style="visibility:<?php 
    if($page >= $ceil){
        echo "hidden";
    }
    ?>">
         <a href="?page=<?php echo $page+1; ?>"> <i class="material-icons">chevron_right</i></a>
    </button>
    
    
</section>
    </section> 
    </main>
    <footer>
        
    </footer>
     <script>
     let create_form=document.querySelector("#create_form");
     let loading=document.getElementById("loading");
     let pause=document.getElementsByClassName("pause");
     let delete_button=document.querySelectorAll(".delete");
     let row_id=document.getElementsByClassName("row_id");
     let status_row=document.querySelectorAll(".status_row");
     let code_row=document.getElementsByClassName("code_row");
     
        let generate_button=document.querySelector(".generate_button");
        let rows=document.querySelectorAll(".rows");
        let generate_input=document.querySelector(".generate_input");
        let generate_cont=document.querySelector(".generate_cont");
        generate_button.addEventListener("click",function(){
            let alphabets="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            let generated_code="";
            for(let i=0;i < 20;i++){
               let index=Math.floor(Math.random() * alphabets.length);
             generated_code += alphabets[index];
             generate_input.value=generated_code;
            }
           
        })
        create_form.addEventListener("submit",function(){
            if(generate_input.value==""){
                event.preventDefault();
                generate_cont.classList.add("shake");
                generate_cont.addEventListener("animationend",function(){
                    generate_cont.classList.remove("shake");
                })
                return;
            }
            loading.style.display="flex";
        })
        // function to pause
        function pause_code(){
            for(let p=0;p < pause.length;p++){
                pause[p].addEventListener("click",function(){
                    loading.style.display="flex";
                    let xhp=new XMLHttpRequest();
                    xhp.open("GET","discount_process.php?pause=true&id=" + encodeURIComponent(row_id[p].value),true);
                    xhp.onreadystatechange=function(){
                        if(xhp.readyState==4 && xhp.status==200){
                            loading.style.display="none";
                            let new_action="";
                            let new_color="";
                            if(xhp.responseText == 'active'){
                                new_action="PAUSE";
                                new_color="orange";
                            }
                             else{
                                 new_action="RESUME";
                                 new_color="#4caf50";
                             }
                            status_row[p].innerText=xhp.responseText;
                            pause[p].innerText=new_action;
                            pause[p].style.background=new_color;
                        }
                    }
                    xhp.send();
                })
            }
        }
        // function to delete
        function delete_code(){
            for(let d=0;d < delete_button.length;d++){
                delete_button[d].addEventListener("click",function(){
                    loading.style.display="flex";
                    let xhd=new XMLHttpRequest();
                    xhd.open("GET","discount_process.php?delete_row=true&id=" + encodeURIComponent(row_id[d].value),true);
                    xhd.onreadystatechange=function(){
                        if(xhd.readyState==4 && xhd.status==200){
                            loading.style.display="none";
                            if(xhd.responseText=="success"){
                                rows[d].style.display="none";
                            }
                             else{
                                 alert(xhd.responseText);
                             }
                        }
                    }
                    xhd.send();
                })
            }
        }
        // function to copy code
        for(let c=0;c < code_row.length;c++){
            let copy_icon=code_row[c].querySelector(".material-icons");
            let codes=code_row[c].querySelector(".code_span");
            copy_icon.addEventListener("click",function(){
                if(navigator.clipboard.writeText(codes.innerText)){
                    copy_icon.innerText='done';
                    setTimeout(function(){
                        copy_icon.innerText="content_copy";
                    },1000);
                }
            })
        }
        pause_code();
        delete_code();
    </script>
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
      notifications.addEventListener("click",function(){
          if(notice.style.display=="none"){
          notice.style.display="block";
          }
           else{
                notice.style.display="none";
           }
      })
  </script> 
</body>

</html>