<?php 
if (!ISSET($_SESSION)) {
	session_start();
}
$userName = $_SESSION["username"];
//$userName = 3124;

if (is_numeric($userName)) {
	INCLUDE_ONCE("./../../Models/Members.php");
	$memberName = getMemberName($userName);
	$userName = $memberName[0][0]." ".$memberName[0][1];
}
else {
	$userName = ucfirst($userName);
}

?>

<nav class="navbar navbar-light bg-light navbar-expand">
	<a class="navbar-brand" href="./../../Home.php">Golf Registration System</a>
		<ul class="navbar-nav mr-auto navbar-right">
			<li class="nav-item">
				<a class="nav-link" href="./../../Views/src">Calendar</a>
			</li>
			<?php if($_SESSION["access"] == 'Member') : ?>
				<li class="nav-item">
					<a class="nav-link" href="./../../Controllers/User/user.php">TeeTimes</a>
				</li>
			<?php endif; ?>
			<?php if($_SESSION["access"] == 'Admin') : ?>
				<li class="nav-item">
					<a class="nav-link" href="./../../Controllers/Admin/Admin.php">Manage Members</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./../../Controllers/Admin/ResetPasswordAdmin.php">Reset A Password</a>
				</li>
			<?php endif; ?>
			<?php if($_SESSION["access"] == 'Pro') : ?>
				<li class="nav-item">
					<a class="nav-link" href="./../../Controllers/ProUser/Pro.php">TeeTimes</a>
				</li>
			<?php endif; ?>
		</ul>
		
		<span class="navbar-text">
			Hello <a href="./../../Controllers/reset-password.php"> <font size="+1"><?php echo $userName; ?></font></a>
			<a class="my-sm-0" href="./../../Controllers/Logout.php"> Logout</a>
		</span>
</nav>