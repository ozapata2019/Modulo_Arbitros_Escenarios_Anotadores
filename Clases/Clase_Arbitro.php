
<?php


require_once('Clase_Persona.php');

 class arbitro extends Persona
{
	private $tipoArbitro;	
	private $disponible;	
	
	
	public function getTipoArbitro ()
	{
		return $this->tipoArbitro;
	}
	
	public function setTipoArbitro ($tipoArbitro)
	{
		$this->tipoArbitro = $tipoArbitro;
	}
	
	public function getDisponible ()
	{
		return $this->disponible;
	}
	
	public function setDisponible ($disponible)
	{
		$this->disponible = $disponible;
	}
}

?>