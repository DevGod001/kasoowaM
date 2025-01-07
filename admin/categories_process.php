<?php
session_start();
include_once 'connect.php';
if(isset($_POST['category'])){
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $name=$_FILES['icon']['name'];
     $tmp=$_FILES['icon']['tmp_name'];
    $select="SELECT * FROM `categories` WHERE `name`='$category'";
    $selected=mysqli_query($conn,$select);
    if(mysqli_num_rows($selected) > 0){
        echo "category already exists";
        exit;
    }
    $dir="../icons";
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
        
    }
    $dest=$dir."/".$name;
    if(move_uploaded_file($tmp,$dest)){
        $insert="INSERT INTO `categories`(`name`,`icon`) VALUES('$category','$dest')";
        $inserted=mysqli_query($conn,$insert);
        if($inserted){
            echo "category created successfully";
            exit;
        }
    }
}
if(isset($_POST['subcategory'])){
    $subcategory=mysqli_real_escape_string($conn,$_POST['subcategory']);
    $subcategory_units=mysqli_real_escape_string($conn,$_POST['subcategory_units']);
    
    $category=mysqli_real_escape_string($conn,$_POST['category_id']);
   $name=$_FILES['icon']['name'];
   $tmp=$_FILES['icon']['tmp_name'];
    $select="SELECT * FROM `subcategories` WHERE `name`='$subcategory' AND `category_id`=$category";
    $selected=mysqli_query($conn,$select);
    if(mysqli_num_rows($selected) > 0){
        echo "subcategory already exists";
        exit;
    }
   $dir="../icons";
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
        
    }
    $dest=$dir."/".$name;
}
  if(move_uploaded_file($tmp,$dest)){
        $insert="INSERT INTO `subcategories`(`name`,`category_id`,`icon`,`units`) VALUES('$subcategory',$category,'$dest','$subcategory_units')";
        $inserted=mysqli_query($conn,$insert);
        if($inserted){
            echo "subcategory created successfully";
            exit;
        }
    }
if(isset($_POST['category_id'])){
    $category=mysqli_real_escape_string($conn,$_POST['edit_category']);
    $category_id=mysqli_real_escape_string($conn,$_POST['category_id']);
    $name=$_FILES['icon']['name'];
    $tmp=$_FILES['icon']['tmp_name'];
   $select="SELECT * FROM `categories` WHERE `name`='$category' AND `id` <> $category_id";
    $selected=mysqli_query($conn,$select);
    $dir="../icons";
    if(mysqli_num_rows($selected) > 0){
        echo "category already exists";
        exit;
    }
    $select="SELECT * FROM `categories` WHERE `id`=$category_id";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    if(empty($name)){
        $dest=$fetch['icon'];
        
    }
      else{
          $dest=$dir."/".$name;
          move_uploaded_file($tmp,$dest);
      }
    if(empty($category)){
        $category=$fetch['name'];
    }
   $update="UPDATE `categories` SET `name`='$category',`icon`='$dest' WHERE `id`=$category_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
       echo "category updated successfully,refresh to see changes";
   }
}
if(isset($_POST['delete_category_id'])){
    $id=mysqli_real_escape_string($conn,$_POST['delete_category_id']);
    $select="SELECT * FROM `categories` WHERE `id`=$id";
    $selected=mysqli_query($conn,$select);
    if(mysqli_num_rows($selected)==0){
        echo "Category does not exists or may have been deleted";
        exit;
    }
    else{
        $delete="DELETE FROM `categories` WHERE `id`=$id";
        $deleted=mysqli_query($conn,$delete);
        if($deleted){
            echo "Category deleted successfully, kindly refresh to see changes";
            exit;
        }
    }
}
if(isset($_POST['edit_subcategory'])){
    $subcategory=mysqli_real_escape_string($conn,$_POST['edit_subcategory']);
    $unit=mysqli_real_escape_string($conn,$_POST['edit_subcategory_unit']);
     $sub_id=mysqli_real_escape_string($conn,$_POST['sub_id']);
      $cat_id=mysqli_real_escape_string($conn,$_POST['cat_id']);
     $name=$_FILES['icon']['name'];
     $tmp=$_FILES['icon']['tmp_name'];
     
     $select="SELECT * FROM `subcategories` WHERE `name`='$subcategory' AND `category_id`=$cat_id AND `id` <> $sub_id";
    $selected=mysqli_query($conn,$select);
    if(mysqli_num_rows($selected) > 0){
        echo "subcategory already exists";
        exit;
    }
     $select="SELECT * FROM `subcategories` WHERE `id`=$sub_id";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    if(empty($name)){
        $dest=$fetch['icon'];
    }
    else{
        $dir="../icons";
          $dest=$dir."/".$name;
          move_uploaded_file($tmp,$dest);
      }
    
   $update="UPDATE `subcategories` SET `name`='$subcategory',`icon`='$dest',`units`='$unit' WHERE `id`=$sub_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
       echo "Subcategory updated successfully";
       exit;
   }
}
if($_SERVER['REQUEST_METHOD']=="GET"){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
   $select="SElECT * FROM `subcategories` WHERE `id`=$id";
   $selected=mysqli_query($conn,$select);
   if(mysqli_num_rows($selected)==0){
       echo "SubCategory does not exists or may have been deleted";
       exit;
   }
   else{
       $delete="DELETE FROM `subcategories` WHERE `id`=$id";
       $deleted=mysqli_query($conn,$delete);
       if($deleted){
           echo "subcategory deleted successfully,kindly refresh to see changes";
           exit;
       }
   }
}
?>