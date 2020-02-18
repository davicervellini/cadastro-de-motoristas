<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="content-language" content="pt-br" />
    <title>Sistema</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="css/materialize-customized.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/style.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/dataTables.material.css" />
    <link type="text/css" rel="stylesheet" href="css/buttons.dataTables.min.css" />
    <link type="text/css" rel="stylesheet" href="css/datepicker.css" />
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/buttons.print.min.js"></script>
    <script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery-maskmoney-v3.0.2.js"></script>
    <script type="text/javascript" src="js/materialize.min.js" charset="utf-8"></script>
    <style type="text/css">
        body {
            background: url("img/bkg-login.jpg");
        }

        .btntour {
            padding: 4px 6px;
        }

        .arca-nav {
            overflow-y: hidden;
            overflow-x: hidden;
        }

        .arca-nav:hover {
            overflow-y: auto;
        }
    </style>

</head>

<body class="grey lighten-2">
    <div class="container">
        <div class="row" id="Motoristas">
            <form id="frmCadMotoristas" class="col l12 white z-depth-1" style='padding-top:10px'>
                <div class="row no-bottom center-align">
                    <h5>Cadastro de Motoristas</h5>
                </div>
                <div class="row no-bottom">
                    <div class="input-field col l10 offset-l1">
                        <input placeholder="" id="nome" type="text" data-next="#telefone">
                        <label for="nome" id="lblNome">Nome</span></label>
                    </div>
                </div>
                <div class="row no-bottom">
                    <div class="input-field col l2 offset-l1">
                        <input placeholder="" id="telefone" type="text" data-next="#Cnh">
                        <label for="telefone" id="lblTelefone">Telefone</span></label>
                    </div>
                    <div class="input-field col l2">
                        <input placeholder="" id="cnh" type="text" data-next="#tipoCnh">
                        <label for="Cnh" id="lblCnh">CNH</span></label>
                    </div>
                    <div class="input-field col l2">
                        <input placeholder="" id="tipoCnh" type="text" data-next="#Cpf">
                        <label for="tipoCnh" id="lblTipoCnh">tipo de CNH</span></label>
                    </div>
                    <div class="input-field col l2">
                        <input placeholder="" id="cpf" class="cpf" type="text" data-next="#data">
                        <label for="Cpf" id="lblCpf">CPF</span></label>
                    </div>
                    <div class="input-field col l2">
                        <input placeholder="" id="data" class="date" type="text" data-next="#documento">
                        <label for="data" id="lblData">Nascimento</span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col l10 offset-l1" id="message"></div>
                </div>
                <div class="row">
                    <div class="col l10 offset-l1 center-align">
                        <a id="btnIncluir" name="btnIncluir" class="waves-effect waves-light btn background btnControl" onClick='incluirMotorista()'> Incluir</a>
                        <a id="btnCorrigir" name="btnCorrigir" class="waves-effect waves-light btn background btnControl" onClick='corrigirMotorista()' style="margin-left:5px">Corrigir</a>
                        <a id="btnCorrigir" name="btnCorrigir" class="waves-effect waves-light btn background btnControl" onClick='excluirMotorista()' style="margin-left:5px">Excluir</a>
                    </div>
                </div>
                <div class="row" style=' min-height:250px;margin-bottom:50px'>
                    <div class="col l10 offset-l1">
                        <table id="gridMotorista" class='bordered striped display compact dataTablePrint highlight pointer'></table>
                    </div>
                </div>
                <input name='codMotorista' id='codMotorista' type='hidden' value="<?php print @$_GET['codigo']; ?>"></input>
            </form>
        </div>
    </div>
    <script src="js/frmCadMotorista.js" type="text/javascript" charset="utf-8"></script>
</body>