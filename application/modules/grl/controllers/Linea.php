<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Linea extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('linea_model');
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
			$this->template->load('template','linea',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  
		      
    }
	
	public function carga_linea()
	{
		$plaza = $this->input->post('plaza');
		$data['lineas'] = $this->linea_model->desplega_linea_plaza($plaza);
		$this->load->view('linea_detalle',$data);
	}
	
	public function agregar()
	{
			$linea = $this->input->get('linea');
			$plaza = $this->input->get('plaza');
			$data["result"] = $this->linea_model->agrega($linea,$plaza);
			$new = $data["result"][0]["mensaje"];
			if($new=="Error"):
				echo '{"msg":"ko"}';
			else:
				echo '{"msg":"'.$new.'"}';
			endif;   
	}
	
	public function eliminar()
	{
		$linea = $this->input->get('id');
		$data["result"] = $this->linea_model->elimina($linea);
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
		$linea = $this->input->get('linea');
		$data["result"] = $this->linea_model->modifica($id,$linea);
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