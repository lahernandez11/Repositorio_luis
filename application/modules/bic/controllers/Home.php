<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Home extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('administrar_model');
		$this->load->model('grl/general_model');    
    }
	
	public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/infragistics.theme.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/infragistics.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script> ';
			$data['js'] .= '<script src="'.base_url('assets/js/modernizr.min.js').'"></script> ';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/jquery.btechco.excelexport.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/jquery.base64.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bic.js').'"></script>';
			$data["proyectos"] = $this->general_model->desplega_lista_proyectos();
			$data["tipos"] = $this->administrar_model->desplega_tipos();
			$data["cuerpos"] = $this->administrar_model->desplega_cuerpos();
			$data["causas"] = $this->administrar_model->desplega_causas();
			$data["carriles"] = $this->administrar_model->desplega_carriles();
			$incidencias = $this->administrar_model->desplega_incidencias($data['iduser']);
			$datasource = array();
			foreach ($incidencias as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			$data["datasource"]=json_encode($datasource);
			$this->template->load('template','home',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	      
    }
	
	public function hitos()
	{
		$idproyecto = $this->input->get('idproyecto');
		$hitos = $this->administrar_model->desplega_hitos($idproyecto);
		$datasource = array();
		foreach ($hitos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function metros()
	{
		$idproyecto = $this->input->get('idproyecto');
		$metros = $this->administrar_model->desplega_metros($idproyecto);
		$datasource = array();
		foreach ($metros as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function agregar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idproyecto = $this->input->get('proyecto');
			$idcuerpo = $this->input->get('cuerpo');
			$km_min = $this->input->get('km_min');
			$km_max = $this->input->get('km_max');
			$ms_min = $this->input->get('ms_min');
			$ms_max = $this->input->get('ms_max');
			$idtipo_incidencia = $this->input->get('tipo');
			$idcausa = $this->input->get('causa');
			$fecha_inicio = $this->input->get('fecha_inicio');
			$fecha_fin = $this->input->get('fecha_fin');
			$hora_inicio = $this->input->get('hora_inicio');
			$hora_fin = $this->input->get('hora_fin');
			$notas = $this->input->get('notas');
			$carril = $this->input->get('carril');
			$carriles='';
			foreach($carril as $dato):
				$carriles = $carriles.$dato.';';
			endforeach;
			$result = $this->administrar_model->agregar_incidencia($idproyecto,$idcuerpo,$km_min,$km_max,$ms_min,$ms_max,$idtipo_incidencia,$idcausa,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_fin,$notas,$carriles,$data['iduser']);
			echo '{"msg":'.$result[0]['mensaje'].'}';
		else:
			redirect('login/index', 'refresh');
		endif;  
	}
	
	public function desplegar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$incidencias = $this->administrar_model->desplega_incidencias($data['iduser']);
			$datasource = array();
			foreach ($incidencias as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;  
	}
	
	public function eliminar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idincidencia = $this->input->get('idincidencia');
			$result = $this->administrar_model->eliminar_incidencia($idincidencia);
			echo '{"msg":'.$result[0]['mensaje'].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function consultar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idincidencia = $this->input->get('idincidencia');
			$result = $this->administrar_model->consultar_incidencia($idincidencia);
			$datasource = array();
			foreach ($result as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function editar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idproyecto = $this->input->get('proyecto');
			$idcuerpo = $this->input->get('cuerpo');
			$km_min = $this->input->get('km_min');
			$km_max = $this->input->get('km_max');
			$ms_min = $this->input->get('ms_min');
			$ms_max = $this->input->get('ms_max');
			$idtipo_incidencia = $this->input->get('tipo');
			$idcausa = $this->input->get('causa');
			$fecha_inicio = $this->input->get('fecha_inicio');
			$fecha_fin = $this->input->get('fecha_fin');
			$hora_inicio = $this->input->get('hora_inicio');
			$hora_fin = $this->input->get('hora_fin');
			$notas = $this->input->get('notas');
			$carril = $this->input->get('carril');
			$carriles='';
			foreach($carril as $dato):
				$carriles = $carriles.$dato.';';
			endforeach;
			$idincidencia = $this->input->get('idincidencia');
			$result = $this->administrar_model->editar_incidencia($idproyecto,$idcuerpo,$km_min,$km_max,$ms_min,$ms_max,$idtipo_incidencia,$idcausa,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_fin,$notas,$carriles,$idincidencia);
			echo '{"msg":'.$result[0]['mensaje'].'}';
		else:
			redirect('login/index', 'refresh');
		endif;  
	}
	
	public function consultar_incidencia_carril()
	{
		$idincidencia = $this->input->get('idincidencia');
		$result = $this->administrar_model->consultar_incidencia_carril($idincidencia);
		$datasource = array();
		foreach ($result as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	
	
}
/*
*end modules/login/controllers/index.php
*/