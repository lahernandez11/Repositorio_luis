<?php  foreach ($permisos as $permiso):?>
	<div class="permiso <?=$permiso->color?>" perfil="<?=$perfil?>" estado="<?=$permiso->estado?>" id="<?=$permiso->idmenu?>"><?=$permiso->nombre_menu?></div>
<?php endforeach;?>