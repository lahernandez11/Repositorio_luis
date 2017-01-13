<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/consultar_small.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a> <a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>"> SOLICITUD DE FACTURACI&Oacute;N / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/consultar')?>">CONSULTAR SOLICITUDES</a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form'));?>
<div class="row">
	<div class="col-md-5">
    	<div class="square letra10">
        	<h5><strong>DATOS DE LA SOLICITUD</strong></h5>
            <br>
        	<div class="form-group">
            	<label for="ticket" class="col-sm-3 control-label">Folio: </label>
            		<div class="col-sm-9">
              			<label class="text-danger"><h5><?=$solicitudes[0]->folio?></h5></label>
            		</div>
          	</div>
          	<div class="form-group">
            	<label for="solicitante" class="col-sm-3 control-label">Escrito por: </label>
            	<div class="col-sm-9">
              		<input type="text" class="form-control letra10" value="<?=$solicitudes[0]->nombre_solicitante?>" readonly />
              		<br>
              		<input type="text" name="correo" id="correo" class="form-control letra10" value="<?=$solicitudes[0]->mail_solicitante?>"  disabled />
            	</div>
          	</div>
          	<div class="form-group">
            	<label for="tipo-solicitud" class="col-sm-3 control-label">Tipo:</label>
            	<div class="col-sm-9" >
              		<input type="text" class="form-control letra10" value="<?=$solicitudes[0]->tipo_solicitud?>" readonly />
            	</div>
          	</div>
          	<div class="form-group">
            	<label for="tema" class="col-sm-3 control-label">Tema:</label>
            	<div class="col-sm-9">
              		<input type="text" class="form-control letra10" value="<?=$solicitudes[0]->tema_solicitud?>" readonly />
            	</div>
          	</div>
          	<div class="form-group">
            	<label for="descripcion" class="col-sm-3 control-label">Descripci&oacute;n:</label>
            	<div class="col-sm-9">
              		<textarea class="form-control letra10" rows="10" readonly><?=$solicitudes[0]->mensaje_solicitud?></textarea>
            	</div>
          	</div>
        </div>
    </div>
    <div class="col-md-7">
    	<div class="square letra10">
        <?php if(sizeof($respuestas)>0):?>
        	<h5><strong>RESPUESTA</strong></h5>
            <br>
        	<div class="form-group">
            	<label for="respondio" class="col-sm-3 control-label">Respondio:</label>
            	<div class="col-sm-9">
              		<input type="text" class="form-control" value="<?=utf8_decode($respuestas[0]->usuario_respuesta)?>" readonly />
            	</div>
          	</div>
            <div class="form-group">
            	<label for="respondio" class="col-sm-3 control-label">Respuesta:</label>
            	<div class="col-sm-9">
              		<?=$respuestas[0]->respuesta?>
            	</div>
          	</div>
            <div class="form-group">
            	<label for="documentos" class="col-sm-3 control-label">Documentos adjuntos:</label>
            	<div class="col-sm-9">
              		<?php foreach ($documentos as $docto):?>
                    	<a href="<?=base_url('documents/baw/'.$docto->nombre_documento)?>" target="_blank"><?=$docto->nombre_documento?></a><br>
					<?php endforeach;?>
            	</div>
          	</div>
            <hr>
            <?php endif; ?>
            <h5><strong>DETALLE DE TICKETS</strong></h5>
            <table class="table table-bordered table-striped" style="font-size:11px;" border="1">
            	<thead>
                	<tr>
                    	<th>#</th>
                        <th>Folio</th>
                        <th>Plaza Cobro</th>
                        <th>Carril</th>
                        <th>Folio Evento</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Tarifa</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php $n=1; foreach ($solicitudes as $ticket):?>
                <tr>
                	<td><?=$n?></td>
                    <td><?=$ticket->folio_impreso?></td>
                    <td><?=$ticket->nombre_plaza?></td>
                    <td><?=$ticket->carril?></td>
                    <td><?=$ticket->folio_evento?></td>
                    <td><?=$ticket->fecha?></td>
                    <td><?=$ticket->hora?></td>
                    <td align="right"><?=$ticket->tarifa?></td>
                    <td><?=$ticket->estado?></td>
                </tr>
                <?php $n++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<div class="row">
	<div class="col-md-10"></div>
    <div class="col-md-2"><?=$siguiente?><?=$anterior?></div>
</div>
<div class="row" align="center">
<a href="<?=base_url('baw/facturacion/consultar')?>" class="btn btn-success">Aceptar</a>
</div>
<?=form_close();?>

