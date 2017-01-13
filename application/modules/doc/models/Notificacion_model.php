<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notificacion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_notificaciones()
	{
		$this->db->select("*");
		$this->db->from("doc_notificacion_color");
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_notificacion($id)
	{
		$query = $this->db->query("SELECT n.descripcion_nivel, n.idnivel, n.idestado_nivel, nn.idnotificacion_color, CASE WHEN nn.idnotificacion_color IS NULL THEN '' ELSE 'checked' END AS [check] FROM doc_nivel_usuario AS n LEFT OUTER JOIN doc_notificacion_nivel AS nn ON n.idnivel = nn.idnivel AND nn.idnotificacion_color = ".$id." WHERE (n.idestado_nivel = 1) ORDER BY n.idnivel"); 	
        return $query->result_array();
	}
}
