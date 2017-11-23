<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class acredores_pasivo extends contabilidad
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################

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
			$option["where"]="
				WHERE c.type='PASIVO ACREDOR'			
			";
			return	parent::reporte_kanban($option);
		}				
		
	}
?>

