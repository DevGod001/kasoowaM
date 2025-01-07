<?php
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
$select_category_option="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
$category_option_selected=mysqli_query($conn,$select_category_option);

if(!isset($_GET['page'])){
$page=1;
}
else{
    $page=$_GET['page'];
}
$per_page=10;
$offset=($page-1)*$per_page;
$select_categories="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC LIMIT $per_page OFFSET $offset";
$categories_selected=mysqli_query($conn,$select_categories);
$scp="SELECT * FROM `categories` WHERE 1";
$cps=mysqli_query($conn,$scp);
$cpr=mysqli_num_rows($cps);
$cpc=ceil($cpr/$per_page);

if(!isset($_GET['current'])){
    $current=1;
}
else{
    $current=$_GET['current'];
}
$offset=($current-1)*$per_page;
$select_subcategories="SELECT * FROM `subcategories` WHERE 1 ORDER BY `name` ASC LIMIT $per_page OFFSET $offset";
$subcategories_selected=mysqli_query($conn,$select_subcategories);
$sc="SELECT * FROM `subcategories` WHERE 1";
$cs=mysqli_query($conn,$sc);
$csr=mysqli_num_rows($cs);
$csc=ceil($csr/$per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop groceries from anywhere worldwide">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Manage Categories</title>
    
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
    <link rel="manifest" href="app.json">
    <style>
    body{
       font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
       height:100vh;
       display:flex;
       flex-direction:column;
       background:whitesmoke;
    }
    *{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
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
    .section1{
        margin-top:12vh;
        height:100px;
        width:100%;
        overflow:auto;
        overflow-y:hidden;
    }
    .add-buttons-section{
        display:flex;
        flex-direction:row;
        gap:10px;
       justify-content:center;
       width:100%;
      
    }
     .add-buttons-section button{
         height:70px;
         overflow-wrap:break-word;
         white-space:normal;
         width:150px;
     }
     .parent{
         position:fixed;
         top:0;
         bottom:0;
         left:0;
         right:0;
         background:rgba(0,0,0,0.2);
         display:flex;
         flex-direction:column;
         align-items:center;
         justify-content:center;
         z-index:3200;
         transition:opacity 0.5s;
         opacity:0;
         visibility:hidden;
     }
     .child{
         padding:10px;
         background:white;
         width:90%;
         border-radius:5px;
         box-shadow:0px 4px 8px rgba(0,0,0,0.5);
     }
     .input-container {
            position: relative;
            margin:10px 0;
            display: inline-block;
           width:90%;
          border: 1px solid #ccc;
          border-radius:5px;
          
        }
        .input-container:hover{
            border:1px solid #4caf50;
        }
        .input-field {
            padding: 10px;
            border: 1px solid #ccc;
          border:none;
            border-radius: 5px;
            width: 90%;
            outline: none;
            font-size: 16px;
            z-index:11;
        }
        .label {
            position: absolute;
            left: 12px;
            top: 10px;
            background: white;
            padding: 0 5px;
            color: #aaa;
            transition: 0.2s ease all;
            pointer-events: none;
            z-index:1;
        }
        .input-field:focus + .label,
        .input-field:not(:placeholder-shown) + .label {
            top: -10px;
            font-size: 12px;
            color: #4caf50;
            
        }
        #icon_input,#icon_input2{
            display:none;
        }
        .icon_input_trigger{
            height:40px;
            width:90%;
            background:#2c3e50;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            border-radius:5px;
            color:white;
            
        }
        .icon{
            width:150px;
            height:150px;
            background-size:cover;
            background-position:center;
            margin:5px 0px;
            display:none;
        }
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
        .hide{
            display:none;
        }
        .echo,.warn,#warn,.note,.message,.sub_warn{
          color:red;  
          font-size:0.7rem;
          display:block;
         text-align:center;
         
          width:100%;
        }
        select{
            width:90%;
            height:40px;
            border-radius:5px;
            border:1px solid #ccc;
            margin-bottom:10px;
            background:white;
        }
        select:hover{
            border-color:#4caf50;
        }
    
             .section1{
       
        width:100vw;
        
        
        display:flex;
       
        align-items:center;
       justify-content:center;
    }
    
        
        #categories_section{
            height:auto;
            overflow:auto;
        }
        
        
        
         table {
            width: ;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50; /* Green background */
            color: white;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Light gray for even rows */
        }
        tbody tr:hover {
            background-color: #f1f1f1; /* Light hover effect */
        }
        
}

        .table-container {
        padding: 10px;
        width:auto;
      
        display:flex;
        align-items:center;
        justify-content:center;
        }
        .action{
            width:50px;
            height:50px;
        }
    @media(min-width:800px){
        
        nav{
            width:300px;
        }
        #menu{
            display:none;
            
        }
        .section1{
       
       width: 1000px; 
        max-width: 1200px; 
         padding-left:50px;
        margin-left:300px;
        display:flex;
        align-items:center;
       justify-content:center;
       
    }
    .child{
         padding:10px;
         background:white;
         width:500px;
         border-radius:5px;
     }
    }
    .section2{
            width:1000px;
            max-width:1200px;
            margin-left:400px;
        }
       
        .add-buttons-section {
            width:100%;
    justify-content:flex-start;
    
   
}
       
    }
  
    </style>
  <style>
  /* Center the table section and add padding */
