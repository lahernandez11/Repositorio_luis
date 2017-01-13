<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/268131_settings2-512.png')?>"> <a class="bom-menu" href="<?=base_url('sgwc/reporte/reporte_foto')?>">SGWC / REPORTE FOTOGR&Aacute;FICO / DESCARGA </a></b></h5>
</div>
<div class="row">
	<div class="col-md-10"><b> REPORTE FOTOGR&Aacute;FICO ATM </b></div>
    <div class="col-md-2"><b> DESCARGA </b></div>
</div>
<br>
<div class="row letra10">		
    <?php if(!empty($archivos)):?>  
	<?php foreach($archivos as $key=>$archivo):
    	$nombre=explode("/",$archivo);?>				        
		<div class="col-md-10"><?=substr($nombre[3],24)?></div>        
        <div class="col-md-2"><button type="button" id="d_<?=$key?>" class="btn btn-success loading-state descarga" data-archivo="<?=$nombre[3]?>">Descargar</button></div>    
	<?php endforeach;?>    
    <?php else:?>
    	No existen archivos para descargar
    <?php endif;?>
</div>