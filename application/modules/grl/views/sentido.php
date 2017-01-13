<div class="page-header">
	<i class="fa fa-exchange fa-2x"></i> <span style="font-size:18px;">SENTIDOS</span> 
</div>
<div class="row">
  		<div class="col-md-4">
    		<div class="form-group">
    			<label for="inputPassword1" class="col-lg-2 control-label">Plaza</label>
    			<div class="col-lg-10">
                    <select name="input1" class="form-control" id="select-plaza-sentido">
                    	<option value="0">- SELECCIONE -</option>
                    <?php foreach ($plazas as $plaza):?>
                        <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
                    <?php endforeach?>
                    </select>
            	</div>
      		</div>
            <div class="detalle_cuerpo">
            </div> 
        </div>
  		<div class="col-md-8 detalle">
        </div>
	</div>  