.table-section {
    display: flex;
    flex-direction:column;
    justify-content: center;
    padding: 10px;
    
}
.table-section h3{
   margin-left:15px;
    
}

/* Container for responsive behavior */
.responsive-table-container {
    width: 90%;
    max-width: 1000px;
    overflow-x: auto;
    margin: auto;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    white-space:nowrap;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* Adjust table width for small screens */
@media (max-width: 600px) {
    th, td {
        padding:10px;
        font-size: 14px;
    }
}
  @media(min-width:800px){
      .table-section {
       margin-left: 300px;
       
      }
      .table-section h3{
   margin-left:50px;
    
}
  }
  
  
  
  
  /* For larger screens */
@media(min-width: 800px) {
    .add-buttons-section {
        justify-content: flex-start;
        width: 100%;
    }
}

/* For mobile screens */
@media(max-width: 799px) {
    .add-buttons-section {
        justify-content: center;
        width: 100%;
    }
}

</style> 
<style>
        
        .modal {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            width:100%;
        }
        .modal h2 {
            color: #d9534f; /* Bootstrap danger color */
            margin-bottom: 15px;
        }
        .modal p {
            margin-bottom: 20px;
            color: #555;
        }
        .modal button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            transition: background 0.3s, color 0.3s;
            width:auto;
        }
        .modal .confirm,.modal .conf{
            background: #d9534f; /* Danger color */
            color: white;
        }
        .modal .confirm:hover {
            background: #c9302c; /* Darker shade */
        }
        .modal .conf:hover {
            background: #c9302c; /* Darker shade */
        }
        .modal .cancel {
            background: #f0ad4e; /* Warning color */
            color: white;
        }
        .modal .cancel:hover {
            background: #ec971f; /* Darker shade */
        }
        .modal .canc:hover {
            background: #ec971f; /* Darker shade */
        }
        .modal .canc {
            background: #f0ad4e; /* Warning color */
            color: white;
        }
    </style>
    <style>
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
      <a href="/"><div class="logo"></div></a>
      <div class="notice_div" style="position:relative;margin-left:auto">
      <i id="notifications" class="material-icons">notifications</i><strong class="notify"><?php echo $notice_row; ?></strong>
      <section id='notice' class="notice">
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
        <section class="section1">
            
          <div class="add-buttons-section"><button class="action">Add New Category</button><button class="action">Add New Sub-Category</button></div>  
        </section>
        <section class="parent">
            <div class="child">
                <i id="warn"></i>
                <h3>Add Category</h3>
                <form id="category_form">
                     <div class="input-container">
                        <input name="category" id="category" type="text" class="input-field" placeholder=" " required>
    
    <label class="label">Enter Category name</label>
</div>
<label for="icon_input" class="icon_input_trigger">Upload category icon</label>
<input required class="image_input" id="icon_input" type="file" accept="image/*">
<div class="icon" id="category_image">
    
</div>
<button type="submit">
    Create Category
</button>
                </form>
            </div>
        </section>
        
        
        
    <section class="parent">
            <div class="child">
                <i class="warn" id="warn2"></i>
                <h3>Add Subcategory</h3>
                <form id="subcategory_form">
                     <div class="input-container">
                        <input name="category" id="subcategory" type="text" class="input-field" placeholder=" " required>
    
    <label class="label">Enter Subcategory name</label>
