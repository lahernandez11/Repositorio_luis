<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pendiente_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_clase($proyecto)
	{
		$query = $this->db->query("select c.* ,p.id,case when p.id >=1 then 'disabled' end as disabled ,case when p.id >=1 then '#F2DEDE' end as color 
from foto_clase c left join sgwc_notificacion_pvencer p on (c.idclase=p.id and p.indicador='C' and p.idbase=".$proyecto.") where c.idbase=".$proyecto." and c.bloqueID=2 order by c.clase");
		return $query->result();
	}
	
	public function desplega_clase_notificacion($proyecto)
	{
		$query = $this->db->query("EXEC sp_sgwc_desplega_clase_notificacion $proyecto");
		return $query->result();
	}
	
	public function desplega_tipo($clase,$idbase)
	{
		$query = $this->db->query("select t.* ,p.id,case when p.id >=1 then 'disabled' end as disabled ,case when p.id >=1 then '#F2DEDE' end as color 
from sgwc_tipo t left join sgwc_notificacion_pvencer p on (t.tipoID=p.id and p.indicador='T' and p.idbase=".$idbase.") where t.idbase=".$idbase." and t.claseID=".$clase." order by t.title");
		return $query->result_array();
	}
	
	public function desplega_tipo_destino($clase,$idbase)
	{
		$query = $this->db->query("EXEC sp_sgwc_desplega_tipo_destino $idbase,$clase");
		return $query->result_array();
	}
	
	public function desplega_subtipo($tipo,$idbase)
	{
		$query = $this->db->query("select s.* ,p.id,case when p.id >=1 then 'disabled' end as disabled ,case when p.id >=1 then '#F2DEDE' end as color,CASE WHEN s.plazo_maximo_default<60 THEN CAST(s.plazo_maximo_default AS nvarchar(10))+' MIN.' ELSE CAST((s.plazo_maximo_default/60) AS nvarchar(10)) + ' HR.' END AS hr 
from sgwc_subtipo s left join sgwc_notificacion_pvencer p on (s.subtipoID=p.id and p.indicador='S' and p.idbase=".$idbase.") where s.idbase=".$idbase." and s.tipoID=".$tipo." order by s.title");
		return $query->result_array();
	}
	
	public function desplega_subtipo_destino($tipo,$idbase)
	{
		$query = $this->db->query("EXEC sp_sgwc_desplega_subtipo_destino $idbase,$tipo");
		return $query->result_array();
	}
	
	public function muestra_unidad_tiempo()
	{
		$query = $this->db->query("SELECT * FROM sgwc_cat_tiempo");
		return $query->result();
	}
	
	public function muestra_clases($clase,$idbase)
	{
		$query=$this->db->query("SELECT idclase,clase,idbase FROM foto_clase WHERE idclase IN (".$clase.") AND idbase=".$idbase." ORDER BY clase");
		return $query->result();
	}
	
	public function muestra_tipos($tipo,$idbase)
	{
		$query=$this->db->query("SELECT tipoID,title FROM sgwc_tipo WHERE tipoID IN (".$tipo.") AND idbase=".$idbase." ORDER BY title");
		return $query->result();
	}
	
	public function muestra_subtipos($subtipo,$idbase)
	{
		$query=$this->db->query("SELECT subtipoID,title,idbase FROM sgwc_subtipo WHERE subtipoID IN (".$subtipo.") AND idbase=".$idbase." ORDER BY title");
		return $query->result();
	}
	
	public function agregar_notificacion($idbase,$indicador,$id,$tiempo,$valor,$usuario)
	{
		$query = $this->db->query("EXEC sp_sgwc_agregar_notificacion $idbase,'$indicador','$id',$tiempo,$valor,'$usuario'");
		return $query->result_array();
	}
	
	public function eliminar_notificacion($id)
	{
		$query = $this->db->query("EXEC sp_sgwc_eliminar_notificacion '$id'");
		return $query->result_array();
	}
	
	public function cambia_estado($id,$idestado)
	{
		$query = $this->db->query("EXEC sp_sgwc_cambia_estado $id,$idestado");
		return $query->result_array();
	}
	
	public function busca_notificacion($id,$indicador)
	{
		$query = $this->db->query("EXEC sp_sgwc_buscar_notificacion $id,'$indicador'");
		return $query->result_array();
	}
	
	public function modifica_datos($idnotificacion,$valor,$tiempo)
	{
		$query = $this->db->query("EXEC sp_sgwc_modifica_datos $idnotificacion,$valor,$tiempo");
		return $query->result_array();
	}
	
}
/*
*end modules/login/models/index_model.php
*/