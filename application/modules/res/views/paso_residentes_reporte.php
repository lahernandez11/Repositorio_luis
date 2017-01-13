<div class="page-header">
	<h4><a href="<?=base_url('res/reportes/index')?>">
    <i class="fa fa-tasks bom-menu fa-2x"></i> </a>REPORTES</h4>
</div>
<?=form_open('res/reportes/genera_reporte',array("id" => "reporte" ,"class" => "form-horizontal validar", "role"=>"form"));?>
<div class="row">
    	<div class="square-res">
        	<h5><strong>Reporte por turno</strong></h5>
            <br><br>
          <div class="row">
          	<div class="col-md-3">
            	<label>Turno</label>
                <select class="form-control required" name="select-turno" id="select-turno">
                	<option value="0" >--SELECCIONE--</option>
                    <option value="1">-- 1 --</option>
                    <option value="2">-- 2 --</option>
                    <option value="3">-- 3 --</option>
                    <option value="t"> TODOS </option>
                </select>
            </div>
            <div class="col-md-3">
            	<label>Carril</label>
                <select class="form-control required" name="select-carril" id="select-carril">
                	<option value="0" >--SELECCIONE--</option>
                    <?php foreach ($carriles as $carril):?>
                    <option value="<?=$carril->idcarril?>"><?=$carril->nombre_plaza?> - <?=$carril->nombre_carril?></option>
                    <?php endforeach; ?>
                    <option value="t"> TODOS </option>
                </select>
            </div>     
            <div class="col-md-3">
            	<label>Fecha </label>
                <div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="registro-fecha">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>                
                </div>
            </div>                           
            <div class="col-md-3">
            	<input type="submit" value="Generar" class="btn btn-success">
            </div>                
          </div> 	
          <br/>
          <span id="errores" class="errores"></span>
        </div>    
</div>
<br>
<?=form_close();?>
