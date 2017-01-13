<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Pasos extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('pasos_model');
		$this->load->model('grl/general_model');
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data['carriles']=$this->pasos_model->desplega_carril($data['iduser']);
			$this->template->load('template','pasos',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function tipo_residente()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data['carril'] = $this->input->post('registro-carril');
			$data['turno'] = $this->input->post('registro-turno');
					
			$this->template->load('template','tipo_residente_paso',$data);   
			
		else:
			redirect('login/index', 'refresh');
		endif; 		
	}
	
	public function registro_paso()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data['carril'] = $this->input->get('carril');
			$data['turno'] = $this->input->get('turno');
			$data['comercial'] = $this->input->get('comercial');
					
			$data['carriles']=$this->pasos_model->nombre_carril($data['carril'],$data['iduser']);
			$data['vehiculos']=$this->pasos_model->desplega_vehiculo($data['carriles'][0]['idplaza']);
			$data['idplaza']=$data['carriles'][0]['idplaza'];
			$data['idcarril']=$data['carril'];
			$this->template->load('template','registro_paso',$data);   
			
		else:
			redirect('login/index', 'refresh');
		endif; 		
	}
	
	public function guarda_registro()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$placas = $this->input->post('placas');
			$ife = $this->input->post('ife');
			$vehiculo = $this->input->post('vehiculo');
			$turno = $this->input->post('turno');
			$idcarril = $this->input->post('idcarril');
			$idplaza = $this->input->post('idplaza');
			$comercial = $this->input->post('comercial');
				
			$result=$this->pasos_model->guarda_registro($placas,$ife,$vehiculo,$data['iduser'],$_SERVER['REMOTE_ADDR'],$turno,date('Y-m-d'),date('H:i:s'),$idcarril,$idplaza,$comercial);  
			
			echo "<div class='form-group'><div align='center'>";
			if($result[0]['mensaje']=='Error'):				
				echo "Ocurrio un error, intentalo nuevamente";
			else:
				if($result[0]['info']=='existe'):
					echo "RESIDENTE: ".$result[0]['nombre'];				
					echo "<br/>No.IFE:".$ife;
					echo "<br/><img width='200' height='200' src='".base_url("documents/res/".$result[0]['i_frente'])."'>";
					echo "<img width='200' height='200' src='".base_url("documents/res/".$result[0]['i_atras'])."'>";
					
				elseif($result[0]['info']=='residente'):
					echo "SE REGISTRO EL RESIDENTE, NO HAY DATOS QUE MOSTRAR.";
				endif;
				echo "<br/><br/>Registro correcto";
			endif;
			echo "</div></div>
				  <div class='form-group'>
                  	<div align='center'>
                    	<button type='submit' class='btn btn-success'>Cerrar</button>
                    </div>
                  </div>";
		else:
			redirect('login/index', 'refresh');
		endif; 		
	}
	
}
/*
*end modules/login/controllers/index.php
*/