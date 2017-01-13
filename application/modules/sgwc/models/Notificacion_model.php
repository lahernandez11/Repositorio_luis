<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notificacion_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();   
    }
	
	public function muestra_usuarios_destino($idbase,$tramoID)
	{
		$query=$this->db->query("SELECT * FROM sgwc_notificacion WHERE idbase=".$idbase." AND tramoID=".$tramoID." ORDER BY usuario");
		return $query->result_array();
	}
	
	public function addcorreo($idusu,$idbase,$tramo,$correo,$usuario,$user)
	{
		$query=$this->db->query("EXEC sp_sgwc_agregar_usuario_notificacion $idusu,$idbase,$tramo,'$correo','$usuario','$user'");
		return $query->result_array();
	}
	
	public function removecorreo($id,$idbase,$tramo)
	{
		$query=$this->db->query("EXEC sp_sgwc_eliminar_usuario_notificacion $id,$idbase,$tramo");
		return $query->result_array();
	}
}
?>