<?php

session_start();

// show errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

$myDB = mysqli_connect( "warehouse",
						"knj228",
						"3bbzwf9r",
						"knj228_lamp");

$series = array("Western Conference Semi-Finals 1","","Western Conference Semi-Finals 2","","Eastern Conference Semi-Finals 1","","Eastern Conference Semi-Finals 2");

$predictions = array();
$user = $_SESSION["userVar"];

$predictString = "";
for ($y = 0; $y < 8; $y++)
	{
		$this_guess = 'guess'.$y;
		$guest = $_POST[$this_guess];

		if ($y >= 7)
			$predictString = $predictString."'".$guest."'";
		else
			$predictString = $predictString."'".$guest."',";

		$predictions[] = $guest;

	}

$addPredictions = "INSERT into prediction (user,efr1,efr1_Sweep_Game7_None,efr1_mvp,efr2,efr2_Sweep_Game7_None,efr2_mvp,efr3,efr3_Sweep_Game7_None,efr3_mvp,efr4,efr4_Sweep_Game7_None,efr4_mvp,wfr1,wfr1_Sweep_Game7_None,wfr1_mvp,wfr2,wfr2_Sweep_Game7_None,wfr2_mvp,wfr3,wfr3_Sweep_Game7_None,wfr3_mvp,wfr4,wfr4_Sweep_Game7_None,wfr4_mvp,) VALUES('". $user ."',". $predictString .");";
$variable = $myDB->query($addPredictions);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Round Two!</title>
		<link rel="stylesheet" href="stylesheets/style.css" type="text/css">
	</head>

	<body align="center">

		<?php
			echo "<h1>Now for your second round predictions:</h1><form method='post' action='roundThree.php'>";
			for ($x = 0; $x < 7; $x += 2)
				{

					$lastQuery = "SELECT * FROM teams WHERE team_abbrv='".$predictions[$x]."';";
					$fullHome = mysqli_fetch_row($myDB->query($lastQuery));

					$actualLast = "SELECT * FROM teams WHERE team_abbrv='".$predictions[$x + 2]."';";
					$fullAway = mysqli_fetch_row($myDB->query($actualLast));
					echo "<h3>".$series[$x].": Round 2</h3>";

					echo "<input type='radio' name='guess".$x."' value='".$predictions[$x]."'>".$fullHome[1];
					echo "<input type='radio' name='guess".$x."' value='".$predictions[$x + 1]."'>".$fullAway[1]."<br />";
				}

			echo "<input type='submit'></form>";

		?>
	</body>
</html>
