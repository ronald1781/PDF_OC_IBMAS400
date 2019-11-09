<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ordencompra_db2_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
 function index(){

 }
 public function get_cia($codcia) {   
    include("application/config/conexdb_db2.php");
       $sql = "select u.EUCODELE,u.EUDSCABR,u.EUDSCLAR,u.EUJOB from LIBPRDDAT.MMEUREL0 u WHERE u.EUCODTBL='01' AND u.EUCODELE='".$codcia."' and u.EUSTS='A'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_ruccia($codclicia) {   
    include("application/config/conexdb_db2.php");
       $sql = "select (CASE WHEN a.AKTIPIDE='02' THEN (select b.IFNVORUC from LIBPRDDAT.MMIFREP b WHERE b.IFCODCLI=a.AKCODCLI) ELSE a.AKNROIDE END) AS NROIDE from LIBPRDDAT.MMAKREP a where a.AKCODCLI='".$codclicia."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_direcia($codclicia) {   
    include("application/config/conexdb_db2.php");
       $sql = "select h.ALTIPDIR,h.ALVIADIR,h.ALDSCDIR,h.ALNRODIR,h.ALDEPART,h.ALPROVIN,h.ALDISTRI from libprddat.mmalrel1 h where h.ALCODCLI='".$codclicia."' and h.ALITEM01='1'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}

public function get_nom_persvend($codcia,$codper) {   
    include("application/config/conexdb_db2.php");
       $sql = "select b.BMPRNOMB,b.BMSGNOMB,b.BMPRAPLL,b.BMSGAPLL from libprddat.MMBMREP b where b.BMCODCIA='".$codcia."' and b.BMCODPER='".$codper."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_datosadi_persvend($codper) {   
    include("application/config/conexdb_db2.php");
       $sql = "select c.NKTELDIR,c.NKTELNEX,c.NKTELRPM,c.NKTELANE,c.NKTELPE1,c.NKTELPE2,c.NKCORREO from libprddat.mmnkrel0 c where c.NKCODPER='".$codper."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_direpago_prov($codcliemp) {   
    include("application/config/conexdb_db2.php");
       $sql = "select d.ALTIPDIR,d.ALVIADIR,d.ALDSCDIR,d.ALNRODIR,d.ALDSCZDR,d.ALDEPART,d.ALPROVIN,d.ALDISTRI from libprddat.mmalrel1 d where d.ALCODCLI='".$codcliemp."' and d.ALITEM01='1'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
//
public function get_perpago_prov($codclie) {   
    include("application/config/conexdb_db2.php");
       $sql = "select e.PGPRNOMB,e.PGPRAPLL,e.PGSGAPLL from libprddat.mmpgrel0 e where e.PGCODCLI='".$codclie."' and e.PGITEM01='1'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
 // +---------------------------------------------------------------------------+    
// | Generar orden de compra
// +---------------------------------------------------------------------------+        
public function get_orden_compra_cab($codcia,$nrosol) {   
    include("application/config/conexdb_db2.php");
       $sql = "select b.F3NROSOL,b.F3FECING,b.F3CODVEN,b.F3CODPRV,b.F3CODCLI FROM LIBPRDDAT.MMF3REL0 b where b.F3CODCIA='".$codcia."' AND b.F3NROSOL=".$nrosol." and F3STS='A'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_datosadi_oc($codcia,$nrosol,$nrosec) {   
    include("application/config/conexdb_db2.php");
       $sql = "select f.F7NROINT,f.F7CODMON,f.F7OBSER1,f.F7MNTPR,f.F7MNIGV,f.F7MTIGV from libprddat.mmf7rel0 f where f.F7CODCIA='".$codcia."' and f.F7NROSEC='".$nrosec."' and f.F7NROSOL=".$nrosol;
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_moneda_oc($codmon) {   
    include("application/config/conexdb_db2.php");
       $sql = "select g.EUDSCABR,g.EUDSCCOR from libprddat.mmeurel0 g where g.EUCODTBL='35' and g.EUCODELE='".$codmon."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_direc_dist_oc($codclie) {   
    include("application/config/conexdb_db2.php");
       $sql = "select h.ALTIPDIR,h.ALVIADIR,h.ALDSCDIR,h.ALNRODIR,h.ALDEPART,h.ALPROVIN,h.ALDISTRI from libprddat.mmalrel1 h where h.ALCODCLI='".$codclie."' and h.ALITEM01='11'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_persresp_recep_oc($codclie) {   
    include("application/config/conexdb_db2.php");
       $sql = "select i.PGPRNOMB,i.PGSGNOMB,i.PGPRAPLL,i.PGSGAPLL,i.PGCORREO,i.PGTELEF1 from libprddat.mmpgrel0 i where i.PGCODCLI='".$codclie."' and i.PGITEM01='11'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_nomprov_oc($codprov) {   
    include("application/config/conexdb_db2.php");
       $sql = "select j.AHRAZSOC from libprddat.mmahrel0 j where j.AHCODPRV='".$codprov."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_rucprov_oc($codprov) {   
    include("application/config/conexdb_db2.php");
       $sql = "select k.IPNVORUC from libprddat.mmiprel0 k where k.IPCODCLI='".$codprov."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_direprov_oc($codprov) {   
    include("application/config/conexdb_db2.php");
       $sql = "select l.CGTIPDIR,l.CGVIADIR,l.CGDSCDIR,l.CGNRODIR,l.CGDEPART,l.CGPROVIN,l.CGDISTRI from libprddat.mmcgrel1 l where l.CGCODPRV='".$codprov."' and l.CGITEM01='01'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_distprov_oc($coddep,$codprv,$coddst) {   
    include("application/config/conexdb_db2.php");
       $sql = "select m.BJDSCCOR,m.BJDSCLAR from libprddat.mmbjrel0 m where m.BJDEPART='".$coddep."' and m.BJPROVIN='".$codprv."' and m.BJDISTRI='".$coddst."' ";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_telfprov_oc($codprov) {   
    include("application/config/conexdb_db2.php");
       $sql = "select n.CGNROTL1,n.CGNROTL2 from libprddat.mmcgrel1 n where n.CGCODPRV='".$codprov."' and n.CGITEM01='01'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_contaprov_oc($codprov) {   
    include("application/config/conexdb_db2.php");
       $sql = "select o.IBPRNOMB,o.IBSGNOMB,o.IBPRAPLL,o.IBSGAPLL from libprddat.mmibrel0 o where o.IBCODPRV='".$codprov."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_igv_oc() {   
    include("application/config/conexdb_db2.php");
       $sql = "select p.BKCODIMP from libprddat.mmBKrel0 p where p.BKCNDTRB='01'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_valigv_oc($igv) {   
    include("application/config/conexdb_db2.php");
       $sql = "select q.BLPRCIMP from libprddat.mmBlrel0 q where q.BLCODIMP='".$igv."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_detalle_oc($codcia,$nrosol,$nrosec) {   
    include("application/config/conexdb_db2.php");
       $sql = "select r.F8NROSEX,r.F8CODPAR,r.F8CODREP,r.F8CODPRO,r.F8CANTID,r.F8PPRECI,r.F8PMNTMM  from libprddat.MMF8REL0 r where r.F8CODCIA='".$codcia."' and r.F8NROSOL=".$nrosol." and r.F8NROSEC='".$nrosec."'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}
public function get_detnomprd_oc($codcia,$F8CODPAR,$F8CODREP,$F8CODPRO) {   
    include("application/config/conexdb_db2.php");
       $sql = "select s.G9DESCRIC from libprddat.mmg9rel0 s where s.G9CODCIA='".$codcia."' and s.G9NROREP='".$F8CODREP."' and s.G9NROPRO='".$F8CODPRO."' and s.G9PARTSS='".$F8CODPAR."' and s.G9TIPOCA='PA'";
        $dato = odbc_exec($dbconect, $sql)or die("<p>" . odbc_errormsg());
		if (!$dato) {
			$data = FALSE;
		} else {            
			$data = $dato;  
		}        
		return $data;
}


}
?>