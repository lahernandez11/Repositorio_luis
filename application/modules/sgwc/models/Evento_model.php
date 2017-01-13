<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Evento_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_proyecto()
	{
		$query = $this->db->query("SELECT idbase,proyecto FROM foto_base WHERE idestado=1");
		//idestado=1
		return $query->result();
	}
	
	public function desplega_proyecto_permiso($iduser)
	{
		$query = $this->db->query("SELECT * FROM vw_foto_base WHERE idusuario=".$iduser." AND idbase IN (3)");
		//idestado=1
		return $query->result();
	}
	
	public function desplega_fotos($proyecto)
	{
		$query = $this->db->query("SELECT distinct(alias),idbase FROM foto_descripcion WHERE idestado=1 AND idbase=".$proyecto);
		return $query->result();
	}
	
	public function desplega_fuentes($base)
	{
		$query = $this->db->query("SELECT * FROM foto_fuente_informacion WHERE idestado=1 AND idbase=$base ORDER BY fuente_informacion");
		return $query->result();
	}
		
	public function desplega_descripciones($proyecto,$fotos)
	{
		$query = $this->db->query("SELECT * FROM foto_descripcion WHERE idbase=".$proyecto." AND alias='".$fotos."' ORDER BY orden");
		return $query->result();
	}
	
	public function desplega_segmentos($proyecto)
	{
		$query = $this->db->query("SELECT * FROM foto_segmento WHERE idbase=".$proyecto." ORDER BY tramo");
		return $query->result();
	}
	
	public function modifica_descripcion($id,$descripcion,$sin_espacio)
	{
		$query = $this->db->query("EXEC sp_foto_modifica_descripcion $id,'$descripcion','$sin_espacio'");
		return $query->result_array();
	}
	
	public function modifica_orden($id,$fotos,$ordenacion,$id_descripcion,$desc,$sin_espacio)
	{
		$query = $this->db->query("EXEC sp_foto_modifica_orden $id,$fotos,'$ordenacion','$id_descripcion','$desc','$sin_espacio'");
		return $query->result_array();
	}
	
	public function inserta_descripciones()
	{
		$this->db->query("SET ANSI_WARNINGS ON");
		$this->db->query("SET ANSI_NULLS ON");
		$query = $this->db->query("EXEC sp_foto_inserta_descripciones");
		return $query->result_array();
	}
	
	public function muestra_firmas()
	{
		$query = $this->db->query("SELECT * FROM vw_sgwc_firma");
		return $query->result_array();
	}
	
	public function datos_firma($firma)
	{
		$query = $this->db->query("SELECT * FROM vw_sgwc_firma WHERE idfirma=".$firma);
		return $query->result_array();
	}
	
	public function agregar_firma($accion,$idbase,$nombre,$puesto,$usuario)
	{
		$query=$this->db->query("EXEC sp_sgwc_agregar_firma $accion,$idbase,'$nombre','$puesto','$usuario'");
		return $query->result_array();
	}
	
	public function cambia_estado_firma($idfirma,$idestado)
	{
		$query=$this->db->query("EXEC sp_sgwc_cambia_firma $idfirma,$idestado");
		return $query->result_array();
	
	}
}
/*
*end modules/login/models/index_model.php
*/