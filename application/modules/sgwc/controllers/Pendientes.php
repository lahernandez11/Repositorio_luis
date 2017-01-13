<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Pendientes extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('menu');		
		$this->load->model('pendiente_model');
	}

	public function index()
	{		
		$this->load->model('reporte_model');
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['user']=$session_data['usuario'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js']='<script src="'.base_url('assets/js/incidencia.js').'"></script>';	
			$data['proyectos']=$this->reporte_model->desplega_proyecto_permiso($data['iduser']);
			
			$this->template->load('template','incidencia_pendientes',$data);
		else:
			redirect('login/index','refresh');
		endif;
	
	}

	public function carga_pendientes()
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['user']=$session_data['usuario'];			
			
			$proyecto=$this->input->get('proyecto');			
			$data['clases']=$this->pendiente_model->desplega_clase($proyecto);
			$data['clasesd']=$this->pendiente_model->desplega_clase_notificacion($proyecto);			
			
			$this->load->view('pendientes_view',$data);
		else:
			redirect('login/index','refresh');
		endif;
	
	}	
	
	public function tipos()
	{		
		$idclase = $this->input->get('idclase');
		$idbase = $this->input->get('idbase');
		$contratos = $this->pendiente_model->desplega_tipo($idclase,$idbase);
		$datasource = array();
		foreach ($contratos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	
	}
	
	public function tipos_destino()
	{		
		$idclase = $this->input->get('idclase');
		$idbase = $this->input->get('idbase');
		$contratos = $this->pendiente_model->desplega_tipo_destino($idclase,$idbase);
		$datasource = array();
		foreach ($contratos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	
	}
	
	public function subtipos()
	{		
		$idtipo = $this->input->get('idtipo');
		$idbase = $this->input->get('idbase');
		$contratos = $this->pendiente_model->desplega_subtipo($idtipo,$idbase);
		$datasource = array();
		foreach ($contratos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	
	}
	
	public function subtipos_destino()
	{		
		$idtipo = $this->input->get('idtipo');
		$idbase = $this->input->get('idbase');
		$contratos = $this->pendiente_model->desplega_subtipo_destino($idtipo,$idbase);
		$datasource = array();
		foreach ($contratos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	
	}
	
	public function muestra_clases()
	{
		$idbase = $this->input->post('idbase');
		$contenedor ='';
		$class='';
		$type='';
		$subtype='';
		//CLASES				
		if (isset($_POST['cl'])){
			$arregloclase=$_POST['cl'];		
			foreach($arregloclase as $clase):
				$info = $clase.",";
				$class .= $info;
			endforeach;		
			$class = trim($class, ',');
			$clases=$this->pendiente_model->muestra_clases($class,$idbase);	
			
			foreach ($clases as $clase):
				$contenedor .= "-CLASE: ".$clase->clase."<br>";		
			endforeach;
		}
		
		//TIPOS
		if (isset($_POST['t'])){
			$arreglotipo=$_POST['t'];
			foreach($arreglotipo as $tipo):
				$info = $tipo.",";		
				$type .= $info;
			endforeach;
			$type = trim($type,',');
			$tipos=$this->pendiente_model->muestra_tipos($type,$idbase);
			
			foreach ($tipos as $tipo):
				$contenedor .= "-TIPO: ".$tipo->title."<br>";		
			endforeach;	
		}
		
		//SUBTIPOS
		if (isset($_POST['s'])){
			$arreglosub=$_POST['s'];
			foreach($arreglosub as $subtipo):
				$info = $subtipo.",";
				$subtype .= $info;
			endforeach;
			$subtype = trim($subtype,',');
			$subtipos=$this->pendiente_model->muestra_subtipos($subtype,$idbase);		
				
			foreach ($subtipos as $subtipo):
				$contenedor .= "-SUBTIPO: ".$subtipo->title."<br>";		
			endforeach;

		}
		echo $contenedor;
	}	
	
	public function muestra_unidad_tiempo()
	{
		$tiempos= $this->pendiente_model->muestra_unidad_tiempo();		
		$combo ='<select name="tiempo" id="tiempo" class="form-control required">
					<option value="0">-- SELECCIONE --</option>';
		foreach ($tiempos as $tiempo):
			$combo .='<option value="'.$tiempo->idtiempo.'">'.$tiempo->tiempo.'</option>';
		endforeach;
		$combo.='</select>';
		echo $combo;
		
	}
	
	public function agregar_notificacion()
	{
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			
			$idbase = $this->input->get('idbase');			
			$valor = $this->input->get('valor');			
			$tiempo = $this->input->get('tiempo');			
			$id='';
			$indicador='';			
			//CLASES				
			if (isset($_GET['cl'])){
				$arregloclase=$_GET['cl'];		
				foreach($arregloclase as $clase):
					$info = $clase.",";
					$id .= $info;
					$indicador .= 'C,';
				endforeach;					
			}
			
			//TIPOS
			if (isset($_GET['t'])){
				$arreglotipo=$_GET['t'];		
				foreach($arreglotipo as $tipo):
					$info = $tipo.",";
					$id .= $info;
					$indicador .= 'T,';
				endforeach;					
			}
			
			//SUBTIPOS
			if (isset($_GET['s'])){
				$arreglosubtipo=$_GET['s'];		
				foreach($arreglosubtipo as $subtipo):
					$info = $subtipo.",";
					$id .= $info;
					$indicador .= 'S,';
				endforeach;					
			}			
	
			$inserta=$this->pendiente_model->agregar_notificacion($idbase,$indicador,$id,$tiempo,$valor,$data['usuario']);			
			if($inserta[0]["mensaje"]==1):
				echo '{"msg":"ok"}';
			else:
				echo '{"msg":"ko"}';
			endif;
			
		else:
			redirect('login/index','refresh');
		endif;
		
	}
	
	public function eliminar_notificacion()
	{
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			
			$idbase = $this->input->get('idbase');
			
			$id='';				
			//CLASES				
			if (isset($_GET['cl_d'])){
				$arregloclase=$_GET['cl_d'];		
				foreach($arregloclase as $clase):
					$info = $clase.",";
					$id .= $info;					
				endforeach;					
			}
			
			//TIPOS
			if (isset($_GET['t_d'])){
				$arreglotipo=$_GET['t_d'];		
				foreach($arreglotipo as $tipo):
					$info = $tipo.",";
					$id .= $info;
				endforeach;					
			}
			
			//SUBTIPOS
			if (isset($_GET['s_d'])){
				$arreglosubtipo=$_GET['s_d'];		
				foreach($arreglosubtipo as $subtipo):
					$info = $subtipo.",";
					$id .= $info;
				endforeach;					
			}			
			
			$eliminar= $this->pendiente_model->eliminar_notificacion($id);
			if($eliminar[0]["mensaje"]==1):
				echo '{"msg":"ok"}';
			else:
				echo '{"msg":"ko"}';
			endif;
			
			
		else:
			redirect('login/index','refresh');
		endif;
	}
	
	public function cambia_estado()
	{
		$id = $this->input->get('id');		
		$idestado = $this->input->get('idestado');
		
		$cambia = $this->pendiente_model->cambia_estado($id,$idestado);
		if ($cambia[0]["mensaje"]==1):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;	
	}
	
	public function busca_notificacion()
	{
		$id = $this->input->get('id');		
		$indicador= $this->input->get('indicador');
		$datos = $this->pendiente_model->busca_notificacion($id,$indicador);
		$datasource = array();
		foreach ($datos as $resultado):
			//$datasource[]=array_map('utf8_encode', $resultado);
			$datasource[]=($resultado);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function modifica_datos()
	{
		$idnotificacion = $this->input->get('idnotificacion');
		$valor = $this->input->get('valor');
		$tiempo = $this->input->get('tiempo');
		
		$modifica = $this->pendiente_model->modifica_datos($idnotificacion,$valor,$tiempo);
		if($modifica[0]["mensaje"]==1):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
			
	}
	
	
	
	
	
}
?>