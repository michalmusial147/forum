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
   echo"Najpierw się zaloguj?";
}
$Post = $connection->query("Select * from Posts Where PostID = ".$_POST["postID"]);
$Row = $Post->fetch_assoc();

if($Row["userID"] == $UserID) {
   $connection->query("Delete from Posts Where PostID = ".$_POST["postID"]);
   echo "Usunięto";
} 
else {
   echo "To nie jest twój post";
}
?>