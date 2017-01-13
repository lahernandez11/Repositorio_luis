<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalogo_equipo_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_equipos()
	{
		$query = $this->db->query("SELECT idequipo,nombre_equipo,clave_equipo,idcat_estado,cat_estado,botones FROM vw_bom_equipo ORDER BY nombre_equipo");
		return $query->result_array();
	}
	
	public function agregar_equipo($equipo,$clave,$usuario)
	{
		$query = $this->db->query("EXEC sp_bom_agregar_equipo '$equipo','$clave','$usuario'");
		return $query->result_array();
	}
	
	public function buscar_equipo($idequipo)
	{
		$query = $this->db->query("SELECT * FROM vw_bom_equipo WHERE idequipo=".$idequipo."");
		return $query->result_array();
	}
	
	public function editar_equipo($idequipo,$equipo,$clave)
	{
		$query = $this->db->query("EXEC sp_bom_modificar_equipo $idequipo,'$equipo','$clave'");
		return $query->result_array();
	}
	
	public function cambiar_estado_equipo($idequipo,$idestado)
	{
		$query = $this->db->query("EXEC sp_bom_cambiar_estado_equipo $idequipo,$idestado");
		return $query->result_array();
	}
	
	public function busca_equipo($idequipo)
	{
		$query = $this->db->query("SELECT nombre_equipo,clave_equipo,cat_estado,botones FROM vw_bom_equipo WHERE idequipo=".$idequipo);
		return $query->result_array();
	}
}
/*
*end modules/login/models/index_model.php
*/