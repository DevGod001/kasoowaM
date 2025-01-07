<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
     $title=str_replace(' ',"",$title);
     $title=strtolower($title);
     $name=$_FILES['image']['name'];
     $tmp=$_FILES['image']['tmp_name'];
     $path=pathinfo($name)['extension'];
     $dest=$title.".".$path;
    if(move_uploaded_file($tmp,$dest)){
        $_SESSION['notice']="uploaded successfully";
        header("Location:upload.php");
        exit;
    }
     else{
          $_SESSION['notice']="failed to upload";
          header("Location:upload.php");
        exit;
     }
}

?>