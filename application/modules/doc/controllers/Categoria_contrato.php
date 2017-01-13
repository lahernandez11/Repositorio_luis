<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Categoria_contrato extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('categoria_contrato_model');  
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
			$data["contratos"] = $this->categoria_contrato_model->desplegar_contratos_activos($data['iduser']);
			$this->template->load('template','categoria_contrato',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	      
    }
	
	public function categorias()
	{
		$idcontrato = $this->input->get('idcontrato');
		$categorias = $this->categoria_contrato_model->desplegar_categorias($idcontrato);
		$datasource = array();
		foreach ($categorias as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);	
	}
	
	public function cambiar()
	{
		$idcategoria = $this->input->get('idcategoria');
		$idcontrato = $this->input->get('idcontrato');
		$idestado = $this->input->get('idestado');
		$result = $this->categoria_contrato_model->cambiar_categorias($idcategoria,$idcontrato,$idestado);
		echo '{"msg":"'.$result[0]['mensaje'].'"}';
	}
	
}