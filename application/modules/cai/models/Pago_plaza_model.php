<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pago_plaza_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
    public function desplega_pagos($idplaza)
    {
		$query = $this->db->query("EXEC sp_cai_mostrar_tipo_pago_plaza '$idplaza'");
        return $query->result();
    }
	
	public function desplega_pagos_plaza($idplaza)
	{
		$query = $this->db->query("SELECT tv.idtipo_pago,orden,tipo_pago
							FROM cai_tipo_pago_plaza vp
							LEFT JOIN cai_tipo_pago tv ON vp.idtipo_pago = tv.idtipo_pago
							WHERE idplaza=".$idplaza."
							ORDER BY orden");
				
  		return $query->result();
	}
	
	public function agrega($idpago,$idplaza,$registra)
	{
		$query = $this->db->query("EXEC sp_cai_agregar_tipopago_plaza '$idpago','$idplaza','$registra'");
		return $query->result_array();
	}
	
	public function elimina($idpago,$idplaza)
	{
		$query = $this->db->query("EXEC sp_cai_elimina_tipopago_plaza '$idpago','$idplaza'");
		return $query->result_array();
	}
	
	public function ordena_pagos_plaza($idplaza,$Pagos,$Posiciones,$registra)
	{
		$query = $this->db->query("EXEC sp_cai_ordena_tipo_pago_plaza '$Pagos','$idplaza','$registra','$Posiciones'");
		return $query->result_array();
	}

	
    
	
}
/*
*end modules/login/models/index_model.php
*/