</div>
<div class="input-container">
                        <textarea name="category" id="subcategory_units" class="input-field" placeholder=" " required></textarea>
    
    <label class="label" style="font-size:0.7rem">Enter Subcategory units seperated with commas</label>
</div>
<select required id="select_category">
    <option value="" disabled selected>
      select category
  </option>
  <?php if(mysqli_num_rows($category_option_selected) > 0){
      while($fetch_category_option=mysqli_fetch_assoc($category_option_selected)){
          echo '<option value="'.$fetch_category_option['id'].'">
      '.$fetch_category_option['name'].'
  </option>  ';
      }
  }
  
  
  ?>
  
</select>
<label for="icon_input2" class="icon_input_trigger">Upload Subcategory icon</label>
<input required class="image_input" id="icon_input2" type="file" accept="image/*">
<div class="icon" id="subcategory_image">
    
</div>
<button type="submit">
    Create Subcategory
</button>
                </form>
            </div>
        </section>
        
      
        
        
        
        <section class="table-section">
            <h3>Current Categories</h3>
    <div class="responsive-table-container">
        <table>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Added date</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($categories_selected)>0){
                    $sn=0;
                while($fetch=mysqli_fetch_assoc($categories_selected)){
                    $sn++;
              echo  '<tr>
                    <td>'.$sn.'</td>
                    <td><div style="height:50px;width:50px;background-size:cover;background-image:url(&quot;'.$fetch['icon'].'&quot;);border-radius:5px;background-position:center">
                        
                    </div></td>
                    <td>'.$fetch['name'].'</td>
                    <td><button class="action">Edit</button>
                    <section class="parent">
            <div class="child">
                <i class="note"></i>
                <h3>Edit Category</h3>
                <form class="edit_category_form">
                     <div class="input-container">
                        <input required name="category" value="'.$fetch['name'].'" type="text" class="input-field" placeholder=" " >
    
    <label class="label">Enter Category name</label>
    
</div>
<input class="category_id" type="hidden" value="'.$fetch['id'].'">
<label for="icon_input_'.$fetch['id'].'" class="icon_input_trigger">Change category icon</label>
<input type="hidden" value="'.$fetch['icon'].'" class="default_icon">
<input style="display:none" class="image_input" id="icon_input_'.$fetch['id'].'" type="file" accept="image/*">
<div class="icon" >
    
</div>
<button type="submit">
    Save changes
</button>
                </form>
            </div>
        </section>
                    </td>
                   
                    <td class="delete_td"><button class="action" style="background:red">Delete</button>
                    <section class="parent">
                   <div class="child">
                   
                   <div class="modal">
                   <i class="message"></i>
    <h2><span class="material-icons" style="vertical-align: middle;">delete</span> Delete Confirmation</h2>
    <p>Are you sure you want to delete this Category? This action cannot be undone.</p>
    <input class="confirm_id" type="hidden" value="'.$fetch['id'].'">
    <button class="confirm" >Yes, Delete</button>
    <button class="cancel">Cancel</button>
</div>
                   </div>
               </section> 
                    </td>
                    
                    <td>'.$fetch['date'].'</td>
                </tr>';
                }
                }
                ?>
               
            </tbody>
        </table>
       
    </div>
     
