<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399338062_change_user.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>">SOLICITUD DE FACTURACI&Oacute;N</a> / CARGAR TICKETS</b></h5>
</div>
<div class="row">
	<form enctype="multipart/form-data" class="form-horizontal formulario" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-1 control-label">Plaza</label>
    <div class="col-sm-4">
      <select name="plaza" id="plaza" class="form-control">
            	<option value="0">- SELECCIONE PLAZA- </option>
				<?php foreach ($plazas as $plaza):?>
                <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
                <?php endforeach;?>
            </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-1 control-label">Archivo</label>
    <div class="col-sm-11">
      <input type="file" name="archivo" id="archivo" title="Selecciona archivo Excel"/>
    </div>
  </div>
  
  <div class="radio col-sm-offset-1 col-sm-10">
  <label>
    <input type="radio" name="tipo_fecha" id="optionsRadios1" value="1" checked>
    Formato de fecha dd/mm/aaaa
  </label>
  </div>
  <div class="radio col-sm-offset-1 col-sm-10">
  <label>
    <input type="radio" name="tipo_fecha" id="optionsRadios2" value="2">
    Formato de fecha mm/dd/aaaa
  </label>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-4"><br>
      <input type="button" value="Enviar" class="btn btn-primary" id="btn-cargar-tickets"/>
    </div>
  </div>
</form>


	<!--<form enctype="multipart/form-data" class="formulario" role="form form-horizontal">
  		<div class="form-group">
        	<label class="col-md-1 control-label" for="exampleInputEmail2" class="">Plaza</label>
            <div class="col-md-6">
            
            </div>
        </div>
        <div class="form-group">
    		<label class="col-md-1" for="exampleInputEmail2">Archivo</label>
            <div class="col-md-6">
    		
            </div>
  		</div>
        <div class="form-group">
        	
        	
        </div>
  		
	</form>-->
    <br>    
    <!--div para visualizar mensajes-->
    <div class="messages"></div><br /><br />
    <!--div para visualizar en el caso de imagen-->
    <div class="showImage"></div>
</div>
