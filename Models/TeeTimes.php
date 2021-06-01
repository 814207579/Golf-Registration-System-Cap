<?php 
include("./../../Models/Database.php");
//made the function so it can be used without or without an input date
function getTeeSheet($currentDate = "") {
	global $link;
	
	//deals with the link if it doesn't have a date
	if ($currentDate === "") {
    	$currentDate = new DateTime(date("Y")."-".date("m")."-".date("d"));
    }
	//deals with the link if it does have a date
    else {
    	$dateArray = explode("/", $currentDate);
		//var_dump($dateArray);
        $currentDate = new DateTime($dateArray[0]."-".$dateArray[1]."-".$dateArray[2]);
    }
	$currentDate = $currentDate->format("Y/m/d");
	
	//echo $currentDate;
	
	$query = "SELECT * FROM teetimedb.`".$currentDate."`";
	
	$statement = $link->prepare($query);
	$statement->execute();
	
	$result = $statement->get_result();

	$result = $result->fetch_all();

	//echo var_dump($result);

	$teetimes = $result;
	
	$statement->close();
	
	return $result;
}

function getTeeTime($time) {
	global $link;
	
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	$builtDate = ($year."-".$month."-".$day);
	$currentDate = new DateTime($builtDate);
	$currentDate = $currentDate->format("Y/m/d");
	
	$query = 'SELECT * FROM teetimedb.`'.$currentDate.'` WHERE currentTime = "'.$time.'"';
	$statement = $link->prepare($query);
	$statement->execute();
	
	$result = $statement->get_result();

	$result = $result->fetch_all();
	
	return $result;
}

function editTeeTime($time, $name1, $name2, $name3, $name4, $name5, $notes) {
	global $link;
	//building the date for table name
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	$builtDate = ($year."-".$month."-".$day);
	$currentDate = new DateTime($builtDate);
	$currentDate = $currentDate->format("Y/m/d");
	
	//never though I'd use the whole ()?: thing but it works perfectly here to make it not bug out on blank names
	$query = 'UPDATE teetimedb.`'.$currentDate.'` SET 
								 time1 = '. (($name1 == "") ? "NULL" : '"'.$name1.'"') .', 
								 time2 = '. (($name2 == "") ? "NULL" : '"'.$name2.'"') .',
								 time3 = '. (($name3 == "") ? "NULL" : '"'.$name3.'"') .',
								 time4 = '. (($name4 == "") ? "NULL" : '"'.$name4.'"') .',
								 time5 = '. (($name5 == "") ? "NULL" : '"'.$name5.'"') .',
								 notes = '. (($notes == "") ? "NULL" : '"'.$notes.'"') .'
							 WHERE currentTime = "'.$time.'"';
		
	$statement = $link->prepare($query);
	$statement->execute();
	$statement->close();
}
?>