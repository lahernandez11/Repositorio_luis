<style>
ul.lista{
	list-style:none;
	color:red;
	}
ul.lista li:hover{
	cursor:pointer;
	background-color:#eee;
	}
</style>
<div class="page-header">
	<h4><a class="bom-menu" href="<?=base_url('doc/home/index')?>"> 
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS / CONTRATOS DE CONCESI&Oacute;N </a>/ <a class="bom-menu" href="<?=base_url('doc/administracion/index')?>">ADMINISTRACI&Oacute;N </a> / CATEGOR&Iacute;AS POR PROYECTO</h4>
</div>
<div class="row">
	<div class="col-md-4">
    <h5><strong>Proyectos</strong></h5>
        	<select class="form-control" id="catxproy_proyecto">
           		<option value="0">- SELECCIONE -</option>
                <?php foreach ($proyectos as $proyecto):?>
              		<option value="<?=$proyecto->idproyecto?>"><?=$proyecto->nombre_proyecto?></option>	
				<?php endforeach;?>
            </select>
    </div>
    <div class="col-md-4" id="lista-categorias">
    </div>
</div>