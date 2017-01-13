<script>
$( "#sortable" ).sortable();
$( "#sortable" ).disableSelection();
</script>
<h5><strong>Orden</strong></h5>
<ul id="sortable" idplaza="<?=$idplaza?>">
	<?php foreach ($vehiculos as $vehiculo): ?>
    	<li idvehiculo="<?=$vehiculo->idtipo_vehiculo?>" class="orden_vehiculo"><i class="icon-move"></i><?=$vehiculo->tipo_vehiculo?></li>
    <?php endforeach;?>
</ul>
<a id="cai-vp-guardar_orden" class="btn btn-success" idplaza="<?=$idplaza?>">Guardar orden</a>
<br><br>