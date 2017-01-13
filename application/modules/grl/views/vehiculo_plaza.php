<div class="page-header">
          <i class="fa fa-truck fa-2x"></i> <span style="font-size:18px;">VEHICULOS POR PLAZA</span>
          <br><br>
          </div>
<div class="row">
  <div class="col-md-4" id="plazas">
  	<h5><strong>Plazas</strong></h5>
  	<select name="plaza" class="form-control cai-vp-plaza">
    	<option value="0">- SELECCIONE -</option>
        <?php foreach($plazas as $plaza):?>
        <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
        <?php endforeach;?>
    </select>
  </div>
  <div class="col-md-4" id="cai-vp-vehiculos">
  
  </div>
  <div class="col-md-4" id="cai-vp-posiciones">
  
  </div>
</div>