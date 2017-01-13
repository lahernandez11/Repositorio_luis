<div class="page-header">
	<h4><a href="<?=base_url('grl/res/index')?>">
    	<i class="fa fa-truck fa-2x bom-menu"></i> </a>PASOS</h4>
</div>
<?=form_open('res/pasos/tipo_residente',array('class'=>'form-horizontal','role'=>'form','id'=>'registro'));?>
<div class="row">
    	<div class="square-res">
        	<h5><strong>INGRESA TODAS LAS OPCIONES</strong></h5>
            <br><br>
          <div class="row">
              <div class="col-md-6">
              	<label>1.- Turno</label>
                <select name="registro-turno" id="registro-turno" class="form-control required">
                    <option value="0">- SELECCIONE -</option>
                    <option value="1">- 1 -</option>
                    <option value="2">- 2 -</option>
                    <option value="3">- 3 -</option>                    
                  </select>              	
              </div>
              <div class="col-md-6">
              	<label>2.- Carril </label>
                <select name="registro-carril" id="registro-carril" class="form-control required">
                    <option value="0">- SELECCIONE -</option>
                    <?php foreach($carriles as $carril):?>
                        <option value="<?=$carril->idcarril?>"><?=$carril->nombre_plaza." - ".$carril->nombre_carril?></option>
                    <?php endforeach;?>
                  </select>
              </div>              
          </div> 
          <br/>
          <span id="errores" class="errores"></span>
        </div>    
</div>
<br>
<div class="row" align="center">
	<div class="col-md-12">
        <input type="submit" value="Continuar" class="btn btn-success">
    </div>
</div>
<br/>
<?=form_close();?>

          
          
