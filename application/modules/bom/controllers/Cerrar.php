<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Cerrar extends MX_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('grl/general_model');
		$this->load->model('bom_general_model');
		$this->load->model('cerrar_model');
    }
    
    public function index()
    { 
		if($this->session->userdata('id')):
			$this->load->helper('text');
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-table.css').'" rel="stylesheet">';
			$data['css'] .= '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/jquery-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bom.js').'"></script>';
			$data['reportes'] = $this->bom_general_model->desplega_reportes(5,$data["iduser"]);
			$this->template->load('template','cerrar',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 
    }
	
	public function desplegar_remplazos()
	{
		$idreporte = $this->input->get('idreporte');
		$idsolucion = $this->input->get('idsolucion');
		$remplazos = $this->cerrar_model->desplegar_remplazos($idreporte,$idsolucion);
		$datasource = array();
		foreach ($remplazos as $remplazo):
			//$datasource[]=array_map('utf8_encode', $remplazo);
			$datasource[]=($remplazo);
		endforeach;
		echo json_encode($datasource);
	}
	
	public function cerrar_reporte()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$idreporte=$this->input->post('id');
			$idsolucion=$this->input->post('idsolucion');
			$folio=$this->input->post('folio');
			$observaciones=$this->input->post('observaciones');
			$fechas  = '';
			foreach ($this->input->post('fecha') as $fecha):
				$fechas = $fechas.$fecha.';';
			endforeach;
			$equipos  = '';
			foreach ($this->input->post('equipo') as $equipo):
				$equipos = $equipos.$equipo.';';
			endforeach;
			$result = $this->cerrar_model->cerrar_reporte($idreporte,$data['iduser'],$observaciones,$equipos,$fechas);
			$data['mensaje'] = $result[0]["mensaje"];
			$data['folio'] = $folio;
			if($data['mensaje']=='ok'):
				$this->load->model('notificacion_model');
				$this->load->library('email');
				$this->load->model('emitir_model');
				$data["result"] = $this->emitir_model->desplega_encabezado_reporte($idreporte);
				$correos = $this->notificacion_model->select_correos($data["result"][0]["idtiporeporte"],$data["result"][0]["idclasificacion"],$data["result"][0]["idplaza"],25);
				$copiaoculta = $this->notificacion_model->select_copiaoculta();
				$html = $this->load->view('cerrar_notificacion', $data, true);
				$this->email->attach('./documents/bom/'.$data["result"][0]["idreporte"].'.pdf');
				/*foreach($correos as $correo):
					$this->email->clear();
					$this->email->to($correo["correo"]);
					$this->email->from('sao@grupohi.mx','Bitácora Operación y Mantto.');
					$this->email->subject('Cierre de Reporte '.$data["result"][0]["folio"].' Plaza "'.$data["result"][0]["nombre_plaza"].'"');
					$this->email->message($html);
					$this->email->send();
				endforeach;
				foreach($copiaoculta as $co):
					$this->email->clear();
					$this->email->bcc($co['correo']);
					$this->email->from('sao@grupohi.mx','Bitácora Operación y Mantto.');
					$this->email->subject('Cierre de Reporte '.$data["result"][0]["folio"].' Plaza "'.$data["result"][0]["nombre_plaza"].'"');
					$this->email->message($html);
					$this->email->send();
				endforeach;*/
			endif;
			$this->template->load('template','cerrar_mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	/*public function generales($id)
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data["result"] = $this->emitir_model->desplega_encabezado_reporte($id);
			$data["reparar"] = $this->emitir_model->desplega_equipo_reparar($data["result"][0]["idregistro_solucion"]);
			$data["reemplazar"] = $this->emitir_model->desplega_equipo_reemplazar($data["result"][0]["idregistro_solucion"]);
			$data["idreporte"]=$id;
			$this->load->library('pdf');
			$this->pdf->load_view('emitir_generales',$data);
 			$this->pdf->render();
 			$this->pdf->stream("REPORTE_".$data["result"][0]["folio"].".pdf");
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	
	
	public function subir_firma($id)
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$data["result"] = $this->emitir_model->desplega_encabezado_reporte($id);
			$data["idreporte"]=$id;
			$this->template->load('template','emitir_firmas',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function registrar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$id = $this->input->post('idreporte');
			$config['upload_path'] = './application/modules/bom/documents/';
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '0';
			$config['overwrite'] = true;
			
			$this->load->library('upload', $config);
			$result = $this->emitir_model->desplega_encabezado_reporte($id);
			$data["folio"] = $result[0]["folio"];
			if ( ! $this->upload->do_upload()):
				$error = array('error' => $this->upload->display_errors());
				$data["mensaje"]='Error';
			else:
				$datos = array('upload_data' => $this->upload->data());
				$soporte = $datos["upload_data"]["file_name"];
				unlink("./application/modules/bom/documents/".$id.".pdf");
				rename("./application/modules/bom/documents/".$soporte,"./application/modules/bom/documents/".$id.".pdf");
				$data["mensaje"]='ok';
			endif;
			$this->template->load('template','emitir_mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif;
	}
	
	public function carga_informacion()
	{
		$id=$this->input->post('id');
		$data["result"] = $this->emitir_model->desplega_encabezado_reporte($id);
		$data["reparar"] = $this->emitir_model->desplega_equipo_reparar($data["result"][0]["idregistro_solucion"]);
		$data["reemplazar"] = $this->emitir_model->desplega_equipo_reemplazar($data["result"][0]["idregistro_solucion"]);
		$tabla='<div class="square">
    		<h5><strong>GENERALES DEL REPORTE</strong></h5>
            <div class="col-md-12">
            	<div class="pull-right">'.
					$data["result"][0]["folio"].'
                	<br>
                	<span class="label label-'.$data["result"][0]["color"].'">'.$data["result"][0]["nombre_clasificacion"].'</span>
            	</div>	
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        Plaza de Cobro<br>
                        Nombre de quien reporta<br>
                        Puesto<br>
                    </strong>
                </div>
                <div class="col-md-7">'.
                    $data["result"][0]["nombre_plaza"].'<br>'.
                    $data["result"][0]["nombre_reporta"].'<br>'.
                    $data["result"][0]["puesto_reporta"].'
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        Tipo de Reporte<br>
                        Fecha Detecci&oacute;n Falla<br>
                        Hora Detecci&oacute;n Falla<br>
                    </strong>
                </div>
                <div class="col-md-7">'.
                    $data["result"][0]["nombre_tiporeporte"].'<br>'.
                    $data["result"][0]["fecha"].'<br>'.
                    $data["result"][0]["hora"].'
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        &Aacute;rea de Afectaci&oacute;n<br>
                        Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-7">'.
                    $data["result"][0]["nombre_area"].'<br>'.
                    $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>				
			</div>
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
			<div class="row">
				<div class="col-md-5">
					<strong>
						Fecha de Asignaci&oacute;n<br>
						Hora de Asignaci&oacute;n<br>
						T&eacute;cnico<br>
					</strong>
				</div>
				<div class="col-md-7">'.
					$data["result"][0]["fecha_asignacion"].'<br>'.
					$data["result"][0]["hora_asignacion"].'<br>'.
					$data["result"][0]["tecnico"].'
				</div>
			</div>
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
			<div class="row">
				<div class="col-md-5">
					<strong>
						Diagn&oacute;stico
					</strong>
				</div>	
                <div class="col-md-7">'.
                    $data["result"][0]["diagnostico"].'<br>'.
                '</div>
            </div>	
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>';				
            
			if($data["result"][0]["reparar"]==1):
            $tabla .='<table><tr><td colspan="4"><strong><i>EQUIPO QUE REQUIERE REPARACI&Oacute;N</i></strong></td></tr>
            <tr>
                <td colspan="4">
                    <table style="font-size:8px;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>
                            <td><strong>CAPACIDAD</strong></td>
                            <td><strong>SERIE</strong></td>
                            <td><strong>MOTIVO</strong></td>
                            <td><strong>FECHA DE REGRESO</strong></td>
                            <td><strong>UBICACI&Oacute;N</strong></td>
                        </tr>';
                        $n=0; foreach($data["reparar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["marca"].'</td>
                            <td>'.$elemento["modelo"].'</td>
                            <td>'.$elemento["capacidad"].'</td>
                            <td>'.$elemento["serie"].'</td>
                            <td>'.$elemento["motivo"].'</td>
                            <td>'.$elemento["destino"].'</td>
                            <td>'.$elemento["fecha_regreso"].'</td>
                        </tr>';
                        endforeach;
                    $tabla.='</table>
                </td>
            </tr>';
            endif;
			if($data["result"][0]["remplazo"]==1):
            $tabla.='<tr><td colspan="4"><strong><i>MATERIALES REQUERIDOS POR DA&Ntilde;O O REEMPLAZO</i></strong></td></tr>
            <tr>
                <td colspan="2">
                    <table style="font-size:8px;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>
                            <td><strong>CAPACIDAD</strong></td>
                            <td><strong>SERIE</strong></td>
                            <td><strong>MOTIVO</strong></td>
                            <td><strong>UBICACI&Oacute;N</strong></td>
                        </tr>';
                        $n=0; foreach($data["reemplazar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["r_marca"].'</td>
                            <td>'.$elemento["r_modelo"].'</td>
                            <td>'.$elemento["r_capacidad"].'</td>
                            <td>'.$elemento["r_serie"].'</td>
                            <td>'.$elemento["r_motivo"].'</td>
                            <td>'.$elemento["r_ubicacion"].'</td>
                        </tr>';
                        endforeach;
                    $tabla.='</table>
                </td>
			</tr>
			<tr>
                <td colspan="2" align="center" style="font-size:8px;"><i>(MATERIALES A SUSTITUIR)</i></td>
            </tr>					
			<tr>
				<td>
            		<table style="font-size:8px;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>
                            <td><strong>CAPACIDAD</strong></td>
                            <td><strong>SERIE</strong></td>
                            <td><strong>MOTIVO</strong></td>
                            <td><strong>UBICACI&Oacute;N</strong></td>
                        </tr>';
                        $n=0; foreach($data["reemplazar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["n_marca"].'</td>
                            <td>'.$elemento["n_modelo"].'</td>
                            <td>'.$elemento["n_capacidad"].'</td>
                            <td>'.$elemento["n_serie"].'</td>
                            <td>'.$elemento["n_motivo"].'</td>
                            <td>'.$elemento["n_ubicacion"].'</td>
                        </tr>';
                        endforeach;
                    $tabla.='</table>
            	</td>
			</tr>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-size:8px;"><i>(MATERIALES QUE LOS SUSTITUYEN)</i></td>
            </tr>
			</table>';
            endif;
			$tabla.='
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
			<div class="row">
				<div class="col-md-5">
					<strong>
						Observaciones
					</strong>
				</div>	
                <div class="col-md-7">'.
                    $data["result"][0]["observacion_reporte"].
                '</div>
            </div>	
			</div>';
			echo $tabla;
	}*/
}
/*
*end modules/login/controllers/index.php
*/