<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Notificacion extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('notificacion_model');  
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
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';
			
			$data['js'] .= '<script src="'.base_url('assets/js/doc-not.js').'"></script>';
			$this->template->load('template','notificacion',$data);
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
			$notificacion = $this->notificacion_model->desplegar_notificaciones();
			$datasource = array();
			foreach ($notificacion as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
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
			$id = $this->input->get('id');
			$notificacion = $this->notificacion_model->desplegar_notificacion($id);
			$datasource = array();
			foreach ($notificacion as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;	
	}
	
	public function modifcar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idnotificacion = $this->input->get('idnotificacion');
			$niveles = $this->input->get('nivel');
			foreach($niveles as $nivel):
				if(!$nivel):
				endif;
			endforeach;
			
		else:
			redirect('login/index', 'refresh');
		endif;			
	}	
	
}