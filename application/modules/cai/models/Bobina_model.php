<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bobina_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    } 
	
    public function desplega($id)
    {
		$query = $this->db->query("SELECT * FROM vw_cai_bobina WHERE idplaza in (SELECT idplaza
									  FROM vw_grl_usuario_plaza
									  WHERE idusuario=".$id.")");
        return $query->result();
    }
	
	
	public function agrega($inicial,$final,$idplaza,$registra,$serie)
	{
		$query = $this->db->query("EXEC sp_cai_agregar_bobina '$inicial','$final','$idplaza','$registra','$serie'");
		return $query->result_array();
	}
	
}
/*
*end modules/login/models/index_model.php
*/