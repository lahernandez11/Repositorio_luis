<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Emitir extends MX_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('grl/general_model');
		$this->load->model('bom_general_model');
		$this->load->model('emitir_model');
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
			$data['js'] = '<script src="'.base_url('assets/js/jquery-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-table.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bom.js').'"></script>';
			$data['reportes'] = $this->bom_general_model->desplega_reportes(4,$data["iduser"]);
			$this->template->load('template','emitir',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 
    }
	
	public function generales($id)
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$this->emitir_model->emitir_reporte($id,$data['iduser']);
			$data["result"] = $this->emitir_model->desplega_encabezado_reporte($id);
			$data["reparar"] = $this->emitir_model->desplega_equipo_reparar($id,$data["result"][0]["idregistro_solucion"]);
			$data["reemplazar"] = $this->emitir_model->desplega_equipo_reemplazar($id,$data["result"][0]["idregistro_solucion"]);
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
			$config['upload_path'] = './documents/bom/';
			$config['allowed_types'] = 'pdf';
			//$config['max_size']	= '0';
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
				unlink("./documents/bom/".$id.".pdf");
				rename("./documents/bom/".$soporte,"./documents/bom/".$id.".pdf");
				$data["mensaje"]='ok';
				$this->emitir_model->guardar_documento($id,$id.'.pdf',$data['usuario'],$data['iduser']);
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
		$data["reparar"] = $this->emitir_model->desplega_equipo_reparar($id,$data["result"][0]["idregistro_solucion"]);
		$data["reemplazar"] = $this->emitir_model->desplega_equipo_reemplazar($id,$data["result"][0]["idregistro_solucion"]);
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
                <div class="col-md-4">
                    <strong>
                        Plaza de Cobro<br>
                        Nombre de quien reporta<br>
                        Puesto<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_plaza"].'<br>'.
                    $data["result"][0]["nombre_reporta"].'<br>'.
                    $data["result"][0]["puesto_reporta"].'
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <strong>
                        Tipo de Reporte<br>
                        Fecha Detecci&oacute;n Falla<br>
                        Hora Detecci&oacute;n Falla<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_tiporeporte"].'<br>'.
                    $data["result"][0]["fecha"].'<br>'.
                    $data["result"][0]["hora"].'
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <strong>
                        &Aacute;rea de Afectaci&oacute;n<br>';
						if($data["result"][0]["nombre_area"]=="CARRIL"):
				$tabla .='Ubicaci&oacute;n<br>';
			endif;						
            $tabla .='Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_area"].'<br>';
				if($data["result"][0]["nombre_area"]=="CARRIL"):
				$tabla .=$data["result"][0]["nombre_carril"].'<br>';
			endif;	
			 $tabla .=  $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>
            </div>';				
				$tabla.=
                  '
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
			<div class="row">
				<div class="col-md-4">
					<strong>
						Fecha de Asignaci&oacute;n<br>
						Hora de Asignaci&oacute;n<br>
						T&eacute;cnico<br>
					</strong>
				</div>
				<div class="col-md-8">'.
					$data["result"][0]["fecha_asignacion"].'<br>'.
					$data["result"][0]["hora_asignacion"].'<br>'.
					$data["result"][0]["tecnico"].'
				</div>
			</div>
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
			<div class="row">
				<div class="col-md-4">
					<strong>
						Diagn&oacute;stico
					</strong>
				</div>	
                <div class="col-md-8">'.
                    $data["result"][0]["diagnostico"].'<br>'.
                '</div>
            </div>	
			<div class="row">
            	<div class="col-md-12"><hr></div>
            </div>';				
            
			if($data["result"][0]["reparar"]==1):
            $tabla .='<table style="width:100%"><tr><td colspan="4"><strong><i>EQUIPO QUE REQUIERE REPARACI&Oacute;N</i></strong></td></tr>
            <tr>
                <td colspan="4">
                    <table style="font-size:8px;width:100%;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>EQUIPO</strong></td>
							<td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>
                            <!--<td><strong>CAPACIDAD</strong></td>
                            <td><strong>SERIE</strong></td>-->
                            <td><strong>MOTIVO</strong></td>                            
                            <td><strong>DESTINO</strong></td>
							<td><strong>FECHA DE REGRESO</strong></td>
                        </tr>';
                        $n=0; foreach($data["reparar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["nombre_equipo"].'</td>
							<td>'.$elemento["marca"].'</td>
                            <td>'.$elemento["modelo"].'</td>
                            <!--<td>'.$elemento["capacidad"].'</td>
                            <td>'.$elemento["serie"].'</td>-->
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
                    <table style="font-size:8px;width:100%;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>EQUIPO</strong></td>
							<td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>
                            <!--<td><strong>CAPACIDAD</strong></td>-->
                            <!--<td><strong>SERIE</strong></td>-->
                            <td><strong>MOTIVO</strong></td>
                            <td><strong>UBICACI&Oacute;N</strong></td>
                        </tr>';
                        $n=0; foreach($data["reemplazar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["r_nombre_equipo"].'</td>
							<td>'.$elemento["r_marca"].'</td>
                            <td>'.$elemento["r_modelo"].'</td>
                            <!--<td>'.$elemento["r_capacidad"].'</td>-->
                            <!--<td>'.$elemento["r_serie"].'</td>-->
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
            		<table style="font-size:8px;width:100%;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>EQUIPO</strong></td>
							<td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>

                            <!--<td><strong>CAPACIDAD</strong></td>-->
                            <td><strong>SERIE</strong></td>
                            <td><strong>MOTIVO</strong></td>
                            <!--<td><strong>UBICACI&Oacute;N</strong></td>-->
                        </tr>';
                        $n=0; foreach($data["reemplazar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["n_nombre_equipo"].'</td>
							<td>'.$elemento["n_marca"].'</td>
                            <td>'.$elemento["n_modelo"].'</td>
                            <!--<td>'.$elemento["n_capacidad"].'</td>-->
                            <td>'.$elemento["n_serie"].'</td>
                            <!--<td>'.$elemento["n_motivo"].'</td>-->
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
				<div class="col-md-4">
					<strong>
						Soluci&oacute;n
					</strong>
				</div>	
                <div class="col-md-8">'.
                    $data["result"][0]["solucion"].
                '</div>
            </div>	
			</div>';
			echo $tabla;
	}
}
/*
*end modules/login/controllers/index.php
*/