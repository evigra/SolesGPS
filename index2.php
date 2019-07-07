<?php
	
	include('nucleo/cer/Crypt/RSA.php');
	include('nucleo/cer/File/X509.php');
	

	$data_file = file_get_contents('VIGE850830GKA.cer');	
	
	$objeto = new File_X509();	
	$cert = $objeto->loadX509($data_file);
	
	/*
	echo "<pre>";
	print_R($cert);	
	echo "</pre>";
	#*/




	$data_file = file_get_contents('VIGE850830GKA.key');	
	
	$objeto = new Crypt_RSA();	
	$cert = $objeto->loadKey($data_file);
	
	#/*
	echo "<pre>";
	#print_R($objeto);	
	print_R($cert);
	echo "</pre>";
	#*/

?>
