<?php
class Mant_ges_inc_model extends CI_Model{	
	
	public function __construct()
    {
        parent::__construct();   
    }
	
	function get_proyectos()
	{
		$query=$this->db->query("SELECT idproyecto,proyecto FROM [repseg].[dbo].[vw_opn_incidencias_clase_tipo_mensual] GROUP BY idproyecto,proyecto ORDER BY idproyecto ASC");
		return $query->result_array();
	}
	
	function get_proyecto($idproyecto)
	{
		$query=$this->db->query("SELECT idproyecto,proyecto FROM [repseg].[dbo].[vw_opn_incidencias_clase_tipo_mensual] WHERE idproyecto=".$idproyecto." GROUP BY idproyecto,proyecto ORDER BY idproyecto ASC");
		return $query->result_array();
	}
	
	function get_meses($idproyecto)
	{
		$query=$this->db->query("SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_incidencias_clase_tipo_mensual] WHERE idproyecto=".$idproyecto." GROUP BY anio,mes,serie ORDER BY anio DESC,mes DESC");
		return $query->result_array();
	}
	
	function get_clases_x($idproyecto,$serie)
	{
		$query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' GROUP BY idclase,clase,serie ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_clases_y($idproyecto,$serie)
	{
		$query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' GROUP BY idclase,clase ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_clases_x_filtro($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $clase, $tipo, $sub){
            
            $query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND anio>='".$yi."' AND anio<='".$yf."' AND dia>='".$di."' AND dia<='".$df."' AND mes>='".$mi."' AND mes<='".$mf."' ".$clase." ".$tipo." ".$sub." GROUP BY idclase,clase ORDER BY SUM(total_subtipo) DESC");
            return $query->result_array();	
	}
		
	function get_clases_y_filtro($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $clase, $tipo, $sub)
	{
            $query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND anio>='".$yi."' AND anio<='".$yf."' AND dia>='".$di."' AND dia<='".$df."' AND mes>='".$mi."' AND mes<='".$mf."' ".$clase." ".$tipo." ".$sub." GROUP BY idclase,clase ORDER BY SUM(total_subtipo) DESC");
            return $query->result_array();
	}
	
	function get_tipos_y($idproyecto,$serie,$tipo){
		$query=$this->db->query("SELECT idtipo,tipo,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND clase='".$tipo."' GROUP BY idtipo,tipo ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_tipos_y_filtro($idproyecto, $serie, $tipo, $di, $mi, $yi, $df, $mf, $yf){
            
            $query=$this->db->query("SELECT idtipo,tipo,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND clase='".$tipo."' AND anio>='".$yi."' AND anio<='".$yf."' AND dia>='".$di."' AND dia<='".$df."' AND mes>='".$mi."' AND mes<='".$mf."' GROUP BY idtipo,tipo ORDER BY SUM(total_subtipo) DESC");
            return $query->result_array();
	}
		
	function get_subtipos_y($idproyecto, $serie, $clase, $tipo){
            
            $query=$this->db->query("SELECT idsubtipo,subtipo,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND clase='".($clase)."' AND tipo='".($tipo)."' GROUP BY idsubtipo,subtipo ORDER BY SUM(total_subtipo) DESC");
            return $query->result_array();
	}
	
	function get_subtipos_y_filtro($idproyecto, $serie, $clase, $tipo, $mi, $yi, $mf, $yf, $di, $df)
	{
		$query=$this->db->query("SELECT idsubtipo,subtipo,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND clase='".($clase)."' AND tipo='".($tipo)."' AND anio>='".$yi."' AND anio<='".$yf."' AND mes>='".$mi."' AND mes<='".$mf."' GROUP BY idsubtipo,subtipo ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_mensual_clases($idproyecto)
	{
		$query=$this->db->query("SELECT idclase,clase FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_mensual] WHERE idproyecto=".$idproyecto." GROUP BY idclase,clase");
		return $query->result_array();
	}
	
	
	function get_incidencias_anual($idproyecto, $anio, $mes){
            
            $query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual] $idproyecto, $anio, $mes");
            return $query->result_array();
	}
	
	function get_incidencias_anual_filtro($idproyecto, $mi, $di, $yi, $mf, $df, $yf, $clase, $tipo, $sub){
            
            $query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual_filtro] $idproyecto, $mi, $di, $yi, $mf, $df, $yf, '$clase', '$tipo', '$sub'");
            return $query->result_array();
	}

	function get_incidencias_anual_tipo($idproyecto, $anio, $mes, $clase){
            
            $query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual_tipo] $idproyecto,$anio,$mes,'".utf8_encode($clase)."'");
            return $query->result_array();
	}
	
	function get_incidencias_anual_subtipo($idproyecto, $anio, $mes, $clase, $tipo){
            $query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual_subtipo] $idproyecto,$anio,$mes,'".utf8_encode($clase)."','".utf8_encode($tipo)."'");
            return $query->result_array();
	}
	
