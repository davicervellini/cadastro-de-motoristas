<?php
session_start();
require_once "../conexao/ConexaoMySQL.Class.php";
require_once "../classes/autoload.php";
$sys = new Sistema;
$mot = new Motorista;

$resp    = array();
$vCampos = array();
$vDados  = array();

foreach ($_POST as $key => $value) {
    ${$key} = ($value != "") ? $value : NULL;
}


switch ($processo) {
    case 'incluirMotorista':

        try {

            $motCodigo = $sys->gera_codigo("motoristas");

            $vDados = [
                'MOT_CODIGO'        => $motCodigo,
                'MOT_NOME'          => $nome,
                'MOT_TELEFONE'      => $telefone,
                'MOT_CNH'           => $cnh,
                'MOT_TIPO_CNH'      => $tpCnh,
                'MOT_CPF'           => $sys->limpaVars($documento),
                'MOT_DTNACIMENTO'   => $sys->padroniza_datas_US($dtNaci)
                
            ];

            $res = $sys->getInsert("motoristas", $vDados);

            if ($res != "") {
                $resp['error'] = $res;
            } else {
                $resp['message'] = 'Motorista cadastrado com sucesso.';
                $resp['cliCod']  = $mot->resgataRecno($motCodigo);
            }

            print json_encode($resp);
        } catch (Exception $e) {
            $resp['error'] = $e->getMessage();
            print json_encode($resp);
        }
        break;

    case 'corrigirMotorista':

        try {

            $vDados = [
                'MOT_NOME'          => $nome,
                'MOT_TELEFONE'      => $telefone,
                'MOT_CNH'           => $cnh,
                'MOT_TIPO_CNH'      => $tpCnh,
                'MOT_CPF'           => $sys->limpaVars($documento),
                'MOT_DTNACIMENTO'   => $sys->padroniza_datas_US($dtNaci)
            ];
            $res = $sys->getUpdate("motoristas", "RECNO = " . $codMotorista, $vDados);


            if ($res != "") {
                $resp['error'] = $res;
            } else {
                $resp['message']   = 'Motorista corrigido com sucesso.';
            }

            print json_encode($resp);
        } catch (Exception $e) {
            $resp['error'] = $e->getMessage();
            print json_encode($resp);
        }
        break;

    case 'excluirMotorista':

        try {

            $res = $sys->getDelete("motoristas", "RECNO = " . $codMotorista);
            if ($res != "") {
                $resp['error'] = $res;
            } else {
                $resp['message']   = 'Motorista excluído com sucesso.';
            }

            print json_encode($resp);
        } catch (Exception $e) {
            $resp['error'] = $e->getMessage();
            print json_encode($resp);
        }
        break;

    case 'listarMotoristas':

        try {
            $qry = $mot->list();
            $cont = 0;
            $selected = 0;
            $ativo = "";
            if (count($qry) > 0) {
                $resp['grid'] = "
                   <thead>
                        <tr align=\"center\">
                          <th width=\"25%\">Documento</th>
                          <th width=\"75%\">Nome</th>
                        </tr>
                  </thead>
                  <tbody>";
                foreach ($qry as $ln) {
                    $cont++;
                    if ($ln["RECNO"] == $recno) {
                        $ativo = "tr-active";
                        $selected = $cont;
                    } else {
                        $ativo = "";
                    }
                    $resp['grid'] .= "
                        <tr class='trHighlight " . $ativo . "' onclick=\"selecionarRegistro('" . $ln["RECNO"] . "',this)\">
                            <td>" . $sys->mask($ln["MOT_CPF"]) . "</td>
                            <td>" . $ln["MOT_NOME"] . "</td>
                        </tr>";
                }

                $resp['grid'] .= " </tbody>";
                $resp['pagina'] = (10 * floor(($selected / 10)));
            } else {
                $resp['grid'] = "<thead>
                        <th>&nbsp;</th>
                       </thead>
                       <tbody>
                        <tr><td>Nenhum registro encontrado</td></tr>
                       </tbody>";
            }
            print json_encode($resp);
        } catch (Exception $e) {
            $resp['error'] = $e->getMessage();
            print json_encode($resp);
        }

        break;

    case 'preencheCampos':

        try {
            $mot = new Motorista($id);
            $resp["Nome"]       = $mot->getNome();
            $resp["Telefone"]   = $mot->getTelefone();
            $resp["Cnh"]        = $mot->getCnh();
            $resp["TipoCnh"]    = $mot->getTipoCnh();
            $resp["Documento"]  = $sys->mask($mot->getCpf());
            $resp["DtNaci"]     = $sys->padroniza_datas_BR($mot->getDtNaci());

            print json_encode($resp);
        } catch (Exception $e) {
            $resp['error'] = $e->getMessage();
            print json_encode($resp);
        }

        break;
}
