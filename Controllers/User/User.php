<?php 
include_once("./../../Models/Database.php");
include_once("./../../Models/Members.php");
include_once("./../../Models/LibraryImports.php");
include_once("./../../Models/TeeTimes.php");
//keep out anyone with "Member" access
if(!isset($_SESSION["loggedin"])) {
	//simple script to send the user to another page without using php headers
	echo 	'<script type="text/javascript">
				window.location.href = "./../login.php";
			</script>';
}
//grab the action
$action = filter_input(INPUT_GET, "action");
if ($action === null) {
	$action = filter_input(INPUT_POST, "action");
	if ($action === null) {
		$action = "index";
	}
}
switch ($action) :
	case "index" :
		include_once("./../../Views/User/TeeTimeTable.php");
		break;
	case "edit" :
		$time = FILTER_INPUT(INPUT_POST, "time");
		$name1 = FILTER_INPUT(INPUT_POST, "Time1");
		$name2 = FILTER_INPUT(INPUT_POST, "Time2");
		$name3 = FILTER_INPUT(INPUT_POST, "Time3");
		$name4 = FILTER_INPUT(INPUT_POST, "Time4");
		$name5 = FILTER_INPUT(INPUT_POST, "Time5");
		$notes = FILTER_INPUT(INPUT_POST, "Notes");
		
		editTeeTime($time, $name1, $name2, $name3, $name4, $name5, $notes);
		
		echo 	'<script type="text/javascript">
					window.location.href = "./../User/User.php";
				</script>';
		break;

endswitch;
?>