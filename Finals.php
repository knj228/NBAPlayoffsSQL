<?php

session_start();

// show errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

$myDB = mysqli_connect( "warehouse",
						"knj228",
						"qu8uy7sv",
						"knj228_lamp");

$predicts = array();
$user = $_SESSION["userVar"];

$nbaFinals = isset($_POST["FinalsGuess"]) ? $_POST["FinalsGuess"]: '';
$nbaFinalsOutcome = isset($_POST["FinalsGuess2"])?$_POST["FinalsGuess2"]:'';
$nbaFinalsMVP = isset($_POST["FinalsMVP"]) ? $_POST["FinalsMVP"]:'';


$addPredicts= "UPDATE predictions SET nbaf='".$nbaFinals."' WHERE user='".$user."'";
$variable = $myDB->query($addPredicts);
$addPredicts= "UPDATE predictions SET nbaf_Sweep_Game7_None='".$nbaFinalsOutcome."' WHERE user='".$user."'";
$variable = $myDB->query($addPredicts);
$addPredicts= "UPDATE predictions SET nbaf_mvp='".$nbaFinalsMVP."' WHERE user='".$user."'";
$variable = $myDB->query($addPredicts);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Your Page</title>
		<link rel="stylesheet" href="stylesheets/style.css" type="text/css">
		<link rel="stylesheet" href="stylesheets/bracket.css" type="text/css">
	</head>
	<body>
	<body align="center">
		<div id="wrapper">
		 <header>
			<nav>
						<ul class="nav" id="bar">
							<li><a href="../index.html" class="nav">Home</li>
							<li><a href="index.html" class="nav">Database Design</li>
							<li><a href="#" class="nav">Assignments</a>
						 <ul>
								<li><a href="assignment1.html" class="nav">Assignment 1</a></li>
								<li><a href="#" class="nav">Assignment 2</a></li>
								<li><a href="assignment3.html" class="nav">Assignment 3</a></li>
								<li><a href="#" class="nav">Assignment 4</a></li>
								<li><a href="assignment5.html" class="nav">Assignment 5</a></li>
								<li><a href="#" class="nav">Assignment 6</a></li>
								<li><a href="#" class="nav">Assignment 7</a></li>
								<li><a href="#" class="nav">Assignment 8</a></li>
								<li><a href="#" class="nav">Assignment 9</a></li>
						 </ul>
					 </ul>
		</nav>
	 <br><center><img src="images/nba.png"></center><br>
 </header>
		<hr class="style13">

		<?php

			$lastQuery = "SELECT * FROM teams WHERE team_abbrv='".$nbaFinals."';";
			$fullName = mysqli_fetch_row($myDB->query($lastQuery));

			echo "<h1>Alright ".$user.", check back in June to see if the ".$fullName[1]." have won the NBA Finals!</h1>";
			echo "<img class='winner' src='Logos/".$nbaFinals.".png' alt='".$fullName[1]."'>";
		?>
	</body>
</html>
