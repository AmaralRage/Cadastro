<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');


session_start();

$codigo = $_GET['id'];

require_once('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetXY(190, 5);
        $this->SetFont('Arial', 'B', 8); #Seta a Fonte
        $this->Ln(20); #Quebra de Linhas

    }
    function Footer()
    {
        $this->SetY(202);
    }
}
$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetFillColor(238, 238, 238);
$pdf->SetMargins(0, 0, 0); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
$pdf->AddPage();

$tamanhoFonte = 11;
$tamanhoFonteMenor = 8;
$tipoDeFonte = 'Times';
$fontWeight = 'B';

$pdf->SetFillColor(220, 220, 220);

$pdf->Line(5, 5, 205, 5);
$pdf->Line(5, 12, 205, 12);
$pdf->Line(5, 5, 5, 292);
$pdf->Line(205, 5, 205, 292);
$pdf->Line(5, 292, 205, 292);



$pdf->Image('C:\inetpub\wwwroot\Cadastro\img\ntlLogoMarcaDagua.png', 36.5, 80, 135, 145, 'PNG');
$pdf->Image('C:\inetpub\wwwroot\Cadastro\img\MarcaNTL.png', 12, 265, 60, 20, 'PNG');

$pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
$pdf->SetY(6);
$pdf->SetX(95);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Relatorio do Funcionário"), 0, 0, "C", 0);

$pdf->Cell(3, 35, iconv('UTF-8', 'windows-1252', ""), 0, 0, "C", 0);

$pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
$pdf->SetY(19);
$pdf->SetX(95);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "INFORMAÇÕES DOS FUNCIONÁRIOS"), 0, 0, "C", 0);






$sql = " SELECT F.nome, F.codigo, F.ativo, F.cpf, F.data_Nascimento,F.pispasep, F.estadoCivil, F.pispasep, F.primeiroEmprego, F.cep, F.logradouro, F.bairro, F.numero, F.complemento,
                F.uf, F.cidade, F.rg, G.descricao as genero
                FROM dbo.funcionarios F
                LEFT JOIN dbo.genero G on G.codigo = F.genero WHERE F.codigo = $codigo";


