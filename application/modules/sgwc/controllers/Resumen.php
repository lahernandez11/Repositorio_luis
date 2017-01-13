<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
header('Content-Type: text/html; charset=utf-8');

class Resumen extends MX_Controller{
    
    public function __construct(){
		
        parent::__construct();
	$this->load->library('template');
	$this->load->library('menu');	
	$this->load->model('mant_ges_inc_model');			
    }
	
    public function index(){		
        
        if($this->session->userdata('id')):
            $session_data=$this->session->userdata();
            $data['usuario']=$session_data['username'];
            $data['iduser']=$session_data['id'];
            $data['idperfil']=$session_data['idperfil'];
            $data['menu']=$this->menu->crea_menu($data['idperfil']);
                    
            $data['css'] = '<link href="'.base_url('assets/css/bootstrap-select.min.css').'" rel="stylesheet">';
            $data['css'] .= '<link href="'.base_url('assets/css/jquery-ui.css').'" rel="stylesheet">';	
                    
            $data['js'] = '<script src="'.base_url('assets/js/bootstrap-select.min.js').'"></script>';	
            $data['js'] .='<script src="'.base_url('assets/js/man-ges-inc.js').'"></script>';				
            $data['js'] .='<script src="'.base_url('assets/js/highcharts.js').'"></script>';
            $data['js'] .='<script src="'.base_url('assets/js/highcharts-more.js').'"></script>';
            $data['js'] .='<script src="'.base_url('assets/js/data.js').'"></script>';
            $data['js'] .='<script src="'.base_url('assets/js/exporting.js').'"></script>';			
            $data['js'] .= '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script>';

            $this->template->load('template','resumen',$data);			
	else:
            redirect('login/index','refresh');
	endif;
    }
	
