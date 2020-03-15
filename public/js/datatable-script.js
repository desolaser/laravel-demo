$(function () {
    var pathname = window.location.pathname;
    pathname = pathname.substring(1);
    if (pathname == "") {
        pathname = "dashboard-data";
    }

    if (pathname == "precios") {
        var buttons_options = [
            {
                extend: 'excel',
                title: pathname,
                className: 'btn btn-primary excelButton'
            }
        ];
    } else {
        var buttons_options = [
            {
                extend: 'excel',
                title: pathname,
                exportOptions: {
                    columns: 'th:not(:last-child)'
                },
                className: 'btn btn-primary excelButton'
            }
        ];
    }
    
    var oTable = $('#tablas').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'dom': 'lfrtipB',
        'buttons': buttons_options,
        'language': {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });    

    $("#datepicker_from").datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: "button",
        buttonImageOnly: false,
        "onSelect": function(date) {
            minDateFilter = new Date(date).getTime();
            oTable.draw();
        }
    }).keyup(function() {
        minDateFilter = new Date(this.value).getTime();
        oTable.draw();
    });

    $("#datepicker_to").datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: "button",
        buttonImageOnly: false,
        "onSelect": function(date) {
            maxDateFilter = new Date(date).getTime();
            oTable.draw();
        }
    }).keyup(function() {
        maxDateFilter = new Date(this.value).getTime();
        oTable.draw();
    });

    // Date range filter
    minDateFilter = "";
    maxDateFilter = "";

    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
            if (typeof aData._date == 'undefined') {
                var pathname = window.location.pathname;
                if (pathname == '/cotizaciones') {
                    aData._date = new Date(aData[4]).getTime();
                } else {
                    aData._date = new Date(aData[2]).getTime();
                }
            }

            if (minDateFilter && !isNaN(minDateFilter)) {
                if (aData._date < minDateFilter) {
                return false;
                }
            }

            if (maxDateFilter && !isNaN(maxDateFilter)) {
                if (aData._date > maxDateFilter) {
                return false;
                }
            }

            return true;
        }
    );
});