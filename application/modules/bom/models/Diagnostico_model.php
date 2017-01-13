<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Diagnostico_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_reporte($id)
	{
		$query=$this->db->query("EXEC sp_bom_info_diagnostico '$id'");
		return $query->result_array();
	}
	
	/*public function registra_diagnostico($idreporte,$diagnostico,$registra)
	{
		$query = $this->db->query("EXEC sp_bom_registro_diagnostico '$idreporte','$diagnostico','$registra'");
		return $query->result_array();
	}*/
	
	public function registra_diagnostico($idreporte,$diagnostico,$registra,
																$reparar,
																$reemplazar,
																$Equipos,
																$Marcas,
																$Modelos,
																//$Capacidades,
																//$Series,
																$Motivos,
																$Destinos,
																$Fechas,
																$VEquipos,
																$VMarcas,
																$VModelos,
																//$VCapacidades,
																//$VSeries,
																$VMotivos,
																$VUbicaciones)
	{
		$query = $this->db->query("EXEC sp_bom_registro_diagnostico '$idreporte','$diagnostico','$registra','$reparar','$reemplazar','$Equipos','$Marcas','$Modelos','$Motivos','$Destinos','$Fechas','$VEquipos','$VMarcas','$VModelos','$VMotivos','$VUbicaciones'");
		return $query->result_array();
	}
}