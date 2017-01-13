<strong>Distribuci&oacute;n de fotograf&iacute;as:</strong>
<br/><br/>
<div class="row">    
        <?php if($ordenacion[0]->fotos==3):?>
        <div class="col-md-8 square">        
        <table style="text-align:center" width="100%">
        	<tr><td colspan="3" height="40"></td></tr>
            <tr>
            	<td><i class="fa fa-picture-o fa-5x"></i></td>
                <td width="20%"></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
            </tr>
            <tr>
            	<td>Orden <input style="text-align:center" name="orden1" type="text" class="form-control orden" value="<?=$ordenacion[0]->orden?>" readonly>
                	<input type="hidden" name="des1" class="descrip" value="<?=$ordenacion[0]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd1" id="des_<?=$ordenacion[0]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[0]->descripcion?></textarea>
                </td>
                <td width="30%"></td>
                <td>Orden <input style="text-align:center" name="orden2" type="text" class="form-control orden" value="<?=$ordenacion[1]->orden?>" readonly>
                	<input type="hidden" name="des2" class="descrip" value="<?=$ordenacion[1]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd2" id="des_<?=$ordenacion[1]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[1]->descripcion?></textarea>
                </td>
            </tr>
            <tr><td colspan="3" height="90"></td></tr>
            <tr>
            	<td></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
                <td></td>
            </tr>
            <tr>
            	<td></td>
                <td>Orden <input style="text-align:center" name="orden3" type="text" class="form-control orden" value="<?=$ordenacion[2]->orden?>" readonly>
                	<input type="hidden" name="des3" class="descrip" value="<?=$ordenacion[2]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd3" id="des_<?=$ordenacion[2]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[2]->descripcion?></textarea>
                </td>
                <td></td>
            </tr>
        </table>
        <br/>
        P&aacute;gina 1
        </div>
        <?php elseif($ordenacion[0]->fotos==4):?>
        <div class="col-md-8 square">        
        <table style="text-align:center" width="100%">        	
        	<tr><td colspan="4" height="40"></td></tr>
            <tr>
            	<td><i class="fa fa-picture-o fa-5x"></i></td>
                <td width="20%"></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
            </tr>
            <tr>
            	<td>Orden <input style="text-align:center" name="orden1" type="text" class="form-control orden" value="<?=$ordenacion[0]->orden?>" readonly>
                	<input type="hidden" name="des1" class="descrip" value="<?=$ordenacion[0]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd1" id="des_<?=$ordenacion[0]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[0]->descripcion?></textarea>
                </td>
                <td width="30%"></td>
                <td>Orden <input style="text-align:center" name="orden2" type="text" class="form-control orden" value="<?=$ordenacion[1]->orden?>" readonly>
                	<input type="hidden" name="des2" class="descrip" value="<?=$ordenacion[1]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd2" id="des_<?=$ordenacion[1]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[1]->descripcion?></textarea>
                </td>
            </tr>
            <tr><td colspan="4" height="90"></td></tr>
            <tr>
            	<td><i class="fa fa-picture-o fa-5x"></i></td>
                <td></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
            </tr>
            <tr>
            	<td>Orden <input style="text-align:center" name="orden3" type="text" class="form-control orden" value="<?=$ordenacion[2]->orden?>" readonly>
                	<input type="hidden" name="des3" class="descrip" value="<?=$ordenacion[2]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd3" id="des_<?=$ordenacion[2]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[2]->descripcion?></textarea>
                </td>
                <td></td>
                <td>Orden <input style="text-align:center" name="orden4" type="text" class="form-control orden" value="<?=$ordenacion[3]->orden?>" readonly>
                	<input type="hidden" name="des4" class="descrip" value="<?=$ordenacion[3]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd4" id="des_<?=$ordenacion[3]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[3]->descripcion?></textarea>
                </td>
            </tr>
        </table>
        <br/>
        P&aacute;gina 1
        </div>    
        <?php elseif($ordenacion[0]->fotos==5):?>
        <div class="col-md-5  square">        
        <table style="text-align:center" width="100%">
        	<tr><td colspan="3" height="10"></td></tr>
            <tr>
            	<td><i class="fa fa-picture-o fa-5x"></i></td>
                <td width="30%"></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
            </tr>
            <tr>
            	<td>Orden <input style="text-align:center" name="orden1" type="text" class="form-control orden" value="<?=$ordenacion[0]->orden?>" readonly>
                	<input type="hidden" name="des1" class="descrip" value="<?=$ordenacion[0]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd1" id="des_<?=$ordenacion[0]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[0]->descripcion?></textarea>
                </td>
                <td width="30%"></td>
                <td>Orden <input style="text-align:center" name="orden2" type="text" class="form-control orden" value="<?=$ordenacion[1]->orden?>" readonly>
                	<input type="hidden" name="des2" class="descrip" value="<?=$ordenacion[1]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd2" id="des_<?=$ordenacion[1]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[1]->descripcion?></textarea>
                </td>
            </tr>
            <tr><td colspan="3" height="90"></td></tr>
            	<tr>
                	<td></td>
                	<td><i class="fa fa-picture-o fa-5x"></i></td>
                	<td></td>
                </tr>
                <tr>
                	<td></td>
                    <td>Orden <input style="text-align:center" name="orden3" type="text" class="form-control orden" value="<?=$ordenacion[2]->orden?>" readonly>
                    	<input type="hidden" name="des3" class="descrip" value="<?=$ordenacion[2]->iddescripcion?>" />
                        Descripci&oacute;n 
                        <textarea name="dd3" id="des_<?=$ordenacion[2]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[2]->descripcion?></textarea>
                    </td>
                    <td></td>
                </tr>
        </table>  
        <br/>
        P&aacute;gina 1         
        </div>
        <div class="col-md-5  square">  
        <table style="text-align:center" width="100%">
        	<tr><td colspan="3" height="10"></td></tr>
            <tr>
            	<td width="110"></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
                <td width="110"></td>
            </tr>
            <tr>                            
                <td></td>
                <td>Orden <input style="text-align:center" name="orden4" type="text" class="form-control orden" value="<?=$ordenacion[3]->orden?>" readonly>
                	<input type="hidden" name="des4" class="descrip" value="<?=$ordenacion[3]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd4" id="des_<?=$ordenacion[3]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[3]->descripcion?></textarea>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="3" height="90"></td></tr>
            <tr>
                <td></td>
                <td><i class="fa fa-picture-o fa-5x"></i></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Orden <input style="text-align:center" name="orden5" type="text" class="form-control orden" value="<?=$ordenacion[4]->orden?>" readonly>
                	<input type="hidden" name="des5" class="descrip" value="<?=$ordenacion[4]->iddescripcion?>" />
                    Descripci&oacute;n 
                    <textarea name="dd5" id="des_<?=$ordenacion[4]->iddescripcion?>" readonly class="form-control l10 dd"><?=$ordenacion[4]->descripcion?></textarea>
                </td>
                <td></td>
            </tr>
        </table>
         <br/>
        P&aacute;gina 2
        </div>       
        <?php endif;?>
    <div class="col-md-2">
    	<button fotos="<?=$ordenacion[0]->fotos?>" type="button" class="btn btn-warning" id="mod-orden" estado="1"><i class="fa fa-pencil-square-o estado fa-2x"></i></button>
        <br>
        <span id="errores" class="errores"></span>
    </div>   
    <input type="hidden" id="proyecto" value="<?=$ordenacion[0]->idbase?>" />
</div>
<br>