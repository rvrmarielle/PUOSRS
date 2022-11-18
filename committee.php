<?php
include("db.php");
session_start();


// approved delete
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 $_SESSION['label']="Submit Successfuly";
 $db_link->query("DELETE FROM tbl_form WHERE id=$id") or die($db_link->error);
    header("Location: pending_committee.php");
   
}










