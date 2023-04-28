<?php
 session_start();
 if(!isset($_SESSION['AdminLoginId']))
 {
    header("location: AdminLogin.php");
 }
 else
 {
   header("location: ./panel/index.php");
 }
?>