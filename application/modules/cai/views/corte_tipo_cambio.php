<?php foreach ($tipo_cambio as $elemento):?>
<span style="width:50%;" class="label label-success"><?=$elemento->moneda?> = <?=$elemento->valor?></span>
<?php endforeach;?>
<?=$aviso?>