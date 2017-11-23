<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class contabilidad extends general
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
			"fechaMovimiento"	    	=>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"movimiento"	    	=>array(
			    "title"             => "Movimiento",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"descripcionMovimiento"	    	=>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"monto"	    	=>array(
			    "title"             => "Monto",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"relacion"	    	=>array(
			    "title"             => "Relacion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"analitica_id"	    =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "relation"          => "one2many",
			    "class_name"       	=> "files",
			    "class_path"        => "modulos/files/modelo.php",
			    "class_field_o"    	=> "files_id",
			    "class_field_m"    	=> "id",			    
			),
			"CASE WHEN co.movimiento='CARGO' THEN round(monto,2) END"=>array(
				"title"				=> "CARGO",
				"showTitle"			=> "si"
			),	


/*
			"contabilidad_ids"	=>array(
			    "type"              => "class",	    			    
			    "relation"          => "one2many",
			    "class_name"       	=> "movimiento",
			    "class_path"        => "modulos/movimiento/modelo.php",
			    "template_title"    => "modulos/movimiento/html/report_title",
			    "template_body"     => "modulos/movimiento/html/report_body",
			    #"template_search"   => "modulos/movimiento/html/search",
			    "template_create"   => "modulos/movimiento/html/create",			   			    
			    #"class_field_l"    	=> "clave",				# Label
			    #"class_field_o"    	=> "customer_id",		
			    #"class_field_m"    	=> "id",			    
			),			
*/			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files();	
			parent::__CONSTRUCT();
		}				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];    	    
    		parent::__SAVE($datas,$option);
		}		

		public function reporte($option=NULL)
    	{
    		if(is_null($option))			$option				=array();
    		if(!isset($option["select"]))	$option["select"]	=array();

			$option["select"][101]   																="ca.*";
			$option["select"][102]   																="co.*";
			$option["select"]["CASE WHEN co.movimiento='CARGO' THEN round(monto,2) END"]   			="CARGO";
			$option["select"]["CASE WHEN co.movimiento='ABONO' THEN round(monto,2) END"]   			="abono";
			
			$option["from"]     				="contabilidad co join contabilidad_analitica ca on co.analitica_id=ca.id";
			#$option["echo"]     		="CONTABILIDAD";

			if(!isset($option["where"]))    $option["where"]    =array();
			
			#$option["where"][]      ="co.company_id={$_SESSION["company"]["id"]}";

			$return 				=$this->__VIEW_REPORT($option);
			return	$return;     	
		}				
		public function reporte_kanban($option=NULL)
    	{
    		$where="";
    		if(!is_null($option))
    		{
    			if($option["where"]!="")	$where=$option["where"];    			
    		}
			$comando_sql="
				SELECT 
					c.id, GROUP_CONCAT(cargo SEPARATOR '') as cargo,round(sum(cargo),2) as total_cargo, GROUP_CONCAT(abono  SEPARATOR '') as abono,round(sum(abono),2) as total_abono,type,
					GROUP_CONCAT(relacion_cargo SEPARATOR '') as relacion_cargo, 
		            GROUP_CONCAT(relacion_abono SEPARATOR '') as relacion_abono,
					(
					case 	
						when (right(c.type,6)='DEUDOR')  then round(sum(cargo)-sum(abono),2) 
						when (right(c.type,7)='ACREDOR')  then round(sum(abono)-sum(cargo),2)
					end
					)
					as total,
					count,name
				FROM (
					SELECT 
						ca.id, co.fechaMovimiento, ca.count,ca.type,
						(case 	when (co.movimiento='CARGO'AND co.monto>0)  then concat('<font class=\"relacion\" relacion=\"',co.relacion,'\">',co.relacion,'</font><br>') else '' end ) as relacion_cargo,
						(case 	when (co.movimiento='ABONO'AND co.monto>0)  then concat('<font class=\"relacion\" relacion=\"',co.relacion,'\">',co.relacion,'</font><br>') else '' end ) as relacion_abono,
						(case 	when (co.movimiento='CARGO')  then concat(ROUND(co.monto,2),'<br>') else '' end ) as cargo,
						(case 	when (co.movimiento='ABONO')  then concat(ROUND(co.monto,2),'<br>') else '' end ) as abono,        
						ca.name
					FROM contabilidad co JOIN contabilidad_analitica ca ON co.analitica_id=ca.id 
					ORDER BY id desc
				) c
				$where
				GROUP BY id	
			";
			#echo $comando_sql;
			$data = $this->__EXECUTE($comando_sql); 						
			return	$data;
		}				
		
	}
?>

