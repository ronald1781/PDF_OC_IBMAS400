
function getTipEq(id) {
    //rucsearch=$('#rucsearch').val();

    $.ajax({
        type: 'POST',
        url: 'controllers_ajax/getTipEq',
        data: {id: id},
        dataType: 'json',
        success: function(json) {
//alert("1");
            lista = json.lista;

            str = '<select name="seletequi" required id="seletequi" class="form-control">';
            if (lista != 0) {

                cad = lista.split("&&&");
                num = cad.length;
                for (e = 0; e < num; e++) {
                    dat = cad[e].split("#$#");
                    codtipequi = dat[0];
                    nomtipequi = dat[1];
                    estrgtipequi = dat[2];
                    str += '<option value="' + codtipequi + '">' + nomtipequi + '</option>';
                }

            } else {
                str += '<option value="0">No hay resultados</option>';
            }

            str += '</select>';

            $('#seletequi').html(str);
        }
    });
}
//OTRA FUNCION



var lst_producto = new Array();
    var tablaListaCompras;
    var cont = 0;
  
    $("#gdarprodu").click(function(e) {
        e.preventDefault();
       // alert("data");
        var miJSON = JSON.stringify(lst_producto);
        $.ajax({
            type: 'POST',
            data: $('#frmprodu').serialize() + '&lst_producto=' + miJSON,
            url: 'producto_control/guardar_producto',
            success: function(msj) {
                if (msj == 'guardo') {
                    $('#msj_ok').modal('show');
                    jQuery.fn.reset = function() {
                        $(this).each(function() {
                            this.reset();
                        });
                    };
                    $("#frmCompra").reset();
                } else {
                    $('#msj_error').modal('show');
                }
            }
        });
    });
    function limpiarproducto() {
        $('#txtNomd').val('');
        $('#txtDescd').val('');
        $('#txtNomd').focus();
    }
    function listarProductos() {
      var producto = {};
        var nomdetapro = $("#txtNomd").val();
        var descdetapro = $("#txtDescd").val();

        if (nomdetapro == '' || descdetapro == '') {
            alert('Ingrese Nombre y descripcion');
            $('#txtNomd').focus();
        } else {
            producto.nomdetapro = nomdetapro;
            producto.descdetapro = descdetapro;

            lst_producto.push(producto);

            $("#lstTabla").show();

            var $tabla = $("#lstTabla");
            $tabla.find("table").remove();

            $tabla.append('<table class="table table-striped dataTable table-condensed table-bordered dataTable-noheader table-has-pover dataTable-nosort" data-nosort="0">' +
                    '<thead><tr><th>Item</th><th>Producto</th><th>Descripcion</th><th>Action</th></tr>' +
                    '</thead></table>');

            var tbody = $('<tbody></tbody>');

            jQuery.each(lst_producto, function(i, value) {
                cont = i + 1;
                tbody.append(
                        '<tr><td style="text-align: center;">' + cont +
                        '</td><td style="text-align: center;">' + value["nomdetapro"] +
                        '</td><td style="text-align: center;">' + value["descdetapro"] +
                        '</td><td class="actions">' +
                        '<div class="btn-group"><a onclick="del_listaProducto(' + i + ');" class="btn btn-mini deleteRow"> Eliminar' +
                        '</a></div></td></tr>'
                        );
            });
            $tabla.find("table").append(tbody);
            limpiarproducto();
        }
    }
    function del_listaProducto(id) {
        jQuery.each(lst_producto, function(i, value) {
            if (i == id) {
                lst_producto.splice(i, 1);
            }

        });

        $("#lstTabla").show();

        var $tabla = $("#lstTabla");
        $tabla.find("table").remove();
        $tabla.append('<table class="table table-striped dataTable table-condensed table-bordered dataTable-noheader table-has-pover dataTable-nosort" data-nosort="0">' +
                '<thead><tr><th>Item</th><th>Producto</th><th>Descripcion</th><th>Action</th></tr>' +
                '</thead></table>');
        var tbody = $('<tbody></tbody>');

        jQuery.each(lst_producto, function(i, value) {
            cont = i + 1;
            tbody.append(
                    '<tr><td style="text-align: center;">' + cont +
                    '</td><td style="text-align: center;">' + value["nomdetapro"] +
                    '</td><td style="text-align: center;">' + value["descdetapro"] +
                    '</td><td class="actions">' +
                    '<div class="btn-group"><a onclick="del_listaProducto(' + i + ');" class="btn btn-mini deleteRow"> Eliminar' +
                    '</a></div></td></tr>'

                    );

        });


        $tabla.find("table").append(tbody);
    }


