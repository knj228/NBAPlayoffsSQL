<?php

session_start();

// show errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

$myDB = mysqli_connect( "warehouse",
						"knj228",
						"qu8uy7sv",
						"knj228_lamp");

$series = array("Western Conference Semi-Finals 1","","Western Conference Semi-Finals 2","","Eastern Conference Semi-Finals 1","","Eastern Conference Semi-Finals 2");

$predictions = array();
$seriesOutcome = array();
$MVPpredictions = array();
$user = $_SESSION["userVar"];

$predictString = "";
$Sweep = "";
$MVP = "";
for ($y = 0; $y < 8; $y++)
	{
		$this_guess = 'guess'.$y;
		$this_guess2 = 'guess2'.$y;
		$this_guess3 = 'MVP'.$y;
		$guest = isset($_POST[$this_guess]) ? $_POST[$this_guess]: '';
		$guest2 = isset($_POST[$this_guess2]) ? $_POST[$this_guess2]: '';
		$guest3 = $_POST[$this_guess3];

		if ($y >= 7){
			$predictString = $predictString."'".$guest."'";
			$Sweep = $Sweep."'".$guest2."'";
			$MVP=$MVP."'".$guest3."'";
		}
		else{
			$predictString = $predictString."'".$guest."',";
			$Sweep = $Sweep."'".$guest2."',";
			$MVP=$MVP."'".$guest3."',";

		}

		$predictions[] = $guest;
		$seriesOutcome[] = $guest2;
		$MVPpredictions[] = $guest3;

	}
	echo "<h2>".$MVP."'</h2>";
$addPredictions = "INSERT into predictions (user,efr1,efr2,efr3,efr4,wfr1,wfr2) VALUES('". $user ."','". $predictions[0] ."','".$predictions[1]."','".$predictions[2]."','".$predictions[3]."','".$predictions[4]."','".$predictions[5]."');";
$variable = $myDB->query($addPredictions);
$addPredictions = "UPDATE predictions SET wfr3='".$predictions[6]."' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);
$addPredictions = "UPDATE predictions SET wfr4='".$predictions[7]."' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);
$addPredictions = "UPDATE predictions SET efr1_Sweep_Game7_None='$seriesOutcome[0]',efr2_Sweep_Game7_None='$seriesOutcome[1]',efr3_Sweep_Game7_None='$seriesOutcome[2]',efr4_Sweep_Game7_None='$seriesOutcome[3]',wfr1_Sweep_Game7_None='$seriesOutcome[4]',wfr2_Sweep_Game7_None='$seriesOutcome[5]',wfr3_Sweep_Game7_None='$seriesOutcome[6]',wfr4_Sweep_Game7_None='$seriesOutcome[7]' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);
$addPredictions = "UPDATE predictions SET efr1_mvp='$MVPpredictions[0]',efr2_mvp='$MVPpredictions[1]',efr3_mvp='$MVPpredictions[2]',efr4_mvp='$MVPpredictions[3]',wfr1_mvp='$MVPpredictions[4]',wfr2_mvp='$MVPpredictions[5]',wfr3_mvp='$MVPpredictions[6]',wfr4_mvp='$MVPpredictions[7]' WHERE user='".$user."'";
$variable = $myDB->query($addPredictions);


?>
<!DOCTYPE html>
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
			echo "<h1>Now for your second round predictions:</h1><form method='post' action='3R.php'>";
			for ($x = 0; $x < 8; $x += 1){
				echo "<h2>".$predictions[$x]."'</h2>";
			}
			for ($x = 0; $x < 7; $x += 2)
				{

					$lastQuery = "SELECT * FROM teams WHERE team_abbrv='".$predictions[$x]."';";
					$fullHome = mysqli_fetch_row($myDB->query($lastQuery));

					$actualLast = "SELECT * FROM teams WHERE team_abbrv='".$predictions[$x+1]."';";
					$fullAway = mysqli_fetch_row($myDB->query($actualLast));
					echo "<h3>".$series[$x].": Round 2</h3>";

					echo "<input type='radio' name='guess".$x."' value='".$predictions[$x]."'>".$fullHome[1];
					echo "<input type='radio' name='guess".$x."' value='".$predictions[$x+1]."'>".$fullAway[1]."<br />";
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
