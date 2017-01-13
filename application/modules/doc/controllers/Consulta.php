<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Consulta extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('consulta_model');  
		$this->load->model('programacion_model');
    }
	
	public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);			
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['css'] .= '<link href="'.base_url('assets/css/infragistics.theme.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/infragistics.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/bootstrap-select.min.css').'" rel="stylesheet" />';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script> ';			
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-select.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/doc-con.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/jquery-form.js').'"></script>';
			
			$this->template->load('template','consulta_tareas',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	      
    }
	
	public function contratos()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$contratos = $this->programacion_model->desplegar_contratos($data["iduser"]);
			$datasource = array();
			foreach ($contratos as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);		
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function categorias()
	{
		$idcontrato = $this->input->get('idcontrato');
		$categorias = $this->consulta_model->desplegar_categorias($idcontrato);
		$datasource = array();
		foreach ($categorias as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);	
	}
	
	public function subcategorias()
	{
		$idcontrato = $this->input->get('idcontrato');		
		$subcategorias = $this->consulta_model->desplegar_subcategorias($idcontrato);
		$datasource = array();
		foreach ($subcategorias as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);	
	}
	
	public function estados()
	{
		$idcontrato = $this->input->get('idcontrato');		
		$estados = $this->consulta_model->desplegar_estados($idcontrato);
		$datasource = array();
		foreach ($estados as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);	
	}
	
	public function desplegar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			
			$id = $this->input->get('id');
			$idcategoria = $this->input->get('idcategoria');
			$idsubcategoria = $this->input->get('idsubcategoria');
			$idcontrato = $this->input->get('idcontrato');
			$idestado = $this->input->get('idestado');
			$fecha_inicio = $this->input->get('fecha_inicio');
			$fecha_fin = $this->input->get('fecha_fin');
			
			if($id==''):
				$consulta = "WHERE idcontrato IN(".$idcontrato.")";
				if($idcategoria<>0):
					$consulta .= " AND idcat_categoria IN (".$idcategoria.")";
				endif;
				if($idsubcategoria<>0):
					$consulta .= " AND idcat_subcategoria IN (".$idsubcategoria.")";
				endif;
				if($idestado<>0):
					$consulta .= " AND idestado_actividad IN (".$idestado.")";
				endif;
				if($fecha_inicio<>""):
					$consulta .=" AND fecha >='".$fecha_inicio."'";
				endif;
				if($fecha_fin<>""):
					$consulta .=" AND fecha <='".$fecha_fin."'";
				endif;
			else:
				$consulta = "WHERE p.idprogramacion = ".$id;
			endif;
			
			
			
			$tareas = $this->consulta_model->desplegar_actividades($consulta,$data['iduser']);
			$datasource = array();
			foreach ($tareas as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
}
/*
*end modules/login/controllers/index.php
*/