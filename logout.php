<?php
   include 'db.php';
   session_start();
   unset($_SESSION['id']);
   header("Location: csdl_login.php");
   
?>