<?php

include_once("./../../Models/TeeTimes.php");
include_once("./../../Models/LibraryImports.php");
include_once("./../../Views/NavBar.php");
include_once("./../../Models/Members.php");

$teeTime = FILTER_INPUT(INPUT_GET, "time");

$teeTimeArray = getTeeTime($teeTime);

//getting the members array
$members = getMembers();

$currentTime = FILTER_INPUT(INPUT_GET, "time");


?>
<?php //js do something when an option is selected in <option> ?>
<script type="text/javascript" src="./../../Models/TableFilter.js"></script>
<script type="text/javascript" src="./../../Models/memberSelecter.js"></script>

<head>
	<title> Pro Edit TeeTime </title>
</head>

<body>
		<form action="./../../Controllers/ProUser/Pro.php" method="post">
			<input hidden name="time" value="<?php echo $currentTime; ?>"
			<label> Slot 1 </label>
			<input name="Time1" id="Time1" value=<?php echo $teeTimeArray[0][1] ?>> </input>
			</br>
			<label> Slot 2 </label>
			<input name="Time2" id="Time2" value=<?php echo $teeTimeArray[0][2] ?>> </input>
			</br>
			<label> Slot 3 </label>
			<input name="Time3" id="Time3" value=<?php echo $teeTimeArray[0][3] ?>> </input>
			<?php //used for typing the member's name ?>
			<input placeholder="Enter a Name" id="myInput"> </input>
			</br>
			<label> Slot 4 </label>
			<input name="Time4" id="Time4" value=<?php echo $teeTimeArray[0][4] ?>>
			<?php //used for showing member's names ?>
						<select id="FilterSelect" placeholder="select a member"> 
							<option disabled selected> Select A Member </option>
							<?php foreach ($members as $member) : ?>
								<option> <?php echo $member[1]." ".$member[2]; ?>
							<?php endforeach ?>
						</select>
			</br>
			<label> Slot 5 </label>
			<input name="Time5" id="Time5" value=<?php echo $teeTimeArray[0][5] ?>> </input>
			</br>
			
			<label> Notes </label>
			<input name="Notes" value=<?php echo $teeTimeArray[0][6] ?>> </input>
			</br>
			<button type="submit" name="action" value="edit"> Submit</button>
		</form>
	</body>