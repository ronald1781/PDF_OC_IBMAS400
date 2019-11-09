<section clase="container">
    <div class="row">
        <div class="col-md-12"> 
            <ul class="nav nav-tabs">
                <li >
                    <a  href="formulario/compra">Reistro</a>
                </li>
                <li class="active">
                    <a  href="lista/compra">Lista</a>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="form-signin-heading">Lista de Hadrware</h3>
            <?php
            if ($this->session->userdata("mensajeperupd")) {

                echo '<div class="error">' . $this->session->userdata("mensajeperupd") . '</div>';
                $this->session->unset_userdata("mensajeperupd");
            }
            ?>  
            <?php
            if ($this->session->userdata("mensajepererru")) {
                echo '<div class="error">' . $this->session->userdata("mensajepererru") . '</div>';
                $this->session->unset_userdata("mensajepererru");
            }
            ?>
            <form name="accion" action="accion/producto" method="POST" id="forediprodu">  

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="active"><TD class="info">#</TD><TD>Codigo</TD><TD>Equipo</TD><TD>Tipo</TD><TD>Marca</TD><TD>Modelo</TD><TD>Serie</TD><TD>Estado</TD><TD colspan="2">Accion</TD></tr>

                        <?php
                        $conta = 0;
                        for ($p = 0; $p < count($lhardware); $p++) {
                            $conta = $conta + 1;
                            $cad = $lhardware[$p];
                            $CODHARD = $cad['codhard'];
                            $CODIGOHARD = $cad['codigohard'];
                            $NOMEQUI = $cad['nomequi'];
                            $NOMTEQUI = $cad['nomtequi'];
                            $NOMMAR = $cad['nommar'];
                            $MODHARD = $cad['modhard'];
                            $SNUMHARD = $cad['snumhard'];
                            
                            $ESTHARD = $cad['esthard'];
                            switch ($ESTHARD) {
                                CASE 'D':
                                    $ESTHARD = 'DISPONIBLE';
                                    break;
                                CASE 'A':
                                    $ESTHARD = 'ASIGNADO';
                                    break;
                            }
                            $url = 'detahard/' . $CODHARD . '/';
                            $url.= url_title(convert_accented_characters($NOMEQUI), '-', TRUE);
                            ?>     <tr>
                                <TD><?php echo $conta; ?></TD>
                                <TD><?php echo $CODIGOHARD; ?></TD>
                                <TD style="width:10%"><?php echo anchor($url, $NOMEQUI); ?></TD>
                                <TD style="width:10%"><?php echo $NOMTEQUI; ?></TD>
                                <TD ><?php echo $NOMMAR; ?></TD> 
                                <TD ><?php echo $MODHARD; ?></TD>   
                                <TD ><?php echo $SNUMHARD; ?></TD> 
                                <TD ><?php echo $ESTHARD; ?></TD>  
                                <TD><a class="btn btn-warning" href="imprimirpdf/codbar/<?php echo $CODHARD; ?>" target="blanck" title="Imprimir"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>


                            </TD>
                                                               <TD>
                                    <input type="hidden" name="txtCodhard" value="<?php echo $CODHARD; ?>"/>
                                    <input type="submit" value="Editar"  class="btn btn-primary"/> 

                                </TD>
                                <?php
                            }
                            ?>
                        </tr>
                    </table>

                </div>
            </form>
            <div class="row">             
                <div class="col-md-3"> 
                </div>
                <div class="col-md-6"> 
                    <?php echo $this->pagination->create_links(); ?> 
                </div>
                <div class="col-md-3"> </div>

            </div>
        </div> 
    </div>   
</section>



