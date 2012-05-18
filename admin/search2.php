<?php
	$lesadresses = fopen('lesadresses.txt','a');
	$lemail = $_POST['lemail'];
	fputs($lesadresses,date("Y-m-d H:i",time()));
	fputs($lesadresses,"//");
	fputs($lesadresses,$lemail);
	fputs($lesadresses,";");
	fputs($lesadresses,"\r\n");
	fclose($lesadresses);
	header('Location: ../index.html');
?>