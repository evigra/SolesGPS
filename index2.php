<?php
	
	include('nucleo/cer/File/X509.php');

	$x509 = new File_X509();	
	$cer=$_GET["cer"];
	
	
	$pemca = file_get_contents('VIGE850830GKA.cer');	
	$pemca = file_get_contents($cer);	

	
	$cert = $x509->loadX509($pemca);
	

	echo "<pre>";
	print_R($cert);	
	echo "</pre>";





?>
