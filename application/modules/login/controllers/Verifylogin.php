<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
   		$this->load->model('index_model','',TRUE);
 	}

	function index()
 	{
	   $this->load->library('form_validation');
	   $this->form_validation->set_error_delimiters('<div style="color:darkred; font-size:10px;">', '</div>');
	   $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
	   $this->form_validation->set_rules('clave', 'Clave', 'trim|required|callback_check_database');
	
	   if($this->form_validation->run() == FALSE)
	   {
		   //echo 'Error';
		   $this->load->view('login');
		   }
		else
		{
			//echo 'Ingreso';
			redirect('login/home', 'refresh');
			}
	}

	function check_database($password)
	{
	   
	   $username = $this->input->post('usuario');
	   $result = $this->index_model->login($username, $password);
	   if($result)
	   {
			$sess_array = array();
		 	foreach($result as $row)
		 	{
		   		$sess_array = array(
			 	'id' => $row->idusuario,
			 	'username' => $row->descripcion,
				'usuario' => $row->usuario,
				'idperfil' => $row->idperfil
		   	);
		   	$this->session->set_userdata($sess_array);
		}
		 return TRUE;
	   	}
	   	else
	   	{
		 	$this->form_validation->set_message('check_database', 'Datos invalidos');
		 	return false;
	   	}
	}
}
