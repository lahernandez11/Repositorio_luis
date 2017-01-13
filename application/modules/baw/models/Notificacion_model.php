<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notificacion_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();   
    }
	
	public function muestra_usuarios_destino($tipo,$proyecto)
	{
		$query=$this->db->query("SELECT * FROM con_destinatario WHERE idtipo_solicitud=".$tipo." AND idproyecto=".$proyecto." ORDER BY usuario");
		return $query->result_array();
	}
	
	public function addcorreo($idusu,$correo,$usuario,$user,$tipo,$proyecto)
	{
		$query=$this->db->query("EXEC sp_baw_agregar_usuario_notificacion $idusu,'$correo','$usuario','$user',$tipo,$proyecto");
		return $query->result_array();
	}
	
	public function removecorreo($id,$tipo,$proyecto)
	{
		$query=$this->db->query("EXEC sp_baw_eliminar_usuario_notificacion $id,$tipo,$proyecto");
		return $query->result_array();
	}
}
?>