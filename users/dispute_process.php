<?php
session_start();
include_once 'connect.php';
$user_id=$_COOKIE['user_id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $order_id=mysqli_real_escape_string($conn,$_POST['order_id']);
    $dispute_reason=mysqli_real_escape_string($conn,$_POST['dispute_reason']);
    $details=mysqli_real_escape_string($conn,$_POST['details']);
    if($dispute_reason == 'other'){
        $custom=mysqli_real_escape_string($conn,$_POST['custom']);
        
    }
     else{
        $custom=$dispute_reason;
     }
     $files=$_FILES['attach'];
     $dir="attachment";
     if(!is_dir($dir)){
        mkdir($dir,0777,true);
     }
     $attach=[];
for($i=0;$i < count($files['name']);$i++){
    $name=$_FILES['attach']['name'][$i];
    $tmp=$_FILES['attach']['tmp_name'][$i];
    $dest=$dir."/".$name;
    if(move_uploaded_file($tmp,$dest)){
        $attach[]=$dest;
    }
    
}
$dispute_id=uniqid("disp_");
$attachment = implode(',',$attach);
$insert="INSERT INTO `dispute`(`order_id`,`uniqid`,`dispute_reason`,`custom`,`details`,`user_id`,`attachment`) VALUES('$order_id','$dispute_id','$dispute_reason','$custom','$details',$user_id,'$attachment')";
 $inserted=mysqli_query($conn,$insert);
 if($inserted){
    $uniqid=uniqid("inb_");
    $insert2="INSERT INTO `inbox`(`sender`,`dispute_id`,`uniqid`,`subject`,`message`,`photo`,`status`) VALUES($user_id,'$dispute_id','$uniqid','dispute','$details','$attachment','active')";
    $inserted2=mysqli_query($conn,$insert2);
    if($inserted2){
        header('Location:inbox');
        exit;
    }
 }
}


?>