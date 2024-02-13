// Configuracion de lenguaje de Datatables
function lan_datatable() {
    return {
        //info: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros'
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        search: "Buscar",
        paginate: {
            first: "Primero",
            last: "Ultimo",
            next: "Siguiente",
            previous: "Anterior",
        },
        lengthMenu:
            "Mostrar <select>" +
            '<option value="10">10</option>' +
            '<option value="30">30</option>' +
            '<option value="50">50</option>' +
            '<option value="100">100</option>' +
            '<option value="-1">TODOS</option>' +
            "</select> registros",
        loadingRecords: "Cargando...",
        processing:
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Procesando...",
        emptyTable: "No hay datos para mostrar",
        zeroRecords: "No hay coincidencias",
        infoEmpty: "" /* Info Izquierda*/,
        infoFiltered: "" /*Info Derecha*/,
        iDisplayLength: 10,
    };
}

// Ejecutar el listado con DataTables
function lst_datatable(
    idTable,
    url,
    data,
    btn,
    parametros,
    orders = [1],
    search = true
) {
    var t = $("#" + idTable).DataTable({
        language: lan_datatable(),
        processing: true,
        searching: search,
        serverSide: true,
        ajax: {
            url: url,
            data: parametros,
        },
        columns: data,

        responsive: true,
        autoWidth: false,
        dom:
            "<'row'<'col-lg-4 col-md-4 col-sm-6'l><'col-lg-4 col-md-4 col-sm-6'B><'col-lg-4 col-md-4 col-sm-12'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        buttons: btn,

        columnDefs: [
            {
                searchable: false,
                targets: orders,
                orderable: false,
            },
        ],
    });
}

// Mostrar Mensajes de error
function error_status(status) {
    let msj = "";
    switch (status) {
        case 401:
            msj = "Su sessión ha finalizado, por favor recargue la página.";
            break;
        case 403:
            msj = "Estimado usuario Ud. no tiene permisos para esta acción.";
            break;
        case 404:
            msj =
                "No se a encontrado la página, consulta con el Administrador del sistema.";
            break;
        case 405:
            msj =
                "Método no encontrado, consulte con el Administrador del sistema.";
            break;
        case 419:
            msj =
                "El tiempo de conexión ha expirado, por seguridad recargue la página.";
            break;
        case 500:
            msj = "Error interno, consulte con el Administrador del sistema.";
            break;
        default:
            msj =
                "Excepción no identificada, por favor comuníquese con el Administrador del sistema."; // No es necesario
            break;
    }
    return msj;
}

