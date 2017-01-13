<div class="page-header">
	<h4><a href="<?=base_url('res/pasos/index')?>">
    	<i class="fa fa-truck fa-2x bom-menu"></i> </a>PASOS</h4>
</div>

<div class="row">
    	<div class="square-res">
        	<h5><strong>SELECCIONE TIPO DE RESIDENTE</strong></h5>
            <br><br>
          <div class="row" align="center">
              <div class="col-md-6">
              	<a href="<?=base_url()?>res/pasos/registro_paso?carril=<?=$carril?>&turno=<?=$turno?>&comercial=1" id="comercial">
                <i class="fa fa-caret-square-o-left bom-menu fa-4x"></i></a>    
                <h6 class="bom-menu" >COMERCIAL</h6>                     	
              </div>
              <div class="col-md-6">
              	<a href="<?=base_url()?>res/pasos/registro_paso?carril=<?=$carril?>&turno=<?=$turno?>&comercial=2" id="no-comercial">
                <i class="fa fa-caret-square-o-right bom-menu fa-4x"></i></a>    
                <h6 class="bom-menu" >NO COMERCIAL</h6>           
              </div>              
          </div> 
          <input type="hidden" id="carril" name="carril" value="<?=$carril?>" />
          <input type="hidden" id="turno" name="turno" value="<?=$turno?>" />
        </div>    
</div>
<br/>
