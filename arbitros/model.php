<?php
	

	require_once('../Clases/Clase_Persona.php');
	require_once('../Clases/Clase_Arbitro.php');
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
			
		
		# Traer datos de un arbitro
		function get($ARBITRO_data = array()) {			
			
			if(array_key_exists('identificacion', $ARBITRO_data)) {	
			
				$id = $ARBITRO_data['identificacion'];											
										
										$this->query = "
															SELECT *
															FROM arbitros 
															WHERE Identificacion ='$id' 											
														";
										
									try
									{
										$result = $this->get_results_from_query();					
									} 	catch(Excepcion $e){
									
									}
									
			
			while ($this->rows[] = $result->fetch_assoc());		
			array_pop($this->rows);			
			
			
					$juez = new arbitro();
					if(count($this->rows) > 0) {				
			
						
						
						
						
						foreach($this->rows as $propiedad=>$valor){									
																	
									$juez->setIdentificacion($valor['Identificacion']);								
									$juez->setNombre($valor['Nombre']);								
									$juez->setApellido($valor['Apellido']);									
									$juez->setEmail($valor['Email']);								
									$juez->setTelefono ($valor['Telefono']);								
									$juez->setTipoArbitro($valor['TipoArbitro']);
									$juez->setDireccion($valor['Direccion']);								
									$juez->setDisponible($valor['Disponible']);										
									
						} 	
									return $juez;	
					
					} else 
							$this->mensaje = 'arbitro no encontrado';
							return $juez;
								
			}
			
		}	
			
	
	# Crear un nuevo arbitro
	 function set($ARBITRO_data=array()) {
		if(array_key_exists('identificacion', $ARBITRO_data)) {			
							
				
				$juez = $this->get($ARBITRO_data);
						
					if (!empty($juez)) {	
						
						if($ARBITRO_data['identificacion'] != $juez->getIdentificacion()) {
					
												
											
							
							
							$juez->setIdentificacion($ARBITRO_data['identificacion']);
							$id = $juez->getIdentificacion();							
							$juez->setNombre($ARBITRO_data['nombre']);
							$nombre =$juez->getNombre();								
							$juez->setApellido($ARBITRO_data['apellido']);
							$apellido =$juez->getApellido();									
							$juez->setEmail($ARBITRO_data['email']);		
							$email =$juez->getEmail();
							
							
							$juez->setTelefono($ARBITRO_data['telefono']);		
							$telefono =$juez->getTelefono();
							
							$juez->setDireccion($ARBITRO_data['direccion']);		
							$direccion =$juez->getDireccion();						
							
							$juez->setTipoArbitro($ARBITRO_data['tipo']);		
							$tipo =$juez->getTipoArbitro();							
									
							$Disponibilidad = 'Si';					
							
							
					
						$this->query = "
										INSERT INTO arbitros
										(Identificacion, Nombre, Apellido, Email,TipoArbitro,Direccion,Telefono,Disponible)
										VALUES										
										('$id','$nombre', '$apellido', '$email','$tipo','$direccion','$telefono','$Disponibilidad')
										";						
						$this->execute_single_query();						
						$this->mensaje = 'arbitro agregado exitosamente';
						
						} else 
						$this->mensaje = 'El arbitro ya existe';
				  }
					   
		} else 
				$this->mensaje = 'Error al Agregar arbitro';				
	}	
	
	# Modificar un arbitro
	 function edit($ARBITRO_data=array()) {			
						
			if(array_key_exists('identificacion', $ARBITRO_data)) {	
			
				$juez = $this->get($ARBITRO_data);
				
				
				//if (!empty($juez)) {	
					
					if($ARBITRO_data['identificacion'] == $juez->getIdentificacion()) {						
						
						
							$juez->setIdentificacion($ARBITRO_data['identificacion']);																
							$id = $juez->getIdentificacion();
							
							$juez->setNombre($ARBITRO_data['nombre']);
							$nombre =$juez->getNombre();
									
							$juez->setApellido($ARBITRO_data['apellido']);
							$apellido =$juez->getApellido();
									
							$juez->setEmail($ARBITRO_data['email']);		
							$email =$juez->getEmail();						
							
							$juez->setTelefono($ARBITRO_data['telefono']);		
							$telefono =$juez->getTelefono();
							
							$juez->setDireccion($ARBITRO_data['direccion']);		
							$direccion =$juez->getDireccion();					
							
							$juez->setTipoArbitro($ARBITRO_data['tipo']);		
							$tipo =$juez->getTipoArbitro();							
							
							$juez->setDisponible($ARBITRO_data['disponible']);
							$disponibilidad =$juez->getDisponible();			
								
						
						$this->query = "
							UPDATE arbitros
							SET							
								Nombre='$nombre',
								Apellido='$apellido',			
								Email='$email',
								Telefono= '$telefono',
								Direccion= '$direccion',
								TipoArbitro= '$tipo',
								Disponible = '$disponibilidad'
															
							WHERE Identificacion = '$id'
						";		
		  
						$this->execute_single_query();			
						$this->mensaje = 'arbitro modificado exitosamente';
					
			
		
						
					}else
						$this->mensaje = 'El arbitro no aparece registrado';
				//}
				
			}else
				$this->mensaje = 'Error al tratar de agregar arbitro ';
	}

		# Eliminar un arbitro
		 function delete($ARBITRO_data = array()) {			
			
			
			
			
			if(array_key_exists('identificacion', $ARBITRO_data)) {		
				
				
				
				
				$juez = $this->get($ARBITRO_data);
				
				
				//$juez = new arbitro();
				if($ARBITRO_data['identificacion'] == $juez->getIdentificacion()) {				
					
					
					$juez->setIdentificacion($ARBITRO_data['identificacion']);															
					$id = $juez->getIdentificacion();		
								
				
							$this->query = "
								DELETE FROM arbitros
								WHERE Identificacion = '$id'
								";
								$Respuesta=$this->execute_single_query();								
								$this->mensaje = 'arbitro eliminado exitosamente';								
				}else
					$this->mensaje = 'El arbitro no se encuetra registrado';
				
			}else
				$this->mensaje = 'Error al tratar de eliminar el arbitro ';
				
		}	
		# Método constructor
			function __construct() {
				$this->db_name = 'baloncesto';
		}
		
}
?>