<?php
   include 'db.php';
   session_start();
   unset($_SESSION['id']);
   header("Location: commlogin.php");
   
?>