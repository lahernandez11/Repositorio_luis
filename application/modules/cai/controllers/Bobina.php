<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Bobina extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('bobina_model');
		$this->load->model('grl/general_model');
        $this->load->library('template');   
		$this->load->library('menu');
    }
    
    public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-table.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-table.js').'"></script>';
			$data['elementos'] = $this->bobina_model->desplega($session_data['id']);
			$data['plazas'] = $this->general_model->desplega_plazas_usuario($session_data['id']);
			$this->template->load('template','bobina',$data);    
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
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$data["title"] ='BOBINAS';
			$data["icon"]='fa-barcode';
			$data["link"]='cai/bobina/index';
			$inicial = $this->input->post('input1');
			$final = $this->input->post('input2');
			$serie = $this->input->post('input3');
			$idplaza = $this->input->post('input4');
			$result = $this->bobina_model->agrega($inicial,$final,$idplaza,$data["iduser"],$serie);
			$mensaje = $result[0]["mensaje"];
			if ($mensaje=='ok'):
				$data["result"]=1;
			else:
				$data["result"]=0;
			endif;
			$this->template->load('template','mensaje',$data);   
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
}
/*
*end modules/login/controllers/index.php
*/