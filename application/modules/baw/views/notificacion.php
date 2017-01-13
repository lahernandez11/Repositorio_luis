<div class="page-header">
	<div class="btn-group pull-right" style="margin-left:5px;">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
        <ul class="dropdown-menu ayuda">
            <li><a href="<?=base_url('downloads/baw/v20140512_opi-registrar-respuesta.pdf')?>" download><i class="fa fa-file"></i> Registrar Respuesta</a></li>
        </ul>
    </div>
	<h5><b><a class="bom-menu" href="<?=base_url('baw/home/index')?>">
    <img src="<?=base_url('assets/img/1420612726_icon-person-add-32.png')?>"> BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / USUARIOS NOTIFICACI&Oacute;N </a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'registro'));?>
<div class="row letra-10">
	<div class="col-md-3">
    	<div class="square">
        	<h5><strong>TIPOS DE SOLICITUD</strong></h5>
            <br>
            Por favor, seleccione un tipo de solicitud:
            <br><br>
    		
          <div class="form-group">
            <label for="tipo_solicitud" class="col-sm-3 control-label">Tipo:</label>
            <div class="col-sm-9">
              <select name="tipo_sol" id="tipo_sol" class="form-control required campo-sol letra-10">
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
              <select name="proyecto" id="proyecto" class="form-control required campo-sol letra-10">
              	<option value="0">- SELECCIONE -</option>
				<?php foreach($proyectos as $proyecto):?>
                    <option value="<?=$proyecto->idproyecto?>"><?=$proyecto->nombre_proyecto?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>          
        </div>
    </div>
    <div class="row letra-10" id="usuarios">
    
    </div>
</div>

<?=form_close();?>
