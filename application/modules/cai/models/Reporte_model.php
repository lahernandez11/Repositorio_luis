<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reporte_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    } 
	
    public function desplega_reportes_corte($id)
    {
		$query = $this->db->query("SELECT 
							SUM(cd.total) as aforo,
							cd.idcorte,
							fecha,
							nombre_plaza,
							nombre_carril,
							turno,
							nombre_sentido,
							nombre,
							apaterno,
							amaterno
							FROM cai_corte_detalle cd
							LEFT JOIN cai_corte c ON c.idcorte = cd.idcorte
							LEFT JOIN grl_plaza p ON p.idplaza = c.idplaza
							LEFT JOIN grl_carril ca ON ca.idcarril = c.idcarril
							LEFT JOIN cai_turno t ON t.idturno = c.idturno
							LEFT JOIN grl_sentido s ON s.idsentido = c.idsentido
							LEFT JOIN grl_usuario u ON u.idusuario = c.registra
							WHERE cd.idtipo_pago not in (10)
							AND cd.idtipo_vehiculo not in (5,19,20)
							AND fecha=(SELECT MAX(fecha) FROM cai_corte)
							AND c.idplaza IN (SELECT idplaza FROM grl_usuario_plaza WHERE idusuario=".$id.")
							GROUP BY 
							cd.idcorte,
							fecha,
							nombre_plaza,
							nombre_carril,
							turno,
							nombre_sentido,
							nombre,
							apaterno,
							amaterno
							ORDER BY nombre_plaza ASC, nombre_sentido ASC, turno ASC");
        return $query->result();
    }
	
	public function desplega_reportes_corte_resultado($turno,$plaza,$fecha)
    {
		$query = $this->db->query("SELECT 
							SUM(cd.total) as aforo,
							cd.idcorte,
							fecha,
							nombre_plaza,
							nombre_carril,
							turno,
							nombre_sentido,
							nombre,
							apaterno,
							amaterno
							FROM cai_corte_detalle cd
							LEFT JOIN cai_corte c ON c.idcorte = cd.idcorte
							LEFT JOIN grl_plaza p ON p.idplaza = c.idplaza
							LEFT JOIN grl_carril ca ON ca.idcarril = c.idcarril
							LEFT JOIN cai_turno t ON t.idturno = c.idturno
							LEFT JOIN grl_sentido s ON s.idsentido = c.idsentido
							LEFT JOIN grl_usuario u ON u.idusuario = c.registra
							WHERE cd.idtipo_pago not in (10)
							AND cd.idtipo_vehiculo not in (5,19,20)
							AND fecha='".$fecha."'
							AND c.idplaza IN (".$plaza.")
							AND c.idturno in (".$turno.")
							GROUP BY 
							cd.idcorte,
							fecha,
							nombre_plaza,
							nombre_carril,
							turno,
							nombre_sentido,
							nombre,
							apaterno,
							amaterno
							ORDER BY nombre_plaza ASC, nombre_sentido ASC, turno ASC");
        return $query->result();
    }
	
	public function encabezado_corte_pdf($id)
	{
		$query = $this->db->query("SELECT 
							fecha,
							c.idplaza,
							nombre_proyecto,
							nombre_plaza,
							nombre_sentido,
							turno,
							nombre_cuerpo,
							nombre_carril,
							je.nombre+' '+je.apaterno+' '+je.amaterno as jefe,
							co.nombre+' '+co.apaterno+' '+co.amaterno as cobrador
							FROM cai_corte c
							LEFT JOIN grl_plaza p ON c.idplaza = p.idplaza
							LEFT JOIN grl_proyecto pr ON pr.idproyecto = p.idproyecto
							LEFT JOIN grl_sentido s ON s.idsentido = c.idsentido
							LEFT JOIN cai_turno t ON t.idturno = c.idturno
							LEFT JOIN grl_cuerpo cu ON cu.idcuerpo = c.idcuerpo
							LEFT JOIN grl_carril ca ON ca.idcarril = c.idcarril
							LEFT JOIN grl_usuario je ON je.idusuario = c.jefe
							LEFT JOIN grl_usuario co ON co.idusuario = c.cobrador
							WHERE idcorte=".$id."");
		return $query->result();
	}
	
	
	//FUNCIONES ANTERIORES
	
	
	function encabezado_pdf($corte)
	{
		$query = $this->db->query("select
									c.idcorte,
									c.idturno as turno,
									ca.caseta as caseta,
									ca.idcaseta,
									p.proyecto as proyecto,
									c.fecha,
									u.descripcion as cobrador,
									uj.descripcion as jefe,
                  					if(idcuerpo=1,'A','B') as cuerpo,
                  					linea,
                  					tipo_caseta as tipo,
									concat(s.origen,"-",s.destino) as sentido
									from corte c left join caseta ca using (idcaseta)
									left join proyecto  p using (idproyecto)
									left join usuario u on u.idusuario=c.cobrador
									left join usuario uj on uj.idusuario=c.jefe
                  					left join linea li using (idlinea)
                  					left join tipo_caseta using (idtipo_caseta)
									left join sentido s using (idsentido)
								WHERE idcorte=".$corte);
		return $query->result();
	}
	
	
	/*function carga_tipos_pago($caseta)
	{
		$query = $this->db->query('SELECT idtipo_pago,tipo_pago,clave
									FROM tipo_pago_caseta 
									LEFT JOIN tipo_pago USING (idtipo_pago)
									WHERE idcaseta='.$caseta.'
									ORDER BY orden');
		return $query->result();
	}
	
	function carga_vehiculos($caseta)
	{
		$query = $this->db->query('SELECT idtipo_vehiculo,tipo_vehiculo,clave
									FROM tipo_vehiculo_caseta 
									LEFT JOIN tipo_vehiculo USING (idtipo_vehiculo)
									WHERE idcaseta='.$caseta.'
									ORDER BY idtipo_vehiculo');
		return $query->result();
	}*/
	
	//Se cambiaron funciones para no modificar reporte cuando se agreguen o eliminen tipos de pago y tipos de vehiculo
	function carga_tipos_pago($corte,$caseta)
	{
		/*$query = $this->db->query('SELECT distinct(cd.idtipo_pago),tp.tipo_pago,tp.clave
									FROM cai_corte_detalle cd 
									LEFT JOIN cai_tipo_pago tp ON tp.idtipo_pago = cd.idtipo_pago
									WHERE idcorte='.$corte.'');*/
		$query = $this->db->query("SELECT distinct(cd.idtipo_pago),tp.tipo_pago,tp.clave,tpp.orden
FROM cai_corte_detalle cd 
LEFT JOIN cai_tipo_pago_plaza tpp ON tpp.idtipo_pago = cd.idtipo_pago
LEFT JOIN cai_tipo_pago tp ON tp.idtipo_pago = cd.idtipo_pago
WHERE idcorte=".$corte." AND tpp.idplaza=".$caseta." ORDER BY orden");
									
		return $query->result();
	}
	
	function carga_vehiculos($corte,$caseta)
	{
		/*$query = $this->db->query('SELECT distinct(cd.idtipo_vehiculo),tv.tipo_vehiculo,tv.clave
									FROM cai_corte_detalle cd 
									LEFT JOIN grl_tipo_vehiculo tv ON tv.idtipo_vehiculo = cd.idtipo_vehiculo
									WHERE idcorte='.$corte.'');*/
									
		$query = $this->db->query("SELECT distinct(cd.idtipo_vehiculo),tv.tipo_vehiculo,tv.clave,tvp.orden
FROM cai_corte_detalle cd 
LEFT JOIN grl_tipo_vehiculo_plaza tvp ON tvp.idtipo_vehiculo = cd.idtipo_vehiculo
LEFT JOIN grl_tipo_vehiculo tv ON tv.idtipo_vehiculo = cd.idtipo_vehiculo
WHERE idcorte=".$corte." AND tvp.idplaza=".$caseta." ORDER BY orden");							
		return $query->result();
	}
	//=================================================================================================================
	
	function carga_ejes($vehiculo)
	{
		$query = $this->db->query("SELECT * FROM 
									grl_tipo_vehiculo 
									WHERE idtipo_vehiculo=".$vehiculo);
		return $query->result();
	}
	
	
	function carga_aforo($vehiculo,$pago,$corte)
	{
		$query = $this->db->query("SELECT * FROM cai_corte_detalle 
									WHERE idcorte=".$corte."
									AND idtipo_vehiculo=".$vehiculo."
									AND idtipo_pago=".$pago);
		return $query->result();
	}
	
	//Se agrego NOT IN para descontar ejes
	function suma_aforo_vehiculo($vehiculo,$corte)
	{
		$query = $this->db->query("SELECT SUM(total) as total 
									FROM cai_corte_detalle 
									WHERE idcorte=".$corte."
									AND idtipo_vehiculo=".$vehiculo."
									AND idtipo_pago!=9");
		return $query->result();
	}
	
	
	function carga_tarifas($corte)
	{
		$query = $this->db->query("SELECT ct.idtarifa,m.idmoneda,m.moneda
									FROM cai_corte_tarifa ct
									LEFT JOIN cai_tarifa t ON t.idtarifa = ct.idtarifa
									LEFT JOIN grl_moneda m ON m.idmoneda = t.idmoneda
									WHERE idcorte=".$corte);
		return $query->result();
	}
	
	
	/*function regresa_tarifa($vehiculo,$corte)
	{
		$query = $this->db->query('SELECT tarifa 
									FROM tarifa_detalle
									LEFT JOIN tarifa USING (idtarifa)
									LEFT JOIN corte USING (idtarifa)
									WHERE idcorte='.$corte.' 
									AND idtipo_vehiculo='.$vehiculo.'');
		return $query->result();
	}*/
	function regresa_tarifa($vehiculo,$tarifa)
	{
		$query = $this->db->query("SELECT * FROM cai_tarifa_detalle 
									WHERE idtarifa=".$tarifa."
									AND idtipo_vehiculo=".$vehiculo);
		return $query->result();
	}
	
	function carga_importe($vehiculo,$corte,$where)
	{
		$query = $this->db->query("SELECT SUM(total) as total
									FROM cai_corte_detalle 
									WHERE idcorte='.$corte.'
									AND idtipo_vehiculo=".$vehiculo."
									AND idtipo_pago not in (6,7,9)
									".$where);
		return $query->result();
	}
	
	//Se agrego NOT IN para descontar ejes
	function regresa_total($pago,$corte)
	{
		$query = $this->db->query("SELECT ISNULL(SUM(total),0) AS total 
									FROM cai_corte_detalle WHERE IdCorte=".$corte."
									AND idtipo_pago=".$pago." AND idtipo_vehiculo NOT IN (18,19,20)");
		return $query->result();
	}
	
	function regresa_calificacion($corte)
	{
		$query = $this->db->query("SELECT * 
									FROM cai_corte_calificacion WHERE idcorte=".$corte);
		return $query->result();
	}
	
	function folios_utilizados($corte)
	{
		$query = $this->db->query("SELECT * FROM cai_folio_utilizado_rango WHERE idcorte=".$corte);
		return $query->result();
	}
	
	function folios_utilizados_total($corte)
	{
		$query = $this->db->query("SELECT count(*) as total FROM cai_folio_utilizado WHERE idcorte=".$corte);
		return $query->result();
	}
	
	function folios_cancelados_total($corte)
	{
		$query = $this->db->query("select count(*) as total from cai_folio_cancelado where idcorte=".$corte);
		return $query->result();
	}
	
	function folios_cancelados($corte)
	{
		$query = $this->db->query("select folio_cancelado, serie from cai_folio_cancelado where idcorte=".$corte);
		return $query->result();
	}
	
	function folios_noemitidos($corte)
	{
		$query = $this->db->query("select count(*) as total from cai_folio_noemitido where idcorte=".$corte);
		return $query->result();
	}
	
	function folios_noemitidos_detalle($corte)
	{
		$query = $this->db->query("select folio_noemitido from cai_folio_noemitido where idcorte=".$corte);
		return $query->result();
	}
	
	/*function firma($caseta)
	{
		$query = $this->db->query('SELECT * FROM usuario
									LEFT JOIN usuario_caseta USING (idusuario)
									WHERE idtipo_usuario=1 AND idcaseta='.$caseta.'');
		return $query->result();	
	}
	
	function firma_registra($corte)
	{
		$query = $this->db->query('select c.registra,u.descripcion,tu.tipo_usuario
from corte c
left join usuario u on u.idusuario = c.registra
left join tipo_usuario tu using (idtipo_usuario)
where c.idcorte='.$corte.'');
		return $query->result();	
	}*/
	
	function retiros($corte)
	{
		$query = $this->db->query("SELECT 
									retiros_parciales_1,
									ultimo_retiro_1,
									retiros_parciales_2,
									ultimo_retiro_2
									from cai_corte WHERE idcorte=".$corte);
		return $query->result();
	}
	
	
	function total_importe($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_importe 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo = cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago not in (8,9) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_efectivo($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_efectivo 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo = cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago=1 and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_ingreso_sd($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_ingreso_sd 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (1,4) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_ingreso_sd_e($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_ingreso_sd_e 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo = cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (2) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_tvas($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_tvas 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (3,4) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_vas2($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_vas2 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (4) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_vas1($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_vas1 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (3) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_telepeaje($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_telepeaje 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago=5 and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_exentos($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_exentos 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (8,9) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_residentes($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_residentes 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (6,7) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function total_eludidos($corte,$tarifa)
	{
			$query = $this->db->query("SELECT sum((total*tarifa)) as total_eludidos 
										FROM cai_corte_detalle cd
										LEFT JOIN cai_tarifa_detalle td ON td.idtipo_vehiculo=cd.idtipo_vehiculo
										WHERE idcorte=".$corte."
										and idtipo_pago in (10) and idtarifa=".$tarifa);
			return $query->result();
	}
	
	function firma_registra($corte)
	{
		$query = $this->db->query("select 
		c.registra,
		u.nombre+' '+u.apaterno+' '+u.amaterno as firmante,p.nombre_perfil as firmante_puesto
from cai_corte c
left join grl_usuario u on u.idusuario = c.registra
left join grl_usuario_perfil up on up.idusuario = u.idusuario
left join grl_perfil p on p.idperfil = up.idperfil
where c.idcorte=".$corte);
		return $query->result();	
	}
	
	function carga_aforos($corte,$plaza)
	{
		$query = $this->db->query("
		(SELECT 
dbo.cai_corte_detalle.total as total, 
dbo.grl_tipo_vehiculo.clave as clave,  
dbo.cai_tipo_pago.tipo_pago as tipo_pago, 
dbo.cai_tipo_pago_plaza.orden as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago INNER JOIN
                      dbo.grl_tipo_vehiculo_plaza ON dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo AND 
                      dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo
WHERE     (dbo.cai_corte.idcorte = ".$corte.") AND (dbo.cai_tarifa.idestado = 1) AND (dbo.cai_tarifa.idmoneda = 1) AND (dbo.cai_tipo_pago_plaza.idplaza = ".$plaza.") AND 
                      (dbo.grl_tipo_vehiculo_plaza.idplaza = ".$plaza."))
UNION
(SELECT 
SUM(dbo.cai_corte_detalle.total) as total, 
dbo.grl_tipo_vehiculo.clave as clave,  
'AFORO' as tipo_pago, 
'100' as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago INNER JOIN
                      dbo.grl_tipo_vehiculo_plaza ON dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo AND 
                      dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo
WHERE     (dbo.cai_corte.idcorte = ".$corte.") AND (dbo.cai_tarifa.idestado = 1) AND (dbo.cai_tarifa.idmoneda = 1) AND (dbo.cai_tipo_pago_plaza.idplaza = ".$plaza.") 
 AND 
                      (dbo.grl_tipo_vehiculo_plaza.idplaza = ".$plaza.")
GROUP BY dbo.grl_tipo_vehiculo.clave)
UNION
(
SELECT 
SUM(dbo.cai_corte_detalle.total*dbo.grl_tipo_vehiculo.ejes) as total, 
dbo.grl_tipo_vehiculo.clave as clave,  
'EJES' as tipo_pago, 
'200' as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago INNER JOIN
                      dbo.grl_tipo_vehiculo_plaza ON dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo AND 
                      dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo
WHERE     (dbo.cai_corte.idcorte = ".$corte.") AND (dbo.cai_tarifa.idestado = 1) AND (dbo.cai_tarifa.idmoneda = 1) AND (dbo.cai_tipo_pago_plaza.idplaza = ".$plaza.") AND 
                      (dbo.grl_tipo_vehiculo_plaza.idplaza = ".$plaza.")
GROUP BY dbo.grl_tipo_vehiculo.clave
)
UNION
(
SELECT 
SUM(dbo.cai_corte_detalle.total*dbo.cai_tarifa_detalle.tarifa) as total, 
dbo.grl_tipo_vehiculo.clave as clave,  
'IMPORTE' as tipo_pago, 
'300' as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago INNER JOIN
                      dbo.grl_tipo_vehiculo_plaza ON dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo AND 
                      dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo
WHERE     (dbo.cai_corte.idcorte = ".$corte.") AND (dbo.cai_tarifa.idestado = 1) AND (dbo.cai_tarifa.idmoneda = 1) AND (dbo.cai_tipo_pago_plaza.idplaza = ".$plaza.") AND (dbo.cai_corte_detalle.idtipo_pago NOT IN(2,8,9)) AND 
                      (dbo.grl_tipo_vehiculo_plaza.idplaza = ".$plaza.")
GROUP BY dbo.grl_tipo_vehiculo.clave
)
ORDER BY orden");
			return $query->result();
	}
	
	function carga_totales($corte,$caseta)
	{
		$query=$this->db->query("(SELECT
dbo.cai_tipo_pago.clave,
SUM(dbo.cai_corte_detalle.total) as total,   
dbo.cai_tipo_pago_plaza.orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago
WHERE     (dbo.cai_corte.idcorte = ".$corte.") 
AND (dbo.cai_tarifa.idestado = 1) 
AND (dbo.cai_tarifa.idmoneda = 1) 
AND (dbo.cai_tipo_pago_plaza.idplaza = ".$caseta.")
AND (dbo.cai_corte_detalle.idtipo_vehiculo NOT IN (5,19,20))  
GROUP BY dbo.cai_tipo_pago.clave,dbo.cai_tipo_pago_plaza.orden)
UNION ALL
(SELECT
'AFORO' as clave,
SUM(dbo.cai_corte_detalle.total) as total,   
'100' as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago
WHERE     (dbo.cai_corte.idcorte = ".$corte.") 
AND (dbo.cai_tarifa.idestado = 1) 
AND (dbo.cai_tarifa.idmoneda = 1) 
AND (dbo.cai_tipo_pago_plaza.idplaza = ".$caseta.")
AND (dbo.cai_corte_detalle.idtipo_vehiculo NOT IN (5,19,20)))
UNION ALL
(SELECT
'EJES' as clave,
SUM(dbo.cai_corte_detalle.total*dbo.grl_tipo_vehiculo.ejes) as total,   
'200' as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago
WHERE     (dbo.cai_corte.idcorte = ".$corte.") 
AND (dbo.cai_tarifa.idestado = 1) 
AND (dbo.cai_tarifa.idmoneda = 1) 
AND (dbo.cai_tipo_pago_plaza.idplaza = ".$caseta.")
AND (dbo.cai_corte_detalle.idtipo_vehiculo NOT IN (5)))
UNION
(SELECT
'IMPORTE' as clave,
SUM(dbo.cai_corte_detalle.total*dbo.cai_tarifa_detalle.tarifa) as total,   
'300' as orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago
WHERE     (dbo.cai_corte.idcorte = ".$corte.") 
AND (dbo.cai_tarifa.idestado = 1) 
AND (dbo.cai_tarifa.idmoneda = 1) 
AND (dbo.cai_tipo_pago_plaza.idplaza = ".$caseta.")
AND (dbo.cai_corte_detalle.idtipo_pago NOT IN (9,8,2))
)
ORDER BY orden");
		return $query->result();
	}
	
	public function carga_importes_e($corte,$caseta)
	{
		$query=$this->db->query("SELECT 
SUM(dbo.cai_corte_detalle.total*dbo.cai_tarifa_detalle.tarifa) as total, 
dbo.grl_tipo_vehiculo.clave,  
'IMPORTE' as tipo_pago, 
dbo.grl_tipo_vehiculo_plaza.orden
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago INNER JOIN
                      dbo.grl_tipo_vehiculo_plaza ON dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo AND 
                      dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo
WHERE     (dbo.cai_corte.idcorte = ".$corte.") AND (dbo.cai_tarifa.idestado = 1) AND (dbo.cai_tarifa.idmoneda = 2) AND (dbo.cai_tipo_pago_plaza.idplaza = ".$caseta.") 
AND (dbo.cai_corte_detalle.idtipo_pago IN(2)) AND 
                      (dbo.grl_tipo_vehiculo_plaza.idplaza = ".$caseta.")
GROUP BY dbo.grl_tipo_vehiculo.clave,dbo.grl_tipo_vehiculo_plaza.orden
ORDER BY orden");
		return $query->result();
	}
	
	function carga_totales_e($corte,$caseta)
	{
		$query = $this->db->query("SELECT 
SUM(dbo.cai_corte_detalle.total*dbo.cai_tarifa_detalle.tarifa) as total,  
'IMPORTE' as tipo_pago
FROM         dbo.cai_tipo_pago INNER JOIN
                      dbo.cai_corte INNER JOIN
                      dbo.cai_corte_detalle ON dbo.cai_corte.idcorte = dbo.cai_corte_detalle.idcorte INNER JOIN
                      dbo.cai_corte_tarifa ON dbo.cai_corte.idcorte = dbo.cai_corte_tarifa.idcorte INNER JOIN
                      dbo.cai_tarifa ON dbo.cai_corte_tarifa.idtarifa = dbo.cai_tarifa.idtarifa INNER JOIN
                      dbo.cai_tarifa_detalle ON dbo.cai_tarifa.idtarifa = dbo.cai_tarifa_detalle.idtarifa INNER JOIN
                      dbo.grl_tipo_vehiculo ON dbo.cai_tarifa_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo AND 
                      dbo.cai_corte_detalle.idtipo_vehiculo = dbo.grl_tipo_vehiculo.idtipo_vehiculo ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_corte_detalle.idtipo_pago INNER JOIN
                      dbo.cai_tipo_pago_plaza ON dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago AND 
                      dbo.cai_tipo_pago.idtipo_pago = dbo.cai_tipo_pago_plaza.idtipo_pago INNER JOIN
                      dbo.grl_tipo_vehiculo_plaza ON dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo AND 
                      dbo.grl_tipo_vehiculo.idtipo_vehiculo = dbo.grl_tipo_vehiculo_plaza.idtipo_vehiculo
WHERE     (dbo.cai_corte.idcorte = ".$corte.") AND (dbo.cai_tarifa.idestado = 1) AND (dbo.cai_tarifa.idmoneda = 2) AND (dbo.cai_tipo_pago_plaza.idplaza = ".$caseta.") 
AND (dbo.cai_corte_detalle.idtipo_pago IN(2))
 AND 
                      (dbo.grl_tipo_vehiculo_plaza.idplaza = ".$caseta.")");
		return $query->result();
	}
	
}
/*
*end modules/login/models/index_model.php
*/