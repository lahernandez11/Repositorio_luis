<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf_fpdf extends FPDF {
		public $fecha;
		public $plaza;
		public $carril;
		public $turno;
		public $operador;
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
            $this->Image('assets/img/hoatsa.png',10,8,22);
            $this->SetFont('Arial','B',13);
            $this->Cell(30);
            $this->Cell(120,10,'REPORTE PASO DE RESIDENTES',0,0,'C');
            $this->Ln('10');
			
			$this->SetFont('Arial', 'B', 8);        
			$this->SetFillColor(255,255,255);
			$this->Cell(30,5,'FECHA: '.$this->fecha,'',0,'L','1');
			$this->Cell(70,5,'PLAZA DE COBRO: '.$this->plaza,'',0,'L','1');
			$this->Ln('5');
			$this->Cell(30,5,'CARRIL: '.$this->carril,'',0,'L','1');
			$this->Cell(70,5,'TURNO: '.$this->turno,'',0,'L','1');
			$this->Cell(60,5,'OPERADOR: '.$this->operador,'',0,'L','1');		
			$this->Ln('7');
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
		   $this->Cell(0,10,'SAO - Grupo Hermes Infraestructura',0,0,'L');
           $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' de {nb}',0,0,'R');
      }
    }
?>