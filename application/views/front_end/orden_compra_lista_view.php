

<section clase="container"> 

    <script type="text/javascript">
        $(document).ready(function() {
            $('#rangofecha').hide();
            $('#listaordencomp').DataTable();

            $('input[type="radio"]').click(function() {
                var test = $(this).val();
                if(test == '2') {
                    $('#rangofecha').show();           
                }

                else {
                    $('#rangofecha').hide();   
                }
            });

        } );

        function onclickFunction(est,codoc,codprv){
            //CPY copiar  copy_oc_cab
            var motianu='';
            var codprv=codprv;
            if(est==='CPY'){
                 if (confirm('Esta Seguro crear una orden clon de la Ordern de compra?'))
            {

             copy_oc_cab(codoc);

           }

               
            }else if(est==='I'){
             var person = prompt("Ingrese el Motivo de Anulacion", "No procede");
             if (person != null) {
                motianu=person;               

                update_estado_oc(est,codoc,motianu);
                
            }
        }else{
            if (confirm('Esta Seguro de los cambios de estado de esta Ordern de compra?'))
            {

               update_estado_oc(est,codoc,motianu);

           }

       }
   }

   function update_estado_oc(est,codoc,motianu){
   // alert(est+ ' ,'+codoc+','+motianu+'ok');
   $.ajax({
    type: "post",
    url: "compra_control/update_estado_oc",
    data: {
        est:est,
        codoc:codoc,
        motianu:motianu,
    },
    dataType: "JSON",
    success: function (data){
        alert('Dato Modificado :'+data.status);
                        //sleep(2000);
                        reinicioformlstoc();

                    },
                    error: function (xhr, ajaxOptions, thrownError){

                    }
                });


}
function copy_oc_cab(codoc){
   // alert(est+ ' ,'+codoc+','+motianu+'ok');
   $.ajax({
    type: "post",
    url: "compra_control/copy_oc_cab",
    data: {
        codoc:codoc
    },
    dataType: "JSON",    
    beforeSend: function () {           
            $('#msj_text').modal('show');
        },
        success: function (msj){
            $('#msj_text').modal('hide');
            var dato = JSON.parse(msj);
            var exis = dato.existe;
          if(exis=== 1){ 
          setTimeout(function() {          
            $('#msj_grabo .modal-body').html('<span>' + dato.msg +'</span><br><b> La clonacion: <a class="btn btn-warning" href="editar/ocompra/' + dato.codoc + '" target="blanck" title="Abrir">' + dato.nrooc +'</a>');
            $("#msj_grabo").modal('show');           
      
     }, 5000);
          reinicioformlstoc();
             
        }else{
            alert('Alerta!! :'+dato.msg);
        }
    },
    error: function (xhr, ajaxOptions, thrownError){
        alert('Error!! :'+xhr+' '+ ajaxOptions+'  '+ thrownError);
    }
});


}
function existe_mail_prove_oc(codoc){
   // alert(est+ ' ,'+codoc+','+motianu+'ok');
   $.ajax({
    type: "post",
    url: "compra_control/existe_mail_prove_oc",
    data: {
        codoc:codoc
    },
    dataType: "JSON",
    success: function (data){
        alert('Dato Modificado :'+data.status);
                        //sleep(2000);
                        reinicioformlstoc();

                    },
                    error: function (xhr, ajaxOptions, thrownError){

                    }
                });


}
function reinicioformlstoc() {
    window.location.href = 'listar/ocompra';
}  

$(function () {
    $("#fechaini").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd"
    });
});
$(function () {
    $("#fechafin").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd"
    });
});
</script>

