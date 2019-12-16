<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Forum - miejsce spotkań filozofów </title>
</head>

<body>
		
	<?php
		echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
		echo "<p><b>E-mail</b>: ".$_SESSION['email'];
		echo "<br /><b>Data wygaśnięcia premium</b>: ".$_SESSION['dnipremium']."</p>";

		$dataczas = new DateTime();
		
		echo "Data i czas zalogowania: ".$dataczas->format('Y-m-d H:i:s')."<br>";
		
		$koniec = DateTime::creat
		eFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);
		
		$roznica = $dataczas->diff($koniec);
		
		if($dataczas<$koniec)
		echo "Pozostało premium: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');
		else
		echo "Premium nieaktywne od: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');	
	?>

</body>
</html>