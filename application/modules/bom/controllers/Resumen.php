<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resumen extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('resumen_model');
	}	
	
	public function index()
	{
		$data['result']=$this->resumen_model->detalle_resumen();
		$this->load->view('resumen',$data);
		$this->load->model('notificacion_model');
		//$this->load->library('email');
		$this->load->library('My_PHPMailer');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPAuth   = true; 
		$mail->Host       = "172.20.74.6";   
		$mail->Port       = 25;              
		$mail->Username   = "scaf"; 
		$mail->Password   = "GpoHermesInfra";
		$copiaoculta = $this->notificacion_model->select_copiaoculta();
		$correos = $this->notificacion_model->select_actividades_resumen();		
		$html = $this->load->view('resumen', $data, true);
		$mail->SetFrom('sao@grupohi.mx', utf8_decode('Bitácora Operación y Mantto.'));
		$mail->Subject = utf8_decode('Resumen Actividades Pendientes');
		$mail->Body      = $html;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
		foreach ($correos as $correo):
			$mail->AddAddress($correo["correo"]);
		endforeach;
		foreach($copiaoculta as $co):
			$mail->AddBcc($co["correo"]);
		endforeach;
		
		$mail->Send();	
	}
}
?>