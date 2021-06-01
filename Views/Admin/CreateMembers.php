<?php
session_start();

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
//

?>

<html>

	<head>
		<title> Create New Member </title>
	</head>
	
	<body>
		<form action="./../../Controllers/Admin/Admin.php" method="post">
			<label> First Name </label>
			<input name="FirstName"/>
			
			</br>
			
			<label> Last Name </label>
			<input name="LastName"/>
			
			</br>
			
			<label> Member Type</label>
			<select name="MemberType"> Member type
				<option value="Regular"> Regular </option>
				<option value="Social"> Social </option>
				<option value="Special"> Special </option>
				<option value="Pro"> Pro </option>
				<option value="Other"> Other </option>
			</select>
			
			</br>
			
			<label> Member Number</label>
			<input name="MemberNumber" type="number"/>
			
			</br>
			
			<label> Member Email</label>
			<input name="MemberEmail" type="email"/>
			
			</br>
			
			<label> Member Phone Number</label>
			<input name="MemberPhoneNumber" type="tel"/>
			
			</br>
			
			<button type="submit" name="action" value="create"> Submit</button>
		</form>
	</body>


</html>