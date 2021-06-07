<?php 
	include_once("./../../Models/TeeTimes.php");
	include_once("./../../Models/LibraryImports.php");
	include_once("./../../Views/NavBar.php");
?>
<html>
	<head>
		<title> Tee Sheet </title>
		<script type="text/javascript" src="./../../Models/TableSorter.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
	</head>
	<body>
		<?php // help with table formatting from https://stackoverflow.com/questions/38160951/how-do-i-horizontally-center-a-table-in-bootstrap ?>
		<div class="justify-content-center row">
			<div class="col-auto">
				<table class="table-responsive table table1">
					<thead>
						<tr>
							<th> Time</th>
							<th> Time 1</th>
							<th> Time 2</th>
							<th> Time 3</th>
							<th> Time 4</th>
							<th> Time 5</th>
							<th> Notes</th>
							<th> Manage</th>
						</tr>
					</thead>
					<tbody id="tableBody">
						<?php
							//making the function work based off a given date
							$currentDateGet = FILTER_INPUT(INPUT_GET, "date");
							if (!ISSET($currentDateGet)) {
								$currentDateGet = "";
							}
							else {
								//redirecting if they picked an invalid date
								$currentDatePlusSeven = new DateTime("now");
								//$currentDatePlusSeven->modify("+7 days");
								$dateCheck = explode("/", $currentDateGet);
								$dateCheck = new DateTime($dateCheck[0]."-".$dateCheck[1]."-".$dateCheck[2]);
								$dateDifference = $currentDatePlusSeven->diff($dateCheck);
								
								$numberOfDaysMoreThanSeven = $dateDifference->format('%a');
								
								//echo (int)$numberOfDaysMoreThanSeven;
								//echo $numberOfDaysMoreThanSeven;
								if ((int)$numberOfDaysMoreThanSeven > 6) {
									echo '<script type="text/javascript">
											 window.location.href = "./../../Views/Src";
										 </script>';
								}
							}
							
							
							
							
							$teeArray = getTeeSheet($currentDateGet);
							$locationCounter = 0;
							foreach($teeArray as $tee) {
								//reset the counter
								$counter = 0;
								//trying something to hide times
								$splitTime = explode(":", $tee[0]);
								//create the start of the row
								echo "<tr>";
									if ($splitTime[0] < 7) {
										unset($splitTime);
										continue;
									}
									//trying to make it display 1900 was annoying, but this makes it work so all good
									if ($splitTime[0] > 18) {
										if ($splitTime[1] >= 0) {
											if ($splitTime[0] == 19 && $splitTime[1] == 0) {
												
											}
											else {
												continue;
											}
										}
									}
									foreach($tee as $teeItem) {
										//skip the bool column as it doesn't need to be in the table
										if ($counter === 7) {
											continue;
										}
										//I need to fix the notes later
										if ($counter === 6) {
											if ($tee[6] !== NULL) {
												$note = $teeItem;
												echo "<td name='[".$locationCounter."][6]'>";
												//round about way to make the notes all unique calls so they can work
												echo '<script type="text/javascript">
														function alertClick'.$locationCounter.'6'.'() {
															alert("'.$tee[6].'");
														}
													  </script>';
													  
												echo '<a href="javascript:alertClick'.$locationCounter.'6'.'();">click me</a>';
												echo "</td>";
												$counter++;
												echo "<td>";
												echo "<a href='./../../Views/User/EditTeeTime.php?time=".$tee[0]."'>Edit</td>";
												echo "</td>";
												continue;
											}
											else {
												$note = $teeItem;
												echo "<td name='[".$locationCounter."][6]'>";
												echo "empty";
												echo "</td>";
												$counter++;
												echo "<td>";
												echo "<a href='./../../Views/User/EditTeeTime.php?time=".$tee[0]."'>Edit</td>";
												echo "</td>";
												continue;
											}
										}
										if ($teeItem === NULL) {
											echo "<td>";
											echo "empty";
											echo "</td>";
											$counter++;
											continue;
										}
										echo "<td>";
										echo $teeItem;
										echo "</td>";
										$counter++;
									}
							$locationCounter++;
							}	
								echo "</tr>";
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>