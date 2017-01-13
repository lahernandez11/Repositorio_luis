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
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS </a>/ <a class="bom-menu" href="<?=base_url('doc/contratos_concesion/index')?>">CONTRATOS DE CONCESI&Oacute;N </a>/ <a class="bom-menu" href="<?=base_url('doc/administracion/index')?>">ADMINISTRACI&Oacute;N </a> / SUBCATEGOR&Iacute;AS POR CONTRATO</h4>
</div>
<div class="row">
	<div class="col-md-4">
    <h5><strong>Contratos</strong></h5>
        	<select class="form-control" id="subcatxcont_contrato">
           		<option value="0">- SELECCIONE -</option>
                <?php foreach ($contratos as $contrato):?>
              		<option value="<?=$contrato->idcontrato?>"><?=$contrato->clave.'-'.$contrato->numero_contrato?></option>	
				<?php endforeach;?>
            </select>
    </div>
    <div class="col-md-4" id="lista-categorias">
    	<h5><strong>Categor&iacute;as</strong></h5>
        	<select class="form-control" id="subcatxcont_categoria">
           		<option value="0">- SELECCIONE -</option>
            </select>
    </div>
    <div class="col-md-4" id="lista-subcategorias">
    </div>
</div>