<?php
	
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
   }
	if (!($_SESSION['admin']==true))
	{
		header('Location: index.php');
		exit();
	}
	require_once "connect.php";
	$connection = new mysqli($host, $db_user, $db_password, $db_name);

	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="theme.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="mainpage_scripts.js"></script>
	<title>Forum</title>
</head>

<body>
	<div class="header">
	<h1>Witaj,  <?php echo $_SESSION['username']?></h1>
	<h2>A niewiedza i nierozum, czy to nie jest też niedostatek w stanie duszy?</h2>
	</div>

	<ul>
	<li><a href="mainpage.php">Home</a></li>
	<li><a href="logout.php">Wyloguj się</a></li> 
	
	<?php
	if($_SESSION['admin'] == true)
	{ 
		echo"<li><a href='control.php'>Panel kontrolny</a></li>";
	}
	?> 
	</ul>
   
	<div id = 'container'>
		<p>    
			<form class = 'banUser'>
				<input list="users" name="usernameToBan">
				<datalist id="users">
					<?php 
					$Users = $connection->query("Select * from users");
					while($Row = $Users->fetch_assoc())
					{
						echo "<option value = ".$Row['username'].">";
					}
					?>
				</datalist>
				<input type="submit" value="Zbanuj użytkownika">
			</form>
		</p>
		
		<p>    
			<form class = 'deleteCategory'>
				<input list="categories" name="categoryName">
				<datalist id="categories">
					<?php 
					$Categories = $connection->query("Select * from Categories");
							while($Row = $Categories->fetch_assoc())
							{
								echo "<option value =".$Row['CategoryName'].">";
							}
					?>
				</datalist>
				<input type="submit" value="Usuń kategorię">
			</form>
		</p>



	</div>

	<footer id=stopka>
		Created by: Michal Musiał
		Contact information: = "Michal.Musial553@gmail.com"
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
		

</body>
</html> 