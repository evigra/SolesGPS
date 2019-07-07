<?php
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/File/X509.php');

	$x509 = new File_X509();
	$cert = $x509->loadX509('VIGE850830GKA.cer');

	print_R($cert)	
?>
