<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Usuario extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
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
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-table.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-table.js').'"></script>';
			$data['elementos'] = $this->usuario_model->desplega();
			$data['perfiles'] =$this->general_model->desplega_lista_perfiles();
			$data['plazas'] =$this->usuario_model->desplega_usuario_plaza($data['iduser']);
			$this->template->load('template','usuario',$data);
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
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$data["title"] ='Usuarios';
			$data["icon"]='fa-group';
			$data["link"]='grl/usuario/index';
			$nombre = $this->input->post('input1');
			$paterno = $this->input->post('input2');
			$materno = $this->input->post('input3');
			$correo = $this->input->post('input4');
			$usuario = $this->input->post('input6');
			$clave = $this->input->post('input7');
			$perfil = $this->input->post('input5');
			$elemento = $this->input->post("checkbox");
			$data["result"] = $this->usuario_model->agrega($nombre,$paterno,$materno,$correo,$usuario,$clave,$perfil);
			$new = $data["result"][0]["mensaje"];
			if($new=="Error"):
				$data["result"]=0;
			else:
				foreach($elemento as $checkbox):
					$data["result1"] = $this->usuario_model->agrega_usuario_plaza($new,$checkbox);
					$mensaje = $data["result1"][0]["mensaje"];
					if ($mensaje == "ok"):
						$data["result"]=1;
					else:
						$data["result"]=0;
					endif;
				endforeach;
			endif;
			/*if (strpos($result,'Error') === false):
				foreach($elemento as $checkbox):
					$data["result1"] = $this->usuario_model->agrega_usuario_plaza($new,$checkbox);
					$result1 = json_encode($data["result1"]);
					if (strpos($result1,'ok') !== false):
						$data["result"]=1;
					else:
						$data["result"]=0;
					endif;
					
				endforeach;
			else:
				$data["result"]=0;
			endif;*/
			$this->template->load('template','mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 
		   
	}
	
	/*public function estado()
	{
		$id = $this->input->get("id");
		$estado = $this->input->get("estado");
		if($estado==0):$new=1;else:$new=0;endif;
		$data["result"] = $this->perfil_model->estado($id,$new);
		if($data["result"]>0):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	}*/
    
	public function cambiar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			echo $id = $this->input->post("id");
			echo $nombre = $this->input->post('input1');
			echo $paterno = $this->input->post('input2');
			echo $materno = $this->input->post('input3');
			echo $correo = $this->input->post('input4');
			echo $usuario = $this->input->post('input6');
			echo $clave = $this->input->post('input7');
			echo $perfil = $this->input->post('input5');
			$elemento = $this->input->post("checkbox");
			$data["result"] = $this->usuario_model->cambia($id,$nombre,$paterno,$materno,$correo,$usuario,$clave,$perfil);
			foreach($elemento as $checkbox):
					$data["result1"] = $this->usuario_model->agrega_usuario_plaza($id,$checkbox);
					$mensaje = $data["result1"][0]["mensaje"];
					if ($mensaje == "ok"):
						$data["result"]=1;
					else:
						$data["result"]=0;
					endif;
			endforeach;
			$data["title"] ='Usuarios';
			$data["icon"]='fa-group';
			$data["link"]='grl/usuario/index';
			$this->template->load('template','mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
    
    public function carga_plazas()
	{
		$id = $this->input->get('idusuario');
		$json='[';
		$n=0;
			$plazas = $this->general_model->desplega_plazas_usuario($id);
			foreach($plazas as $plaza): 
			$n++;
			if($n==1):$coma='';else:$coma=',';endif;
			$json.=$coma.'{"idusaurio":"'.$id.'","idplaza":"'.$plaza->idplaza.'"}';
			endforeach;
		$json.=']';
		echo $json;
			/*echo '[
    		{ "plaza" : "CHAPULETEPEC", "idplaza" : "1" },
	 		{ "plaza" : "ATLACOMULCO", "idplaza" : "2" },
	 		{ "plaza" : "CHAPULETEPEC", "idplaza" : "3" }
    
  				]';*/
	}
}
/*
*end modules/login/controllers/index.php
*/