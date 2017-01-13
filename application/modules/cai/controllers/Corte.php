<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Corte extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('corte_model');
		$this->load->model('caratula_model');	
		$this->load->model('grl/general_model');
        $this->load->library('template');   
		$this->load->library('menu');
		$this->load->library('caratula');
    }
    
    public function index()
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
			$data['js'] .= '<script src="'.base_url('assets/js/cai-corte.js').'"></script>';
			$data['plazas'] = $this->general_model->desplega_plazas_usuario($session_data['id']);
			$this->template->load('template','corte',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	function carga_tipo_cambio()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['username'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$fecha = $this->input->post('fecha');
			$caseta = $this->input->post('caseta');
			$data['tipo_cambio'] = $this->corte_model->carga_tipo_cambio($fecha,$caseta);
			$data['tarifas'] = $this->corte_model->carga_tarifas($caseta);
			foreach($data['tarifas'] as $elemento):
				if($elemento->idmoneda==2):
					$data['tipo_cambio_actual'] = $this->corte_model->carga_tipo_cambio_actual($fecha);
					if(sizeof($data['tipo_cambio_actual'])==0):
						$data['aviso'] = '<span class="label label-warning" style="width:50%">No existe un tipo de cambio para esta fecha</span>';
					else:
						$data['aviso'] = "";
					endif;
				else:
					$data['aviso'] = "";
				endif;
			endforeach;
			$this->load->view('corte_tipo_cambio',$data);
   		endif;
	}
	
	function carga_bobina_activa()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['username'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$caseta = $this->input->post('caseta');
			$data['bobinas'] = $this->corte_model->cargar_bobina_activa($caseta);    
			$this->load->view('corte_bobina',$data);
   		else:
     		redirect('login', 'refresh');
   		endif;
	}
	
	function carga_caratula()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['username'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$caseta = $this->input->post('caseta');
			$data['caseta'] = $caseta;
			$data['lineas'] = $this->corte_model->cargar_lineas($caseta);
			$data['series'] = $this->corte_model->carga_series($caseta);
			$data['sentidos'] = $this->corte_model->carga_sentidos($caseta);
			$data['cuerpos'] = $this->corte_model->carga_cuerpos($caseta);
			$data['jefes'] = $this->corte_model->carga_perfiles($caseta,1);
			$data['cobradores'] = $this->corte_model->carga_perfiles($caseta,1);
			$data['caratula'] = $this->caratula->crea_caratula($data['iduser'],$caseta);
			$data['monedas'] = $this->corte_model->carga_monedas($caseta);
			$this->load->view('corte_caratula',$data);
   		else:
     		redirect('login', 'refresh');
   		endif;
	}
	
	function valida_folios()
	{
		$inicial = $this->input->get('inicial');
		$final = $this->input->get('final');
		$serie = $this->input->get('serie');
		$caseta = $this->input->get('caseta');
		$result = $this->corte_model->valida_folios_utilizados($inicial,$final,$serie,$caseta);
		$mensaje = $result[0]["mensaje"];
		if($mensaje=='no'):
			echo '{"kind":"green","msg":"ok"}';
		else:
			echo '{"kind":"red","msg":"El folio ha sido utilizado"}';
		endif;
	}
	
	function valida_folios_cancelados()
	{
		$cancelado = $this->input->get('cancelado');
		$serie = $this->input->get('serie');
		$caseta = $this->input->get('caseta');
		$result = $this->corte_model->valida_folios_cancelados($cancelado,$serie,$caseta);
		$mensaje = $result[0]["mensaje"];
		if($mensaje=='no'):
			echo '{"kind":"green","msg":"ok"}';
		else:
			echo '{"kind":"red","msg":"El folio ha sido utilizado"}';
		endif;	
	}

	function valida_folios_noemitidos()
	{
		$noemitido = $this->input->get('noemitido');
		$caseta = $this->input->get('caseta');
		$result = $this->corte_model->valida_folios_noemitidos($noemitido,$caseta);
		$mensaje = $result[0]["mensaje"];
		if($mensaje=='no'):
			echo '{"kind":"green","msg":"ok"}';
		else:
			echo '{"kind":"red","msg":"El folio ha sido utilizado"}';
		endif;	
	}
	
	function agregar()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['username'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];	
			$caseta = $this->input->post('idcaseta');
			//$tarifa = $this->input->post('tarifa');
			$linea = $this->input->post('linea');
			$sentido = $this->input->post('sentido');
			$cuerpo = $this->input->post('cuerpo');
			$fecha = $this->input->post('fecha');
			$turno = $this->input->post('turno');
			$jefe = $this->input->post('jefe');
			$cobrador = $this->input->post('cobrador');
			$retiros_parciales_1 = ($this->input->post('retiros_parciales_1')=="")?0:$this->input->post('retiros_parciales_1');
			$ultimo_retiro_1 = ($this->input->post('ultimo_retiro_1')=="")?0:$this->input->post('ultimo_retiro_1');
			$retiros_parciales_2 = ($this->input->post('retiros_parciales_2')=="")?0:$this->input->post('retiros_parciales_2');
			$ultimo_retiro_2 = ($this->input->post('ultimo_retiro_2')=="")?0:$this->input->post('ultimo_retiro_2');
			$presentacion = ($this->input->post('presentacion')=="")?0:$this->input->post('presentacion');
			$discrepancias = ($this->input->post('discrepancias')=="")?0:$this->input->post('discrepancias');
			$discrepancias_srv = ($this->input->post('discrepancias_srv')=="")?0:$this->input->post('discrepancias_srv');
			$errores = ($this->input->post('errores')=="")?0:$this->input->post('errores');
			$violaciones = ($this->input->post('violaciones')=="")?0:$this->input->post('violaciones');
			$violaciones_srv = ($this->input->post('violaciones_srv')=="")?0:$this->input->post('violaciones_srv');
			$reportes_admin = ($this->input->post('reportes_admin')=="")?0:$this->input->post('reportes_admin');
			$comentarios = $this->input->post('comentarios');
			
			
			$Vehiculos='';
			$Pagos='';
			$Totales='';
			/*$data["vehiculos"] = $this->caratula_model->carga_vehiculos($caseta);
			foreach($data["vehiculos"] as $vehiculo):
				$Vehiculos=$Vehiculos.$vehiculo->idtipo_vehiculo.',';
			endforeach;
			$data["pagos"] = $this->caratula_model->carga_tipos_pago($caseta);
			foreach($data["pagos"] as $pago):
				$Pagos=$Pagos.$pago->idtipo_pago.',';
			endforeach;*/
			$data["pagos"] = $this->caratula_model->carga_tipos_pago($caseta);
			$data["vehiculos"] = $this->caratula_model->carga_vehiculos($caseta);
			foreach ($data['pagos'] as $pago):
				foreach($data["vehiculos"] as $vehiculo):
				$valor = ($this->input->post($vehiculo->idtipo_vehiculo.'_'.$pago->idtipo_pago)=="")?0:$this->input->post($vehiculo->idtipo_vehiculo.'_'.$pago->idtipo_pago);
					$Totales=$Totales.$valor.',';
					$Pagos=$Pagos.$pago->idtipo_pago.',';
					$Vehiculos=$Vehiculos.$vehiculo->idtipo_vehiculo.',';
				endforeach;
			endforeach;
			
			/*echo 'Vehiculos='.$Vehiculos.'<br>';
			echo 'Pagos='.$Pagos.'<br>';
			echo 'Totales='.$Totales.'<br>';*/
			
			$noemitidos = $this->input->post('noemitidos');
			$Foliosnoemitidos = '';
			for($i=1;$i<=$noemitidos;$i++):
				$valor = ($this->input->post('noemitido'.$i)=="")?0:$this->input->post('noemitido'.$i);
				if($valor!=""):
					$Foliosnoemitidos=$Foliosnoemitidos.$valor.',';
				endif;
			endfor;
			
			
			$cancelados = $this->input->post('cancelados');
			$Folioscancelados = '';
			$FolioscanceladosSerie = '';
			for($j=1;$j<=$cancelados;$j++):
				$valor = ($this->input->post('cancelado'.$j)=="")?0:$this->input->post('cancelado'.$j);
				$serie = $this->input->post('serie_cancelado'.$j);
				if($valor>0):
					$Folioscancelados=$Folioscancelados.$valor.',';
					$FolioscanceladosSerie=$FolioscanceladosSerie.$serie.',';
				endif;
			endfor;
			
			
			$utilizados = $this->input->post('utilizados');
			$FoliosutilizadosInicial = '';
			$FoliosutilizadosFinal = '';
			$FoliosutilizadosSerie = '';
			for($k=1;$k<=$utilizados;$k++):
				$inicial = $this->input->post('inicial'.$k);
				$final = $this->input->post('final'.$k);
				$serie = $this->input->post('serie'.$k);
				if($inicial>0):
					$FoliosutilizadosInicial=$FoliosutilizadosInicial.$inicial.',';
					$FoliosutilizadosFinal=$FoliosutilizadosFinal.$final.',';
					$FoliosutilizadosSerie=$FoliosutilizadosSerie.$serie.',';
				endif;
			endfor;
			
			$Tarifas='';
			$data['tarifas'] = $this->corte_model->carga_tarifas($caseta);
			foreach($data['tarifas'] as $tarifa):
				$tarifa = $tarifa->idtarifa;
				$Tarifas=$Tarifas.$tarifa.',';
			endforeach;
			
			/*echo 'NE'.$Foliosnoemitidos.'<br>';
			echo 'CAN'.$Folioscancelados.'<br>';
			echo 'SER-CAN'.$FolioscanceladosSerie.'<br>';
			echo 'UTI-INI'.$FoliosutilizadosInicial.'<br>';
			echo 'UTI-FIN'.$FoliosutilizadosFinal.'<br>';
			echo 'UTI-SER'.$FoliosutilizadosSerie.'<br>';*/
			
			$result = $this->corte_model->agrega_corte($caseta,$linea,$sentido,$fecha,$turno,$jefe,$cobrador,$retiros_parciales_1,$ultimo_retiro_1,$data["iduser"],$cuerpo,$retiros_parciales_2,$ultimo_retiro_2,$presentacion,$discrepancias,$discrepancias_srv,$errores,$violaciones,$violaciones_srv,$reportes_admin,$comentarios,$Vehiculos,$Pagos,$Totales,$Tarifas,$FoliosutilizadosInicial,$FoliosutilizadosFinal,$FoliosutilizadosSerie,$Folioscancelados,$FolioscanceladosSerie,$Foliosnoemitidos);
			$mensaje=$result[0]["mensaje"];
			if($mensaje!='Error'):
				echo '<div class="alert alert-success"><i class="fa fa-check">
				</i> El corte ha sido guardado con &eacute;xito
				&nbsp;&nbsp;<a href="'.base_url('cai/corte/index').'"class="btn btn-success">Registrar nuevo corte</a>
				&nbsp;&nbsp;<a href="'.base_url('cai/reporte/corte_pdf/'.$mensaje).'"class="btn btn-success">Ver PDF</a>
				</div>';
			else:
				echo '<div class="alert alert-danger">
				<i class="fa fa-warning"></i> Ocurri&oacute; un error al tratar de guardar el corte
				&nbsp;&nbsp;<a href="'.base_url('cai/corte/index').'"class="btn btn-danger">Intentar nuevamente</a>
				</div>';
			endif;
			
		else:
			redirect('login', 'refresh');
		endif;
	}


	public function eliminar($idcorte)
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);
			$data['css'] = '';
			$data['js'] = '';
			$data["title"] ='REPORTE DE CORTE';
			$data["icon"]='fa-barcode';
			$data["link"]='cai/reporte/corte';
			$result = $this->corte_model->elimina_corte($idcorte);
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