</section>
<section class="paginate-section" style="visibility:<?php 
    if($cpr <= $per_page){
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
    if($page >= $cpc){
        echo "hidden";
    }
    ?>">
         <a href="?page=<?php echo $page+1; ?>"> <i class="material-icons">chevron_right</i></a>
    </button>
    
    
</section>
 <section class="table-section">
      <h3>Current SubCategories</h3>
    <div class="responsive-table-container">
       
        <table>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Units of measurements</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Added date</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($subcategories_selected)>0){
                    $sn=0;
                while($fetch=mysqli_fetch_assoc($subcategories_selected)){
                    $sn++;
                    $cat_id=$fetch['category_id'];
                    $get="SELECT * FROM `categories` WHERE `id`=$cat_id";
                    $gotten=mysqli_query($conn,$get);
                    $carry=mysqli_fetch_assoc($gotten);
                    $category=$carry['name'];
              echo  '<tr>
                    <td>'.$sn.'</td>
                    <td><div style="height:50px;width:50px;background-size:cover;background-image:url(&quot;'.$fetch['icon'].'&quot;);border-radius:5px;background-position:center">
                        
                    </div></td>
                    <td>'.$fetch['name'].'</td>
                    <td>'.$category.'</td>
                    <td>'.$fetch['units'].'</td>
                    <td><button class="action">Edit</button>
                   <section class="parent">
            <div class="child">
                <i class="sub_warn"></i>
                <h3>Edit Subcategory</h3>
                <form class="edit_subcategory_form">
                     <div class="input-container">
                        <input value="'.$fetch['name'].'" name="category"  type="text" class="input-field" placeholder=" " required>
    
    <label class="label">Enter Subcategory name</label>
</div>
<div class="input-container">
                        <textarea name="category"  class="input-field" placeholder=" " required>'.$fetch['units'].'</textarea>
    
    <label class="label" style="font-size:0.7rem">Enter Subcategory units seperated with commas</label>
</div>
<label for="sub_icon_input_'.$fetch['id'].'" class="icon_input_trigger">Change Subcategory icon</label>
<input style="display:none" class="image_input" id="sub_icon_input_'.$fetch['id'].'" type="file" accept="image/*">
<input type="hidden" value="'.$fetch['id'].'" class="change_id">
<input type="hidden" value="'.$fetch['category_id'].'" class="verify_id">
<div class="icon" >
    
</div>
<button type="submit">
   Save changes
</button>
                </form>
            </div>
        </section>
        
      
                    </td>
                   
                    <td class="delete_row"><button class="action" style="background:red">Delete</button>
                    <section class="parent">
                   <div class="child">
                   
                   <div class="modal">
                   <i class="echo"></i>
    <h2><span class="material-icons" style="vertical-align: middle;">delete</span> Delete Confirmation</h2>
    <p>Are you sure you want to delete this SubCategory? This action cannot be undone.</p>
    <input class="conf_id" type="hidden" value="'.$fetch['id'].'">
    <button class="conf" >Yes, Delete</button>
    <button class="cancel">Cancel</button>
</div>
                   </div>
               </section> 
                    </td>
                    
                    <td>'.$fetch['date'].'</td>
                </tr>';
                }
                }
                ?>
               
            </tbody>
        </table>
       
    </div>
     
</section>
<section class="paginate-section" style="visibility:<?php 
    if($csr <= $per_page){
        echo "hidden";
    }
    ?>">
    <button class="paginate-buttons" style="visibility:<?php 
    if($current <= 1){
        echo "hidden";
    }
    ?>">
       <a href="?current=<?php echo $current-1; ?>">  <i class="material-icons">chevron_left</i></a>
    </button>
    <button class="page"><?php echo $current; ?></button>
     <button class="paginate-buttons" style="visibility:<?php 
    if($current >= $csc){
        echo "hidden";
    }
    ?>">
         <a href="?current=<?php echo $current+1; ?>"> <i class="material-icons">chevron_right</i></a>
    </button>
    
    
