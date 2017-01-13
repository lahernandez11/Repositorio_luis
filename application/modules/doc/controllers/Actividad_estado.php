<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Actividad_estado extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('actividad_estado_model');  
		//$this->load->model('grl/general_model');    
    }
	
	public function info()
	{
		phpinfo();
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
			$data['js'] = '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script> ';
			$data['js'] .= '<script src="'.base_url('assets/js/modernizr.min.js').'"></script> ';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';
			
			$data['js'] .= '<script src="'.base_url('assets/js/doc-act-est.js').'"></script>';
			$this->template->load('template','actividad_estado',$data);
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
			$estado = $this->input->get('estado');
			$descripcion = $this->input->get('descripcion');
			$result = $this->actividad_estado_model->agregar_estado($estado,$descripcion,$data["usuario"]);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function buscar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idestado_actividad = $this->input->get('idestado_actividad');
			$estados = $this->actividad_estado_model->desplegar_estado($idestado_actividad);
			$datasource = array();
			foreach ($estados as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;	
	}
	
	public function cancelar()
	{
		$estado = $this->input->get('estado');
		$idestado_actividad = $this->input->get('idestado_actividad');
		$result = $this->actividad_estado_model->cambiar_estado($idestado_actividad,$estado);
		echo '{"msg":'.$result[0]["mensaje"].'}';
	}
		
	public function desplegar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$estados = $this->actividad_estado_model->desplegar_estados();
			$datasource = array();
			foreach ($estados as $resultado):
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
			$estado = $this->input->get('estado');
			$descripcion = $this->input->get('descripcion');
			$idestado_actividad = $this->input->get('idestado_actividad');
			$result = $this->actividad_estado_model->editar_estado($idestado_actividad,$estado,$descripcion);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
}