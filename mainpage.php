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
	<div class="wrapper">
		<header>I'm a 30px tall header</header>
		<main> <div id="container">
		    <p>Witaj <?php echo $_SESSION['username']?>
				<button><a href="logout.php">Wyloguj się</a></button>
			</p>
			<br/>
		<?php

			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				echo "Error: ".$connection->connect_errno;
			}
			$categories_result = $connection->query("Select CategoryName from Categories Order by CategoryName");
			if ($categories_result->num_rows > 0) {
			echo
			"<table id='main_table'>
			 <thead>
					<tr>
					<th>Kategoria</th>
					</tr>
				</thead>
				<tbody>";
			  while($row = $categories_result->fetch_assoc()) {
				  echo "<tr><td>".$row["CategoryName"]."</td> </tr>";
			  }
			echo"</tbody>"."</table>";
			} else {
			    echo "0 results";
			}
		?>
	</div></main>
		<footer id=stopka>
	  		Created by: Michal Musiał
	  		Contact information: ="Michal.Musial553@gmail.com"
				<?php
					$dataczas = new DateTime();
					$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);
					$roznica = $dataczas->diff($koniec);
					$dataczas = new DateTime();
					echo "Data i czas zalogowania: ".$dataczas->format('Y-m-d H:i:s');
					$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);
					$roznica = $dataczas->diff($koniec);
					if($dataczas<$koniec)
					echo "Pozostało subskrypcji: ".$roznica->format('%y lat, %m mies, %d dni, %h godz');
					else
					echo "Subskrypcji nieaktywna od: ".$roznica->format('%y lat, %m mies, %d dni, %h godz');
				?>
		</footer>
	</div>
</body>
</html>
