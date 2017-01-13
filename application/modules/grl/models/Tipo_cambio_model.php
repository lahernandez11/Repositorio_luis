<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipo_cambio_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega_monedas()
    {
		$query = $this->db->query("SELECT * FROM vw_grl_moneda WHERE idestado=1 AND idmoneda!=1");
        return $query->result();
    }
	
	
	public function agrega($moneda,$fecha,$valor,$registra)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_tipo_cambio '$moneda','$fecha','$valor','$registra'");
		return $query->result_array();
	}
	
	/*public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idtipo_pago', $id);
		$this->db->update('[opi].[dbo].[cai_tipo_pago]', $data);
		return $this->db->affected_rows();
	}
	
	public function cambia($id,$pago,$clave)
	{
		$query = $this->db->query("EXEC sp_cai_modifica_tipo_pago '$id','$pago','$clave'");
		return $query->result_array();
	}*/
	
    
	
}
/*
*end modules/login/models/index_model.php
*/