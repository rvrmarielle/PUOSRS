<?php
   include 'db.php';
   session_start();
   unset($_SESSION['id']);
   header("Location: student_login.php");
   
?>