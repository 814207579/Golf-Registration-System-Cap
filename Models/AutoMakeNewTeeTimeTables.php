<?php
//this whole script exists because I want the tables to be named after the table they match to...
//it works by making a weeks worth of teetime tables and filling them all on an pro user logging into the website
//it needs to be like this incase, for whatever reason, the user goes a long time without ever restarting the computer
	//there's a very small chance they will go over a week without ever logging out of the pro user account and this way
	//there will always be a new set of teetime tables.

if(!isset($_SESSION["loggedin"])) {
	//simple script to send the user to another page without using php headers
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Controllers/login.php";
			</script>';
}
if($_SESSION["access"] == "Member") {
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Contollers/home.php";
			</script>';
}


include_once("./../../Models/Database.php");
//building the current date in php date object
$year = date("Y");
$month = date("m");
$day = date("d");
$builtDate = ($year."-".$month."-".$day);
//help with DateTime function for added/removing days check line 21
//https://stackoverflow.com/questions/2605446/php-get-future-date-time
$currentDate = new DateTime($builtDate);


//for loop to go over today + the next 6 days
for($i = 0; $i < 8; $i++) {
	if ($i === 0) {
		//echo $currentDate->format("Y/m/d");
		makeTable($currentDate->format("Y/m/d"));
		echo "</br>";
		continue;
	}
	$currentDate = $currentDate->modify("+1 day");
	makeTable($currentDate->format("Y/m/d"));
	//echo $currentDate->format("Y/m/d");
	//echo "</br>";
}



function makeTable($date) {
	global $link;
	
	$query = "CREATE TABLE teetimedb.`".$date."` (
			`currentTime` time NOT NULL,
			`time1` varchar(255),
			`time2` varchar(255),
			`time3` varchar(255),
			`time4` varchar(255),
			`time5` varchar(255),
			`notes` text,
			`currentlyOpen` boolean DEFAULT TRUE)";
			
	$statement = $link->prepare($query);
	$statement->execute();
	$statement->close();
	
	$query2 = "ALTER TABLE teetimedb.`".$date."`
			  ADD PRIMARY KEY (`currentTime`)";
	$statement2 = $link->prepare($query2);
	$statement2->execute();
	$statement2->close();
	
	fillTable($date);
}

function fillTable($tableName) {
	global $link;
	$query = "INSERT INTO teetimedb.`".$tableName."` (`currentTime`, `time1`, `time2`, `time3`, `time4`, `time5`, `notes`, `currentlyOpen`) VALUES
	('00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('01:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('02:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('03:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('04:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('05:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('06:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('07:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('08:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('09:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('11:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('13:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('14:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('16:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('17:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('18:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('19:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('21:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('22:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:07:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:37:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('23:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('24:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
	$statement = $link->prepare($query);
	$statement->execute();
	$statement->close();
	//I'm very sorry
}