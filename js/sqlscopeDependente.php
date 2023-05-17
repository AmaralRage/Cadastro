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

if ($funcao == 'dependenteVerificado') {
    call_user_func($funcao);
}

return;


function gravar()
{

    $descricao = $_POST['descricao'];
    $codigo = 0;
    $ativo = (int)$_POST['ativo'];

    $sql = "dbo.dependentes_Atualiza 

    '$codigo'
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

    $sql = " SELECT codigo, tipoDependente, dependenteAtivo
               FROM dbo.dependentes WHERE codigo = $id";

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
        $ativo = +$row['ativo'];
        $dependente = (int)$row['dependente'];
    }

    $out =   $id . "^" .
        $ativo . "^" .
        $dependente . "^" .
        $dependente;

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

    $result = $reposit->update('dbo.dependentes' . '|' . 'ativo = 0' . '|' . 'id =' . $id);

    $reposit = new reposit();

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}

function validaUsuario($login)
{
    $sql = "SELECT codigo,[login],ativo FROM Ntl.usuario
    WHERE [login] LIKE $login and ativo = 1";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    if ($result[0]) {
        return true;
    } else {
        return false;
    }
}


function dependenteVerificado()
{
    $tipoDependente = $_POST["tipoDependente"];
    $sql = "SELECT tipoDependente, codigo FROM dbo.tipoDependentes WHERE tipoDependente='$tipoDependente'";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);
    if ($result) {
        $mensagem = "Dependente já registrado!";
        echo "failed#" . $mensagem . ' ';
        return;
    } else {
        echo  'succes#';
        return;
    }
}


function recuperarDadosUsuario()
{

    session_start();
    $codigoLogin = $_SESSION['codigo'];

    $sql = "SELECT codigo, login, ativo, restaurarSenha
    FROM Ntl.usuario
    WHERE (0=0) AND
    codigo = " . $codigoLogin;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $codigo = (int)$row['codigo'];
        $restaurarSenha = $row['restaurarSenha'];
    }

    $out = $codigo . "^" .
        $restaurarSenha;

    if ($out == "") {
        echo "failed#";
        return;
    }

    echo "success" . $out;
    return;
}

function gravarNovaSenha()
{
    $reposit = new reposit();
    $senhaConfirma = $_POST["senhaConfirma"];
    $senha = $_POST["senha"];

    if ((empty($_POST['senhaConfirma'])) || (!isset($_POST['senhaConfirma'])) || (is_null($_POST['senhaConfirma']))) {
        $senhaConfirma = null;
    }
    if ((empty($_POST['senha'])) || (!isset($_POST['senha'])) || (is_null($_POST['senha']))) {
        $senha = null;
    }

    if ((!is_null($senhaConfirma)) or (!is_null($senha))) {
        $comum = new comum();
        $validouSenha = 1;
        if (!is_null($senha)) {
            $validouSenha = $comum->validaSenha($senha);
        }
        if ($validouSenha === 0) {
            if ($senhaConfirma !== $senha) {
                $mensagem = "A confirmação da senha deve ser igual a senha.";
                echo "failed#" . $mensagem . ' ';
                return;
            } else {
                $comum = new comum();
                $senhaCript = $comum->criptografia($senha);
                $senha = "'" . $senhaCript . "'";
            }
        } else {
            switch ($validouSenha) {
                case 1:
                    $mensagem = "Senha não pode conter espaços.";
                    break;
                case 2:
                    $mensagem = "Senha deve possuir no mínimo 7 caracter.";
                    break;
                case 3:
                    $mensagem = "Senha ultrapassou de 15 caracteres.";
                    break;
                case 4:
                    $mensagem = "Senha deve possuir no mínimo um caractér númerico.";
                    break;
                case 5:
                    $mensagem = "Senha deve possuir no mínimo um caractér alfabético.";
                    break;
                case 6:
                    $mensagem = "Senha deve possuir no mínimo um caracter especial.\nSão válidos : ! # $ & * - + ? . ; , : ] [ ( )";
                    break;
                case 7:
                    $mensagem = "Senha não pode ter caracteres acentuados.";
                    break;
            }
            echo "failed#" . $mensagem . ' ';
            return;
        }
    }

    session_start();
    $login = "'" .  $_SESSION['login'] . "'";
    $usuario =  $login;

    $id = $_SESSION['codigo'];
    $funcionario = $_SESSION['funcionario'];
    if (!$funcionario) {
        $funcionario = 'NULL';
    }
    $ativo = 1;
    $tipoUsuario = 'C';
    $restaurarSenha = 0;

    $sql = "Ntl.usuario_Atualiza " . $id . "," . $ativo . "," . $login . "," . $senha . "," . $tipoUsuario . "," . $usuario . "," . $funcionario . "," . $restaurarSenha . " ";

    $reposit = new reposit();
    $result = $reposit->Execprocedure($sql);

    $ret = 'sucess#';

    if ($result < 1) {
        $ret = 'failed#';
    }

    echo $ret;
    return;
}
