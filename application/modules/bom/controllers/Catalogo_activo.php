<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Catalogo_activo extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('catalogo_activo_model'); 
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
			$data['js'] = '<script src="'.base_url('assets/js/bom.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script> ';
			$data['js'] .= '<script src="'.base_url('assets/js/modernizr.min.js').'"></script> ';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';	
			$data['js'] .='<script src="'.base_url('assets/js/jquery.btechco.excelexport.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/jquery.base64.js').'"></script>';		
			$data['js'] .= '<script src="'.base_url('assets/js/bom_catalogo_activo.js').'"></script>';
			$data['equipos'] = $this->catalogo_activo_model->desplegar_equipos();
			//$data['marcas'] = $this->catalogo_activo_model->desplegar_marcas();
			$data['proyectos'] = $this->catalogo_activo_model->desplegar_proyectos();
			$data['areas'] = $this->catalogo_activo_model->desplegar_areas();
			$this->template->load('template','catalogo_activo',$data);
		else:
			redirect('login/index', 'refresh');
		endif;       
    }
	
	public function desplegar()
	{
		if($this->session->userdata('id')):
			$activos = $this->catalogo_activo_model->desplegar_activos();
			$datasource = array();
			foreach ($activos as $activo):
				//$datasource[]=array_map('utf8_encode', $activo);
				$datasource[]=($activo);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function deplegar_plazas()
	{
		if($this->session->userdata('id')):
			$idproyecto = $this->input->get('idproyecto');
			$plazas = $this->catalogo_activo_model->desplegar_plazas($idproyecto);
			$datasource = array();
			foreach ($plazas as $plaza):
				//$datasource[]=array_map('utf8_encode', $plaza);
				$datasource[]=($plaza);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function desplegar_carriles()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idplaza = $this->input->get('idplaza');
			$carriles = $this->catalogo_activo_model->desplegar_carriles($idplaza,$data['iduser']);
			$datasource = array();
			foreach ($carriles as $carril):
				//$datasource[]=array_map('utf8_encode', $carril);
				$datasource[]=($carril);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	
	
	public function agregar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$equipo = $this->input->get('equipo');
			$marca = $this->input->get('marca');
			$modelo = $this->input->get('modelo');
			$serie = $this->input->get('serie');
			$simex = $this->input->get('simex');
			$observacion = $this->input->get('observacion');
			$proyecto = $this->input->get('proyecto');
			$plaza = $this->input->get('plaza');
			$ubicacion = $this->input->get('ubicacion');
			if(isset($_GET['carril'])):
    			$carril = $this->input->get('carril');
			else:
				$carril = 0;
			endif;
			$result = $this->catalogo_activo_model->agregar_activo($equipo,$marca,$modelo,$serie,$simex,$observacion,$proyecto,$plaza,$ubicacion,$carril,$data["usuario"]);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function buscar()
	{
		if($this->session->userdata('id')):
			$idactivo = $this->input->get('idactivo');
			$activos = $this->catalogo_activo_model->buscar_activo($idactivo);
			$datasource = array();
			foreach ($activos as $activo):
				//$datasource[]=array_map('utf8_encode', $activo);
				$datasource[]=($activo);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function editar()
	{
		if($this->session->userdata('id')):
			$idactivo = $this->input->get('idactivo');
			$equipo = $this->input->get('equipo');
			$marca = $this->input->get('marca');
			$modelo = $this->input->get('modelo');
			$serie = $this->input->get('serie');
			$simex = $this->input->get('simex');
			$observacion = ($this->input->get('observacion'));
			$proyecto = $this->input->get('proyecto');
			$plaza = $this->input->get('plaza');
			$ubicacion = $this->input->get('ubicacion');
			if(isset($_GET['carril'])):
    			$carril = $this->input->get('carril');
			else:
				$carril = 0;
			endif;
			$result = $this->catalogo_activo_model->editar_activo($idactivo,$equipo,$marca,$modelo,$serie,$simex,$observacion,$proyecto,$plaza,$ubicacion,$carril);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function cambiar()
	{
		if($this->session->userdata('id')):
			$idactivo = $this->input->get('idactivo');
			$idestado = $this->input->get('idestado');
			$result = $this->catalogo_activo_model->cambiar_estado_activo($idactivo,$idestado);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function busca_activo()
	{
		$idactivo = $this->input->get('idactivo');
		$activos = $this->catalogo_activo_model->busca_activo($idactivo);
		$datasource = array();
		foreach ($activos as $activo):
			//$datasource[]=array_map('utf8_encode', $activo);
			$datasource[]=($activo);
		endforeach;
		echo json_encode($datasource);
	}
	
	
}
/*
*end modules/login/controllers/index.php
*/