<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Subcategoria extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('subcategoria_model');  
		$this->load->model('grl/general_model');    
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
			$data['css'] = '<link href="'.base_url('assets/css/infragistics.theme.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/infragistics.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script> ';
			$data['js'] .= '<script src="'.base_url('assets/js/modernizr.min.js').'"></script> ';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/jquery.btechco.excelexport.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/jquery.base64.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/doc-subcat.js').'"></script>';
			$this->template->load('template','subcategoria',$data);
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
			$subcategoria = ($this->input->get('subcategoria'));
			$result = $this->subcategoria_model->agregar_subcategoria($subcategoria,$data["iduser"]);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function buscar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idsubcategoria = $this->input->get('idsubcategoria');
			$subcategorias = $this->subcategoria_model->desplegar_subcategoria($idsubcategoria);
			$datasource = array();
			foreach ($subcategorias as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;	
	}
	
	public function cancelar()
	{
		$estado = $this->input->get('estado');
		$idsubcategoria = $this->input->get('idsubcategoria');
		$result = $this->subcategoria_model->cambiar_estado_subcategoria($idsubcategoria,$estado);
		echo '{"msg":'.$result[0]["mensaje"].'}';
	}
	
	public function desplegar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$subcategorias = $this->subcategoria_model->desplegar_subcategorias();
			$datasource = array();
			foreach ($subcategorias as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}	
	
	public function editar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$subcategoria = ($this->input->get('subcategoria'));
			$idsubcategoria = $this->input->get('idsubcategoria');
			$result = $this->subcategoria_model->editar_subcategoria($idsubcategoria,$subcategoria);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
}