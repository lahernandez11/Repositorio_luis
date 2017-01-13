<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Plaza_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega()
    {
		$query = $this->db->query("SELECT * FROM vw_grl_plaza ORDER BY nombre_plaza ASC, nombre_proyecto ASC");
        return $query->result();
    }
	
	
	public function agrega($proyecto,$plaza,$clave,$direccion)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_plaza '$plaza','$clave','$direccion','$proyecto'");
		return $query->result();
		/*$data = array(
               'nombre_plaza' => $plaza,
			   'clave' => $clave,
			   'direccion' => $direccion,
			   'idproyecto' => $proyecto
            );

		$this->db->insert('[opi].[dbo].[grl_plaza]', $data); 
		return $this->db->affected_rows();*/
	}
	
	public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idplaza', $id);
		$this->db->update('grl_plaza', $data);
		return $this->db->affected_rows();
	}
	
	public function cambia($id,$proyecto,$plaza,$clave,$direccion)
	{
		$data = array(
               'nombre_plaza' => $plaza,
			   'clave' => $clave,
			   'direccion' => $direccion,
			   'idproyecto' => $proyecto
            );

		$this->db->where('idplaza', $id);
		$this->db->update('grl_plaza', $data);
		return $this->db->affected_rows();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/