<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Index_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
	function login($username, $password)
	{
		$query = $this->db->query("SELECT dbo.grl_usuario.idusuario as idusuario,dbo.grl_usuario.usuario, dbo.grl_usuario.nombre+' '+dbo.grl_usuario.apaterno+' '+dbo.grl_usuario.amaterno as descripcion, dbo.grl_usuario_perfil.idperfil as idperfil
FROM dbo.grl_usuario INNER JOIN dbo.grl_usuario_perfil ON dbo.grl_usuario.idusuario = dbo.grl_usuario_perfil.idusuario WHERE (dbo.grl_usuario.usuario = '".$username."') AND (dbo.grl_usuario.clave = '".md5($password)."')");
		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	public function verify_pass($id,$clave)
	{
		$this -> db -> select('*');
		$this -> db -> from('grl_usuario');
		$this -> db -> where('idusuario', $id);
		$this -> db -> where('idestado', 1);
		$this -> db -> where('clave', MD5($clave));
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		return $query -> num_rows();
	}
	
	
	public function change_pass($id,$clave)
	{
		$data = array(
               'clave' => md5($clave)
            );

		$this->db->where('idusuario', $id);
		$this->db->update('grl_usuario', $data); 
		return $this->db->affected_rows();
	}
	
	public function carga_menu($idperfil,$idmenu)
	{
		$query = $this->db->query("EXEC sp_grl_crea_menu '$idperfil','$idmenu'");
		return $query->result();
	}
	
	public function carga_menu_principal($idperfil)
	{
		$query = $this->db->query("SELECT nombre_menu,ruta,icono FROM grl_menu_perfil mp
LEFT JOIN grl_menu m ON m.idmenu = mp.idmenu
WHERE mp.idperfil=".$idperfil." AND m.idestado=1 AND m.idpadre=0 AND m.idmenu NOT IN (7,16) ORDER BY orden");
		return $query->result();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/