<?php
	#if(file_exists("../modelo/modelo.php")) require_once("../modelo/modelo.php");
	
	class permiso extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"usergroup_id"	    =>array(
			    "title"             => "Usuario",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"menu_id"	    =>array(
			    "title"             => "Menu",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"s"	    =>array(
			    "title"             => "select",
			    "showTitle"         => "si",
			    "type"              => "input",			    
			    "default"           => "",
			    "value"             => "",			    
			),						
			"c"	    =>array(
			    "title"             => "create",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"w"	    =>array(
			    "title"             => "write",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"d"	    =>array(
			    "title"             => "delete",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),			

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			$this->menu_obj=new menu(array("temporal"=>"AUX_DEVICE"));
			parent::__CONSTRUCT();
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    	    #echo "EJECUTA";
    	    return parent::__SAVE($datas,$option);
    	}    		
		public function groups($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(
				"permiso.*",
			);
			$option["from"]		="permiso";
			
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}		
		public function permisos_html($values=NULL)
    	{
    		$menu_id=NULL;
    		if(!is_null($values))
    			$menu_id	=@$values[0]["menu_id"];
    		
    		$menus=$this->menu_obj->menu($menu_id);  
			$tr="";
    		foreach($menus["data"] as $menu)
    		{   
				$activeselect	="";
				$activecreate	="";
				$activewrite	="";
				$activedelete	="";
    			if(is_array($values))
    			{
					foreach($values as $row)
					{
						if($row["menu_id"]==$menu["id"] AND $row["s"]==1)	$activeselect	="checked";
						if($row["menu_id"]==$menu["id"] AND $row["c"]==1)	$activecreate	="checked";    				
						if($row["menu_id"]==$menu["id"] AND $row["w"]==1)	$activewrite	="checked";    				    				
						if($row["menu_id"]==$menu["id"] AND $row["d"]==1)	$activedelete	="checked";    				
					}	
				}

    			$select		="<input type=\"checkbox\" value=\"1\" name=\"permiso_ids[{$menu["id"]}][s]\" $activeselect>";	
    			$create		="<input type=\"checkbox\" value=\"1\" name=\"permiso_ids[{$menu["id"]}][c]\" $activecreate>";
    			$write		="<input type=\"checkbox\" value=\"1\" name=\"permiso_ids[{$menu["id"]}][w]\" $activewrite>";
    			$delete		="<input type=\"checkbox\" value=\"1\" name=\"permiso_ids[{$menu["id"]}][d]\" $activedelete>";
    		
    			if($menu["type"]=="menu" or $menu["type"]=="submenu")	
    			{    				
					$create="";
					$write="";
					$delete="";    				
    			}	


    			$tr.="
    				<tr>
    					<td>{$menu["name"]}</td>
    					<td>$select</td>
    					<td>$create</td>
    					<td>$write</td>
    					<td>$delete</td>
    				</tr>
    			";
			}    
    			$tr="
    				<tr>
    					<td>MENU</td>
    					<td>S</td>
    					<td>C</td>
    					<td>W</td>
    					<td>D</td>
    				</tr>
    				$tr
    				<tr>
    					<td>MENU</td>
    					<td>S</td>
    					<td>C</td>
    					<td>W</td>
    					<td>D</td>
    				</tr>    				
    			";			
				
			$return="
				<table width=\"300\">
					$tr
				</table>			
			";
			return $return;
		}		
	}
?>
