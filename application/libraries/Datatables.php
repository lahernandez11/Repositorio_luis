<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Datatables 
{

	public function set_datatable($table,$key,$columnas)
	{
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = $key;
		   
		/* DB table to use */
		$sTable = $table;
		 
		/* Database connection information */
		$gaSql['user']       = "oaguayo";
		$gaSql['password']   = "2014_opc7";
		$gaSql['db']         = "popi";
		$gaSql['server']     = "PREFLAHERNANDEZ\SQLEXPRESS";
		 
		/*
		* Columns
		* If you don't want all of the columns displayed you need to hardcode $aColumns array with your elements.
		* If not this will grab all the columns associated with $sTable
		*/
		$aColumns = $columnas;
	 
	 	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		 * no need to edit below this line
		 */
	
		/*
		 * ODBC connection
		 */
		 
		
		// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
		// La conexión se intentará utilizando la autenticación Windows.
		$gaSql['link'] = mssql_connect('PREFLAHERNANDEZ\SQLEXPRESS', 'oaguayo', '2014_opc7');
		
		if (!$gaSql['link'] || !mssql_select_db('popi', $gaSql['link'])) {
			die('No se puede conectar o seleccionar una base de datos!');
		}	
		
		/* Ordering */
		//ORDER BY 2 ASC;
		$sOrder = "";		
		if (  $_GET['order'][0]["column"]==0 )  {
			$sOrder = "ORDER BY 1 ".$_GET['order'][0]['dir'];
		}
		else{
			$sOrder = "ORDER BY ".$_GET['order'][0]["column"]." ".$_GET['order'][0]['dir'];
		}
		   
		/* Filtering */
		$sWhere = "";
		if ( isset($_GET['search']['value']) && $_GET['search']['value'] != "" ) {
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
				$sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_GET['search']['value'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )  {
				if ( $sWhere == "" ) {
					$sWhere = "WHERE ";
				} else {
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".addslashes($_GET['sSearch_'.$i])."%' ";
			}
		}
		   
		/* Paging */
		//$top = (isset($_GET['iDisplayStart']))?((int)$_GET['iDisplayStart']):0 ;
		//$limit = (isset($_GET['iDisplayLength']))?((int)$_GET['iDisplayLength'] ):10;
		$top = intval($_GET['start']);
		$limit = intval($_GET['length']);
		
		$sQuery = "SELECT TOP $limit ".implode(",",$aColumns)."
			FROM $sTable
			$sWhere ".(($sWhere=="")?" WHERE ":" AND ")." $sIndexColumn NOT IN
			(
				SELECT $sIndexColumn FROM
				(
					SELECT TOP $top ".implode(",",$aColumns)."
					FROM $sTable
					$sWhere
					$sOrder
				)
				as [virtTable]
			)
			$sOrder";
		 
		$rResult = mssql_query($sQuery) or die("$sQuery: 1");
	  
		$sQueryCnt = "SELECT * FROM $sTable $sWhere";
		$rResultCnt = mssql_query( $sQueryCnt) or die (" $sQueryCnt: 2" );
		$iFilteredTotal = mssql_num_rows( $rResultCnt );
	  
		$sQuery = " SELECT * FROM $sTable ";
		$rResultTotal = mssql_query( $sQuery ) or die("Error 3");
		$iTotal = mssql_num_rows( $rResultTotal );
		   
		$output = array(
			"sEcho" => 0,
			"recordsTotal" => $iTotal,
			"recordsFiltered" => $iFilteredTotal,
			"data" => array()
		);
		   
		while ( $aRow = mssql_fetch_array( $rResult ) ) {
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
				if ( $aColumns[$i] != ' ' ) {
					$v = $aRow[ $aColumns[$i] ];
					$v = mb_check_encoding($v, 'UTF-8') ? $v : utf8_encode($v);
					$row[]=$v;
				}
			}
			if (!empty($row)) { $output['data'][] = $row; }
		}   
		echo json_encode( $output );
	}
}
?>
    
	