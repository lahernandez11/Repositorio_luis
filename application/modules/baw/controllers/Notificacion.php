<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Notificacion extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('notificacion_model');  
    }
	
	public function index()
    { 
		$this->load->model('respuesta_model');
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
			$this->template->load('template','notificacion',$data);
		else:
			redirect('login/index', 'refresh');
		endif;  	      
    }
	
	public function carga_usuario()
	{		
		$tipo=$this->input->get('tipo');
		$proyecto=$this->input->get('proyecto');
		
		$d_usuarios=$this->notificacion_model->muestra_usuarios_destino($tipo,$proyecto);
		//CONEXION A INTRANET
		$connect = mysqli_connect('172.20.74.92', 'intranet_ghi','Int_GHi14','igh');
		if ($connect) 
		{ 
			$query = "SELECT idusuario,concat_ws(' ',nombre,apaterno,amaterno)as nombre,correo FROM usuario where usuario_estado = 2 and correo<>'' AND idusuario NOT IN (";
			$nombres='';
			if(sizeof($d_usuarios)==0):
				$nombres .= '0';
			else:
				foreach($d_usuarios as $usuarios):
					$nombres .= $usuarios["idusuario"].",";
				endforeach;
					$nombres=trim($nombres,',');
			endif;
								
			$query .= $nombres;
							
			$query .= ") ORDER BY nombre,apaterno,amaterno ASC";
			$result=mysqli_query($connect,$query);
			$row=mysqli_num_rows($result);
			$datasource = array();
			for($j=0;$j<$row;$j++)
			{
				$datasource[]=mysqli_fetch_array($result);		
			}
			$data["datasource"]=$datasource;
		}
		else{exit;}
		$data["d_usuarios"]=$this->notificacion_model->muestra_usuarios_destino($tipo,$proyecto);	
		$this->load->view('notificacion_usuarios',$data);
	}
	
	public function addcorreo()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];			
		
			$idusu=$this->input->get('idusu');
			$correo=$this->input->get('correo');
			$usuario=$this->input->get('usuario');			
			$tipo=$this->input->get('tipo');
			$proyecto=$this->input->get('proyecto');	
			$result=$this->notificacion_model->addcorreo($idusu,$correo,$usuario,$data["usuario"],$tipo,$proyecto);			
			
			if($result[0]["mensaje"]=1):
				echo '{"kind":"green","msg":"Registro Exitoso"}';
			else:
				echo '{"kind":"red","msg":"Registro Erroneo"}';
			endif;
			
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function removecorreo()
	{
		$id=$this->input->get('id');		
		$tipo=$this->input->get('tipo');
		$proyecto=$this->input->get('proyecto');
		$result=$this->notificacion_model->removecorreo($id,$tipo,$proyecto);
		
		if($result[0]["mensaje"]>0):
			echo '{"kind":"green","msg":"Registro Exitoso"}';
		else:
			echo '{"kind":"red","msg":"Registro Erroneo"}';
		endif;
	}
}
/*
*end modules/login/controllers/index.php
*/