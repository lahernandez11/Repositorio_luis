<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega()
    {
		$query = $this->db->query("SELECT * FROM [dbo].[vw_grl_usuario] ORDER BY nombre ASC, apaterno ASC, amaterno ASC");
        return $query->result();
    }
	
	public function desplega_usuario_plaza($id)
	{
		/*$query = $this->db->query('SELECT * FROM [dbo].[vw_grl_usuario_plaza] WHERE idusuario='.$id.' ORDER BY nombre_proyecto ASC, nombre_plaza ASC');*/
		$query = $this->db->query("SELECT idplaza,nombre_plaza,clave as clavep FROM [dbo].[vw_grl_plaza]
		WHERE idestado=1 ORDER BY nombre_proyecto ASC,nombre_plaza ASC");
        return $query->result();
	}
	
	public function agrega($nombre,$paterno,$materno,$correo,$usuario,$clave,$perfil)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_usuario '$usuario','$nombre','$paterno','$materno','$clave','$correo','$perfil'");
		return $query->result_array();
	}
	
	public function agrega_usuario_plaza($new,$checkbox)
	{
		$query = $this->db->query("EXEC sp_grl_usuario_plaza '$new','$checkbox'");
		return $query->result_array();
	}
	
	public function cambia($id,$nombre,$paterno,$materno,$correo,$usuario,$clave,$perfil)
	{
		if($clave!=''):
			$query = $this->db->query("EXEC sp_grl_modifica_usuario_pass '$id','$nombre','$paterno','$materno','$clave','$correo','$perfil'");
		else:
			$query = $this->db->query("EXEC sp_grl_modifica_usuario '$id','$nombre','$paterno','$materno','$correo','$perfil'");
		endif;
		
		return $query->result_array();
	}
    
	
}
/*
*end modules/login/models/index_model.php
*/