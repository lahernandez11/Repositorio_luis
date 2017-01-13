<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Cuerpo extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('cuerpo_model');
		$this->load->model('usuario_model');
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
			$data['plazas'] = $this->usuario_model->desplega_usuario_plaza($data['iduser']);
			$this->template->load('template','cuerpo',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  
		      
    }
	
	public function carga_cuerpo()
	{
		$plaza = $this->input->post('plaza');
		$data['cuerpos'] = $this->cuerpo_model->desplega_cuerpo_plaza($plaza);
		$this->load->view('cuerpo_detalle',$data);
	}
	
	public function agregar()
	{
			$cuerpo = $this->input->get('cuerpo');
			$plaza = $this->input->get('plaza');
			$data["result"] = $this->cuerpo_model->agrega($cuerpo,$plaza);
			$new = $data["result"][0]["mensaje"];
			if($new=="Error"):
				echo '{"msg":"ko"}';
			else:
				echo '{"msg":"'.$new.'"}';
			endif;   
	}
	
	public function eliminar()
	{
		$cuerpo = $this->input->get('id');
		$data["result"] = $this->cuerpo_model->elimina($cuerpo);
		$new = $data["result"][0]["mensaje"];
		if($new=="ok"):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	} 
	
	public function modificar()
	{
		$id = $this->input->get('id');
		$cuerpo = $this->input->get('cuerpo');
		$data["result"] = $this->cuerpo_model->modifica($id,$cuerpo);
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