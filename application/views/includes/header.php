
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="es-ES">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#">
<head>

 <meta charset=utf-8>
 <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <?php date_default_timezone_set('America/Lima');  ?> 

 <base href="<?php echo base_url(); ?>">
 <title><?php echo $titulo ?></title>
 <link rel="shortcut icon" type="image/x-icon" href="assest/imagen/servti.ico" />


 <link  rel="stylesheet" type="text/css" href="assest/css/jquery-ui.css">
 <link  rel="stylesheet" type="text/css" href="assest/css/jquery-ui-timepicker-addon.css">
 <link  rel="stylesheet" type="text/css" href="assest/css/chosen.min.css">
 <link  rel="stylesheet" type="text/css" href="assest/css/rrgstilos.css">
 <link  rel="stylesheet" type="text/css" href="assest/css/bootstrap.css">
 <link  rel="stylesheet" type="text/css" href="assest/css/alertify.css">
 <link  rel="stylesheet" type="text/css" href="assest/css/bootstrap-multiselect.css">
 <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"></link>
 <script src="assest/js/bootstrap.js"></script>                                        
 <script src="assest/js/jquery-2.js"></script> 
 <script src="assest/js/ajaxfileupload.js"></script> 
 <script src="assest/js/bootstrap-filestyle.min.js"></script>
 <script src="assest/js/jquery.dataTables.min.js"></script>   
 <script src="assest/js/dataTables.bootstrap.js"></script>
 <script src="assest/js/generales_js.js"></script>  
 <script src="assest/js/jquery-ui.js"></script>    
 <script src="assest/js/alertify.js"></script>                                
 <script src="assest/js/jquery-ui-timepicker-addon.js"></script>
 <script src="assest/js/chosen.jquery.min.js"></script>
 <script src="assest/js/chosen.proto.min.js"></script>
 <script src="assest/js/bootstrap-multiselect.js"></script>  

 <!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <style>
    .dropdown-submenu{position:relative;}
    .dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
    .dropdown-submenu:hover>.dropdown-menu{display:block;}
    .dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
    .dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
    .dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}

