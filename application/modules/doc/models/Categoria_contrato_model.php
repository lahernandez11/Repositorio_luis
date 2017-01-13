<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categoria_contrato_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_contratos_activos($iduser)
	{
		$query = $this->db->query("select * from vw_doc_contrato_proyecto
where idproyecto in (select idproyecto from vw_grl_usuario_plaza WHERE idusuario=".$iduser." group by idproyecto) ORDER BY clave,numero_contrato"); 	
        return $query->result();
	}
	
	public function desplegar_categorias($idcontrato)
	{
		$query = $this->db->query("EXEC sp_doc_desplegar_categoria_contrato ".$idcontrato.""); 	
        return $query->result_array();
	}
	
	public function cambiar_categorias($idcategoria,$idcontrato,$idestado)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_eliminar_categoria_contrato $idcontrato,$idcategoria,$idestado"); 	
        return $query->result_array();
	}
	
}