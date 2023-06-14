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


$pdf->Line(10, 85.1, 200, 85.1);



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
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "INFORMAÇÕES"), 0, 0, "C", 0);



$sql = "SELECT DISTINCT F.codigo AS funcionario, F.nome, F.codigo, F.ativo, F.cpf, F.data_Nascimento, F.estadoCivil, F.pispasep,
                        F.primeiroEmprego, F.cep, F.logradouro, F.bairro, F.numero, F.complemento,
                        F.uf, F.cidade, F.rg, TF.telefone, EF.email, G.descricao as genero
                        FROM dbo.funcionarios F
                        LEFT JOIN dbo.genero G on F.genero = G.codigo
                        LEFT JOIN dbo.telefone TF ON TF.funcionarioId = F.codigo
                        LEFT JOIN dbo.email EF ON EF.funcionarioId = F.codigo
                        WHERE TF.principal = 1 AND EF.emailPrincipal = 1";


$reposit = new reposit();
$result = $reposit->RunQuery($sql);
$resultQueryTelefone = $reposit->RunQuery($sql);
$resultQueryEmail = $reposit->RunQuery($sql);
foreach ($result as $row) {
    $nome = $row['nome'];
    $cpf = $row['cpf'];
    $rg =  $row['rg'];
    $dataNascimento = $row['data_Nascimento'];
    $ativo = $row['ativo'];
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
    $telefone = $row['telefone'];
    $email = $row['email'];

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

    if ($contador) {
    } else {
        $contador = "Nenhum";
    }

    if ($dataNascimento) {
        $dataNascimento = explode(" ", $dataNascimento);
        $data = explode("-", $dataNascimento[0]);
        $data = ($data[2] . "/" . $data[1] . "/" . $data[0]);
    }

    $sql2 = "SELECT codigo FROM dbo.dependentes where funcionario = $codigo";
    $reposit = new reposit();
    $resultQuery = $reposit->RunQuery($sql2);
    $contador = 0;

    foreach ($resultQuery as $row) {

        if ($contador) {
            $contador = $contador + 1;
        } else {
            $contador = "Nenhum";
        }
    }

    $i = $i + 15;


    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(32.5);
    $pdf->SetX(15); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(13, 3, iconv('UTF-8', 'windows-1252', "NOME:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$nome"), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(42);
    $pdf->SetX(15); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(10, 3, iconv('UTF-8', 'windows-1252', "CPF:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(11, 3.6, iconv('UTF-8', 'windows-1252', $cpf), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(51.5);
    $pdf->SetX(15); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(10, 3, iconv('UTF-8', 'windows-1252', "RG:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(16, 3.6, iconv('UTF-8', 'windows-1252', $rg), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(62);
    $pdf->SetX(15); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(17, 3, iconv('UTF-8', 'windows-1252', "GÊNERO:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $genero), 0, 0, "L", 0);


    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(72);
    $pdf->SetX(15); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(22, 3, iconv('UTF-8', 'windows-1252', "TELEFONE:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $telefone), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(42);
    $pdf->SetX(70); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(32, 3, iconv('UTF-8', 'windows-1252', "ESTADO CIVIL:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $estadoCivil), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(51.5);
    $pdf->SetX(70); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(42, 3, iconv('UTF-8', 'windows-1252', "PRIMEIRO EMPREGO:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $primeiroEmprego), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(61.5);
    $pdf->SetX(70); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(20, 3, iconv('UTF-8', 'windows-1252', "PISPASEP:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $pispasep), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(72);
    $pdf->SetX(70); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(16, 3, iconv('UTF-8', 'windows-1252', "EMAIL:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $email), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(42);
    $pdf->SetX(140); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(27, 3, iconv('UTF-8', 'windows-1252', "DATA NASC.:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $data), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(52);
    $pdf->SetX(140); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(19, 3, iconv('UTF-8', 'windows-1252', "CIDADE:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $cidade), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(62);
    $pdf->SetX(140); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(22, 3, iconv('UTF-8', 'windows-1252', "ENDEREÇO:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', $logradouro), 0, 0, "L", 0);

    $pdf->SetFont('Courier', 'B', 11);
    $pdf->SetY(72);
    $pdf->SetX(140); // TAMANHO EM X, TAMANHO EM Y    HABILITAR CAXA //// ORIENTAÇÃO // COR
    $pdf->Cell(29, 3, iconv('UTF-8', 'windows-1252', "DEPENDENTES:"), 0, 0, "L", 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 3, iconv('UTF-8', 'windows-1252', $contador), 0, 0, "L", 0);
}

$pdf->Output();
