<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Permiso extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('permiso_model');
		$this->load->model('general_model');
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
			$data['css'] = '';
			$data['js'] = '';
			$data['perfiles'] = $this->general_model->desplega_lista_perfiles();
			$this->template->load('template','permiso',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  
		      
    }
	
	public function carga_permiso()
	{
		$data["perfil"] = $this->input->post('perfil');
		$data['permisos'] = $this->permiso_model->desplega_permisos($data['perfil']);
		$this->load->view('permiso_detalle',$data);
	}
	
	public function agregar()
	{
			$menu = $this->input->get('idmenu');
			$perfil = $this->input->get('idperfil');
			$data["result"] = $this->permiso_model->agrega($menu,$perfil);
			$new = $data["result"][0]["mensaje"];
			if($new=="Error"):
				echo '{"msg":"ko"}';
			else:
				echo '{"msg":"'.$new.'"}';
			endif;   
	}
	
	public function eliminar()
	{
		$menu = $this->input->get('idmenu');
		$perfil = $this->input->get('idperfil');
		$data["result"] = $this->permiso_model->elimina($menu,$perfil);
		$new = $data["result"][0]["mensaje"];
		if($new=="ok"):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	}
	
}
/*
*end modules/login/controllers/index.php
*/