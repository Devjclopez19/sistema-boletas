$(document).ready(function(){
    $('#tabla-usuarios').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Ãšltimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "autoWidth": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'views/ajax/ajaxUserData.php'
        },
        'columns': [            
            { data: 'full_name' },
            { data: 'dni' },
            { data: 'tipo_boleta' },
            { data: 'email' },
            { data: 'celular' },
            {   
                "render": function (data, type, full, meta)
                    {   if(full.estado == 2){
                            return '<button type="button" class="btn-table btn-wait" onclick="mru.activarUsuario(this,'+full.id_usuario+')"><i class="icofont icofont-ui-clock"></i></button><button type="button" class="btn-table btn-active d-none"><i class="icofont icofont-ui-check"></i></button><button type="button" class="btn-table" onclick="mru.editarUsuario('+full.id_usuario+')"><i class="icofont icofont-ui-edit"></i></button><button class="btn-table btn-del" onclick="mru.eliminarUsuario('+full.id_usuario+')"><i class="icofont icofont-ui-delete"></i></button>'
                        }else {
                            return '<button type="button" class="btn-table btn-active"><i class="icofont icofont-ui-check"></i></button><button type="button" class="btn-table" onclick="mru.editarUsuario('+full.id_usuario+')"><i class="icofont icofont-ui-edit"></i></button><button class="btn-table btn-del" onclick="mru.eliminarUsuario('+full.id_usuario+')"><i class="icofont icofont-ui-delete"></i></button>';
                        } 
                    }
            },
            { data: 'fecha_registro' },
            { data: 'fecha_acceso' },
        ]
    });
    $('#tabla-boletas').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "",
            "sZeroRecords":    "",
            "sEmptyTable":     "",
            "sInfo":           "",
            "sInfoEmpty":      "",
            "sInfoFiltered":   "",
            "sInfoPostFix":    "",
            "sSearch":         "",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "autoWidth": false,
        "iDisplayLength":20,
        "searching": false,
        "bPaginate":false,
    });
    $('#tabla-cboletas').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "",
            "sZeroRecords":    "",
            "sEmptyTable":     "",
            "sInfo":           "",
            "sInfoEmpty":      "",
            "sInfoFiltered":   "",
            "sInfoPostFix":    "",
            "sSearch":         "",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Ãšltimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "autoWidth": false,
        "autoHeigth": false,
        'processing': true,
        "iDisplayLength":20,
        "searching": false
    });
});

