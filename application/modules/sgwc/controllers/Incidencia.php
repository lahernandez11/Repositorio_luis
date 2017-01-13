<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Incidencia extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('menu');				
	}
	
	public function index()
	{		
		if($this->session->userdata('id')):
			$session_data=$this->session->userdata();
			$data['usuario']=$session_data['username'];
			$data['iduser']=$session_data['id'];
			$data['idperfil']=$session_data['idperfil'];
			$data['menu']=$this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js']='';	
			$data["repfot_sub"] = $this->menu->crea_submenu_repfot($data['idperfil'],45);
			$this->template->load('template','incidencia',$data);			
		else:
			redirect('login/index','refresh');
		endif;
	}
	
}
?>