<?php
session_start();
require_once "connect.php";
$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno!=0)
{
   echo "Error: ".$connection->connect_errno;
}
$UserID = $_SESSION['userid'];
if(! isset($_SESSION)){
   echo "Najpierw się zaloguj?";
}
if($_SESSION['admin'] == true) 
{
   $name = $_POST["newcategory"];
   if($connection->query("Insert INTO Categories Values (null, '$name', null)"))
   {
      echo "Dodano kategorię:";
   }
   else
   {
      echo"Error";
      throw new Exception($connection->error);
   }
} 
else {
   echo "To nie jest twój wątek";
}
?>