$reposit = new reposit();
$result = $reposit->RunQuery($sql);
foreach ($result as $row) {
    $nome = $row['nome'];
    $cpf = $row['cpf'];
    $rg =  $row['rg'];
    $dataNascimento = $row['data_Nascimento'];
    $ativo = $row['ativo$ativo'];
    $genero = $row['genero'];
    $estadoCivil = $row['estadoCivil'];
    $primeiroEmprego = $row['primeiroEmprego'];
    $pispasep = $row['pispasep'];
    $cep = $row['cep'];
    $logradouro = $row['logradouro'];
    $bairro = $row['bairro'];
    $numero = $row['numero'];
    $complemento = $row['complemento'];
    $uf = $row['uf'];
    $cidade = $row['cidade'];


    $valor_de_retorno = match ($estadoCivil) {
        1 => 'Solteiro(a)',
        2 => 'Casado(a)',
        3 => 'Divorciado(a)',
        4 => 'Separado(a)',
        5 => 'Viúvo(a)',
    };
    $estadoCivil = $valor_de_retorno;

    $valor_de_retorno = match ($primeiroEmprego) {
        0 => 'Não',
        1 => 'Sim',
    };
    $primeiroEmprego = $valor_de_retorno;

    $cpf = $row['cpf'];
    $rg = $row['rg'];
    $descricaoAtivo = "";

    if ($ativo == 1) {
        $descricaoAtivo = "Sim";
    } else {
        $descricaoAtivo = "Não";
    }

    if ($pispasep) {
        // $pispasep = "";
    } else {
        $pispasep = "Nenhum";
    }

    if ($dataNascimento) {
        $dataNascimento = explode(" ", $dataNascimento);
        $data = explode("-", $dataNascimento[0]);
        $data = ($data[2] . "/" . $data[1] . "/" . $data[0]);

        $pdf->SetFont('Courier', 'B', 11);
        $pdf->SetY(32.5);
        $pdf->SetX(15); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
        $pdf->Cell(13, 3, iconv('UTF-8', 'windows-1252', "NOME:"), 0, 0, "L", 0);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$nome"), 0, 0, "L", 0);





        $sql2 = "SELECT  TF.telefone, TF.principal, TF.whatsapp FROM dbo.funcionarios C
        LEFT JOIN dbo.telefone TF on TF.funcionarioId = C.codigo where C.codigo = $codigo";

        $i = 87;
        $margem = 5;
        foreach ($resultQueryTelefone as $row) {

            // ------------------ Contato Funcionario ----------------- {
            $telefone = $row['telefone'];
            $telefonePrincipal = $row['principal'];
            $telefoneWhatsapp = $row['whatsapp'];

            if ($telefonePrincipal) {
                $telefonePrincipal = 'Sim';
            } else {
                $telefonePrincipal = 'Não';
            }

            if ($telefoneWhatsapp) {
                $telefoneWhatsapp = 'Sim';
            } else {
                $telefoneWhatsapp = 'Não';
            }


            $i = $i + 7;

            $pdf->SetFont('Helvetica', '', 10);
            $pdf->SetY($i);
            $pdf->SetX(14);
            $pdf->Cell(35, 7, iconv('UTF-8', 'windows-1252', $telefone), 1, 0, "C", 0);

            $pdf->SetFont('Helvetica', '', 10);
            $pdf->SetY($i);
            $pdf->SetX(49);
            $pdf->Cell(25, 7, iconv('UTF-8', 'windows-1252', $telefonePrincipal), 1, 0, "C", 0);

            $pdf->SetFont('Helvetica', '', 10);
            $pdf->SetY($i);
            $pdf->SetX(74);
            $pdf->Cell(25, 7, iconv('UTF-8', 'windows-1252', $telefoneWhatsapp), 1, 0, "C", 0);
        }

        $sql3 = "SELECT email, emailPrincipal FROM dbo.email where funcionarioId = $codigo";

        $reposit = new reposit();
        $resultQueryEmail = $reposit->RunQuery($sql3);


        $y = 87;
        $margem = 5;
        foreach ($resultQueryEmail as $row) {

            // ------------------ Contato Funcionario ----------------- {
            $email = $row['email'];
            $emailPrincipal = $row['emailPrincipal'];

            if ($emailPrincipal) {
                $emailPrincipal = 'Sim';
            } else {
                $emailPrincipal = 'Não';
            }

            $y = $y + 7;

            $pdf->SetFont('Helvetica', '', 10);
            $pdf->SetY($y);
            $pdf->SetX(112);
            $pdf->Cell(55, 7, iconv('UTF-8', 'windows-1252', $email), 1, 0, "C", 0);

            $pdf->SetFont('Helvetica', '', 10);
            $pdf->SetY($y);
            $pdf->SetX(167);
            $pdf->Cell(25, 7, iconv('UTF-8', 'windows-1252', $emailPrincipal), 1, 0, "C", 0);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
    }
}
























































// $pdf->Line(9.5, 64.5, 200, 64.5); //LINHA DE FUNCIONÁRIO

// $pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
// $pdf->SetY(72);
// $pdf->SetX(95);
// $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "CONTATOS"), 0, 0, "C", 0);


// $pdf->SetFillColor(255, 182, 193);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY(86);
// $pdf->SetX(112);
// $pdf->Cell(55, 8, iconv('UTF-8', 'windows-1252', "EMAIL"), 1, 0, "C", 1);


// $pdf->SetFillColor(127, 255, 212);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY(86);
// $pdf->SetX(167);
// $pdf->Cell(25, 8, iconv('UTF-8', 'windows-1252', "PRINCIPAL"), 1, 0, "C", 1);


//94

// $reposit = new reposit();
// $resultQueryTelefone = $reposit->RunQuery($sql2);

// $pdf->SetFillColor(255, 182, 193);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY(86);
// $pdf->SetX(14);
// $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "TELEFONE"), 1, 0, "C", 1);

// $pdf->SetFillColor(127, 255, 212);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY(86);
// $pdf->SetX(49);
// $pdf->Cell(25, 8, iconv('UTF-8', 'windows-1252', "PRINCIPAL"), 1, 0, "C", 1);

// $pdf->SetFillColor(144, 238, 144);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY(86);
// $pdf->SetX(74);
// $pdf->Cell(25, 8, iconv('UTF-8', 'windows-1252', "WHATSAPP"), 1, 0, "C", 1);

//se o array de telefone for maior que o do email muda nada
//else $y = $i+17

// $numero = count($resultQueryTelefone);
// $email = count($resultQueryEmail);
// if ($numero > $email) {
//     $i = $i + 17;
// } else {
//     $i = $y + 17;
// }

// $pdf->Line(10, $i, 200, $i);
// $i = $i + 7.5;
// $pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
// $pdf->SetY($i);
// $pdf->SetX(95);
// $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "ENDEREÇO"), 0, 0, "C", 0);

// $i = $i + 14;

// $pdf->SetFillColor(244, 164, 96);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY($i);
// $pdf->SetX(14);
// $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "CEP"), 1, 0, "C", 1);

// $pdf->SetFillColor(244, 164, 96);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY($i);
// $pdf->SetX(50);
// $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "RUA"), 1, 0, "C", 1);

// $pdf->SetFillColor(244, 164, 96);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY($i);
// $pdf->SetX(86);
// $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "BAIRRO"), 1, 0, "C", 1);

// $pdf->SetFillColor(244, 164, 96);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY($i);
// $pdf->SetX(122);
// $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "CIDADE"), 1, 0, "C", 1);

// $pdf->SetFillColor(244, 164, 96);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY($i);
// $pdf->SetX(158);
// $pdf->Cell(17, 8, iconv('UTF-8', 'windows-1252', "UF"), 1, 0, "C", 1);

// $pdf->SetFillColor(244, 164, 96);
// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY($i);
// $pdf->SetX(175);
// $pdf->Cell(17.5, 8, iconv('UTF-8', 'windows-1252', "NÚMERO"), 1, 0, "C", 1);

//         $i = $i + 8;
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(14);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($cep)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(50);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($logradouro)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(86);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($bairro)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(122);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($cidade)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(158);
//         $pdf->Cell(17, 8, iconv('UTF-8', 'windows-1252', trim($uf)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(175);
//         $pdf->Cell(17.5, 8, iconv('UTF-8', 'windows-1252', trim($numero)), 1, 0, "C", 0);




//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(42.3);
//         $pdf->SetX(14.6);
//         $pdf->Cell(10, 3, iconv('UTF-8', 'windows-1252', "CPF:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->Cell(20, 3.8, iconv('UTF-8', 'windows-1252', "$cpf"), 0, 0, "L", 0);

//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(52.5);
//         $pdf->SetX(15);
//         $pdf->Cell(8, 3, iconv('UTF-8', 'windows-1252', "RG:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$rg"), 0, 0, "L", 0);

//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(32.5);
//         $pdf->SetX(75);
//         $pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "GÊNERO:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->Cell(20, 3.5, iconv('UTF-8', 'windows-1252', "$genero"), 0, 0, "L", 0);

//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(43.5);
//         $pdf->SetX(75);
//         $pdf->Cell(31, 0, iconv('UTF-8', 'windows-1252', "ESTADO CIVIL:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetX(105.5);
//         $pdf->Cell(8, 0.5, iconv('UTF-8', 'windows-1252', "$estadoCivil"), 0, 0, "L", 0);

//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(53.5);
//         $pdf->SetX(75);
//         $pdf->Cell(35, 0, iconv('UTF-8', 'windows-1252', "DATA DE NASC.:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY(51);
//         $pdf->SetX(108);
//         $pdf->Cell(3, 5.5, iconv('UTF-8', 'windows-1252', "$data"), 0, 0, "L", 0);

//         // $pdf->SetFillColor(255, 0, 0);
//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(29.5);
//         $pdf->SetX(140);
//         $pdf->Cell(40, 8, iconv('UTF-8', 'windows-1252', "PRIMEIRO EMPREGO:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY(29.4);
//         $pdf->SetX(180);
//         $pdf->Cell(20, 8.3, iconv('UTF-8', 'windows-1252', "$primeiroEmprego"), 0, 0, "L", 0);

//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(41.5);
//         $pdf->SetX(140);
//         $pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "PIS:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY(27.2);
//         $pdf->SetX(150);
//         $pdf->Cell(10, 32.3, iconv('UTF-8', 'windows-1252', "$pispasep"), 0, 0, "L", 0);

//         $pdf->SetFont('Courier', 'B', 11);
//         $pdf->SetY(51.5);
//         $pdf->SetX(140);
//         $pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "ATIVO:"), 0, 0, "L", 0);
//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY(37.5);
//         $pdf->SetX(155);
//         $pdf->Cell(10, 31.3, iconv('UTF-8', 'windows-1252', "Sim"), 0, 0, "L", 0);


//         ////////////////////////////////////////////////////////////////////////////// ENDEREÇO ///////////////////////////////////////////////////////////////////////////////////////////
//         //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//     }


//     $sql4 = "SELECT dependente, dataNascimento, tipoDependente, cpfDependente FROM dbo.dependentes where funcionarioId = $codigo";

//     $reposit = new reposit();
//     $resultQueryDependente = $reposit->RunQuery($sql4);

//     $i = $i + 15;

//     if ($i > 220) {
//         $pdf->AddPage();
//         $i = 25;
//         $pdf->SetX(10);


//         $i = $i + 10;
//         $pdf->Line(9.5, $i, 200, $i); //LINHA DE DEPENDENTE
//         $i = $i + 15.5;
//         $pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
//         $pdf->SetY($i - 35);
//         $pdf->SetX(95);
//         $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "DEPENDENTES"), 0, 0, "C", 0);
//         $pdf->Image('C:\inetpub\wwwroot\Cadastro\img\ntlLogoMarcaDagua.png', 36.5, 80, 135, 145, 'PNG');
//         $pdf->Image('C:\inetpub\wwwroot\Cadastro\img\MarcaNTL.png', 12, 265, 60, 20, 'PNG');

//         //linhas das bordas

//         $pdf->Line(5, 5, 205, 5);
//         $pdf->Line(5, 5, 5, 292);
//         $pdf->Line(205, 5, 205, 292);
//         $pdf->Line(5, 292, 205, 292);

//     } else {

//         $i = $i + 17;
//         $pdf->Line(9.5, $i, 200, $i); //LINHA DE DEPENDENTE
//         $i = $i + 20.5;
//         $pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
//         $pdf->SetY($i - 12);
//         $pdf->SetX(97);
//         $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "DEPENDENTES"), 0, 0, "C", 0);   
//     }

//     $pdf->SetFillColor(102, 205, 170);
//     $pdf->SetFont('Courier', 'B', 11);
//     $pdf->SetY($i);
//     $pdf->SetX(32);
//     $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "DEPENDENTE"), 1, 0, "C", 1);

//     $pdf->SetFillColor(102, 205, 170);
//     $pdf->SetFont('Courier', 'B', 11);
//     $pdf->SetY($i);
//     $pdf->SetX(68);
//     $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "CPF"), 1, 0, "C", 1);

//     $pdf->SetFillColor(102, 205, 170);
//     $pdf->SetFont('Courier', 'B', 11);
//     $pdf->SetY($i);
//     $pdf->SetX(104);
//     $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "DATA DE NASC."), 1, 0, "C", 1);

//     $pdf->SetFillColor(102, 205, 170);
//     $pdf->SetFont('Courier', 'B', 11);
//     $pdf->SetY($i);
//     $pdf->SetX(140);
//     $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', "TIPO DEPENDENTE"), 1, 0, "C", 1);



//     foreach ($resultQueryDependente as $row) {

//         // ------------------ DEPENDENTE ----------------- {
//         $dependente = $row['dependente'];
//         $dataNascimento = $row['dataNascimento'];
//         $tipoDependente = $row['tipoDependente'];
//         $cpfDependente = $row['cpfDependente'];

//         $dataNascimento = explode(" ", $dataNascimento);
//         $dataNascimento = explode("-", $dataNascimento[0]);
//         $dataNascimento = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];

//         $i = $i + 8;

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(32);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($dependente)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(68);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($cpfDependente)), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(104);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim("$dataNascimento")), 1, 0, "C", 0);

//         $pdf->SetFont('Helvetica', '', 10);
//         $pdf->SetY($i);
//         $pdf->SetX(140);
//         $pdf->Cell(36, 8, iconv('UTF-8', 'windows-1252', trim($tipoDependente)), 1, 0, "C", 0);


$pdf->Output();