	public function proyectos()
	{
		$proyectos = $this->mant_ges_inc_model->get_proyectos();
		$datasource = array();
	   	foreach ($proyectos as $resultado):
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function meses()
	{
		$idproyecto = $this->input->get("idproyecto");
		$meses = $this->mant_ges_inc_model->get_meses($idproyecto);
		$datasource = array();
	   	foreach ($meses as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function clases_x()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clases = $this->mant_ges_inc_model->get_clases_x($idproyecto,$serie);
		$datasource = array();
	   	foreach ($clases as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function clases_y()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clases = $this->mant_ges_inc_model->get_clases_x($idproyecto,$serie);
		$datos = '[{ "name": "CLASES", "data": [';
		$n=1;
		foreach($clases as $clase):
			$coma =($n==1)?'':',';
			$datos.=$coma.'{"name":"'.$clase["clase"].'","y":'.$clase["total"].'}';
			$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function clases_x_filtro()
	{
            $mi = $this->input->get('mi');	
            $di = $this->input->get('di');	
            $yi = $this->input->get('yi');	
            $mf = $this->input->get('mf');	
            $df = $this->input->get('df');	
            $yf = $this->input->get('yf');
                
            $idproyecto =$this->input->get('idproyecto');
            $idclase =$this->input->get('idclase');
            $idtipo =$this->input->get('idtipo');
            $idsubtipo =$this->input->get('idsubtipo');	
		
            $clase = ($idclase == 0) ? '' : ' AND idclase='.$idclase;
            $tipo  = ($idtipo == 0) ? '' : ' AND idtipo='.$idtipo;
            $sub   = ($idsubtipo == 0) ? '' : 'AND idsubtipo='.$idsubtipo;
		
            $clases = $this->mant_ges_inc_model->get_clases_x_filtro($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $clase, $tipo, $sub);
            $datasource = array();
	   	
            foreach ($clases as $resultado):
                //$datasource[]=array_map('utf8_encode', $resultado);
                $datasource[]=($resultado);
            endforeach;
                
            echo json_encode($datasource);
	}
	
	public function clases_y_filtro(){
            
            $mi = $this->input->get('mi');	
            $di = $this->input->get('di');	
            $yi = $this->input->get('yi');	
            $mf = $this->input->get('mf');	
            $df = $this->input->get('df');	
            $yf = $this->input->get('yf');	
            
            $idproyecto =$this->input->get('idproyecto');
            $idclase =$this->input->get('idclase');
            $idtipo =$this->input->get('idtipo');
            $idsubtipo =$this->input->get('idsubtipo');	
		
            ($idclase==0) ? $clase='' : $clase=' AND idclase='.$idclase;
            ($idtipo==0)  ? $tipo ='' : $tipo =' AND idtipo='.$idtipo;
            ($idsubtipo==0)? $sub ='' : $sub = 'AND idsubtipo='.$idsubtipo;
		
            $clases = $this->mant_ges_inc_model->get_clases_x_filtro($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $clase, $tipo, $sub);
            $datos = '[{ "name": "CLASES", "data": [';
            $n=1;
            
            foreach($clases as $clase):
                $coma =($n==1)?'':',';
                $datos.=$coma.'{"name":"'.$clase["clase"].'","y":'.$clase["total"].'}';
		$n++;
            endforeach;
            
            $datos.=']}]';
            
            echo $datos;
	}
	
	public function tipos_y()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$tipo = $this->input->get("tipo");
		$tipos = $this->mant_ges_inc_model->get_tipos_y($idproyecto,$serie,$tipo);
		$datos = '[{ "name": "TIPOS", "data": [';
		$n=1;
		foreach($tipos as $tipo):
			$coma =($n==1)?'':',';
			$datos.=$coma.'{"name":"'.$tipo["tipo"].'","y":'.$tipo["total"].'}';
			$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function tipos_y_filtro()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$tipo = $this->input->get("tipo");
		$mi = $this->input->get('mi');	
		$di = $this->input->get('di');	
		$yi = $this->input->get('yi');	
		$mf = $this->input->get('mf');	
		$df = $this->input->get('df');	
		$yf = $this->input->get('yf');	
		$tipos = $this->mant_ges_inc_model->get_tipos_y_filtro($idproyecto,$serie,$tipo,$mi,$yi,$mf,$yf);
		$datos = '[{ "name": "TIPOS", "data": [';
		$n=1;
		foreach($tipos as $tipo):
			$coma =($n==1)?'':',';
			$datos.=$coma.'{"name":"'.$tipo["tipo"].'","y":'.$tipo["total"].'}';
			$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function subtipos_y()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$tipo = $this->input->get("tipo");
		$clase = $this->input->get("clase");
		$subtipos = $this->mant_ges_inc_model->get_subtipos_y($idproyecto,$serie,$clase,$tipo);
		$datos = '[{ "name": "SUBTIPOS", "data": [';
		$n=1;
		foreach($subtipos as $subtipo):
			$coma =($n==1)?'':',';
			$datos.=$coma.'{"name":"'.$subtipo["subtipo"].'","y":'.$subtipo["total"].'}';
			$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function subtipos_y_filtro()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$tipo = $this->input->get("tipo");
		$clase = $this->input->get("clase");
		$mi = $this->input->get('mi');	
		$di = $this->input->get('di');	
		$yi = $this->input->get('yi');	
		$mf = $this->input->get('mf');	
		$df = $this->input->get('df');	
		$yf = $this->input->get('yf');	
		$subtipos = $this->mant_ges_inc_model->get_subtipos_y_filtro($idproyecto, $serie, $clase, $tipo, $di, $mi, $yi, $df, $mf, $yf);		
		$datos = '[{ "name": "SUBTIPOS", "data": [';
		$n=1;
		foreach($subtipos as $subtipo):
			$coma =($n==1)?'':',';
			$datos.=$coma.'{"name":"'.$subtipo["subtipo"].'","y":'.$subtipo["total"].'}';
			$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function anual()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$datos = $this->mant_ges_inc_model->get_incidencias_anual($idproyecto,$anio,$mes);
		$data='[';
			$n=1; foreach ($datos as $dato):
				$coma =($n==1)?$coma='':$coma=',';
				$data .= $coma.'{"val":'.$dato["val"].',"unit":"'.$dato["unit"].'","status":"'.$dato["status"].'"}';
			$n++; endforeach;
		$data.=']';
		echo $data;
	}
	
	public function anual_filtro()
	{
		$idproyecto = $this->input->get("idproyecto");
		$mi = $this->input->get('mi');	
		$di = $this->input->get('di');	
		$yi = $this->input->get('yi');	
		$mf = $this->input->get('mf');	
		$df = $this->input->get('df');	
		$yf = $this->input->get('yf');	
		$idclase =$this->input->get('idclase');
		$idtipo =$this->input->get('idtipo');
		$idsubtipo =$this->input->get('idsubtipo');
		
		$clase = ($idclase==0) ? '' : ' AND idclase='.$idclase;
		$tipo  = ($idtipo==0)  ? '' : ' AND idtipo='.$idtipo;
		$sub   =($idsubtipo==0)? '' : 'AND idsubtipo='.$idsubtipo;
		
		$datos = $this->mant_ges_inc_model->get_incidencias_anual_filtro($idproyecto,$mi,$di,$yi,$mf,$df,$yf,$clase,$tipo,$sub);
		$data='[';
			$n=1; foreach ($datos as $dato):
				$coma =($n==1)?$coma='':$coma=',';
				$data .= $coma.'{"val":'.$dato["val"].',"unit":"'.$dato["unit"].'","status":"'.$dato["status"].'"}';
			$n++; endforeach;
		$data.=']';
		echo $data;
	}
	
	public function anual_tipo()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$clase =utf8_decode($this->input->get("tipo"));
		$datos = $this->mant_ges_inc_model->get_incidencias_anual_tipo($idproyecto,$anio,$mes,$clase);
		$data='[';
			$n=1; foreach ($datos as $dato):
				$coma =($n==1)?$coma='':$coma=',';
				$data .= $coma.'{"val":'.$dato["val"].',"unit":"'.$dato["unit"].'","status":"'.$dato["status"].'"}';
			$n++; endforeach;
		$data.=']';
		echo $data;
	}
	
	public function anual_subtipo()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$clase =utf8_decode($this->input->get("clase"));
		$tipo =utf8_decode($this->input->get("tipo"));
		$datos = $this->mant_ges_inc_model->get_incidencias_anual_subtipo($idproyecto,$anio,$mes,$clase,$tipo);
		$data='[';
			$n=1; foreach ($datos as $dato):
				$coma =($n==1)?$coma='':$coma=',';
				$data .= $coma.'{"val":'.$dato["val"].',"unit":"'.$dato["unit"].'","status":"'.$dato["status"].'"}';
			$n++; endforeach;
		$data.=']';
		echo $data;
	}
	
	public function clases_x_scatter()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clases = $this->mant_ges_inc_model->get_clases_x_scatter($idproyecto,$serie);
		$datasource = array();
	   	foreach ($clases as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function clases_y_scatter()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$clases = $this->mant_ges_inc_model->get_clases_y_scatter($idproyecto,$anio,$mes);
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($clases as $clase):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$clase["clase"].',"y":'.$clase["km"].',"z":'.$clase["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($clase["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function tipos_x_scatter()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clase = $this->input->get("clase");
		$tipos = $this->mant_ges_inc_model->get_tipos_x_scatter($idproyecto,$serie,$clase);
		$data='[';
		$l=1;
		foreach ($tipos as $tipo):
			$coma =($l==1)?$coma='':$coma=',';
			$data .= $coma.'{"tipo":"'.utf8_encode($tipo["tipo"]).'"}';
		$l++;endforeach;
		$data.=']';
		echo $data;
	}
	
	public function tipos_y_scatter()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$clase = $this->input->get("clase");
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$tipos = $this->mant_ges_inc_model->get_tipos_y_scatter($idproyecto,$anio,$mes,utf8_decode($clase));
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($tipos as $tipo):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$tipo["tipo"].',"y":'.$tipo["km"].',"z":'.$tipo["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($tipo["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function subtipos_x_scatter()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clase = $this->input->get("clase");
		$tipo = $this->input->get("tipo");
		$subtipos = $this->mant_ges_inc_model->get_subtipos_x_scatter($idproyecto,$serie,$clase,$tipo);
		$data='[';
		$l=1;
		foreach ($subtipos as $subtipo):
			$coma =($l==1)?$coma='':$coma=',';
			$data .= $coma.'{"subtipo":"'.utf8_encode($subtipo["subtipo"]).'"}';
		$l++;endforeach;
		$data.=']';
		echo $data;
	}
	
	public function subtipos_y_scatter()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$clase = $this->input->get("clase");
		$tipo = $this->input->get("tipo");
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$subtipos = $this->mant_ges_inc_model->get_subtipos_y_scatter($idproyecto,$anio,$mes,utf8_decode($clase),utf8_decode($tipo));
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($subtipos as $subtipo):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$subtipo["subtipo"].',"y":'.$subtipo["km"].',"z":'.$subtipo["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($subtipo["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function get_nombre_mes($nombre)
	{
		switch ($nombre):
			case 'ENE':$mes=1;break;
			case 'FEB':$mes=2;break;
			case 'MAR':$mes=3;break;
			case 'ABR':$mes=4;break;
			case 'MAY':$mes=5;break;
			case 'JUN':$mes=6;break;
			case 'JUL':$mes=7;break;
			case 'AGO':$mes=8;break;
			case 'SEP':$mes=9;break;
			case 'OCT':$mes=10;break;
			case 'NOV':$mes=11;break;
			case 'DIC':$mes=12;break;
		endswitch;
		return $mes;
	}
	
	public function colorBubble($total){
		if($total<6):
			$color = '#7ad61d';
		elseif($total>=6 && $total<10):
			$color = '#5bb531';
		elseif($total>=10 && $total<15):
			$color = '#00923f';
		elseif($total>=15 && $total<20):
			$color = '#008b5e';
		elseif($total>=20 && $total<25):
			$color = '#00544b';
		else:
			$color = '#003c1f';
		endif;
		return $color;
	}
	
	//==============FUNCIONES PARA SEGMENTOS============================
	
	public function segmentos()
	{
		$idproyecto = $this->input->get('idproyecto');
		$serie = $this->input->get('serie');
		$segmentos = $this->mant_ges_inc_model->get_segmentos($idproyecto,$serie);
		$datasource = array();
	   	foreach ($segmentos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function segmentos_filtro()
	{
		$idproyecto = $this->input->get('idproyecto');
		$mi = $this->input->get('mi');	
		$di = $this->input->get('di');	
		$yi = $this->input->get('yi');	
		$mf = $this->input->get('mf');	
		$df = $this->input->get('df');	
		$yf = $this->input->get('yf');			
		$idclase =$this->input->get('idclase');
		$idtipo =$this->input->get('idtipo');
		$idsubtipo =$this->input->get('idsubtipo');
		
		$clase = ($idclase==0) ? '' : ' AND idclase='.$idclase;
		$tipo  = ($idtipo==0)  ? '' : ' AND idtipo='.$idtipo;
		$sub   =($idsubtipo==0)? '' : 'AND idsubtipo='.$idsubtipo;
		
		$segmentos = $this->mant_ges_inc_model->get_segmentos_filtro($idproyecto,$mi,$yi,$mf,$yf,$clase,$tipo,$subtipo);
		$datasource = array();
	   	foreach ($segmentos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function clases_x_scatter_segmento()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$segmento = $this->input->get("segmento");
		$clases = $this->mant_ges_inc_model->get_clases_x_scatter_segmento($idproyecto,$serie,$segmento);
		$datasource = array();
	   	foreach ($clases as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);
	}
	
	public function clases_y_scatter_segmento()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$segmento = $this->input->get("segmento");
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$clases = $this->mant_ges_inc_model->get_clases_y_scatter_segmento($idproyecto,$anio,$mes,$segmento);
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($clases as $clase):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$clase["clase"].',"y":'.$clase["km"].',"z":'.$clase["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($clase["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function clases_x_scatter_segmento_filtro()
	{
		$idproyecto = $this->input->get("idproyecto");
		$mi = $this->input->get('mi');	
		$di = $this->input->get('di');	
		$yi = $this->input->get('yi');	
		$mf = $this->input->get('mf');	
		$df = $this->input->get('df');	
		$yf = $this->input->get('yf');			
		$idclase =$this->input->get('idclase');
		$idtipo =$this->input->get('idtipo');
		$idsubtipo =$this->input->get('idsubtipo');
		
		$clase = ($idclase==0) ? '' : ' AND idclase='.$idclase;
		$tipo  = ($idtipo==0)  ? '' : ' AND idtipo='.$idtipo;
		$sub   =($idsubtipo==0)? '' : 'AND idsubtipo='.$idsubtipo;
		
		$clases = $this->mant_ges_inc_model->get_clases_x_scatter_segmento_filtro($idproyecto,$mi,$yi,$mf,$yf,$clase,$tipo,$subtipo);
		$datasource = array();
	   	foreach ($clases as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
	   	endforeach;
    	echo json_encode($datasource);		
	}
	
	public function clases_y_scatter_segmento_filtro()
	{
		$idproyecto = $this->input->get("idproyecto");
		$segmento = $this->input->get("segmento");
		$mi = $this->input->get('mi');	
		$di = $this->input->get('di');	
		$yi = $this->input->get('yi');	
		$mf = $this->input->get('mf');	
		$df = $this->input->get('df');	
		$yf = $this->input->get('yf');			
		$idclase =$this->input->get('idclase');
		$idtipo =$this->input->get('idtipo');
		$idsubtipo =$this->input->get('idsubtipo');
		
		$clase = ($idclase==0) ? '' : ' AND idclase='.$idclase;
		$tipo  = ($idtipo==0)  ? '' : ' AND idtipo='.$idtipo;
		$sub   =($idsubtipo==0)? '' : 'AND idsubtipo='.$idsubtipo;
		
		$clases = $this->mant_ges_inc_model->get_clases_y_scatter_segmento_filtro($idproyecto,$mi,$di,$yi,$mf,$df,$yf,$clase,$tipo,$subtipo,$segmento);
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($clases as $clase):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$clase["clase"].',"y":'.$clase["km"].',"z":'.$clase["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($clase["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;		
	}
	
	public function tipos_x_scatter_segmento()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clase = $this->input->get("clase");
		$segmento = $this->input->get("segmento");
		$tipos = $this->mant_ges_inc_model->get_tipos_x_scatter_segmento($idproyecto,$serie,$clase,$segmento);
		$data='[';
		$l=1;
		foreach ($tipos as $tipo):
			$coma =($l==1)?$coma='':$coma=',';
			$data .= $coma.'{"tipo":"'.$tipo["tipo"].'"}';
		$l++;endforeach;
		$data.=']';
		echo $data;
	}
	
	public function tipos_y_scatter_segmento()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$clase = $this->input->get("clase");
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$segmento = $this->input->get("segmento");
		$tipos = $this->mant_ges_inc_model->get_tipos_y_scatter_segmento($idproyecto,$anio,$mes,utf8_decode($clase),$segmento);
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($tipos as $tipo):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$tipo["tipo"].',"y":'.$tipo["km"].',"z":'.$tipo["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($tipo["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function subtipos_x_scatter_segmento()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = $this->input->get("serie");
		$clase = $this->input->get("clase");
		$tipo = $this->input->get("tipo");
		$segmento = $this->input->get("segmento");
		$subtipos = $this->mant_ges_inc_model->get_subtipos_x_scatter_segmento($idproyecto,$serie,$clase,$tipo,$segmento);
		$data='[';
		$l=1;
		foreach ($subtipos as $subtipo):
			$coma =($l==1)?$coma='':$coma=',';
			$data .= $coma.'{"subtipo":"'.$subtipo["subtipo"].'"}';
		$l++;endforeach;
		$data.=']';
		echo $data;
	}
	
	public function subtipos_y_scatter_segmento()
	{
		$idproyecto = $this->input->get("idproyecto");
		$serie = explode(" ",$this->input->get("serie"));
		$clase = $this->input->get("clase");
		$tipo = $this->input->get("tipo");
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$segmento = $this->input->get("segmento");
		$subtipos = $this->mant_ges_inc_model->get_subtipos_y_scatter_segmento($idproyecto,$anio,$mes,utf8_decode($clase),utf8_decode($tipo),$segmento);
		$datos = '[{ "name": "INCIDENCIAS", "data": [';
		$n=1;
		foreach($subtipos as $subtipo):
		$coma =($n==1)?'':',';
		$datos.=$coma.'{"x":'.$subtipo["subtipo"].',"y":'.$subtipo["km"].',"z":'.$subtipo["total"].',"fillColor":{
							"radialGradient": { "cx": 0.4, "cy": 0.3, "r": 0.7 },
							"stops": [
								[0, "rgba(255,255,255,1)"],
								[1, "Highcharts.Color(\''.$this->colorBubble($subtipo["total"]).'\').setOpacity(1).get(\'rgba\')"]
							]
						}}';
		$n++;
		endforeach;
		$datos.=']}]';
		echo $datos;
	}
	
	public function excel()
	{
		$nivel = $this->input->get_post('nivel');
		$idproyecto = $this->input->get_post('idproyecto');
		$serie = explode(' ',$this->input->get_post('serie'));
		$segmento = $this->input->get_post('segmento');
		$clase = $this->input->get_post('clase');
		$tipo = $this->input->get_post('tipo');
		$anio =$serie[0];
		$data["mes"] = $serie[1];
		$data["anio"] = $serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$proyecto  = $this->mant_ges_inc_model->get_proyecto($idproyecto);
		$data["clave"] = $proyecto[0]["proyecto"];
		if($nivel==1):
			$data["datos"] = $this->mant_ges_inc_model->get_clases_segmento_xls($idproyecto,$anio,$mes,$segmento);
			$data["nivel"]="clase";
		elseif($nivel==2):
			$data["datos"] = $this->mant_ges_inc_model->get_tipos_segmento_xls($idproyecto,$anio,$mes,utf8_decode($clase),$segmento);	
			$data["nivel"]="tipo";
		elseif($nivel==3):
			$data["datos"] = $this->mant_ges_inc_model->get_subtipos_segmento_xls($idproyecto,$anio,$mes,utf8_decode($clase),utf8_decode($tipo),$segmento);
			$data["nivel"]="subtipo";	
		endif;
		$data["segmento"]=$segmento;
		$data["clase"]=' '.$clase;
		$data["tipo"]=' '.$tipo;
		$this->load->view('xls_incidencias_segmento',$data);	
	}
	
	
	public function excel_int()
	{
		$nivel = $this->input->get_post('nivel');
		$idproyecto = $this->input->get_post('idproyecto');
		$serie_name = $this->input->get_post('serie');
		$serie = explode(' ',$this->input->get_post('serie'));
		$clase = $this->input->get_post('clase');
		$tipo = $this->input->get_post('tipo');
		$data["mes"] = $serie[1];
		$data["anio"] = $serie[0];
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$proyecto  = $this->mant_ges_inc_model->get_proyecto($idproyecto);
		$data["clave"] = $proyecto[0]["proyecto"];
		if($nivel==1):
			$data["datos"] = $this->mant_ges_inc_model->get_clases_x($idproyecto,$serie_name);
			$data["nivel"]="clase";
		elseif($nivel==2):
			$data["datos"] = $this->mant_ges_inc_model->get_tipos_y($idproyecto,$serie_name,$clase);
			$data["nivel"]="tipo";
		elseif($nivel==3):
			$data["datos"] = $this->mant_ges_inc_model->get_subtipos_y($idproyecto,$serie_name,$clase,$tipo);
			$data["nivel"]="subtipo";
		endif;
		$data["clase"]=' '.$clase;
		$data["tipo"]=' '.$tipo;
		$this->load->view('xls_intervenciones',$data);	
	}
	
	public function excel_comp()
	{
		$nivel = $this->input->get_post('nivel');
		$idproyecto = $this->input->get_post('idproyecto');
		$serie_name = $this->input->get_post('serie');
		$serie = explode(' ',$this->input->get_post('serie'));
		$clase = $this->input->get_post('clase');
		$tipo = $this->input->get_post('tipo');
		$data["mes"] = $serie[1];
		$data["anio"] = $serie[0];
		$anio =$serie[0];
		$mes = $this->get_nombre_mes($serie[1]);
		$proyecto  = $this->mant_ges_inc_model->get_proyecto($idproyecto);
		$data["clave"] = $proyecto[0]["proyecto"];
		if($nivel==1):
			$data["meses"] = $this->mant_ges_inc_model->get_meses_clase($idproyecto,$anio,$mes);
			$data["datos"] = $this->mant_ges_inc_model->get_incidencias_anual_clase_xls($idproyecto,$anio,$mes);
			$data["nivel"]="clase";
		elseif($nivel==2):
			$data["meses"] = $this->mant_ges_inc_model->get_meses_tipo($idproyecto,$anio,$mes,$clase);
			$data["datos"] = $this->mant_ges_inc_model->get_incidencias_anual_tipo_xls($idproyecto,$anio,$mes,$clase);
			$data["nivel"]="tipo";
		elseif($nivel==3):
			$data["meses"] = $this->mant_ges_inc_model->get_meses_subtipo($idproyecto,$anio,$mes,$clase,$tipo);
			$data["datos"] = $this->mant_ges_inc_model->get_incidencias_anual_subtipo_xls($idproyecto,$anio,$mes,$clase,$tipo);
			$data["nivel"]="subtipo";
		endif;
		$data["clase"]=' '.$clase;
		$data["tipo"]=' '.$tipo;
		$this->load->view('xls_comparativa',$data);	
	}
	
	public function desplega_clases()
	{
            $mi = $this->input->get('mi');	
            $di = $this->input->get('di');	
            $yi = $this->input->get('yi');	
            $mf = $this->input->get('mf');	
            $df = $this->input->get('df');	
            $yf = $this->input->get('yf');	
            $idproyecto =$this->input->get('idproyecto');
		
            $clases = $this->mant_ges_inc_model->get_desplega_clases($di, $mi, $yi, $df, $mf, $yf, $idproyecto);
            $datasource = array();
                
            foreach ($clases as $resultado):
                $datasource[]=($resultado);
            endforeach;
                
            echo json_encode($datasource);
	}
	
	public function desplega_tipos()
	{
            $mi = $this->input->get('mi');	
            $di = $this->input->get('di');	
            $yi = $this->input->get('yi');	
            $mf = $this->input->get('mf');	
            $df = $this->input->get('df');	
            $yf = $this->input->get('yf');	
            $idproyecto =$this->input->get('idproyecto');
            $idclase =$this->input->get('idclase');
		
            $tipos = $this->mant_ges_inc_model->get_desplega_tipos($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $idclase);
            $datasource = array();
            
            foreach ($tipos as $resultado):
                $datasource[]=($resultado);
            endforeach;
            
            echo json_encode($datasource);			
	}
	
	public function desplega_subtipos()
	{
            $mi = $this->input->get('mi');	
            $di = $this->input->get('di');	
            $yi = $this->input->get('yi');	
            $mf = $this->input->get('mf');	
            $df = $this->input->get('df');	
            $yf = $this->input->get('yf');	
            $idproyecto =$this->input->get('idproyecto');
            $idclase =$this->input->get('idclase');
            $idtipo =$this->input->get('idtipo');
		
            $tipos = $this->mant_ges_inc_model->get_desplega_subtipos($di, $mi, $yi, $df, $mf, $yf, $idproyecto, $idclase, $idtipo);
            $datasource = array();
            
            foreach ($tipos as $resultado):
                $datasource[]=($resultado);
            endforeach;
                
            echo json_encode($datasource);			
	}
	
}
?>