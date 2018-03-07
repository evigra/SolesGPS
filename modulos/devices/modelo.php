<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class devices extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_filter		=array(
				"name"=>"d.name",		
		);
		var $sys_fields		=array(
				"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"name"	    	=>array(
			    "title"             => "Numero Economico",
			    "title_filter"		=> "Dispositivo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"bastidor"	    	=>array(
			    "title"             => "Bastidor",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"uniqueid"	    =>array(
			    "title"             => "Imei",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),	
			"status"	    =>array(
			    "title"             => "Alertas",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"1"		=>	"Activa",
			    	"0"		=>	"Inactiva",
			    ),	
			),
			"bloqueo"	    =>array(
			    "title"             => "Bloqueo",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(			    	
			    	"0"		=>	"Inactiva",
			    	"1"		=>	"Activa",
			    ),	
			),

			"dataId"	    =>array(
			    "title"             => "Clave Datos",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"positionid"	    =>array(
			    "title"             => "Posicion Actual",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"transmision"	    =>array(
			    "title"             => "Transmision",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"Automatica"	=>	"Automatica",
			    	"Estandar"		=>	"Estandar",
			    ),	
			    
			),
			"tipoCombustible"   =>array(
			    "title"             => "Tipo de Combustible",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"emisionesCO2"      =>array(
			    "title"             => "Emisiones CO2",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"caballosPotencia"   =>array(
			    "title"             => "Caballos de Potencia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"fechaAdquisicion"   =>array(
			    "title"             => "Fecha de Adquisicion",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			),
			"valorCoche"   =>array(
			    "title"             => "Costo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"numAsientos"   =>array(
			    "title"             => "Numero de Asientos",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"numPuertas"   =>array(
			    "title"             => "Numero de Puertas",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"color"   =>array(
			    "title"             => "Color",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"image"   =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"01"	=>	"Carro Gris",
			    	"02"	=>	"Carro Rojo",
			    	"03"	=>	"Camioneta Gris",
			    	"30"	=>	"Moto",
			    	"90"	=>	"Celular Negro",
			    	"91"	=>	"Celular Azul",
			    	"92"	=>	"Celular Verde",
			    	"93"	=>	"Celular Rojo",			    	
			    )
			),			
			"vehicle"	    =>array(
			    "title"             => "Vehiculo",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",
			),						
			
			"telefono"   =>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"file_id"	    =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "no",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",			    
			),	
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    /*
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    "class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",			    			    
			    */
			),
			"responsable_id"	    =>array(
			    "title"             => "Externo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			#/*
			"responsable_fisico_id"	=>array(
			    "title"             => "Supervisor",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/users/ajax/index.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "users",
			    #"class_path"        => "modulos/users/modelo.php",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "responsable_fisico_id",
			    "class_field_m"    	=> "id",			    
			),
			#*/
			"placas"	    		=>array(
			    "title"             => "Placas",
			    "title_filter"		=> "Placas",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"speed_max"	    		=>array(
			    "title"             => "Velocidad Maxima",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"mail_speed"	    		=>array(
			    "title"             => "Mail por exceso de velocidad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"lastupdate"	    =>array(
			    "title"             => "Ultima Actualizacion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files();	
			parent::__CONSTRUCT();
			
			#$this->__PRINT_R($_SESSION);
		}
				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{   
    		#echo "PRUEBA---------------";
    		#$option["echo"]				="DEVICES :: SAVE";
    	    $datas["company_id"]		=$_SESSION["company"]["id"];

    	    $files_id					=$this->files_obj->__SAVE();    	    
    	    if(!is_null($files_id))		$datas["files_id"]			=$files_id;    	    

    		parent::__SAVE($datas,$option);
		}		
		public function devices_time()
    	{
      		if(is_null($option))			$option				=array();
    		if(is_null($option["select"]))	$option["select"]	=array();
    		    		
			$option["select"]["d.name"]			="ECONOMICO";
			$option["select"]["c.rasonSocial"]	="EMPRESA";
			$option["select"]["d.placas"]		="PLACAS";
			$option["select"]["SEC_TO_TIME(TIMESTAMPDIFF(SECOND, d.lastUpdate, now()))"]		="REPORTO HACE";
			$option["select"]["lastUpdate"]		="ULTIMO REPORTE";
			
			$option["from"]						="device d LEFT JOIN company c ON d.company_id = c.id";
			
			$option["where"][]					="dev.company_id NOT IN (1)";
			$option["where"][]					="SEC_TO_TIME(TIMESTAMPDIFF(SECOND, d.lastUpdate, now()))>'00:10:00'";
			
			
						
			$data = $this->__VIEW_REPORT($option);

			$para      = 'evigra@hotmail.com';
			$titulo    = 'SOLESGPS POSITIONS';
			$mensaje   = $data;
			$cabeceras = 'From: webmaster@example.com' . "\r\n" .
				'Reply-To: webmaster@example.com' . "\r\n" .
				'X-Mailer: PHP/';
			mail($para, $titulo, $mensaje, $cabeceras);			

    	}		
		public function devices($option=NULL)
    	{
    		if(is_null($option))	$option=array();

			#$option["echo"]="DEVICES :: modelo";    		
			
			
			$option["total"]	=1;
			$option["select"]   =array(
					"distinct(d.id)"																							=>"d_id",
					"d.*",
					"IF(image!=0,CONCAT('../sitio_web/img/car/vehiculo_',image,'/i225.png'),'../modulos/device/img/cell.png')"	=>"file_id",
					"IF(vehicle=1,'../modulos/device/img/car.png','../modulos/device/img/cell.png')"							=>"file_id1",
			);
			$option["from"]     ="devices d, user_group ug, groups g";
			
			if(!isset($option["where"]))    $option["where"]    =array();


			$option["section_filter"]="devices";

			
			$option["where"][]      ="d.company_id={$_SESSION["company"]["id"]}";
			$option["where"][]      ="ug.menu_id=2";
			$option["where"][]      ="
				(		
					(
						responsable_fisico_id={$_SESSION["user"]["id"]}		
						AND user_id=responsable_fisico_id
						AND ug.active=g.id
					)        
					OR					
					(
						ug.user_id={$_SESSION["user"]["id"]}		
						AND ug.active=g.id
						AND g.nivel<=20
					)
				)			
			";		
			
			$option["color"]["orange"]	="$"."row[\"status\"]=='Inactiva'";
			
			
			
			$return =$this->__VIEW_REPORT($option);			
			#$this->__PRINT_R($this->sys_sql);			
			return	$return; 
    	
		}		
		public function devices_user($user=NULL)
    	{
    		$return="";
    		$data="";
  			$devices=$this->devices();
  			$col=0;
  			#$this->__PRINT_R($devices["data"][0]);
  			foreach($devices["data"] as $device)
  			{	
  				if($col==0)	$data.="<tr>";
  				$col++;
  				$chequed="";
  				
  				
  				if($device["responsable_fisico_id"]==$user)	$chequed="checked";
  				
  				
  				$data.="
  						<td>
	  						<table height=\"40\" width=\"200\">
	  							<tr>
	  								<td align=\"left\" width=\"30\"><input type=\"checkbox\" $chequed name=\"device[{$device["id"]}]\" value=\"1\"></td>
	  								<td align=\"left\">{$device["name"]}<br>{$device["placas"]}</td>
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
		public function devices_data($option=NULL)
    	{    		    		
    		if(is_null($option))			$option				=array();    		
    		if(!isset($option["where"]))	$option["where"]	=array();
    		
    		$option["where"][]				="company_id={$_SESSION["company"]["id"]}";    		
    		$return							=$this->__BROWSE($option);    		
    		return $return["data"];
    	}			
		public function devices_html($option=NULL)
    	{
    		$return="";
    		$data="";
  			$devices=$this->devices_data();
  			$col=0;
  			#$this->__PRINT_R($devices["data"][0]);
  			foreach($devices as $device)
  			{	
  				if($col==0)	$data.="<tr>";
  				$col++;
  				$chequed="";
  				
  				if(!is_null($option))
  				{
					$comando_sql		="SELECT * FROM alerts_device ad WHERE device_id={$device["id"]} AND alerts_id=$option";
					$alerts_device	=$this->__EXECUTE($comando_sql);


	  				if(@$alerts_device[0]["status"]==1)	$chequed="checked";
	  				else								$chequed="";
	  			}	
  				
  				$data.="
  						<td>
	  						<table height=\"30\" width=\"200\">
	  							<tr>
	  								<td align=\"left\" width=\"30\"><input type=\"checkbox\" $chequed name=\"devices_ids[{$device["id"]}]\" value=\"1\"></td>
	  								<td align=\"left\">{$device["name"]}<br>{$device["placas"]}</td>
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
						
		public function cron_saldo()
    	{    
		    		
			$comando_sql		="
				SELECT d.id,left(d.telefono,10) as referencia,  now() as actualizado, 'TEL050' as producto
				FROM devices d join company c on c.id=d.company_id  
				WHERE 1=1 
					AND 
					(bloqueo!=1
					OR bloqueo is NULL)
					AND c.estatus=1
					AND d.telcel=1
					AND(d.recargado is null  OR    DATE_ADD(d.recargado, INTERVAL 29 DAY)< now() )
			";
			$datas	=$this->__EXECUTE($comando_sql);

			foreach($datas as $row)
			{	
				$this->__PRINT_R( 	$this->WS_TAECEL($row) 		);
			}
    	}
		public function prueba_saldo()
    	{    
			$datas=array(
				array("referencia"=>"5555555505", "producto"=>"TEL010"),
				array("referencia"=>"5555555510", "producto"=>"TEL050"),
				array("referencia"=>"5555555515", "producto"=>"TEL100"),
				array("referencia"=>"5555555520", "producto"=>"TEL150"),
				array("referencia"=>"5555555525", "producto"=>"TEL200"),
				array("referencia"=>"5555555530", "producto"=>"MOV010"),
				array("referencia"=>"5555555540", "producto"=>"MOV050"),
				array("referencia"=>"5555555560", "producto"=>"MOV100"),
				array("referencia"=>"5555555565", "producto"=>"MOV120"),
				array("referencia"=>"5555555200", "producto"=>"MOV150"),
				array("referencia"=>"871235412635", "producto"=>"SKY000", "monto"=>"95"),
				array("referencia"=>"6589745213", "producto"=>"TMX001", "monto"=>"100"),
				array("referencia"=>"125478965412365478965230126654", "producto"=>"CFE000", "monto"=>"260"),
				array("referencia"=>"9854123547", "producto"=>"MEG000", "monto"=>"131"),
				array("referencia"=>"27458965324125", "producto"=>"DSH000", "monto"=>"103"),
				array("referencia"=>"4578326541", "producto"=>"IZZ000", "monto"=>"155"),
				array("referencia"=>"3456987", "producto"=>"MAX000", "monto"=>"177"),
				
			);		    		

			foreach($datas as $row)
			{	
				$this->__PRINT_R( 	$this->WS_TAECEL($row) 		);
			}
    	}
  		  				
		
	}
?>
