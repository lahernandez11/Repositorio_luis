<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Reporte extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('reporte_model');
		$this->load->model('grl/general_model');
        $this->load->library('template');   
		$this->load->library('menu');
		$this->load->library('caratula');
    }
    
    public function corte()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/cai.js').'"></script>';
			$data['elementos'] = $this->reporte_model->desplega_reportes_corte($data['iduser']);
			$data['plazas'] = $this->general_model->desplega_plazas_usuario($session_data['id']);
			$this->template->load('template','reporte_corte',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function buscar_corte()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$plaza=$this->input->post('plaza');
			$turno=$this->input->post('turno');
			$fecha=$this->input->post('fecha');
			if($turno=='0'):
				$turno='1,2,3';
			else:
				$turno=$turno;
			endif;
			$data['elementos'] = $this->reporte_model->desplega_reportes_corte_resultado($turno,$plaza,$fecha);
			$this->load->view('reporte_corte_resultado',$data);
		else:
			
		endif;
		
	}
	
	function corte_pdf($corte)
	{
		$suma_importe = 0;
		$suma_eje = 0;
		$suma_aforo = 0;
		$encabezado = $this->reporte_model->encabezado_corte_pdf($corte);
		$data["proyecto"] = $encabezado[0]->nombre_proyecto;
		$data["caseta"] = $encabezado[0]->nombre_plaza;
		$data["idcaseta"] = $encabezado[0]->idplaza;
		$data["fecha"] = $encabezado[0]->fecha; 
		$data["jefe"] = $encabezado[0]->jefe; 
		$data["cobrador"] = $encabezado[0]->cobrador;
		$data["cuerpo"] = $encabezado[0]->nombre_cuerpo;
		$data["turno"] = $encabezado[0]->turno;
		$data["tipo"] = "";
		$data["linea"] = $encabezado[0]->nombre_carril;
		$data["sentido"] = $encabezado[0]->nombre_sentido;
		//$data["tarifa"] = $encabezado[0]->idtarifa;
		$data['pagos'] = $this->reporte_model->carga_tipos_pago($corte,$data["idcaseta"]);
		$data['vehiculos'] = $this->reporte_model->carga_vehiculos($corte,$data["idcaseta"]);
		$data['tarifas'] = $this->reporte_model->carga_tarifas($corte);
		$data['test'] = $this->reporte_model->carga_aforos($corte,$data["idcaseta"]);
		$data['caratula']='<style>table.caratula td{padding:4px;}</style>
		<table style="font-size:8px;">
			<tr>
				<td>
					<table border="0" cellpading="0" cellspacing="0" class="caratula">
						<tr style="background-color:#ccc;">
							<td>VEHICULO</td>';
		foreach($data['pagos'] as $pago):
			$data['caratula'].='<td align="center">'.$pago->clave.'</td>';
		endforeach;
		$data['caratula'] .='<td>&#163;AFORO</td><td>&#163;EJES</td>';
		foreach ($data['tarifas'] as $elemento):
			$data['caratula'] .='<td>&#163; IMPORTE<br>'.$elemento->moneda.'</td>';
		endforeach;
		$data['caratula'] .='
						</tr>';
		$n=1;
		//INICIA CARATULA
		
		foreach($data['vehiculos'] as $vehiculo): $n++;
			if ($n%2==0):$color = "style='background-color:#eee;'";else:$color = "style='background-color:#fff;'";endif;
			$data['caratula'].='<tr '.$color.'><td>'.$vehiculo->clave.'</td>';
			foreach($data['test'] as $test):
				if($vehiculo->clave==$test->clave):
					if($test->tipo_pago=='IMPORTE'):
						$data['caratula'].='<td align="right">$'.number_format($test->total,2).'</td>';
					else:
						$data['caratula'].='<td align="right">'.$test->total.'</td>';
					endif;
				endif;
			endforeach;
			if(sizeof($data['tarifas'])>1):
				$data['test2'] = $this->reporte_model->carga_importes_e($corte,$data["idcaseta"]);
				foreach($data['test2'] as $test2):
					if($vehiculo->clave==$test2->clave):
						$data['caratula'].='<td align="right">$'.number_format($test2->total,2).'</td>';
					endif;
				endforeach;
			endif;
			
			$data['caratula'] .='</tr>';
		endforeach;
		
		
		
		//FIN CARATULA
		$data['caratula'] .='<tr style="background-color:#ccc"><td>TOTALES</td>';
		$data['totales'] = $this->reporte_model->carga_totales($corte,$data["idcaseta"]);
		foreach($data["totales"] as $total):
			if($total->clave=='IMPORTE'):
				$data['caratula'].='<td align="right">$'.number_format($total->total,2).'</td>';
			else:
				$data['caratula'].='<td align="right">'.$total->total.'</td>';
			endif;
		endforeach;
		if(sizeof($data['tarifas'])>1):
				$data['test3'] = $this->reporte_model->carga_totales_e($corte,$data["idcaseta"]);
				$data['caratula'].='<td align="right">$'.number_format($data['test3'][0]->total,2).'</td>';
			endif;
		
		$data['caratula'] .='</tr></table>
				</td>
				';
		$retiros = $this->reporte_model->retiros($corte);
		foreach($data['tarifas'] as $elemento):
				if($elemento->idmoneda==1):
					$total_vas2 = $this->reporte_model->total_vas2($corte,$elemento->idtarifa);
					$total_vas1 = $this->reporte_model->total_vas1($corte,$elemento->idtarifa);
					$total_telepeaje = $this->reporte_model->total_telepeaje($corte,$elemento->idtarifa);
					$total_residentes = $this->reporte_model->total_residentes($corte,$elemento->idtarifa);
					$total_exentos = $this->reporte_model->total_exentos($corte,$elemento->idtarifa);
					$total_eludidos = $this->reporte_model->total_eludidos($corte,$elemento->idtarifa);
					$ingreso_sd = $this->reporte_model->total_ingreso_sd($corte,$elemento->idtarifa);
					$faltante = $ingreso_sd[0]->total_ingreso_sd-($total_vas2[0]->total_vas2+$retiros[0]->retiros_parciales_1+$retiros[0]->ultimo_retiro_1);
					if($faltante<0):
						$faltante=0;
					else:
						$faltante=$faltante;
					endif;
					
					$total_efectivo = $total_vas2[0]->total_vas2+$retiros[0]->retiros_parciales_1+$retiros[0]->ultimo_retiro_1+$faltante;
					$sobrante = $total_efectivo - $ingreso_sd[0]->total_ingreso_sd;
					if($sobrante<0):
						$sobrante=0;
					else:
						$sobrante=$sobrante;
					endif;
					
					$subtotal = $total_vas1[0]->total_vas1 + $total_telepeaje[0]->total_telepeaje + $total_residentes[0]->total_residentes;
					$total_ingresos = $ingreso_sd[0]->total_ingreso_sd + $subtotal;
					
					$data['caratula'].='<td valign="top"><table style="background-color:#eee;" width="160px">
										<tr><td colspan="2"><strong>MONEDA NACIONAL '.$elemento->moneda.'</strong></td><td colspan="2">&nbsp;</td></tr>
										<tr><td>RETIROS PARCIALES</td><td align="right">$'.number_format($retiros[0]->retiros_parciales_1,2).'</td></tr>
										<tr><td>ULTIMO RETIRO</td><td align="right">$'.number_format($retiros[0]->ultimo_retiro_1,2).'</td></tr>
										<tr><td>TARJETAS VAS 2.0</td><td align="right">$'.number_format($total_vas2[0]->total_vas2,2).'</td></tr>
										<tr><td>FALTANTE PAGADO</td><td align="right">$'.number_format($faltante,2).'</td></tr>
										<tr><td>TOTAL EFECTIVO</td><td align="right">$'.number_format($total_efectivo,2).'</td></tr>
										<tr><td>SOBRANTE</td><td align="right">$'.number_format($sobrante,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>INGRESO SD</td><td align="right">$'.number_format($ingreso_sd[0]->total_ingreso_sd,2).'</td></tr>
										<tr><td>TOTAL INGRESOS</td><td align="right">$'.number_format($total_ingresos,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>TOTAL DEPOSITADO</td><td align="right">$'.number_format($total_efectivo,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td colspan="2"><strong>MEDIOS ELECTRONICOS</strong></td></tr>
										<tr><td>TARJETAS VAS 1.0</td><td align="right">$'.number_format($total_vas1[0]->total_vas1,2).'</td></tr>
										<tr><td>TELEPEAJE</td><td align="right">$'.number_format($total_telepeaje[0]->total_telepeaje,2).'</td></tr>
										<tr><td>RESIDENTES</td><td align="right">$'.number_format($total_residentes[0]->total_residentes,2).'</td></tr>
										<tr><td>SUBTOTAL</td><td align="right">$'.number_format($subtotal,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td colspan="2"><strong>EXENTOS DE PAGO</strong></td></tr>
										<tr><td>EXENTOS</td><td align="right">$'.number_format($total_exentos[0]->total_exentos,2).'</td></tr>
										<tr><td>ELUDIDOS</td><td align="right">$'.number_format($total_eludidos[0]->total_eludidos,2).'</td></tr>
									</table></td>';
				else:
					$ingreso_sd_e = $this->reporte_model->total_ingreso_sd_e($corte,$elemento->idtarifa);
					$faltante_e = $ingreso_sd_e[0]->total_ingreso_sd_e-($retiros[0]->retiros_parciales_2+$retiros[0]->ultimo_retiro_2);
					if($faltante_e<0):
						$faltante_e=0;
					else:
						$faltante_e=$faltante_e;
					endif;
					$total_efectivo_e = $retiros[0]->retiros_parciales_2+$retiros[0]->ultimo_retiro_2+$faltante_e;
					
					$sobrante_e = $total_efectivo_e - $ingreso_sd_e[0]->total_ingreso_sd_e;
					if($sobrante_e<0):
						$sobrante_e=0;
					else:
						$sobrante_e=$sobrante_e;
					endif;
					
					$data['caratula'] .='<td>&nbsp;&nbsp;</td><td valign="top"><table style="background-color:#eee;" width="160px">
										<tr><td colspan="2"><strong>MONEDA EXTRANJERA '.$elemento->moneda.'</strong></td><td colspan="2">&nbsp;</td></tr>
										<tr><td>RETIROS PARCIALES</td><td align="right">$'.number_format($retiros[0]->retiros_parciales_2,2).'</td></tr>
										<tr><td>ULTIMO RETIRO</td><td align="right">$'.number_format($retiros[0]->ultimo_retiro_2,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>FALTANTE PAGADO</td><td align="right">$'.number_format($faltante_e,2).'</td></tr>
										<tr><td>TOTAL EFECTIVO</td><td align="right">$'.number_format($total_efectivo_e,2).'</td></tr>
										<tr><td>SOBRANTE</td><td align="right">$'.number_format($sobrante_e,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>INGRESO SD</td><td align="right">$'.number_format($ingreso_sd_e[0]->total_ingreso_sd_e,2).'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>TOTAL A DEPOSITAR</td><td align="right">$'.number_format($total_efectivo_e,2).'</td></tr>
									</table></td>';
				endif;
		endforeach;		
					
		$data['caratula'].='
			</tr>
		</table>';
		
		$firmas = $this->reporte_model->firma_registra($corte);
		$data['firmante'] = $firmas[0]->firmante;
		$data['firmante_puesto'] = $firmas[0]->firmante_puesto;
		
		
		
		//CALIFICAICON
		$data['datos_calificacion'] = $this->reporte_model->regresa_calificacion($corte);
		$presentacion = ($data['datos_calificacion'][0]->presentacion==1)?"CORRECTO":"INCORRECTO";
		$discrepancias = $data['datos_calificacion'][0]->discrepancias;
		$discrepancias_srv = $data['datos_calificacion'][0]->discrepancias_srv;
		$errores = $data['datos_calificacion'][0]->errores;
		$violaciones = $data['datos_calificacion'][0]->violaciones;
		$violaciones_srv = $data['datos_calificacion'][0]->violaciones_srv;
		$reportes_admin = $data['datos_calificacion'][0]->reportes_admin;
		$comentarios = $data['datos_calificacion'][0]->comentarios;
		$data['calificacion'] ='<table style="font-size:9px;">
		<tr>
			<td>Calificaci&oacute;n:</td><td>'.$presentacion.'</td>
		</tr>
		<tr>
			<td>Discrepancias:</td><td>'.$discrepancias.'</td><td>Discrepancias SRV:</td><td>'.$discrepancias_srv.'</td>
		</tr>
		<tr>
			<td>Errores:</td><td>'.$errores.'</td><td>Violaciones:</td><td>'.$violaciones.'</td>
		</tr>
		<tr>
			<td>Violaciones SRV:</td><td>'.$violaciones_srv.'</td><td>Reportes. Admin:</td><td>'.$reportes_admin.'</td>
		</tr>
		<tr>
			<td>Observaciones:</td><td colspan="3">'.$comentarios.'</td>
		</tr>
		</table>';
		 
		//FOLIOS 
		$data['utilizados'] = $this->reporte_model->folios_utilizados($corte);
		$data['cancelados_total'] = $this->reporte_model->folios_cancelados_total($corte);
		$data['cancelados'] = $this->reporte_model->folios_cancelados($corte);
		$data['noemitidos'] = $this->reporte_model->folios_noemitidos($corte);
		$data['noemitidos_detalle'] = $this->reporte_model->folios_noemitidos_detalle($corte);
		$data['utilizados_total'] = $this->reporte_model->folios_utilizados_total($corte);
		$data['totales_folio'] = $this->reporte_model->regresa_total(1,$corte);
		$total_folios_general=0;
		foreach ($data['utilizados'] as $rango):
					$total_folios = 1+(($rango->final)-($rango->inicial));
					$total_folios_general = $total_folios_general + $total_folios;
		endforeach;
		
		$total_general_folios = $total_folios_general-$data['cancelados_total'][0]->total+$data['noemitidos'][0]->total;
		$data['folios_utilizados'] = '<table style="font-size:9px; width:100%;">
		<tr>
			<td valign="top" width="25%">
				<table>
					<tr><td>Folios Utilizados:'.number_format($total_folios_general).'</td><td>&nbsp;</td></tr>';
					foreach ($data['utilizados'] as $rango):
					$total_folios = 1+(($rango->final)-($rango->inicial));
						$data['folios_utilizados'] .='<tr>
														<td>'.number_format($rango->inicial).' al '.number_format($rango->final).'&nbsp;&nbsp;&nbsp;Serie:'.$rango->serie.'</td>
														<td>&nbsp;&nbsp;'.$total_folios.'</td>
													  </tr>';		
					endforeach;
					$data['folios_utilizados'] .='
				</table>
			</td>
			<td>&nbsp;</td>
			<td valign="top" width="25%">
				<table width="100%">
					<tr><td>Folios Cancelados:'.$data['cancelados_total'][0]->total.'</td></tr>';
					foreach ($data['cancelados'] as $cancelado):
						$data['folios_utilizados'] .='<tr>
														<td>'.number_format($cancelado->folio_cancelado).'&nbsp;&nbsp;Serie:'.$cancelado->serie.'</td>
													  </tr>';		
					endforeach;
				$data['folios_utilizados'] .='</table>
			</td>
			<td>&nbsp;</td>
			<td valign="top" width="25%">
				<table>
					<tr><td>Folios No Emitidos:'.$data['noemitidos'][0]->total.'</td></tr>';
					foreach ($data['noemitidos_detalle'] as $noemitido_detalle):
						$data['folios_utilizados'] .='<tr>
														<td>'.$noemitido_detalle->folio_noemitido.'</td>
													  </tr>';		
					endforeach;
				$data['folios_utilizados'].='</table>
			</td>
			<td valign="top" width="25%">
				<table>
					<tr><td>Total:'.number_format($total_general_folios).'</td></tr>';
				$data['folios_utilizados'] .='</table>
			</td>
		</tr>';
		$data['folios_utilizados'] .='</table>';
		
		
		$data["firmas"] = '<table style="font-size:9px; width:100%;">
		<tr>
			<td align="center">'.$data['cobrador'].'</td>
			<td align="center">'.$data['jefe'].'</td>
			<td align="center">'.$data['firmante'].'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center">____________________________________</td>
			<td align="center">____________________________________</td>
			<td align="center">____________________________________</td>
		</tr>
		<tr>
			<td align="center">COBRADOR</td>
			<td align="center">JEFE DE TURNO</td>
			<td align="center">'.$data['firmante_puesto'].'</td>
		</tr>
		</table>';
		$caseta = $data["caseta"];
		$turno = $data["turno"];
		$fecha = $data["fecha"];
		
		$date = explode("-",$data["fecha"]);
		$data["fecha"]=$date[2].'-'.$date[1].'-'.$date[0]; 
		//$this->load->view('corte_pdf',$data);
		$this->load->library('pdf');
		$this->pdf->load_view('corte_pdf',$data);
 		$this->pdf->render();
 		$this->pdf->stream("CORTE DE CAJA $caseta-$turno-$fecha.pdf");
	
	}
	
	

}
/*
*end modules/login/controllers/index.php
*/