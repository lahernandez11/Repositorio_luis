<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Index extends MX_Controller
{
    
    public function __construct()
    { 
        parent::__construct();
        $this->load->model('index_model');   
    }
    
    public function index()
    { 
		if($this->session->userdata('id')):
			redirect('login/home');
		else:
			$this->load->view('login');
		endif;      
    }
}
/*
*end modules/login/controllers/index.php
*/