<?php
if (!ISSET($_SESSION)) {
	session_start();
}

if(!isset($_SESSION["loggedin"])) {
	//simple script to send the user to another page without using php headers
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Controllers/login.php";
			</script>';
}

include("./../../Models/Database.php");

function getMemberName($memberNumber) {
	global $link;
	
	$query = "SELECT members.firstName, members.lastName FROM members WHERE members.memberNumber = ".$memberNumber."";
	$statement = $link->prepare($query);
	$statement->execute();

	//get the result set
	$result = $statement->get_result();

	//fetch all data
	$result = $result->fetch_all();
	
	$statement->close();
	
	return $result;
}

function getMembers() {
	global $link;
	
	$query = "SELECT * FROM members";
	$statement = $link->prepare($query);
	$statement->execute();

	//get the result set
	$result = $statement->get_result();

	//fetch all data
	$result = $result->fetch_all();

	//echo var_dump($result);

	$members = $result;
	
	$statement->close();
	
	return $members;
}

//current_timestamp();

function createMember($firstName, $lastName, $memberType, $memberNumber, $memberEmail, $memberPhone) {
	global $link;
	//$query = "INSERT INTO members (id, firstName, lastName, memberType, memberNumber, email, phoneNumber, createdAt) 
	//VALUES (?, ?, ?, ?,?,?,?,?)";
	//
	//var_dump($memberArray);
	
	//$statement->bind_param(NULL, $fn, $ln, $mt, $mn, $me, $mp, $date);
	//building the query the hard way because the other way wouldn't work
			 
	$query = 'INSERT INTO members (id, firstName, lastName, memberType, memberNumber, email, phoneNumber, createdAt)
			  VALUES ('.'NULL'.',"'.$firstName.'", "'.$lastName.'", "'.$memberType.'", '.$memberNumber.', "'.$memberEmail.'", "'.$memberPhone.'", CURRENT_TIMESTAMP())';
	$statement = $link->prepare($query);
	//echo $query;
	
	$statement->execute();
	$statement->close();
	
	createMemberUserAccount($memberNumber, $lastName);
	//$DB->close();
	
}
//makes the user account that is associated with the new user
function createMemberUserAccount($memberNumber, $lastName) {
		global $link;
		
		$param_username = $memberNumber;
		$param_password = password_hash($lastName, PASSWORD_DEFAULT); // Creates a password hash


		// Prepare an insert statement
        $query = 'INSERT INTO users (username, password) VALUES ("'.$param_username.'", '.'"'.$param_password.'")';
		$statement = $link->prepare($query);
		//echo $query;
		$statement->execute();
		$statement->close();
}

function deleteMember($id, $memberNumber) {
	
	global $link;
	
	//deleting the user from the members table
	$query = 'DELETE FROM members WHERE members.id = '.$id;
	$statement = $link->prepare($query);
	$statement->execute();
	$statement->close();
	
	//deleting the user from the users table
	$query = 'DELETE FROM users WHERE users.username = '.$memberNumber;
	$statement = $link->prepare($query);
	$statement->execute();
	$statement->close();
}

function getMember($id) {
	global $link;
	$query = 'SELECT * FROM members WHERE members.memberNumber = '.$id;
	$statement = $link->prepare($query);
	$statement->execute();
	
	//get the result set
	$result = $statement->get_result();

	//fetch all data
	$result = $result->fetch_all();
	
	$member = $result;
	
	$statement->close();
	
	return $member;
}

function editMember($firstName, $lastName, $memberType, $memberNumber, $memberEmail, $memberPhone){ 
	global $link;
	
	$query = 'UPDATE members SET firstName = "'.$firstName.'", 
								 lastName = "'.$lastName.'",
								 memberType = "'.$memberType.'",
								 memberNumber = '.$memberNumber.',
								 email = "'.$memberEmail.'",
								 phoneNumber = "'.$memberPhone.'"
							 WHERE memberNumber = '.$memberNumber;
							 
	$statement = $link->prepare($query);
	$statement->execute();
	$statement->close();
}
?>