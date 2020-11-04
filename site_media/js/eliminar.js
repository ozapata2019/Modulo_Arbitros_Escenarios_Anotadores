function pregunta(){ 
    if (confirm('¿Estas seguro de eliminar este registro?')){ 
       document.ForEliminar.submit()
		
    } 
	else{
		return false;
	}
} 
							
							