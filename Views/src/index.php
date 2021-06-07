<?php 
	include_once("./../../Models/TeeTimes.php");
	include_once("./../../Models/LibraryImports.php");
	include_once("./../../Views/NavBar.php");
	
?>
<head>
	<title> Calendar </title>
</head>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet/less" type="text/css" href="style.less" />
<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
<div class="calendar-wrapper">
  <button id="btnPrev" type="button">Prev</button>
	  <button id="btnNext" type="button">Next</button>
  <div id="divCal"></div>
</div>
