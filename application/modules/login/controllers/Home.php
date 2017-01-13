<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Home extends MX_Controller
{
    
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('index_model');
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
			$data["menu_principal"] = $this->menu->crea_menu_principal($data['idperfil']);
			$data['css']='';
			$data['js']='';
			$this->template->load('template','home',$data);
		else:
			redirect('login/index', 'refresh');
		endif;       
    }
	
	
	public function cambiar_clave()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['username'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$actual = $this->input->get('actual');
			$nueva = $this->input->get('nueva');
			$confirmar = $this->input->get('confirmar');
			if($confirmar==$nueva):
				$data['actual'] = $this->index_model->verify_pass($data['iduser'],$actual);
				if($data['actual']>0):
					$data['cambio'] = $this->index_model->change_pass($data['iduser'],$nueva);
					if($data['cambio']>0):
						echo '{"kind":"success","msg":"La clave fue cambiada correctamente"}';
					else:
						echo '{"kind":"danger","msg":"Ocurri&oacute; un error, intente de nuevo"}';
					endif;
				else:
					echo '{"kind":"danger","msg":"La clave actual es incorrecta"}';
				endif;
			else:
				echo '{"kind":"danger","msg":"La clave nueva y la confirmacion son diferentes"}';
			endif;
			
   		else:
     		redirect('login', 'refresh');
   		endif;
	}
	
	
	function logout()
 	{
   		$this->session->unset_userdata();
   		session_destroy();
   		redirect('login/index', 'refresh');
 	}
}