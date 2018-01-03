<?php

session_start();

// show errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

$myDB = mysqli_connect( "warehouse",
						"knj228",
						"qu8uy7sv",
						"knj228_lamp");

$predictions = array();
$seriesOutcome = array();
$MVPpredictions = array();
$user = $_SESSION["userVar"];

$easternFinalist = $_POST["guess0"];
$westernFinalist = $_POST["guess2"];
$this_guess21 = 'guess20';
$this_guess22 = 'guess22';
$this_guess1 = 'MVP0';
$this_guess2 = 'MVP2';
$guest2 = isset($_POST[$this_guess21]) ? $_POST[$this_guess21]: '';
$guest3 = isset($_POST[$this_guess1])? $_POST[$this_guess1]: '';
$guest4 = isset($_POST[$this_guess22])? $_POST[$this_guess22]: '';
$guest5 = isset($_POST[$this_guess2])? $_POST[$this_guess2]: '';


$addPredictions = "UPDATE predictions SET ecf='$easternFinalist',ecf_Sweep_Game7_None='$guest2',ecf_mvp='$guest3' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);
$addPredictions = "UPDATE predictions SET wcf='$westernFinalist',wcf_Sweep_Game7_None='$guest4',wcf_mvp='$guest5' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);
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
			echo "<h1>And who will win the NBA Finals?</h1><form method='post' action='Finals.php'>";

			$lastQuery = "SELECT * FROM teams WHERE team_abbrv='".$easternFinalist."';";
			$fullHome = mysqli_fetch_row($myDB->query($lastQuery));

			$actualLast = "SELECT * FROM teams WHERE team_abbrv='".$westernFinalist."';";
			$fullAway = mysqli_fetch_row($myDB->query($actualLast));



			echo "<input type='radio' name='FinalsGuess' value='".$easternFinalist."'>".$fullHome[1];
			echo "<input type='radio' name='FinalsGuess' value='".$westernFinalist."'>".$fullAway[1]."<br />";
			echo "<input type='radio' name='FinalsGuess2' value='Sweep'> Sweep <br />";
			echo "<input type='radio' name='FinalsGuess2' value='Game7'> Game 7 <br />";
			echo "<input type='radio' name='FinalsGuess2' value='None'> None <br />";
			echo "<h3>MVP:</h3>";
			echo "<input type='text' name='FinalsMVP'>";
			echo "<input type='submit'></form>";

		?>
	</body>
</html>
