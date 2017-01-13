<div class="page-header">
          <i class="fa fa-credit-card fa-2x"></i> <span style="font-size:18px;">TIPOS DE PAGO POR PLAZA</span>
          <br><br>
          </div>
<div class="row">
  <div class="col-md-4" id="plazas">
  	<h5><strong>Plazas</strong></h5>
  	<select name="plaza" class="form-control cai-pp-plaza">
    	<option value="0">- SELECCIONE -</option>
        <?php foreach($plazas as $plaza):?>
        <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
        <?php endforeach;?>
    </select>
  </div>
  <div class="col-md-4" id="cai-pp-pagos">
  
  </div>
  <div class="col-md-4" id="cai-pp-posiciones">
  
  </div>
</div>