<div class="page-header">
	<i class="fa fa-unlock fa-2x"></i> <span style="font-size:18px;">PERMISOS</span>
</div>
<div class="row">
  		<div class="col-md-4">
        
    		<div class="form-group">
    			<label for="inputPassword1" class="col-lg-2 control-label">Perfi</label>
    			<div class="col-lg-10">
                    <select name="input1" class="form-control" id="select-perfil">
                    	<option value="0">- SELECCIONE -</option>
                    <?php foreach ($perfiles as $perfil):?>
                        <option value="<?=$perfil->idperfil?>"><?=$perfil->nombre_perfil?></option>
                    <?php endforeach?>
                    </select>
            	</div>
      		</div>
    	  
        </div>
  		<div class="col-md-5 detalle">
        </div>
	</div>  