const DIAS = ["", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes"]
const HORAS = ["", "8:15- 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:45", "12:45 - 13:45", "13:45 - 14:45"];

function volver() {

    $.ajax({
        url: DIR_SERV + "/logueado",
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        if (data.usuario) {

            $("#respuesta").html("");
        } else if (data.error) {

            cargar_vista_error(data.error);
        } else {

            saltar_a("index.html")
        }

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function obtener_vista_normal(id_usuario, nombre_usuario) {

    $.ajax({
        url: encodeURI(DIR_SERV + "/horario/" + id_usuario),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        if (data.no_auth) {

            saltar_a("index.html");
        } else if (data.horario) {

            let output = "<h2>Horario del profesor: " + nombre_usuario + "</h2>";
            output += "<table >";

            //dias dinamico
            output += "<tr>"
            DIAS.map(dia => output += "<th>" + dia + "</th>")
            output += "</tr>"

            for (let i = 1; i < HORAS.length; i++) {

                output += "<tr>";

                output += "<th>" + HORAS[i] + "</th>";

                if (i == 4) {

                    output += "<td colspan=5>RECREO</td>";
                } else {

                    for (let j = 1; j < DIAS.length; j++) {

                        output += "<td>";
                        let grupos_usuario = [];
                        let grupos_aula;
                        $.each(data.horario, function (key, value) {

                            if (value.dia == j && value.hora == i) {

                                grupos_usuario.push(value.grupo);
                                grupos_aula = value.aula;
                            }
                        });

                        if (grupos_usuario.length > 0) {

                            output += grupos_usuario[0];
                        }

                        if (grupos_usuario.length > 1) {

                            for (let k = 1; k < grupos_usuario.length; k++) {

                                output += " / " + grupos_usuario[k];
                            }
                        }

                        if (grupos_aula != undefined && grupos_aula != "Sin asignar o sin aula") {

                            output += "<br/>(" + grupos_aula + ")";
                        }

                        output += "</td>";
                    }
                }
                output += "</tr>";
            }
            output += "</table>";
            $("#horario").html(output);
        } else {

            cargar_vista_error(data.error);
        }

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function obtener_vista_admin() {

    $.ajax({
        url: encodeURI(DIR_SERV + "/usuarios"),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        if (data.no_auth) {

            saltar_a("index.html");

        } else if (data.usuarios) {

            let output = "<form onsubmit='obtener_horario_admin();event.preventDefault();'>";
            output += "<p>Seleccione el profesor <select name='nombres' id='nombres'>";
            $.each(data.usuarios, function (key, value) {

                output += "<option value='" + value["id_usuario"] + "-" + value["nombre"] + "'>" + value["nombre"] + "</option>";
            });
            output += "</select> <button class='btn btn-dark'>Ver Horario</button></p>";
            output += "</form>";
            $('#vista_admin').html(output);
        }

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function obtener_horario_admin() {

    let id_usuario = $("#nombres").val().split("-")[0];
    let nombre = $("#nombres").val().split("-")[1];

    $.ajax({
        url: encodeURI(DIR_SERV + "/horario/" + id_usuario),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        if (data.no_auth) {

            saltar_a("index.html");
        } else if (data.horario) {

            let output = "<h2>Horario del profesor: " + nombre + "</h2>";
            output += "<table class='table table-dark'>";

            //MIRAR

            //dias dinamico
            output += "<tr>"
            DIAS.map(dia => output += "<th>" + dia + "</th>")
            output += "</tr>"

            //RESTO DEL HORARIO
            for (let i = 1; i < HORAS.length; i++) {

                output += "<tr>";

                output += "<th>" + HORAS[i] + "</th>";

                if (i == 4) {

                    output += "<td colspan=5>RECREO</td>";
                } else {

                    for (let j = 1; j < DIAS.length; j++) {

                        output += "<td>";

                        let grupos_usuario = [];
                        let grupos_id_usuario = [];
                        let grupos_aula;
                        let grupos_id_aula;

                        $.each(data.horario, function (key, value) {

                            if (value.dia == j && value.hora == i) {

                                grupos_usuario.push(value.grupo);
                                grupos_id_usuario.push(value.id_grupo);
                                grupos_aula = value.aula;
                                grupos_id_aula = value.id_aula;
                            }
                        });

                        if (grupos_usuario.length > 0) {

                            output += grupos_usuario[0];

                            for (let k = 1; k < grupos_usuario.length; k++) {

                                output += " / " + grupos_usuario[k];
                            }
                        }

                        if (grupos_aula != undefined && grupos_aula != "Sin asignar o sin aula") {

                            output += "<br/>(" + grupos_aula + ")";
                        }
                        output += `<br/><button class='enlace' onclick='editar_grupos("${j}", "${i}", "${id_usuario}", "${grupos_aula}", "${grupos_id_aula}");event.preventDefault();'>Editar</button>`
                        output += "</td>";
                    }
                }
                output += "</tr>";
            }
            output += "</table>";

            $("#horario").html(output);
            $("#editar_horario").html("");

        } else {

            cargar_vista_error(data.error);
        }

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function editar_grupos(dia, hora, id_usuario, aula, id_aula) {

    $.ajax({
        url: encodeURI(DIR_SERV + "/grupos/" + dia + "/" + hora + "/" + id_usuario),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        //control hora real
        let horaReal = hora;
        if (hora > 4) {

            horaReal--;
        }

        let output = "<h2>Editando la " + horaReal + "º hora (" + HORAS[hora] + ") del " + DIAS[dia] + "</h2>";
        output += "<table class='table table-dark' id='tabla_editando'>";
        output += "<tr><th>Grupo (Aula)</th><th>Acción</th></tr>";
        $.each(data.grupos, function (key, value) {

            output += `<tr><td>${value.grupo} (${aula})</td><td><button class='enlace' onclick='borrar_grupo("${dia}", "${hora}", "${id_usuario}", "${value.id_grupo}", "${aula}", "${id_aula}");event.preventDefault();'>Quitar</button></td></tr>`
        });
        output += "</table>";

        output += `<form onsubmit='add_grupo("${dia}", "${hora}", "${id_usuario}");event.preventDefault();'>`;

        //buscamos en output, cuantas lineas tiene la tabla
        let filas_tabla = output.match(/<tr>/g);

        //ACA
        if (aula == "Sin asignar o sin aula" && filas_tabla.length == 1) {

            output += "<label>Grupo:</label>";
            output += `<select onchange='selecciona_grupo("${dia}", "${hora}")' name='grupos' id='grupos'>`;
            mostrar_grupos(dia, hora, id_usuario);
            output += "</select>";

            output += "<label>Aula:</label><select name='aulas' id='aulas'>";

            //si no tiene aula (aula = undefined) o sin asignar aun
            if (aula == "undefined" || aula == "Sin asignar o sin aula") {

                mostrar_aulas(dia, hora);

                //que no, solo mostramos ESE AULA
            } else {

                output += "<option value='" + id_aula + "-" + aula + "'>" + aula + "</option>";
            }

            output += "</select>";
            output += "<button>Añadir</button>";

        } else if (aula != "Sin asignar o sin aula") {

            output += "<label>Grupo:</label>";
            output += `<select onchange='selecciona_grupo("${dia}", "${hora}", "${id_aula}")' name='grupos' id='grupos'>`;

            //mas de una fila en la tabla implica que tiene grupos con aulas asignados

            //SOLO MOSTRAREMOS GRUPOS
            if (filas_tabla.length > 1) {

                mostrar_grupos(dia, hora, id_usuario, true);

                //QUE NO, GRUPOS Y GUARDIAS
            } else {

                mostrar_grupos(dia, hora, id_usuario, false);
            }
            output += "</select>";

            output += "<label>Aula:</label><select name='aulas' id='aulas'>";

            //CONTROL DE AULAS
            if (aula == "undefined") {

                mostrar_aulas(dia, hora, aula);
            } else {

                output += "<option value='" + id_aula + "-" + aula + "'>" + aula + "</option>";
            }

            output += "</select>";
            output += "<button class='btn btn-dark'>Añadir</button>";

            //CASO GUARDIAS(NO SE ASIGNARA AULA)
        } else {

            output += "<label>Grupo:</label><select disabled></select><label>Aula:</label><select disabled></select><button disabled>Añadir</button>";
        }

        output += "</form><div id='mensaje'></div>";
        $("#editar_horario").html(output);

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function borrar_grupo(dia, hora, id_usuario, id_grupo, aula, id_aula) {

    let fila_tabla = document.getElementById("tabla_editando").rows.length;

    $("select#aulas").html("");
    $.ajax({

        url: encodeURI(DIR_SERV + "/borrarGrupo/" + dia + "/" + hora + "/" + id_usuario + "/" + id_grupo),
        type: "DELETE",
        dataType: "json"

    }).done(function (data) {

        if (aula == "Sin asignar o sin aula") {

            mostrar_aulas(dia, hora);
        } else {

            mostrar_aulas(dia, hora, aula, id_aula, fila_tabla);
        }

        obtener_horario_admin();
        editar_grupos(dia, hora, id_usuario, aula, id_aula);

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function selecciona_grupo(dia, hora, id_aula) {

    let nombreCompletoGrupo = $("#grupos").val().split("-");

    //SI ES GUARDIA
    if (nombreCompletoGrupo[1].startsWith('G') || nombreCompletoGrupo[1].startsWith('F')) {

        $("select#aulas").html("");
        let datos = $("#grupos").val().split("-");

        if (datos[1].match(/^[a-zA-Z]/)) {

            $.ajax({

                url: encodeURI(DIR_SERV + "/aulasLibres/" + dia + "/" + hora),
                type: "GET",
                dataType: "json"

            }).done(function (data) {

                let output = "<optgroup label='Libres'>";
                output += "<option value='64-Sin asignar o sin aula'>Sin asignar o sin aula</option>";
                $("select#aulas").html(output);

            }).fail(function (a, b) {

                cargar_vista_error(error_ajax_jquery(a, b));
            });
        } else {

            mostrar_aulas(dia, hora);
        }
    } else {

        //si la longitud no es 0, tiene almenos un aula asignada ya
        if ($("#tabla_editando").children().children().eq(1).length != 0) {

            //para captar el aula
            let claseEntera = $("#tabla_editando").children().children().eq(1).children().eq(0).html()

            claseEntera = claseEntera.split("(")

            let aula = claseEntera[1].substr(0, claseEntera[1].length - 1)

            let output = "<option value='" + id_aula + "-" + aula + "'>" + aula + "</option>";
            $("select#aulas").html(output);
        } else {

            //que no, mostramos todas las aulas
            mostrar_aulas(dia, hora);
        }
    }
}

function add_grupo(dia, hora, id_usuario) {

    let grupos = $("#grupos").val().split("-");
    let aulas = $("#aulas").val().split("-");

    $.ajax({

        url: encodeURI(DIR_SERV + "/comprobar_al_aniadir/" + dia + "/" + hora + "/" + aulas[0]),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        if (!data.profesor || id_usuario != data.profesor[0].usuario) {
            if (data.ocupada && data.profesor[0].grupo != grupos[0]) {

                let profesores = [];
                let grupos_prof = [];

                let html_code = "<h2 class='centrar'>Confirmación Cambio de Aula del " + DIAS[dia] + " a " + hora + "º Hora</h2>";
                html_code += "<p class='centrar'>Has seleccionado un aula que está usada por el profesor (";

                if (data.profesor.length == 1) {

                    profesores.push(data.profesor.usuario);
                    html_code += data.profesor[0].usuario;
                } else {

                    $.each(data.profesor, function (key, value) {

                        profesores.push(value.usuario) + "-";
                        grupos_prof.push(value.nombre_grupo) + "-";
                    });

                    //COPIAS
                    let copia_array_prof = [... new Set(profesores)];
                    let copia_array_grupo = [... new Set(grupos_prof)];

                    for (const profesor of copia_array_prof) {
                        html_code += profesor + ", ";
                    }

                    html_code += ") en el grupo " + copia_array_grupo[0];

                    for (let i = 1; i < copia_array_grupo.length; i++) {

                        html_code += ", " + copia_array_grupo[i];
                    }

                    html_code += "</p>";

                    html_code += "<p class='centrar'>Para añadir este aula a " + grupos[1] + ", cambiae antes el aula a " + copia_array_grupo[0] + ", ";

                    for (let i = 1; i < copia_array_grupo.length; i++) {

                        html_code += ", " + copia_array_grupo[i];
                    }

                    html_code += "</p>";
                }

                html_code += `<p class='centrar'><button class='btn btn-light' onclick='cerrar_modal();'>Cancelar</button> <button class='btn btn-dark' onclick='cambiar_aula("${dia}", "${hora}","${profesores}","${id_usuario}","${data.profesor[0].nombre_grupo}");event.preventDefault();'>Cambiar</button></p>`;

                let existia = false;

                for (let i = 0; i < profesores.length; i++) {

                    if (id_usuario == profesores[i]) {

                        existia = true;
                        break;
                    }
                }

                if (!existia) {

                    abrir_modal(html_code);
                } else {

                    $.ajax({
                        url: encodeURI(DIR_SERV + "/insertarGrupo/" + dia + "/" + hora + "/" + id_usuario + "/" + grupos[0] + "/" + aulas[0]),
                        type: "POST",
                        dataType: "json"

                    }).done(function (data) {

                        obtener_horario_admin();
                        editar_grupos(dia, hora, id_usuario, aulas[1], aulas[0]);

                    }).fail(function (a, b) {

                        cargar_vista_error(error_ajax_jquery(a, b));
                    });
                }

            } else {

                if (grupos[1].match(/^[^a-zA-Z]/) && aulas[0] == 64) {

                    $("#mensaje").html("Error: No le ha asignado un grupo a un aula");
                } else {

                    $.ajax({
                        url: encodeURI(DIR_SERV + "/insertarGrupo/" + dia + "/" + hora + "/" + id_usuario + "/" + grupos[0] + "/" + aulas[0]),
                        type: "POST",
                        dataType: "json"

                    }).done(function (data) {

                        obtener_horario_admin();
                        editar_grupos(dia, hora, id_usuario, aulas[1], aulas[0]);

                    }).fail(function (a, b) {

                        cargar_vista_error(error_ajax_jquery(a, b));
                    });
                }
            }
        } else {

            if (grupos[1].match(/^[^a-zA-Z]/) && aulas[0] == 64) {

                $("#mensaje").html("Error: No le ha asignado un grupo a un aula");
            } else {

                $.ajax({
                    url: encodeURI(DIR_SERV + "/insertarGrupo/" + dia + "/" + hora + "/" + id_usuario + "/" + grupos[0] + "/" + aulas[0]),
                    type: "POST",
                    dataType: "json"

                }).done(function (data) {

                    obtener_horario_admin();
                    editar_grupos(dia, hora, id_usuario, aulas[1], aulas[0]);

                }).fail(function (a, b) {

                    cargar_vista_error(error_ajax_jquery(a, b));
                });
            }
        }
    }).fail(function (a, b) {
        cargar_vista_error(error_ajax_jquery(a, b));
    });

}

function mostrar_grupos(dia, hora, id_usuario, asignado = null) {

    $.ajax({

        url: encodeURI(DIR_SERV + "/gruposLibres/" + dia + "/" + hora + "/" + id_usuario),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        //MOSRAMOS GRUPOS QUE NECESITAN AULAS
        let output = "<optgroup label='Con Aula'>";

        $.each(data.grupos, function (key, value) {

            if (value.grupo.match(/^[^a-zA-Z]/)) {

                output += "<option value='" + value.id_grupo + "-" + value.grupo + "'>" + value.grupo + "</option>";
            }
        });

        //SI NO TIENE NADA ASIGNADO, MUESTRA TAMBIEN GUARDIAS
        if (!asignado) {

            output += "<optgroup label='Sin Aula'>";

            $.each(data.grupos, function (key, value) {

                if (value.grupo.match(/^[a-zA-Z]/)) {

                    output += "<option value='" + value.id_grupo + "-" + value.grupo + "'>" + value.grupo + "</option>";
                }
            });
        }

        $("select#grupos").html(output);

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
}

function mostrar_aulas(dia, hora, aula = null, id_aula = null, fila_tabla = null) {

    $.ajax({

        url: encodeURI(DIR_SERV + "/aulasLibres/" + dia + "/" + hora),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        let output = "<optgroup label='Libres'>";

        if (aula && id_aula && fila_tabla && fila_tabla > 2) {

            output += "<option value='" + id_aula + "-" + aula + "'>" + aula + "</option>";
            $("select#aulas").html(output);
        } else {

            $.each(data.aulas_libres, function (key, value) {

                output += "<option value='" + value.id_aula + "-" + value.aula + "'>" + value.aula + "</option>";
            });

            $.ajax({

                url: encodeURI(DIR_SERV + "/aulasOcupadas/" + dia + "/" + hora),
                type: "GET",
                dataType: "json"

            }).done(function (data) {

                output += $("select#aulas").html("");
                output += "<optgroup label='Ocupadas'>";

                $.each(data.aulas_ocupadas, function (key, value) {

                    output += "<option value='" + value.id_aula + "-" + value.aula + "'>" + value.aula + "</option>";
                });

                $("select#aulas").html(output);

            }).fail(function (a, b) {

                cargar_vista_error(error_ajax_jquery(a, b));
            });
        }

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });

}

function cambiar_aula(dia, hora, id_usuarios_antiguos, id_usuario, aula) {


    cerrar_modal();

    let html_code = "<h2 class='centrar'> Cambiando aula " + aula + " del " + DIAS[dia] + " a " + hora + "º Hora</h2>";
    html_code += "<p class='centrar'>Elija un nuevo aula libre: <select id='cambio_aula'>";

    $.ajax({

        url: encodeURI(DIR_SERV + "/aulasLibres/" + dia + "/" + hora),
        type: "GET",
        dataType: "json"

    }).done(function (data) {

        $.each(data.aulas_libres, function (key, value) {

            if (value.aula != "Sin asignar o sin aula") {

                html_code += "<option value='" + value.id_aula + "-" + value.aula + "'>" + value.aula + "</option>";
            }
        });

        $("select#cambio_aula").html(html_code);

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));

    });

    html_code += "</select> </p>";
    html_code += `<p class='centrar'><button class='btn btn-light' onclick='cerrar_modal();'>Cancelar</button> <button class='btn btn-dark' onclick='confirmar_cambio_aula("${dia}","${hora}","${id_usuarios_antiguos}","${id_usuario}");event.preventDefault();'>Cambiar</button></p>`;

    abrir_modal(html_code);
}

function confirmar_cambio_aula(dia, hora, id_usuarios_antiguos, id_usuario) {

    let select_de_grupos = $("select#grupos").val().split("-");
    let select_de_aulas = $("select#aulas").val().split("-");
    let usuarios_antiguos = id_usuarios_antiguos.split(",");
    let select_de_cambio_aulas = $("select#cambio_aula").val().split("-");

    $.each(usuarios_antiguos, function (key, value) {

        $.ajax({

            url: encodeURI(DIR_SERV + "/actualizarAula/" + select_de_cambio_aulas[0] + "/" + dia + "/" + hora + "/" + value),
            type: "PUT",
            dataType: "json"

        }).done(function (data) {

            console.log(data.mensaje);

        }).fail(function (a, b) {

            cargar_vista_error(error_ajax_jquery(a, b));
        });
    });

    $.ajax({

        url: encodeURI(DIR_SERV + "/insertarGrupo/" + dia + "/" + hora + "/" + id_usuario + "/" + select_de_grupos[0] + "/" + select_de_aulas[0]),
        type: "POST",
        dataType: "json"

    }).done(function (data) {

        obtener_horario_admin();
        editar_grupos(hora, dia, id_usuario, select_de_aulas[1], select_de_aulas[0]);

    }).fail(function (a, b) {

        cargar_vista_error(error_ajax_jquery(a, b));
    });
    cerrar_modal();
}