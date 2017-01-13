<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Informacion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_solicitud_datos($iduser)
	{
		$query = $this->db->query("SELECT 
sd.idsolicitud_datos,sd.idsolicitud,
cs.folio,
p.nombre_proyecto,
sd.tema,
sd.fecha_solicitud,
CONVERT(VARCHAR(8),
sd.hora_solicitud,108)as hora,
'<a href=\"\" data-toggle=modal data-target=#myModal class=sol_info id='+CAST(sd.idsolicitud  AS varchar(4000))+'>'+CAST(folio AS varchar(4000))+'</a>' AS link  
FROM baw_solicitar_datos sd left join baw_solicitud s on s.idsolicitud=sd.idsolicitud 
left join con_solicitud cs on s.idcon_solicitud=cs.idsolicitud left join grl_proyecto p on p.idproyecto=cs.idproyecto 
where sd.estado_datos=1 AND cs.idproyecto in(SELECT idproyecto FROM vw_grl_usuario_plaza where idusuario=".$iduser.") ORDER BY sd.fecha_solicitud DESC,hora DESC");
        return $query->result_array();
	}  
	
	public function informacion_datos($solicitud)
	{
		$query = $this->db->query("SELECT *,CONVERT(VARCHAR(8),hora_solicitud,108)as hora FROM vw_baw_solicitar_datos WHERE idsolicitud_datos=".$solicitud);
        return $query->result_array();
	}
	
	public function responder_comentario($solicitud,$usuario,$respuesta)
	{
		$query=$this->db->query("EXEC sp_baw_responder_solicitud_datos '$solicitud','$usuario','$respuesta'");
		return $query->result_array();
	}
	
	public function responder_comentario_documento($idrespuesta_datos,$file)
	{
		$query=$this->db->query("EXEC sp_baw_responder_solicitud_datos_documento '$idrespuesta_datos','$file'");
		return $query->result_array();
	}
	
	public function desplega_preguntas($solicitud)
	{
		$query=$this->db->query("SELECT s.idcon_solicitud, sd.tema, sd.comentario,sd.idsolicitud_datos , sd.fecha_solicitud, CONVERT(VARCHAR(8),sd.hora_solicitud,108)as hora_s,sd.estado_datos , 
CASE WHEN sd.estado_datos=1 THEN '<button id=\"'+ CAST(idcon_solicitud AS varchar)+'\" style=\"float:right\" type=\"button\" class=\"btn btn-danger btn-xs btn-cerrar\" >
Cerrar Tema</button>' END AS boton,sd.usuario_solicita,s.idsolicitud ,
CASE WHEN rd.usuario_respuesta IS NULL                      
THEN 'NO SE TIENE RESPUESTA' ELSE '<a href=\"\" data-toggle=\"modal\" data-target=\"#myModal' + CAST(sd.idsolicitud_datos AS varchar) + '\">VER RESPUESTA</a>' END AS link
FROM baw_solicitud s INNER JOIN baw_solicitar_datos sd ON s.idsolicitud = sd.idsolicitud 
LEFT OUTER JOIN baw_respuesta_datos AS rd ON sd.idsolicitud_datos = rd.idsolicitud_datos
WHERE sd.idsolicitud_datos=".$solicitud);
		return $query->result_array();
	}
	
	
	
	public function desplega_respuesta($solicitud)
	{
		$query=$this->db->query("SELECT s.idcon_solicitud,rd.fecha_respuesta,CONVERT(VARCHAR(8),rd.hora_respuesta,108)as hora_respuesta,rd.usuario_respuesta, sd.tema,rd.respuesta,sd.idsolicitud_datos, sd.usuario_pregunta, rd.fecha_respuesta, CASE WHEN rd.fecha_respuesta IS NULL THEN CAST(sd.usuario_pregunta AS varchar) + ' | NO SE TIENEN RESPUESTA' ELSE '<a href=\"\" data-toggle=modal data-target=#myModal'+CAST(sd.idsolicitud_datos AS varchar)+'>'+CAST(sd.usuario_pregunta AS varchar) + ' | ' + CAST(rd.fecha_respuesta AS varchar)+'</a>' END AS link FROM baw_solicitud AS s INNER JOIN baw_solicitar_datos AS sd ON s.idsolicitud = sd.idsolicitud LEFT OUTER JOIN baw_respuesta_datos AS rd ON sd.idsolicitud_datos = rd.idsolicitud_datos
WHERE sd.idsolicitud_datos =".$solicitud);
		return $query->result_array();
	}
	
	public function consulta_solicitud_datos($solicitud)
	{
		$query=$this->db->query("SELECT sd.tema,sd.comentario,cs.folio FROM baw_solicitar_datos sd INNER JOIN baw_solicitud s ON sd.idsolicitud=s.idsolicitud INNER JOIN con_solicitud cs ON s.idcon_solicitud=cs.idsolicitud WHERE sd.idsolicitud_datos=".$solicitud);
		return $query->result();
	}
	
	public function resumen_informacion($idsolicitud)
	{
		$query=$this->db->query("SELECT * FROM vw_baw_solicitudes_atendidas WHERE idsolicitud=".$idsolicitud);
		return $query->result_array();
	}
	
}
/*
*end modules/login/models/index_model.php
*/