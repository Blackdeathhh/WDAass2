<!DOCTYPE HTML5>
<html>
<head>
	<link rel="stylesheet" href="css/base.css" />
	<meta charset="UTF-8">
	<title>Messages</title>
</head>
<body>
<?php require("php/topbar.php"); ?>

<div class="maindiv">
<?php
session_start();
require_once("php/database.php");
require_once("php/storedprocedures.php");
require_once("php/error.php");

if(isset($_GET['messageid'])){
	$db = connectToDatabase();
	if($db){
		$content = getMessageContent($db, $_GET['messageid'], $_SESSION['id'], $_SESSION['token']);
		switch($content[SP::ERROR]){
			case ERR::OK:
				echo "<p>". $content[MESSAGE::CONTENT] ."</p>";
				break;
		}
	}
	else{
		echo "<p>Could not coinnect to database. Please try again later.</p>";
	}
}
else{
	echo "<p>No message selected. <a href='friendslist.php'>Back to friends list</a>.</p>";
}
?>
</div>
</body>
</html>