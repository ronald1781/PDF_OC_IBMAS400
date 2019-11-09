function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

var config = {
        '.chosen-select': {},
        '.chosen-select-no-results': { no_results_text: 'nothing found!' }
    }

function openModal(dato) {
    dato = dato.split("##");
    codasi = dato[0];
    codasid = dato[1];
    codhard = dato[2];
    codigohard = dato[3];
    codper = dato[4];
    codthard = dato[5];
    codanx = dato[6];
    coddir = dato[7];
    $("#txtcodasimodal").val(codasi);
    $("#txtcodasidmodal").val(codasid);
    $("#txtcodhardmodal").val(codhard);
    $("#txtcodigohardModal").val(codigohard);
    $("#txtcodthardModal").val(codthard);
    $("#txtcodiperModal").val(codper);
    $("#txtcodanxModal").val(codanx);
    $("#txtcoddirModal").val(coddir);
    $("#myModal1").modal('show');

}

function openModaledit(dato) {
    dato = dato.split("##");
    codasid = dato[0];
    codihard = dato[1];
    codasi = dato[2];
    codhard = dato[3];
    iphard = dato[4];
    anextel = dato[5];
    codmtv = dato[6];
    nommtv = dato[7];
    fchmtv = dato[8];
    equipo = dato[9];
    codanx = dato[10];
    nomanx = dato[11];
    coddir = dato[12];
    nomdir = dato[13];
    codthar = dato[14];
    $("#txtcodasimodaled").val(codasi);
    $("#txtcodasidmodaled").val(codasid);
    $("#txtcodhardmodaled").val(codihard);
    $("#txtcodthardmodaled").val(codthar);
    $("#txtchardModaled").val(codhard + ' ' + equipo);
    $("#txtiphrModaled").val(iphard);
    $("#txtanxdmodaled").val(anextel);
    $("#txtcdmtvmodaled").val(codmtv);
    $("#txtnomtvModaled").val(nommtv);
    $("#txtfcmtvModaled").val(fchmtv);
    var optionanx = '';
    var optiondir = '';
    if (codanx == 0 || codanx == '') {
        optionanx = '<option selected value="0">--Sin Numero Anexo --</option> ';
    } else {
        optionanx = '<option selected value="' + codanx + '">' + nomanx + '</option>';
    }
    $('#selanxtlfedModaled').append(optionanx);
    if (coddir == 0 || coddir == '') {
        optiondir = '<option selected value="0">--Sin Numero Directo --</option>';
    } else {
        optiondir = '<option selected value="' + coddir + '">' + nomdir + '</option>';
    }
    $('#selnrodirtlfedModaled').append(optiondir);
    if (codthar != 5) {
        $(".editnumtlf").hide();
    } else {
        $(".editnumtlf").show();
    }
    $("#myModaledit").modal('show');

}

function openModaldevo(datadevo) {
    var data = datadevo.split("##");
    codeasi = data[0];
    numasi = data[1];
    codper = data[2];
    $("#txtcodasidvModal").val(codeasi);
    $("#txtcodnumasidvModal").val(numasi);
    $("#txtcodperModal").val(codper);
    $("#myModalDevo").modal('show');
}

