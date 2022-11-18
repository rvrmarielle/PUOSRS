<?php

//import.php

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
 fgetcsv($file_data);
 while($row = fgetcsv($file_data))
 {
  $data[] = array(
   'name'  => $row[0],
   'snum'  => $row[1],
   'hk'  => $row[2],
   'cnum'  => $row[3],
   'stat'  => $row[4]
  );
 }
 echo json_encode($data);
}

?>