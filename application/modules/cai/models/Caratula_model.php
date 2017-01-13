<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Caratula_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    } 
	
    function carga_tipos_pago($plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_cai_tipopago_plaza
									WHERE idplaza=".$plaza."
									ORDER BY orden");
		return $query->result();
	}
	
	function carga_vehiculos($plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_tipo_vehiculo_plaza
									WHERE idplaza=".$plaza."
									ORDER BY orden");
		return $query->result();
	}
	
	function carga_tarifas($plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_cai_tarifa WHERE idplaza=".$plaza."AND idestado=1 ORDER BY idmoneda ASC");
		return $query->result();
	}
	
	function carga_tarifa($plaza,$vehiculo)
	{
		$query = $this->db->query("SELECT * FROM vw_cai_tarifa_detalle WHERE idplaza=".$plaza." AND idtipo_vehiculo=".$vehiculo." AND idestado=1");
		return $query->result();
	}
	
}
/*
*end modules/login/models/index_model.php
*/