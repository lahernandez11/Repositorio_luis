<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class notificacion extends MX_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('grl/general_model');
		$this->load->model('area_model');
		$this->load->model('notificacion_model');  
    }
    
    public function index()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/bom.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['plazas'] = $this->general_model->desplega_plazas_usuario($session_data['id']);
			$data['areas'] = $this->area_model->desplega_areas_activas();
			$data['clasificaciones'] = $this->area_model->desplega_clasificaciones();
			$data["tipo"] = $this->notificacion_model->select_tiporeporte();
			$data["cla"] = $this->notificacion_model->select_clasificacion();
			$this->template->load('template','notificacion',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 		      
    }
	
	public function carga_usuarios_origen()
	{
		$tipo=$this->input->post('tipo');
		$cla=$this->input->post('cla');
		$pasos=$this->input->post('pasos');
		$data['utodos'] = $this->notificacion_model->muestra_usuarios_origen($tipo,$cla,$pasos);
		$this->load->view('notificacion_usuarios_origen',$data);
	}
	
	public function carga_usuarios_destino()
	{
		$tipo=$this->input->post('tipo');
		$cla=$this->input->post('cla');
		$pasos=$this->input->post('pasos');
		$data['utodos'] = $this->notificacion_model->muestra_usuarios_destino($tipo,$cla,$pasos);
		$this->load->view('notificacion_usuarios_destino',$data);
	}
	
	public function carga_pasos()
	{
		$data['pasos']=$this->notificacion_model->muestra_pasos();
		$div='PASOS <select id="select_pasos" name="tipo" class="form-control">
        	<option value="0">- SELECCIONE -</option>';
            foreach($data['pasos'] as $p):
            	$div.='<option value="'.$p["idmenu"].'">'.$p['nombre_menu'].'</option>';
            endforeach;
        $div.='</select>';		
		echo $div;
	}
	public function addcorreo()
	{
		$idusu=$this->input->get('idusu');
		$idtipo=$this->input->get('idtipo');
		$idcla=$this->input->get('idcla');
		$pasos=$this->input->get('pasos');
		$data['result']=$this->notificacion_model->addcorreo($idusu,$idtipo,$idcla,$pasos);
		$this->load->view('notificacion_mensaje_json_view',$data);	
	}
	
	public function removecorreo()
	{
		$id=$this->input->get('id');
		$data['result']=$this->notificacion_model->removecorreo($id);
		$this->load->view('notificacion_mensaje_json_view',$data);	
	}
}
?>