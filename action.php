<?php

require ("db.php");
session_start();

//login functions


    if(isset($_POST['submit']))
    {
            
            if(empty($_POST['username']) || empty($_POST['password']))
            {
                   header("location:login.php?Empty=Please Fill in the Blanks");   
            }else{
                    $query="SELECT * FROM login WHERE username='".$_POST['username']."' and password = '".$_POST['password']."'";

                    $result=mysqli_query($db_link,$query);

                    if(mysqli_fetch_assoc($result)){
                            $_SESSION['user']=$_POST['username'];
                            header("location:home_csdl.php");
                    }else{
                            header("location: index.php?Invalid= Incorrect username or password");
                    }
            }
    }else{
            echo "not working";
    }

    


?>