<div class="panel with-nav-tabs panel-default">

    <div class="panel-heading clearfix">
        <div class="btn-group pull-left">  
            <h4>Lista&nbsp;de&nbsp;ordenes&nbsp;de&nbsp;compra</h4>
        </div>
        <!--disabled="disabled"-->
        <input type="hidden" name="grabar" value="si">
        <h4 class="panel-title pull-right" style="padding-top: 7.5px;"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#bajaoclist" ><span class="glyphicon glyphicon-download" aria-hidden="true"></span>Excel</button>
            <a class="btn btn-primary btn-sm active" href="formulario/ordencompra" role="button" title="Lista Proveedor"><span class="glyphicon glyphicon-plus"></span>&nbsp;Generar&nbsp;O.&nbsp;C.&nbsp;</a>
        </h4>
    </div>
    <div class="panel-body">    
        <div class="table-responsive">
            <table id="listaordencomp" class="table table-bordered" cellspacing="0" width="100%" >
                <thead>
                    <tr class="info"><th >#</th><th>Nro&nbsp;O.C.</th><th>Empresa</th><th>Proveedor</th><th>Fecha&nbsp;O.C.</th><th>Solicitante</th><th>Importe</th><th>Estado</th><th>Accion</th></tr> 
                </thead>

                <tbody>
                    <?php
                    if(count($locompra)>0){
                        $conta = 0;
                        for ($p = 0; $p < count($locompra); $p++) {
                            $conta = $conta + 1;
                            $cad = $locompra[$p];                                                  
                            $codoc = $cad['codoc'];
                            $codigoc = $cad['codigoc'];
                            $ncemp = $cad['ncemp'];
                            $fechaoc = $cad['fechaoc'];
                            $rasprove = $cad['rasprove'];
                            $fechaoc = $cad['fechaoc'];
                            $persoli = $cad['persoli'];
                            $totimpoc = $cad['totimpoc'];
                            $estoc = $cad['estoc'];
                            $estaoc = $cad['estaoc']; 
                            ?>     <tr>
                            <td><?php echo $conta; ?></td>  
                            <td><?php echo $codigoc; ?></td>
                            <td><?php echo $ncemp; ?></td>
                            <td><?php echo $rasprove; ?></td>
                            <td style="width:10%"><?php echo  $fechaoc;?></td>                               
                            <td ><?php echo $persoli; ?></td>                                    
                            <td ><?php echo $totimpoc; ?></td> 
                            <td ><?php echo $estoc;?></td>  
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <?php
                                        switch($estaoc){
                                            case 'I':
                                            ?>
                                            <li><a href="imprime/ocompra/<?php echo $codoc;?>" target="blanck" title="Imprimir" class="disabled_li_href"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('E',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-briefcase" aria-hidden="true">&nbsp;Env.Proveedor</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('NP',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-credit-card" aria-hidden="true">&nbsp;En&nbsp;Pago</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('T',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-check" aria-hidden="true">&nbsp;Terminado</a></li>
                                            <li><a href="vista/ordencompra/'.$codoc.'" target="blanck" title="Vista"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;Visualizar</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('I',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true" class="disabled_li_href"></span>&nbsp;Anulado</a></li>

                                            <li><a href="javascript:void()" onclick="onclickFunction('CPY',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-transfer" aria-hidden="true" class="disabled_li_href"></span>&nbsp;Clonar</a></li>
                                            <?php break;
                                            case 'T':
                                            ?>
                                            <li><a href="imprime/ocompra/<?php echo $codoc;?>" target="blanck" title="Imprimir" <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('E',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-briefcase" aria-hidden="true">&nbsp;Env.Proveedor</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('NP',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-credit-card" aria-hidden="true">&nbsp;En&nbsp;Pago</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('T',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-check" aria-hidden="true">&nbsp;Terminado</a></li>
                                            <li><a href="vista/ordencompra/<?php echo $codoc;?>" target="blanck" title="Vista"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;Visualizar</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('I',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-trash" aria-hidden="true" class="disabled_li_href"></span>&nbsp;Anulado</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('CPY',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>&nbsp;Clonar</a></li>
                                            <?php break;
                                            case 'G': ?>
                                            <li><a href="imprime/ocompra/<?php echo $codoc;?>" target="blanck" title="Imprimir"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('E',<?php echo $codoc;?>)" ><span class="glyphicon glyphicon-briefcase" aria-hidden="true">&nbsp;Env.Proveedor</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('NP',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-credit-card" aria-hidden="true">&nbsp;En&nbsp;Pago</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('T',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-check" aria-hidden="true">&nbsp;Terminado</a></li>
                                            <li><a href="vista/ordencompra/<?php echo $codoc;?>" target="blanck" title="Vista"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;Visualizar</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('I',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Anulado</a></li>
                                            <li>
                                                <a href="editar/ocompra/<?php echo $codoc; ?>" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Editar</a>
                                            </li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('CPY',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>&nbsp;Clonar</a></li>
                                            <?php break;
                                            case 'NP':  
                                            ?>                                 
                                            <li><a href="imprime/ocompra/<?php echo $codoc;?>" target="blanck" title="Imprimir" <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('E',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-briefcase" aria-hidden="true">&nbsp;Env.Proveedor</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('NP',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-credit-card" aria-hidden="true">&nbsp;En&nbsp;Pago</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('T',<?php echo $codoc;?>)" ><span class="glyphicon glyphicon-check" aria-hidden="true">&nbsp;Terminado</a></li>
                                            <li><a href="vista/ordencompra/<?php echo $codoc;?>" target="blanck" title="Vista"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;Visualizar</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('I',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Anulado</a></li>
                                            <?php break;
                                            case 'E':  
                                            ?>              
                                            <li><a href="imprime/ocompra/<?php echo $codoc;?>" target="blanck" title="Imprimir" <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('E',<?php echo $codoc;?>)" class="disabled_li_href"><span class="glyphicon glyphicon-briefcase" aria-hidden="true">&nbsp;Env.Proveedor</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('NP',<?php echo $codoc;?>)" ><span class="glyphicon glyphicon-credit-card" aria-hidden="true">&nbsp;En&nbsp;Pago</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('T',<?php echo $codoc;?>)" ><span class="glyphicon glyphicon-check" aria-hidden="true">&nbsp;Terminado</a></li>
                                            <li><a href="vista/ordencompra/<?php echo $codoc;?>" target="blanck" title="Vista"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;Visualizar</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('I',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Anulado</a></li>
                                            <li><a href="javascript:void()" onclick="onclickFunction('CPY',<?php echo $codoc;?>)"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>&nbsp;Clonar</a></li>
                                            <?php 
                                            break;
                                        }
                                        ?>

                                    </ul>
                                </div>



                           <!--  <php  echo $estorc; ?>
                           <a class="btn btn-primary btn-sm" href="editar/ocompra/<php echo $codoc; ?>" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>-->


                       </td>
                   </tr>
                   <?php
               }}else{
                ?>
                <tr>
                    <td class="" colspan="8"> sin Datos para mostrar</td> </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </div>

</div>
</div>
<style>


    .disabled_li_href {
       pointer-events: none;
       cursor: default;
       opacity: 0.6;
   }
</style>

<!-- Modal -->
<div class="modal fade in" id="bajaoclist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Exportar&nbsp;OC&nbsp;a&nbsp;Excel</h4>
            </div> 

            <form name="exporta_exceloc" action="exporta_orden_compra" method="POST" class="form-horizontal" >
                <div class="modal-body">                       

                    <div class="form-group">
                        <label for="Desripcion">Generar</label>
                        <label class="radio-inline">
                            <input name="frtinf" id="frtinf" value="1" type="radio" checked="checked">Todo
                        </label>
                        <label class="radio-inline">
                            <input name="frtinf" id="frtinf" value="2" type="radio">Por&nbsp;Rango&nbsp;de&nbsp;fecha
                        </label>
                    </div>
                    <div id="rangofecha">
                        <div class="form-group">
                            <label for="Producto">Desde</label>
                            <input type="text" name="fechaini" id="fechaini" class="form-control" placeholder="desde la Fecha "> 
                        </div>  
                        <div class="form-group">
                            <label for="Producto">Hasta</label>
                            <input type="text" name="fechafin" id="fechafin" class="form-control" placeholder="Hasta la Fecha "> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Exportar" id="btnGuardar" class="btn btn-primary "/>                
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 

<div class="modal" id="msj_grabo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Mensaje se Registro</h4>
            </div>
            <div class="modal-body">

                <span>Se Registro Correctamente <input type="text" name="numpedi" id="numpedi" readonly=""></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript
                :window.location.reload()">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal" id="msj_nodata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Mensaje sin dato</h4>
            </div>
            <div class="modal-body">
                <span>Debe ingresar datos completos</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="msj_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
            </div>
            <div class="modal-body">
                <span>Registro Fallido, Vuelva a intentarlo...</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="msj_text" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
            </div>
            <div class="modal-body">
                <span>Procesando...</span>
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
    </div>
</div>
</section>


