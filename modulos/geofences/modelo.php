<?php
	class geofences extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),		
			"name"	    =>array(
			    "title"             => "Geocerca",
			    "type"              => "input",
			),
			
			"points"	    =>array(
			    "title"             => "Puntos",
			    "type"              => "hidden",
			),
			"area"	    =>array(
			    "title"             => "Puntos",
			    "type"              => "hidden",
			),

			"geofence_email_in"	    =>array(
			    "title"             => "Email al entrar",
			    "type"              => "input",
			),			
			"geofence_email_out"	    =>array(
			    "title"             => "Email al salir",
			    "type"              => "input",
			),			
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),				
			"color"	    =>array(
			    "title"             => "Color",
			    "type"              => "select",
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
			    "type"              => "select",
			    "source"			=>array(
			    	"1"			=>	"SI",
			    	"0"			=>	"NO",
			    )			    
			),				


		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT($option=NULL)
		{
			return parent::__CONSTRUCT($option);
		}
		
		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		if(isset($datas["points"]))
    		{
				$datas["points"] =substr($datas["points"],0,strlen($datas["points"])-2);    		
				$datas["points"] = str_replace(",", " ", $datas["points"]);
				$datas["points"] = str_replace("|", ", ", $datas["points"]);
								
				$datas["area"]    		="POLYGON(({$datas["points"]}))";
				$datas["company_id"]    =$_SESSION["company"]["id"];
			}	
			return parent::__SAVE($datas,$option);			
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
		public function autocomplete_geofences()		
    	{	
    		$option					=array();
    		$option["where"]		=array();    		
    		$option["where"][]		="name LIKE '%{$_GET["term"]}%'";
    		$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";
    		
			$return =$this->__BROWSE($option);    				
			return $return;			
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
			return $return;
		}		
	}
?>
