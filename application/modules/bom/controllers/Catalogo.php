<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Catalogo extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('area_model'); 
    }
    
    public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '<script src="'.base_url('assets/js/bom.js').'"></script>';
			$this->template->load('template','catalogo',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  
		      
    }
	
	
}
/*
*end modules/login/controllers/index.php
*/