<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf_validacion extends FPDF {
		public $titulo;
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('http://opc.grupohi.mx/assets/img/logo_.png',15,12,30);
            $this->SetFont('Arial','B',13);
            $this->Cell(20);
            $this->Cell(145,10,utf8_decode('VALIDACIÓN AUTOMÁTICA'),0,0,'C');
			$this->SetFont('Arial','B',6);
			$this->Cell(10,10,'Consulta:'.date('Y-m-d H:i:s'),0,0,'C');
            $this->Ln('5');
			$this->SetFont('Arial','B',10);
			$this->Cell(185,10,utf8_decode('CORRESPONDIENDE AL DÍA ').$this->titulo,0,0,'C');
            $this->SetFont('Arial','B',6);
            $this->Cell(30);
            $this->Cell(120,10,'',0,0,'C');
            $this->Ln(10);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>