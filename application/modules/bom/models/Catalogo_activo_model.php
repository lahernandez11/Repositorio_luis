<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalogo_activo_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_equipos()
	{
		$query = $this->db->query("SELECT * FROM vw_bom_equipo WHERE idcat_estado=1 ORDER BY nombre_equipo");
		return $query->result_array();
	}
	
	public function desplegar_marcas()
	{
		$query = $this->db->query("SELECT * FROM vw_bom_marca WHERE idcat_estado=1 ORDER BY nombre_marca");
		return $query->result_array();
	}
	
	public function desplegar_proyectos()
	{
		$query = $this->db->query("SELECT * FROM vw_grl_proyecto WHERE idestado=1 ORDER BY nombre_proyecto");
		return $query->result_array();
	}
	
	public function desplegar_activos()
	{
		$query = $this->db->query("SELECT nombre_equipo,nombre_marca,modelo,serie,no_simex,clave,nombre_plaza,nombre_area,nombre_carril,estado_activo,botones,
idactivo,idequipo,idproyecto,idplaza,idareaafectacion,idcarril,idcat_estado_activo FROM vw_bom_activo");
		return $query->result_array();
	}
	
	public function desplegar_plazas($idproyecto)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_plaza WHERE idestado=1 AND idproyecto=".$idproyecto."");
		return $query->result_array();
	}
	
	public function desplegar_areas()
	{
		$query = $this->db->query("SELECT * FROM vw_bom_areafectacion WHERE idestado=1");
		return $query->result_array();
	}
	
	public function desplegar_carriles($idplaza,$usuario)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_carril WHERE idplaza=".$idplaza." AND idusuario=".$usuario."");
		return $query->result_array();
	}
	
	public function agregar_activo($equipo,$marca,$modelo,$serie,$simex,$observacion,$proyecto,$plaza,$ubicacion,$carril,$usuario)
	{
		$query = $this->db->query("EXEC sp_bom_agregar_activo $equipo,'$marca','$modelo','$serie','$simex','$observacion',$proyecto,$plaza,$ubicacion,$carril,'$usuario'");
		return $query->result_array();
	}
	
	public function buscar_activo($idactivo)
	{
		$query = $this->db->query("SELECT * FROM vw_bom_activo WHERE idactivo=".$idactivo."");
		return $query->result_array();
	}
	
	public function editar_activo($idactivo,$equipo,$marca,$modelo,$serie,$simex,$observacion,$proyecto,$plaza,$ubicacion,$carril)
	{
		$query = $this->db->query("EXEC sp_bom_modificar_activo $idactivo,$equipo,'$marca','$modelo','$serie','$simex','$observacion',$proyecto,$plaza,$ubicacion,$carril");
		return $query->result_array();
	}
	
	public function cambiar_estado_activo($idactivo,$idestado)
	{
		$query = $this->db->query("EXEC sp_bom_cambiar_estado_activo $idactivo,$idestado");
		return $query->result_array();
	}
	
	public function busca_activo($idactivo)
	{
		$query = $this->db->query("SELECT nombre_equipo,nombre_marca,modelo,serie,no_simex,clave,nombre_plaza,nombre_area,nombre_carril,estado_activo,botones FROM vw_bom_activo WHERE idactivo=".$idactivo);
		return $query->result_array();	
	}
}
/*
*end modules/login/models/index_model.php
*/