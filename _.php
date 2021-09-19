<?php
	// include('condb.php');
	header("Content-Type: text/plain; charset=utf-8");

	$fls = $_REQUEST["fls"];
	if(is_file($fls.".php")) include($fls.".php");
?>