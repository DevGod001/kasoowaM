<?php
$current_file=basename($_SERVER['PHP_SELF']);
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url=str_replace($current_file,"checkout_process.php",$url);
echo $url;


?>