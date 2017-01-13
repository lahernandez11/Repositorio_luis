<script>
$( "#sortable" ).sortable();
$( "#sortable" ).disableSelection();
</script>
<h5><strong>Orden</strong></h5>
<ul id="sortable" idplaza="<?=$idplaza?>">
	<?php foreach ($pagos as $pago): ?>
    	<li idpago="<?=$pago->idtipo_pago?>" class="orden_pago"><i class="icon-move"></i><?=$pago->tipo_pago?></li>
    <?php endforeach;?>
</ul>
<a id="cai-pp-guardar_orden" class="btn btn-success" idplaza="<?=$idplaza?>">Guardar orden</a>
<br><br>