<div class="page-header">
          <i class="fa fa-ticket fa-2x"></i> <span style="font-size:18px;">TARIFAS</span>
          <a href="<?=base_url('cai/tarifa/index')?>" class="btn btn-success pull-right"><i class="fa fa-list"></i> Tarifas</a>
</div>
<div class="row">
	<div class="col-md-3">
        <h5><strong>Plazas</strong></h5>
        <select name="plaza" class="form-control cai-t-plaza">
        	<option value="0">- SELECCIONE -</option>
        <?php foreach($plazas as $plaza):?>
            <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
        <?php endforeach?>
        </select>
    </div>
    <div class="col-md-7" id="cai-t-tarifas">
    </div>
</div>