function openModalDelePieza(deletpieza) {
    var dato = deletpieza.split("##");
    codihardp = dato[0];
    codidhard = dato[1];
    codiprop = dato[2];

    $("#textcodihar").val(codihardp);
    $("#textcoddhar").val(codidhard);
    $("#textcodipro").val(codiprop);

    $("#myModalDevP").modal('show');

}
function openModalDelpro(delepro) {
    var dato = delepro.split("##");
    codiped = dato[0];
    codidped = dato[1];
    codipro = dato[2];
    nompro = dato[3];
    $("#textcodpedi").val(codiped);
    $("#textcoddpedi").val(codidped);
    $("#textcodipro").val(codipro);
    $("#textnompro").val(nompro);
    $("#myModalDelP").modal('show');

}
function openModalAnulpro(delepro) {
    var dato = delepro.split("##");
    codiped = dato[0];
    codidped = dato[1];
    codipro = dato[2];
    nompro = dato[3];
    codmarpro = dato[4];
    codcatpro = dato[5];
    $("#textcodpedi").val(codiped);
    $("#textcoddpedi").val(codidped);
    $("#textcodipro").val(codipro);
    $("#textnompro").val(nompro);
    $("#textcodmarpro").val(codmarpro);
    $("#textcodcatepro").val(codcatpro);
    $("#myModalAnulP").modal('show');

}
function openModalCanactsrv(deleactsrv) {

    var dato = deleactsrv.split("##");
    mdcodisrv = dato[0];
    mdcodidsrv = dato[1];
    mdnomact = dato[2];
    $("#textmdcodsrv").val(mdcodisrv);
    $("#textmdcoddsrv").val(mdcodidsrv);
    $("#textmdnomact").val(mdnomact);
    $("#myModalcanserv").modal('show');

}
function openModalEjeMant(datadevo) {

    var data = datadevo.split("##");
    codipln = data[0];
    codiplndt = data[1];
    $("#textcodplnm").val(codipln);
    $("#textcodplnmdt").val(codiplndt);
    $("#myModalEjeMant").modal('show');
}
function openModalanuserdet(dato) {
    dato = dato.split("##");
    codasiserd = dato[0];
    codasiser = dato[1];
    nomtserv = dato[2];
    nomser = dato[3];
    $("#txtcodservdetmodal").val(codasiserd);
    $("#txtcodservmodal").val(codasiser);
    $("#txtnomtserModal").val(nomtserv);
    $("#txtnomserModal").val(nomser);
    $("#myModalanuserdet").modal('show');

}
function openModalvarAnu(datadevo) {
    var data = datadevo.split("##");
    codeasi = data[0];
    numasi = data[1];
    $("#txtcodasidvModal").val(codeasi);
    $("#txtcodnumasidvModal").val(numasi);
    $("#myModalVaranu").modal('show');
}

function openModaltrsf(datadevo) {
    var data = datadevo.split("##");
    codeasi = data[0];
    numasi = data[1];
    codper = data[2];
    $("#txtcodasitrfModal").val(codeasi);
    $("#txtcodnumasitrfModal").val(numasi);
    $("#txtcodpertrfModal").val(codper);
    $("#myModalVaranu").modal('show');
}

function openModaleditact(dato) {
    dato = dato.split("##");
    codtra = dato[0];
    tittra = dato[1];
    pritra = dato[2];
    ffptra = dato[3];
    hrptra = dato[4];
    ffrtra = dato[5];
    hrrtra = dato[6];
    avctra = dato[7];
    esttra = dato[8];
    obstra = dato[9];
    prntra = dato[10];
     stntra = dato[11];
    var optionest = '';
    var optionpri = '';
     $('.modal-title').text('Editar Tarea');
    $("#codtramd").val(codtra);
    $("#areadesctramd").val(tittra);
    if (pritra != '' || pritra != 0) {
        optionpri = '<option selected value="' + pritra + '">' + prntra + '</option>';
    }
    $('#selepriotramd').append(optionpri);
    $("#txtffinplntramd").val(ffptra);
    $("#txthrplantramd").val(hrptra);
    $("#txtffinrltramd").val(ffrtra);
    $("#txthrrltramd").val(hrrtra);
    $("#areaobstramd").val(obstra);
    $("#txthavantramd").val(avctra);
   
    if (esttra != '' || esttra != 0) {
        optionest = '<option selected value="' + esttra + '">' + stntra + '</option>';
    }
    $('#selesttramd').append(optionest);


    $("#myModaleditra").modal('show');

}
function openModalvistact(dato) {
    dato = dato.split("##");
    codtra = dato[0];
    tittra = dato[1];
    pritra = dato[2];
    ffptra = dato[3];
    hrptra = dato[4];
    ffrtra = dato[5];
    hrrtra = dato[6];
    avctra = dato[7];
    esttra = dato[8];
    obstra = dato[9];
    prntra = dato[10];
    stntra = dato[11];
    
     $('.modal-title').text('Vista Tarea');
    $("#codtramdv").val(codtra);
    $("#areadesctramdv").val(tittra);   
    $('#selepriotramdv').val(prntra);
    $("#txtffinplntramdv").val(ffptra);
    $("#txthrplantramdv").val(hrptra);
    $("#txtffinrltramdv").val(ffrtra);
    $("#txthrrltramdv").val(hrrtra);
    $("#areaobstramdv").val(obstra);
    $("#txthavantramdv").val(avctra);   
    $('#selesttramdv').val(stntra);
    $("#myModalvistra").modal('show');

}