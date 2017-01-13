<div class="form-group">
    			<label for="inputPassword1" class="col-lg-2 control-label">Cuerpo</label>
    			<div class="col-lg-10">
                	<input type="hidden" name="plaza" id="plaza" value="<?=$plaza?>">
                    <select name="input1" class="form-control" id="select-plaza-cuerpo">
                    	<option value="0">- SELECCIONE -</option>
                    <?php foreach ($cuerpos as $cuerpo):?>
                        <option value="<?=$cuerpo->idcuerpo?>"><?=$cuerpo->nombre_cuerpo?></option>
                    <?php endforeach?>
                    </select>
            	</div>
      		</div>