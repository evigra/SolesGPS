<?php	
	class svg extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $svg_height;
		var $svg_width;
		var $sys_fields		=array(
			"satellite_tracking"	    =>array(
			    "title"             => "RASTREO SATELITAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",			    
			),		
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        public function __CONSTRUCT()
		{
			@$_SESSION["user"]["l18n"]="";
			#@$_SESSION["user"]["l18n"]="es_MX";
			#@$_SESSION["user"]["l18n"]="en";

			parent::__CONSTRUCT();

		}

		public function base($opciones)
		{		
			$t			=$opciones["tam"];
			$ancho		=$opciones["anc"];
			$largo		=$opciones["lar"];
			$altura		=$opciones["alt"];

			$base="";		
			$alto_aux=(($t*1*$largo)+($t*0.5*$ancho))+($t*$altura)+($t*4);		
		
			for($anc=1; $anc<=$ancho; $anc++)		
			{			
		
				for($lar=1; $lar<=$largo; $lar++)		
				{
					$izquierda	=($t*3.5*$lar)-($anc*$t)+($ancho*$t);
					$alto		=-($t*1*$lar)-($t*0.5*$anc) + $alto_aux;
		
					$a			=$izquierda;
					$i			=$alto;
			
						$p1			=$a+($t*2);
						$p2			=$a+($t*3);					
						$p3			=$a+($t*5.5);					
						$p4			=$a+($t*6.5);		
						$p5			=$i+($t*2);
						$p6			=$i+($t*2.5);
						$p7			=$i+($t*3);
						$p8			=$i+($t*3.5);
						$p9			=$i+($t*1);					
						$p10		=$i+($t*1.5);					
						$p11		=$i+($t*2.5);
					
						$p12		=$a+($t*1.8);					
						$p13		=$i+($t*2.3);
						$p14		=$a+($t*4.5);
						$p15		=$i+($t*3.8);
					
					$cara40		=	
								$p1 .",". $p5 . " " .
								$p2 .",". $p6 . " " .
								$p4 .",". $p10 . " " .
								$p3 .",". $p9 . " " 
								;
					$base="<polygon tipo=\"base\" points=\"$cara40\" style=\"fill:grey;stroke:black;stroke-width:0.5\"/>".$base;		


					if($anc==1 and $t>=15)
					{					
						$tam_letra=12;
						$base.="<text class=\"fila\" fila=\"$lar\" x=\"$p14\" y=\"$p15\" fill=\"white\" style=\"font-size: $tam_letra"."px;\" transform=\"rotate(-16 $p12,$p13)\">$lar</text>";
					}
					if($lar==1 and $t>=15)
					{					
						$tam_letra=12;
						$base.="<text class=\"columna\" columna=\"$anc\" x=\"$p12\" y=\"$p7\" fill=\"white\" style=\"font-size: $tam_letra"."px;\" transform=\"rotate(-16 $p12,$p13)\">$anc</text>";
					}
				
				
					#<text x=\"$p1\" y=\"$p5\" fill=\"red\">$anc $lar</text>
				}	
			}

			return $base;
		}				
		public function patio($datos,$opciones)
		{		
			$t			=$opciones["tam"];
			$ancho		=$opciones["anc"];
			$largo		=$opciones["lar"];
			$altura		=$opciones["alt"];

			$base="";
		
			$zndex=1000;
			foreach($datos as $lar => $lar_datos)		
			{			
				foreach($lar_datos as $anc => $anc_datos)		
				{					
					foreach($anc_datos as $alt => $informacion)		
					{							
						$alto_aux=(($t*1*$largo)+($t*0.5*$ancho))+($t*$altura)+($t*4);		

						$izquierda	=($t*3.5*$lar)-($anc*$t)+($ancho*$t);
						$alto		=-($t*1*$lar)-($t*0.5*$anc) + $alto_aux - ($t*$alt);
		
						$a			=$izquierda;
						$i			=$alto;
			
						$p1			=$a+($t*2);
						$p2			=$a+($t*3);					
						$p3			=$a+($t*5.5);					
						$p4			=$a+($t*6.5);		
						$p5			=$i+($t*2);
						$p6			=$i+($t*2.5);
						$p7			=$i+($t*3);
						$p8			=$i+($t*3.5);					
						$p9			=$i+($t*1);					
						$p10		=$i+($t*1.5);					
						$p11		=$i+($t*2.5);
					
						$p12		=$a+($t*1.8);
						$p13		=$i+($t*2.3);

						$cara40		=	
							$p1 .",". $p5 . " " .    
							$p1 .",". $p7 . " " .
							$p2 .",". $p8 . " " .
							$p2 .",". $p6 . " " .
							$p1 .",". $p5 . " " .
				
							$p3 .",". $p9 . " " .    
							$p4 .",". $p10 . " " .
							$p2 .",". $p6 . " " .
							$p2 .",". $p8 . " " .
				
							$p4 .",". $p11 . " " .    
							$p4 .",". $p10 . " " .
							$p2 .",". $p6 . " " 
							;
		
						if(isset($informacion["color"]))	$color=$informacion["color"];
						else								$color="red";
										
						@$con_alto.="<polygon class=\"contenedor\" fila=\"$lar\" columna=\"$anc\" points=\"$cara40\" style=\"fill:$color;stroke:purple;stroke-width:0.5\" opacity=\"0.95\"/>";

						if(isset($informacion["serie"]))	$serie=$informacion["serie"];
						else								$serie="";
					
						if($t>=15)
						{					
							$tam_letra=$t*12/30;
							$con_alto.="<text class=\"contenedor\"  fila=\"$lar\" columna=\"$anc\" x=\"$p2\" y=\"$p8\" fill=\"white\" style=\"font-size: $tam_letra"."px;\" transform=\"rotate(-16 $p12,$p13)\">$serie</text>					
							";
						}
					
					}
					@$con_largo=$con_alto.$con_largo;
				}	
				@$con_ancho=$con_largo.$con_ancho;	
			}
			return $con_ancho;
		}				


	}
?>
