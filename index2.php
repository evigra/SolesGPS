<?php
	
	include('nucleo/cer/File/X509.php');

	$x509 = new File_X509();	
	$pemca = file_get_contents('VIGE850830GKA.cer');	
	$pemca = file_get_contents('VIGE850830GKA.key');	

	
	$cert = $x509->loadX509($pemca);
	

	echo "<pre>";
	print_R($cert);	
	echo "</pre>";





?>
