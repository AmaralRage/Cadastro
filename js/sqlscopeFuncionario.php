<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'grava') {
    call_user_func($funcao);
}

if ($funcao == 'recuperaFuncionario') {
    call_user_func($funcao);
}

if ($funcao == 'excluir') {
    call_user_func($funcao);
}

if ($funcao == 'recuperarDadosUsuario') {
    call_user_func($funcao);
}
if ($funcao == 'validaCPF') {
    call_user_func($funcao);
}
if ($funcao == 'validaCPFDependente') {
    call_user_func($funcao);
}
if ($funcao == 'VerificaCPF') {
    call_user_func($funcao);
}
if ($funcao == 'VerificaRG') {
    call_user_func($funcao);
}

if ($funcao == 'gravarNovaSenha') {
    call_user_func($funcao);
}

return;

function grava()
{

    $reposit = new reposit();

    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $id = 0;
    } else {
        $id = (int) $_POST["id"];
    }

    if ((empty($_POST['ativo'])) || (!isset($_POST['ativo'])) || (is_null($_POST['ativo']))) {
        $ativo = 0;
    } else {
        $ativo = (int) $_POST["ativo"];
    }

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $genero = $_POST['genero'];
    $dataNascimento = $_POST['dataNascimento'];
    $estadoCivil = $_POST['estadoCivil'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $primeiroEmprego = $_POST['primeiroEmprego'];
    $pispasep = $_POST['pispasep'];
    $nome = trim($nome);
    $cep = trim($cep);
    $logradouro = trim($logradouro);
    $bairro = trim($bairro);
    $complemento = trim($complemento);
    

    //=============================================================================================TELEFONE==================================================================================================

    $strArrayTelefone = $_POST['jsonTelefoneArray'];

    // $strArrayTelefone = json_decode($strArrayTelefone, true);
    $xmlTelefone = "";
    // $nomeXml = "ArrayOfTelefone";
    // $nomeTabela = "telefone";
    $comum = new comum();

    $strArrayTelefone = $_POST['jsonTelefoneArray'];
    $arrayTelefone = $strArrayTelefone;

    $xmlTelefone = new \FluidXml\FluidXml('ArrayOfTelefone', ['encoding' => '']);
    foreach ($arrayTelefone as $item) {

        $telefonePrincipal = $item['telefonePrincipal'];
        if ($telefonePrincipal == 'true') {
            $telefonePrincipal = '1';
        } else {
            $telefonePrincipal = '0';
        }

        $telefoneWhatsApp = $item['telefoneWhatsApp'];
        if ($telefoneWhatsApp == 'true') {
            $telefoneWhatsApp = '1';
        } else {
            $telefoneWhatsApp = '0';
        }

        $xmlTelefone->addChild('telefone', true) //nome da tabela
            ->add('telefone', $item['telefone'])
            ->add('telefonePrincipal', $telefonePrincipal)
            ->add('telefoneWhatsApp', $telefoneWhatsApp)
            ->add('sequencialTelefone', $item['sequencialTelefone']);
    }

    $xmlTelefone = $comum->formatarString($xmlTelefone);

    //========================================================================================EMAIL============================================================================================================

    $strArrayEmail = $_POST['jsonEmailArray'];

    // $strArrayEmail = json_decode($strArrayEmail, true);
    $xmlEmail = "";
    // $nomeXml = "ArrayOfEmail";
    // $nomeTabela = "Email";
    $comum = new comum();

    $strArrayEmail = $_POST['jsonEmailArray'];
    $arrayEmail = $strArrayEmail;

    $xmlEmail = new \FluidXml\FluidXml('ArrayOfEmail', ['encoding' => '']);
    foreach ($arrayEmail as $item) {

        $emailPrincipal = $item['emailPrincipal'];
        if ($emailPrincipal == 'true') {
            $emailPrincipal = '1';
        } else {
            $emailPrincipal = '0';
        }

        $xmlEmail->addChild('email', true) //nome da tabela
            ->add('email', $item['email'])
            ->add('emailPrincipal', $emailPrincipal);
    }

    $xmlEmail = $comum->formatarString($xmlEmail);

    //========================================================================================DEPENDENTES============================================================================================================


    $strArrayDependente = $_POST['jsonDependenteArray'];

    // $strArrayDependente = json_decode($strArrayDependente, true);
    $xmlDependente = "";
    // $nomeXml = "ArrayOfDependente";
    // $nomeTabela = "Dependente";
    $comum = new comum();

    $strArrayDependente = $_POST['jsonDependenteArray'];
    $arrayDependente = $strArrayDependente;

    $xmlDependente = new \FluidXml\FluidXml('ArrayOfDependente', ['encoding' => '']);
    foreach ($arrayDependente as $item) {

        $xmlDependente->addChild('dependente', true) //nome da tabela
            ->add('dependente', $item['dependente'])
            ->add('cpfDependente', $item['cpfDependente'])
            ->add('dataNascimentoDependente', $item['dataNascimentoDependente'])
            ->add('tipoDependente', $item['tipoDependente'])
            ->add('sequencialDependente', $item['sequencialDependente']);
    }

    $xmlDependente = $comum->formatarString($xmlDependente);


    $sql = "dbo.funcionarios_Atualiza 
    '$id' , 
    '$ativo' ,
    '$nome', 
    '$cpf',
    '$rg',
    '$genero' ,
    '$dataNascimento',
    '$estadoCivil',
    $xmlTelefone,
    $xmlEmail,
    $xmlDependente,
    '$cep',
    '$logradouro',
    '$numero',
    '$complemento',
    '$uf',
    '$bairro',
    '$cidade',
    '$primeiroEmprego',
    '$pispasep'";


    $reposit = new reposit();
    $result = $reposit->Execprocedure($sql);

    $ret = 'success';
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

    $sql = " SELECT codigo as codigoFuncionario, nome, cpf, rg, data_nascimento, ativo, genero, estadoCivil, primeiroEmprego, pispasep,
                    cep, logradouro, uf, complemento,  numero, bairro, cidade 
             FROM dbo.funcionarios USU WHERE codigo = $id";



    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $id = +$row['codigoFuncionario'];
        $ativo = +$row['ativo'];
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $estadoCivil = $row['estadoCivil'];
        $rg = $row['rg'];
        $primeiroEmprego = $row['primeiroEmprego'];
        $pispasep = $row['pispasep'];
        $cep = $row['cep'];
        $logradouro = $row['logradouro'];
        $uf = $row['uf'];
        $complemento = $row['complemento'];
        $numero = $row['numero'];
        $bairro = $row['bairro'];
        $cidade = $row['cidade'];
        $data_nascimento = $row['data_nascimento'];
        if ($data_nascimento) {
            $data_nascimento = explode(" ", $data_nascimento);
            $data = explode("-", $data_nascimento[0]);
            $data_nascimento = ($data[2] . "/" . $data[1] . "/" . $data[0]);
        };
        $genero = (int)$row['genero'];
    }

    // cep, logradouro, uf, complemento,  numero, bairro, cidade 

    //Mudar os nomes das variaveis ACIMA 

    $out =   $id . "^" .
        $ativo . "^" .
        $nome . "^" .
        $cpf . "^" .
        $rg . "^" .
        $genero . "^" .
        $data_nascimento . "^" .
        $estadoCivil . "^" .
        $cep . "^" .
        $logradouro . "^" .
        $numero . "^" .
        $complemento . "^" .
        $uf . "^" .
        $bairro . "^" .
        $cidade . "^" .
        $pispasep . "^" .
        $primeiroEmprego;

    $sqlDependente = "SELECT dependente, cpfDependente, dataNascimento, tipoDependente FROM dbo.dependentes WHERE funcionarioId = $id";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sqlDependente);

    $contador = 0;
    $arrayDependente = [];
    foreach ($result as $contador => $item) {
        $sequencialDependente = $contador + 1;

        $dataNascimento = explode(" ", $item['dataNascimento']);
        $dataNascimento = explode("-", $dataNascimento[0]);
        $dataNascimento = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];
        
        array_push($arrayDependente, [
            'dependente' => $item['dependente'],
            'cpfDependente' => $item['cpfDependente'],
            'dataNascimentoDependente' => $dataNascimento,
            'tipoDependente' => $item['tipoDependente'],
            'sequencialDependente' => $sequencialDependente 
             
        ]);
            

    }

    $jsonDependente = json_encode($arrayDependente);

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $sqlTelefone = "SELECT telefone, whatsapp, principal FROM dbo.telefone WHERE funcionarioId = $id";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sqlTelefone);

    $contador = 0;
    $arrayTelefone = [];
    foreach ($result as $contador => $item) {
        $sequencialTelefone = $contador + 1;
        $item['principal'] == 1 ? $descricaoTelefonePrincipal = "Sim" :  $descricaoTelefonePrincipal = "Não";
        $item['whatsapp'] == 1 ? $descricaoWhatsappPrincipal = "Sim" :  $descricaoWhatsappPrincipal = "Não";

        array_push($arrayTelefone, [
            'telefone' => $item['telefone'],
            'telefoneWhatsapp' => $item['whatsapp'],
            'telefonePrincipal' => $item['principal'],
            'descricaoTelefonePrincipal' => $descricaoTelefonePrincipal,
            'descricaoTelefoneWhatsApp' => $descricaoWhatsappPrincipal,
            'sequencialTelefone' => $sequencialTelefone
        ]);
    }
    $jsonTelefone = json_encode($arrayTelefone);

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   

    $sqlEmail = "SELECT email, emailPrincipal FROM dbo.email WHERE funcionarioId = $id";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sqlEmail);

    $contador = 0;
    $arrayEmail = [];
    foreach ($result as $contador => $item) {
        $sequencialEmail = $contador + 1;
        $item['email'] == 1 ? $descricaoEmailPrincipal = "Sim" :  $descricaoEmailPrincipal = "Não";

        array_push($arrayEmail, [
            'email' => $item['email'],
            'emailPrincipal' => $item['email'],
            'descricaoEmailPrincipal' => $descricaoEmailPrincipal,
            'sequencialEmail' => $sequencialEmail

        ]);
    }
    $jsonEmail = json_encode($arrayEmail);

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($out == "") {
        echo "failed#";
    } else {
        echo "sucess#" . $out . "#" . $jsonTelefone . "#" . $jsonEmail . "#" . $jsonDependente;
    }
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

    $result = $reposit->update('dbo.funcionarios' . '|' . 'ativo = 0' . '|' . 'id =' . $id);

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

function validaCPF()
{

    // Extrai somente os números
    $cpf = $_POST["cpf"];
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            echo "failed";
            return false;
        }
    }
    echo "success";
    return true;
}

function VerificaCPF()
{
    $cpf = $_POST["cpf"];
    $sql = "SELECT cpf, codigo FROM dbo.funcionario WHERE cpf='$cpf'";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);
    if ($result > 0) {
        $mensagem = "CPF já registrado!";
        echo "failed#" . $mensagem . ' ';
        return;
    } else {
        echo  'succes#';
        return;
    }
}

function validaCPFDependente()
{
    $cpfDependente = $_POST["cpfDependente"];
    $sql = "SELECT cpfDependente, codigo FROM dbo.dependentes WHERE cpfDependente='$cpfDependente'";
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

function VerificaRG()
{
    ////////verifica registros duplicados

    $rg = "'" . $_POST["rg"] . "'";

    $sql = " SELECT rg FROM dbo.funcionarios WHERE rg = $rg ";
    //achou 
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    ////! ANTES É NEGAÇÃO
    if (!$result) {
        echo  'success#';
    } else {
        $mensagem = "RG já registrado!";
        echo "failed#" . $mensagem . ' ';
    }
}
