<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class consulta extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');  
		$this->load->library('menu');
		$this->load->model('grl/general_model');
		$this->load->model('bom_general_model');
		$this->load->model('consulta_model');
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
			$data['reportes'] = $this->consulta_model->consulta_mp($data["iduser"]);
			$this->template->load('template','consulta',$data);
		else:
			redirect('login/index', 'refresh');
		endif;   
		      
    }
	
	public function estatus()
	{
		$tr=$this->input->get('tr');	
		$estado=$this->input->get('estado');			
		$idr=$this->input->get('idrepo');	
			
		$data['resultado']=$this->consulta_model->select_estatus($idr,$tr,$estado);	
		if($data['resultado'])
		{
		echo "<div><i><b>".$data['resultado'][0]['nombre_estado']."</b></i></div>";
		echo "<div>Se capturo por ".$data['resultado'][0]['nombre'].
				   "<br/> el dia ".$data['resultado'][0]['fecha'].
		" a las ".$data['resultado'][0]['hora']."</div>";	
		}		
		else
		{echo "<div><i>Aun no llega a este paso.</i></div>";}
	}
	
	public function carga_informacion()
	{
		$id=$this->input->post('id');
		$estado=$this->input->post('estado');
		if($estado==1):
			$this->load->model('asignacion_model');
			$data["result"]=$this->asignacion_model->desplega_reporte($id);
		$mensaje = '<div class="square">
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
				 	$mensaje .= "Ubicaci&oacute;n<br>";
				 endif;
                 $mensaje .= 'Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_area"].'<br>';
                    if($data["result"][0]["nombre_area"]=="CARRIL"):
				 		$mensaje .= $data["result"][0]["nombre_carril"]."<br>";
				 	endif;
				$mensaje .= $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>
            </div>';
			echo $mensaje;
		elseif($estado==2):
		$this->load->model('diagnostico_model');
		$data["result"]=$this->diagnostico_model->desplega_reporte($id);
		$mensaje = '<div class="square">
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
				 	$mensaje .= "Ubicaci&oacute;n<br>";
				 endif;
                 $mensaje .= 'Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_area"].'<br>';
				 if($data["result"][0]["nombre_area"]=="CARRIL"):
				 	$mensaje .= $data["result"][0]["nombre_carril"]."<br>";
				 endif;	
                 $mensaje .= $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>				
			</div>
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
            </div>';

		echo $mensaje;
		elseif($estado==3):
		$this->load->model('solucion_model');
		$data["result"]=$this->solucion_model->desplega_reporte($id);
		$data["reparar"]=$this->solucion_model->desplega_reparo($data["result"][0]["idreporte"]);
		$data["reemplazar"]=$this->solucion_model->desplega_reemplazo($data["result"][0]["idreporte"]);
		$tabla = '<div class="square">
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
				 	$tabla .= "Ubicaci&oacute;n<br>";
				 endif;	
                 $tabla .= 'Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_area"].'<br>';
				if($data["result"][0]["nombre_area"]=="CARRIL"):
				 	$tabla .= $data["result"][0]["nombre_carril"]."<br>";
				endif;	
                $tabla .= $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>				
			</div>
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
                            <td><strong>MOTIVO</strong></td>   
							<td><strong>UBICACI&Oacute;N</strong></td>                            
							<td><strong>FECHA DE REGRESO</strong></td>
                        </tr>';
                        $n=0; foreach($data["reparar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["nombre_equipo"].'</td>
							<td>'.$elemento["marca"].'</td>
                            <td>'.$elemento["modelo"].'</td>
                            <td>'.$elemento["motivo"].'</td>
                            <td>'.$elemento["destino"].'</td>
                            <td>'.$elemento["fecha"].'</td>
                        </tr>';
                        endforeach;
                    $tabla.='</table>
                </td>
            </tr>';
            endif;
			if($data["result"][0]["reemplazo"]==1):
            $tabla.='<tr><td colspan="4"><strong><i>MATERIALES REQUERIDOS POR DA&Ntilde;O O REEMPLAZO</i></strong></td></tr>
            <tr>
                <td colspan="2">
                    <table style="font-size:8px;width:100%;" cellpadding="0" cellspacing="0" border="1">
                        <tr style="background-color:#CCC;" align="center">
                            <td><strong>EQUIPO</strong></td>
							<td><strong>MARCA</strong></td>
                            <td><strong>MODELO</strong></td>                            
                            <td><strong>MOTIVO</strong></td>
                            <td><strong>UBICACI&Oacute;N</strong></td>
                        </tr>';
                        $n=0; foreach($data["reemplazar"] as $elemento): $n++;
                        $tabla.='<tr align="center">
                            <td>'.$elemento["r_nombre_equipo"].'</td>
							<td>'.$elemento["r_marca"].'</td>
                            <td>'.$elemento["r_modelo"].'</td>
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
            </tr>           
			</table>';
            endif;		
			$tabla .= '</div>';
		echo $tabla;
		elseif($estado==4):
		$this->load->model('emitir_model');
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
				 	$tabla .= "Ubicaci&oacute;n<br>";
				endif;	
                $tabla .= 'Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_area"].'<br>';
			    if($data["result"][0]["nombre_area"]=="CARRIL"):
				 	$tabla .= $data["result"][0]["nombre_carril"]."<br>";
				 endif;	
                 $tabla .= $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>				
			</div>
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
				<div class="col-md-5">
					<strong>
						Soluci&oacute;n
					</strong>
				</div>	
                <div class="col-md-7">'.
                    $data["result"][0]["solucion"].
                '</div>
            </div>	
			</div>';
			echo $tabla;
		elseif($estado==5):
			$this->load->model('emitir_model');
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
				 		$tabla .= "Ubicaci&oacute;n<br>";
				    endif;	
                    $tabla .= 'Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-8">'.
                    $data["result"][0]["nombre_area"].'<br>';
					if($data["result"][0]["nombre_area"]=="CARRIL"):
				 		$tabla .= $data["result"][0]["nombre_carril"]."<br>";
				 	endif;	
                    $tabla .= $data["result"][0]["nombre_tipofalla"].'<br>'.
                    $data["result"][0]["observacion_reporte"].'
                </div>				
			</div>
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
				<div class="col-md-4">
					<strong>
						Diagn&oacute;stico
					</strong>
				</div>	
                <div class="col-md-8">'.
                    $data["result"][0]["diagnostico"].'<br>'.
                '</div>
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
            $tabla.='<tr><td colspan="4"><br><strong><i>MATERIALES REQUERIDOS POR DA&Ntilde;O O REEMPLAZO</i></strong></td></tr>
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
		endif;
	}
}
?>
