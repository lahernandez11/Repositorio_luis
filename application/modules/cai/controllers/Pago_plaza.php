<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Pago_plaza extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('pago_plaza_model');
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
			$data['js'] .= '<script src="'.base_url('assets/js/cai.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/jquery-ui-1.10.3.custom.js').'"></script>';
			$data['plazas'] = $this->general_model->desplega_plazas_usuario($session_data['id']);
			$this->template->load('template','pago_plaza',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function carga_pagos()
	{
		$idplaza=$this->input->post("idplaza");
		$data["idplaza"]=$idplaza;
		$data['pagos'] = $this->pago_plaza_model->desplega_pagos($idplaza);
		$this->load->view('pago_plaza_lista',$data);
	}
	
	public function cambiar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$idplaza=$this->input->get("idplaza");
			$idpago=$this->input->get("idpago");
			$estado=$this->input->get("estado");
			if($estado==1):
				$result = $this->pago_plaza_model->elimina($idpago,$idplaza);
			else:
				$result = $this->pago_plaza_model->agrega($idpago,$idplaza,$data["iduser"]);
			endif;
			$mensaje = $result[0]["mensaje"];
			echo '{"msg":"'.$mensaje.'"}';
		endif;
	}
	
	public function orden()
	{
		$idplaza=$this->input->post("idplaza");
		$data["idplaza"]=$idplaza;
		$data['pagos'] = $this->pago_plaza_model->desplega_pagos_plaza($idplaza);
		$this->load->view('pago_plaza_orden',$data);
	}
	
	public function ordenar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$Posiciones = '';
			$Pagos ='';
			$idplaza=$this->input->post("idplaza");
			$n=$this->input->post("n");
			for($i=1;$i<=$n;$i++):
				$Posiciones=$Posiciones.$this->input->post('orden'.$i).',';
				$Pagos=$Pagos.$this->input->post('idpago'.$i).',';
			endfor;
			$result = $this->pago_plaza_model->ordena_pagos_plaza($idplaza,$Pagos,$Posiciones,$data["iduser"]);
			echo $mensaje = $result[0]["mensaje"];
			if($mensaje=='ok'):
				echo '<h5><strong>Orden</strong></h5><div class="alert alert-success">
            			<i class="fa fa-check"></i> El orden ha sido guardado con &eacute;xito.
						</div>';
			else:
				echo '<h5><strong>Orden</strong></h5><div class="alert alert-danger">
            			<i class="fa fa-warning"></i> Ocurri&oacute; un error, intente nuevamente.
						</div>';
			endif;
		endif;
	}
	
}
/*
*end modules/login/controllers/index.php
*/