//Eliminar registros de la base de datos
function delete_confirm(url, text, btn, idTabla, dataview = 0) {
    Swal.fire({
        title: "Está seguro?",
        text: `${text}`,
        icon: "question",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: `Sí, ${btn}!`,
        showLoaderOnConfirm: true,
        confirmButtonColor: colorTemaBtn /*'#3085d6'*/,
        cancelButtonColor: "#d33",
        preConfirm: (login) => {
            return fetch(`${url}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(response.status);
                    }
                    return response.json();
                })
                .catch((error) => {
                    const cod_status = parseInt(`${error}`.substr(7, 3));
                    Swal.showValidationMessage(error_status(cod_status));
                });
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: result.value.success ? "success" : "info",
                title: result.value.success ? "Exito!" : "Error!",
                html: `${result.value.mensaje}`,
                confirmButtonText: "Ok!",
                confirmButtonColor: colorTemaBtn,
            });
            if (result.value.success) {
                if (dataview === 0) {
                    // Verificar que el listado no es un DATATABLE
                    $("#" + idTabla)
                        .DataTable()
                        .ajax.reload();
                } else {
                    if (dataview == 1) {
                        $("#" + idTabla).remove();
                    } else {
                        $("#" + idTabla).click();
                    }
                }
            }
        }
    });
}

// ABRIR MODAL
function modal_form(url, size = "") {
    if (size != "-super") {
        $(".reinicia-modal").html("");
    }

    $("#title-modal-static" + size).text("Procesando...");
    $("#content-modal-static" + size).html($("#loading").html());
    $("#modal-static" + size).modal("show");

    $.ajax({
        url: url,
    })
        .done(function (data) {
            $("#title-modal-static" + size).text(data.title);
            $("#content-modal-static" + size).html(data.view);
        })
        .fail(function (e) {
            $("#msj-error-peticion").html(
                `<i class='fa fa-exclamation-triangle'></i> ${error_status(
                    e.status
                )}`
            );
            $("#content-modal-static" + size).html(
                $("#content-error-peticion").html()
            );
        });
}
// FIN AGREGAR, MODIFICAR REGISTROS EN LA BASE DE DATOS

// FORMULARIO CON METODO POST Y GET (INSERTAR, ACTUALIZAR EN MODAL)
$(document).on("submit", ".formentrada", function (e) {
    e.preventDefault();
    let form = $(this);
    let load = "#loading-" + form.attr("id");
    $(load).css("display", "inline-block");

    /* Bloquea pantalla */
    $("#loading-eab").css("display", "block");

    $.ajax({
        type: form.attr("method"),
        url: form.attr("action"),
        cache: false,
        dataType: "json",
        data: form.serialize(),
        success: function (data) {
            $(load).css("display", "none");
            if (data.success) {
                if (data.edit === undefined) {
                    form.trigger("reset");
                }
                if (data.dataview === undefined) {
                    // Verificar que el listado no es un DATATABLE
                    $("#" + data.datatable)
                        .DataTable()
                        .ajax.reload();
                } else {
                    // si dataview es vacio significa que no debe realizar ningun listado
                    if (data.dataview !== "") {
                        $("#" + data.dataview).click();
                    }
                }
                Swal.fire({
                    icon: "success",
                    title: "Exito!",
                    html: `${data.view}`,
                    confirmButtonText: "Ok!",
                    confirmButtonColor: colorTemaBtn,
                });
                $(`#${form.attr("id")} #close_modal`).click();
            } else {
                Swal.fire({
                    html: `${data.view}`,
                    confirmButtonText: "Ok!",
                    confirmButtonColor: colorTemaBtn,
                });
            }

            /* Desbloquea pantalla */
            $("#loading-eab").css("display", "none");
        },
        error: function (e) {
            $(load).css("display", "none");
            Swal.fire({
                icon: "error",
                text: `${error_status(e.status)}`,
                confirmButtonText: "Ok!",
                confirmButtonColor: colorTemaBtn,
            });
            /* Desbloquea pantalla */
            $("#loading-eab").css("display", "none");
        },
    });
});

//FORMULARIO PARA REGISTRO QUE INCLUYA ENVIO DE ARCHIVOS
$(document).on("submit", ".formfiles", function (e) {
    e.preventDefault();
    let form = $(this);
    let load = "#loading-" + form.attr("id");
    $(load).css("display", "inline-block");

    /* Bloquea pantalla */
    $("#loading-eab").css("display", "block");

    var dataFile = new FormData($("#" + form.attr("id"))[0]);
    $.ajax({
        type: form.attr("method"),
        url: form.attr("action"),
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        data: dataFile,
        success: function (data) {
            $(load).css("display", "none");
            if (data.success) {
                if (data.edit === undefined) {
                    form.trigger("reset");
                }
                if (data.dataview === undefined) {
                    // Verificar que el listado no es un DATATABLE
                    $("#" + data.datatable)
                        .DataTable()
                        .ajax.reload();
                } else {
                    // si dataview es vacio significa que no debe realizar ningun listado
                    if (data.dataview !== "") {
                        $("#" + data.dataview).click();
                    }
                }

                //Imprime cuando sea ventas
                if (data.print !== undefined) {
                    //Cargamos el ticket a imprimir.
                    let frame = $("#frame_impresion");
                    let url = baseUrl + "/pt/" + data.print;
                    frame.attr("src", url);

                    Swal.fire({
                        title: "Éxito!",
                        text: `${data.view}`,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: colorTemaBtn,
                        //no cierra al dar click fuera
                        allowOutsideClick: false,
                        cancelButtonColor: "#d33",
                        cancelButtonText: "Cerrar",
                        confirmButtonText: `<i class='fa fa-print'></i> Imprimir`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document
                                .getElementById("frame_impresion")
                                .contentWindow.print();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Exito!",
                        html: `${data.view}`,
                        confirmButtonText: "Ok!",
                        confirmButtonColor: colorTemaBtn,
                    });
                }

                $(`#${form.attr("id")} #close_modal`).click();
            } else {
                Swal.fire({
                    html: `${data.view}`,
                    confirmButtonText: "Ok!",
                    confirmButtonColor: colorTemaBtn,
                });
            }
            /* Desbloquea pantalla */
            $("#loading-eab").css("display", "none");
        },
        error: function (e) {
            $(load).css("display", "none");
            Swal.fire({
                icon: "error",
                text: `${error_status(e.status)}`,
                confirmButtonText: "Ok!",
                confirmButtonColor: colorTemaBtn,
            });
            /* Desbloquea pantalla */
            $("#loading-eab").css("display", "none");
        },
    });
});

