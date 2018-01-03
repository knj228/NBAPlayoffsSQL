<?php

session_start();

// show errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

$myDB = mysqli_connect( "warehouse",
						"knj228",
						"qu8uy7sv",
						"knj228_lamp");

$users ="SELECT * FROM user_accounts ORDER BY user_id";
$result = $myDB->query($users);
if (!$result) { // add this check.
    die('Invalid query: ' . mysql_error());
	}
$usernames = array();
$passwords = array();
$teams = array();


while($row = mysqli_fetch_array($result))
	{
		$usernames[] = $row["username"];
		$passwords[] = $row["password"];
	}

$thatQuery = "SELECT * FROM playoff_series;";
$playoffs = $myDB->query($thatQuery);

$series = array(
				"efr"=>"Eastern Conference First Round",
				"wfr"=>"Western Conference First Round",
				"wcsf"=>"Western Conference Semi-Finals",
				"ecsf"=>"Eastern Conference Semi-Finals",
				"wcf"=>"Western Conference Finals",
				"ecf"=>"Eastern Conference Finals",
				"nbaf"=>"NBA Finals",
				);

function _dudewheresmypage()
	{
		echo "<h1>Can't find that user in our database. Try logging in again?</h1>";
		echo "<form action='http://i6.cims.nyu.edu/~knj228/DD/LAMP/profilePage.php' method='post'>";
		echo "<h3>Username:</h3>";
		echo '<input type="text" name="User"><br />';
		echo '<h3>Password:</h3>';
		echo '<input type="text" name="Pass"><br />';
		echo '<input type="submit" value="Login">';
	}

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
			$user = $_POST["User"];
			$pwd = $_POST["Pass"];

			if ($pwd == null)
				$pwd = "password";

			if (in_array($user, $usernames))
				{
					if (in_array($pwd, $passwords))
						{
							$query1 = "SELECT * FROM predictions WHERE user='".$user."';";
							$result2=$myDB->query($query1);
							$bracket = mysqli_fetch_row($result2);


							$query2 = "SELECT * FROM teams WHERE team_abbrv='".$bracket[count($bracket) - 3]."';";
							$result3=$myDB->query($query2);
							$urTeam = mysqli_fetch_row($result3);

							$index = 1;
							$numCorrect = 0;
							$numFinished = 0;
							echo "<h1>Hey! You're Back, ".$user."!</h1>";
					if(strcmp($urTeam[2],"East")==0){
						echo <<<END
							<div class="tournament8-wrap">
								<div class="round4-top winner4"><img src=Logos/$urTeam[0].png alt=$urTeam[1]></div>
								<div class="round3-topwrap">
									<div class="round3-top"><span>$bracket[37]</span></div>
									<div class="round2-topwrap">
										<div class="round2-top"><span>$bracket[1]</span></div>
										<div class="round1-top"><span>CLE</span></div>
										<div class="round1-bottom"><span>DET</span></div>
									</div>
									<div class="round2-bottomwrap">
										<div class="round2-bottom"><span>$bracket[4]</span></div>
										<div class="round1-top"><span>ATL</span></div>
										<div class="round1-bottom"><span>BOS</span></div>
									</div>
								</div>
								<div class="round3-bottomwrap">
									<div class="round3-bottom"><span>$bracket[28]</span></div>
									<div class="round2-topwrap">
										<div class="round2-top"><span>$bracket[7]</span></div>
										<div class="round1-top"><span>TOR</span></div>
										<div class="round1-bottom"><span>IND</span></div>
									</div>
									<div class="round2-bottomwrap">
										<div class="round2-bottom"><span>$bracket[10]</span></div>
										<div class="round1-top"><span>MIA</span></div>
										<div class="round1-bottom"><span>CHA</span></div>
									</div>
								</div>
							</div>
						</div>
				    	<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You picked the $urTeam[1] to make a run for it out of the $urTeam[2]</h3>
						 <h2>And Win the NBA Finals!</h2>
						 <h2>Predicted&nbsp;Finals&nbsp; MVP:&nbsp;&nbsp;$bracket[45]</h2>
					   <h4>So far,$numCorrect,out of,$numFinished,of your predictions have been correct!
END;
			}
					if(strcmp($urTeam[2],"West")==0){
						echo <<<END
						<link rel="stylesheet" href="stylesheets/bracket.css" type="text/css">
							<div class="tournament8-wrap">
								<div class="round4-top winner4"><img src=Logos/$urTeam[0].png alt=$urTeam[1]</div>
								<div class="round3-topwrap">
									<div class="round3-top"><span>$bracket[31]</span></div>
									<div class="round2-topwrap">
										<div class="round2-top"><span>$bracket[13]</span></div>
										<div class="round1-top"><span>GAS</span></div>
										<div class="round1-bottom"><span>HOU</span></div>
									</div>
									<div class="round2-bottomwrap">
										<div class="round2-bottom"><span>$bracket[16]</span></div>
										<div class="round1-top"><span>LAC</span></div>
										<div class="round1-bottom"><span>POR</span></div>
									</div>
								</div>
								<div class="round3-bottomwrap">
									<div class="round3-bottom"><span>$bracket[34]</span></div>
									<div class="round2-topwrap">
										<div class="round2-top"><span>$bracket[22]</span></div>
										<div class="round1-top"><span>SAS</span></div>
										<div class="round1-bottom"><span>MEM</span></div>
									</div>
									<div class="round2-bottomwrap">
										<div class="round2-bottom"><span>$bracket[19]</span></div>
										<div class="round1-top"><span>OKC</span></div>
										<div class="round1-bottom"><span>DAL</span></div>
									</div>
								</div>
							</div>
						</div>

							<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You picked the $urTeam[1] to make a run for it out of the $urTeam[2]</h3>
						 <h2>And Win the NBA Finals!</h2>
						 <h4>So far,1,out of,$numFinished,of your predictions have been correct!
END;
					}
				}
					else
						{
							_dudewheresmypage();
						}

				}
			else if ($user == null)
				{
					_dudewheresmypage();
				}
			else
				{
					$addUser = "INSERT into user_accounts (username, password) VALUES('". $user ."','". $pwd ."');";
					$variable = $myDB->query($addUser);

					echo "<h1>Welcome, ".$user." </h1>";
					if ($pwd == "password")
						echo '<h3>(Ohh You Silly Goose.)</h3>';

					echo "<h2>If you don't have a bracket you can't win, So Let's Get Started</h2>";
					echo "<h3>If You Need Some Help, I can fix that: <a href='http://stats.nba.com/' target='blank'>Dank Stats</a></h3>";

					$_SESSION["userVar"] = $user;
					$x = 0;
					echo "<form action='R2.php' method='post'>";

					while($row = mysqli_fetch_array($playoffs))
						{
							if ($row["round"] == 1)
								{
									$home_Team = $row["home_Team"];
									$away_Team = $row["away_Team"];

									$lastQuery = "SELECT * FROM teams WHERE team_abbrv='".$home_Team."';";
									$fullHome = mysqli_fetch_row($myDB->query($lastQuery));

									$actualLast = "SELECT * FROM teams WHERE team_abbrv='".$away_Team."';";
									$fullAway = mysqli_fetch_row($myDB->query($actualLast));


									$abbrv_series = substr($row["series"], 0, 3);
									echo "<h3>".$series[$abbrv_series].": Round ".$row["round"]."</h3>";
									echo "<input type='radio' name='guess".$x."' value='".$home_Team."'>".$fullHome[1];
									echo "<input type='radio' name='guess".$x."' value='".$away_Team."'>".$fullAway[1]."<br />";
									echo "<input type='radio' name='guess2".$x."' value='Sweep'> Sweep <br />";
									echo "<input type='radio' name='guess2".$x."' value='Game7'> Game 7 <br />";
									echo "<input type='radio' name='guess2".$x."' value='None'> None <br />";
									echo "<h3>MVP:</h3>";
									echo "<input type='text' name='MVP".$x."'>";

									$x++;

								}
						}
					echo "<input type='submit'></form>";

				}
		?>
	</body>
</html>
