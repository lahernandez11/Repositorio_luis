<div class="page-header">
	<div class="btn-group pull-right" style="margin-left:5px;">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
        <ul class="dropdown-menu ayuda">
            <li><a href="<?=base_url('downloads/baw/v20140512_opi-registrar-respuesta.pdf')?>" download><i class="fa fa-file"></i> Registrar Respuesta</a></li>
        </ul>
    </div>
	<h5><b><a class="bom-menu" href="<?=base_url('baw/home/index')?>">
    <img src="<?=base_url('assets/img/1399334124_message_outline.png')?>"> BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / CONFIGURAR RESPUESTA AUTOM&Aacute;TICA</a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'registro'));?>
<div class="row">
	<div class="col-md-4">
    	<div class="square">
        	<h5><strong>TIPOS DE SOLICITUD</strong></h5>
            <br>
            Por favor, seleccione un tipo de solicitud:
            <br><br>
    		
          <div class="form-group">
            <label for="tipo_solicitud" class="col-sm-3 control-label">Tipo:</label>
            <div class="col-sm-9">
              <select name="tipo_solicitud" id="tipo_solicitud" class="form-control required campo-solicitud">
              	<option value="0">- SELECCIONE -</option>
				<?php foreach($tipos as $tipo):?>
                    <option value="<?=$tipo->idtipo_solicitud?>"><?=$tipo->tipo_solicitud?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="proyecto" class="col-sm-3 control-label">Proyecto:</label>
            <div class="col-sm-9">
              <select name="proyecto" id="proyecto" class="form-control required campo-solicitud">
              	<option value="0">- SELECCIONE -</option>
				<?php foreach($proyectos as $proyecto):?>
                    <option value="<?=$proyecto->idproyecto?>"><?=$proyecto->nombre_proyecto?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>          
        </div>
    </div>
    <div id="respuesta-automatica">
    
    </div>
</div>
<br>
<div class="row" align="center">
	<div class="col-md-12">
    	<a href="#" class="btn btn-primary vista_previa">Vista Previa</a>
    	<a href="<?=base_url('baw/home/index')?>" class="btn btn-warning">Cancelar</a>
        <button id="registro" type="button" class="btn btn-success">Registrar</button>
    </div>
</div>
<?=form_close();?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Vista Previa</h4>
      </div>
      <div class="modal-body">
      		<b><div id="asunto"></div></b><br>
            <div id="vista_previa" style="border: solid 1px #eee;">
        	<div id="cuerpo"></div><br>&nbsp;&nbsp;&nbsp;&nbsp;
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>