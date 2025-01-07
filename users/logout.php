<?php

 setcookie("user_key","",time()-86400);
  setcookie("user_id","",time()-86400);
   setcookie("home_user_id","",time()-86400,'/');
 header('Location:login');
 exit;




?>