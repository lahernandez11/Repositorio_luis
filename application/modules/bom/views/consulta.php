<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a>CONSULTA DE REPORTES</h4>
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
                <th>Seguimiento</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($reportes as $reporte): $n++;?>
            	<tr align="center">
                	<td align="left"><?=$n?></td>
                    <td>
                    	<?php if($reporte['idestado']==6):?>
                        	<a href="<?=base_url('documents/bom/'.$reporte['idreporte'].'.pdf');?>" target="_blank"><?=$reporte['folio']?></a>
                        <?php else:?>
   	                    	<a class="info" id="<?=$reporte['idreporte']?>" estado="<?=$reporte['idestado']?>" href="#Modal<?=$reporte['idreporte']?>" data-toggle="modal"><?=$reporte['folio']?></a>
                        <?php endif;?>
                    	<div class="modal fade" id="Modal<?=$reporte['idreporte']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="left">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Informaci&oacute;n</h4>
                              </div>
                              <div class="modal-body" id="contenido_<?=$reporte['idreporte']?>">                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </td>
                    <td><?=$reporte['nombre_area']?></td>
                    <td><?=character_limiter($reporte['nombre_tipofalla'],20)?></td>
                    <td><?=$reporte['fecha']?></td>
                    <td><?=$reporte['hora']?></td>
                    <td><span class="label label-<?=$reporte['color']?>"><?=$reporte['nombre_clasificacion']?></span></td>
                    <td>
                    <?php if($reporte['idestado']==6):?>
                    	Cerrado
                    <?php else:?>
					<?=$reporte['tiempo']?>
                    <?php endif;?>
                    </td>
                    <td>
                    	<?php for($i=1;$i<=6;$i++): ?> 
                        	<?php if($reporte['idestado']==$i): ?>                      
    <a idrepo="<?=$reporte['idreporte']?>" id="n<?=$reporte['idreporte'].$i?>" idr="<?=$reporte['idreporte'].$i?>" tr="<?=$reporte['idtiporeporte']?>" estado="<?=$i?>" class="detalle btn btn-success" data-placement="left"></a>
                        	<?php else: ?>
    <a idrepo="<?=$reporte['idreporte']?>" id="n<?=$reporte['idreporte'].$i?>" idr="<?=$reporte['idreporte'].$i?>" tr="<?=$reporte['idtiporeporte']?>" estado="<?=$i?>" class="detalle btn btn-default"></a>
							<?php endif ?>
                        <?php endfor ?>
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>
