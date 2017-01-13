<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Plaza extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('plaza_model');
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
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-table.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-table.js').'"></script>';
			$data['elementos'] = $this->plaza_model->desplega();
			$data['proyectos'] = $this->general_model->desplega_lista_proyectos();
			$this->template->load('template','plaza',$data);
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
			$data["title"] ='Plazas';
			$data["icon"]='fa-sitemap';
			$data["link"]='grl/plaza/index';
			$proyecto = $this->input->post('input1');
			$plaza = $this->input->post('input2');
			$clave = $this->input->post('input3');
			$direccion = $this->input->post('input4');
			$data["result"] = $this->plaza_model->agrega($proyecto,$plaza,$clave,$direccion);
			$result = json_encode($data["result"]);
			if (strpos($result,'ok') !== false):
				$data["result"]=1;
			else:
				$data["result"]=0;
			endif;
			$this->template->load('template','mensaje',$data);   
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function estado()
	{
		$id = $this->input->get("id");
		$estado = $this->input->get("estado");
		if($estado==2):$new=1;else:$new=2;endif;
		$data["result"] = $this->plaza_model->estado($id,$new);
		if($data["result"]>0):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	}
    
	public function cambiar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$id = $this->input->post("id");
			$proyecto = $this->input->post("input1");
			$plaza = $this->input->post("input2");
			$clave = $this->input->post("input3");
			$direccion = $this->input->post("input4");
			$data["result"] = $this->plaza_model->cambia($id,$proyecto,$plaza,$clave,$direccion);
			$data["title"] ='Plazas';
			$data["icon"]='fa-sitemap';
			$data["link"]='grl/plaza/index';
			$this->template->load('template','mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
}
/*
*end modules/login/controllers/index.php
*/