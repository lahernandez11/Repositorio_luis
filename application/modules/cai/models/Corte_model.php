<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Corte_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    } 
	
    function carga_tipo_cambio($fecha,$plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_tipo_cambio
									WHERE idmoneda IN (
										SELECT idmoneda FROM cai_tarifa 
										WHERE idplaza=".$plaza."
										and idestado=1
										and idmoneda!=1 
										)
									AND fecha='".$fecha."'");
		return $query->result();
	}
	
	function carga_tipo_cambio_actual($fecha)
	{
		$query = $this->db->get_where('vw_grl_tipo_cambio',array('fecha' => $fecha, 'idmoneda'=>2,'idestado'=>1));
		return $query->result();
	}
	
	function carga_tarifas($plaza)
	{
		$query = $this->db->get_where('cai_tarifa',array('idplaza' => $plaza, 'idestado'=>1));
		return $query->result();
	}
	
	function cargar_bobina_activa($plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_cai_bobina 
									WHERE idplaza=".$plaza." AND idestado=1");
		return $query->result();
	}
	
	function carga_perfiles($plaza,$perfil)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_usuario_plaza WHERE idperfil in (".$perfil.") AND idplaza=".$plaza);
		return $query->result();
	}
	
	function carga_monedas($plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_cai_tarifa WHERE idplaza=".$plaza." AND idestado=1");
		return $query->result();
	}
	
	function cargar_lineas($plaza)
	{
		$query = $this->db->query("SELECT * FROM grl_carril WHERE idplaza=".$plaza." AND idestado=1");
		return $query->result();
	}
	
	function carga_series($plaza)
	{
		$query = $this->db->query("SELECT DISTINCT(clave) FROM vw_cai_bobina WHERE idplaza=".$plaza." AND idestado=1");
		return $query->result();
	}
	
	function carga_sentidos($plaza)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_sentido
									WHERE idplaza=".$plaza);
		return $query->result();
	}
	
	function carga_cuerpos($plaza)
	{
		$query = $this->db->query("SELECT * FROM grl_cuerpo
									WHERE idplaza=".$plaza." AND idestado=1");
		return $query->result();
	}
	
	public function valida_folios_utilizados($inicial,$final,$serie,$idplaza)
	{
		$query = $this->db->query("EXEC sp_cai_busca_folio_utilizados '$inicial','$final','$idplaza','$serie'");
		return $query->result_array();
	}
	
	public function valida_folios_cancelados($cancelado,$serie,$idplaza)
	{
		$query = $this->db->query("EXEC sp_cai_busca_folio '$cancelado','$idplaza','$serie'");
		return $query->result_array();
	}
	
	public function valida_folios_noemitidos($noemitido,$idplaza)
	{
		$query = $this->db->query("EXEC sp_cai_busca_folio_noemitido '$noemitido','$idplaza'");
		return $query->result_array();
	}
	
	public function agrega_corte($caseta,$linea,$sentido,$fecha,$turno,$jefe,$cobrador,$retiros_parciales_1,$ultimo_retiro_1,$registra,$cuerpo,$retiros_parciales_2,$ultimo_retiro_2,$presentacion,$discrepancias,$discrepancias_srv,$errores,$violaciones,$violaciones_srv,$reportes_admin,$comentarios,$Vehiculos,$Pagos,$Totales,$Tarifas,$FoliosutilizadosInicial,$FoliosutilizadosFinal,$FoliosutilizadosSerie,$Folioscancelados,$FolioscanceladosSerie,$Foliosnoemitidos)
	{
		$query = $this->db->query("EXEC sp_cai_agregar_corte '$caseta','$linea','$sentido','$fecha','$turno','$jefe','$cobrador','$retiros_parciales_1','$ultimo_retiro_1','$registra','$cuerpo','$retiros_parciales_2','$ultimo_retiro_2','$presentacion','$discrepancias','$discrepancias_srv','$errores','$violaciones','$violaciones_srv','$reportes_admin','$comentarios','$Vehiculos','$Pagos','$Totales','$Tarifas','$FoliosutilizadosInicial','$FoliosutilizadosFinal','$FoliosutilizadosSerie','$Folioscancelados','$FolioscanceladosSerie','$Foliosnoemitidos'");
		return $query->result_array();
	}
	
	public function elimina_corte($idcorte)
	{
		$query = $this->db->query("EXEC sp_cai_elimina_corte '$idcorte'");
		return $query->result_array();
	}
	
}
/*
*end modules/login/models/index_model.php
*/