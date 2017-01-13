<div class="row letra11">
    <div class="col-md-5" id="origen" style="padding-left: 0px; padding-right: 0px;">
    	<b>ORIGEN</b> <br>
		<?php foreach($clases as $key=>$clase):?>
    	<li style="list-style:none" class="clases" id="C<?=$clase->idclase?>">
        	<i class="fa fa-plus-square-o abrir-clase" id_c="<?=$clase->idclase?>" id="c_<?=$clase->idclase?>" idclase="<?=$clase->idclase?>" idbase="<?=$clase->idbase?>"></i> 
			<span style="background:<?=$clase->color?>"><input <?=$clase->disabled?> type="checkbox" class="ch_clase" name="cl[]" value="<?=$clase->idclase?>" id="<?=$clase->idclase?>" idbase="<?=$clase->idbase?>" > <?=$clase->clase?></span> 
        	<div class="clases tipo<?=$clase->idclase?>" style="display:none;"></div>
        </li>
		<?php endforeach;?>
    </div>  
    
    <div class="col-md-1" id="enviar">
    	<button type="button" class="btn btn-default" id="btn-agregar" data-toggle="modal" data-target="#myModal"><i class="fa fa-share"></i></button>
        <br><br>
        <button type="button" class="btn btn-default" id="btn-eliminar" ><i class="fa fa-reply"></i></button>        
    </div>
    
    <div class="col-md-5" id="destino" style="padding-left: 0px; padding-right: 0px;">
    	<b>DESTINO</b> <br>
    	<?php foreach($clasesd as $clased):?>
    	<li style="list-style:none" class="clases" id="C<?=$clased->idclase?>">        	 			
          	<table>
            	<tr>
                	<td style="width:100%">
                	<i class="fa fa-plus-square-o abrir-clase_d" id="d_<?=$clased->idclase?>" idclase="<?=$clased->idclase?>" idbase="<?=$clased->idbase?>"></i> <span ><input <?=$clased->disabled?> type="checkbox" class="ch_clase_d" id="<?=$clased->idclase?>" value="<?=$clased->idnotificacion?>" name="cl_d[]" idbase="<?=$clased->idbase?>" > <?=$clased->clase?> <?=$clased->valor?> <?=$clased->abreviatura?>
            </span>
            	    </td>
                	<td >
                		<a id="n_<?=$clased->idnotificacion?>" id_n="<?=$clased->idnotificacion?>" idestado="<?=$clased->idestado?>" class="<?=$clased->color?> estado"><i class="<?=$clased->icon?> estado"></i></a>
                	</td>
                	<td>
                		<a  id="<?=$clased->idnotificacion?>" indicador="<?=$clased->indicador?>" class="<?=$clased->color_editar?>" data-toggle="modal" data-target="#myModal"><i class="<?=$clased->editar?>"></i></a> 
                	</td>
                </tr>
            </table>          
                    
        	<div class="clases_d tipo_d<?=$clased->idclase?>" style="display:none;"></div>
        </li>
		<?php endforeach;?>
    </div>  
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group"> 
            	<div class="col-md-9" id="contenedor-clases">
                </div>           	
            </div>
            <div class="form-group">
            	<label for="tiempo" class="col-md-3 control-label">Unidad de Tiempo</label>
                <div class="col-md-9" id="contenedor-tiempos">
                </div>                
            </div>
            <div class="form-group">            	
                <label for="valor" class="col-md-3 control-label">Tiempo</label>
                <div class="col-md-9">
                	<input type="text" name="valor" id="valor" class="form-control required" placeholder="Ingrese Tiempo" />
                </div>
            </div>            
        </div>
        <span id="errores" class="errores"></span>
        <input type="hidden" id="base" name="base" />
        <input type="hidden" id="idnotificacion" name="idnotificacion" />
        <div class="modal-footer">            
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-accion" id=""></button>
        </div>
      </div>
    </div>
</div>
