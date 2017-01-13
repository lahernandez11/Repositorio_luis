<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bom_general_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_numero($id,$iduser)
	{
		/*if($id==4):$id='4,5';endif;
		$query = $this->db->query("SELECT SUM([total]) as total FROM [opi].[dbo].[vw_bom_pasos_pendientes] WHERE idestado in (".$id.")
		AND idplaza in (SELECT idplaza FROM [opi].[dbo].[grl_usuario_plaza] WHERE idusuario=".$iduser.")");*/
		if($id==4):$id='4,5';endif;
		if($id==4):
			$query = $this->db->query("SELECT COUNT([idreporte]) as total FROM vw_bom_consulta_mp_emision 
  WHERE idplaza in (SELECT idplaza from vw_grl_usuario_plaza WHERE idusuario=".$iduser.")");
		elseif($id==5):
			$query = $this->db->query("SELECT COUNT(mp.idreporte) AS total FROM vw_bom_consulta_mp mp LEFT JOIN bom_reporte_documento doc ON doc.idreporte=mp.idreporte WHERE mp.idestado in (5) AND mp.idplaza in (SELECT idplaza from vw_grl_usuario_plaza WHERE idusuario=".$iduser.") AND doc.emision=1");
		else:
			$query = $this->db->query("SELECT SUM([total]) as total FROM vw_bom_pasos_pendientes WHERE idestado in (".$id.")
		AND idplaza in (SELECT idplaza FROM grl_usuario_plaza WHERE idusuario=".$iduser.")");
		endif;
		return $query->result();
	}
	
	public function desplega_reportes($estado,$usuario)
	{
		if($estado==4):
			$estado='4,5';
			/*$query = $this->db->query("SELECT * FROM [opi].[dbo].[vw_bom_consulta_mp_emision] WHERE idestado in (".$estado.") AND idplaza in (SELECT idplaza from [opi].[dbo].[vw_grl_usuario_plaza] WHERE idusuario=".$usuario.")
			AND (emision is null or emision=2) AND nombre_usuario is not NULL
		ORDER BY prioridad DESC, horas DESC, minutos DESC");
		$query= $this->db->query("SELECT * FROM [opi].[dbo].[vw_bom_consulta_mp_emision] WHERE idestado in (4) 
AND idplaza in (SELECT idplaza from [opi].[dbo].[vw_grl_usuario_plaza] WHERE idusuario=".$usuario.")
OR (idestado=5 AND emision=2 AND nombre_usuario is not null)			
		ORDER BY prioridad DESC, horas DESC, minutos DESC");*/
			$query = $this->db->query("SELECT * FROM vw_bom_consulta_mp_emision WHERE idplaza in (SELECT idplaza from vw_grl_usuario_plaza WHERE idusuario=".$usuario.")
		ORDER BY prioridad DESC, horas DESC, minutos DESC");
		elseif($estado==5):
			$query = $this->db->query("SELECT mp.* FROM vw_bom_consulta_mp mp LEFT JOIN bom_reporte_documento doc ON doc.idreporte=mp.idreporte
  WHERE mp.idestado in (5) AND mp.idplaza in (SELECT idplaza from vw_grl_usuario_plaza WHERE idusuario=".$usuario.") AND doc.emision=1 
  ORDER BY mp.prioridad DESC, mp.horas DESC, mp.minutos DESC");
		else:
			$query = $this->db->query("SELECT * FROM vw_bom_consulta_mp WHERE idestado in (".$estado.") AND idplaza in (SELECT idplaza from vw_grl_usuario_plaza WHERE idusuario=".$usuario.")
		ORDER BY prioridad DESC, horas DESC, minutos DESC");
			
		endif;
		
		return $query->result();
	}
	
	public function desplega_lista_tecnicos_plaza($plaza)
	{
		$query = $this->db->query("SELECT u.idusuario,u.nombre,u.apaterno,u.amaterno FROM grl_usuario u LEFT JOIN grl_usuario_plaza up ON up.idusuario = u.idusuario 						  LEFT JOIN grl_usuario_perfil upf ON upf.idusuario = u.idusuario WHERE idplaza=".$plaza." AND idperfil=23");
        return $query->result();
	}
	
}