<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administrar_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_cuerpos()
	{
		$query = $this->db->query("SELECT * FROM vw_bic_cuerpo WHERE estado=1");
        return $query->result();
	}
	
	public function desplega_carriles()
	{
		$query = $this->db->query("SELECT * FROM vw_bic_carril WHERE estado=1");
        return $query->result();
	}
	
	public function desplega_causas()
	{
		$query = $this->db->query("SELECT * FROM vw_bic_causa WHERE estado=1 ORDER BY causa");
        return $query->result();
	}
	
	public function consultar_incidencia($idincidencia)
	{
		$query = $this->db->query("SELECT * FROM vw_bic_incidencia WHERE idincidencia=".$idincidencia."");
        return $query->result_array();
	}
	
	public function consultar_incidencia_carril($idincidencia)
	{
		$query = $this->db->query("SELECT idcarril,carril FROM vw_bic_incidencia_carril WHERE idincidencia=".$idincidencia."");
        return $query->result_array();
	}
	
	public function desplega_incidencias($iduser)
	{
		$query = $this->db->query("SELECT * FROM vw_bic_incidencia WHERE estado=1");
        return $query->result_array();
	}
	
	public function desplega_tipos()
	{
		$query = $this->db->query("SELECT * FROM vw_bic_incidencia_tipo WHERE estado=1");
        return $query->result();
	}
	
	public function desplega_hitos($idproyecto)
	{
		$query = $this->db->query("SELECT * FROM vw_bic_hito WHERE idproyecto=".$idproyecto." ORDER BY hito_kilometrico");
        return $query->result_array();
	}
	
	public function desplega_metros($idproyecto)
	{
		$query = $this->db->query("SELECT * FROM vw_bic_metro WHERE idproyecto=".$idproyecto." ORDER BY metros_hito_kilometrico");
        return $query->result_array();
	}
	
	public function agregar_incidencia($idproyecto,$idcuerpo,$km_min,$km_max,$ms_min,$ms_max,$idtipo_incidencia,$idcausa,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_fin,$notas,$carriles,$user)
	{
		$query = $this->db->query("EXEC sp_bic_agregar_incidencia $idproyecto,$idcuerpo,$km_min,$km_max,$ms_min,$ms_max,$idtipo_incidencia,$idcausa,'$fecha_inicio','$fecha_fin','$hora_inicio','$hora_fin','$notas','$carriles',$user");
        return $query->result_array();
	}
	
	public function eliminar_incidencia($idincidencia)
	{
		$query = $this->db->query("EXEC sp_bic_eliminar_incidencia $idincidencia");
        return $query->result_array();
	}
	
	public function editar_incidencia($idproyecto,$idcuerpo,$km_min,$km_max,$ms_min,$ms_max,$idtipo_incidencia,$idcausa,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_fin,$notas,$carriles,$idincidencia)
	{
		$query = $this->db->query("EXEC sp_bic_modificar_incidencia $idproyecto,$idcuerpo,$km_min,$km_max,$ms_min,$ms_max,$idtipo_incidencia,$idcausa,'$fecha_inicio','$fecha_fin','$hora_inicio','$hora_fin','$notas','$carriles',$idincidencia");
        return $query->result_array();
	}
	
	
}