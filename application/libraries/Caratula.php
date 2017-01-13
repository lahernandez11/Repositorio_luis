<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Caratula 
{

    public function crea_caratula($id,$caseta)
    {
			$this->CI =& get_instance();
			$this->CI->load->model('cai/caratula_model');
			$data['pagos'] = $this->CI->caratula_model->carga_tipos_pago($caseta);
			$n = sizeof($data['pagos']);
			$data['vehiculos'] = $this->CI->caratula_model->carga_vehiculos($caseta);
			$m = sizeof($data['vehiculos']);
			$data['tarifas'] = $this->CI->caratula_model->carga_tarifas($caseta);
			$t = sizeof($data['tarifas']);
			$caratula = '<h5><strong>CORTE DE AFORO</strong></h5><table class="caratula">
					 <tr><th>&nbsp;</th>
					 	 <th colspan="'.$t.'">TARIFAS</th>';
			foreach ($data['pagos'] as $pago):
				$caratula .='<th>&nbsp;</th>';
			endforeach;
				$caratula .='<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;&nbsp;&nbsp;&nbsp;</th><th colspan="'.$t.'">&#931; IMPORTE</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';		 
			$caratula .='</tr>
						 <tr>
						 	<td>VEHICULO</td>';
			foreach ($data['tarifas'] as $tarifas):
				$caratula .='<td>'.$tarifas->moneda.'</td>';
			endforeach;
			foreach ($data['pagos'] as $pago):
				$caratula .='<th>'.$pago->clave.'</th>';
			endforeach;
			$caratula .='<td>&#931; AFORO</td><td>&#931; EJES</td><td>&nbsp;</td>';
			foreach ($data['tarifas'] as $tarifas):
				$caratula .='<td>'.$tarifas->moneda.'</td>';
			endforeach;
			$tab=0;
			foreach ($data['vehiculos'] as $vehiculo):
				$caratula .='</tr><tr>
							<td><span id="eje_'.$vehiculo->idtipo_vehiculo.'" eje="'.$vehiculo->ejes.'">'.$vehiculo->clave.'</span></td>';
							$data["tarifa"] =  $this->CI->caratula_model->carga_tarifa($caseta,$vehiculo->idtipo_vehiculo);
							foreach($data["tarifa"] as $tarifa):
								$caratula .='<td><input eje="'.$tarifa->ejes.'" id="tarifa_'.$tarifa->idmoneda.'_'.$vehiculo->idtipo_vehiculo.'" vehiculo="'.$vehiculo->idtipo_vehiculo.'" class="form-control input-sm strong" style="text-align:right;" type="text" value="'.$tarifa->tarifa.'" readonly><input type="hidden" name="tarifa" value="'.$tarifa->idtarifa.'"></td>';
							endforeach;
							
							$num_pago = 0;
							$tab++;
							foreach ($data['pagos'] as $pago):
							$num_pago=$num_pago+1;
									if($num_pago>1){
										$new=$tab+($m*($num_pago-1));
										}
									else{
										$new=$tab;
										}
								$caratula .='
								<td>
								<input type="text" name="'.$vehiculo->idtipo_vehiculo.'_'.$pago->idtipo_pago.'" id="'.$vehiculo->idtipo_vehiculo.'_'.$pago->idtipo_pago.'" class="numeric form-control input-sm referencia column_'.$pago->idtipo_pago.' '.$vehiculo->idtipo_vehiculo.'" 
								tabindex="'.$new.'" nuevo="'.$new.'" num_pago="'.$num_pago.'" vehiculo="'.$vehiculo->idtipo_vehiculo.'" pago="'.$pago->idtipo_pago.'">
								</td>';
							endforeach;
							
				$caratula .='<td><input name="total_eje_'.$vehiculo->idtipo_vehiculo.'" type="text" id="total_aforo_'.$vehiculo->idtipo_vehiculo.'" readonly class="form-control input-sm strong subtotal_aforo"></td>
							<td><input name="total_eje_'.$vehiculo->idtipo_vehiculo.'" type="text" id="total_eje_'.$vehiculo->idtipo_vehiculo.'" readonly class="form-control input-sm strong subtotal_eje"></td><td>&nbsp;</td>';
							foreach ($data['tarifas'] as $tarifas):
								$caratula .='<td><input name="total_importe_'.$tarifas->idmoneda.'_'.$vehiculo->idtipo_vehiculo.'" type="text" id="total_importe_'.$tarifas->idmoneda.'_'.$vehiculo->idtipo_vehiculo.'" readonly class="form-control input-sm strong subtotal_importe_'.$tarifas->idmoneda.'"></td>';
							endforeach;
			
			endforeach;
			
			$caratula .='</tr><tr><td colspan="'.$t.'">&nbsp;</td><td class="strong">TOTALES</td>';
				foreach ($data['pagos'] as $pago):
								$caratula .='<td><input name="total_column_'.$pago->idtipo_pago.'" class="form-control input-sm strong" type="text" id="total_column_'.$pago->idtipo_pago.'" readonly></td>';
							endforeach;
			$caratula .='<td><input name="total_aforo" class="form-control input-sm strong" type="text" readonly id="total_aforo"></td>
						 <td><input name="total_eje" class="form-control input-sm strong" type="text" readonly id="total_eje"></td><td>&nbsp;</td>';
						 
			foreach ($data['tarifas'] as $tarifas):
				$caratula .='<td><input name="total_importe_'.$tarifas->idmoneda.'" class="form-control input-sm strong" type="text" readonly id="total_importe_'.$tarifas->idmoneda.'"></td>';
			endforeach;
			 
			$caratula .='</tr></table>';
			
			return $caratula;
		
    }
}
