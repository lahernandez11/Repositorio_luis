<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	public function desplega_usuario($id)
	{
		$query = $this->db->query("SELECT * FROM [dbo].[vw_grl_usuario] WHERE idusuario=".$id);
        return $query->result();
	}
	
    public function desplega_lista_proyectos()
    {
		$query = $this->db->query("SELECT * FROM [dbo].[vw_grl_proyecto] ORDER BY nombre_proyecto ASC;");
        return $query->result();
    }
	
	public function desplega_perfil_usuario($idperfil)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_perfil WHERE idperfil='".$idperfil."'");
        return $query->result();
	}
	
	public function desplega_lista_perfiles()
    {
		$query = $this->db->query("SELECT * FROM [dbo].[vw_grl_perfil] WHERE idestado=1");
        return $query->result();
    }
	
	public function desplega_lista_plazas_activas()
	{
		$query = $this->db->query("SELECT * FROM [dbo].[vw_grl_plaza] WHERE idestado=1");
        return $query->result();
	}
	
	public function desplega_plazas_usuario($id)
	{
		$query = $this->db->query("SELECT * FROM [dbo].[vw_grl_usuario_plaza] WHERE idusuario=".$id);
        return $query->result();
	}
	
	public function desplega_carriles_plaza($id)
	{
		$query = $this->db->query("SELECT * FROM [dbo].[grl_carril] WHERE idplaza=".$id." AND idestado=1");
        return $query->result();
	}
	
	public function desplega_lista_usuarios_activos()
	{
		$query = $this->db->query("SELECT * FROM [dbo].[grl_usuario] WHERE idestado=1");
        return $query->result();
	}
	
}