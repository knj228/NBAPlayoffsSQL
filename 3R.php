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

for ($y = 0; $y < 8; $y += 2)
	{
		$this_guess = 'guess'.$y;
		$this_guess2 = 'guess2'.$y;
		$this_guess3 = 'MVP'.$y;
		$guest = $_POST[$this_guess];
		$guest2 = isset($_POST[$this_guess2]) ? $_POST[$this_guess2]: '';
		$guest3 = isset($_POST[$this_guess3])? $_POST[$this_guess3]: '';


		$predictions[] = $guest;
		$seriesOutcome[] = $guest2;
		$MVPpredictions[] = $guest3;

	}

$addPredictions = "UPDATE predictions SET ecsf1='".$predictions[0]."' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);

$addPredictions = "UPDATE predictions SET ecsf2='".$predictions[1]."' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);

$addPredictions = "UPDATE predictions SET wcsf1='".$predictions[2]."' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);

$addPredictions = "UPDATE predictions SET wcsf2='".$predictions[3]."' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);

$addPredictions = "UPDATE predictions SET ecsf1_Sweep_Game7_None='$seriesOutcome[0]',ecsf2_Sweep_Game7_None='$seriesOutcome[1]',wcsf1_Sweep_Game7_None='$seriesOutcome[2]',wcsf2_Sweep_Game7_None='$seriesOutcome[3]' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);
$addPredictions = "UPDATE predictions SET ecsf1_mvp='$MVPpredictions[0]',ecsf2_mvp='$MVPpredictions[1]',wcsf1_mvp='$MVPpredictions[2]',wcsf2_mvp='$MVPpredictions[3]' WHERE user='".$user."'";
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
			echo "<h1>Third round predictions:</h1><form method='post' action='4R.php'>";
			for ($x = 0; $x <= 2; $x += 2)
				{

					$lastQuery = "SELECT * FROM teams WHERE team_abbrv='".$predictions[$x]."';";
					$fullHome = mysqli_fetch_row($myDB->query($lastQuery));

					$actualLast = "SELECT * FROM teams WHERE team_abbrv='".$predictions[$x + 1]."';";
					$fullAway = mysqli_fetch_row($myDB->query($actualLast));

					if ($x == 0)
						echo "<h3>Eastern Conference Finals: Round 3</h3>";
					else
						echo "<h3>Western Conference Finals: Round 3</h3>";

					echo "<input type='radio' name='guess".$x."' value='".$predictions[$x]."'>".$fullHome[1];
					echo "<input type='radio' name='guess".$x."' value='".$predictions[$x + 1]."'>".$fullAway[1]."<br />";
					echo "<input type='radio' name='guess2".$x."' value='Sweep'> Sweep <br />";
					echo "<input type='radio' name='guess2".$x."' value='Game7'> Game 7 <br />";
					echo "<input type='radio' name='guess2".$x."' value='None'> None <br />";
					echo "<h3>MVP:</h3>";
					echo "<input type='text' name='MVP".$x."'>";
				}

			echo "<input type='submit'></form>";

		?>
	</body>
</html>
