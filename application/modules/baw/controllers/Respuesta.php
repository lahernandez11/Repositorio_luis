<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Respuesta extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('respuesta_model');  
    }
	
	public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data["menu_baw"] = $this->menu->crea_menu_baw($data['idperfil'],$data['iduser']);
			$data['css'] = '<link href="'.base_url('assets/css/summernote.css').'" rel="stylesheet">';			
			$data['css'] .= '<link href="'.base_url('assets/css/summernote-bs3.css').'" rel="stylesheet">';
			
			$data['js'] = '<script src="'.base_url('assets/js/summernote.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/baw.js').'"></script>';
			
			$data["proyectos"] = $this->respuesta_model->proyecto();
			$data["tipos"] = $this->respuesta_model->tipo_solicitud();
			$this->template->load('template','respuesta',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	      
    }
	
	public function carga_respuesta()
	{		
		$tipo=$this->input->post('tipo');
		$proyecto=$this->input->post('proyecto');
		$data["resultados"]=$this->respuesta_model->carga_respuesta($tipo,$proyecto);
		if(sizeof($data["resultados"])>0):
			$data["valor"]=$data["resultados"][0]["idrespuesta_automatica"];
		else:
			$data["valor"]=0;
		endif;
		$this->load->view('respuesta_automatica',$data);
	}
	
	public function registrar()
	{
		$session_data = $this->session->userdata();
		$data['iduser'] = $session_data['id'];
		$accion=$this->input->post('accion');	
		$tipo=$this->input->post('tipo');	
		$asunto=$this->input->post('asunto');
		$idproyecto=$this->input->post('idproyecto');	
		$texto=$this->input->post('texto');	
		$asunto=($asunto);
		$texto=($texto);	
		$data["result"] = $this->respuesta_model->inserta_respuesta($accion,$tipo,$asunto,$texto,$data['iduser'],$idproyecto);
		$new = $data["result"][0]["mensaje"];
		if($new=="1"):
			echo 'Se agrego el comentario correctamente';
		else:
			echo 'Ocurrion un error';
		endif; 
	}
	
	public function muestra_texto()
	{		
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data["menu_mp"] = $this->menu->crea_menu_mp($data['idperfil'],$data['iduser']);
			$data['css'] = '';
			$data['js'] = '';
			
			$data["resultados"] = $this->respuesta_model->muestra_texto(1);
			$this->template->load('template','muestra_texto',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	 		
	}
	
}
/*
*end modules/login/controllers/index.php
*/