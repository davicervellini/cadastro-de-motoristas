var liberarInclusao = false,
    liberarCorrecao = false,
    isInclusao = 0;

function habilitarCampos(sBool) {
    $("input[type='text']:not(#atividade),input[type='hidden']").prop('disabled', sBool == true ? false : true);
}

function limparCampos() {
    $("input[type='text']").val('');
}

function dataMotorista(data) {
    return (data != "" && data != undefined) ? data.split("/") : "";
}

function selecionarRegistro(cod, elm) {
    setDadosForm(cod);
    $("tr").removeClass("tr-active");
    $(elm).addClass("tr-active");
}

var getDadosForm = function () {
    return {
        nome: $("#nome").val(),
        telefone: $("#telefone").val(),
        cnh: $("#cnh").val(),
        tpCnh: $("#tipoCnh").val(),
        documento: $("#cpf").val(),
        dtNaci: $("#data").val(),
        codMotorista: $("#codMotorista").val()
    }
}

function setDadosForm(id) {
    $.ajax({
        type: "POST",
        url: "php/frmCadMotorista.php",
        datatype: "json",
        data: {
            processo: 'preencheCampos',
            id: id
        },
        beforeSend: function () {
            $("#message").loadGif('Carregando dados, por favor aguarde...');
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (!data.hasOwnProperty('error')) {
                $("#nome").val(data.Nome),
                $("#telefone").val(data.Telefone),
                $("#cnh").val(data.Cnh),
                $("#tipoCnh").val(data.TipoCnh),
                $("#cpf").val(data.Documento),
                $("#data").val(data.DtNaci),

                $("#codMotorista").val(id)
                $('html,body').animate({ scrollTop: 0 }, 'slow');
                $(".date").datepicker().mask('00/00/0000');
            } else {
                alert(data.error);
            }
            $("#message").html('');
        },
        error: function (data) {
            alert('Falha ao carregar os dados, recarregue a página e tente novamente.');
            console.log(data);
        }
    });
}

function habilitarControles(nameButton = null) {
    $('.btnControl').addClass('disabled');
    if (nameButton !== null) {
        for (var i = 0; i < nameButton.length; i++) {
            $(nameButton[i]).removeClass('disabled');
        }
    } else {
        $('.btnControl').removeClass('disabled');
    }
}

