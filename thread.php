<?php

	session_start();
	require_once "connect.php";

?>


<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="theme.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
	<script src="mainpage_scripts.js"></script>
	<title>Forum</title>
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	

</head>

<body>

<div class="header">
	<h1>Witaj,  <?php echo $_SESSION['username']?></h1>
	<h2>A niewiedza i nierozum, czy to nie jest też niedostatek w stanie duszy?</h2>
</div>

<ul>
	<li><a href="mainpage.php">Home</a></li>
	<li><a href="logout.php">Wyloguj się</a></li>
</ul>

<?php
		
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno!=0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		$Posts = $connection->query("Select * from Posts where ThreadID=".$_GET["ID"]." order by Posted_on asc");
		$User = $connection->query("Select username from Users where userID = 
		(select userID from Threads where ThreadID = ".$_GET["ID"].");");
		$row_User = $User->fetch_assoc();
		$Topic = $connection->query("Select * from Threads where ThreadID =".$_GET["ID"])->fetch_assoc();
	
	?>   

<div id = "container">
	<section>
				<?php 
					echo "<p id = 'thread_header'>".$Topic["ThreadName"]."<i onclick='deleteThread(".$Topic["ThreadID"].")' class='demo-icon icon-trash'></i> </p>";
					while($row_posts = $Posts->fetch_assoc()) 
					{	
						$Users = $connection->query("Select username from Users where userID = ".$row_posts["userID"]);
						$user = $Users->fetch_assoc();
						echo "<article>  <div id = 'post'> 
						<div class='grid-container'> <div class='grid-item-left'>
						<p id = 'post_header'> przez :".$user["username"]." at :".$row_posts["Posted_on"].":</p> </div>
						<div class='grid-item-right'><i onclick='deletePost(".$row_posts["PostID"].")' class='demo-icon icon-trash'></i></div> </div> </br> </br>"
						.$row_posts["Content"]." </div> </article>";
					}
				?>
				<div id = "post">
				<form class="add_post" thrID = <?php echo $_GET["ID"]; ?>>
					<textarea id="postform" name="postText"><?php
						if (isset($_SESSION['fr_post']))
						{
							echo $_SESSION['fr_post'];
							unset($_SESSION['fr_post']);
						}
						?></textarea>
					<input type="submit" value="Dodaj wpis"/>
				</form>
				</div>
	</section>
</div>
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

</body>

</html>