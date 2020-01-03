<?php

session_start();
require_once "connect.php";
$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno!=0)
{
   echo "Error: ".$connection->connect_errno;
}

$ok = $connection->query("Insert into Threads Values (null, '".$_POST["newthread"].
"' , ".$_POST["CategoryID"].", null, null, ".$_SESSION["userid"].")");


if($ok) {
   echo "Dodano wątek";
} 
else {
   echo "Error"."Insert into Threads Values (null, ".$_POST["newthread"].
   " , ".$_POST["CategoryID"].", null, null, ".$_SESSION["userid"].")";
}
?>