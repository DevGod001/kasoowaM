<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
if(!isset($_COOKIE['username'])){
    header('Location:login');
    exit;
}
$user_id=$_COOKIE['user_id'];
$select="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
$selected=mysqli_query($conn,$select);
$row=mysqli_num_rows($selected);
if($row > 0){
    header('Location:/');
    exit;
}


$sel="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
$seld=mysqli_query($conn,$sel);
$sea="SELECT * FROM `categories` WHERE 1 ORDER BY `name` ASC";
$sead=mysqli_query($conn,$sea);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Shop the latest products at our e-commerce store.">
    <meta name="keywords" content="e-commerce, online shopping, buy products, groceries,kasoowa, Shopify, delivery">
   
    <title>Account Setup</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="E-Commerce Store">
    <meta property="og:description" content="Shop the latest products at our store.">
    <meta property="og:image" content="<?php echo $image; ?>"> <!-- Link to your image -->
    <meta property="og:url" content="<?php echo $url; ?>"> <!-- Your website URL -->
    <meta property="og:type" content="website">
    
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="shortcut icon" href="../kasoowa.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="app.json">
    <style>
    *{
        font-family:Roboto;
    }
       body{
           background:whitesmoke;
           display:flex;
           flex-direction:column;
           align-items:center;
           justify-content:center;
          
       }
       html,body{
           margin:0;
           padding:0;
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
            overflow:hidden;
        }
        .input-field:focus + .label,
        .input-field:not(:placeholder-shown) + .label {
            top: -10px;
            font-size: 12px;
            color: #4caf50;
            
        }
       .section1{
           width:100vw;
           max-width:700px;
           display:flex;
           flex-direction:column;
           align-items:center;
           padding:10vh 0%;
           height:auto;
           overflow:hidden;
         overflow-y:scroll;
         padding-bottom:10px;
       }
     
       .s1_div{
           background:white;
           width:90%;
           border-radius:10px;
           padding:10% 2%;
           box-shadow:0px 0px 10px -5px black;
           display:flex;
           flex-direction:column;
           align-items:center;
           justify-content:center;
           text-align:center;
           overflow-x:visible;
           
        
       }
      
       #welcome{
           
           white-space:pre-wrap;
           
           
       }
       .welcome{
           width:100%;
           display :flex;
           flex-direction:column;
           align-items:center;
           justify-content:center;
       }
       .buttons{
           display:flex;
           flex-direction:column;
           align-items:center;
           justify-content:space-between;
           width:100%;
           gap:10px;
       }
       .type{
           width:100%;
           background:#4caf50;
           border:none;
           height:40px;
           color:white;
           border-radius:5px;
           font-weight:bold;
           cursor:pointer;
       }
       .form,form{
           width:100%;
           display:flex;
           flex-direction:column;
           align-items:center;
           justify-content:center;
       }
       .style{
          display:none;
       }
       button[type=submit]{
           background:#4caf50;
           border:none;
           width:100%;
           height:40px;
           border-radius:5px;
           font-weight:bold;
           color:white;
           margin:5% 0%;
       }
       .form{
           display:none;
           margin:2%;
       }
       
       #profile{
           max-height:100%;
           max-width:100%;
          
       }
       .pic{
           height:150px;
           width:150px;
           border-radius:50%;
           background:silver;
           border:1px solid #545454;
           overflow:hidden;
           background-size:cover;
           background-position:center;
       }
       .hide{
           display:none;
       }
       .show{
           display:flex;
       }
       
    .select_section{
        height:40px;
        width:90%;
        border:1px solid silver;
        border-radius:5px;
        display:flex;
        align-items:center;    
        justify-content:space-between;
        position: relative;
        oveerflow:visible;
        z-index:1800;
        padding:5px;
    }
    .product_list{
        width:100%;
        background:white;
        border:1px solid silver;
      
        position: absolute;
        top:100%;
        left:0;
        margin-top:5px;
         margin-bottom:50px;
        display:none;
        flex-direction:column;
        align-items:center;
        justify-content:flex-start;
        max-height:200px;
        overflow: scroll;
        overflow-x:hidden;
        border-radius:5px;
       
    }
  
    .categories{
        width:100%;
        display:flex;
       flex-direction:row;
       align-items:center;
      padding:1%;
      
    }
    .categories label{
        flex:1;
      
    }
