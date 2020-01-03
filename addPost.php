<?php
   session_start();
   require_once "connect.php";

	$con = new mysqli($host, $db_user, $db_password, $db_name);
		if ($con->connect_errno!=0)
		{
			echo "Error: ".$con->connect_errno;
		}
	// User submited form
	if (isset($_POST['postText']))
	{

		$text = $_POST['postText'];
		
		$ThreadID = $_POST["ThreadID"];
		$userid = $_SESSION['userid'];
		
		if($con->query("INSERT INTO Posts VALUES (NULL, '$text', '$ThreadID', '$userid', NULL)"))
		{
         echo"Dodano post";
		}
		else
		{
         echo"Error";
			throw new Exception($con->error);
		}
		
   }
   
?>