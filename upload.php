<?php
include  "db.php";
include_once  "Common.php";

if($_FILES['excelDoc']['name']) {
    $allowed_ext = array('csv','xlsx');
    $arrFileName = explode('.', $_FILES['excelDoc']['name']);
    $file_ext = end($arrFileName);
    
    if ($arrFileName[1] == 'csv') {
        $handle = fopen($_FILES['excelDoc']['tmp_name'], "r");
        $count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $count++;
            if ($count == 1) {
                continue;
            }
                $firstname = $db_link->real_escape_string($data[0]);
                $lastname = $db_link->real_escape_string($data[1]);
                $studentnum = $db_link->real_escape_string($data[2]);
                $email = $db_link->real_escape_string($data[3]);
                $hk = $db_link->real_escape_string($data[4]);
                $college = $db_link->real_escape_string($data[5]);
                $common = new Common(); 
                $SheetUpload = $common->uploadData($db_link,$firstname,$lastname,$studentnum,$email,$hk,$college);
        }
        if ($SheetUpload){
            echo "<script>alert('Sheet has been uploaded successfull !');window.location.href='scholars_csdl.php';</script>";
        }
    }else{
        echo "<script>alert('Invalid File Type!');window.location.href='scholars_csdl.php';</script>";
    }
}