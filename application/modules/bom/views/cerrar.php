<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383252640_handshake.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a> CERRAR REPORTE
    <div class="btn-group pull-right" style="margin-left:5px;">
  		<a class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
  		<ul class="dropdown-menu ayuda">
    		<li><a href="<?=base_url('downloads/bom/v20140303_opi-cerrar-reporte.pdf')?>" download><i class="fa fa-file"></i> Cerrar Reporte</a></li>
  		</ul>
	</div>
    </h4>
</div>
<div class="row">
<table id="example" class="table table-bordered table-striped table-condensed">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>Folio<br>Reporte</th>
                <th>&Aacute;rea<br>Afectaci&oacute;n</th>
                <th>Tipo<br>Falla</th>
                <th>Fecha<br>Falla</th>
                <th>Hora<br>Falla</th>
                <th>Clasificaci&oacute;n</th>
                <th>Tiempo<br>Transcurrido<br>(hh:mm)</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($reportes as $reporte): $n++;?>
            	<tr align="center">
                	<td align="left"><?=$n?></td>
                	<td><a href="<?=base_url('documents/bom/'.$reporte->idreporte.'.pdf');?>" target="_blank"><?=$reporte->folio?></a>
                    </td>
                    <td><?=$reporte->nombre_area?></td>
                    <td><?=character_limiter($reporte->nombre_tipofalla,20)?></td>
                    <td><?=$reporte->fecha?></td>
                    <td><?=$reporte->hora?></td>
                    <td><span class="label label-<?=$reporte->color?>"><?=$reporte->nombre_clasificacion?></span></td>
                    <td><?=$reporte->tiempo?></td>
                    <td>
                    	<a href="#Modal<?=$reporte->idreporte?>" data-toggle="modal" class="abrir-observaciones" idreporte="<?=$reporte->idreporte?>" idsolucion="<?=$reporte->idregistro_solucion?>">CERRAR</a>
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
    <?php foreach ($reportes as $reporte):?>
    <div class="modal fade" id="Modal<?=$reporte->idreporte?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="left">
    <?=form_open(base_url('bom/cerrar/cerrar_reporte'),array('class'=>'form-horizontal','role'=>'form'))?>
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Cerrar reporte</h4>
                              </div>
                              <div class="modal-body">   
                              <div class="form-group">
                                <label for="observaciones" class="col-md-3 control-label">Observaciones</label>
                                <div class="col-md-9">
                                  <textarea name="observaciones" id="observaciones" class="form-control">SIN OBSERVACIONES.</textarea>
                                </div>
                              </div> 
                              <div id="tabla-remplazo"></div>                          
                              </div>
                              <div class="modal-footer">
                              	<input type="hidden" name="id" value="<?=$reporte->idreporte?>">
                                <input type="hidden" name="folio" value="<?=$reporte->folio?>">
                                <input type="hidden" name="idsolucion" value="<?=$reporte->idregistro_solucion?>">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-success" value="Aceptar">
                              </div>
                            </div>
                          </div>
	 <?=form_close()?> 
     </div>
    <?php endforeach?>
</div>