.categories:hover{
    background:#4caf50;
}
.select_section:hover{
        border-color:#4caf50;
    }
    
    .warn{
        font-size:0.7rem;
        color:red;
    }
    .material-icons{
        user-select:none;
    }
        @media(min-width:800px){
           .s1_div{
               border-radius:10px;
               
           }
           .buttons{
               flex-direction:row;
           }
           .section1{
          
         padding-bottom:20vh;
       }
     
       }
       .address_div *{
           font-size:0.9rem;
           
       }
       .address_div{
           border:1px solid silver;
           border-radius:5px;
           padding:5px;
           width:90%;
           display:flex;
           flex-direction:column;
           align-items:flex-start;
           margin:10px 0;
       }
       .update_button{
           border:none;
           font-family:teachers;
           font-size:0.9rem;
           background:rgba(144,255,144,0.5);
           color:green;
           margin:0 10px;
           padding:5px;
           border-radius:2px;
           display:flex;
           align-items:center;
           
       }
       
       
    </style>
    <style>
        .add_parent{
            background:rgba(0,0,0,0.5);
            position:fixed;
            top:0;
            bottom:0;
            left:0;
            right:0;
            display:none;
            align-items: center;
            justify-content:center;
            z-index:20000;
        }
        .add_child{
            padding:10px;
            background:white;
            width:90%;
            border-radius:5px;
            box-shadow:0px 4px 8px rgba(0,0,0,0.3);
            font-family:teachers;
            display:flex;
            flex-direction:column;
            gap:10px;
        }
        
        @media(min-width:800px){
           .add_child{
               width:500px;
               padding:20px;
           }
        }
        .cont{
            width:100%;
            height:40px;
            border:1px solid silver;
            border-radius:3px;
            position:relative;
        }
        .cont_input{
            width:95%;
            height:90%;
            border:none;
            outline:none;
           background:white;
           font-family:teachers;
           font-size:0.9rem;
        }
        .float{
            position:absolute;
            pointer-events:none;
            top:25%;
            left:5%;
            background:white;
            color#708090;
            transition:top 0.5s;
            padding:0 5px;
            font-family:teachers;
        }
        .cont_input:focus + .float,.cont_input:not(:placeholder-shown) + .float{
            top:-25%;
            color:#4caf50;
        }
        *{
            outline:none;
        }
        .update_address{
            height:40px;
            border:none;
            color:white;
            font-weight:bold;
            font-family:teachers;
            background:linear-gradient(to right,green,lightgreen);
            border-radius:4px;
            margin:10px 0;
        }
        .add_form{
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:10px;
        }
        .add_form *not(.float){
            width:90%;
        }
        .add_form button{
            width:100%;
        }
        .vibrate{
            border-color:red;
            animation:shake 0.5s linear;
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
        .done_button{
            border:none;
            padding:5px 10px;
            background:linear-gradient(to right,green,lightgreen);
            color:white;
            margin:10px 10px 10px auto;
            
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
        .map_section{
           position:fixed;
           bottom:0%;
           left:0%;
           right:0%;
           background:rgba(0,0,0,0.5);
           height:100vh; 
           z-index:1900;
           

        }
        .iframe{
            background:white;
            position:absolute;
            bottom:-100%;
            transition-duration:1s;
            left:0;
            right:0;
            width:100%;
            height:60%;
            border-radius:25px 25px 0px 0px;
            border:0.1px solid silver;
            box-shadow:0px 4px 8px rgba(0,0,0,0.8);
          z-index:1900;
        }
        .bottom{
            bottom:0%;
            transition-duration:1s;
        }
        .alert_div{
            z-index:600;
            position:absolute;
            background:#4caf50;
            top:10%;
            left:50%;
            transform:translate(-50%);
            border-radius:5px;
            box-shadow:0px 4px 8px rgba(0,0,0,0.5);
            padding:10px;


        }
        .alert_div *{
            font-family:poppins;
            color:white;
            font-size:0.9rem;
        }
      
    </style>
</head>
<body>
   
     <section class="loading" id="loading">
                       <div class="dots">
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                           <span class="dot">•</span>
                       </div>      
                         </section>
        
    <section class="section1">
        
        <div class="s1_div">
            <section class="welcome">
          <h2 id="welcome"></h2>
          
          </section>
          <p style="color:#767676">To better assist you please let us know your role:</p>
          <section class='buttons' id="buttons">
              <button class="type" id="type">I am a Buyer</button>
              <button class="type">I am a Seller</button>
            
          </section>
           <i class="warn"><?php if(isset($_SESSION['buy'])){
              echo $_SESSION['buy'];
              unset($_SESSION['buy']);
              }
              ?></i>
              <i class="warn"><?php if(isset($_SESSION['sell'])){
              echo $_SESSION['sell'];
              unset($_SESSION['sell']);
              }
              ?></i>
           <section class="form" id="buyer_form">
              <div class="pic" id="buyer_pic"></div>
              
                  <form action="complete_process.php" method="post" enctype="multipart/form-data">
    <label style="height:40px;width:70%;background:#4caf50;border:none;border-radius:5px;display:block;text-align:center;font-weight:bold;display:flex;flex-direction:column;align-items:center;justify-content:center;color:white;font-size:0.8rem;margin-top:2%" for="buyer_profile_picture">Upload profile picture</label>
    <input id="buyer_profile_picture" name="profile" style="display:none;" type="file" accept="image/*">
    
   
    
   
    
    
    <div class='address_div'>
        <input type="hidden" class='address_input' name='address'>
      <span class='address_span' style="font-family:teachers">Add delivery/home address</span><button class="update_button"><i class="material-icons">edit</i>update address</button>  <section class="add_parent">
        <div class="add_child">
            <strong style='font-family:poppins'>Update Address </strong>
            <section class="add_form">
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter your street address</label>
                </div>
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Apartment, suite etc (optional)</label>  
                </div>
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter your City</label>
                </div>
                <?php 
                    $select="SELECT * FROM `users` WHERE `id`=$user_id";
                    $selected=mysqli_query($conn,$select);
                    $fetch=mysqli_fetch_assoc($selected);
                    $country=$fetch['country'];
                    
                    switch($country){
                        case "nigeria":
                        $zip_code= '';
                        break;
                        default:
                            $zip_code=' <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter zip code</label>
                    
                </div>';
                break;
                       }
                    echo $zip_code;
                    ?>
               
                <div class="cont">
                    <?php 
                    $select="SELECT * FROM `users` WHERE `id`=$user_id";
                    $selected=mysqli_query($conn,$select);
                    $fetch=mysqli_fetch_assoc($selected);
                    $country=$fetch['country'];
                    
                    switch($country){ 
                        case "nigeria":
                        $label="Select State";    
                    $states='<option value="" selected disabled>--- Click to select state ---</option>
                <option value="Abia">Abia</option>
                <option value="Abuja">Abuja</option>
<option value="Adamawa">Adamawa</option>
<option value="Akwa Ibom">Akwa Ibom</option>
<option value="Anambra">Anambra</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Enugu">Enugu</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nasarawa">Nasarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun">Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau">Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba">Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>';
                 break;   
                    case "united_states":
        $label="Select State";
        $states='<option value="" selected disabled>--- Click to select state ---</option>
<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>';
break; 
        case "ghana":
          $label="Select Region";
          $states='<option selected disabled>--- Click to select region ---</option>
<option value="Ahafo">Ahafo</option>
<option value="Ashanti">Ashanti</option>
<option value="Bono">Bono</option>
<option value="Bono East">Bono East</option>
<option value="Central">Central</option>
<option value="Eastern">Eastern</option>
<option value="Greater Accra">Greater Accra</option>
<option value="Northern">Northern</option>
<option value="Oti">Oti</option>
<option value="Savannah">Savannah</option>
<option value="Western">Western</option>
<option value="Western North">Western North</option>
<option value="Upper East">Upper East</option>
<option value="Upper West">Upper West</option>
<option value="Volta">Volta</option>
<option value="North East">North East</option>';
           break;
            case "cameroon":
         $label="Select Region";
         $states='<option selected disabled>--- Click to select region ---</option>
<option value="Adamawa">Adamawa</option>
<option value="Central">Central</option>
<option value="East">East</option>
<option value="Far North">Far North</option>
<option value="Littoral">Littoral</option>
<option value="North">North</option>
<option value="North West">North West</option>
<option value="South">South</option>
<option value="South West">South West</option>
<option value="West">West</option>';
           break;
           case "canada":
           $label="Select Province/territory";
           $states='<option selected disabled>--- Click to select province/territory ---</option>
<option value="Alberta">Alberta</option>
<option value="British Columbia">British Columbia</option>
<option value="Manitoba">Manitoba</option>
<option value="New Brunswick">New Brunswick</option>
<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
<option value="Nova Scotia">Nova Scotia</option>
<option value="Ontario">Ontario</option>
<option value="Prince Edward Island">Prince Edward Island</option>
<option value="Quebec">Quebec</option>
<option value="Saskatchewan">Saskatchewan</option>
<option value="Northwest Territories">Northwest Territories</option>
<option value="Nunavut">Nunavut</option>
<option value="Yukon">Yukon</option>';
            break;
            case "united_kingdom":
           $label="Select Country";
          $states='<option selected disabled>--- Click to select country ---</option>
<option value="England">England</option>
<option value="Scotland">Scotland</option>
<option value="Wales">Wales</option>
<option value="Northern Ireland">Northern Ireland</option>';
        break;
                    } 
                    ?>
                    <select class="cont_input">
                       <?php echo $states; ?>
                    </select>
                    <label class="float"><?php echo $label; ?></label>
                    
                </div>
             <button class='update_address' type='button'>update address</button>
            </section>
        </div>
    </section>
  </div>
    
         <section class="select_section" >
        <span style="font-family:teachers" class="buyer_what">Select preferred products </span>
        <i class="material-icons">arrow_drop_down</i>
        <div class="product_list">
            <div class="categories">
              <input value="all" id="category_0"type ="checkbox">
              <label style="font-family:teachers" for="category_0">All Categories</label>
              
          </div>
          <?php
            while($fet=mysqli_fetch_assoc($seld)){
             echo '<div class="categories">
              <input class="categories_checks" value="'.$fet['name'].'" id="category_'.$fet['id'].'"type ="checkbox">
              <label style="font-family:teachers" for="category_'.$fet['id'].'">'.$fet['name'].'</label>
              
          </div>';
          }
          ?>
          
           <div class="categories">
              <input id="category_null" value="null" type ="checkbox">
              <label style="font-family:teachers" for="category_null">Rather not say</label>
               </div>
               
               
               
            <button class="done_button" type="button">DONE</button>   
               
        </div>
    </section>
    <input class="hidden_product_input" type ="hidden" id="hidden" name="product" >
    
     
    <button type="submit" name="buyer">Create Account</button>
</form>

          </section>
          <section class="form" id="seller_form">
              <div class="pic" id="seller_pic"></div>
              <form action="complete_process.php" method="post" enctype="multipart/form-data">
                  <label style="height:40px;width:70%;background:#4caf50;border:none;border-radius:5px;display:block;text-align:center;font-weight:bold;display:flex;flex-direction:column;align-items:center;justify-content:center;color:white;font-size:0.8rem;margin-top:2%" for="image_file" >Upload business banner or logo</label>
                  <input name="profile" id="image_file" style="display:none;" type="file" accept="image/*">
                 <div class="input-container" >
                        <input name="business" type="text" class="input-field" placeholder=" " required>
    
    <label style="font-size:0.9rem" class="label">Enter your Business/Company name</label>
</div>  
  <section class="select_section" >
        <span class="seller_what" style="font-family:teachers">What products do you sell? </span>
        <i class="material-icons">arrow_drop_down</i>
        <div class="product_list">
             
          <?php
            while($fe=mysqli_fetch_assoc($sead)){
             echo '<div class="categories">
              <input class="seller_checks" value="'.$fe['name'].'" id="category2_'.$fe['id'].'"type ="checkbox">
              <label style="font-family:teachers" for="category2_'.$fe['id'].'">'.$fe['name'].'</label>
              
          </div>';
          }
          ?>
               
               
               
              <button class="done_button" type="button">DONE</button>   
             
               
        </div>
    </section>
    <div class="input-container" >
                        <input name="minimum_order" type="number" class="input-field" placeholder=" " required>
    
    <label style="font-size:0.7rem" class="label">Enter Minimum Order amount for your buyers</label>
</div>  
    <input class="hidden_product_input" type ="hidden" id="hide" name="product" >
    
  <div class="input-container" >
                        <input name="mail" type="email" class="input-field" placeholder=" " >
    
    <label class="label">Contact mail(optional)</label>
</div>  
  <div class="input-container" >
                        <input name="mobile" type="number" class="input-field" placeholder=" " >
    
    <label class="label">Contact number(optional)</label>
</div> 
<input type="hidden" class='address_input' name="address">
  <div class='address_div'>
      <span class="address_span" style="font-family:teachers">Add Store address</span><button class="update_button"><i class="material-icons">edit</i>update address</button>  <section class="add_parent">
        <div class="add_child">
            <strong style='font-family:poppins'>Update Address </strong>
            <section class="add_form">
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter your store street address</label>
                </div>
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Apartment, suite etc (optional)</label>  
                </div>
                <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter the city your store is located</label>
                </div>
                <?php 
                    $select="SELECT * FROM `users` WHERE `id`=$user_id";
                    $selected=mysqli_query($conn,$select);
                    $fetch=mysqli_fetch_assoc($selected);
                    $country=$fetch['country'];
                    
                    switch($country){
                        case "nigeria":
                        $zip_code= '';
                        break;
                        default:
                            $zip_code=' <div class="cont">
                    <input type="text" placeholder=" " class="cont_input">
                    <label class="float">Enter zip code</label>
                    
                </div>';
                break;
                       }
                    echo $zip_code;
                    ?>
               
                <div class="cont">
                    <?php 
                    $select="SELECT * FROM `users` WHERE `id`=$user_id";
                    $selected=mysqli_query($conn,$select);
                    $fetch=mysqli_fetch_assoc($selected);
                    $country=$fetch['country'];
                    
                    switch($country){ 
                        case "nigeria":
                        $label="Select State";    
                    $states='<option value="" selected disabled>--- Click to select state ---</option>
                <option value="Abia">Abia</option>
<option value="Adamawa">Adamawa</option>
<option value="Akwa Ibom">Akwa Ibom</option>
<option value="Anambra">Anambra</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Enugu">Enugu</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nasarawa">Nasarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun">Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau">Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba">Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>';
                 break;   
                    case "united_states":
        $label="Select State";
        $states='<option value="" selected disabled>--- Click to select state ---</option>
<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>';
break; 
        case "ghana":
          $label="Select Region";
          $states='<option selected disabled>--- Click to select region ---</option>
<option value="Ahafo">Ahafo</option>
<option value="Ashanti">Ashanti</option>
<option value="Bono">Bono</option>
<option value="Bono East">Bono East</option>
<option value="Central">Central</option>
<option value="Eastern">Eastern</option>
<option value="Greater Accra">Greater Accra</option>
<option value="Northern">Northern</option>
<option value="Oti">Oti</option>
<option value="Savannah">Savannah</option>
<option value="Western">Western</option>
<option value="Western North">Western North</option>
<option value="Upper East">Upper East</option>
<option value="Upper West">Upper West</option>
<option value="Volta">Volta</option>
<option value="North East">North East</option>';
           break;
            case "cameroon":
         $label="Select Region";
         $states='<option selected disabled>--- Click to select region ---</option>
<option value="Adamawa">Adamawa</option>
<option value="Central">Central</option>
<option value="East">East</option>
<option value="Far North">Far North</option>
<option value="Littoral">Littoral</option>
<option value="North">North</option>
<option value="North West">North West</option>
<option value="South">South</option>
<option value="South West">South West</option>
<option value="West">West</option>';
           break;
           case "canada":
           $label="Select Province/territory";
           $states='<option selected disabled>--- Click to select province/territory ---</option>
<option value="Alberta">Alberta</option>
<option value="British Columbia">British Columbia</option>
<option value="Manitoba">Manitoba</option>
<option value="New Brunswick">New Brunswick</option>
<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
<option value="Nova Scotia">Nova Scotia</option>
<option value="Ontario">Ontario</option>
<option value="Prince Edward Island">Prince Edward Island</option>
<option value="Quebec">Quebec</option>
<option value="Saskatchewan">Saskatchewan</option>
<option value="Northwest Territories">Northwest Territories</option>
<option value="Nunavut">Nunavut</option>
<option value="Yukon">Yukon</option>';
            break;
            case "united_kingdom":
           $label="Select Country";
          $states='<option selected disabled>--- Click to select country ---</option>
<option value="England">England</option>
<option value="Scotland">Scotland</option>
<option value="Wales">Wales</option>
<option value="Northern Ireland">Northern Ireland</option>';
        break;
                    } 
                    ?>
                    <select class="cont_input">
                       <?php echo $states; ?>
                    </select>
                    <label class="float"><?php echo $label; ?></label>
                    
                </div>
             <button class='update_address' type='button'>update address</button>
            </section>
        </div>
    </section>
  </div>
<button type="submit" name="seller">Create Store</button>
              </form>
          </section>
        </div>
        
    </section>
    <input type="hidden" value="<?php echo $country; ?>" class="hidden_country">
    <input type="hidden" value="" class="coordinates_status">
   
    <script src="complete.js?v=1.0">
        
    </script>
    <script>
        window.onload=function(){
            welcome_user("<?php echo $_COOKIE['username']; ?>");
        }
    </script>
</body>
</html>