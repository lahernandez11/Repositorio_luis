<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Tarifa extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('tarifa_model');
		$this->load->model('grl/general_model');
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
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-table.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-table.js').'"></script>';
			$elementos = $this->tarifa_model->desplega($session_data['id']);
			$data['tabla']='<table id="example" class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Proyecto</th>
					<th>Plaza</th>
					<th>Fecha</th>
					<th>Moneda</th>
					<th>Acci&oacute;n</th>
				</tr>
			</thead>
			<tbody>';
			$n=1; foreach($elementos as $elemento):
			$data['tabla'].='<tr class="'.$elemento->color.'">
                	<td>'.$n.'</td>
                	<td>'.$elemento->nombre_proyecto.'</td>
                    <td>'.$elemento->nombre_plaza.'</td>
                    <td>'.$elemento->fecha.'</td>
                    <td>'.$elemento->moneda.'</td>
                    <td align="center">
                    	<a class="btn btn-primary btn-xs" data-toggle="modal" href="#tarifa'.$elemento->idtarifa.'">Detalle</a>
                    </td>
                </tr>';
			$n++;
			endforeach;
			$data['tabla'].='</tbody>
    		</table>';
			$data['modal']='';
			foreach($elementos as $elemento):
				$detalles=$this->tarifa_model->desplega_detalle($elemento->idtarifa);
				$data['modal'].='
			<div class="modal fade" id="tarifa'.$elemento->idtarifa.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">PLAZA:'.$elemento->nombre_plaza.' FECHA:'.$elemento->fecha.'</h4>
				  </div>
				  <div class="modal-body">
				  <table class="table table-bordered table-striped">
				  	<tr>
						<th>Vehiculo</th>
						<th>Clave</th>
						<th>Tarifa</th>
					</tr>';
					foreach ($detalles as $detalle):
					$data['modal'].='<tr>
						<td>'.$detalle->tipo_vehiculo.'</td>
						<td>'.$detalle->clave.'</td>
						<td>'.$detalle->tarifa.'</td>
					</tr>';
					endforeach;
				  $data['modal'].='</table></div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
				  </div>
				</div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->';
			endforeach;
			$this->template->load('template','tarifa',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function form_agregar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/cai.js').'"></script>';
			$data['plazas'] = $this->general_model->desplega_plazas_usuario($session_data['id']);
			$this->template->load('template','tarifa_plaza',$data);  
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function detalle()
	{
		$this->load->model('grl/vehiculo_plaza_model');
		$data["idplaza"]=$this->input->post('idplaza');
		$data["vehiculos"]=$this->vehiculo_plaza_model->desplega_vehiculos_plaza($data["idplaza"]);
		$data["monedas"]=$this->general_model->desplega_lista_monedas_activas();
		$this->load->view('tarifa_vehiculos',$data);
	}
	
	public function agregar()
	{
		if($this->session->userdata('id')):
			$this->load->model('grl/vehiculo_plaza_model');
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$data["title"] ='TARIFAS';
			$data["icon"]='fa-ticket';
			$data["link"]='cai/tarifa/index';
			$idplaza = $this->input->post('idplaza');
			$fecha = $this->input->post('fecha');
			$moneda = $this->input->post('moneda');
			$data["vehiculos"]=$this->vehiculo_plaza_model->desplega_vehiculos_plaza($idplaza);
			$Vehiculos='';
			$Tarifas='';
			foreach($data["vehiculos"] as $vehiculo):
				$Vehiculos=$Vehiculos.$vehiculo->idtipo_vehiculo.',';
				$Tarifas=$Tarifas.$this->input->post('input'.$vehiculo->idtipo_vehiculo).',';
			endforeach;
			//echo $Vehiculos.'<br>';
			//echo $Tarifas.'<br>';
			$result = $this->tarifa_model->agrega($fecha,$moneda,$idplaza,$data["iduser"],$Vehiculos,$Tarifas);
			$mensaje = $result[0]["mensaje"];
			if ($mensaje=='ok'):
				$data["result"]=1;
			else:
				$data["result"]=0;
			endif;
			$this->template->load('template','mensaje',$data);   
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
}
/*
*end modules/login/controllers/index.php
*/