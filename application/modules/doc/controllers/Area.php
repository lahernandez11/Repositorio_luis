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
		//$this->load->model('grl/general_model');    
    }
	
	public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/infragistics.theme.css').'" rel="stylesheet" />';
			$data['css'] .= '<link href="'.base_url('assets/css/infragistics.css').'" rel="stylesheet" />';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-ui.min.js').'"></script> ';
			$data['js'] .= '<script src="'.base_url('assets/js/modernizr.min.js').'"></script> ';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.core.js').'"></script>';
			$data['js'] .='<script src="'.base_url('assets/js/infragistics.lob.js').'"></script>';
			
			$data['js'] .= '<script src="'.base_url('assets/js/doc-area.js').'"></script>';
			$this->template->load('template','area',$data);
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
			$area = ($this->input->get('area'));
			$result = $this->area_model->agregar_area($area,$data["usuario"]);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function agregar_usuario()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$partes = explode('/',$this->input->get('usuario'));
			$idarea = $this->input->get('idarea');
			$idnivel = $this->input->get('nivel');
			$usuario = $partes[0];
			$correo = $partes[1];
			$result = $this->area_model->agregar_usuario($idarea,$idnivel,$usuario,$correo,$data['usuario']);
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
			$idarea_involucrada = $this->input->get('idarea');
			$areas = $this->area_model->desplegar_area($idarea_involucrada);
			$datasource = array();
			foreach ($areas as $resultado):
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
		$idarea = $this->input->get('idarea');
		$result = $this->area_model->cambiar_estado($idarea,$estado);
		echo '{"msg":'.$result[0]["mensaje"].'}';
	}
	
	public function cancelar_usuario()
	{
		$idnivel_area_usuario = $this->input->get('idnivel_area_usuario');
		$result = $this->area_model->cambiar_estado_usuario($idnivel_area_usuario);
		echo '{"msg":'.$result[0]["mensaje"].'}';
	}
		
	public function desplegar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$areas = $this->area_model->desplegar_areas();
			$datasource = array();
			foreach ($areas as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function desplegar_activas()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$areas = $this->area_model->desplegar_areas_activas();
			$datasource = array();
			foreach ($areas as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function desplegar_usuarios_intranet()
	{
		//CONEXION A INTRANET
			$connect = mysqli_connect('172.20.74.92', 'intranet_ghi','Int_GHi14','igh');
			if ($connect) 
			{ 
				$result=mysqli_query($connect,"SELECT idusuario,concat_ws(' ',nombre,apaterno,amaterno)as nombre,correo FROM usuario where usuario_estado = 2 and correo<>'' order by nombre,apaterno,amaterno ASC");
				$row=mysqli_num_rows($result);
				$datasource = array();
				for($j=0;$j<$row;$j++)
				{
					//$datasource[]=mysqli_fetch_array($result);
					//$datasource[]=array_map('utf8_encode', mysqli_fetch_array($result));
					$datasource[]=(mysqli_fetch_array($result));
					
				}
				echo json_encode($datasource);
			}
			else{exit;}
	}
	
	public function desplegar_usuarios_agregados()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$idarea=$this->input->get('idarea');
			$usuarios_agregados = $this->area_model->desplegar_usuarios_agregados($idarea);
			$datasource = array();
			foreach ($usuarios_agregados as $resultado):
				//$datasource[]=array_map('utf8_encode', $resultado);
				$datasource[]=($resultado);
			endforeach;
			echo json_encode($datasource);
		else:
			redirect('login/index', 'refresh');
		endif;
	}	
	
	public function desplegar_niveles()
	{
		$niveles = $this->area_model->desplegar_niveles();
		$datasource = array();
		foreach ($niveles as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function editar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$area = ($this->input->get('area'));
			$idarea = $this->input->get('idarea');
			$result = $this->area_model->editar_area($idarea,$area);
			echo '{"msg":'.$result[0]["mensaje"].'}';
		else:
			redirect('login/index', 'refresh');
		endif;
	}
}