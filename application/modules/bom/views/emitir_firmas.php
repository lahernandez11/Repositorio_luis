<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383354398_purchase_order.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a><a class="bom-menu" href="<?=base_url('bom/emitir/index')?>">EMITIR REPORTE</a></h4>
</div>
<?=form_open_multipart('bom/emitir/registrar',array('class'=>'form-horizontal','role'=>'form','id'=>'emitir_registrar'));?>
<div class="row">
	<div class="col-md-12">
    	<div class="square">
        	<h5><strong>SUBIR DOCUMENTO DEL REPORTE</strong></h5>
            <br>
        	<div>
					<?=$result[0]["folio"]?>
                	<br>
                	<span class="label label-<?=$result[0]["color"]?>"><?=$result[0]["nombre_clasificacion"]?></span>
           	</div>
            <br><br>	
            <div class="form-group">
                <label for="userfile" id="userfile" class="col-sm-1 control-label required">Documento</label>
                <div class="col-sm-10">
                <input type="file" name="userfile" id="userfile" size="20" />
                </div>
            </div>
    	</div>	
    </div>
</div>
<br>
<input type="hidden" value="<?=$idreporte?>" name="idreporte">
<input type="hidden" value="<?=$result[0]["idtiporeporte"]?>" name="idtipo">
<input type="hidden" value="<?=$result[0]["idclasificacion"]?>" name="idclasificacion">
<div class="row" align="center">
	<div class="col-md-12" id="botones">
        <a href="<?=base_url('bom/emitir/index')?>" class="btn btn-warning">Cancelar</a>
        <input type="submit" value="Subir documento" class="btn btn-success">
    </div>
</div>
<?=form_close()?>
<br>