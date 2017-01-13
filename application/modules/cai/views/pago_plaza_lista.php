<h5><strong>Tipos de Pago</strong></h5>
<ul class="cai-pp-pagos">
	<?php foreach ($pagos as $pago):?>
    <li class="cai-pp-pago <?=$pago->color?>" idplaza="<?=$idplaza?>" idpago="<?=$pago->idtipo_pago?>" estado="<?=$pago->estado?>" id="<?=$idplaza?>-<?=$pago->idtipo_pago?>"><?=$pago->tipo_pago?></li>
    <?php endforeach;?>
</ul>
<a class="btn btn-success cai-pp-orden" idplaza="<?=$idplaza?>">Mostrar orden <i class="fa fa-chevron-right"></i></a>
