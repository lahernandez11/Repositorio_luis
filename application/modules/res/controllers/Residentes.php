<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); 
class Residentes extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('residentes_model');
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data['elementos']=$this->residentes_model->total_pendicentes();
			$this->template->load('template','residentes',$data);    
		else:
			redirect('login/index', 'refresh');
		endif;   
    }
	
	public function desplega_localidad()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$municipio=$this->input->post('municipio');
			$data['localidades']=$this->residentes_model->desplega_localidad($municipio);
			foreach($data['localidades'] as $localidad):
				echo "<option value='".$localidad->idlocalidad."'>".$localidad->nombre_localidad."</option>";
			endforeach; 
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function consulta_residentes()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data['elementos']=$this->residentes_model->desplega_residentes();
			$data['municipios']=$this->residentes_model->desplega_municipio();
			$this->template->load('template','consulta_residentes',$data); 
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function busca_residentes()
	{			
		$busca=$this->input->post('busca');
		$data['elementos']=$this->residentes_model->busca_residentes($busca);
		if(sizeof($data['elementos'])>0):
			$data['municipios']=$this->residentes_model->desplega_municipio();
			$this->load->view('busca_residentes',$data);		
		else:
			echo "No se encontraron registros.";
		endif;
	}
	
	public function pendientes()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
					
			$this->template->load('template','pendientes',$data); 
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function busca_pendientes()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$busca=$this->input->post('busca');
			$data['elementos']=$this->residentes_model->desplega_pendientes($busca);
			$data['municipios']=$this->residentes_model->desplega_municipio();			
			if(sizeof($data['elementos'])>0):
			$this->load->view('busca_pendientes',$data); 
			else:
			echo "No se encontraron registros.";
			endif;
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function agregar()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data["title"] ='Residentes';
			$data["icon"]='fa-user';
			$data["link"]='res/residentes/consulta_residentes';
			$input1 = $this->input->post('input1');
			$input2 = $this->input->post('input2');
			$input3 = $this->input->post('input3');
			$input4 = $this->input->post('input4');
			$select1 = $this->input->post('select1');
			$select2 = $this->input->post('select2');
			$imagen_f =$_FILES['i_frente']['name'];
			$imagen_a =$_FILES['i_atras']['name'];
			
			if($imagen_f=="" and $imagen_a==""):
			$data["resultado"] = $this->residentes_model->agrega($input1,$input2,$input3,$input4,$select1,$select2,0,0);
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
					$data["result"]=0;
				endif;
			else:
			
				$config['upload_path'] = ('./documents/res/');
    			$config['allowed_types'] = 'gif|jpg|png';
			
				$this->load->library('upload', $config);
				$this->load->helper('file');
												
				$data["resultado"] = $this->residentes_model->agrega($input1,$input2,$input3,$input4,$select1,$select2,$imagen_f,$imagen_a);
			
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;					
				
					if ( ! $this->upload->do_upload('i_frente')):
						echo $this->upload->display_errors();
						$data["result"] = 0;					
					else:				
						$datos = array('i_frente' => $this->upload->data());
						$imagen1 = $datos["i_frente"]["file_name"];
						rename("./documents/res/".$imagen1,"./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
						/*REDIMENCIONAR*/
						$rutaImagenOriginal="./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg";
						$img_original = imagecreatefromjpeg($rutaImagenOriginal);
						$max_ancho = 200;
						$max_alto = 200;
						list($ancho,$alto)=getimagesize($rutaImagenOriginal);
						$x_ratio = $max_ancho / $ancho;
						$y_ratio = $max_alto / $alto;
						if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){ 
							$ancho_final = $ancho;
							$alto_final = $alto;
						}
						elseif (($x_ratio * $alto) < $max_alto){
							$alto_final = ceil($x_ratio * $alto);
							$ancho_final = $max_ancho;
						}
						else{
							$ancho_final = ceil($y_ratio * $ancho);
							$alto_final = $max_alto;
						}
						$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
						imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
						imagedestroy($img_original);
						$calidad=100;
						unlink("./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
						imagejpeg($tmp,"./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg",$calidad);									
						endif;
				
					if ( ! $this->upload->do_upload('i_atras')):
						echo $this->upload->display_errors();
						$data["result"] = 0;					
					else:				
						$datos = array('i_atras' => $this->upload->data());
						$imagen2 = $datos["i_atras"]["file_name"];
						rename("./documents/res/".$imagen2,"./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");	
						/*REDIMENCIONAR*/
						$rutaImagenOriginal="./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg";
						$img_original = imagecreatefromjpeg($rutaImagenOriginal);
						$max_ancho = 200;
						$max_alto = 200;
						list($ancho,$alto)=getimagesize($rutaImagenOriginal);
						$x_ratio = $max_ancho / $ancho;
						$y_ratio = $max_alto / $alto;
						if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){ 
							$ancho_final = $ancho;
							$alto_final = $alto;
						}
						elseif (($x_ratio * $alto) < $max_alto){
							$alto_final = ceil($x_ratio * $alto);
							$ancho_final = $max_ancho;
						}
						else{
							$ancho_final = ceil($y_ratio * $ancho);
							$alto_final = $max_alto;
						}
						$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
						imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
						imagedestroy($img_original);
						$calidad=100;
						unlink("./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");
						imagejpeg($tmp,"./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg",$calidad);			
						endif;					
				
											
			else:
				$data["result"]=0;
				endif;
			endif;				
				$this->template->load('template','mensaje',$data);			
					  
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function cambiar()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data["title"] ='Pendientes';
			$data["icon"]='fa-user';
			$data["link"]='res/residentes/pendientes';
			echo $id = $this->input->post("id");
			echo $input1 = $this->input->post("input1");
			echo $input2 = $this->input->post("input2");
			echo $input3 = $this->input->post("input3");
			echo $input4 = $this->input->post("input4");
			echo $select1 = $this->input->post("select1");
			echo $select2 = $this->input->post("select2");
			echo $imagen_f =$_FILES['i_frente']['name'];
			echo $imagen_a =$_FILES['i_atras']['name'];
			
			$config['upload_path'] = ('./documents/res/');
    		$config['allowed_types'] = 'gif|jpg|png';
			
			$this->load->library('upload', $config);
			$this->load->helper('file');
												
			if($imagen_a==""):
				$data["resultado"] = $this->residentes_model->cambia($id,$input1,$input2,$input3,$input4,$select1,$select2);
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
				$data["result"]=0;
				endif;
			elseif($imagen_f==""):
				$data["resultado"] = $this->residentes_model->cambia($id,$input1,$input2,$input3,$input4,$select1,$select2);
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
				$data["result"]=0;
				endif;
			else:
				$data["resultado"] = $this->residentes_model->cambia_imagen($id,$input1,$input2,$input3,$input4,$select1,$select2,$imagen_f,$imagen_a);
				if ( ! $this->upload->do_upload('i_frente')):
					echo $this->upload->display_errors();
					$data["result"] = 0;					
				else:				
					$datos = array('i_frente' => $this->upload->data());
					$imagen1 = $datos["i_frente"]["file_name"];
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
					rename("./documents/res/".$imagen1,"./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
					/*REDIMENCIONAR*/
					$rutaImagenOriginal="./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg";
					$img_original = imagecreatefromjpeg($rutaImagenOriginal);
					$max_ancho = 200;
					$max_alto = 200;
					list($ancho,$alto)=getimagesize($rutaImagenOriginal);
					$x_ratio = $max_ancho / $ancho;
					$y_ratio = $max_alto / $alto;
					if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){ 
						$ancho_final = $ancho;
						$alto_final = $alto;
					}
					elseif (($x_ratio * $alto) < $max_alto){
						$alto_final = ceil($x_ratio * $alto);
						$ancho_final = $max_ancho;
					}
					else{
						$ancho_final = ceil($y_ratio * $ancho);
						$alto_final = $max_alto;
					}
					$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
					imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
					imagedestroy($img_original);
					$calidad=100;
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
					imagejpeg($tmp,"./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg",$calidad);
				endif;
				
				if ( ! $this->upload->do_upload('i_atras')):
					echo $this->upload->display_errors();
					$data["result"] = 0;					
				else:				
					$datos = array('i_atras' => $this->upload->data());
					$imagen2 = $datos["i_atras"]["file_name"];
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");
					rename("./documents/res/".$imagen2,"./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");	
					/*REDIMENCIONAR*/
					$rutaImagenOriginal="./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg";
					$img_original = imagecreatefromjpeg($rutaImagenOriginal);
					$max_ancho = 200;
					$max_alto = 200;
					list($ancho,$alto)=getimagesize($rutaImagenOriginal);
					$x_ratio = $max_ancho / $ancho;
					$y_ratio = $max_alto / $alto;
					if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){ 
						$ancho_final = $ancho;
						$alto_final = $alto;
					}
					elseif (($x_ratio * $alto) < $max_alto){
						$alto_final = ceil($x_ratio * $alto);
						$ancho_final = $max_ancho;
					}
					else{
						$ancho_final = ceil($y_ratio * $ancho);
						$alto_final = $max_alto;
					}
					$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
					imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
					imagedestroy($img_original);
					$calidad=100;
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");
					imagejpeg($tmp,"./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg",$calidad);				
				endif;							
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
				$data["result"]=0;
				endif;
				
			endif;
				$this->template->load('template','mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function modifica()
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
			$data['js'] .= '<script src="'.base_url('assets/js/res.js').'"></script>';
			
			$data["title"] ='Pendientes';
			$data["icon"]='fa-user';
			$data["link"]='res/residentes/consulta_residentes';
			$id = $this->input->post("id");
			$input1 = $this->input->post("input1");
			$input2 = $this->input->post("input2");
			$input3 = $this->input->post("input3");
			$input4 = $this->input->post("input4");
			$select1 = $this->input->post("select1");
			$select2 = $this->input->post("select2");
			$imagen_f =$_FILES['imagen_f']['name'];
			$imagen_a =$_FILES['imagen_a']['name'];
			
			$config['upload_path'] = ('./documents/res/');
    		$config['allowed_types'] = 'gif|jpg|png';
			
			$this->load->library('upload', $config);
			$this->load->helper('file');
												
			if($imagen_a==""):
				$data["resultado"] = $this->residentes_model->cambia($id,$input1,$input2,$input3,$input4,$select1,$select2);
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
				$data["result"]=0;
				endif;
			elseif($imagen_f==""):
				$data["resultado"] = $this->residentes_model->cambia($id,$input1,$input2,$input3,$input4,$select1,$select2);
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
				$data["result"]=0;
				endif;
			else:
				$data["resultado"] = $this->residentes_model->cambia_imagen($id,$input1,$input2,$input3,$input4,$select1,$select2,$imagen_f,$imagen_a);
				if ( ! $this->upload->do_upload('imagen_f')):
					echo $this->upload->display_errors();
					$data["result"] = 0;					
				else:				
					$datos = array('imagen_f' => $this->upload->data());
					$imagen1 = $datos["imagen_f"]["file_name"];
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
					rename("./documents/res/".$imagen1,"./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
					/*REDIMENCIONAR*/
					$rutaImagenOriginal="./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg";
					$img_original = imagecreatefromjpeg($rutaImagenOriginal);
					$max_ancho = 200;
					$max_alto = 200;
					list($ancho,$alto)=getimagesize($rutaImagenOriginal);
					$x_ratio = $max_ancho / $ancho;
					$y_ratio = $max_alto / $alto;
					if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){ 
						$ancho_final = $ancho;
						$alto_final = $alto;
					}
					elseif (($x_ratio * $alto) < $max_alto){
						$alto_final = ceil($x_ratio * $alto);
						$ancho_final = $max_ancho;
					}
					else{
						$ancho_final = ceil($y_ratio * $ancho);
						$alto_final = $max_alto;
					}
					$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
					imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
					imagedestroy($img_original);
					$calidad=100;
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg");
					imagejpeg($tmp,"./documents/res/".$data["resultado"]["0"]["id"]."_f.jpg",$calidad);
				endif;
				
				if ( ! $this->upload->do_upload('imagen_a')):
					echo $this->upload->display_errors();
					$data["result"] = 0;					
				else:				
					$datos = array('imagen_a' => $this->upload->data());
					$imagen2 = $datos["imagen_a"]["file_name"];
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");
					rename("./documents/res/".$imagen2,"./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");	
					/*REDIMENCIONAR*/
					$rutaImagenOriginal="./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg";
					$img_original = imagecreatefromjpeg($rutaImagenOriginal);
					$max_ancho = 200;
					$max_alto = 200;
					list($ancho,$alto)=getimagesize($rutaImagenOriginal);
					$x_ratio = $max_ancho / $ancho;
					$y_ratio = $max_alto / $alto;
					if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){ 
						$ancho_final = $ancho;
						$alto_final = $alto;
					}
					elseif (($x_ratio * $alto) < $max_alto){
						$alto_final = ceil($x_ratio * $alto);
						$ancho_final = $max_ancho;
					}
					else{
						$ancho_final = ceil($y_ratio * $ancho);
						$alto_final = $max_alto;
					}
					$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
					imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
					imagedestroy($img_original);
					$calidad=100;
					unlink("./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg");
					imagejpeg($tmp,"./documents/res/".$data["resultado"]["0"]["id"]."_a.jpg",$calidad);		
				endif;							
				if ($data["resultado"][0]["mensaje"] == 'ok'):
					$data["result"]=1;
				else:
				$data["result"]=0;
				endif;
			endif;
				$this->template->load('template','mensaje',$data);
		else:
			redirect('login/index', 'refresh');
		endif; 
	}
	
	public function estado()
	{
		$id = $this->input->get("id");
		$estado = $this->input->get("estado");
		if($estado==2):$new=1;else:$new=2;endif;
		$data["result"] = $this->residentes_model->estado($id,$new);
		if($data["result"]>0):
			echo '{"msg":"ok"}';
		else:
			echo '{"msg":"ko"}';
		endif;
	}
	
}
/*
*end modules/login/controllers/index.php
*/