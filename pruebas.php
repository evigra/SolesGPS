<?php


	#date_default_timezone_set('America/Los_Angeles');
	$script_tz = date_default_timezone_get();
	
	
	
	
	echo $script_tz;
	echo "<br>".date("Y-m-d H:i:s");
	
	date_default_timezone_set('America/Mexico_City');
	echo "<br>".date("Y-m-d H:i:s");
	
	echo "<br>";


	foreach(timezone_abbreviations_list() as $timezone)
	{
		    foreach($timezone as $abbr =>$val)
		    {
		            if(isset($val['timezone_id']))
		            {
		            	echo "<br>". $val['offset']/60/60 ."<pre>" . print_r($val) . "</pre>";
		            }
		    }
	}
?>

