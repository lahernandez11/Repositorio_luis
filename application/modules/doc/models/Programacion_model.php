<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Programacion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_periodos()
	{
		$this->db->select("idcat_periodo,cat_periodo");
		$this->db->from("vw_doc_cat_periodo");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function desplegar_contratos_activos($iduser)
	{
		$query = $this->db->query("select * from vw_doc_contrato_proyecto
where idcat_estado=1 AND idproyecto in (select idproyecto from vw_grl_usuario_plaza WHERE idusuario=".$iduser." group by idproyecto) ORDER BY clave,numero_contrato"); 	
        return $query->result();
	}
	
	public function desplegar_contratos($iduser)
	{
		$query = $this->db->query("select * from vw_doc_contrato_proyecto
where idcat_estado=1 AND idproyecto in (select idproyecto from vw_grl_usuario_plaza WHERE idusuario=".$iduser." group by idproyecto) ORDER BY clave,numero_contrato"); 	
        return $query->result_array();
	}
	
	public function desplegar_programaciones($idactividad)
	{
		$this->db->select("idprogramacion,idactividad,fecha,modificar,eliminar");
		$this->db->from("vw_doc_programacion_actividad");
		$this->db->where("idactividad",$idactividad);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function agregar_programacion($idactividad,$repeticion,$periodo,$fecha,$usuario)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_programacion_actividad $idactividad,$repeticion,$periodo,'$fecha','$usuario'");
		return $query->result_array();
	}
	
	public function editar_programacion($idprogramacion,$fecha)
	{
		$query = $this->db->query("EXEC sp_doc_modificar_programacion_actividad $idprogramacion,'$fecha'");
		return $query->result_array();
	}
	
	public function cancelar_programacion($idprogramacion)
	{
		$query = $this->db->query("EXEC sp_doc_eliminar_programacion_actividad $idprogramacion");
		return $query->result_array();
	}
	
	public function desplegar_area_notificacion($idactividad)
	{
		$this->db->select("idarea_involucrada,nombre_area_involucrada");
		$this->db->from("vw_doc_actividad_area_involucrada_nivel_usuario");
		$this->db->where("idactividad",$idactividad);
		$this->db->group_by("idarea_involucrada,nombre_area_involucrada"); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function desplegar_usuario_notificacion($idarea)
	{
		$this->db->select("usuario,correo_usuario,idnivel");
		$this->db->from("vw_doc_actividad_area_involucrada_nivel_usuario");
		$this->db->where("idarea_involucrada",$idarea);
		$this->db->where("idestado",1);
		$this->db->group_by("usuario,correo_usuario,idnivel"); 
		$this->db->order_by("idnivel","asc"); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function correo_notificacion_programacion($areas)
	{
		$query = $this->db->query("SELECT correo_usuario FROM vw_doc_actividad_area_involucrada_nivel_usuario WHERE idarea_involucrada IN (".$areas.") GROUP BY correo_usuario");		
		return $query->result_array();
	}
	
	public function desplegar_programacion($idactividad)
	{
		$query = $this->db->query("SELECT * FROM vw_doc_programacion WHERE idactividad=".$idactividad." AND idestado_actividad=2 AND timestamp=CONVERT(char(10), GetDate(),126)");			
        return $query->result_array();
	}
	
	public function correo_notificacion_programacion_editar($idactividad)
	{
		$query = $this->db->query("SELECT correo_usuario FROM vw_doc_actividad_area_involucrada_nivel_usuario WHERE idactividad IN (".$idactividad.") GROUP BY correo_usuario");		
		return $query->result_array();
	}
	
	public function desplegar_programacion_editar($idprogramacion)
	{
		$query = $this->db->query("SELECT * FROM vw_doc_programacion WHERE idprogramacion=".$idprogramacion);			
        return $query->result_array();
	}
	
}