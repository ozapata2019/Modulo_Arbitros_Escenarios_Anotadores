
<?php


class Escenario 

{
	
	protected $Id;
	protected $nombre;
	protected $direccion;
	protected $aforo;
	protected $disponible;
	protected $techomovible;
	protected $observaciones;
	
	

	
	
	public function getId()
	{
		return $this->Id;
	}
	
	public function SetId($id)
	{
		 $this->Id = $id;
	}	
	
	public function getNombre ()
	{
		return $this->nombre;
	
	}
	public function setNombre($nombre)
    {
         $this->nombre = $nombre;
    }


	public function getDireccion()
	{
		return $this->direccion;
	
	}
	public function setDireccion($direccion)
    {
         $this->direccion = $direccion;
    }


	
	
	
	public function getAforo ()
	{
		return $this->aforo;
	}	
	
	public function setAforo($aforo)
    {
         $this->aforo = $aforo;
    }	
	
	
	
	
	
	
	public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }	
	
	public function getDisponible ()
	{
		return $this->disponible;
	}
	
		
	public function getTechomovible ()
	{
		return $this->techomovible;
	}
	
	public function setTechomovible($techomovible)
    {
        $this->techomovible = $techomovible;
    }	
	
	
	public function getObservaciones ()
	{
		return $this->observaciones;
	}
	
	public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }	
	
	

}

?>