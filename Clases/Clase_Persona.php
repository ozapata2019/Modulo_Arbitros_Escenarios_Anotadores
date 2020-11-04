
<?php


abstract class Persona 

{
	protected $Imagen;
	protected $Identificacion;
	protected $nombre;
	protected $apellido;
	protected $email;
	protected $telefono;
	protected $direccion;
	
	
	public function getImagen ()
	{
		return $this->Imagen;
	}
	
	public function setImagen ($Imagen)
	{
		$this->Imagen = $Imagen;
	}
	
	
	public function getIdentificacion()
	{
		return $this->Identificacion;
	}
	
	public function SetIdentificacion ($identificacion)
	{
		 $this->Identificacion = $identificacion;
	}	
	
	public function getNombre ()
	{
		return $this->nombre;
	}
	
	public function setNombre($nombre)
    {
         $this->nombre = $nombre;
    }	
	
	public function getApellido ()
	{
		return $this->apellido;
	}	
	
	public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }	
	
	public function getEmail ()
	{
		return $this->email;
	}
	
	public function setEmail($email)
    {
        $this->email = $email;
    }	
	
	
	public function getTelefono ()
	{
		return $this->telefono;
	}
	
	public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }	
	
	

	public function getDireccion ()
	{
		return $this->direccion;
	}

	public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }	
}

?>