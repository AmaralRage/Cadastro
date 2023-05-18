<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravar') {
    call_user_func($funcao);
}

if ($funcao == 'recuperaFuncionario') {
    call_user_func($funcao);
}


if ($funcao == 'excluir') {
    call_user_func($funcao);
}
if ($funcao == 'generoVerificado') {
    call_user_func($funcao);
}
return;


function gravar()
{

    $descricao = $_POST['descricao'];
    $codigo = (int)$_POST['codigo'];
    $ativo = (int)$_POST['ativo'];

    $sql = "dbo.Genero_Atualiza 

    $codigo
    ,'$descricao'
    ,'$ativo'";

    $reposit = new reposit();
    $result = $reposit->Execprocedure($sql);

    $ret = 'success#';
    if ($result < 1) {
        $ret = 'failed#';
    }
    echo $ret;
    return;
}

function generoVerificado()
{
    $descricao = $_POST["descricao"];
    $sql = "SELECT descricao, codigo FROM dbo.genero WHERE descricao='$descricao'";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);
    if ($result) {
        $mensagem = "CPF do dependente já registrado!";
        echo "failed#" . $mensagem . ' ';
        return;
    } else {
        echo  'succes#';
        return;
    }
}

function recuperaFuncionario()
{
    $condicaoId = !((empty($_POST["id"])) || (!isset($_POST["id"])) || (is_null($_POST["id"])));
    $condicaoLogin = !((empty($_POST["loginPesquisa"])) || (!isset($_POST["loginPesquisa"])) || (is_null($_POST["loginPesquisa"])));

    if (($condicaoId === false) && ($condicaoLogin === false)) {
        $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    if (($condicaoId === true) && ($condicaoLogin === true)) {
        $mensagem = "Somente 1 parâmetro de pesquisa deve ser informado.";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    if ($condicaoId) {
        $id = $_POST["id"];
    }

    if ($condicaoLogin) {
        $loginPesquisa = $_POST["loginPesquisa"];
    }

    $sql = " SELECT codigo, generoAtivo, descricao
               FROM dbo.genero WHERE codigo = $id";

    // if ($condicaoId) {
    //     $sql = $sql . " AND codigo = " . $id . " ";
    // }

    if ($condicaoLogin) {
        $sql = $sql . " AND login = '" . $loginPesquisa . "' ";
    }

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $id = +$row['codigo'];
        $ativo = +$row['generoAtivo'];
        $descricao = $row['descricao'];
    }

    $out =   $id . "^" .
        $ativo . "^" .
        $descricao . "^" .
        $descricao;

    if ($out == "") {
        echo "failed#";
        return;
    }

    echo "sucess#" . $out;
    return;
}
function excluir()
{

    $reposit = new reposit();
    $possuiPermissao = $reposit->PossuiPermissao("USUARIO_ACESSAR|USUARIO_EXCLUIR");

    $id = $_POST["id"];

    if ((empty($_POST['id']) || (!isset($_POST['id'])) || (is_null($_POST['id'])))) {
        $mensagem = "Selecione um usuário.";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    session_start();
    $usuario = $_SESSION['login'];
    $usuario = "'" . $usuario . "'";

    $result = $reposit->update('dbo.genero' . '|' . 'generoAtivo = 0' . '|' . 'codigo =' . $id);

    $reposit = new reposit();

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}