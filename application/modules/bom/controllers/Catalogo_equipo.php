<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Catalogo_equipo extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('catalogo_equipo_model'); 
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
			$data['js'] .= '<script src="'.base_url('assets/js/bom_catalogo_equipo.js').'"></script>';
			$this->template->load('template','catalogo_equipo',$data);
		else:
			redirect('login/index', 'refresh');
		endif;       
    }
	
	public function desplegar()
	{
		if($this->session->userdata('id')):
			$equipos = $this->catalogo_equipo_model->desplegar_equipos();
			$datasource = array();
			foreach ($equipos as $equipo):
				//$datasource[]=array_map('utf8_encode', $equipo);
				$datasource[]=($equipo);
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
			$equipo = trim($this->input->get('equipo'));
			$clave = trim($this->input->get('clave'));
			$result = $this->catalogo_equipo_model->agregar_equipo($equipo,$clave,$data["usuario"]);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function buscar()
	{
		if($this->session->userdata('id')):
			$idequipo = $this->input->get('idequipo');
			$equipos = $this->catalogo_equipo_model->buscar_equipo($idequipo);
			$datasource = array();
			foreach ($equipos as $equipo):
				//$datasource[]=array_map('utf8_encode', $equipo);
				$datasource[]=($equipo);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function editar()
	{
		if($this->session->userdata('id')):
			$idequipo = $this->input->get('idequipo');
			$equipo = trim($this->input->get('equipo'));
			$clave = trim($this->input->get('clave'));
			$result = $this->catalogo_equipo_model->editar_equipo($idequipo,($equipo),($clave));
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function cambiar()
	{
		if($this->session->userdata('id')):
			$idequipo = $this->input->get('idequipo');
			$idestado = $this->input->get('idestado');
			$result = $this->catalogo_equipo_model->cambiar_estado_equipo($idequipo,$idestado);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function busca_equipo()
	{
		$idequipo = $this->input->get('idequipo');
		$equipos = $this->catalogo_equipo_model->busca_equipo($idequipo);
		$datasource = array();
		foreach ($equipos as $equipo):
			//$datasource[]=array_map('utf8_encode', $equipo);
			$datasource[]=($equipo);
		endforeach;
		echo json_encode($datasource);
	}
}
/*
*end modules/login/controllers/index.php
*/