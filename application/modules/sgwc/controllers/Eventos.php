<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Eventos extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('menu');		
		$this->load->model('evento_model');
	}
		
	public function reporte_eventos()
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js']='';	
			$data["repfot_sub"] = $this->menu->crea_submenu_repfot($data['idperfil'],41);
			$this->template->load('template','reporte_eventos',$data);			
		else:
			redirect('login/index','refresh');
		endif;
	}

	
	public function estandares($pdf)
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['user']=$session_data['usuario'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js']='<script src="'.base_url('assets/js/repfoto_evento.js').'"></script>';	
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			$data['proyectos']=$this->evento_model->desplega_proyecto_permiso($data['iduser']);
			//$descripcion = $this->reporte_model->inserta_descripciones();
			if($pdf==1):
				$data["mensaje"]='<div id="alert" class="alert alert-success" role="alert"><h4>Reporte Fotogr&aacute;fico</h4>El reporte se ha creado.</div>';
			else:
				$data["mensaje"]='';
			endif;
			$this->template->load('template','eventos_estandares',$data);			
		else:
			redirect('login/index','refresh');
		endif;
	}
	
	public function carga_estandares()
	{
		$proyecto=$this->input->get('proyecto');		
		$data['fuentes']=$this->evento_model->desplega_fuentes($proyecto);		
		
		if($proyecto == 3){
			$json = file_get_contents("http://ns5002111.ip-192-99-17.net/sgwc_repfot/Actualizar_RepFot_Lugares.php");
			$segmentos = json_decode($json, true);
			foreach ($segmentos as $segmento) {
			    $existe = $this->evento_model->existe_segmentos($proyecto, $segmento['tramoID']);
			    if(!$existe){
			    	$this->evento_model->insert_segmentos($proyecto, $segmento['tramoID'], $segmento['tramo']);
			    }
			}			
		}
		$data['segmentos']=$this->evento_model->desplega_segmentos($proyecto);			
		$this->load->view('carga_estandares_e',$data);	
	}
	
	public function configuracion()
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';			
			$this->template->load('template','eventos_configuracion',$data);
			
		else:
			redirect('login/index','refresh');
		endif;
	}
	
	public function orden()
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '<script src="'.base_url('assets/js/repfoto_evento.js').'"></script>';
			$data['proyectos']=$this->evento_model->desplega_proyecto_permiso($data['iduser']);
			$this->template->load('template','eventos_orden',$data);
			
		else:
			redirect('login/index','refresh');
		endif;
	}
	
	public function numero_fotos()
	{
		$proyecto=$this->input->post('proyecto');
		$fotos=$this->evento_model->desplega_fotos($proyecto);
		$select='<select id="fotos" name="fotos" class="form-control letra10 required">
		<option value="00">- SELECCIONE -</option>';
		foreach($fotos as $foto):
			$select .= '<option value="'.$foto->idbase.'">'.$foto->alias.'</option>';            
		endforeach;
		$select .= '</select>';
		echo $select;
	}
	
	public function carga_ordenacion()
	{
		$proyecto=$this->input->post('proyecto');
		$fotos=$this->input->post('fotos');
		$data['ordenacion']=$this->evento_model->desplega_descripciones($proyecto,$fotos);
		$this->load->view('eventos_carga_ordenacion',$data);
	}
	
	public function modifica_orden()
	{
		$id=$this->input->get('proyecto');
		$fotos=$this->input->get('fotos');
		$iddesc="";
		$orden="";
		$desc="";
		for($i=1;$i<=$fotos;$i++){
			$des=$this->input->get('dd'.$i)==''?'':$this->input->get('dd'.$i).";";
			$iddes=$this->input->get('des'.$i)==''?'':$this->input->get('des'.$i).";";
			$ord=$this->input->get('orden'.$i)==''?'':$this->input->get('orden'.$i).";";
			$desc .= $des;
			$iddesc .= $iddes;
			$orden .= $ord;
		}
		$sin_espacio=str_replace(' ','',$desc);	
		$desc=utf8_decode($desc);
		$sin_espacio=utf8_decode($sin_espacio);	
		
		$modifica=$this->evento_model->modifica_orden($id,$fotos,$orden,$iddesc,$desc,$sin_espacio);
		if($modifica[0]["mensaje"]==1):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	}
	
	public function modifica_descripcion()
	{
		$id=$this->input->get('id');
		$descripcion=$this->input->get('descripcion');		
		$descripcion=utf8_decode($descripcion);
		$sin_espacio=str_replace(' ','',$descripcion);
		$modifica=$this->evento_model->modifica_descripcion($id,$descripcion,$sin_espacio);
		if($modifica[0]["mensaje"]==1):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
		
	}	
	
	public function descripcion()
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '<script src="'.base_url('assets/js/repfoto.js').'"></script>';
			$data['proyectos']=$this->reporte_model->desplega_proyecto();			
			$this->template->load('template','descripcion',$data);
			
		else:
			redirect('login/index','refresh');
		endif;
	}	
	
	public function carga_descripciones()
	{
		$proyecto=$this->input->post('proyecto');
		$fotos=$this->input->post('fotos');
		$data['descripciones']=$this->reporte_model->desplega_descripciones($proyecto,$fotos);
		$this->load->view('caraga_descripciones',$data);
	}
		
	public function firma()
	{
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '<script src="'.base_url('assets/js/repfoto.js').'"></script>';
			$data["firmas"]=$this->reporte_model->muestra_firmas();
			$data['proyectos']=$this->reporte_model->desplega_proyecto_permiso($data['iduser']);
			$this->template->load('template','firma',$data);
			
		else:
			redirect('login/index','refresh');
		endif;
	}
	
	public function datos_firma()
	{
		$idfirma=$this->input->get('idfirma');
		$firmas=$this->reporte_model->datos_firma($idfirma);
		$datasource = array();
		foreach ($firmas as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function agregar_firma()
	{
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			
			$proyecto = $this->input->post('proyecto');
			$nombre = $this->input->post('nombre');			
			$accion = $this->input->post('accion');	
			$puesto = $this->input->post('puesto');			
			$insert=$this->reporte_model->agregar_firma($accion,$proyecto,$nombre,$puesto,$data['usuario']);
			
			if($insert[0]["mensaje"]):
				echo 'ok';
			else:
				echo 'ko';
			endif;
		else:
			redirect('login/index','refresh');
		endif;
		
	}
	
	public function cambia_firma()
	{
		$idfirma=$this->input->get('idfirma');
		$idestado=$this->input->get('idestado');
		$cambia=$this->reporte_model->cambia_estado_firma($idfirma,$idestado);
		if($cambia[0]["mensaje"]):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	}
}
?>