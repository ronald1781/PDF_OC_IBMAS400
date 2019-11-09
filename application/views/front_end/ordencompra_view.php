<script type="text/javascript">

    $(function () {
        $("#fechacomp").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy/mm/dd"
        });
    });
    var lst_compra = new Array();
    $(document).ready(function () {

        $("#btnGuardar").click(function (e) {
            e.preventDefault();
            var miJSON = JSON.stringify(lst_compra);
            //alert(miJSON);
            $('#imgLoader').show();
            $.ajax({
                type: 'POST',
                data: $('#foraddcomp').serialize() + '&lst_compra=' + miJSON,
                url: 'compra_control/registrar_compra',
                success: function (msj) {

                    if (parseInt(msj) == 2) {
                        $('#msj_nodata').modal('show');
                        jQuery.fn.reset = function () {
                            $(this).each(function () {
                                this.reset();
                            });
                        };
                        $("#foraddcomp").reset();
                    } else {
                        (parseInt(msj) == 1)
                        $('#msj_grabo').modal('show');
                        jQuery.fn.reset = function () {
                            $(this).each(function () {
                                this.reset();
                            });
                        };
                        $("#foraddcomp").reset();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {

                    $('#msj_error .modal-body').html(thrownError + " " + xhr.status + " Sin detalle agregar - si persiste contactese con TI"),
                    $('#msj_error').modal('show');
                }

            });
            return false;
        });


    });
    function listarCompra() {

        var compra = {};

        var codpro = $("#txtcodart").val();
        var nompro = $("#areadescr").val();
        var codmone = $("#selemone").val();
        var cantpro = $("#txtctd").val();
        var prepro = $("#txtprc").val();
        var detaad = $("#areadscad").val();
        var importe = parseFloat(cantpro * prepro).toFixed(2);
        if (prepro == '') {
            alert('Ingrese DATA');
            $('#txtcodart').val('');
            $('#areadescr').val('');
            $('#txtctd').val('');
            $('#txtprc').val('');
            $('#areadscad').val('');
            $('#areadescr').focus();
        } else {
            compra.codpro = codpro;
            compra.nompro = nompro;
            compra.codmone = codmone;
            compra.cantpro = cantpro;
            compra.prepro = prepro;
            compra.importe = importe;
            compra.detaad = detaad;
            lst_compra.push(compra);
            var montos = 0;
            $("#lstTabla").show();
            var $tabla = $("#lstTabla");
            $tabla.find("table").remove();
            $tabla.append('<table class="table table-bordered">' +
                '<thead><tr class="active"><th>#</th><th>CodigoArticulo</th><th>Descripcion</th><th>cantidad</th><th>Precio</th><th>Importe</th><th>Action</th></tr>' +
                '</thead></table>');
            var tbody = $('<tbody></tbody>');
            jQuery.each(lst_compra, function (i, value) {
                cont = i + 1;
                tbody.append(
                    '<tr><td style="text-align: center;">' + cont +
                    '<input type="hidden"  name=codimar value=["codmone"]/>' +
                    '</td><td style="text-align: center;">' + value["codpro"] +
                    '</td><td style="text-align: center;">' + value["nompro"] +
                    '</td><td style="text-align: center;">' + value["cantpro"] +
                    '</td><td style="text-align: center;">' + value["prepro"] +
                    '</td><td style="text-align: center;">' + value["importe"] +
                    '</td><td style="text-align: center;">' +
                    '<div class="btn-group"><a onclick="del_listarCompra(' + i + ');" class="btn btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                    '</a></div></td></tr>'
                    );
                montos = montos + parseFloat(value["importe"]);
            });
            calcular_pago(montos);
            $tabla.find("table").append(tbody);
            $('#txtcodart').val('');
            $('#areadescr').val('');
            $('#txtctd').val('');
            $('#txtprc').val('');
            $('#areadscad').val('');
            $('#areadescr').focus();
        }

    }

    function del_listarCompra(id) {
        jQuery.each(lst_compra, function (i, value) {
            if (i == id) {
                lst_compra.splice(i, 1);
            }
        });
        $("#lstTabla").show();
        var montos = 0;
        var $tabla = $("#lstTabla");
        $tabla.find("table").remove();
        $tabla.append('<table class="table table-bordered">' +
            '<thead><tr class="active"><th>#</th><th>Articulo</th><th>Marca</th><th>cantidad</th><th>Precio</th><th>Importe</th><th>Action</th></tr>' +
            '</thead></table>');
        var tbody = $('<tbody></tbody>');
        jQuery.each(lst_compra, function (i, value) {
            cont = i + 1;
            tbody.append(
                '<tr><td style="text-align: center;">' + cont +
                '<input type="hidden"  name=codimar value=["codmone"]/>' +
                '</td><td style="text-align: center;">' + value["codpro"] +
                '</td><td style="text-align: center;">' + value["nompro"] +
                '</td><td style="text-align: center;">' + value["cantpro"] +
                '</td><td style="text-align: center;">' + value["prepro"] +
                '</td><td style="text-align: center;">' + value["importe"] +
                '</td><td style="text-align: center;">' +
                '<div class="btn-group"><a onclick="del_listarCompra(' + i + ');" class="btn btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                '</a></div></td></tr>'
                );
            montos = montos + parseFloat(value["importe"]);
        });
        calcular_pago(montos);
        $tabla.find("table").append(tbody);
        $('#txtcodart').val('');
        $('#areadescr').val('');
        $('#txtctd').val('');
        $('#txtprc').val('');
        $('#areadscad').val('');
        $('#areadescr').focus();
    }
    function limpiarproducto() {
        $('#txtcodart').val('');
        $('#areadescr').val('');
        $('#txtctd').val('');
        $('#txtprc').val('');
        $('#areadscad').val('');
        $('#areadescr').focus();
    }
    function calcular_pago(montoTotal) {

        var sbtota = document.getElementById('subTotal').value = parseFloat((montoTotal)).toFixed(2);
        var igv = document.getElementById('montoigv').value = (montoTotal * ($("#igv").val() / 100)).toFixed(2);
        var total = (parseFloat(sbtota) + parseFloat(igv)).toFixed(2);
        document.getElementById('totApagar').value = parseFloat(total).toFixed(2);
    }

    $(function () {
        $('.seleper').chosen();
    });
</script>

<?php
date_default_timezone_set('UTC');
?>
<section clase="container">
    <div class="row">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <?php if ($previ == 0) { ?>
                    <li class="active"><a href="registraprtorqmt"  title="Genera Orden Compra"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></li>
                    <li ><a href="listarproyecto"  title="Orden Compra Pendientes"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
                    <li><a href="listaactividades"  title="Lista Orden Compra"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                    <li><a href="graficoproyecto"  title="Grafico Orden Compra"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span></a></li>
                    <?php } if ($previ == 2) { ?>    
                    <li><a href="listaactividades"  title="Requirimientos"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
                    <?php } ?>
                </ul>
                <h3 class="panel-title">Registro Orden Compra</h3>
            </div>
            <div class="panel-body">

             <div class="col-md-6">
                <fieldset>

                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <p align="middle">
                        <button class="btn btn-info mtr" data-toggle="modal" data-target="#myModaladdprdsrv" title="Agregar Requirimientos"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                        <button type="button" id="btnGuardar" class="btn btn-primary " title="Grabar"/><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></button>
                        <button type="button" id="btnResetea" class='btn btn-danger'  value="Cancelar" title="Resetear"> <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>

                    </p>                           
                </fieldset>
            </div>
            <div class="col-md-12">
                <form name="grabar" action="" method="POST" id="foraddcomp">
                    <div class="row">               

                        <div class="col-md-6">                   
                            <fieldset>                                       

                               <div class="form-group">
                                <label for="inputtEquip" class="col-sm-3 control-label">Proveedor</label>
                                <div class="col-sm-9">
                                 <select name="seleper" required id="seleper" class="form-control seleper" style="width:75%; float:left" > 

                                    <?php
                                    echo "<option  selected value='0'>--Busque Proveedor--</option>";
                                    for ($m = 0; $m < count($lproveedor); $m++) {
                                        $cad = $lproveedor[$m];
                                        $codprove = $cad['codprove'];
                                        $rucprove = $cad['rucprove'];
                                        $rasprove = ucwords(strtolower($cad['rasprove']));
                                        ?>                          
                                        <option   value="<?php echo $codprove; ?>"><?php echo $rucprove . '  ' . $rasprove; ?></option>                                  
                                        <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                       
                     <div class="form-group">
                        <label for="inputtEquip" class="col-sm-3 control-label">CondicionPago</label>
                        <div class="col-sm-9">
                            <select name="selecpago" required id="selecpago" class="form-control" style="width:75%; float:left"> 
                                <option selected value="">--Seleccione--</option>
                                <?php
                                for ($cr = 0; $cr < count($cpago); $cr++) {
                                    $cad = $cpago[$cr];
                                    $CODFPAGO = $cad['codcondpg'];
                                    $NOMFPAGO = $cad['nomcondpg'];
                                    ?>                          
                                    <option value="<?php echo $CODFPAGO; ?>"><?php echo $NOMFPAGO; ?></option>                                  
                                    <?php
                                }
                                ?>
                            </select>                               
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label for="inputtEquip" class="col-sm-3 control-label">Monedad</label>
                        <div class="col-sm-9">
                            <select name="selemone" required id="selemone"  class="form-control" style="width:75%; float:left" > 

                                <?php
                                for ($m = 0; $m < count($lmone); $m++) {
                                    $cad = $lmone[$m];
                                    $CODMON = $cad['codigomon'];
                                    $NOMMON = $cad['nombremon'];
                                    $SIBMON = $cad['simbmone'];
                                    ?>                          
                                    <option  selected value="<?php echo $CODMON; ?>"><?php echo $SIBMON . ' ' . $NOMMON; ?></option>                                  
                                    <?php
                                }
                                ?>
                            </select>                               
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputtEquip" class="col-sm-3 control-label">Cotizacion</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nroctz" requerid id="nroctz"  value="" style="width:75%; float:left" placeholder="Nro Cotizacion">
                        </div>
                    </div>
<div class="form-group">
                        <label for="inputtEquip" class="col-sm-3 control-label">Entrega</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fechacomp" requerid id="fechacomp"  value="<?php echo date("Y-m-d"); ?>" style="width:75%; float:left">
                        </div>
                    </div>
                   
                </fieldset> 
            </div>
            <div class="col-md-6">
                <fieldset> 
                <div class="form-group">
                            <label for="inputtEquip" class="col-sm-3 control-label">Empresa</label>
                            <div class="col-sm-9">
                             <select name="seleper" required id="seleper" class="form-control seleper" style="width:75%; float:left"> 

                                <?php  
                                //,codasemp,rucemp,rsemp,direemp
                                echo "<option  selected value='0'>--Busque Solicitante--</option>";
                                for ($m = 0; $m < count($lpersonal); $m++) {
                                    $cad = $lpersonal[$m];
                                    $codemp = $cad['codemp'];
                                    $rucemp = $cad['rucemp'];
                                    $rsemp = ucwords(strtolower($cad['rsemp']));
                                    ?>                          
                                    <option   value="<?php echo $codemp; ?>"><?php echo $rucemp . '  ' . $rsemp; ?></option>                                  
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
 
                     <div class="form-group">
                            <label for="inputtEquip" class="col-sm-3 control-label">Solicitante</label>
                            <div class="col-sm-9">
                             <select name="seleper" required id="seleper" class="form-control seleper" style="width:75%; float:left"> 

                                <?php
                                echo "<option  selected value='0'>--Busque Solicitante--</option>";
                                for ($m = 0; $m < count($lpersonal); $m++) {
                                    $cad = $lpersonal[$m];
                                    $CODPER = $cad['codper'];
                                    $DNIPER = $cad['dniper'];
                                    $APEPPER = ucwords(strtolower($cad['apepper']));
                                    $APEMPER = ucwords(strtolower($cad['apemper']));
                                    $PNOMPER = ucwords(strtolower($cad['pnomper']));
                                    $SNOMPER = ucwords(strtolower($cad['snomper']));
                                    ?>                          
                                    <option   value="<?php echo $CODPER; ?>"><?php echo $DNIPER . '  ' . $PNOMPER . ' ' . $SNOMPER . ' ' . $APEPPER . ' ' . $APEMPER; ?></option>                                  
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
<div class="form-group">
                            <label for="selecate" class="col-sm-3 control-label">LugarEntrega</label>
                            <div class="col-sm-9">
                                <select name="selecn" required id="selecn" class="form-control" style="width:75%; float:left"> 
                                    <option selected value="">--Seleccione--</option>
                                    <?php
                                    for ($c = 0; $c < count($lcn); $c++) {
                                        $cad = $lcn[$c];
                                        $CODCN = $cad['codcn'];
                                        $NOMCN = $cad['nomcn'];
                                        $DIRCN = $cad['dirsuc'];
                                        ?>                          
                                        <option value="<?php echo $CODCN; ?>"><?php echo $NOMCN.' '.$DIRCN; ?></option>                                  
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                     <div class="form-group">
                            <label for="inputtEquip" class="col-sm-3 control-label">Recepciona</label>
                            <div class="col-sm-9">
                             <select name="seleper" required id="seleper" class="form-control seleper" style="width:75%; float:left"> 

                                <?php
                                echo "<option  selected value='0'>--Busque encargado recepcion--</option>";
                                for ($m = 0; $m < count($lpersonal); $m++) {
                                    $cad = $lpersonal[$m];
                                    $CODPER = $cad['codper'];
                                    $DNIPER = $cad['dniper'];
                                    $APEPPER = ucwords(strtolower($cad['apepper']));
                                    $APEMPER = ucwords(strtolower($cad['apemper']));
                                    $PNOMPER = ucwords(strtolower($cad['pnomper']));
                                    $SNOMPER = ucwords(strtolower($cad['snomper']));
                                    ?>                          
                                    <option   value="<?php echo $CODPER; ?>"><?php echo $DNIPER . '  ' . $PNOMPER . ' ' . $SNOMPER . ' ' . $APEPPER . ' ' . $APEMPER; ?></option>                                  
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div> 

                     

                </fieldset> 
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <div id="lstTabla"  class="table-responsive">
                        <table class="table table-bordered">
                            <thead><tr class="active"><th>#</th><th>CodigoCodigo</th><th>Descripcion</th><th>Cantidad</th><th>Precio</th><th>Importe</th><th>Action</th></tr>
                            </thead>
                        </table>
                    </div>                       
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="add-on" >SubTotal:</span><input type="text" class='input-square input-small' name="subTotal" id="subTotal" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="add-on" >IGV:</span><input type="number" class='input-square input-mini' min="0.0" max="100.0" step="0.1" value="18.0" name="igv" id="igv" onkeyup="calcular_monto_base_porcentaje();">
                            <input type="text" class='input-square input-small' name="montoigv" id="montoigv" readonly><span class="add-on" ></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="add-on" >Total a Pagar:</span><input type="text" class='input-square input-small' name="totApagar" id="totApagar" readonly>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p align="left">
                        <input type="submit" value="Guardar" id="btnGuardar" class="btn btn-primary "/>
                        <input type="reset" class='btn btn-danger' value="Cancelar">
                    </div>
                </div> 

            </div>
        </div>

    </form>
</div> 

<div class="modal" id="msj_grabo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Mensaje se Registro</h4>
            </div>
            <div class="modal-body">
                <span>Se Registro Correctamente</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>

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
<!-- Modal -->
<div class="modal fade in" id="myModaladdprdsrv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar Producto Servicio</h4>
            </div>               
            <div class="modal-body">    

                <div class="form-group">
                    <label for="inputEquip" class="col-sm-3 control-label">Codigo Articulo</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtcodart" value="" maxlength="25" placeholder="Codigo Articulo" class="form-control"  id="txtcodart" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtEquip" class="col-sm-3 control-label" >Descripcion</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="2" maxlength="200"  name="areadescr" id="areadescr" placeholder="Descripcion Producto o Servicio" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtEquip" class="col-sm-3 control-label">Cantidad</label>
                    <div class="col-sm-9">
                        <input type="number" min='0' name="txtctd" value=""  class="form-control"  id="txtctd" />
                    </div>
                </div>
                <div class="form-group">
                    <label  for="txtnom" class="col-sm-3 control-label">Precio</label>
                    <div class="col-sm-9">
                       <input type="number" name="txtprc" min="0.0"  step="0.1" value="" maxlength="45" class="form-control"  id="txtprc" />
                   </div>
               </div>              
               <div class="form-group">
                <label for="inputtEquip" class="col-sm-3 control-label">Detalle</label>
                <div class="col-sm-9">
                   <textarea class="form-control" rows="4" maxlength="1000"  name="areadscad" id="areadscad" placeholder="Detalle de Producto o Servicio" ></textarea>
               </div>
           </div>
       </div>
       <div class="modal-footer">
        <input type="button" name="btnagregar" value="Agregar" class="btn btn-primary" onclick="listarCompra();"> 
        <input type="reset" class='btn btn-warning' value="Cancelar">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
    </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

</section>

