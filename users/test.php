<?php
include_once 'connect.php';
$select="SELECT * FROM `users` JOIN `accounts` ON users.id = accounts.user_id ORDER BY `address` ASC";
$selected=mysqli_query($conn,$select);
while($fetch=mysqli_fetch_assoc($selected)){
    echo $fetch['address']."<br>";
}

?>