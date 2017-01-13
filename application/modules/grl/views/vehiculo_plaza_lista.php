<h5><strong>Vehiculos</strong></h5>
<ul class="cai-vp-vehiculos">
	<?php foreach ($vehiculos as $vehiculo):?>
    <li class="cai-vp-vehiculo <?=$vehiculo->color?>" idplaza="<?=$idplaza?>" idvehiculo="<?=$vehiculo->idtipo_vehiculo?>" estado="<?=$vehiculo->estado?>" id="<?=$idplaza?>-<?=$vehiculo->idtipo_vehiculo?>"><?=$vehiculo->tipo_vehiculo?></li>
    <?php endforeach;?>
</ul>
<a class="btn btn-success cai-vp-orden" idplaza="<?=$idplaza?>">Mostrar orden <i class="fa fa-chevron-right"></i></a>
