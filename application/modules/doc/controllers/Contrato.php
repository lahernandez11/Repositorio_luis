<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Contrato extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu'); 
		$this->load->model('contrato_model');  
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
			
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/doc.js').'"></script>';
			$data["proyectos"] = $this->general_model->desplega_lista_proyectos();
			$this->template->load('template','contrato',$data);
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
			$idproyecto = $this->input->post('proyecto');
			$numero = $this->input->post('numero');
			$descripcion = ($this->input->post('descripcion'));
			$finicio = $this->input->post('fecha_inicio');
			$ffin = $this->input->post('fecha_fin');
			$estado = $this->input->post('estado');
			if($_FILES['userfile']['name']!=''):
				$config['upload_path'] = './documents/doc/';
				//$config['allowed_types'] = 'pdf';
				$posicion = strpos($_FILES['userfile']['name'],'.') + 1;
				$extencion = substr($_FILES['userfile']['name'], $posicion);
				$config['allowed_types'] = $extencion;
				
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload()):
					$error = array('error' => $this->upload->display_errors());
					echo '<script>alert("Ocurrio un error, intente nuevamente");$("progress").attr({value:0,max:0});</script>';
				else:
					$datos = array('upload_data' => $this->upload->data());
					$archivo = $datos["upload_data"]["file_name"];	
					$result = $this->contrato_model->agregar_contrato($idproyecto,$numero,$descripcion,$finicio,$ffin,$estado,$archivo,$data['usuario']);
					if($result[0]["mensaje"]>0):
						echo '<script>alert("El contrato '.strtoupper($numero).' ha sido guardado");$("div#modal-alta-contrato").modal("hide");clearFields();loadTable();</script>';
					else:
						echo '<script>alert("Ocurrio un error, intente nuevamente");$("progress").attr({value:0,max:0});</script>';
					endif;
				endif;
			else:
				$result = $this->contrato_model->agregar_contrato($idproyecto,$numero,$descripcion,$finicio,$ffin,$estado,'',$data['usuario']);
				if($result[0]["mensaje"]>0):
					echo '<script>alert("El contrato '.strtoupper($numero).' ha sido guardado");$("div#modal-alta-contrato").modal("hide");clearFields();loadTable();</script>';
				else:
					echo '<script>alert("Ocurrio un error, intente nuevamente");$("progress").attr({value:0,max:0});</script>';
				endif;
			endif;
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function buscar()
	{
		$idcontrato = $this->input->get('idcontrato');
		$contratos = $this->contrato_model->desplegar_contrato($idcontrato);
		$datasource = array();
		foreach ($contratos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function cancelar()
	{
		$estado = $this->input->get('estado');
		$idcontrato = $this->input->get('idcontrato');
		$result = $this->contrato_model->cambiar_estado_contrato($idcontrato,$estado);
		echo '{"msg":'.$result[0]["mensaje"].'}';
	}
	
	public function desplegar()
	{
		$contratos = $this->contrato_model->desplegar_contratos();
		$datasource = array();
		foreach ($contratos as $resultado):
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
			$idproyecto = $this->input->post('proyecto');
			$numero = ($this->input->post('numero'));
			$descripcion = ($this->input->post('descripcion'));
			$finicio = $this->input->post('fecha_inicio');
			$ffin = $this->input->post('fecha_fin');
			$estado = $this->input->post('estado');
			$idcontrato = $this->input->post('idcontrato');
			if($_FILES['userfile']['name']!=''):
				$config['upload_path'] = './documents/doc/';
				//$config['allowed_types'] = 'pdf';

				$posicion = strpos($_FILES['userfile']['name'],'.') + 1;
				$extencion = substr($_FILES['userfile']['name'], $posicion);
				$config['allowed_types'] = $extencion;

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload()):
					$error = array('error' => $this->upload->display_errors());
					echo '<script>alert("Ocurrio un error, intente nuevamente");$("progress").attr({value:0,max:0});</script>';
				else:
					$datos = array('upload_data' => $this->upload->data());
					$archivo = $datos["upload_data"]["file_name"];	
					$result = $this->contrato_model->editar_contrato($idcontrato,$idproyecto,$numero,$descripcion,$finicio,$ffin,$estado,$archivo,$data['usuario']);
					if($result[0]["mensaje"]>0):
						echo '<script>alert("El contrato '.strtoupper($numero).' ha sido modificado");$("div#modal-alta-contrato").modal("hide");clearFields();loadTable();</script>';
					else:
						echo '<script>alert("Ocurrio un error, intente nuevamente");$("progress").attr({value:0,max:0});</script>';
					endif;
				endif;
			else:
				$result = $this->contrato_model->editar_contrato($idcontrato,$idproyecto,$numero,$descripcion,$finicio,$ffin,$estado,'',$data['usuario']);
				if($result[0]["mensaje"]>0):
					echo '<script>alert("El contrato '.strtoupper($numero).' ha sido modificado");$("div#modal-alta-contrato").modal("hide");clearFields();loadTable();</script>';
				else:
					echo '<script>alert("Ocurrio un error, intente nuevamente");$("progress").attr({value:0,max:0});</script>';
				endif;
			endif;
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	
	
}
/*
*end modules/login/controllers/index.php
*/