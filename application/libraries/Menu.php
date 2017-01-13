<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu {
	
	public function crea_menu($idperfil)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$menu ='<ul class="nav navbar-nav navbar-right">';
		$padres = $this->CI->index_model->carga_menu($idperfil,0);
		foreach ($padres as $padre):
			if($padre->idmenu==4||$padre->idmenu==1||$padre->idmenu==3||$padre->idmenu==33||$padre->idmenu==40):
				$menu.='<li><a href="'.base_url($padre->ruta).'">'.$padre->nombre_menu.'</a></li>';
			else:
				$menu.='<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$padre->nombre_menu.' <b class="caret"></b></a>
					<ul class="dropdown-menu">';
				$hijos =$this->CI->index_model->carga_menu($idperfil,$padre->idmenu);
				foreach ($hijos as $hijo):
					if($hijo->idmenu==17):
						$menu.='<li><a data-toggle="modal" href="'.$hijo->ruta.'">'.$hijo->nombre_menu.'</a></li>';
					else:
						$menu.='<li><a href="'.base_url($hijo->ruta).'">'.$hijo->nombre_menu.'</a></li>';
					endif;
				endforeach;
				$menu.='</ul></li>';
			endif;
		endforeach;
		$menu .='<ul>';
		return $menu;
	}
	
	public function crea_menu_principal($idperfil)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$opciones = $this->CI->index_model->carga_menu_principal($idperfil);
		$m = sizeof($opciones);
		$menu = '<div class="row">';
		if($m==1):$menu.='<div class="col-md-5"></div>';
		elseif($m==2):$menu.='<div class="col-md-4"></div>';
		elseif($m==3):$menu.='<div class="col-md-3"></div>';
		elseif($m==4):$menu.='<div class="col-md-2"></div>';
		elseif($m==5):$menu.='<div class="col-md-1"></div>';
		elseif($m==6):$menu.='';
		endif;
		foreach($opciones as $opcion):
			$menu.='<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<i class="'.$opcion->icono.' fa-5x"></i>
							<h3>'.$opcion->nombre_menu.'</h3>
						</a>
					</div>';
		endforeach;
		$menu.='</div>';
		return $menu;
	}
	
	/*public function crea_menu_mp($idperfil,$idusuario)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,5);
		$menu = '<div class="row">';
		$m=0;
		$n=0;
		foreach($opciones as $opcion):
			if($opcion->idmenu!=26):
				//echo $opcion->idmenu.'<br>';
				if($opcion->idmenu!=27):
					$m++;
				endif;
			endif;
		endforeach;
		if($m==1):
			$menu.='<div class="col-md-5"></div>';
		elseif($m==2):
			$menu.='<div class="col-md-4"></div>';
		elseif($m==3):
			$menu.='<div class="col-md-3"></div>';
		elseif($m==4):
			$menu.='<div class="col-md-2"></div>';
		elseif($m==5):
			$menu.='<div class="col-md-1"></div>';
		endif;
		//echo $m;
		foreach($opciones as $opcion):
			if($opcion->idmenu!=26):
				if($opcion->idmenu!=27):
				$id=$opcion->numero;
				$numero = $this->CI->bom_general_model->desplega_numero($id,$idusuario);
				if($numero[0]->total>0):
					$total = $numero[0]->total;
				else:
					$total='0';
				endif;
				$n++;
				if($opcion->idmenu!=20):
					$num='<h4 class="text-danger">'.$total.'</h4>';
				else:
					$num='';
				endif;
			$menu.='<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h4>PASO '.$n.'</h4>
							<h6>'.$opcion->nombre_menu.'</h6>
							'.$num.'
						</a>
						</div>';
				else:
					$menu.='<br><br>
					<div class="row">
						<div class="col-md-5"></div>
						<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h6>'.$opcion->nombre_menu.'</h6>
						</a>
						</div>
						<div class="col-md-5"></div>
					</div>';
				endif;
			else:
				$menu.='</div><br><br>
					<div class="row">
						<div class="col-md-5"></div>
						<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h6>'.$opcion->nombre_menu.'</h6>
						</a>
						</div>
						<div class="col-md-5"></div>
					</div>';
			endif;
		endforeach;
		/*foreach($opciones as $opcion):
			if($opcion->idmenu!=26):
				$id=$n;
				$numero = $this->CI->bom_general_model->desplega_numero($id,$idusuario);
				$n++;
				if($opcion->idmenu!=20):
					$num='<h4 class="text-danger">'.$numero[0]->total.'</h4>';
				else:
					$num='';
				endif;
				$menu.='<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h4>PASO '.$n.'</h4>
							<h6>'.$opcion->idmenu.'</h6>
							'.$num.'
						</a>
						</div>';
			
			else:
			$menu.='</div><br><br>
					<div class="row">
						<div class="col-md-5"></div>
						<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h6>'.$opcion->idmenu.'</h6>
						</a>
						</div>
						<div class="col-md-5"></div>
					</div>';
			endif;
		endforeach;*/
		//$menu .='</div>';
		//return $menu;	
	//}
	public function crea_menu_mp($idperfil,$idusuario)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,5);
		$menu = '<div class="row">';
		$m=0;
		$n=0;
		$permisos = array(26,27,39);
		foreach($opciones as $opcion):
			if(!in_array($opcion->idmenu,$permisos)):
				$m++;
			endif;
		endforeach;
		
		if($m==1):$menu.='<div class="col-md-5"></div>';
		elseif($m==2):$menu.='<div class="col-md-4"></div>';
		elseif($m==3):$menu.='<div class="col-md-3"></div>';
		elseif($m==4):$menu.='<div class="col-md-2"></div>';
		elseif($m==5):$menu.='<div class="col-md-1"></div>';
		endif;
		
		foreach($opciones as $opcion):
			if(!in_array($opcion->idmenu,$permisos)):
				$id=$opcion->numero;
				$numero = $this->CI->bom_general_model->desplega_numero($id,$idusuario);
				$total=($numero[0]->total>0)?$numero[0]->total:0;
				$n++;	
				
				if($opcion->idmenu!=20):
					$num='<h4 class="text-danger">'.$total.'</h4>';
				else:
					$num='';
				endif;
				$menu.='<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h4>PASO '.$n.'</h4>
							<h6>'.$opcion->nombre_menu.'</h6>
							'.$num.'
						</a>
						</div>';	
			endif;
		endforeach;
		$menu .='</div>';
		
		$menu.='<br><br><br><div class="row"><div class="col-md-3"></div>';
		foreach($opciones as $opcion):
			if(in_array($opcion->idmenu,$permisos)):
				$menu.='<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h6>'.$opcion->nombre_menu.'</h6>
						</a>
						</div>';
			endif;
		endforeach;
		$menu.='</div>';
		
		return $menu;
	}
	
	public function crea_menu_bitacora($idperfil)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,4);
		$menu = '<div class="row">';
		$m=0;
		$n=0;
		foreach($opciones as $opcion):
			$m++;
		endforeach;
		if($m==1):
			$menu.='<div class="col-md-5"></div>';
		elseif($m==2):
			$menu.='<div class="col-md-4"></div>';
		elseif($m==3):
			$menu.='<div class="col-md-3"></div>';
		elseif($m==4):
			$menu.='<div class="col-md-2"></div>';
		elseif($m==5):
			$menu.='<div class="col-md-1"></div>';
		endif;
		foreach($opciones as $opcion):
			/*$menu.='</div><br><br>
					<div class="row">
						<div class="col-md-5"></div>
						<div class="col-md-2 bom-menu" align="center">
						<a href="'.base_url($opcion->ruta).'">
							<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
							<h6><strong>'.$opcion->nombre_menu.'</strong></h6>
						</a>
						</div>
						<div class="col-md-5"></div>
					</div>';*/
			$menu.='<div class="col-md-2 bom-menu" align="center">
      					<a href="'.base_url($opcion->ruta).'">
       						<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
       						<h6><strong>'.$opcion->nombre_menu.'</strong></h6>
      					</a>
      				</div>';
		endforeach;
		$menu .='</div>';
		return $menu;
	}
	
	public function crea_menu_aforo($idperfil)
	 {
	  $this->CI =& get_instance();
	  $this->CI->load->model('login/index_model');
	  $this->CI->load->model('bom/bom_general_model');
	  $opciones = $this->CI->index_model->carga_menu($idperfil,1);
	  $m=0;
	  $n=0;
	  $o=0;
	  $menu = '<div class="row">';
	  foreach($opciones as $opcion):
	   if($opcion->idmenu!=31):
		if($opcion->idmenu!=37):
		 $m++;
		endif;
	   endif;
	  endforeach;
	  
	  if($m==1):
	   $menu.='<div class="col-md-5"></div>';
	  elseif($m==2):
	   $menu.='<div class="col-md-4"></div>';
	  elseif($m==3):
	   $menu.='<div class="col-md-3"></div>';
	  elseif($m==4):
	   $menu.='<div class="col-md-2"></div>';
	  elseif($m==5):
	   $menu.='<div class="col-md-1"></div>';
	  endif;
	  foreach($opciones as $opcion):
	   if($opcion->idmenu!=31):
		if($opcion->idmenu!=37):
		$menu.='<div class="col-md-2 bom-menu" align="center">
		 <a href="'.base_url($opcion->ruta).'">
		   <img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
		   <h6>'.$opcion->nombre_menu.'</h6>
		  </a>
		 </div>';
		endif;
	   endif;
	  endforeach;
	  $menu .='</div> <!--fin primer renglon de opciones-->';
	  
	  
	  $menu .= '<br><br><div class="row">';
	  foreach($opciones as $opcion):
	   if($opcion->idmenu==31):
		$o++;
	   else:
		if($opcion->idmenu==37):
		 $o++;
		endif;
	   endif;
	  endforeach;
	  
	  if($o==1):
	   $menu.='<div class="col-md-5"></div>';
	  elseif($o==2):
	   $menu.='<div class="col-md-4"></div>';
	  endif;
	  foreach($opciones as $opcion):
	   if($opcion->idmenu==31):
		$menu.='<div class="col-md-2 bom-menu" align="center">
		 <a href="'.base_url($opcion->ruta).'">
		   <img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
		   <h6>'.$opcion->nombre_menu.'</h6>
		  </a>
		 </div>';
	   else:
		if($opcion->idmenu==37):
		 $menu.='<div class="col-md-2 bom-menu" align="center">
		 <a href="'.base_url($opcion->ruta).'">
		   <img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
		   <h6>'.$opcion->nombre_menu.'</h6>
		  </a>
		 </div>';
		endif;
	   endif;
	  endforeach;
	  $menu .='</div> <!--fin segundo renglon de opciones-->';
	  
	  return $menu; 
	 }
	
	public function crea_menu_res($idperfil)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,3);
		$menu = '<div class="row" align="center">';				
		foreach($opciones as $opcion):
			if($opcion->idmenu==35):
			$menu.='<div class="col-md-5 bom-menu " align="center">
			 <a href="'.base_url($opcion->ruta).'">
			   <i class="'.$opcion->icono.' fa-4x"></i>
			   <h6>'.$opcion->nombre_menu.'</h6>
			  </a>
			 </div>';
			else:
			$menu.='<div class="col-md-4 bom-menu">
				<a href="'.base_url($opcion->ruta).'">
					<i class="'.$opcion->icono.' fa-4x"></i>
					<h6>'.$opcion->nombre_menu.'</h6>
					</a>
				</div>';
			endif;
						
		endforeach;
		
		$menu .='</div>';
		return $menu;	
	}
	
	public function crea_menu_baw($idperfil)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,28);
		$menu = '<div class="row" align="center">';				
		foreach($opciones as $opcion):
			
			$menu.='<div class="col-md-3 bom-menu" align="center">
					<a href="'.base_url($opcion->ruta).'">
						<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">	
						<h6>'.$opcion->nombre_menu.'</h6>			
					</a>
				</div>';
		
						
		endforeach;
		
		$menu .='</div>';
		return $menu;	
	}
	
	public function crea_menu_repfot($idperfil)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,33);
		$menu = '<div class="row" align="center">';				
		foreach($opciones as $opcion):			
			if($opcion->idmenu==34 or $opcion->idmenu==41 or $opcion->idmenu==47):
				$menu.='<div class="col-md-4 bom-menu">
				<a href="'.base_url($opcion->ruta).'">
					<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
					<h6><strong>'.$opcion->nombre_menu.'</strong></h6>
					</a>
				</div>';
			else:
			$menu.='<div class="col-md-6 bom-menu">
				<a href="'.base_url($opcion->ruta).'">
					<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
					<h6><strong>'.$opcion->nombre_menu.'</strong></h6>
					</a>
				</div>';
			endif;			
		endforeach;
		
		$menu .='</div>';
		return $menu;	
	}
	
	public function crea_submenu_repfot($idperfil,$idmenu)
	{
		$this->CI =& get_instance();
		$this->CI->load->model('login/index_model');
		$this->CI->load->model('bom/bom_general_model');
		$opciones = $this->CI->index_model->carga_menu($idperfil,$idmenu);
		$menu = '<div class="row" align="center">';				
		foreach($opciones as $opcion):			
			$menu.='<div class="col-md-6 bom-menu">
				<a href="'.base_url($opcion->ruta).'">
					<img src="'.base_url('assets/img/'.$opcion->icono).'" class="img-responsive">
					<h6><strong>'.$opcion->nombre_menu.'</strong></h6>
					</a>
				</div>';
						
		endforeach;
		
		$menu .='</div>';
		return $menu;	
	}
}