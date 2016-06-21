<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

	<title >Welcome></title>
	<link rel="stylesheet" href="../Css/home.css"/>
	<link rel="stylesheet" href="../Css/nav.css"/>
</head>
<body>


<div id="content">
<?php include "navigation.php" ?>

<div id="rendu_final">
	<video class="video"id="video"></video>
	<div id="filter_prev" class = "filter1"></div>
</div>

<canvas id="canvas"></canvas>
<img style="display:none" src="http://placekitten.com/g/320/261" id="photo" alt="photo">

<div id= "bouton">
<button id="startbutton">Prendre une photo</button>
	
<form action="../Controlers/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<form method="post" action="final.php">
	<select name="filter" id="choice">
		<option name = "1" value ="filter1">Filter 1</option>
		<option name = "2" value ="filter2">Filter 2</option>
		<option name = "3" value ="filter3">Filter 3</option>
	</select>
	<input id = "filter_button" type="submit" VALUE="filter"/>
</form>
</div>
</div>

<script src="../Js/script.js"></script>
<script type="text/javascript" src= "../Js/filter_preview.js"></script>

</body>
</html>