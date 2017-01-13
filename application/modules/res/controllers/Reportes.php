<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Reportes extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('reportes_model');
		$this->load->model('grl/general_model');
        $this->load->library('template');   
		$this->load->library('menu');
		$this->load->library('pdf_fpdf');
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
			$data['js'] = '<script src="'.base_url('assets/js/res.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			
			$this->template->load('template','reportes',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function paso_residentes_reporte()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);			
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/res.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			
			$data['carriles']=$this->reportes_model->desplega_carril($data['iduser']);
			$this->template->load('template','paso_residentes_reporte',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function desplega_reportes()
    { 
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);			
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/res.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			
			$data['carriles']=$this->reportes_model->desplega_carril($data['iduser']);
			$this->template->load('template','reportes',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
		
	public function genera_reporte()
	{
		if($this->session->userdata('id')):
     		$session_data = $this->session->userdata();
     		$data['usuario'] = $session_data['username'];
	 		$data['iduser'] = $session_data['id'];
			$data['idperfil'] = $session_data['idperfil'];
			$data["menu"] = $this->menu->crea_menu($data['idperfil']);			
			$data['css'] = '<link href="'.base_url('assets/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet">';
			$data['js'] = '<script src="'.base_url('assets/js/res.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker.min.js').'"></script>';
			$data['js'] .= '<script src="'.base_url('assets/js/bootstrap-datetimepicker-init.js').'"></script>';
			
			$turno=$this->input->post('select-turno');
			$carril=$this->input->post('select-carril');
			$fecha=$this->input->post('registro-fecha');
			$dia= date('Y-m-d', strtotime('+1 day'));
			if ($turno=='t' and $carril=='t'):
				$reportes=$this->reportes_model->desplega_reporte_todos($fecha);
				$vehiculo=$this->reportes_model->totales_vehiculo_todos($fecha);				 							
			elseif($turno=='t'):
				$reportes=$this->reportes_model->desplega_reporte_turno($fecha,$carril);
				$vehiculo=$this->reportes_model->totales_vehiculo_turno($fecha,$carril);
			elseif($carril=='t'):
				$reportes=$this->reportes_model->desplega_reporte_carril($fecha,$turno);
				$vehiculo=$this->reportes_model->totales_vehiculo_carril($fecha,$turno);
			else:
				if($turno==3):
				$reportes=$this->reportes_model->desplega_reporte_t($fecha,$turno,$carril,$dia);
				$vehiculo=$this->reportes_model->totales_vehiculo_reporte_t($fecha,$turno,$carril,$dia);
				else:
				$reportes=$this->reportes_model->desplega_reporte($fecha,$turno,$carril);
				$vehiculo=$this->reportes_model->totales_vehiculo($fecha,$turno,$carril);
				endif;				
			endif;
			//echo sizeof($reportes);
		if(sizeof($reportes)>0):
				
		if($turno=='t'):
			$t="TODOS";
			$o="TODOS";
		else:
			$t=$turno;
			$o=$reportes[0]['nombre'].' '.$reportes[0]['apaterno'].' '.$reportes[0]['amaterno'];
		endif;
		if($carril=='t'):
			$c="TODOS";
			$o="TODOS";
		else:
			$c=$reportes[0]['nombre_carril'];			
		endif;	
		if($carril=='t' and $turno=='t'):
			$c="TODOS";
			$o="TODOS";
		endif;
		
		$this->pdf_fpdf = new Pdf_fpdf();      
        $this->pdf_fpdf->fecha=$reportes[0]['fecha_vista'];
		$this->pdf_fpdf->plaza=$reportes[0]['nombre_plaza'];
		$this->pdf_fpdf->carril=$c;
		$this->pdf_fpdf->turno=$t;
		$this->pdf_fpdf->operador=$o;
		$this->pdf_fpdf->AddPage();
        $this->pdf_fpdf->AliasNbPages();
        $this->pdf_fpdf->SetLeftMargin(10);
        $this->pdf_fpdf->SetRightMargin(10);     
		    
        $this->pdf_fpdf->SetFont('Arial', '', 13);		
		$this->pdf_fpdf->SetFillColor(255);
		$this->pdf_fpdf->Cell(30,5,'RESUMEN POR TURNO Y CARRIL','',0,'L','1');
		$this->pdf_fpdf->Ln(5);
		
		$this->pdf_fpdf->SetFont('Arial', '', 7);
		$this->pdf_fpdf->SetFillColor(12,12,12); 
		$this->pdf_fpdf->SetTextColor(255); 
		$this->pdf_fpdf->Cell(10,3,'#','TBLR',0,'C','1');
		$this->pdf_fpdf->Cell(15,3,'TURNO','TBR',0,'C','1');
		$this->pdf_fpdf->Cell(30,3,'CARRIL','TBR',0,'C','1');	
		$this->pdf_fpdf->Cell(45,3,utf8_decode('VEHÍCULO'),'TBLR',0,'C','1');					
		$this->pdf_fpdf->Cell(30,3,'TOTAL','TBR',0,'C','1');
		$this->pdf_fpdf->Cell(30,3,'%','TBR',0,'C','1');
		$this->pdf_fpdf->Ln(3);
		$this->pdf_fpdf->SetFillColor(224,224,224);
		$this->pdf_fpdf->SetTextColor(12,12,12); 
		$fill = false;
		$y=1;
		$totales=0;
		$porciento=0;
		foreach($vehiculo as $ve):
			$totales=$totales+$ve['total'];
		endforeach;
		foreach ($vehiculo as $vehiculos) {
            $this->pdf_fpdf->Cell(10,3,$y++,'TBLR',0,'C',$fill);
			$this->pdf_fpdf->Cell(15,3,$vehiculos['turno'],'TBRL',0,'C',$fill);
			$this->pdf_fpdf->Cell(30,3,$vehiculos['nombre_carril'],'TBRL',0,'L',$fill);	
			$this->pdf_fpdf->Cell(45,3,$vehiculos['tipo_vehiculo'],'TBLR',0,'L',$fill);					
			$this->pdf_fpdf->Cell(30,3,$vehiculos['total'],'TBRL',0,'R',$fill);
			$this->pdf_fpdf->Cell(30,3,number_format((($vehiculos['total']/$totales)*100),1),'TBRL',0,'R',$fill);
			$this->pdf_fpdf->Ln(3);
			$fill=!$fill;
			$porciento=$porciento+number_format((($vehiculos['total']/$totales)*100),3);
		}
		$this->pdf_fpdf->SetFillColor(0);
		$this->pdf_fpdf->SetTextColor(255);  
		$this->pdf_fpdf->Cell(70,3,'','L',0,'L',1);
		$this->pdf_fpdf->Cell(30,3,'SUMA ','',0,'R',1);
		$this->pdf_fpdf->Cell(30,3,number_format($totales),'',0,'R',1);
		$this->pdf_fpdf->Cell(30,3,$porciento,'R',0,'R',1);
		$this->pdf_fpdf->Ln(5);
		
		$this->pdf_fpdf->Ln(5);
		$this->pdf_fpdf->SetFont('Arial', '', 13);	
		$this->pdf_fpdf->SetFillColor(255);
		$this->pdf_fpdf->SetTextColor(0);  
		$this->pdf_fpdf->Cell(30,5,'DETALLE DE PASOS DE RESIDENTES','',0,'L','1');
		$this->pdf_fpdf->Ln(5);
		
		$this->pdf_fpdf->SetFont('Arial', '', 7);	
		$this->pdf_fpdf->SetFillColor(255,255,255);		
		$this->pdf_fpdf->SetFillColor(0); // fondo de celda
		$this->pdf_fpdf->SetTextColor(255); // color del texto 
		$this->pdf_fpdf->Cell(10,3,'#','TBLR',0,'C','1');
        $this->pdf_fpdf->Cell(40,3,'IFE','TBLR',0,'C','1');
        $this->pdf_fpdf->Cell(40,3,'PLACAS','TBLR',0,'C','1');
        $this->pdf_fpdf->Cell(40,3,'TIPO','TBLR',0,'C','1');
        $this->pdf_fpdf->Cell(15,3,'HORA','TBLR',0,'C','1');
        $this->pdf_fpdf->Cell(40,3,'MUNICIPIO','TBR',0,'C','1');
        $this->pdf_fpdf->Ln(3);
        $x = 1;
		$this->pdf_fpdf->SetFillColor(224,224,224);
		$this->pdf_fpdf->SetTextColor(12,12,12); 
        $fill = false;
		foreach ($reportes as $reporte) {
            $this->pdf_fpdf->Cell(10,3,$x++,'TBLR',0,'C',$fill);
            $this->pdf_fpdf->Cell(40,3,$reporte['no_ife'],'TBLR',0,'L',$fill);
            $this->pdf_fpdf->Cell(40,3,$reporte['placas'],'TBRL',0,'L',$fill);
            $this->pdf_fpdf->Cell(40,3,$reporte['tipo_vehiculo'],'TBRL',0,'L',$fill);
            $this->pdf_fpdf->Cell(15,3,$reporte['hora'],'TBRL',0,'L',$fill);
            $this->pdf_fpdf->Cell(40,3,$reporte['municipio'],'TBRL',0,'L',$fill);
            $this->pdf_fpdf->Ln(3);
			$fill= !$fill;
		}	
				
		else:
		$this->pdf_fpdf = new Pdf_fpdf();      
        $this->pdf_fpdf->AddPage();
        $this->pdf_fpdf->AliasNbPages();
        $this->pdf_fpdf->SetLeftMargin(10);
        $this->pdf_fpdf->SetRightMargin(10);
         
        $this->pdf_fpdf->SetFont('Arial', 'B', 25);
        $this->pdf_fpdf->SetFillColor(255,255,255);
		$this->pdf_fpdf->Ln(10);
		$this->pdf_fpdf->Cell(160,7,'NO HAY RESULTADOS QUE MOSTRAR','',0,'C','1');
		endif;
		
        //$this->pdf_fpdf->Output("REPORTE PASO DE RESIDENTES.pdf", 'I');	
		$this->pdf_fpdf->Output("REPORTE PASO DE RESIDENTES-".$fecha.".pdf", 'D');		   
		else:
			redirect('login/index', 'refresh');
		endif;   		
	}
	
}
/*
*end modules/login/controllers/index.php
*/