function incluirMotorista() {
    if (!liberarInclusao) {
        isInclusao = 1;
        limparCampos();
        habilitarCampos(true);
        habilitarControles(['#btnIncluir']);
        $("#btnIncluir").html('Salvar');
        $("#nome").focus();
        liberarInclusao = true;
    } else {

        if (confirm('Deseja salvar os dados?')) {
            var Dados = getDadosForm();
            Dados.processo = 'incluirMotorista';

            $.ajax({
                type: "POST",
                url: "php/frmCadMotorista.php",
                data: Dados,
                datatype: 'json',
                beforeSend: function () {
                    $("#message").loadGif('Incluindo o Motorista, por favor aguarde...');
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (!data.hasOwnProperty('error')) {
                        alert(data.message);
                        $("#message").html('');
                        limparCampos();
                        listarMotoristas();
                        habilitarCampos(false);
                        habilitarControles();
                        $("#btnIncluir").html('Incluir');
                        liberarInclusao = false;
                    } else {
                        alert(data.error);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

        } else {
            habilitarCampos(false);
            habilitarControles();
            $("#btnIncluir").html('Incluir');
            liberarInclusao = false;
        }
    }
}


function corrigirMotorista() {
    var codMotorista = $("#codMotorista").val();
    if (!liberarCorrecao) {
        if (codMotorista != "") {
            habilitarControles(['#btnCorrigir']);
            habilitarCampos(true);
            $("#btnCorrigir").html('Salvar');
            $("#nome").focus();
            liberarCorrecao = true;
        } else {
            alert('Por favor, selecione um registro antes de continuar.');
            return false;
        }
    } else {

        if (confirm('Deseja salvar os dados?')) {
            var Dados = getDadosForm();
            Dados.processo = 'corrigirMotorista';

            $.ajax({
                type: "POST",
                url: "php/frmCadMotorista.php",
                data: Dados,
                datatype: 'json',
                beforeSend: function () {
                    $("#message").loadGif('Corrigindo o Motorista, por favor aguarde...');
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (!data.hasOwnProperty('error')) {
                        alert(data.message);
                        $("#message").html('');
                        limparCampos();
                        listarMotoristas();
                        habilitarCampos(false);
                        habilitarControles();
                        $("#btnCorrigir").html('Corrigir');
                        liberarCorrecao = false;
                        $("tr").removeClass("tr-active");
                    } else {
                        alert(data.error);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });


        } else {

            habilitarControles();
            habilitarCampos(false);
            $("#btnCorrigir").html('Corrigir');
            liberarCorrecao = false;
        }
    }
}

function excluirMotorista() {
    var codMotorista = $("#codMotorista").val();
    if (codMotorista != "") {
        if (confirm('Deseja excluir esse registro?')) {
            var Dados = getDadosForm();
            Dados.processo = 'excluirMotorista';

            $.ajax({
                type: "POST",
                url: "php/frmCadMotorista.php",
                data: Dados,
                datatype: 'json',
                beforeSend: function () {
                    $("#message").loadGif('Excluindo o Motorista, por favor aguarde...');
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (!data.hasOwnProperty('error')) {
                        alert(data.message);
                        $("#message").html('');
                        limparCampos();
                        listarMotoristas()
                    } else {
                        alert(data.error);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });
        }

    } else {
        alert('Por favor, selecione um registro antes de continuar.');
    }
}

function listarMotoristas() {

    $.ajax({
        type: "POST",
        url: "php/frmCadMotorista.php",
        data: {
            processo: 'listarMotoristas',
            recno: $('#codMotorista').val()
        },
        datatype: 'json',
        beforeSend: function () {
            $("#gridMotorista").loadGif('Carregando resultados, por favor aguarde.');
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (!data.hasOwnProperty('error')) {
                if ($.fn.DataTable.isDataTable("#gridMotorista")) {
                    $('#gridMotorista').DataTable().clear().destroy();
                }
                gridMotorista = $("#gridMotorista").html(data.grid).DataTable({ "iDisplayStart": data.pagina, aaSorting: [] });
            } else {
                alert(data.error);
            }
        }
    });

}


$("#descricao").on("blur", function () {
    $.ajax({
        type: "POST",
        url: "php/frmCadMotorista.php",
        data: {
            processo: 'verificarMotorista',
            ocoDescricao: $("#descricao").val()
        },
        success: function (resposta) {
            if (parseInt(resposta) > 0) {
                $("#message").showAlert('Este feriado já foi cadastrado.');
                $("#descricao").focus();
                (isInclusao == 1) ? $("#btnIncluir").addClass("disabled") : $("#btnCorrigir").addClass("disabled");

            } else {
                $("#message").html('');
                (isInclusao == 1) ? $("#btnIncluir").removeClass("disabled") : $("#btnCorrigir").removeClass("disabled");
            }
        }
    });
});

$(".date").datepicker().mask('00/00/0000');

$.fn.loadGif = function (sMessage) {

    sMessage = (sMessage !== "") ? "<div style='padding-left:10px;line-height: 32px; height:32px'>" + sMessage + "</div> " : "";
    $(this).html("<div class=\"row\">\
			<div class=\"col l12 center-align\">\
				<div class=\"preloader-wrapper big active\">\
					<div class=\"spinner-layer spinner-green-only\">\
						<div class=\"circle-clipper left\">\
						<div class=\"circle\"></div>\
						</div><div class=\"gap-patch\">\
						<div class=\"circle\"></div>\
						</div><div class=\"circle-clipper right\">\
						<div class=\"circle\"></div>\
						</div>\
					</div>\
				</div>" + sMessage + "\
			</div></div>");

}

$(document).ready(function () {
    $(".cpf").mask("999.999.999-99");
    habilitarCampos(false);
    listarMotoristas();
    $("input[type='text']").bind('keydown', function (e) {
        if ($(this).data('next'))
            (e.keyCode == '13') && $($(this).data('next')).focus();
    });
    $.datepicker.setDefaults({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Ter&ccedil;a', 'Quarta', 'Quinta', 'Sexta', 'S&aacute;bado', 'Domingo'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
    });
});