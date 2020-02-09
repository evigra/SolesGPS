<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	#require_once("modulos/files/modelo.php");
	class conf_odoo extends configuracion
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="configuracion";
		##############################################################################	
		##  Metodos	
		##############################################################################		
		public function __CONSTRUCT()
		{
		
			parent::__CONSTRUCT();
			
			#$this->__PRINT_R($SESSION);
		}
		public function __SAVE($datas=NULL,$option=NULL)
    	{
   	    	$datas["subtipo"]		="odoo";
   	    	$datas["company_id"]	="{$_SESSION["company"]["id"]}";
    		return parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="tipo='odoo'";
			#$option["where"][]      ="company_id='{$_SESSION["company"]["id"]}'";
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}
		public function __ODOO($option=NULL)
    	{    		
    	    $conf   =$this->__BROWSE();    	    
    	    $eval   ="";    
    	    foreach($conf["data"] as $row)
    	    {
    	        $eval.="$"."{$row["subtipo"]}=\"{$row["valor"]}\";";    	        
    	    }
    	    eval($eval);
    	    
    	    /*
            $url = <insert server URL>;
            $db = <insert database name>;
            $username = "admin";
            $password = <insert password for your admin user (default: admin)>;
            */
            #$server="www.vauxoo.com";
            #$server.=":$port";
            require_once('nucleo/ripcord/ripcord.php');

            $common = ripcord::client("$server/xmlrpc/2/common");            
            $common->version();
            
            
            #$uid = $common->authenticate($database, $user, $password, array());
            #$uid = $common->authenticate($database, $user, $password);
      
            #$this->__PRINT_R($uid);    
      
            #$models = ripcord::client("$server/xmlrpc/2/object");
  
            #$models->execute_kw($database, $uid, $password, 'res.partner', 'check_access_rights', array('read'), array('raise_exception' => false));

            
		}
	}
?>
