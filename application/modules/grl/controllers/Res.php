<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Res extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
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
			$data["menu_res"] = $this->menu->crea_menu_res($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$this->template->load('template','res',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	      
    }
	
}
/*
*end modules/login/controllers/index.php
*/