<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383246894_solutions.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. /</a>REGISTRO DE SOLUCI&Oacute;N
    <div class="btn-group pull-right" style="margin-left:5px;">
  		<a class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
  		<ul class="dropdown-menu ayuda">
    		<li><a href="<?=base_url('downloads/bom/v20140408_opi-registrar-solucion.pdf')?>" download><i class="fa fa-file"></i> Registrar Soluci&oacute;n</a></li>
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
                	<td><a class="info_s" id="<?=$reporte->idreporte?>" href="#Modal<?=$reporte->idreporte?>" data-toggle="modal"><?=$reporte->folio?></a>
                    	<div class="modal fade" id="Modal<?=$reporte->idreporte?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="left">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Informaci&oacute;n</h4>
                              </div>
                              <div class="modal-body" id="contenido_<?=$reporte->idreporte?>">                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </td>
                    <td><?=$reporte->nombre_area?></td>
                    <td><?=character_limiter($reporte->nombre_tipofalla,20)?></td>
                    <td><?=$reporte->fecha?></td>
                    <td><?=$reporte->hora?></td>
                    <td><span class="label label-<?=$reporte->color?>"><?=$reporte->nombre_clasificacion?></span></td>
                    <td><?=$reporte->tiempo?></td>
                    <td><a href="<?=base_url('bom/solucion/generales/'.$reporte->idreporte)?>">REGISTRAR</a></td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>