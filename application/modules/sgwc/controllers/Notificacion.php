<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class notificacion extends MX_Controller
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
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['user']=$session_data['usuario'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js']='<script src="'.base_url('assets/js/incidencia.js').'"></script>';		
			$this->load->model('reporte_model');  		
			$data['proyectos']=$this->reporte_model->desplega_proyecto_permiso($data['iduser']);							
			$this->template->load('template','notificacion',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 		      
    }
	
	public function muestra_segmentos()
	{
		$this->load->model('reporte_model');  	
		$idbase=$this->input->get('idbase');	
		$segmentos=$this->reporte_model->desplega_segmentos($idbase);
		$div = '<label style="text-align:left" for="proyecto" class="control-label">Seleccione segmento: </label>
        <select id="segmento" name="segmento" class="form-control required">
			<option value="0">- SELECCIONE -</option>';
        	foreach($segmentos as $segmento):
				$div .='<option value="'.$segmento->tramoID.'">'.$segmento->tramo.'</option>';
			endforeach;                       
        $div .= '</select>';
		echo $div;
		
	}
	
	public function muestra_usuarios()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['user']=$session_data['usuario'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js']='<script src="'.base_url('assets/js/incidencia.js').'"></script>';	
		
			$idbase=$this->input->get('idbase');	
			$tramoID=$this->input->get('tramoID');	
			$d_usuarios=$this->notificacion_model->muestra_usuarios_destino($idbase,$tramoID);	
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
				//echo $query;
				
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
			$data["d_usuarios"]=$this->notificacion_model->muestra_usuarios_destino($idbase,$tramoID);	
			$this->load->view('notificacion_muestra_usuarios',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 				
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
			$idbase=$this->input->get('idbase');
			$tramoID=$this->input->get('tramoID');	
			$result=$this->notificacion_model->addcorreo($idusu,$idbase,$tramoID,$correo,$usuario,$data["usuario"]);			
			
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
		$idbase=$this->input->get('idbase');	
		$tramoID=$this->input->get('tramoID');	
		$result=$this->notificacion_model->removecorreo($id,$idbase,$tramoID);
		
		if($result[0]["mensaje"]>0):
			echo '{"kind":"green","msg":"Registro Exitoso"}';
		else:
			echo '{"kind":"red","msg":"Registro Erroneo"}';
		endif;
	}
}
?>