<?php 
include_once("./../../Models/Members.php");
include_once("./../../Models/LibraryImports.php");
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
//Block Member
if($_SESSION["access"] == "Member") {
	echo 	'<script type="text/javascript">
				window.location.href = "./../../Controllers/home.php";
			</script>';
}

?>

<html>
	<head>
		<script type="text/javascript" src="./../../Models/TableSorter.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<?php // help with table formatting from https://stackoverflow.com/questions/38160951/how-do-i-horizontally-center-a-table-in-bootstrap ?>
		<div class="justify-content-center row ">
			<div class="col-auto">
				<table class="table-responsive table table1">
					<thead>
						<tr>
							<th> First Name </th>
							<th> Last Name </th>
							<th> Member Type </th>
							<th> Member Number </th>
							<th> Member Email </th>
							<th> Phone Number </th>
							<th> Manage </th>
						</tr>
					</thead>
					
					<tbody id="tableBody">
						<?php  
							//used to choose what column the filter will filter though
							$filterColumn = 2;
							//need to skip 0 and 7 of the loop
							$counter = 0;
							//making the table of all memberArray
							
							$memberArray = getMembers();
							
							foreach($memberArray as $member) {
								//reset the counter
								$counter = 0;
								//create the start of the row
								echo "<tr>";
									
									foreach($member as $memberItem) {
										//skips the two columns that aren't shown
										if ($counter === 0 || $counter === 7) {
											$counter++;
											continue;
										}
										//labels the filter column
										if ($counter === $filterColumn) {
											//start and end the data
											echo '<td class="filterTab">';
											echo $memberItem;
											echo "</td>";
											$counter++;
											continue;
										}
										//label the member number column for post
										if ($counter === 4) {
											//setting the value for the memberNumber
											echo '<td name="memberNumber" value="'.$memberItem.'">';
											echo $memberItem;
											echo "</td>";
											$counter++;
											continue;
										}
										//start and end the data
										echo "<td>";
										echo $memberItem;
										echo "</td>";
										$counter++;
									}
									//build the edit button $member[4] grabs the current id for submission reasons and the delete button with the same value
									echo ' <td> <a href="./../../Views/Admin/EditMember.php?id=' . $member[4] . '"' . '/>Edit</a>
												|
												<a href="admin.php?action=delete&memberNumber='.$member[4].'&id=' . $member[0] . '"' . '/>Delete</a>
										   </td>';
							}	
								echo "</tr>"
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>