<?php
	$kwords = fopen('kwords.txt','a');
	$words = $_POST['words'];
	fputs($kwords,date("Y-m-d H:i",time()));
	fputs($kwords,"//");
	fputs($kwords,$words);
	fputs($kwords,";");
	fputs($kwords,"\r\n");
	fclose($kwords);
	header('Location: ../search.html');
?>