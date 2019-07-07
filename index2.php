<?php
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/File/X509.php');

	$x509 = new File_X509();
	/*
	echo "<pre>";
	print_R($x509);
	echo "</pre>";
	#*/
	
	$pemca = file_get_contents('VIGE850830GKA.cer');
	
	$cert = $x509->loadX509($pemca);

	echo "<pre>";
	print_R($cert);	
	echo "</pre>";
?>
