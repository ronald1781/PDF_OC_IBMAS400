<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compra_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function lista_empresa() {
        $this->db->select('codemp,codasemp,rucemp,rsemp,direemp');
        $this->db->from('tbempresa');
        $this->db->where('estrgemp', 'A');
        $this->db->order_by('codemp','asc');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function lista_moneda() {
        $this->db->select('codigomon,nombremon,simbmone');
        $this->db->from('tbmoneda');
        $this->db->where('estrgmon', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function insertar_compra($comp_cab_pie, $detalle) {
        $codiper = $this->session->userdata('codiper');
        $this->db->trans_start(true);
        $this->db->trans_begin();
        $compras = array(
            'numidecom' => $comp_cab_pie['numcomp'],
            'codprove' => $comp_cab_pie['txtcodprv'],
            'codcondpg' => $comp_cab_pie['txtcodcpg'],
            'codigomone' => $comp_cab_pie['selemone'],
            'codtdocucom' => '1', //tipo documento 1 factura 2 boleta ,3 nota de credito. 
            'numocgen' => $comp_cab_pie['txtnumoc'],
            'numdocucom' => $comp_cab_pie['txtnfact'],
            'fechacom' => $comp_cab_pie['fechacomp'],
            'sbtotal' => $comp_cab_pie['subTotal'],
            'igvcomp' => $comp_cab_pie['montoigv'],
            'imtlcomp' => $comp_cab_pie['totApagar'],
            'factadjcom' => $comp_cab_pie['txtfacts'],
            'usucrcomp' => $comp_cab_pie['usucrcomp'],
            );

        $this->db->insert('tbcompra', $compras);
        $insert_id = $this->db->insert_id();

        $data = array();
        $comart = array();
        foreach ($detalle as $row) {
            $list_comp = array(
                'codcomp' => $insert_id,
                'codcatecom' => $row->codcate,
                'codmarcom' => $row->codmarpro,
                'codprodu' => $row->codpro,
                'codimoncom' => $row->codmone,
                'cantprodu' => $row->cantpro,
                'precprodu' => $row->prepro,
                'impprodu' => $row->importe,
                'usucrprodu' => $codiper,
                );

            $this->db->select('codpromar,imporpro,codimoneda,stockpro');
            $this->db->from('tbproductomarca');
            $this->db->where('codprodu', $row->codpro);
            $this->db->where('codmar', $row->codmarpro);
            $consulta = $this->db->get();
            $rs = $consulta->row_array();
            // $precio_compra = ($rs['imporpro'] + ($row->prepro) / 2);
            $cp = array('codpromar' => $rs['codpromar'],
                'stockpro' => $rs['stockpro'] + $row->cantpro,
                'imporpro' => $row->prepro, //$precio_compra,
                'codimoneda' => $row->codmone,
                'fmdpromar' => gmdate("Y-m-d H:i:s", time() - 18000),
                'usumdpromar' => $codiper,
                );
            array_push($data, $list_comp);
            array_push($comart, $cp);
        }

        $this->db->insert_batch('tbcompradetalle', $data);
        $this->db->update_batch('tbproductomarca', $comart, 'codpromar');
        $movimiento = array(
            'iotmovi' => 1, //1 entrada 2 salida 
            'coddocumv' => $insert_id,
            'codpermv' => $comp_cab_pie['txtcodprv'],
            'codtmovi' => '1', //1 compra 2 solicitud 3 reparacion 4 devolucion           
            'codtidocu' => '1', //1 factura 2 solicitud, 3 orden de trabajo 4 devosoli
            'numdocu' => $comp_cab_pie['numcomp'],
            'impormovi' => $comp_cab_pie['totApagar'],
            'usucrmovi' => $comp_cab_pie['usucrcomp']
            );
        $this->db->insert('tbmovimientos', $movimiento);
        $insertmv_id = $this->db->insert_id();
        $datamv = array();
        foreach ($detalle as $row) {
            $this->db->select('codpromar,imporpro,codimoneda,stockpro');
            $this->db->from('tbproductomarca');
            $this->db->where('codprodu', $row->codpro);
            $this->db->where('codmar', $row->codmarpro);
            $consulta = $this->db->get();
            $rs = $consulta->row_array();
            $list_dmovi = array(
                'codmv' => $insertmv_id,
                'codtomv' => $insert_id,
                'codartimv' => $row->codpro,
                'codcatemv' => $row->codcate,
                'codmarmv' => $row->codmarpro,
                'cantentra' => $row->cantpro,
                'saldomv' => $rs['stockpro'],
                'prepromv' => $row->prepro,
                'imppromv' => $row->importe,
                'codusuariomv' => $codiper,
                );
            array_push($datamv, $list_dmovi);
        }
        $this->db->insert_batch('tbmovimientodetalle', $datamv);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }

        $this->db->trans_off();
    }

    public function ultimoId() {

        $sql = $this->db->query("select concat('14',(select right(concat('00000000',(select count(*) as id from tbcompra)+1),8)))as id")->row();

        return $sql;
    }

    public function total_filas() {
        $this->db->from('tbcompra');
        $this->db->where('estrgcomp', 'A');
        $sql = $this->db->get();
        return $sql->num_rows();
    }

    function lista_compra($inicio = false, $limite = false) {
        if ($inicio !== false && $limite !== false) {
            $this->db->limit($limite, $inicio);
        }
        $this->db->select('codcomp,numidecom,rasprove,fechacom,numdocucom,simbmone,imtlcomp,nomcondpg,factadjcom,estrgcomp');
        $this->db->from('tbcompra');
        $this->db->join('tbproveedor', 'tbproveedor.codprove=tbcompra.codprove');
        $this->db->join('tbcondicionpago', 'tbcondicionpago.codcondpg=tbcompra.codcondpg');
        $this->db->join('tbmoneda', 'tbmoneda.codigomon=tbcompra.codigomone');
        $this->db->where('estrgcomp', 'A');
        $this->db->order_by('codcomp', 'desc');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    public function comp_cod($codcomp) {
        $this->db->select('codcomp,numidecom,rasprove,fechacom,numdocucom,simbmone,sbtotal,igvcomp,imtlcomp,nomcondpg,nombremon,factadjcom');
        $this->db->from('tbcompra');
        $this->db->join('tbproveedor', 'tbproveedor.codprove=tbcompra.codprove');
        $this->db->join('tbcondicionpago', 'tbcondicionpago.codcondpg=tbcompra.codcondpg');
        $this->db->join('tbmoneda', 'tbmoneda.codigomon=tbcompra.codigomone');
        $this->db->where('estrgcomp', 'A');
        $this->db->where('codcomp', $codcomp);
        $sql = $this->db->get();
        return $sql->row();
    }

    function detalle_compra($codcompra) {
        $this->db->select('codcomp,nomprodu,nommar,cantprodu,precprodu,impprodu');
        $this->db->from('tbcompradetalle');
        $this->db->join('tbmarca', 'tbmarca.codmar=tbcompradetalle.codmarcom');
        $this->db->join('tbproducto', 'tbproducto.codprodu=tbcompradetalle.codprodu');
        $this->db->where('estrgdprodu', 'A');
        $this->db->where('codcomp', $codcompra);
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    /*Gestion de orden de compra*/
    public function datos_empresa($codcias) {
        $this->db->select('codemp,codasemp,rucemp,rsemp,direemp,telemp');
        $this->db->from('tbempresa');
        $this->db->where('estrgemp', 'A');
        $this->db->where('codemp', $codcias);
        $sql = $this->db->get();
        return $sql->row();
    }
    function listar_proveedores(){
        $this->db->select('codprove,rasprove,rucprove');
        $this->db->from('tbproveedor');
        $this->db->where('estrgprove', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function listar_personal(){       
        $this->db->select('codper,dniper,apepper,apemper,pnomper,snomper,codcarg,codcn,codarea');
        $this->db->from('tbpersonal');
        $this->db->where('estrgper', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function listar_sucursal(){       
        $this->db->select('codcn,nomcn,dirsuc,distcn');
        $this->db->from('tbcn');
        $this->db->where('estrgcn', 'A');
        $this->db->where('viscn', 1);
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function listar_personal_pagos(){   
       // $persoarea=array('11','3');    
        $this->db->select('codper,dniper,apepper,apemper,pnomper,snomper');
        $this->db->from('tbpersonal');
        //$this->db->where_in('codarea',  $persoarea);
        $this->db->where('estrgper', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    function listar_centro_costo(){       
        $this->db->select('codccos,codiccos,nomccos');
        $this->db->from('tbcentrocosto');
        $this->db->where('estrgccos', 'A');
        $this->db->order_by('codiccos', 'asc');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    function listar_unidadmedida(){       
        $this->db->select('codunimed,nomunimed,simbunimed');
        $this->db->from('tbunidadmedidad');
        $this->db->where('estrgunimed', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function condi_pago() {
        $this->db->select('codcondpg,nomcondpg');
        $this->db->from('tbcondicionpago');
        $this->db->where('estrgcondpg', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    public function ultimoId_oc($codcia) {
        $sql = $this->db->query("select (select right(concat('000000000',(select count(*) as id from tbordencompra where codempoc=".$codcia.")+1),10))as id")->row();
        return $sql;
    }
    function save_orden_compra($cab_oc,$det_oc){

        $subTotal =$cab_oc['impoc'];
        $selectocst=$cab_oc['selectocst'];
        $canti=count($selectocst);
        $div=$subTotal/$canti;
        $impxctocsto=round($div, 2);

        $codiper = $this->session->userdata('codiper');
        $this->db->trans_start(true);
        $this->db->trans_begin();
        $anio=gmdate("Y", time() - 18000);
        $ocompra = array(
            'codempoc'=>$cab_oc['codempoc'],
            'tipdocuoc' => $cab_oc['tipdocuoc'],
            'tipoc'=>$cab_oc['tipoc'],
            'periooc' => $anio,
            'codigoc' => $cab_oc['codigoc'],
            'fechaoc'=>gmdate("Y-m-d H:i:s", time() - 18000),
            'codprvoc' => $cab_oc['codprvoc'],
            'codmdoc' => $cab_oc['codmdoc'],
           // 'condipgoc' => $cab_oc['condipgoc'],
            'condpgoc' => $cab_oc['condpgoc'],
            'nroctzoc' => $cab_oc['nroctzoc'],
            'codcntoc' => $cab_oc['codcntoc'],
            'sucrcpoc' => $cab_oc['sucrcpoc'],
            'codrcpoc' => $cab_oc['codrcpoc'],
            'sucpgpoc' => $cab_oc['sucpgpoc'],
            'codpgpoc' => $cab_oc['codpgpoc'],
            'obsoc' => $cab_oc['obsoc'],
            'impoc' => $cab_oc['impoc'],
            'ptjimptoc' => $cab_oc['ptjimptoc'],
            'afecimpoc' => $cab_oc['afecimpoc'],
            'imptimpoc' => $cab_oc['imptimpoc'],
            'totimpoc' => $cab_oc['totimpoc'],
            'impdscoc' => $cab_oc['impdscoc'],
            'imptotaloc' => $cab_oc['imptotaloc'],
            'usucroc' => $cab_oc['usucroc'],
            );

        $this->db->insert('tbordencompra', $ocompra);
        $insert_id = $this->db->insert_id();
        foreach ($selectocst as $dstctocst) {        
            $dstctocsto = array(
                'cdgccdtcs' => $dstctocst['codctocst'],
                'cdgocdtcs' => $insert_id,
                'impptjdtcs' => $impxctocsto,
                'monedtcs' => $cab_oc['codmdoc'],
                'usucrdtcs' => $cab_oc['usucroc'],
                );
            $this->db->insert('tbocdestribucioncosto', $dstctocsto);
        }
        $ocaudit = array(
            'codiocaud' => $insert_id,
            'estocaud'=>'G',
            'usucrocaud' => $cab_oc['usucroc'],
            );
        $this->db->insert('tbocauditoria', $ocaudit);


        if(count($det_oc)>0){
            $dataoc = array();
            $list_doc;
            foreach ($det_oc as $row) {

                $list_doc['cdgoocd'] = $insert_id;
                $list_doc['flgsvrprd'] = $row['medioserv'];
                $list_doc['codsvrprdocd'] = $row['txtnrocodprod'];
                $list_doc['titsvrprdocd'] = trim($row['txtdsccort']);
                    //'dscsvrprdocd' => $row->areadsclarg,
                $list_doc['fetsvrprdgocd'] = $row['txtfentreg'];
                $list_doc['ctdsvrprdocd'] = $row['txtcntad'];
                $list_doc['unimedocd'] = $row['seleunimed'];
                $list_doc['pusvrprdocd'] = $row['txtpreuni'];
                $list_doc['codmonocd'] = $cab_oc['codmdoc'];
                $list_doc['impsvrprdocd'] = $row['importe'];
                $list_doc['usucrocd'] = $codiper;

                $this->db->insert('tbordencompradetalle', $list_doc);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $insert_id;
            }
            $this->db->trans_off();

        } 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $insert_id;
        }
        return $insert_id;
        $this->db->trans_off();
        
    }

    function update_estado_oc($codioc,$estoc,$motianu) {

       $ocaudit = array(
        'codiocaud' => $codioc,
        'estocaud'=>$estoc,
        'obsaud'=>$motianu,
        'usucrocaud' => $this->session->userdata('codiper'),
        );
       $this->db->insert('tbocauditoria', $ocaudit);

       $this->db->set('usumdoc', $this->session->userdata('codiper'));
       $this->db->set('fmdoc', gmdate("Y-m-d H:i:s", time() - 18000));
       $this->db->set('estoc', $estoc);
       $this->db->where('codoc', $codioc);
       $this->db->update('tbordencompra');
       return $this->db->affected_rows();

   }

   function lista_orden_compra(){
    $previ= $this->session->userdata('prevper');
    $codiper=$this->session->userdata('codiper');
    $this->db->select('a.codoc,a.tipoc,a.nroseroc,a.codigoc, a.fechaoc,b.rucprove,b.rasprove,c.apepper,c.apemper,c.pnomper,c.snomper,d.nomcondpg,e.simbmone,a.totimpoc,a.imptotaloc,a.estoc,f.ncemp');
    $this->db->from('tbordencompra a');
    $this->db->join('tbproveedor b', 'a.codprvoc=b.codprove');
    $this->db->join('tbpersonal c', 'a.codcntoc=c.codper');
    $this->db->join('tbcondicionpago d', 'a.condipgoc=d.codcondpg','left outer');
    $this->db->join('tbmoneda e', 'a.codmdoc=e.codigomon');
    $this->db->join('tbempresa f', 'a.codempoc=f.codemp');
    $this->db->where('a.estrgoc', 'A');
    /*if($previ==0 && $codiper==1){*/
        if($codiper==1 || $codiper==278 || $codiper==29){

        }else{
            $this->db->where('a.usucroc',$codiper);
        }
        $this->db->order_by('a.codoc', 'desc');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function imprime_orden_compra_cab($codoc){

        $this->db->select('a.codoc,a.codempoc,a.nroseroc,a.codigoc,a.tipoc,a.condpgoc,a.tipdocuoc,a.ptjimptoc, a.fechaoc,a.codprvoc,a.impoc,a.impdscoc,a.imptotaloc,a.obsoc,b.rucprove,b.rasprove,b.direprove,b.telfprove,b.contprove,b.emaiprove,b.codprove,c.apepper,c.apemper,c.pnomper,c.snomper,f.dirsuc,f.distcn,f.codcn as codcndirpg,h.dirsuc as dirsc,h.distcn as distsc,h.codcn as codsucde,c.usuaper,c.codper as codpers,g.apepper as appgo,g.apemper as ampgo,g.pnomper as pnpgo,g.snomper as snpgo,g.codper as codiprpg,i.apepper as aprc,i.apemper as amrc,i.pnomper as pnrc,i.snomper as snrc,i.codper as codperre,a.nroctzoc,e.codigomon,e.nombremon,e.simbmone,a.imptimpoc,a.ptjimptoc,a.totimpoc,a.estoc');
        $this->db->from('tbordencompra a');
        $this->db->join('tbproveedor b', 'a.codprvoc=b.codprove','left');
        $this->db->join('tbpersonal c', 'a.codcntoc=c.codper','left');
    //$this->db->join('tbcondicionpago d', 'a.condipgoc=d.codcondpg','left outer'); d.nomcondpg,
        $this->db->join('tbmoneda e', 'a.codmdoc=e.codigomon','left');
        $this->db->join('tbcn f', 'a.sucpgpoc=f.codcn','left');
        $this->db->join('vtpersonal g', 'a.codpgpoc=g.codper','left');//
        $this->db->join('vtcn0 h', 'a.sucrcpoc=h.codcn','left');
        $this->db->join('vtpersonal1 i', 'a.codrcpoc=i.codper','left');
        $this->db->where('a.codoc', $codoc);
        $this->db->where('a.estrgoc', 'A');
        $consulta = $this->db->get();

        return $consulta->row();
    }
    function imprime_orden_compra_det($codoc){
        $this->db->select('a.codocd,a.flgsvrprd,a.codsvrprdocd,a.titsvrprdocd,a.fetsvrprdgocd,a.ctdsvrprdocd,a.pusvrprdocd,a.impsvrprdocd,b.simbmone,c.codunimed,c.nomunimed,c.simbunimed');
        $this->db->from('tbordencompradetalle a');
        $this->db->join('tbmoneda b', 'a.codmonocd=b.codigomon');
        $this->db->join('tbunidadmedidad c', 'a.unimedocd=c.codunimed');
        //
        $this->db->where('a.cdgoocd', $codoc);
        $this->db->where('a.estrgocd', 'A');
        $this->db->order_by('a.codocd', 'asc');
        $consulta = $this->db->get();
        return $consulta->result_array();

    }
    function lista_cntcstodstoc($codoc){    
        $this->db->select('a.coddtcs,b.codccos,b.nomccos,b.sigccos,b.codiccos');
        $this->db->from('tbocdestribucioncosto a');
        $this->db->join('tbcentrocosto b', 'a.cdgccdtcs=b.codccos');
        $this->db->where('a.cdgocdtcs', $codoc);
        $this->db->where('a.estrgdtcs', 'A');
        $this->db->order_by('a.coddtcs', 'desc');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    function lista_ctacteprove($codoc){       
        $this->db->select('a.codprvbn,a.tipctaprvbn,b.NOMTBGRL as nomban,c.nomtbgrl as nomtpcta,d.nombremon,a.nroctacteprvbn,a.nrociprvbn,a.ctadetraprvbn');
        $this->db->from('tbproveedorbancos a');
        $this->db->join('vtbancos b', 'a.codbnprvbn=b.CODITBGRL');
        $this->db->join('vttipoctabanco c', 'a.tipctaprvbn=c.coditbgrl');
        $this->db->join('tbmoneda d', 'a.monctaprvbn=d.codigomon');
        $this->db->where('a.codiprovbn', $codoc);
        $this->db->where('a.estrgprvbn', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    function exportar_excel_oc($lic) {
        $previ= $this->session->userdata('prevper');
    $codiper=$this->session->userdata('codiper');//codoc
    $this->db->select('a.codoc,a.nroseroc,a.codigoc,a.periooc,a.fechaoc,a.tipdocuoc,c.rucprove,c.rasprove,a.nroctzoc,d.codper as codpers,d.pnomper as pnompers,d.apepper as apeppers,a.condpgoc,e.simbmone,f.pnomper as pnomperr,f.apepper as apepperr,g.nomcn,h.pnomper,h.apepper,i.nomcn,a.fecapxentoc,a.impoc,a.impdscoc,a.ptjimptoc,a.imptimpoc,a.totimpoc,a.imptotaloc,a.estoc,a.obsoc,b.codsvrprdocd,b.titsvrprdocd,b.fetsvrprdgocd,b.ctdsvrprdocd,j.simbunimed,b.pusvrprdocd,k.simbmone,b.impsvrprdocd');
    $this->db->from('tbordencompra a');
    $this->db->join('tbordencompradetalle b', 'a.codoc=b.cdgoocd');
    $this->db->join('tbproveedor c', 'a.codprvoc=c.codprove');
    $this->db->join('tbpersonal d', 'a.codcntoc=d.codper');
    $this->db->join('tbmoneda e', 'a.codmdoc=e.codigomon');
    $this->db->join('tbpersonal f', 'a.codrcpoc=f.codper');
    $this->db->join('tbcn g', 'a.sucrcpoc=g.codcn');
    $this->db->join('tbpersonal h', 'a.codpgpoc=h.codper');
    $this->db->join('tbcn i', 'a.sucpgpoc=i.codcn');
    $this->db->join('tbunidadmedidad j', 'b.unimedocd=j.codunimed');
    $this->db->join('tbmoneda k', 'b.codmonocd=k.codigomon');
    if($lic['frtinf']=='1'){}else{
        $this->db->where('a.fechaoc <=', $lic['fechafin']);
        $this->db->where('a.fechaoc >=', $lic['fechaini']);
    }   

    if($codiper==1 || $codiper==278 || $codiper==29){

    }else{
        $this->db->where('a.usucroc',$codiper);
    }
    $this->db->where('a.estrgoc','A');
    $this->db->order_by('a.codoc', 'desc');
    $consulta = $this->db->get();
    return $consulta->result_array();
}


function centro_costo_oc($codoc) {
  $this->db->select('b.codiccos,b.nomccos');
  $this->db->from('tbocdestribucioncosto a');
  $this->db->join('tbcentrocosto b', 'a.cdgccdtcs=b.codccos');
  $this->db->where('a.cdgocdtcs',$codoc);
  $consulta = $this->db->get();
  return $consulta->result_array();
}

function update_oc_cab($cab_oc){
    $this->db->set('codempoc',$cab_oc['codempoc']); 
    $this->db->set('codprvoc' , $cab_oc['codprvoc']);
    $this->db->set('codmdoc' , $cab_oc['codmdoc']);
    $this->db->set('condpgoc' , $cab_oc['condpgoc']);
    $this->db->set('nroctzoc' , $cab_oc['nroctzoc']);
    $this->db->set('codcntoc' , $cab_oc['codcntoc']);
    $this->db->set('sucrcpoc' , $cab_oc['sucrcpoc']);
    $this->db->set('codrcpoc' , $cab_oc['codrcpoc']);
    $this->db->set('sucpgpoc' , $cab_oc['sucpgpoc']);
    $this->db->set('codpgpoc' , $cab_oc['codpgpoc']);
    $this->db->set('obsoc' , $cab_oc['obsoc']);
    $this->db->set('impoc' , $cab_oc['impoc']);
    $this->db->set('imptimpoc' , $cab_oc['imptimpoc']);
    $this->db->set('totimpoc' , $cab_oc['totimpoc']);
    $this->db->set('impdscoc', $cab_oc['impdscoc']);
    $this->db->set('imptotaloc' , $cab_oc['imptotaloc']);
    $this->db->set('usumdoc', $this->session->userdata('codiper'));
    $this->db->set('fmdoc', gmdate("Y-m-d H:i:s", time() - 18000));
    $this->db->where('codoc', $cab_oc['codioccab']);
    $this->db->where('estrgoc', 'A');
    $this->db->update('tbordencompra');
    $numeroa= $this->db->affected_rows();   
    return  $numeroa;
}
function up_cr_ctocto($dataoccab){
    $selectocst=$dataoccab['selectocst'];
    $codoccab=$dataoccab['codoccab'];
    $selemone=$dataoccab['selemone'];
    $impxctocsto=$dataoccab['impxctocsto'];
    $codctocsto=array();
    
 $this->db->set('estrgdtcs' , 'I');
    $this->db->set('fmddtcs' ,gmdate("Y-m-d H:i:s", time() - 18000));
            $this->db->set('usumddtcs' , $this->session->userdata('codiper'));
    $this->db->where('cdgocdtcs', $codoccab);
    $this->db->where('estrgdtcs', 'A');
     $this->db->update('tbocdestribucioncosto');
    $numeroa= $this->db->affected_rows();
    $resulcst[]=array('accion'=>'anulacion masivo Nrofilas '.$numeroa);
    

    foreach ($selectocst as $dstctocst) {              
        

            $this->db->set('cdgccdtcs' , $dstctocst['codctocst']);
            $this->db->set('cdgocdtcs' , $codoccab);
            $this->db->set('impptjdtcs', $impxctocsto);
            $this->db->set('monedtcs' , $selemone);
            $this->db->set('usucrdtcs' , $this->session->userdata('codiper'));            
            $this->db->insert('tbocdestribucioncosto');
            $resulcst[]= array('codctocto'=>$this->db->insert_id(),'cdgccdtcs'=>$dstctocst['codctocst'],'accion'=>'insert');
        
    }
    return $resulcst;
    
    
}
function update_oc_cabe($dataoccb) {
    if($dataoccb['flg']==0){ 
      return 1; 
  }else{    
    $this->db->set('usumdoc', $this->session->userdata('codiper'));
    $this->db->set('fmdoc', gmdate("Y-m-d H:i:s", time() - 18000));
    $this->db->set('impoc', $dataoccb['impoc']);
    $this->db->set('impdscoc', $dataoccb['impdscoc']); 
    $this->db->set('imptimpoc', $dataoccb['imptimpoc']);
    $this->db->set('totimpoc', $dataoccb['totimpoc']);
    $this->db->set('imptotaloc',$dataoccb['imptotaloc']);
    $this->db->where('codempoc', $dataoccb['codcia']);
    $this->db->where('codoc', $dataoccb['codioccab']);
    $this->db->update('tbordencompra');
    return $this->db->affected_rows();
}

}

function crup_oc_deta($dataocdet){
    if(($dataocdet['cdgoocd']!='')&&($dataocdet['codioccab']!='')){
     $this->db->set('codsvrprdocd', $dataocdet['codsvrprdocd']);
     $this->db->set('flgsvrprd', $dataocdet['flgsvrprd']);
     $this->db->set('titsvrprdocd', trim($dataocdet['titsvrprdocd']));   
     $this->db->set('fetsvrprdgocd', $dataocdet['fetsvrprdgocd']);
     $this->db->set('ctdsvrprdocd', $dataocdet['ctdsvrprdocd']);
     $this->db->set('unimedocd', $dataocdet['unimedocd']);
     $this->db->set('pusvrprdocd', $dataocdet['pusvrprdocd']);
     $this->db->set('impsvrprdocd', $dataocdet['impsvrprdocd']);
     $this->db->set('codmonocd', $dataocdet['codmonocd']); 
     $this->db->set('usumdocd', $this->session->userdata('codiper'));
     $this->db->set('fmdocd', gmdate("Y-m-d H:i:s", time() - 18000));
     $this->db->where('estrgocd', 'A');
     $this->db->where('cdgoocd', $dataocdet['codioccab']);
     $this->db->where('codocd', $dataocdet['cdgoocd']);
     $this->db->update('tbordencompradetalle');
     return $this->db->affected_rows();
 }else{
    $this->db->set('cdgoocd', $dataocdet['codioccab']);
    $this->db->set('codsvrprdocd', $dataocdet['codsvrprdocd']);
    $this->db->set('flgsvrprd', $dataocdet['flgsvrprd']);
    $this->db->set('titsvrprdocd', trim($dataocdet['titsvrprdocd']));   
    $this->db->set('fetsvrprdgocd', $dataocdet['fetsvrprdgocd']);
    $this->db->set('ctdsvrprdocd', $dataocdet['ctdsvrprdocd']);
    $this->db->set('unimedocd', $dataocdet['unimedocd']);
    $this->db->set('pusvrprdocd', $dataocdet['pusvrprdocd']);
    $this->db->set('impsvrprdocd', $dataocdet['impsvrprdocd']); 
    $this->db->set('codmonocd', $dataocdet['codmonocd']); 
    $this->db->set('usucrocd', $this->session->userdata('codiper'));
    $this->db->set('fcrocd', gmdate("Y-m-d H:i:s", time() - 18000)); 
    $this->db->insert('tbordencompradetalle');
    return $this->db->insert_id();
}
}

function anula_oc_deta($dataocdet){

 $this->db->set('estrgocd', 'I'); 
 $this->db->set('usumdocd', $this->session->userdata('codiper'));
 $this->db->set('fmdocd', gmdate("Y-m-d H:i:s", time() - 18000));
 $this->db->where('estrgocd', 'A');
 $this->db->where('cdgoocd', $dataocdet['codioccab']);
 $this->db->where('codocd', $dataocdet['cdgoocd']);
 $this->db->update('tbordencompradetalle');
 return $this->db->affected_rows();

}
function get_copy_oc_cab($codoc){
    $this->db->select('codempoc,tipoc,tipdocuoc,codprvoc,codautoc,nroctzoc,codcntoc,condipgoc,condpgoc,codmdoc,codrcpoc,sucrcpoc,codpgpoc,sucpgpoc,impoc,dstprtjoc,impdscoc,ptjimptoc,afecimpoc,imptimpoc,totimpoc,imptotaloc,estoc,obsoc');
  $this->db->from('tbordencompra');
  $this->db->where('codoc',$codoc);
  $this->db->where('estrgoc','A');
  $consulta = $this->db->get();
  return $consulta->row();
}
function get_copy_oc_deta($codoc){
  $this->db->select('flgsvrprd as medioserv,codsvrprdocd as txtnrocodprod,titsvrprdocd as txtdsccort,fetsvrprdgocd as txtfentreg,
  ctdsvrprdocd as txtcntad,codmonocd as codmdoc,impsvrprdocd as importe,pusvrprdocd as txtpreuni,unimedocd as seleunimed');
  $this->db->from('tbordencompradetalle');
  $this->db->where('cdgoocd',$codoc);
  $this->db->where('estrgocd','A');
  $consulta = $this->db->get();
  return $consulta->result_array();  
}


function get_copy_ctocsto_oc($codoc){
     $this->db->select('cdgccdtcs as codctocst');
  $this->db->from('tbocdestribucioncosto');
  $this->db->where('cdgocdtcs',$codoc);
   $this->db->where('estrgdtcs','A');
  $consulta = $this->db->get();
  return $consulta->result_array();
}
function get_cpy_centro_costo_oc($codoc) {
  $this->db->select('b.codiccos,b.nomccos');
  $this->db->from('tbocdestribucioncosto a');
  $this->db->join('tbcentrocosto b', 'a.cdgccdtcs=b.codccos');
  $this->db->where('a.cdgocdtcs',$codoc);
  $consulta = $this->db->get();
  return $consulta->result_array();
}


}
?>
