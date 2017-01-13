<div class="page-header">
	<h4><a href="<?=base_url('res/pasos/index')?>">
    <i class="fa fa-truck fa-2x bom-menu"></i> </a>REGISTRO PASO</h4>
</div>
<div class="row">
    	<div class="square">
        	<h5><strong>
            	<?php if($comercial==1):?>
                RESIDENTE COMERCIAL
                <?php else:?>
                RESIDENTE NO COMERCIAL
                <?php endif; ?>
                <br/><br/>INGRESA LOS CAMPOS SOLICITADOS
            </strong></h5>
            
            <h4>Carril: 
            <?php foreach ($carriles as $carril):?>
            	<?=$carril['nombre_carril']."-".$carril['nombre_plaza']?>
            <?php endforeach; ?>
            &nbsp;&nbsp;&nbsp;&nbsp; Turno: <?=$turno?>
            </h4>
            <br/>
            <div class="row">
              <div class="col-md-6">
              	Placas: 
                <input type="text" class="form-control required enter" name="placas" id="placas" tabindex="1" />
                <br/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              	<?php if($comercial==1):?>
                T.Vehicular / Eco :
                <input type="text" class="form-control required enter" name="ife" id="ife" tabindex="2" />
                <br/>
                <?php else:?>
                 Folio IFE: 
                <input type="text" class="form-control required enter" name="ife" id="ife"  tabindex="2"/>
                <br/>
                <?php endif;?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              	Tipo Vehiculo: 
                <select name="tipo-vehiculo" id="tipo-vehiculo" class="form-control required enter" tabindex="3">
                    <option value="0">- SELECCIONE -</option>
                    <?php foreach($vehiculos as $vehiculo):?>
                        <option value="<?=$vehiculo['idtipo_vehiculo']?>"><?=$vehiculo['tipo_vehiculo']?></option>
                    <?php endforeach;?>
                  </select>
                  <br/>
              </div>
              <input type="hidden" name="turno" id="turno" value="<?=$turno?>" />
              <input type="hidden" name="idcarril" id="idcarril" value="<?=$idcarril?>" />
              <input type="hidden" name="idplaza" id="idplaza" value="<?=$idplaza?>" />
              <input type="hidden" name="comercial" id="comercial" value="<?=$comercial?>" />
            </div>
            <div class="row">
              <div class="col-md-6">
              	<button id="b_continuar" class="btn btn-success" data-toggle="modal" data-target="#myModal" tabindex="4">Continuar</button>
              </div>                 
            </div>
            <br><br>
            	<span id="errores" class="errores"></span>                
                 
        </div>                 
                <div class="modal fade" data-controls-modal="your_div_id" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                    	<div class="modal-content">
                        	<div class="modal-header">                            	
                                <h4 class="modal-title">Informaci&oacute;n residente</h4>
                            </div>
                            	<div class="modal-body">
                                	<div class="form">
                                    	<?=form_open('res/pasos/tipo_residente',array("enctype" => "multipart/form-data","class"=>"form-horizontal", "role"=>"form"));?>
                                        	<div id="i_mensaje" class="form-group">
                                            	
                                          	</div>                                          	
                                          	<input type="hidden" value="<?=$idcarril?>" name="registro-carril">
                                          	<input type="hidden" value="<?=$turno?>" name="registro-turno">
                                        <?=form_close();?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  <button type="button" class="btn btn-success guardar-form-catalogo">Guardar</button>-->
                        		</div>
                    	</div><!-- /.modal-content -->
                	</div><!-- /.modal-dialog -->
                </div>          
</div>
<br>

          