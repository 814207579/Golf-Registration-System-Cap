<?php

include_once("./../../Models/Members.php");
include_once("./../../Models/LibraryImports.php");
include_once("./../../Views/Navbar.php");
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
//block member and pro
if($_SESSION["access"] == "Member" || $_SESSION["access"] == "Pro") {
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Controllers/home.php";
			</script>';
}


//this says id but it's their member number
$id = FILTER_INPUT(INPUT_GET, "id");

//array that hold the current member's info
$member = getMember($id);

//var_dump($member);

$id = $member[0][0];
$firstName = $member[0][1];
$lastName = $member[0][2];
$memberType = $member[0][3];
$memberNumber = $member[0][4];
$memberEmail = $member[0][5];
$memberPhone = $member[0][6];
$createdAt = $member[0][7];
?>

<html>

	<head>
		<title> Edit Member - <?php echo $memberNumber ?> </title>
	</head>
	
	<body>
		<form action="./../../Controllers/Admin/Admin.php" method="post">
			
			<label> First Name </label>
			<input name="FirstName" value="<?php echo $firstName ?>"/>
			
			</br>
			
			<label> Last Name </label>
			<input name="LastName" value="<?php echo $lastName ?>"/>
			
			</br>
			
			<label> Member Type</label>
			<select name="MemberType"> Member type
				<?php switch($memberType) : 
				case "Regular": ?>
					<option value="Regular" selected> Regular </option>
					<option value="Social"> Social </option>
					<option value="Special"> Special </option>
					<option value="Pro"> Pro </option>
					<option value="Other"> Other </option>
					<?php break; ?>
					
				<?php case "Social": ?>
					<option value="Regular"> Regular </option>
					<option value="Social" selected> Social </option>
					<option value="Special"> Special </option>
					<option value="Pro"> Pro </option>
					<option value="Other"> Other </option>
					<?php break; ?>
					
				<?php case "Special": ?>
					<option value="Regular"> Regular </option>
					<option value="Social"> Social </option>
					<option value="Special" selected> Special </option>
					<option value="Pro"> Pro </option>
					<option value="Other"> Other </option>
					<?php break; ?>
					
				<?php case "Pro": ?>
					<option value="Regular"> Regular </option>
					<option value="Social"> Social </option>
					<option value="Special"> Special </option>
					<option value="Pro" selected> Pro </option>
					<option value="Other"> Other </option>
					<?php break; ?>
					
				<?php case "Other": ?>
					<option value="Regular"> Regular </option>
					<option value="Social"> Social </option>
					<option value="Special"> Special </option>
					<option value="Pro"> Pro </option>
					<option value="Other" selected> Other </option>
					<?php break; ?>
				<?php endSwitch; ?>
			</select>
			
			</br>
			
			<label> Member Number</label>
			<input name="MemberNumber" value="<?php echo $memberNumber ?>" type="number"/>
			
			</br>
			
			<label> Member Email</label>
			<input name="MemberEmail" value=" <?php echo $memberEmail ?>" type="email"/>
			
			</br>
			
			<label> Member Phone Number</label>
			<input name="MemberPhoneNumber" value="<?php echo $memberPhone ?>" type="tel"/>
			
			</br>
			
			<button type="submit" name="action" value="edit"> Submit</button>
		</form>
	</body>


</html>