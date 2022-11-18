<?php

class Common
{
  public function uploadData($db_link,$firstname,$lastname,$studentnum,$email,$hk,$college)
  {
      $mainQuery = "INSERT INTO listofmembers SET fname='$firstname',lname='$lastname',snum='$studentnum',email='$email',hkcategory='$hkcategory',college='$college'";
      $result1 = $db_link->query($mainQuery) or die("Error in main Query".$db_link->error);
      return $result1;
  }
}

?>