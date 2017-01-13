<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Sentido extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('sentido_model');
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
			$this->template->load('template','sentido',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  
		      
    }
	
	public function carga_cuerpo()
	{
		$data["plaza"] = $this->input->post('plaza');
		$data['cuerpos'] = $this->sentido_model->desplega_cuerpo_plaza($data["plaza"]);
		$this->load->view('sentido_cuerpo',$data);
	}
	
	public function carga_sentido()
	{
		$data["plaza"] = $this->input->post('plaza');
		$data["cuerpo"] = $this->input->post('cuerpo');
		$data['sentidos'] = $this->sentido_model->desplega_cuerpo_sentido($data["cuerpo"]);
		$this->load->view('sentido_detalle',$data);
	}
	
	public function agregar()
	{
			$cuerpo = $this->input->get('cuerpo');
			$sentido = $this->input->get('sentido');
			$data["result"] = $this->sentido_model->agrega($cuerpo,$sentido);
			$new = $data["result"][0]["mensaje"];
			if($new=="Error"):
				echo '{"msg":"ko"}';
			else:
				echo '{"msg":"'.$new.'"}';
			endif;   
	}
	
	public function eliminar()
	{
		$sentido = $this->input->get('id');
		$data["result"] = $this->sentido_model->elimina($sentido);
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
		$sentido = $this->input->get('sentido');
		$data["result"] = $this->sentido_model->modifica($id,$sentido);
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