// METODO AJAX PARA BUSQUEDA DE REGISTROS
$(document).on("submit", ".formsearch", function (e) {
    e.preventDefault();
    let form = $(this);
    let content = "#search-" + form.attr("id");
    $(content).html($("#loading").html());

    $.ajax({
        type: form.attr("method"),
        url: form.attr("action"),
        cache: false,
        dataType: "json",
        data: form.serialize(),
        success: function (data) {
            $(content).html(data);
        },
        error: function (e) {
            $(content).html(`${error_status(e.status)}`);
        },
    });
});

//LISTADO AJAX NORAL (2eab)
function dataview(url, id, parametros = { method: "GET" }) {
    $("#" + id).html($("#loading").html());

    $.ajax({
        url: url,
        data: parametros,
    })
        .done(function (data) {
            $("#" + id).html(data.view);
        })
        .fail(function (e) {
            $("#" + id).html(
                `<i class='fa fa-exclamation-triangle'></i> ${error_status(
                    e.status
                )}`
            );
        });
}

// CARGA DATOS EN COMBO
function getSelectedData(id, url, ubigeo, valida = 0, texto = "SELECCIONE") {
    $("#" + id + "_load").html($("#loading_2").html());
    $.ajax({
        type: "GET",
        url: url + "/" + ubigeo,
        dataType: "json",
        success: function (data) {
            //Valida que no cargue la opcion SELECCIONE
            var html = "";
            if (valida === 0) {
                html = "<option value='0'>[ " + texto + " ]</option>";
            }

            for (items in data) {
                html +=
                    '<option value="' +
                    data[items].id +
                    '">' +
                    data[items].campoValor +
                    "</option>";
            }
            $("#cb_" + id).html(html);
            $("#" + id + "_load").html("");
        },
        error: function (e) {
            $("#" + id + "_load").html("");
            Swal.fire({
                icon: "error",
                text: `${error_status(e.status)}`,
                confirmButtonText: "Ok!",
                confirmButtonColor: colorTemaBtn,
            });
        },
    });
}
// FIN CARGA DATOS EN COMBO

function focus_input(id) {
    $("#" + id).select();
}

//BUSQUEDA EN EL MISMO INPUT-FORM
function search_data_json(value, url, idData, idFiltro, valorAdicional = 0) {
    if (value === "") {
        $("#" + idData).css("display", "none");
        $("#" + idData).html("");
        return;
    }
    $("#" + idData).css("display", "block");
    $("#" + idData).html($("#loading").html());
    $.ajax({
        url: url,
        data: {
            cb_filtro: $("#cb_" + idFiltro).val(),
            data: value,
            valorAdicional: valorAdicional,
        },
    })
        .done(function (data) {
            $("#" + idData).html(data.view);
        })
        .fail(function (e) {
            $("#" + idData).html(
                `<i class='fa fa-exclamation-triangle'></i> ${error_status(
                    e.status
                )}`
            );
        });
}

/*Mostrar Alerta informativa
let nIntervId;
nIntervId = setInterval(alert_informativo, minutosAlerta);

function alert_informativo(){
    $.ajax({
        url: baseUrl +'/UrlAlerta - test',
        }).done(function (data)
        {
            if( data > 0){
                Swal.fire({
                    text: 'Alerta Informativa',
                    target: '#custom-target',
                    customClass: {
                      container: 'alert-global'
                    },
                    toast: true,
                    position: 'bottom-right'
                  })
            }
        })    
}
*/
