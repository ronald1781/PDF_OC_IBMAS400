

<section clase="container">

    <div class="panel with-nav-tabs panel-info">

        <div class="panel-heading clearfix">
            <div class="btn-group pull-left">  
                <h4>Orden&nbsp;de&nbsp;compra&nbsp;Nro.&nbsp;<?php $fechoc = date("d-m-Y", strtotime($dataoccab->fechaoc)); echo '<strong>'.$dataoccab->nroseroc.'  '.$dataoccab->codigoc.'  de '.$fechoc.'</strong>'; ?></h4>
            </div>

            <h4 class="panel-title pull-right" style="padding-top: 7.5px;">
                <?php 
                $estoc = $dataoccab->estoc;
                switch ($estoc) {
                    case 'G':
                    $estoc='<span class="label label-info">Generado</span>';
                    break;
                    case 'A':
                    $estoc='<span class="label label-primary">Aprobado</span>';
                    break;
                    case 'E':
                    $estoc='<span class="label label-warning">En proveedor</span>';
                    break;
                    case 'XA':
                    $estoc='<span class="label label-warning">Por abrobacion</span>';
                    break;
                    case 'R':
                    $estoc='<span class="label label-danger">Rechazado</span>';
                    break;
                    case 'O':
                    $estoc='<span class="label label-danger">Observado</span>';
                    break;
                    case 'I':
                    $estoc='<span class="label label-default">Anulado</span>';
                    break;
                    case 'T':
                    $estoc='<span class="label label-success">Terminado</span>';
                    break; 
                    case 'XP':
                    $estoc='<span class="label label-warning">En Pago</span>';
                    break; 
                    default:
                    $estoc='Cancelado';
                    break;
                }
                echo '<strong>Estado:</strong> '.$estoc.'&nbsp;&nbsp;';
                ?>

                <a class="btn btn-primary btn-sm active" href="listar/ocompra" role="button" title="Vista Orden de compra">Atras</a>
            </h4>
        </div>
        <div class="panel-body">
            <form name="foraddoc" class="form-horizontal" action="">
                <div class="row">             
                    <div class="col-md-6">                   
                        <fieldset>
                            <div class="form-group">
                                <label for="inputEquip" class="col-sm-3 control-label">Tipo&nbsp;Dodcumento</label>
                                <div class="col-sm-9">
                                    <?php $tipdoc=$dataoccab->tipdocuoc;
                                    switch ($tipdoc) {
                                        case '1':
                                        $tipdoc='Factura';
                                        break;

                                        default:
                                        $tipdoc='Recibo por Honorario';
                                        break;
                                    }
                                    ?>
                                    <p class="form-control-static"><?php echo $tipdoc;?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="selemar" class="col-sm-3 control-label">Tipo&nbsp;de&nbsp;Orden</label>
                                <div class="col-sm-9">
                                    <?php 
                                    $tipoc=$dataoccab->tipoc;
                                    switch ($tipoc) {
                                        case '1':
                                        $tipoc='ARTICULO';
                                        break;
                                        case '2':
                                        $tipoc='SERVICIO';
                                        break;

                                        default:
                                        $tipoc='ARTICULO Y SERVICIO';
                                        break;
                                    }
                                    ?>
                                    <p class="form-control-static"><?php echo $tipoc;?></p>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="inputtEquip" class="col-sm-3 control-label">Proveedor</label>
                                <div class="col-sm-9">

                                    <p class="form-control-static"><?php echo utf8_encode(strtoupper($dataoccab->rasprove));?></p>
                                </div>
                            </div>
                            <?php
                            date_default_timezone_set('UTC');
                            ?>
                            <div class="form-group">
                                <label for="inputMarca" class="col-sm-3 control-label">Moneda</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static"><?php echo strtoupper($dataoccab->nombremon);?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputtEquip" class="col-sm-3 control-label">Condicion&nbsp;de&nbsp;Pago</label>
                                <div class="col-sm-9">
                                   <p class="form-control-static"><?php echo strtoupper($dataoccab->condpgoc);?></p>
                               </div>
                           </div>
                           <div class="form-group">
                            <label for="inputtEquip" class="col-sm-3 control-label">NroCotizacion</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo strtoupper($dataoccab->nroctzoc);?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtEquip" class="col-sm-3 control-label">Centro&nbsp;Costo</label>
                            <div class="col-sm-9">
                                <?php $ccost=''; 
                                foreach ($coddtcos as $value) {
                                 $ccost.= $value['sigccos'].', ';
                             };?>
                             <p class="form-control-static"><?php echo strtoupper($ccost);?></p>

                         </div>
                     </div>
                 </fieldset> 
             </div>
             <div class="col-md-6">
                <fieldset>
                    <div class="form-group">
                        <label for="inputtEquip" class="col-sm-3 control-label">Persona&nbsp;que&nbsp;Solicita</label>
                        <div class="col-sm-9">
                            <?php $contactosoli=utf8_encode(ucwords(strtolower($dataoccab->pnomper.' '.$dataoccab->snomper.', '.$dataoccab->apepper.' '.$dataoccab->apemper))); ?>
                            <p class="form-control-static">&nbsp;<?php echo $contactosoli;?></p>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="inputtEquip" class="col-sm-3 control-label">Direccion&nbsp;de&nbsp;Entrega</label>
                        <div class="col-sm-9">
                           <p class="form-control-static">&nbsp;<?php echo $dataoccab->dirsc.' '.$dataoccab->distsc;?></p>
                       </div>
                   </div>
                   <div class="form-group">
                    <label for="inputtEquip" class="col-sm-3 control-label">Persona&nbsp;que&nbsp;Recibe</label>
                    <div class="col-sm-9">
                        <?php $perrecibe=utf8_encode(ucwords(strtolower($dataoccab->pnrc.' '.$dataoccab->snrc.', '.$dataoccab->aprc.' '.$dataoccab->amrc))); ?>
                        <p class="form-control-static">&nbsp;<?php echo $perrecibe;?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtEquip" class="col-sm-3 control-label">Direccion&nbsp;de&nbsp;Pago</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">&nbsp;<?php echo $dataoccab->dirsuc.' '.$dataoccab->distcn;?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtEquip" class="col-sm-3 control-label">Encargada&nbsp;de&nbsp;Pago</label>
                    <div class="col-sm-9">
                        <?php  $perpago=utf8_encode(ucwords(strtolower($dataoccab->pnpgo.' '.$dataoccab->snpgo.', '.$dataoccab->appgo.' '.$dataoccab->ampgo))); ?>

                        <p class="form-control-static">&nbsp;<?php echo $perpago;?></p>


                    </div>
                </div>
                <div class="form-group">
                    <label for="inputtEquip" class="col-sm-3 control-label" >Observacion</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">&nbsp;<?php echo utf8_encode(ucwords(strtolower($dataoccab->obsoc)));?></p>
                    </div>
                </div>

            </fieldset> 
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead><tr class="active"><th>#</th><th>Cod.Articulo</th><th>Descripcion</th><th>UM</th><th>F.Entrega</th><th>Cantidad</th><th>Precio</th><th>Importe</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        $numite=count($dataocdet);
                        if($numite>0){
                            $conta=0;
                            for($i=0;$i<$numite;$i++){
                                $conta = $conta + 1;
                                $cad=$dataocdet[$i];
                                $fentre = ( $cad['fetsvrprdgocd']==''|| $cad['fetsvrprdgocd']=='0000-00-00') ? "":$cad['fetsvrprdgocd']; 

                                ?>
                                <tr>
                                    <td><?php echo $conta;?></td>
                                    <td><?php echo $cad['codsvrprdocd'];?></td>
                                    <td><?php echo utf8_decode(strtoupper($cad['titsvrprdocd']));?></td>
                                     <td> <?php echo $cad['nomunimed'];?></td>
                                    <td><?php echo $fentre;?></td>
                                    <td><?php echo $cad['ctdsvrprdocd'];?></td>
                                    <td><?php echo $cad['simbmone'].''.$cad['pusvrprdocd'];?></td>
                                    <td><?php echo $cad['simbmone'].''.$cad['impsvrprdocd'];?></td>
                                </tr>
                                <?php }
                                if($dataoccab->tipdocuoc==1){
                                    $nomimp='IGV';
                                }else{
                                 $nomimp='Reten.';
                             }
                             ?>
                               <!--
                               <tr><td colspan="5" rowspan="5"></td><td class="success" ><strong>SubTotal:</strong></strong></td><td class="success"><strong><php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->impoc;?></strong></td></tr>
                               <tr><td><strong><php echo $nomimp.' '.$dataoccab->ptjimptoc.'%';?>:</strong></td><td><strong><php echo $dataoccab->simbmone.''.$dataoccab->imptimpoc;?></strong></td></tr>
                               <tr><td class="success"><strong>Total:</strong></td><td class="success"><strong><php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->totimpoc;?></strong></td></tr>
                               <tr><td><strong>Dsto:</strong></td><td><strong><php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->impdscoc;?></strong></td></tr>
                               <tr><td class="success"><strong>Total.Grl.:</strong></td><td class="success"><strong><php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->imptotaloc;?></strong></td></tr>
                           -->
                           <?php

                       }else{?>
                       <tr><td colspan="7">No tiene datos para mostrar</td> </tr>
                       <?php }?>
                   </tbody>
               </table>
           </div>
       </div>
       <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead><tr class="info"><th><strong>SubTotal:</strong></th><th><strong><?php echo $nomimp.' '.$dataoccab->ptjimptoc.'%';?>:</strong></th><th><strong>Total:</strong></th><th>Dsto:</th><th><strong>Total.Grl.:</strong></th></tr>
                </thead>
                <tbody>
                    <tr class="success">
                        <td><strong><?php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->impoc;?></strong></td>
                        <td><strong><?php echo $dataoccab->simbmone.''.$dataoccab->imptimpoc;?></strong></td>
                        <td><strong><?php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->totimpoc;?></strong></td>
                        <td><strong><?php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->impdscoc;?></strong></td>
                        <td><strong><?php echo $dataoccab->simbmone.'&nbsp;'.$dataoccab->imptotaloc;?></strong></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>


</section>