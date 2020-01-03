<?php
	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: mainpage.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="theme.css"/>
	<title>Forum - filozofia </title>
</head>

<body>

	<div class="header">

	</div>
	
	<div id="container">
		<div align="center">
			Witam
		</div>
		<div align="center">
			<form action="zaloguj.php" method="post">

				Login: <br/> <input type="text" name="login" /> <br />
				Hasło: <br/> <input type="password" name="haslo" /> <br /><br />
				<input type="submit" value="Sign in!" />

			</form>
			<br />
			<button> <a href="rejestracja.php">Sign Up</a> </button>
		</div>
	</div>


<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

</body>
</html>