</style>
</head>
<body>
    <?PHP $username = strtoupper($username);
    ?>
    <nav>
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
            </div>
            <a class="navbar-brand">Gestion TI</a>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="inicio">Inicio</a></li>
                    <?php 
                    switch ($previ) {
                        case '0':?>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Datos <b class="caret"></b></a>
                            <ul class="dropdown-menu">                          

                                <li class="dropdown-submenu">
                                    <a tabindex="-1" >Utilitario</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="registro/acciones">Acciones</a></li>  
                                        <li><a href="registro/error">Errores</a></li>                                                 
                                        <li><a href="registro/errorhardware">Error Hardware</a></li> 
                                        <li><a href="registro/errorsoftware">Error Software</a></li>
                                    </ul>
                                </li>
                                <li><a href="formulario/cn"> Sucursal</a></li>
                                <li><a href="formulario/area"> Area</a></li>
                                <li><a href="formulario/cargo"> Cargo</a></li>
                                <li><a href="formulario/marca"> Marca</a></li>
                                <li><a href="formulario/categoria"> Categoria</a></li>
                                <li><a href="formulario/equipo"> Equipo</a></li>
                                <li><a href="formulario/tequipo"> Tipo Equipo</a></li>
                                <li><a href="formulario/tservicio"> Tipo Servicio</a></li>
                                <li><a href="formulario/servicio"> Servicio</a></li> 
                                <!-- <li><a href="formulario/producto"> Producto</a></li>-->
                                <li><a href="producto/registro"> Producto </a></li>
                                <li><a href="formulario/productomarca"> Producto Marca</a></li>
                                <li><a href="admin/pass">Admini Password</a></li>
                                <li class="divider"></li>
                                <!--                                                        <li class="dropdown-header">Nav header</li>-->
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Registros <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--                                                       <li><a href="#">Action</a></li>-->

                                <li class="dropdown-submenu">
                                    <a tabindex="-1" >Equipos(CMBD)</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="formulario/hardwarenew">Registro CI</a></li> 
                                        <li><a href="formulario/hardware">Inventario CI</a></li> 
                                        <li><a href="formulario/personalhardware">Entrega CI</a></li>
                                        <li><a href="formulario/hardwarebaja">Baja CI</a></li>  
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" >Service Desk</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="formularioma/servicioti">Incidencias</a></li> 
                                        <li><a href="formulario/mantenimiento">Cambios</a></li>
                                        <li class="dropdown-submenu">
                                            <a >Peticiones</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="registro/pedidosprodcuto">Suministro/Accesorio</a></li>
                                                <li><a href="registro/soliservicio">Servicio</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="">Problemas</a></li>
                                        <li><a href="formulario/personalservicio">Accesos</a></li>
                                    </ul>
                                </li>
                                <li><a href=""></a></li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1">Mantenimiento</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="plan/mantenimiento">Plan Mantenimiento Preventivo</a></li>
                                        <li><a href="plan/inventario">Plan Inventario</a></li>
                                    </ul>
                                </li>
                                <li><a href="formulario/compra">Compra Suministros</a></li>
                                <li><a href="ajuste/productomarca">Ajuste Productos</a></li>
                                <li><a href="formulario/personal">Personal</a></li>
                                <li><a href="lista/proveedor">Proveedor</a></li>
                                <li><a href="gestioncontrato">Contratos</a></li> 
                                <li><a href="gestiontelefono">Numero Telefono</a></li> 
                                <li><a href="listar/ocompra">Orden de Compra</a></li>
                                <li><a href="registraprtorqmt">Proyecto y Requirimientos</a></li>
                                
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--                                                        <li><a href="#">Action</a></li>-->

                                <li><a href="inventario/hardware">Total Equipos</a></li>
                                <li><a href="busca/hardware">Buscar Equipo</a></li>
                                <li><a href="busca/personal">Buscar Personal</a></li>
                                <li><a href="busqueda/hardware">Busqueda avanzada Equipos</a></li>
                                <li><a href="busqueda/servicioti">Buscar Service Desk</a></li>
                                <li><a href="stock/producto">Stock Productos</a></li>
                                <li><a href="busqueda/pedidosprodcuto">Buscar Pedido</a></li> 
                                <li><a href="lista/proveedor">Proveedor</a></li>
                                <li><a href="migracli400concar">Clientes AS400 Concar</a></li>
                                <li><a href="conusltatelefono">Buscar Telefono e IP</a></li> 
                                <li class="divider"></li>
                                <!--                                                        <li class="dropdown-header">Nav header</li>-->

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li><a href="reporte/suministros">Movimiento Suministro</a></li>
                                <li><a href="generar/reportehardt">PC LAPTOP SERVER</a></li>
                                <li><a href="reporte/hardwarebaja">Baja de Hardware</a></li>
                                <li><a href="reporteplanmant">Plan de Mantenimiento Hardware</a></li>
                                <li><a href="reporte/movimientoproducto">Movimiento de Productos</a></li>
                                <li><a href="rpto_licencia">Licencia Software</a></li>
                                <li><a href="monitorti">MonitoreoTI</a></li>
                                <li class="divider"></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dasboard <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li><a href="dasboard">Grafico Servicios</a></li>

                            </ul>
                        </li>

                        <?php
                        break;
                        case '1':

                        ?>

                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Registros <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li><a href="formulario/pedidosprodcuto">Solicitud Suministros</a></li>
                                <li><a href="listapp/pedidodespacho">Entrega Suministros</a></li>
                                <li><a href="formulario/servicioti">Solicitud Servicios</a></li> 

                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--                                                        <li><a href="#">Action</a></li>-->
                                 <li><a href="busca/hardware">Buscar Equipo</a></li>
                                <li><a href="busca/personal">Buscar Personal</a></li><li> 
<li><a href="busqueda/hardware">Busqueda avanzada Equipos</a></li>
                                <li><a href="migracli400concar">Clientes de AS400 para Concar</a></li>
                                <!--                                                                <li><a href=" ">-</a></li>-->

                            </ul>
                        </li>

                        <?php
                        break;
                        case '2':
                        ?>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Registros <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li class="dropdown-submenu">
                                    <a tabindex="-1" >Service Desk</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="formularioma/servicioti">Incidencias</a></li>  
                                    </ul>
                                </li>
                                <li><a href="formulario/personalhardware">Asignacion </a></li>
                                <li><a href="formulario/pedidosprodcuto">Solicitud Suministros</a></li>
                                <li><a href="formulario/servicioti">Servicios TI</a></li>
                                <li><a href="listaactividades">Proyecto y Requirimientos</a></li>

                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--                                                        <li><a href="#">Action</a></li>-->
                                
                                <li><a href="busca/hardware">Buscar Equipo</a></li>
                                <li><a href="busca/personal">Buscar Personal</a></li><li>
                                <a href="conusltatelefono">Buscar Telefono e IP</a></li> 

                            </ul>
                        </li>

                        <?php

                        break;
                        default:
                        ?>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Registros <b class="caret"></b></a>
                        <ul class="dropdown-menu">                                <!--                                                       <li><a href="#">Action</a></li>-->

                                <li><a href="lista/proveedor">Proveedor</a></li>
                                <li><a href="listar/ocompra">Orden de Compra</a></li>
                            </ul>
                        </li> 
                         <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--                                                        <li><a href="#">Action</a></li>-->
                                
                                <li><a href="busca/hardware">Buscar Equipo</a></li>
                                <li><a href="busca/personal">Buscar Personal</a></li><li> 
                                <li><a href="busqueda/hardware">Busqueda avanzada Equipos</a></li>

                            </ul>
                        </li>   
                        <?php
                        break;
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li> <a data-toggle="modal" data-target="#myModalh"><?php
                        $data = $this->session->userdata('pend');
                        if ($data > 0) {
                            ?><span class="glyphicon glyphicon-bell" aria-hidden="true"><span class="badge progress-bar-warning"><?php echo $data; ?></span></span><?php } ?></a></li>
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $username; ?>
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="datos/personal"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>Datos</a></li>
                                    <li><a href="datos/equipo"><span class="glyphicon glyphicon-hdd Equipos" aria-hidden="true"></span>Equipo</a></li>
                                    <li><a href="#"> <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Servicio</a></li>
                                   <!-- <li><a href="modificar/clave"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Password</a></li>-->
                                    <li><a href="loginin"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>Salir</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>
            <section class="container">
                <!-- Modal -->
                <div class="modal fade in" id="myModalh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-width="760">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Lista Pendientes</h4>
                            </div>               
                            <div class="modal-body">                       
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="active"><TD class="info">#</TD><TD align="center">Codigo</TD><TD align="center">Fecha Registro</TD><TD align="center">Solicitante</TD><TD align="center">Servicio</TD><TD align="center">Asunto</TD><TD>Prioridad</TD><TD>Estado</TD></tr>
                                        <?php
                                        $lserpe = $this->session->userdata('lserpe');
                                        if ($lserpe) {
                                            $conta = 0;
                                            for ($p = 0; $p < count($lserpe); $p++) {
                                                $conta = $conta + 1;
                                                $cad = $lserpe[$p];
                                                $CODSRVTI = $cad['codsolserv'];
                                                $CODIGOSRVTI = $cad['codigoserv'];
                                                $FCRSRVTI = $cad['finatdserv'];
                                                $TIPOSRVTI = $cad['tipsolserv'];
                                                switch ($TIPOSRVTI) {
                                                    CASE '1':
                                                    $TIPOSRVTI = 'Soporte';
                                                    break;
                                                    CASE '2':
                                                    $TIPOSRVTI = 'Peticion';
                                                    break;
                                                    CASE '3':
                                                    $TIPOSRVTI = 'Cambio';
                                                    break;
                                                    CASE '4':
                                                    $TIPOSRVTI = 'Problema';
                                                    break;
                                                }
                                                $USUASOLI = $cad['usuaper'];
                                                $TSERVI = $cad['nomtipserv'];
                                                $SERVI = $cad['nomserv'];
                                                $codigohard = $cad['codigohard'];
                                                $nomequi = $cad['nomequi'];
                                                $nomtequi = $cad['nomtequi'];
                                                $modhard = $cad['modhard'];
                                                $servicio = '';
                                                if ($SERVI == '') {
                                                    $servicio = $nomequi . ' ' . $codigohard;
                                                } else {
                                                    $servicio = $SERVI;
                                                }
                                                $TITUSERV = $cad['tituserv'];
                                                $PRIOSERV = $cad['prioserv'];
                                                switch ($PRIOSERV) {
                                                    CASE 'A':
                                                    $PRIOSERV = '<span class="label label-danger" alt="Alto"><span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>Alto</button>';
                                                    break;
                                                    CASE 'B':
                                                    $PRIOSERV = '<span class="label label-success" alt="Bajo"><span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span>Bajo</button>';
                                                    break;
                                                    CASE 'C':
                                                    $PRIOSERV = '<span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Critico</button>';
                                                    break;
                                                    CASE 'M':
                                                    $PRIOSERV = '<span class="label label-warning"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>Medio</button>';
                                                    break;
                                                }
                                                $ESTSRVTI = $cad['estsolserv'];
                                                switch ($ESTSRVTI) {
                                                    CASE 'P':
                                                    $ESTSRVTI = '<span class="label label-warning">Pendiente</span>';
                                                    break;
                                                    CASE 'A':
                                                    $ESTSRVTI = '<span class="label label-success">Abierto</span>';
                                                    break;
                                                    CASE 'C':
                                                    $ESTSRVTI = '<span class="label label-danger">Cerrado</span>';
                                                    break;
                                                    CASE 'S':
                                                    $ESTSRVTI = '<span class="label label-info">Proceso</span>';
                                                    break;
                                                    CASE 'N':
                                                    $ESTSRVTI = '<span class="label label-default">Anulado</span>';
                                                    break;
                                                }

                                                $url = 'detaserti/' . $CODSRVTI . '/';
                                                $url.= url_title(convert_accented_characters($CODIGOSRVTI), '-', TRUE);
                                                ?>     <tr>
                                                <TD><font size="0px"><?php echo $conta; ?></font></TD>
                                                <TD ><font size="0px"><?php echo anchor($url, $CODIGOSRVTI); ?></font></TD>
                                                <TD><font size="0px"><?php echo $FCRSRVTI; ?></font></TD>
                                                <td><font size="0px"><?php echo $USUASOLI; ?></font></td>
                                                <Td><font size="0px"><?php echo $servicio; ?></font></TD>                                       
                                                    <td style="width:50%"><font size="0px"><?php echo $TITUSERV; ?></font></td>
                                                    <td><font size="0px"><?php echo $PRIOSERV; ?></font></td>
                                                    <TD><font size="0px"><?php echo $ESTSRVTI; ?></font></TD> 

                                                    <?php ?>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?><tr>
                                            <td colspan="11" align="center">No hay datos para mostrar</td>
                                        </tr>
                                        <?php } ?>
                                    </table>

                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>