<?php
	
    session_start();
	
	if(!isset($_SESSION["loggedin"]) ) {
			//simple script to send the user to another page without using php headers
			echo '<script type="text/javascript">
						window.location.href = "./login.php";
				  </script>';
	}
	
    if($_SESSION["access"] == 'Member') {
		echo '<script type="text/javascript">
						window.location.href = "./User/User.php";
				  </script>';
    }
	else if ($_SESSION["access"] == "Admin") {
		echo '<script type="text/javascript">
						window.location.href = "./Admin/admin.php";
				  </script>';
	}
	else if ($_SESSION["access"] == "Pro") {
		echo '<script type="text/javascript">
						window.location.href = "./ProUser/Pro.php";
				  </script>';
	}
?>