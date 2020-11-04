<?php
	

	require_once('../Clases/Clase_Persona.php');
	require_once('../Clases/Clase_Escenario.php');
	require_once('../Core/IConectarBD.php');
	
	class OrganizadorTorneo implements IConectarBD {
############################### PROPIEDADES Y METODOS ##################
	
	
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '123';
	protected $db_name = '';
	protected $query;
	public $rows = array();
	private $conn;
	public $mensaje = '';	
	

#####################CONEXIÓN BASE DE DATOS####################################################
	
		
	protected function open_connection() {		
		$this->conn = new mysqli(self::$db_host, self::$db_user,self::$db_pass, $this->db_name);			
		if (!$this->conn) {
					throw new Excepcion('No se pudo Conectar a la BD: ' . mysql_error());
		}	
	}
	protected function nombre_bd($nombre_bd){
		$this->db_name = $nombre_bd;
	}	
	# Desconectar la base de datos
	protected function close_connection() {
		$this->conn->close();
	}
	# Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
		protected function execute_single_query() {
		if($_POST) {
			$this->open_connection();
			$this->conn->query($this->query);
			
		} else {
			$this->mensaje = 'Metodo no permitido';
		}
	}
	
	
	# Traer resultados de una consulta en un Array
		protected function get_results_from_query() {
				
				$this->open_connection();
				
				if (!$this->conn) {
					throw new Excepcion('No se pudo Conectar a la BD: ' . mysql_error());
				}
				else
				{			
					$result = $this->conn->query($this->query);
				
						if (!$result) {
							
							
							throw new Excepcion('No se pudo ejecutar la consulta a la BD: ' . mysql_error());
						}
						else
						{
							return $result;
						}
				}
				$result->close();				
				$this->close_connection();		
			
		}	
		
##########################################################################################################################################	
			
		
		# Traer datos de un escenario
		function get($ESCENARIO_data = array()) {			
			
			if(array_key_exists('id', $ESCENARIO_data)) {	
			
				$id = $ESCENARIO_data['id'];											
										
										$this->query = "
															SELECT *
															FROM escenarios 
															WHERE Id ='$id' 											
														";
										
									try
									{
										$result = $this->get_results_from_query();					
									} 	catch(Excepcion $e){
									
									}
									
			
			while ($this->rows[] = $result->fetch_assoc());		
			array_pop($this->rows);			
			
			
					$cancha = new escenario();
					if(count($this->rows) > 0) {				
			
						
						
						
						
						foreach($this->rows as $propiedad=>$valor){									
																	
									$cancha->setId($valor['Id']);								
									$cancha->setNombre($valor['Nombre']);								
									$cancha->setDireccion($valor['direccion']);									
									$cancha->setAforo($valor['Aforo']);								
									$cancha->setDisponible($valor['Disponible']);																
									$cancha->setTechomovible($valor['Techo_movible']);
									$cancha->setObservaciones($valor['Observaciones']);								
									
						} 	
									return $cancha;	
					
					} else 
							$this->mensaje = 'Escenario no encontrado';
							return $cancha;
								
			}
			
		}	
			
	
	# Crear un nuevo escenario
	 function set($ESCENARIO_data=array()) {		
										
											
												
							
							$cancha = new escenario();
							
							$cancha->setNombre($ESCENARIO_data['nombre']);
							$nombre =$cancha->getNombre();								
							
							$cancha->setDireccion($ESCENARIO_data['direccion']);
							$direccion = $cancha->getDireccion();
							
							
							
							$cancha->setAforo($ESCENARIO_data['aforo']);
							$aforo =$cancha->getAforo();							
											
						
							
							$cancha->setTechomovible($ESCENARIO_data['techomovible']);		
							$techomovible =$cancha->getTechomovible();							
									
							$cancha->setObservaciones($ESCENARIO_data['observaciones']);		
							$observaciones =$cancha->getObservaciones();		
							
							
							$disponible = 'Si';						
						
						$this->query = "
										INSERT INTO escenarios
										(Nombre,direccion, Aforo,Disponible,Techo_movible,Observaciones)
										VALUES										
										('$nombre', '$direccion', '$aforo','disponible','$techomovible','$observaciones')
										";						
						$this->execute_single_query();						
						$this->mensaje = 'Escenario agregado exitosamente';		  
					   
					
	}	
	
	# Modificar un escenario
	 function edit($ESCENARIO_data=array()) {			
						
			if(array_key_exists('id', $ESCENARIO_data)) {	
			
				$cancha = $this->get($ESCENARIO_data);
				
				
				//if (!empty($cancha)) {	
					
					if($ESCENARIO_data['id'] == $cancha->getid()) {						
						
						
							$cancha->setid($ESCENARIO_data['id']);
							$id = $cancha->getid();							
							
							$cancha->setNombre($ESCENARIO_data['nombre']);
							$nombre =$cancha->getNombre();								
												
							
							
							$cancha->setAforo($ESCENARIO_data['aforo']);
							$aforo =$cancha->getAforo();							
											
						
							
							$cancha->setTechomovible($ESCENARIO_data['techomovible']);		
							$techomovible =$cancha->getTechomovible();							
									
							$cancha->setObservaciones($ESCENARIO_data['observaciones']);		
							$observaciones =$cancha->getObservaciones();	
							
							
							
							
							$cancha->setDisponible($ESCENARIO_data['disponible']);
							$disponibilidad =$cancha->getDisponible();			
								
						
						$this->query = "
							UPDATE escenarios
							SET							
								Nombre='$nombre',									
								Aforo='$aforo',
								Disponible = '$disponibilidad',
								Techo_movible= '$techomovible',							
								Observaciones= '$observaciones'
								
															
							WHERE Id = '$id'
						";		
		  
						$this->execute_single_query();			
						$this->mensaje = 'escenario modificado exitosamente';
					
			
		
						
					}else
						$this->mensaje = 'El escenario no aparece registrado';
				//}
				
			}else
				$this->mensaje = 'Error al tratar de agregar escenario ';
	}

		# Eliminar un escenario
		 function delete($ESCENARIO_data = array()) {			
			
			
			
			
			if(array_key_exists('id', $ESCENARIO_data)) {		
				
				
				
				
				$cancha = $this->get($ESCENARIO_data);
				
				
				//$cancha = new escenario();
				if($ESCENARIO_data['id'] == $cancha->getid()) {				
					
					
					$cancha->setid($ESCENARIO_data['id']);															
					$id = $cancha->getid();		
								
				
							$this->query = "
								DELETE FROM escenarios
								WHERE Id = '$id'
								";
								$Respuesta=$this->execute_single_query();								
								$this->mensaje = 'escenario eliminado exitosamente';								
				}else
					$this->mensaje = 'El escenario no se encuetra registrado';
				
			}else
				$this->mensaje = 'Error al tratar de eliminar el escenario ';
				
		}	
		# Método constructor
			function __construct() {
				$this->db_name = 'baloncesto';
		}
		
}
?>