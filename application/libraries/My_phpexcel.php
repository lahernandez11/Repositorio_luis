<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_PHPExcel {
	public function My_PHPExcel()
	{
    	require_once('PHPExcel.php');
		require_once('PHPExcel/IOFactory.php');
	}
}
?>