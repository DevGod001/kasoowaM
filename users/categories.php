<?php
session_start();
include_once 'connect.php';
if(isset($_POST['category'])){
    $id=mysqli_real_escape_string($conn,$_POST['category']);
    $select="SELECT * FROM `subcategories` WHERE `category_id`=$id ORDER BY `name` ASC";
    $selected=mysqli_query($conn,$select);
    while($fetch=mysqli_fetch_assoc($selected)){
echo '<label  class="subs"><div class="icon" style="background-image:url(&quot;'.$fetch['icon'].'&quot;)"></div><input type ="hidden" value="'.$fetch['id'].'" class="hidden_subcat_id"><span class="sub_name">'.$fetch['name'].'</span><i class="material-icons">chevron_right</i></label></label>';
    }                 
}
?>