<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/signature_pen_document_text-32.png')?>"> <a class="bom-menu" href="<?=base_url('sgwc/reporte/index')?>">SGWC</a> / <a class="bom-menu" href="<?=base_url('sgwc/reporte/reporte_foto')?>">REPORTE FOTOGR&Aacute;FICO</a> / <a class="bom-menu" href="<?=base_url('sgwc/reporte/configuracion')?>">CONFIGURACI&Oacute;N / FIRMAS</a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'reporte'));?>
<fieldset>
	<h5><strong>FIRMAS</strong></h5>
        <a data-toggle="modal" href="#myModal" class="btn btn-success btn-agregar-firma pull-right"><i class="fa fa-plus"></i> Agregar</a>
    <br><br>			
    <div id="firma">     
    	<table id="example" class="table table-bordered table-striped table-condensed">
	<thead>
    	<tr>
            <th>#</th>    
            <th>Proyecto</th>    
			<th>Nombre Firma</th>    
            <th>Puesto</th>    
			<th>Estado</th>
            <th>Acci&oacute;n</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($firmas as $key=>$firma):?>
    	<tr>
        	<td><?=$key+1?></td>
            <td><?=$firma["nombre_proyecto"]?></td>
            <td><?=$firma["nombre_firma"]?></td>
            <td><?=$firma["puesto"]?></td>
            <td>
            	<a class="btn <?=$firma["color"]?> btn-mini cambiar" estado="<?=$firma["idestado"]?>" id="cambiar<?=$firma["idfirma"]?>" idelemento="<?=$firma["idfirma"]?>" ruta="admin/caballo/cambiar"><i class=" icon-white"></i></a>
            </td>
            <td>
            	<a data-toggle="modal" href="#myModal" class="btn btn-warning btn-xs btn-modificar-firma" id="<?=$firma["idfirma"]?>">
                	<i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
	<?php endforeach;?>
    </tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            	<div class="form">
                	<?=form_open('',array("class"=>"form-horizontal", "role"=>"form"));?>
                    <div class="form-group">
                    	<label for="input2" class="col-lg-3 control-label">Proyecto</label>
                        <div class="col-lg-9">
                        	<select name="input1" id="input1" class="form-control required" >
                            	<option value="0">-- SELECCIONE -- </option>
                                <?php foreach($proyectos as $proyecto):?>
                                	<option value="<?=$proyecto->idbase?>"><?=$proyecto->nombre_proyecto?></option> 
                                <?php endforeach;?>
                            </select>
                        </div>                        
                    </div>
                    <div class="form-group">
                    	<label for="input1" class="col-lg-3 control-label">Nombre Firma</label>
                        <div class="col-lg-9">
                        	<input type="text" class="form-control required" id="input2" name="input2" placeholder="Ingrese nombre">
                        </div>                        
                    </div>  
                    <div class="form-group">
                    	<label for="input1" class="col-lg-3 control-label">Puesto</label>
                        <div class="col-lg-9">
                        	<input type="text" class="form-control required" id="input3" name="input3" placeholder="Ingrese puesto">
                        </div>                        
                    </div>                                        
                </div>      
            </div>
            <div class="errores"></div>
            <input type="hidden" name="accion" id="accion" />
            <div class="modal-footer">
            	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="guardar" >Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 
   
	</div>
    
</fieldset>

<?=form_close();?>
