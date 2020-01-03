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
$Thread = $connection->query("Select * from Threads Where ThreadID = ".$_POST["threadID"]);
$Row = $Thread->fetch_assoc();

if($Row["UserID"] == $UserID) {
   $connection->query("Delete from Threads Where ThreadID = ".$_POST["threadID"]);
   echo "Usunięto wątek";
} 
else {
   echo "To nie jest twój wątek";
}
?>