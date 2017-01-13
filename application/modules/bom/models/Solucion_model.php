<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Solucion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_reporte($id)
	{
		$query=$this->db->query("EXEC sp_bom_info_solucion '$id'");
		return $query->result_array();
	}
	
	public function desplega_reparar($id)
	{
		$query=$this->db->query("SELECT r.idreporte, rp.* FROM bom_reporte r LEFT JOIN bom_reparar_equipo rp on r.idreporte=rp.idreporte WHERE (r.idreporte = ".$id.") AND (r.idestado = 3)");
		return $query->result_array();
	}
	
	public function desplega_reemplazar($id)
	{
		$query=$this->db->query("SELECT r.idreporte, re.* FROM bom_reporte r LEFT JOIN bom_reemplazo_equipo re on r.idreporte=re.idreporte WHERE (r.idreporte = ".$id.") AND (r.idestado = 3)");
		return $query->result_array();
	}
	
	public function desplega_reparo($id)
	{
		$query=$this->db->query("SELECT * FROM vw_bom_reparar_equipo where idreporte=".$id." AND idestado=3");
		return $query->result_array();
	}
	
	public function desplega_reemplazo($id)
	{
		$query=$this->db->query("SELECT * FROM vw_bom_reemplazo_equipo where idreporte=".$id." AND idestado=3");
		return $query->result_array();
	}
	
	public function registra_solucion(
																$idreporte,
																$iduser,
																$solucion,
																$reparar,
																$reemplazar,
																$Equipos,
																$Marcas,
																$Modelos,
																$Motivos,
																$Destinos,
																$Fechas,
																$VEquipos,
																$VMarcas,
																$VModelos,
																$VMotivos,
																$VUbicaciones,
																$NMarcas,
																$NModelos,
																$NSeries,
																$NMotivos,
																$IDreparo,$IDreemplazo,
																$usuario
																)
	{
		$query = $this->db->query("EXEC sp_bom_registro_solucion '$idreporte','$iduser','$solucion','$reparar','$reemplazar','$Equipos','$Marcas','$Modelos','$Motivos','$Destinos','$Fechas','$VEquipos','$VMarcas','$VModelos','$VMotivos','$VUbicaciones','$NMarcas','$NModelos','$NSeries','$NMotivos','$IDreparo','$IDreemplazo','$usuario'");
		return $query->result_array();
	}
	
	public function desplega_equipos($idreporte)
	{
		$query = $this->db->query("select * from vw_bom_activo where 
idareaafectacion=(select idareaafectacion from bom_reporte where idreporte=".$idreporte.")
and 
idplaza=(select idplaza from bom_reporte where idreporte=".$idreporte.") 
AND 
idcarril=(select idcarril from bom_reporte where idreporte=".$idreporte.")
AND
idcat_estado_activo=1 ORDER BY nombre_equipo ASC");
		return $query->result_array();
	}
	
	public function desplega_activo($idactivo)
	{
		$query = $this->db->query("SELECT * FROM vw_bom_activo WHERE idactivo=".$idactivo."");
		return $query->result_array();
	}
	
	/*public function registra_solucion(
																$idreporte,
																$registra,
																$solucion,
																$reparar,
																$reemplazar,
																$Marcas,
																$Modelos,
																$Capacidades,
																$Series,
																$Motivos,
																$Destinos,
																$Fechas,
																$VMarcas,
																$VModelos,
																$VCapacidades,
																$VSeries,
																$VMotivos,
																$VUbicaciones,
																$NMarcas,
																$NModelos,
																$NCapacidades,
																$NSeries,
																$NMotivos,
																$NUbicaciones
																)
	{
		$query = $this->db->query("EXEC sp_bom_registro_solucion '$idreporte','$registra','$solucion','$reparar','$reemplazar','$Marcas','$Modelos','$Capacidades','$Series','$Motivos','$Destinos','$Fechas','$VMarcas','$VModelos','$VCapacidades','$VSeries','$VMotivos','$VUbicaciones','$NMarcas','$NModelos','$NCapacidades','$NSeries','$NMotivos','$NUbicaciones'");
		return $query->result_array();
	}*/
	
}