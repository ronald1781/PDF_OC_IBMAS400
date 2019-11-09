<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reporte_ordencompra_control extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ordencompra_db2_model', '', TRUE);
        $this->load->library('libfpdf');
    }

    public function index($codcia,$codnrosol,$nrosec) {

        //define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        //$this->fpdf = new libfpdf('L', 'mm', 'Legal', true, 'UTF-8', false);
        //$pdf = new FPDF('L','mm',array(110,220));

        $this->fpdf = new libfpdf('L', 'mm', 'A4', true, 'UTF-8', false);      
               
        $this->fpdf->SetMargins(10.4,10.4,10.4,10.4);
        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage('L');
        //$codcia='10';
        //$codnrosol=2019000013;
        //$nrosec='1';
        //$codprest='PRE-001';
        $rscia=$this->ordencompra_db2_model->get_cia($codcia);        
        $CODCIA=trim(odbc_result($rscia, 1));
        $SIGLACIA=trim(odbc_result($rscia, 2));
        $RAZONSOC=trim(odbc_result($rscia, 3));
        $CODCLIEMM=trim(odbc_result($rscia, 4));                
        $rsruccia=$this->ordencompra_db2_model->get_ruccia($CODCLIEMM);
        $RUCCIA=trim(odbc_result($rsruccia, 1)); 
        $rsdircia=$this->ordencompra_db2_model->get_direcia($CODCLIEMM);
        $ALDSCDIRMM=trim(odbc_result($rsdircia, 3));
        $ALNRODIRMM=trim(odbc_result($rsdircia, 4));
        $rsoccab = $this->ordencompra_db2_model->get_orden_compra_cab($codcia,$codnrosol);
        $F3NROSOL=trim(odbc_result($rsoccab, 1));
        $F3FECING=trim(odbc_result($rsoccab, 2));
        $F3CODVEN=trim(odbc_result($rsoccab, 3));
        $F3CODPRV=trim(odbc_result($rsoccab, 4));
        $F3CODCLI=trim(odbc_result($rsoccab, 5));
        $rsnomven = $this->ordencompra_db2_model->get_nom_persvend($codcia,$F3CODVEN);
        $BMPRNOMBV=trim(odbc_result($rsnomven, 1));
        $BMSGNOMBV=trim(odbc_result($rsnomven, 2));
        $BMPRAPLLV=trim(odbc_result($rsnomven, 3));
        $BMSGAPLLV=trim(odbc_result($rsnomven, 4));  
        $rsdadven = $this->ordencompra_db2_model->get_datosadi_persvend($F3CODVEN);
        $NKTELDIR=trim(odbc_result($rsdadven, 1));
        $NKTELNEX=trim(odbc_result($rsdadven, 2));
        $NKTELRPM=trim(odbc_result($rsdadven, 3));
        $NKTELANE=trim(odbc_result($rsdadven, 4));        
        $NKTELPE1=trim(odbc_result($rsdadven, 5));
        $NKTELPE2=trim(odbc_result($rsdadven, 6));
        $NKCORREO=trim(odbc_result($rsdadven, 7));
        $rsdrpgpv = $this->ordencompra_db2_model->get_direpago_prov($CODCLIEMM);
        $ALTIPDIRPGP=trim(odbc_result($rsdrpgpv, 1));
        $ALVIADIRPGP=trim(odbc_result($rsdrpgpv, 2));
        $ALDSCDIRPGP=trim(odbc_result($rsdrpgpv, 3)); 
        $ALNRODIRPGP=trim(odbc_result($rsdrpgpv, 4));
        $ALDSCZDRPGP=trim(odbc_result($rsdrpgpv, 5));
        $ALDEPARTPGP=trim(odbc_result($rsdrpgpv, 6));        
        $ALPROVINPGP=trim(odbc_result($rsdrpgpv, 7));
        $ALDISTRIPGP=trim(odbc_result($rsdrpgpv, 8));
        $rsperpgpv = $this->ordencompra_db2_model->get_perpago_prov($F3CODCLI);
        $PGPRNOMB=trim(odbc_result($rsperpgpv, 1));
        $PGPRAPLL=trim(odbc_result($rsperpgpv, 2));
        $PGSGAPLL=trim(odbc_result($rsperpgpv, 3));
        $rsdadoc = $this->ordencompra_db2_model->get_datosadi_oc($codcia,$codnrosol,$nrosec);
        $F7NROINT=trim(odbc_result($rsdadoc, 1));
        $F7CODMON=trim(odbc_result($rsdadoc, 2));
        $F7OBSER1=trim(odbc_result($rsdadoc, 3));
        $F7MNTPR=trim(odbc_result($rsdadoc, 4));
        $F7MNIGV=trim(odbc_result($rsdadoc, 5));
        $F7MTIGV=trim(odbc_result($rsdadoc, 6));

        $rsmonoc = $this->ordencompra_db2_model->get_moneda_oc($F7CODMON);
        $EUDSCABRMON=trim(odbc_result($rsmonoc, 1));
        $EUDSCCORMON=trim(odbc_result($rsmonoc, 2));
        $rsigvoc = $this->ordencompra_db2_model->get_igv_oc($F7CODMON);
        $valigv=0;
        while (odbc_fetch_row($rsigvoc)) {
        $BKCODIMP=trim(odbc_result($rsigvoc, 1));
        $rsigvvaloc=$this->ordencompra_db2_model->get_valigv_oc($BKCODIMP);
        $BLPRCIMP=trim(odbc_result($rsigvvaloc, 1));
        $valigv=$valigv+$BLPRCIMP;
        }
        $rsdirdtnoc = $this->ordencompra_db2_model->get_direc_dist_oc($F3CODCLI);
        $ALDSCDIRDTN=trim(odbc_result($rsdirdtnoc, 3));
        $ALNRODIRDTN=trim(odbc_result($rsdirdtnoc, 4));
        $rsprsrcpoc = $this->ordencompra_db2_model->get_persresp_recep_oc($F3CODCLI);
        $PGPRNOMB=trim(odbc_result($rsprsrcpoc, 1));
        $PGSGNOMB=trim(odbc_result($rsprsrcpoc, 2));
        $PGPRAPLL=trim(odbc_result($rsprsrcpoc, 3));
        $PGSGAPLL=trim(odbc_result($rsprsrcpoc, 4));
        $PGCORREO=trim(odbc_result($rsprsrcpoc, 5));
        $PGTELEF1=trim(odbc_result($rsprsrcpoc, 6));
        $rsnmbpvoc = $this->ordencompra_db2_model->get_nomprov_oc($F3CODPRV);
        $AHRAZSOCPRV=trim(odbc_result($rsnmbpvoc, 1));
        $rsrucpvoc = $this->ordencompra_db2_model->get_rucprov_oc($F3CODPRV);
        $IPNVORUCPRV=trim(odbc_result($rsrucpvoc, 1));
        $rsdirpvoc = $this->ordencompra_db2_model->get_direprov_oc($F3CODPRV);
        $CGDSCDIRPRV=trim(odbc_result($rsdirpvoc, 3));
        $CGNRODIRPRV=trim(odbc_result($rsdirpvoc, 4));
        $CGDEPARTPRV=trim(odbc_result($rsdirpvoc, 5));
        $CGPROVINPRV=trim(odbc_result($rsdirpvoc, 6));        
        $CGDISTRIPRV=trim(odbc_result($rsdirpvoc, 7));
        $rsdistpvoc = $this->ordencompra_db2_model->get_distprov_oc($CGDEPARTPRV,$CGPROVINPRV,$CGDISTRIPRV);
        $BJDSCCORDSTPV=trim(odbc_result($rsdistpvoc, 1));
        $BJDSCLARDSTPV=trim(odbc_result($rsdistpvoc, 2));
        $rstlfpvoc = $this->ordencompra_db2_model->get_telfprov_oc($F3CODPRV);
        $CGNROTL1PRV=trim(odbc_result($rstlfpvoc, 1));
        $CGNROTL2PRV=trim(odbc_result($rstlfpvoc, 2));
        $rscntpvoc = $this->ordencompra_db2_model->get_contaprov_oc($F3CODPRV);
        $IBPRNOMBPRV=trim(odbc_result($rscntpvoc, 1));
        $IBSGNOMBPRV=trim(odbc_result($rscntpvoc, 2));
        $IBPRAPLLPRV=trim(odbc_result($rsdirpvoc, 3));
        $IBSGAPLLPRV=trim(odbc_result($rsdirpvoc, 4));
        $rsdetoc = $this->ordencompra_db2_model->get_detalle_oc($codcia,$codnrosol,$nrosec);
        $detalleoc=array();
        while (odbc_fetch_row($rsdetoc)) {
        $F8NROSEX=trim(odbc_result($rsdetoc, 1));
        $F8CODPAR=trim(odbc_result($rsdetoc, 2));
        $F8CODREP=trim(odbc_result($rsdetoc, 3));
        $F8CODPRO=trim(odbc_result($rsdetoc, 4));
        $F8CANTID=trim(odbc_result($rsdetoc, 5));
        $F8PPRECI=trim(odbc_result($rsdetoc, 6));
        $F8PMNTMM=trim(odbc_result($rsdetoc, 7));
        $rsdtnompoc=$this->ordencompra_db2_model->get_detnomprd_oc($codcia,$F8CODPAR,$F8CODREP,$F8CODPRO);
        $G9DESCRIC=trim(odbc_result($rsdtnompoc, 1));
        $detalleoc[]=array("item"=>$F8NROSEX,"codigo"=>$F8CODPAR,"descripcion"=>$G9DESCRIC,"fechaentrega"=>'',"cantidad"=>$F8CANTID,"precio"=>$F8PPRECI,"importe"=>$F8PMNTMM);
        } 
        $fechoc = date("dmY", strtotime($F3FECING));
        $title = 'OC_'. $codnrosol.'_'.$fechoc.'_'.strtoupper($AHRAZSOCPRV);
         $this->fpdf->SetTitle($title);
        $fecha=gmdate("Y-m-d", time() - 18000);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->SetFillColor(200, 200, 200);
  $this->fpdf->image('assest/imagen/'.$codcia.'.png', 1, 10, 60,0,'PNG');
        $this->fpdf->Cell(130, 24, '', '', 0, '', 0);
        $tipoc='SERVICIO';     
        $this->fpdf->SetFont('Arial', 'B', 10);     
        $this->fpdf->Cell(70, 6, utf8_decode('ORDEN DE COMPRA  '.$tipoc), 'TBRL', 0, 'C', 0);        
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(70, 6, utf8_decode('Nro: '.$codnrosol), 'TBR', 0, 'C', 0);       
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', 'B', 09);
        $this->fpdf->Cell(57);
        $this->fpdf->Cell(73,4,utf8_decode(strtoupper(utf8_decode($RAZONSOC))),'R',0,'',0);
        $this->fpdf->SetFont('Arial', '', 07);
        $fechoc = date("d-m-Y", strtotime($F3FECING));
        $this->fpdf->Cell(70, 4, utf8_decode('Fecha        : '.$fechoc), '', 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 07);    
        $this->fpdf->Cell(70, 4, utf8_decode('Dirección de Cobranza:'), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(57);
        $this->fpdf->SetFont('Arial', 'B', 07);
        $this->fpdf->Cell(73,4,'RUC. :  '.$RUCCIA,'R',0,'',0);
        $contactosoli=ucwords(strtolower($BMPRNOMBV.' '.$BMSGNOMBV.', '.$BMPRAPLLV.' '.$BMSGAPLLV));
        $this->fpdf->Cell(70, 4, utf8_decode('Contacto    : '.$contactosoli), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);
        $dirpgoprov='Av. '.$ALDSCDIRPGP.' '.$ALNRODIRPGP.' '.$ALDSCZDRPGP;
        $this->fpdf->Cell(70, 4, utf8_decode($dirpgoprov), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(57);
        $this->fpdf->SetFont('Arial', '', 07);
        $this->fpdf->Cell(73,4,utf8_decode('Ofic. Principal: '.utf8_decode('Av. '.$ALDSCDIRMM.' '.$ALNRODIRMM).' - La Victoria'),'R',0,'',0);
        $this->fpdf->Cell(70, 4, utf8_decode('Teléfono     : '.$NKTELDIR.' '.$NKTELANE), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07); 
        $perpago=ucwords(strtolower($PGPRNOMB.', '.$PGPRAPLL.' '.$PGSGAPLL));     
        $this->fpdf->Cell(70, 4, utf8_decode('Atencion: Srta. '.$perpago), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4); 
        $this->fpdf->Cell(57);
        $this->fpdf->SetFont('Arial', '', 07);
        $this->fpdf->Cell(73,4,utf8_decode('Av. Nicolás Arriola 1551 / Av. Nicolás Arriola 1473 - La Victoria'),'R',0,'L',0);
        $this->fpdf->Cell(70, 4, utf8_decode('Movil            : '.$NKTELPE1), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', 'B', 07);       
        $this->fpdf->Cell(70, 4, utf8_decode('Condiciones de Pago:'), 'TLR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(57);
        $this->fpdf->SetFont('Arial', '', 07);
        $this->fpdf->Cell(73,4,utf8_decode('Av. Nicolás Ayllón 3238 - Ate Vitarte'),'R',0,'L',0);
        $this->fpdf->Cell(70,4, utf8_decode('email          : '.strtolower($NKCORREO)), '', 0, 'L', 0);        
        $this->fpdf->SetFont('Arial', '', 06); 
        $datacpg= ucwords(strtolower('Contado'));    
        $this->fpdf->Cell(70,4, utf8_decode($datacpg), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(57);
        $this->fpdf->SetFont('Arial', '', 07);
        $this->fpdf->Cell(73,4,utf8_decode('Av. Alfredo Mendiola 4159 - Los Olivos'),'R',0,'L',0);
        $this->fpdf->Cell(70, 4, utf8_decode('Nro Cotizac.: '.strtoupper($F7NROINT)), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', 'B', 07);       
        $this->fpdf->Cell(70, 4, utf8_decode('Moneda:'), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(57);
        $this->fpdf->SetFont('Arial', 'B', 07);
        $this->fpdf->Cell(73,4,utf8_decode('Teléf.. : 613-1500 Fax: 613-1514 -La Victoria - Lima - Perú '),'R',0,'L',0);
        $this->fpdf->Cell(70, 4, utf8_decode(' '), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);       
        $this->fpdf->Cell(70, 4, utf8_decode($EUDSCABRMON.' '.$EUDSCCORMON), 'BLR', 0, 'C', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', 'B', 08);
        $this->fpdf->Cell(57,4,utf8_decode('CLAUSULA DE PENALIDAD:'),'',0,'L',0);       
        $this->fpdf->Cell(73,4,utf8_decode(''),'',0,'L',0);
        $this->fpdf->Cell(70,4, utf8_decode('PROVEEDOR'), 'TL', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', 'B', 07);       
        $this->fpdf->Cell(70,4, utf8_decode('Dirección de Destino:'), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);
        $this->fpdf->Cell(130,4,utf8_decode('M&M Repuestos y Servicios S.A., podrá aplicar penalidad por incumplimiento de entrega en la fecha acordada,'),'R',0,'L',0);
        $this->fpdf->Cell(70, 4, utf8_decode(''), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);       
        $this->fpdf->Cell(70, 4, utf8_decode('Sucursal: '), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode('pudiendo reservarse el derecho sobre la aceptación del servicio o producto. No obstante el proveedor deberá hacer'),'R',0,'L',0);
        $this->fpdf->SetFont('Arial', 'B', 08); 
        $this->fpdf->Cell(70, 4, utf8_decode(strtoupper($AHRAZSOCPRV)), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);      
        $this->fpdf->Cell(70, 4, utf8_decode('Av. '.$ALDSCDIRDTN.' '.$ALNRODIRDTN), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);              
        $this->fpdf->Cell(130,4,utf8_decode('los esfuerzos necesarios a su cargo para la realización  del servicio o entrega del producto solicitado, en la fecha '),'R',0,'L',0);               
        $this->fpdf->Cell(70, 4, utf8_decode('RUC           : '.$IPNVORUCPRV), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);       
        $this->fpdf->Cell(70, 4, utf8_decode('' ), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode('definida en la orden de compra.'),'R',0,'L',0);        
        $this->fpdf->Cell(70, 4, utf8_decode('Direccion:'), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);
        $perrecibe=ucwords(strtolower($PGPRNOMB.' '.$PGSGNOMB.', '.$PGPRAPLL.' '.$PGSGAPLL));     
        $this->fpdf->Cell(70, 4, utf8_decode('Encargado:   '.$perrecibe), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode(''),'R',0,'L',0);
        $this->fpdf->SetFont('Arial', '', 07); 
        $this->fpdf->Cell(70, 4, utf8_decode(strtolower(' '.$CGDSCDIRPRV.' '.$CGNRODIRPRV)), '', 0, 'C', 0);  
        $this->fpdf->SetFont('Arial', 'B', 07);             
        $this->fpdf->Cell(70, 4, utf8_decode('Horario de Atención:'), 'TLR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode('- El proveedor acepta los términos y condiciones de la orden de compra.'),'R',0,'L',0);
        $this->fpdf->SetFont('Arial', '', 07); 
        $this->fpdf->Cell(70, 4, utf8_decode(''), '', 0, 'L', 0);               
        $this->fpdf->Cell(70, 4, utf8_decode(''), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode('- El proveedor se obliga a entregar productos/servicios de acuerdo a las características especificadas, garantizando '),'R',0,'L',0);
       $this->fpdf->Cell(70, 4, utf8_decode('Teléf. / Fax  :  '.$CGNROTL1PRV.' '.$CGNROTL2PRV), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);       
        $this->fpdf->Cell(70, 4, utf8_decode('Lunes a Viernes de 8:30am.  a 5:30pm.'), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 7);               
        $this->fpdf->Cell(130,4,utf8_decode('que los productos y suministros, o el servicio son de primera calidad.'),'R',0,'L',0);
        $this->fpdf->Cell(70,4, utf8_decode('Atencion:        '), '', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);       
        $this->fpdf->Cell(70,4, utf8_decode('Sábados de 8:30am. a 1:00pm.'), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode('- Emitir factura (s) y guía (s), exclusivamente por esta orden de compra.'),'R',0,'L',0);
        $contprove=$IBPRNOMBPRV.' '.$IBSGNOMBPRV.', '.$IBPRAPLLPRV.' '.$IBSGAPLLPRV;
        $this->fpdf->Cell(70,4, utf8_decode(ucwords(strtolower($contprove))), '', 0, 'C', 0); 
        $this->fpdf->SetFont('Arial', 'B', 07);  
        $this->fpdf->Cell(70,4, utf8_decode(''), 'LR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 07);               
        $this->fpdf->Cell(130,4,utf8_decode('- Las guías de remisión deberán consignar las referencias de la orden de compra.'),'R',0,'L',0);
        $this->fpdf->Cell(70,4, utf8_decode(''), 'B', 0, 'L', 0); 
        $this->fpdf->SetFont('Arial', '', 07);       
        $this->fpdf->Cell(70,4, utf8_decode(''), 'BLR', 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', 'B', 07);
        $this->fpdf->Cell(7, 5, utf8_decode('Ítem'), 'TBLR', 0, 'C', 0);
        $this->fpdf->Cell(32, 5, utf8_decode('Cód. Artículo'), 'TBRL', 0, 'L', 0);
        $this->fpdf->Cell(136,5, utf8_decode('Descripción'), 'TBRL', 0, 'C', 0);
        $this->fpdf->Cell(25, 5, utf8_decode('Fecha de Entrega'), 'TBRL', 0, 'L', 0);
        $this->fpdf->Cell(16, 5, utf8_decode('Cantidad'), 'TBRL', 0, 'C', 0);
        $this->fpdf->Cell(25, 5, utf8_decode('P. Unitario'), 'TBRL', 0, 'C', 0);
        $this->fpdf->Cell(30, 5, utf8_decode('Total'), 'TBRL', 0, 'C', 0);
        $this->fpdf->Ln(5);
        //Cuerpo
        $x = 1;
        $nroitel=10;        
        $numite=count($detalleoc);
        for($i=0;$i<$numite;$i++){
            $cad=$detalleoc[$i];
            $this->fpdf->SetFont('Arial', '', 07);
            $this->fpdf->Cell(7, 5, $cad['item'], 'LR', 0, 'C', 0);
            $this->fpdf->Cell(32, 5, utf8_decode($cad['codigo']), 'R', 0, 'L', 0);
            $this->fpdf->SetFont('Arial', '', 05);
            $this->fpdf->Cell(136, 5, utf8_decode($cad['descripcion']), 'R', 0, 'L', 0);
            $this->fpdf->SetFont('Arial', '', 07);
            $fentre = $cad['fechaentrega']; 
            $this->fpdf->Cell(25, 5, utf8_decode($fentre), 'R', 0, 'L', 0);
            $this->fpdf->Cell(16, 5, utf8_decode($cad['cantidad']), 'R', 0, 'C', 0);
            $precio=number_format((double)$cad['precio'],'2','.',',');
            $importe=number_format((double)$cad['importe'],'2','.',',');
            $this->fpdf->Cell(25, 5, utf8_decode($EUDSCABRMON.' '.$precio), 'R', 0, 'C', 0);
            $this->fpdf->Cell(30, 5, utf8_decode($EUDSCABRMON.' '.$importe), 'R', 0, 'C', 0);           
            $this->fpdf->Ln(5);
}
        if($numite==$nroitel||$numite>$nroitel){}else{
            $rest=$nroitel-$numite;
            for($i=0;$i<=$rest;$i++){

                $this->fpdf->SetFont('Arial', '', 07);
                $this->fpdf->Cell(7, 5, '', 'LR', 0, 'C', 0);
                $this->fpdf->Cell(32, 5, utf8_decode(''), 'R', 0, 'L', 0);
                $this->fpdf->Cell(136, 5, utf8_decode(''), 'R', 0, 'L', 0);
                $this->fpdf->Cell(25, 5, utf8_decode(''), 'R', 0, 'L', 0);
                $this->fpdf->Cell(16, 5, utf8_decode(''), 'R', 0, 'C', 0);
                $this->fpdf->Cell(25, 5, utf8_decode(''), 'R', 0, 'C', 0);
                $this->fpdf->Cell(30, 5, utf8_decode(''), 'R', 0, 'C', 0);           
                $this->fpdf->Ln(5);
            }
        }      

    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(108, 5, 'CENTRO DE COSTO: ', 'TLR', 0, 'L', 0);
    $this->fpdf->Cell(108, 5, utf8_decode('OBSERVACIONES :'), 'TR', 0, 'L', 0);
    $this->fpdf->Cell(25, 5, utf8_decode('Sub Total'), 'TBR', 0, 'C', 0);
    $this->fpdf->SetFont('Arial', '', 7);
    $subtotal=$F7MNTPR;//number_format((double)$F7MNTPR ,'2','.',',');
    $this->fpdf->Cell(30, 5, utf8_decode($EUDSCABRMON.' '.$subtotal), 'TBR', 0, 'C', 0);           
    $this->fpdf->Ln(5);
    $this->fpdf->SetFont('Arial', '', 07);
    $concc=0; 
    $size=($concc>3)?'05':'07';
    $dscccost='';
    $this->fpdf->SetFont('Arial', '', $size);
    $this->fpdf->Cell(108, 5,$dscccost,'LB', 0, 'C', 0);
    $this->fpdf->SetFont('Arial', '', '05');
    $this->fpdf->Cell(108, 5, utf8_decode(strtoupper($F7OBSER1)), 'LBR', 0, 'L', 0);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $nomimp='IGV';
    $this->fpdf->Cell(25, 5, utf8_decode($nomimp.' '.$valigv.'%'), 'BR', 0, 'C', 0);
    $this->fpdf->SetFont('Arial', '', 07);
    $importigv=number_format((double)$F7MNIGV,'2','.',',');
    $this->fpdf->Cell(30, 5, utf8_decode($EUDSCABRMON.' '.$importigv), 'BR', 0, 'C', 0);           
    $this->fpdf->Ln(5);
    $ctacte='';      
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(216, 5, $ctacte, '', 0, 'L', 0);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(25, 5, utf8_decode('TOTAL'), 'LBR', 0, 'C', 0);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(30, 5, utf8_decode($EUDSCABRMON.' '.number_format((double)$F7MTIGV,'2','.',',')), 'BR', 0, 'C', 0);           
    $this->fpdf->Ln(5);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(216, 5,  '', 0, 'L', 0);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(25, 5, utf8_decode('DSTO.'), 'LBR', 0, 'C', 0);
    $this->fpdf->SetFont('Arial', '', 07);
    $this->fpdf->Cell(30, 5, utf8_decode($EUDSCABRMON.' '.number_format(0,'2','.',',')), 'BR', 0, 'C', 0);           
    $this->fpdf->Ln(5); 
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(216, 5,  '', 0, 'L', 0);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(25, 5, utf8_decode('TOTAL.GRL.'), 'LBR', 0, 'C', 0);
    $this->fpdf->SetFont('Arial', 'B', 07);
    $this->fpdf->Cell(30, 5, utf8_decode($EUDSCABRMON.' '.number_format((double)$F7MTIGV,'2','.',',')), 'BR', 0, 'C', 0);           
    $this->fpdf->Ln(5);
        //Cuenta Bancaria Proveedor
/*
$this->fpdf->SetXY(10,164);
    foreach ($listctacte1 as $value) {
       $this->fpdf->SetFont('Arial', 'B', 06);
       $this->fpdf->Cell(24, 3, utf8_decode($value['nomtpcta']), '', 0, 'L', 0);
       $this->fpdf->Cell(25, 3, utf8_decode(''), '', 0, 'L', 0);
       $this->fpdf->Cell(30, 3, utf8_decode(''), '', 0, 'L', 0); 
       $this->fpdf->Ln(3);
       foreach ($value['datos'] as $key => $val) {
           $this->fpdf->SetFont('Arial', '', 06);
           $this->fpdf->Cell(25, 3, utf8_decode(ucwords(strtolower($val['nomban']))), '', 0, 'L', 0);
           $this->fpdf->Cell(10, 3, utf8_decode(ucwords(strtolower($val['nombremon']))), '', 0, 'L', 0);
           $this->fpdf->Cell(30, 3, utf8_decode($val['nroctacteprvbn']), '', 0, 'L', 0); 
           $CI = ($val['nrociprvbn']=='') ? "":'C.I:'.$val['nrociprvbn'];   
           $this->fpdf->Cell(30, 3, utf8_decode($CI), '', 0, 'L', 0);
           $this->fpdf->Ln(3);

       }
   }
*/

   $this->fpdf->SetY(179);
        // Select Arial italic 8
        $this->fpdf->SetFont('Arial','I',8);
        // Print centered page number
        $this->fpdf->Cell(0,10,'FCG0103/25052017 ',0,0,'L');
         

   $this->fpdf->Output($title . '.pdf', 'I');
}



}

?>