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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="mainpage_scripts.js"></script>
	<title>Forum</title>
</head>

<body>
	<div class="header">
	<h1>Witaj,  <?php echo $_SESSION['username']?></h1>
	
	</div>

	<ul>
	<li><a href="mainpage.php">Home</a></li>
	<li><a href="logout.php">Wyloguj się</a></li> 
	
	<?php
	if($_SESSION['admin']==true)
	{ 
		echo"<li><a href='control.php'>Panel kontrolny</a></li>";
	}
	?> 
	</ul>

	<?php
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno!=0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		$Categorynames = $connection->query("Select * from Categories Order by CategoryID");
		$Threads = $connection->query("Select * from Threads Order By DateOpened");
		$Users = $connection->query("Select * from Users");
		//if($Categorynames || $Threads|| $Users)

	?>    
	
	 <div id = 'container'>
			<?php
				$iter = 0;
				while($row_categories = $Categorynames->fetch_assoc()) 
				{
					echo "<div id = main_categories>";
					echo $row_categories["CategoryName"];
					echo "<table class = second_table> 
						<thead>
						<tr>
						<th>Wątek</th> <th>Data otwarcia</th> <th>Zaczął użytkownik</th> <th>Liczba postów</th> <th>Ostatni post</th>
						</tr>
						</thead> <tbody>";
						$Threads->data_seek(0); 
						while($row_threads = $Threads->fetch_assoc()) 
						{	
							if($row_categories["CategoryID"] == $row_threads["CategoryID"])
							{
								$Number = $connection->query("Select Count(*) from Posts where ThreadID = ".$row_threads["ThreadID"]);
								$row_number = $Number->fetch_row();

								$NewestPost = $connection->query("Select * from Posts Where ThreadID = ".$row_threads["ThreadID"]." Order By Posted_on LIMIT 1");
								$row_NewestPost = $NewestPost->fetch_assoc();

								$NewestPostUser = $connection->query("Select * from Users where UserID = ".$row_NewestPost["userID"]);
								if($NewestPostUser!=false){
									$row_NewestPostUser = $NewestPostUser->fetch_assoc();
									$by = " przez ".$row_NewestPostUser["username"];
								}
								else {
									$by = " ";
								}

								$Users = $connection->query("Select username from Users where userID = ".$row_threads["UserID"]);
								$row_user = $Users->fetch_assoc();
								
								
								$ID = $row_threads["ThreadID"];
								echo "<tr onclick='func(".$ID.");'> 
								<td>".$row_threads["ThreadName"]."</td> 
								<td>".$row_threads["DateOpened"]."</td>
								<td>".$row_user["username"]."</td> 
								<td>".$row_number[0]."</td> 
								<td> <div class='grid-container'> <div class='grid-item-left'>".$row_NewestPost["Posted_on"].$by."</div>
								<div class='grid-item-right'></div> </div> </td> </tr> </a>";
							}
						}

						echo "<tr>
							<td> <form class='new_thread' cid = '".$row_categories["CategoryID"]."'>  <br> <input type='text' name='newthread'/> <input type='submit' value='Dodaj wątek'> </form> </td> 
							 </tr>  ";
						echo"</tbody> </table> </div>";
						$iter++;
					}
					echo"<div id = main_categories>";
					echo "Nowa pusta kategoria";
					if($_SESSION['admin'] == 1)
					{
						echo "<form class='add_category' '".$row_categories["CategoryID"]."'>  <br> <input type='text' name='newcategory'/> <input type='submit' value='Dodaj kategorię'> </form>  ";
					}
					echo"</div>"
				?>
				
				
		
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