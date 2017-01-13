<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vehiculo_plaza_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
    public function desplega_vehiculos($idplaza)
    {
		$query = $this->db->query("EXEC sp_grl_mostrar_vehiculos_plaza '$idplaza'");
        return $query->result();
    }
	
	public function desplega_vehiculos_plaza($idplaza)
	{
		$query = $this->db->query("SELECT tv.idtipo_vehiculo,orden,tipo_vehiculo
							  FROM grl_tipo_vehiculo_plaza vp
							  LEFT JOIN grl_tipo_vehiculo tv ON vp.idtipo_vehiculo = tv.idtipo_vehiculo
							  WHERE idplaza=".$idplaza."
							  ORDER BY orden");
				
  		return $query->result();
	}
	
	public function agrega($idvehiculo,$idplaza,$registra)
	{
		$query = $this->db->query("EXEC sp_cai_agregar_vehiculos_plaza '$idvehiculo','$idplaza','$registra'");
		return $query->result_array();
	}
	
	public function elimina($idvehiculo,$idplaza)
	{
		$query = $this->db->query("EXEC sp_cai_elimina_vehiculo_plaza '$idvehiculo','$idplaza'");
		return $query->result_array();
	}
	
	public function ordena_vehiculos_plaza($idplaza,$Vehiculos,$Posiciones,$registra)
	{
		$query = $this->db->query("EXEC sp_grl_ordena_vehiculos_plaza '$idplaza','$Vehiculos','$Posiciones','$registra'");
		return $query->result_array();
	}

	
    
	
}
/*
*end modules/login/models/index_model.php
*/