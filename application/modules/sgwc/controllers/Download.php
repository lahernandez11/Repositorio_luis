<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class download extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('menu');
		$this->load->library('ftp');				
		$this->load->model('reporte_model');
	}
	
	public function index()
	{		
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$user=$session_data['usuario'];
			
			$ftp = new Ftp();
			$conn_id=$ftp->ConectarFTP();			
			$data["archivos"] = ftp_nlist($conn_id, "/reportes_fotograficos/".$user); //VA A LA RUTA INDICADA
			$data['css'] = '';
			$data['js']='<script src="'.base_url('assets/js/repfoto.js').'"></script>';	
			$this->template->load('template','descarga',$data);

		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function descargar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$user=$session_data['usuario'];
			
			$archivo=$this->input->get('archivo');
			$ftp = new Ftp();
			$conn_id=$ftp->ConectarFTP();
			$local_file="C:/Users/Usuario/Downloads/".$archivo;
			$server_file="/reportes_fotograficos/".$user."/".$archivo;
			
			if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) :
				echo '{"msg":"ok"}';
			else:
				echo '{"msg":"ko"}';
			endif;			
						
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
}