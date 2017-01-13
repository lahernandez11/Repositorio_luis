<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Categoria_proyecto extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		//$this->load->model('contrato_model');  
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
			//$data["menu_doc"] = $this->menu->crea_menu_doc($data['idperfil'],$data['iduser']);
			$data['css'] = '';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/doc-cat.js').'"></script>';
			$data["proyectos"] = $this->general_model->desplega_lista_proyectos();
			$this->template->load('template','categoria_proyecto',$data);
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
			$categoria = $this->input->get('categoria');
			echo '{"msg":1}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
}