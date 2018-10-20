<?php
	#if(file_exists("../menu/modelo.php")) require_once("../menu/modelo.php");
	
	class groups extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			),
			"name"	    =>array(
			    "title"             => "Perfil",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"nivel"	    =>array(
			    "title"             => "Nivel",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "source"            => array(
			    	"0"              => "Dios",
			    	"10"              => "Super Administrador",
			    	"20"              => "Administrador",
			    	"30"              => "Usuario",
			    	"40"              => "Usuario2",
			    	"50"              => "Usuario3",
			    	"60"              => "Usuario4",
			    	"70"              => "Usuario5",
			    	"80"              => "Usuario6",
			    	"90"              => "Usuario7",
			    	"100"             => "No activo",
			    ),
			),

			"menu_id"	    =>array(
			    "title"             => "Menu",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "procedure"         => "autocomplete",
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "menu",
			    "class_path"        => "modulos/menu/modelo.php",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "menu_id",			# Origen
			    "class_field_m"    	=> "id",				# Destino
			    "value"             => "",			    
			),
			"permiso_ids"	    =>array(
			    "title"             => "Menu",
			    "type"              => "input",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "permiso",
			    "class_path"        => "modulos/permiso/modelo.php",
			    "class_field_o"    	=> "id",					# Origen
			    "class_field_m"    	=> "usergroup_id",			# Destino	    
			),			
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#$this->menu_obj=new menu();
			parent::__CONSTRUCT();

		}
		public function __VIEW_REPORT($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(
				"g.*",
				"m.name"=>"menu_id",
			);
			$option["from"]		="menu m join groups g on m.id=g.menu_id";
			$option["order"]	="m.id asc, nivel asc";
			
			$return =parent::__VIEW_REPORT($option);    				
			return $return;
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    	    $group_id=parent::__SAVE($datas,$option);
    	    
    	    #echo "<br>USUARIO=$user_id<br>";

    	    ## GUARDAR PERFILES DE USUARIO
    	    $usergroup_datas=array();
    	    if(isset($datas["permiso_ids"]))
    	    {
    	    	$this->__PRINT_R($datas);
			    foreach($datas["permiso_ids"] as $index => $data)
			    {
					$usergroup_option=array();
					## BUSCA PERFIL PREVIO 
					## SI EXISTE, LO MODIFICA
					## SI NO, LO CREA
					#$usergroup_option["echo"]="PERFILES";
					$usergroup_option["where"]=array(
						"usergroup_id	=$group_id",
						"menu_id		={$index}",
					);    	    		    	    		
					$usergroup_data						=$this->obj_permiso_ids->__BROWSE($usergroup_option);
					
					$this->__PRINT_R($usergroup_data);

					if($usergroup_data["total"]>0)		$this->obj_permiso_ids->sys_primary_id=$usergroup_data["data"][0]["id"];
					else								$this->obj_permiso_ids->sys_primary_id=NULL;

					$usergroup_save=array(
						"usergroup_id"	=>"$group_id",
						"menu_id"		=>"{$index}"					
					);
	
					if(isset($data["s"]))			$usergroup_save["s"]="{$data["s"]}";
					if(isset($data["c"]))			$usergroup_save["c"]="{$data["c"]}";
					if(isset($data["w"]))			$usergroup_save["w"	]="{$data["w"]}";
					if(isset($data["d"]))			$usergroup_save["d"]="{$data["d"]}";
					
					#$this->__PRINT_R($usergroup_save);
					$this->obj_permiso_ids->__SAVE($usergroup_save);

			    }	
			}    
		}				
	}
?>

