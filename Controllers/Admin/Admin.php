<?php 
include_once("./../../Models/Database.php");
include_once("./../../Models/LibraryImports.php");
include_once("./../../Views/Navbar.php");
include_once("./../../Models/Members.php");
include_once("./../../Views/Admin/MemberTable.php");
if (!ISSET($_SESSION)) {
	session_start();
}
//keep out anyone with "Member" or "Pro" access
if(!isset($_SESSION["loggedin"])) {
	//simple script to send the user to another page without using php headers
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Controllers/login.php";
			</script>';
}
if($_SESSION["access"] == "Member" || $_SESSION["access"] == "Pro") {
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Contollers/home.php";
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



switch ($action) {
	case "edit" :
		$firstName = filter_input(INPUT_POST, "FirstName");
		$lastName = filter_input(INPUT_POST, "LastName");
		$memberType = filter_input(INPUT_POST, "MemberType");
		$memberNumber = (int)filter_input(INPUT_POST, "MemberNumber");
		$memberEmail = filter_input(INPUT_POST, "MemberEmail");
		$memberPhone = filter_input(INPUT_POST, "MemberPhoneNumber");
		$createdAt = "current_timestamp()";
		
		
		
		editMember($firstName, $lastName, $memberType, $memberNumber, $memberEmail, $memberPhone);
		
		echo 	'<script type="text/javascript">
					window.location.href = "./../home.php";
				</script>';
		
		break;
	case "create" :
		echo $action;
		
		$id = "";
		$firstName = filter_input(INPUT_POST, "FirstName");
		$lastName = filter_input(INPUT_POST, "LastName");
		$memberType = filter_input(INPUT_POST, "MemberType");
		$memberNumber = (int)filter_input(INPUT_POST, "MemberNumber");
		$memberEmail = filter_input(INPUT_POST, "MemberEmail");
		$memberPhone = filter_input(INPUT_POST, "MemberPhoneNumber");
		$createdAt = "current_timestamp()";
		
		$memberArray = [$id, $firstName, $lastName, $memberType, $memberNumber, $memberEmail, $memberPhone];
		
		//var_dump($memberArray);
		
		createMember($firstName, $lastName, $memberType, $memberNumber, $memberEmail, $memberPhone, $memberArray);
		//refreshes the page after making a new member to show the changes
		echo 	'<script type="text/javascript">
					window.location.href = "./../home.php";
				</script>';
		break;
	case "delete" :
		echo "delete";
		$id = filter_input(INPUT_GET, "id");
		$memberNumber= filter_input(INPUT_GET, "memberNumber");
		
		deleteMember($id, $memberNumber);
		echo 	'<script type="text/javascript">
					window.location.href = "./../home.php";
				</script>';
		break;
	case "index" :

		break;
	default :
		echo "error";
		break;
}
?>

<html>

	<head>
		<title> Admin Portal </title>
	</head>

</html>
<div class="container">
     <div class="row">
      <div class="col-lg-1"></div>
      <div class="col-lg-10">
		<?php //used help from https://stackoverflow.com/questions/19589802/how-to-make-a-div-or-a-href-to-align-center to get the text in the middle ?>
        <a href="./../../Views/Admin/CreateMembers.php"/ style="text-align:center; display:block;"> Create New Member </a>
      </div>
     <div class="col-lg-1"></div>
  </div>
</div>
