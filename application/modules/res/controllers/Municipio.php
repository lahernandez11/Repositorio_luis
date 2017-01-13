<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Municipio extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('menu');
		$this->load->model('municipio_model');
	}
	
	public function index()
	{
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css']='';
			$data['js']='<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data['municipios'] = $this->municipio_model->desplega_municipios();
			$this->template->load('template','municipio',$data);
		else:
			redirect('login/index','refresh');
		endif;
	}
	
	public function agrega_municipio()
	{
		$municipio = $this->input->get('municipio');
		$data["result"] = $this->municipio_model->agrega_municipio($municipio);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif;
	}
	
	public function modifica_municipio()
	{
		$idmunicipio = $this->input->get('idmunicipio');
		$municipio = $this->input->get('municipio');
		$data["result"] = $this->municipio_model->modifica_municipio($idmunicipio,$municipio);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
	}
	
	public function carga_localidad()
	{
		$municipio = $this->input->post('municipio');
		$elementos = $this->municipio_model->desplega_municipio($municipio);
		$data["municipio"]=$elementos[0]->nombre_municipio;
		$data["idmunicipio"]=$elementos[0]->idmunicipio;
		$data['localidades'] = $this->municipio_model->desplega_localidades_municipio($municipio);
		$this->load->view('municipio_localidad',$data);
	}
	
	public function agrega_localidad()
	{
		$idmunicipio = $this->input->get('idmunicipio');
		$localidad = $this->input->get('localidad');
		$data["result"] = $this->municipio_model->agrega_localidad($idmunicipio,$localidad);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
	}
	
	public function modifica_localidad()
	{
		$idlocalidad = $this->input->get('idlocalidad');
		$localidad = $this->input->get('localidad');
		$data["result"] = $this->municipio_model->modifica_localidad($idlocalidad,$localidad);
		$new = $data["result"][0]["mensaje"];
		if($new=="Error"):
			echo '{"msg":"ko"}';
		else:
			echo '{"msg":"'.$new.'"}';
		endif; 
	}
}
?>