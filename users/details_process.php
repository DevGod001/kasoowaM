<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
    $_SESSION['clicked']="clicked";
    exit;
}

?>