</section>
    </main>
    <footer>
        
    </footer>
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
  </script> 
  <script>
   let category=document.getElementById("category");
   let category_form=document.getElementById("category_form");
   let loading=document.getElementById("loading");
   let warn=document.getElementById("warn");
   category_form.addEventListener("submit",function(event){
       event.preventDefault();
       loading.style.display="flex";
       let cat=category.value;
       let category_icon=document.getElementById("icon_input");
        let category_image=document.getElementById("category_image");
       let cat_file=category_icon.files[0];
       if(cat_file){
           let formdata=new FormData();
           formdata.append("icon",cat_file);
           formdata.append("category",cat);
           let xhc=new XMLHttpRequest();
           xhc.open("POST","categories_process.php",true);
           xhc.onreadystatechange=function(){
               if(xhc.readyState==4 && xhc.status==200){
                   loading.style.display="none";
                   if(xhc.responseText.includes('success')){
                       warn.style.color="#4caf50";
                   }
                   else{
                        warn.style.color="red";
                   }
                   warn.innerText=xhc.responseText;
                  cat.value="";
                  category_icon.value="";
                  category.value="";
                  category_image.style.display="none";
               }
           }
           xhc.send(formdata);
           
       }
   })
  </script>
  <script>
      let parent=document.getElementsByClassName("parent");
       let action=document.getElementsByClassName("action");
        let child=document.getElementsByClassName("child");
        for(let a=0;a<action.length;a++){
            action[a].addEventListener("click",function(){
                parent[a].style.opacity=1;
                parent[a].style.visibility="visible";
            })
            parent[a].addEventListener("click",function(){
                parent[a].style.visibility="hidden";
                parent[a].style.opacity=0;
            })
            child[a].addEventListener("click",function(){
                event.stopPropagation();
            })
        }
  </script>
  <script>
      let image_input=document.getElementsByClassName("image_input");
      let icon=document.getElementsByClassName("icon");
       for(let i=0;i < image_input.length;i++){
           image_input[i].addEventListener("change",function(){
               if(image_input[i].value==""){
                   icon[i].style.display="none";
                   return;
               }
               let file_selected=this.files[0];
               if(file_selected){
                   let fri=new FileReader();
                   fri.onload=function(){
                      
                       icon[i].style.display="block";
                       icon[i].style.backgroundImage="url('"+fri.result+"')";
                   }
                   fri.readAsDataURL(file_selected);
               }
           })
       }
  </script>
  <script>
      let subcategory_form=document.getElementById("subcategory_form");
      let subcategory=document.getElementById("subcategory");
       let subcategory_units=document.getElementById("subcategory_units");
      let select_category=document.getElementById("select_category");
      let subcategory_image=document.getElementById("subcategory_image");
      let warn2=document.getElementById("warn2");
      subcategory_form.addEventListener("submit",function(event){
          event.preventDefault();
         loading.style.display="flex";
         let sub_icon=document.getElementById("icon_input2");
         let sub_file=sub_icon.files[0];
         if(sub_file){
             let fdata=new FormData();
             fdata.append("icon",sub_file);
             fdata.append("subcategory",subcategory.value);
             fdata.append("subcategory_units",subcategory_units.value);
             fdata.append("category_id",select_category.value);
             let xhs=new XMLHttpRequest();
             xhs.open("POST","categories_process.php",true);
            
           xhs.onreadystatechange=function(){
               if(xhs.readyState==4 && xhs.status==200){
                   
                   loading.style.display="none";
                   if(xhs.responseText.includes('success')){
                       warn2.style.color="#4caf50";
                   }
                   else{
                        warn2.style.color="red";
                   }
                   warn2.innerText=xhs.responseText;
                 subcategory.value="";
                 icon[1].style.display="none";
                  select_category.value="";
               }
           }
             xhs.send(fdata);
         }
      })
  </script>
   <script>
        let edit_category_form=document.getElementsByClassName("edit_category_form");
        let edit_image_input=document.querySelectorAll(".edit_category_form .image_input");
        let edit_cat_input_field=document.querySelectorAll(".edit_category_form .input-field");
        let edit_cat_id=document.querySelectorAll(".edit_category_form .category_id");
        let category_warn=document.getElementsByClassName("note");
        let default_icon=document.getElementsByClassName("default_icon");
        
       for(let e=0;e < edit_category_form.length;e++){
           edit_category_form[e].addEventListener("submit",function(event){
               event.preventDefault();
               loading.style.display="flex";
               
               let edit_cat_file=edit_image_input[e].files[0];
               if(!edit_cat_file){
                   edit_cat_file=default_icon[e].value;
               }
               if(edit_cat_file){
                  let edit_cat_form=new FormData();
                  edit_cat_form.append("icon",edit_cat_file);
                   edit_cat_form.append("edit_category",edit_cat_input_field[e].value);
                   edit_cat_form.append("category_id",edit_cat_id[e].value);
                   let xhe=new XMLHttpRequest();
                   xhe.open("POST","categories_process.php",true);
                   xhe.onreadystatechange=function(){
                       if(xhe.readyState==4  && xhe.status==200){
                           loading.style.display="none";
                           if(xhe.responseText.includes("success")){
                               category_warn[e].style.color="#4caf50";
                           }
                           else{
                              category_warn[e].style.color="red"; 
                           }
                           edit_cat_input_field[e].value="";
                           edit_image_input[e].value="";
                          
                           category_warn[e].innerText=xhe.responseText;
                       }
                       
                   }
                   xhe.send(edit_cat_form);
               }
               
           })
       }
       
     

    </script>
    <script>
        let confirm_button=document.getElementsByClassName("confirm");
         let confirm_id=document.getElementsByClassName("confirm_id");
         let cancel_delete=document.getElementsByClassName("cancel");
          let delete_message=document.getElementsByClassName("message");
          let delete_td=document.querySelectorAll(".delete_td .parent");
        for(let d=0;d < confirm_button.length;d++){
            confirm_button[d].addEventListener('click',function(){
                
                loading.style.display="flex";
                let delete_form=new FormData();
                delete_form.append("delete_category_id",confirm_id[d].value);
                let xhd=new XMLHttpRequest();
                xhd.open("POST","categories_process.php",true);
                xhd.onreadystatechange=function(){
                    if(xhd.readyState==4 && xhd.status==200){
                        loading.style.display="none";
                        if(xhd.responseText.includes("success")){
                            delete_message[d].style.color="#4caf50";
                        }
                        else{
                            delete_message[d].style.color="red"; 
                        }
                       delete_message[d].innerText=xhd.responseText;
                    }
                };
                xhd.send(delete_form);
            })
            cancel_delete[d].addEventListener("click",function(){
               delete_td[d].style.opacity=0;
               delete_td[d].style.visibility="hidden";
            })
            
            
            
        }
        
       
    </script>
    <script>
         let conf=document.getElementsByClassName("conf");
         let conf_id=document.getElementsByClassName("conf_id");
         let ech=document.getElementsByClassName("echo");
         let delete_row=document.querySelectorAll(".delete_row .cancel");
         let delete_parent=document.querySelectorAll(".delete_row .parent")
        for(let u=0;u < conf.length;u++){
            conf[u].addEventListener("click",function(){
                loading.style.display="flex";
                let xhu=new XMLHttpRequest();
                xhu.open("GET","categories_process.php?id="+encodeURIComponent(conf_id[u].value),true);
                xhu.onreadystatechange=function(){
                    if(xhu.status==200 && xhu.readyState==4){
                        loading.style.display="none";
                        if(xhu.responseText.includes("success")){
                                 ech[u].style.color="#4caf50";
                             }
                             else{
                                ech[u].style.color="red";  
                             }
                        ech[u].innerText=xhu.responseText;
                        
                    }
                }
                xhu.send();
            })
            delete_row[u].addEventListener("click",function(){
                delete_parent[u].style.opacity=0;
                delete_parent[u].style.visibility='hidden';
            })
        }
    </script>
    <script>
        let edit_subcategory_form=document.getElementsByClassName("edit_subcategory_form");
         let edit_sub_name=document.querySelectorAll(".edit_subcategory_form input[type=text]");
          let edit_sub_unit=document.querySelectorAll(".edit_subcategory_form textarea");
         let edit_sub_icon=document.querySelectorAll(".edit_subcategory_form .image_input");
         let edit_sub_id=document.getElementsByClassName("change_id");
         let verify_id=document.getElementsByClassName("verify_id");
         let sub_warn=document.getElementsByClassName("sub_warn");
        for(let z=0;z < edit_subcategory_form.length;z++){
            edit_subcategory_form[z].addEventListener("submit",function(event){
                event.preventDefault();
                loading.style.display="flex";
                let edit_sub_file=edit_sub_icon[z].files[0];
                if(!edit_sub_file){
                   edit_sub_file="null";
                }
                if(edit_sub_file){
                    let edit_sub_formdata=new FormData();
                    edit_sub_formdata.append("icon",edit_sub_file);
                    edit_sub_formdata.append("edit_subcategory",edit_sub_name[z].value);
                    edit_sub_formdata.append("edit_subcategory_unit",edit_sub_unit[z].value);
                     edit_sub_formdata.append("sub_id",edit_sub_id[z].value);
                     edit_sub_formdata.append("cat_id",verify_id[z].value);
                     let xhz=new XMLHttpRequest();
                     xhz.open("POST","categories_process.php",true);
                     xhz.onreadystatechange=function(){
                         if(xhz.status==200 && xhz.readyState==4){
                             loading.style.display="none";
                             if(xhz.responseText.includes("success")){
                                sub_warn[z].style.color="#4caf50";
                             }
                             else{
                                sub_warn[z].style.color="red";  
                             }
                             sub_warn[z].innerText=xhz.responseText;
                         }
                     }
                     xhz.send(edit_sub_formdata);
                }
                
            })
        }
        
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
</html>