	function get_clases_x_scatter($idproyecto, $serie){
            
            $query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' GROUP BY idclase,clase,serie ORDER BY SUM(total_subtipo) DESC");
            return $query->result_array();
	}
	
	function get_clases_y_scatter($idproyecto,$anio,$mes)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_clase] $idproyecto,$anio,$mes");
		return $query->result_array();
	}	
	
	function get_tipos_x_scatter($idproyecto,$serie,$clase)
	{
		$query=$this->db->query("SELECT idtipo,tipo, SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND clase='".($clase)."' GROUP BY idtipo,tipo ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_tipos_y_scatter($idproyecto,$anio,$mes,$clase)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_tipo] $idproyecto,$anio,$mes,'$clase'");
		return $query->result_array();
	}	
	
	function get_subtipos_x_scatter($idproyecto,$serie,$clase,$tipo)
	{
		$query=$this->db->query("SELECT idsubtipo,subtipo, SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND clase='".($clase)."' AND tipo='".($tipo)."' GROUO BY idsubtipo,subtipo ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_subtipos_y_scatter($idproyecto,$anio,$mes,$clase,$tipo)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_subtipo] $idproyecto,$anio,$mes,'$clase','$tipo'");
		return $query->result_array();
	}
	
	//====================FUNCTIONES PARA SEGMENTOS
	
	function get_segmentos($idproyecto,$serie)
	{
		$where = "segmento is not null AND segmento!='' AND serie='".$serie."'";
		$query=$this->db->query("SELECT segmento FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_segmento_pkinicial_clase_mensual] WHERE ".$where." GROUP BY segmento ORDER BY segmento");		
		return $query->result_array();
	}
	
	function get_segmentos_filtro($idproyecto,$mi,$yi,$mf,$yf,$clase,$tipo,$subtipo)
	{
		$where = "segmento is not null AND segmento!='' AND anio>='".$yi."' AND anio<='".$yf."' AND mes>='".$mi."' AND mes<='".$mf."' ".$clase;
		$query=$this->db->query("SELECT segmento FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_segmento_pkinicial_clase_mensual] WHERE ".$where." GROUP BY segmento ORDER BY segmento");		
		return $query->result_array();
	}
	
	function get_clases_x_scatter_segmento($idproyecto,$serie,$segmento)
	{
		$query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_segmento_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND segmento='".$segmento."' GROUP BY idclase,clase,serie ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_clases_y_scatter_segmento($idproyecto,$anio,$mes,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_clase_segmento] $idproyecto,$anio,$mes,'$segmento'");
		return $query->result_array();
	}
	
	function get_clases_x_scatter_segmento_filtro($idproyecto,$mi,$yi,$mf,$yf,$clase,$tipo,$subtipo)
	{
		$query=$this->db->query("SELECT idclase,clase,SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_segmento_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND anio>='".$yi."' AND anio<='".$yf."' AND mes>='".$mi."' AND mes<='".$mf."' ".$clase." ".$tipo." ".$subtipo." GROUP BY idclase,clase,serie ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_clases_y_scatter_segmento_filtro($idproyecto,$mi,$di,$yi,$mf,$df,$yf,$clase,$tipo,$subtipo,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_clase_segmento_filtro] $idproyecto,$mi,$di,$yi,$mf,$df,$yf,'$clase','$tipo','$subtipo','$segmento'");
		return $query->result_array();
	}
		
	function get_tipos_x_scatter_segmento($idproyecto,$serie,$clase,$segmento)
	{
		$query=$this->db->query("SELECT idtipo,tipo, SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_segmento_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND clase='".($clase)."' AND segmento='".$segmento."' GROUP BY idtipo,tipo ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_tipos_y_scatter_segmento($idproyecto,$anio,$mes,$clase,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_tipo_segmento] $idproyecto,$anio,$mes,'".utf8_encode($clase)."','".utf8_encode($segmento)."'");
		return $query->result_array();
	}
		
	function get_subtipos_x_scatter_segmento($idproyecto,$serie,$clase,$tipo,$segmento)
	{
		$query=$this->db->query("SELECT idsubtipo,subtipo, SUM(total_subtipo) as total FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_segmento_pkinicial_mensual] WHERE idproyecto=".$idproyecto." AND serie='".$serie."' AND clase='".($clase)."' AND tipo='".($tipo)."' AND segmento='".$segmento."' GROUP BY idsubtipo,subtipo ORDER BY SUM(total_subtipo) DESC");
		return $query->result_array();
	}
	
	function get_subtipos_y_scatter_segmento($idproyecto,$anio,$mes,$clase,$tipo,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_subtipo_segmento] $idproyecto,$anio,$mes,'".utf8_encode($clase)."','".utf8_encode($tipo)."','".utf8_encode($segmento)."'");
		return $query->result_array();
	}
	
	function get_clases_segmento_xls($idproyecto,$anio,$mes,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_clase_segmento_xls] $idproyecto,$anio,$mes,'$segmento'");
		return $query->result_array();
	}
	
	function get_tipos_segmento_xls($idproyecto,$anio,$mes,$clase,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_tipo_segmento_xls] $idproyecto,$anio,$mes,'$clase','$segmento'");
		return $query->result_array();
	}
	
	function get_subtipos_segmento_xls($idproyecto,$anio,$mes,$clase,$tipo,$segmento)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_incidencias_mensual_subtipo_segmento_xls] $idproyecto,$anio,$mes,'$clase','$tipo','$segmento'");
		return $query->result_array();
	}
	
	function get_incidencias_anual_clase_xls($idproyecto,$anio,$mes)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual_clase_xls] $idproyecto,$anio,$mes");
		return $query->result_array();
	}
	
	function get_meses_clase($idproyecto,$anio,$mes)
	{
		$query = $this->db->query("SELECT * FROM  (
SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_mensual] WHERE anio=".$anio." AND mes<=".$mes." AND idproyecto=".$idproyecto." GROUP BY anio,mes,serie
UNION
SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_mensual] WHERE anio<".$anio." AND idproyecto=".$idproyecto." GROUP BY anio,mes,serie 
) as query
ORDER BY anio DESC, mes DESC");
		return $query->result_array();
	}
	
	function get_incidencias_anual_tipo_xls($idproyecto,$anio,$mes,$clase)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual_tipo_xls] $idproyecto,$anio,$mes,'$clase'");
		return $query->result_array();
	}
	
	function get_meses_tipo($idproyecto,$anio,$mes,$clase)
	{
		$query = $this->db->query("SELECT * FROM  (
SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_mensual] WHERE anio=".$anio." AND mes<=".$mes." AND idproyecto=".$idproyecto." AND clase='".$clase."' GROUP BY anio,mes,serie
UNION
SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_mensual] WHERE anio<".$anio." AND idproyecto=".$idproyecto." AND clase='".$clase."' GROUP BY anio,mes,serie 
) as query
ORDER BY anio DESC, mes DESC");
		return $query->result_array();
	}
	
	function get_incidencias_anual_subtipo_xls($idproyecto,$anio,$mes,$clase,$tipo)
	{
		$query = $this->db->query("EXEC [repseg].[dbo].[sp_opn_sgwc_desplegar_intervenciones_anual_subtipo_xls] $idproyecto,$anio,$mes,'$clase','$tipo'");
		return $query->result_array();
	}
	
	function get_meses_subtipo($idproyecto,$anio,$mes,$clase,$tipo)
	{
		$query = $this->db->query("SELECT * FROM  (
SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE anio=".$anio." AND mes<=".$mes." AND idproyecto=".$idproyecto." AND clase='".$clase."' AND tipo='".$tipo."' GROUP BY anio,mes,serie
UNION
SELECT anio,mes,serie FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE anio<".$anio." AND idproyecto=".$idproyecto." AND clase='".$clase."' AND tipo='".$tipo."' GROUP BY anio,mes,serie 
) as query
ORDER BY anio DESC, mes DESC");
		return $query->result_array();
	}
	
	function get_desplega_clases($di, $mi, $yi, $df, $mf, $yf, $idproyecto){
            
            $query = $this->db->query("SELECT idclase,clase FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND anio>='".$yi."' AND anio<='".$yf."' AND dia>='".$di."' AND dia<='".$df."' AND mes>='".$mi."' AND mes<='".$mf."' GROUP BY idclase,clase ORDER BY clase");	
            return $query->result_array();
	}
	
	function get_desplega_tipos($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $idclase){
            
            $query = $this->db->query("SELECT idtipo,tipo FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND anio>='".$yi."' AND anio<='".$yf."' AND dia>='".$di."' AND dia<='".$df."' AND mes>='".$mi."' AND mes<='".$mf."' AND idclase=".$idclase." GROUP BY idtipo,tipo ORDER BY tipo");	
            return $query->result_array();	
	}
	
	function get_desplega_subtipos($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $idclase, $idtipo)
	{
		$query = $this->db->query("SELECT idsubtipo,subtipo FROM [repseg].[dbo].[vw_opn_sgwc_incidencias_por_clase_tipo_subtipo_mensual] WHERE idproyecto=".$idproyecto." AND anio>='".$yi."' AND anio<='".$yf."' AND dia>='".$di."' AND dia<='".$df."' AND mes>='".$mi."' AND mes<='".$mf."' AND idclase=".$idclase." AND idtipo=".$idtipo." GROUP BY idsubtipo,subtipo ORDER BY subtipo");	
		return $query->result_array();		
	}
}