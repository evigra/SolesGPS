<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class geofences extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"name"	    =>array(
			    "title"             => "Geocerca",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			
			"points"	    =>array(
			    "title"             => "Puntos",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    #"type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			"area"	    =>array(
			    "title"             => "Puntos",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",			    
			),

			"geofence_email_in"	    =>array(
			    "title"             => "Email al entrar",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"geofence_email_out"	    =>array(
			    "title"             => "Email al salir",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),				
			"color"	    =>array(
			    "title"             => "Color",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"red"				=>	"Rojo",
			    	"orange"			=>	"Anaranjado",
			    	"yellow"			=>	"Amarillo",
			    	"green"				=>	"Verde",
			    	"blue"			    =>	"Azul",
			    	"black"				=>	"Negro",
			    )			    

			),				
			"hidden"	    =>array(
			    "title"             => "Oculto",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"1"			=>	"SI",
			    	"0"			=>	"NO",
			    )			    
			),				


		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
			#$this->__PRINT_R($this->sys_fields["points"]);

		}
		
		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		/*
    		echo "SAVE MODULO";
    		
    		*/
    		#$this->__PRINT_R($datas["points"]);
    		if(isset($datas["points"]))
    		{
				$datas["points"] =substr($datas["points"],0,strlen($datas["points"])-2);    		
				$datas["points"] = str_replace(",", " ", $datas["points"]);
				$datas["points"] = str_replace("|", ", ", $datas["points"]);
				
						
				
				$datas["area"]    		="POLYGON(({$datas["points"]}))";
				$datas["company_id"]    =$_SESSION["company"]["id"];
				parent::__SAVE($datas,$option);
			}	
		}	
		public function geofence($option=NULL)
    	{
    		if(@$_SESSION["company"]["id"]!="")
    		{
				if(is_null($option))	$option=array();
				
				$option["select"]   =array("g.*",);			
				$option["from"]		="geofences g";
		        
		        if(!isset($option["where"]))		$option["where"]	=array();
		        
				$option["where"][]	="company_id={$_SESSION["company"]["id"]}";

						
				return $this->__VIEW_REPORT($option);
			}
			else
			{
				return false;
			}	
		}		
		public function geofences_data($option=NULL)
    	{    		
    		$comando_sql	="SELECT g.* FROM geofences g WHERE company_id={$_SESSION["company"]["id"]} ORDER BY name";
    		return		$this->__EXECUTE($comando_sql);
    	}	
		public function geofences_html($option=NULL)
    	{
    		$geofences		=$this->geofences_data();
    		$return			="";
    		$data			="";
    		
  			$col=0;
  			foreach(@$geofences as $geofence)
  			{	
  				$geofence["name"]=strtoupper($geofence["name"]);
  				
  				if($col==0)	$data.="<tr>";
  				$col++;
  				$chequed="";
  				
  				if(!is_null($option))
  				{
					$comando_sql		="SELECT ag.* FROM alerts_geofence ag WHERE geofence_id={$geofence["id"]} AND alerts_id=$option";
					#echo "<br>$comando_sql";
					$alerts_geofence	=$this->__EXECUTE($comando_sql);
					
  				
  					if(@$alerts_geofence[0]["status"]=="1")	$chequed="checked";
  					else									$chequed="";
  				}	
  				
  				$data.="
  						<td>
	  						<table width=\"200\">
	  							<tr>
	  								<td align=\"left\" width=\"30\"><input type=\"checkbox\" $chequed name=\"geofences_ids[{$geofence["id"]}]\" value=\"1\"></td>
	  								<td align=\"left\">{$geofence["name"]}</td>
	  							</tr>
	  						</table>	  						  
  						</td>
  				";
  				if($col==3){	$data.="</tr>"; $col=0;}
  			}
  			$return="
  				<table>
  				$data
  				</table>  			
  			";
			#$this->__PRINT_R($devices);			
			return $return;
		}		
	}
?>
