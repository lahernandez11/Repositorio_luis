<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Pago extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('pago_model');
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
			$data['elementos'] = $this->pago_model->desplega();
			$this->template->load('template','pago',$data);    
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
			$data["title"] ='TIPOS DE PAGO';
			$data["icon"]='fa-credit-card';
			$data["link"]='cai/pago/index';
			$pago = $this->input->post('input1');
			$clave = $this->input->post('input2');
			$result = $this->pago_model->agrega($pago,$clave,$data["iduser"]);
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
	
	public function estado()
	{
		$id = $this->input->get("id");
		$estado = $this->input->get("estado");
		if($estado==2):$new=1;else:$new=2;endif;
		$data["result"] = $this->pago_model->estado($id,$new);
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
			$id = $this->input->post("id");
			$vehiculo = $this->input->post("input1");
			$clave = $this->input->post("input2");
			$result = $this->pago_model->cambia($id,$vehiculo,$clave);
			$mensaje = $result[0]["mensaje"];
			$data['css']='';
			$data['js']='';
			if ($mensaje=='ok'):
				$data["result"]=1;
			else:
				$data["result"]=0;
			endif;
			$data["title"] ='TIPOS DE PAGO';
			$data["icon"]='fa-credit-card';
			$data["link"]='cai/pago/index';
			$this->template->load('template','mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
}
/*
*end modules/login/controllers/index.php
*/