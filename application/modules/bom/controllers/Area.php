<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Area extends MX_Controller
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
			$data['areas'] = $this->area_model->desplega_areas();
			$this->template->load('template','area',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  
		      
    }
	
	public function carga_falla()
	{
		$area = $this->input->post('area');
		$elementos = $this->area_model->desplega_area($area);
		$data["area"]=$elementos[0]->nombre_area;
		$data["idarea"]=$elementos[0]->idareaafectacion;
		$data['fallas'] = $this->area_model->desplega_fallas_area($area);
		$data['clasificaciones'] = $this->area_model->desplega_clasificaciones();
		$this->load->view('area_falla',$data);
	}
	
	public function agrega_area()
	{
		$area = $this->input->get('area');
		$data["result"] = $this->area_model->agrega_area($area);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
	}
	
	public function modifica_area()
	{
		$idarea = $this->input->get('idarea');
		$area = $this->input->get('area');
		$data["result"] = $this->area_model->modifica_area($idarea,$area);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
	}
	
	public function agrega_falla()
	{
		$idarea = $this->input->get('idarea');
		$falla = $this->input->get('falla');
		$idclasificacion = $this->input->get('idclasificacion');
		$data["result"] = $this->area_model->agrega_falla($idarea,$falla,$idclasificacion);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
		//echo '{"msg":"1"}';
	}
	
	public function modifica_falla()
	{
		$idfalla = $this->input->get('idfalla');
		$falla = $this->input->get('falla');
		$idclasificacion = $this->input->get('idclasificacion');
		$data["result"] = $this->area_model->modifica_falla($idfalla,$falla,$idclasificacion);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
	}
	
}
/*
*end modules/login/controllers/index.php
*/