<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notificacion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function select_tiporeporte()
	{
		$query=$this->db->query("SELECT * FROM bom_tiporeporte");
		return $query->result_array();
	}
	
	public function select_clasificacion()
	{
		$query=$this->db->query("SELECT * FROM bom_clasificacion");
		return $query->result_array();
	}
	
	public function muestra_usuarios_origen($tipo,$cla,$pasos)
	{
		$query=$this->db->query("EXEC sp_bom_correo_notificacion_todos $tipo,$cla,$pasos");
		return $query->result_array();
	}
	
	public function muestra_usuarios_destino($tipo,$cla,$pasos)
	{
		$query=$this->db->query("EXEC sp_bom_correo_notificacion_usuario $tipo,$cla,$pasos");
		return $query->result_array();
	}
	
	public function muestra_pasos()
	{
		$query=$this->db->query("SELECT [idmenu],[nombre_menu] FROM [dbo].[grl_menu] WHERE idmenu BETWEEN 20 AND 25");
		return $query->result_array();
	}
	
	public function addcorreo($idusu,$idtipo,$idcla,$pasos)
	{
		$query=$this->db->query("EXEC sp_bom_notificacion_agregar_usuario $idusu,$idtipo,$idcla,$pasos");
		return $query->result_array();
	}
	
	public function removecorreo($id)
	{
		$query=$this->db->query("EXEC sp_bom_notificacion_elimina_usuario $id");
		return $query->result_array();
	}
	
	public function select_correos($idtiporeporte,$idclasificacion,$plaza,$menu)
	{
		$query=$this->db->query("SELECT correo FROM [dbo].[vw_bom_correo_notificaciones] WHERE idtiporeporte=".$idtiporeporte." AND idclasificacion<=".$idclasificacion." and idplaza=".$plaza." AND idmenu=".$menu." GROUP BY correo");
		return $query->result_array();
	}
	
	public function select_copiaoculta()
	{
		$query=$this->db->query("SELECT * FROM [dbo].[bom_copiaoculta]");
		return $query->result_array();
	}
	
	public function select_actividades_resumen()
	{
		$query=$this->db->query("SELECT * FROM [dbo].[bom_notificacion_resumen_actpen]");
		return $query->result_array();
	}
	
	
	public function select_usuarios($idtiporeporte,$idclasificacion,$plaza,$menu)
	{
		$query=$this->db->query("SELECT nombre FROM [dbo].[vw_bom_correo_notificaciones] WHERE idtiporeporte=".$idtiporeporte." AND idclasificacion<=".$idclasificacion." and idplaza=".$plaza." AND idmenu=".$menu." GROUP BY nombre");
		return $query->result_array();
	}
	
}