<?php if(sizeof($elementos)>0): ?>
<table id="example" class="table table-bordered table-striped table-condensed">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>Fecha</th>
                <th>Plaza</th>
                <th>Sentido</th>
                <th>Turno</th>
                <th>Linea</th>
                <th>Registra</th>
                <th>Aforo</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr>
                	<td><?=$n?></td>
                	<td><?=$elemento->fecha?></td>
                    <td><?=$elemento->nombre_plaza?></td>
                    <td><?=$elemento->nombre_sentido?></td>
                    <td><?=$elemento->turno?></td>
                    <td><?=$elemento->nombre_carril?></td>
                    <td><?=$elemento->nombre?> <?=$elemento->apaterno?> <?=$elemento->amaterno?></td>
                    <td><?=$elemento->aforo?></td>
                    <td align="center">
                    	<a href="<?=base_url('cai/reporte/corte_pdf/'.$elemento->idcorte)?>" class="btn btn-xs btn-primary">Ver PDF</a>
                        <?php if($idperfil==1||$idperfil==6||$idperfil==7):?>
						<a href="<?=base_url('cai/corte/eliminar/'.$elemento->idcorte)?>" class="btn btn-danger btn-xs">Eliminar</a> 
					<?php endif;?>
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
<?php else: ?>
	<div class="alert alert-warning">
    	<span><i class="fa fa-warning"></i>No hay registros que mostrar</span>
    </div>
<?php endif; ?>