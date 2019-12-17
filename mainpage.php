<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	require_once "connect.php";
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="theme.css"/>
	<title>Forum - miejsce spotkań filozofów </title>
</head>

<body>
	<div id="container">
	<?php
		echo "<p>Witaj ".$_SESSION['username'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
		//echo "<p><b>E-mail</b>: ".$_SESSION['email'];
		echo "<br /><b>Data wygaśnięcia subskrypcji</b>: ".$_SESSION['dnipremium']."</p>";

		$dataczas = new DateTime();

		echo "Data i czas zalogowania: ".$dataczas->format('Y-m-d H:i:s')."<br>";

		$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);
		$roznica = $dataczas->diff($koniec);

		if($dataczas<$koniec)
		echo "Pozostało subskrypcji: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');
		else
		echo "Subskrypcji nieaktywna od: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');

		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno!=0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		$result = $connection->query("Select CategoryName from Categories Order by CategoryName");
		if ($result->num_rows > 0) {
		  echo"<table id='std_table'>"
		  ."<thead>"
			  ."<tr>"
			  .	"<th>Kategoria</th>"
			  ."</tr>"
		  ."</thead>"
		  ."<tbody>";
		  while($row = $result->fetch_assoc()) {
			  echo "<tr><td>".$row["CategoryName"]."</td> </tr>";
		  }
			echo"</tbody>"."</table>";
		// echo "</div>";
		} else {
		    echo "0 results";
		}

	?>
	<div/>


</body>
</html>
