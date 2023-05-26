<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');


session_start();

$codigo = $_GET['id'];

// $sql = " SELECT codigo as codigoFuncionario, nome, cpf, rg, data_nascimento, ativo, genero, estadoCivil, primeiroEmprego, pispasep,
//                 cep, logradouro, uf, complemento,  numero, bairro, cidade 
//              FROM dbo.funcionarios USU WHERE codigo = $codigo";

$sql = " SELECT F.nome, F.codigo, F.ativo, F.cpf, F.data_Nascimento,F.pispasep, F.estadoCivil, F.estadoCivil, F.primeiroEmprego, F.rg, G.descricao as genero
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
}

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

if ($dataNascimento) {
    $dataNascimento = explode(" ", $dataNascimento);
    $data = explode("-", $dataNascimento[0]);
    $data = ($data[2] . "/" . $data[1] . "/" . $data[0]);
}

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

$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetMargins(5, 10, 5); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
$pdf->AddPage();

$pdf->SetFillColor(220, 220, 220);

$pdf->Line(5, 5, 205, 5);
$pdf->Line(5, 12, 205, 12);
$pdf->Line(5, 5, 5, 292);
$pdf->Line(205, 5, 205, 292);
$pdf->Line(5, 292, 205, 292);


$pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
$pdf->SetY(6);
$pdf->SetX(95);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Relatorio do Funcionário"), 0, 0, "C", 0);
$pdf->Line(12, 12, 200, 12);

$pdf->Cell(3, 35, iconv('UTF-8', 'windows-1252', ""), 0, 0, "C", 0);
// $pdf->Line(19, 19, 200, 19);


$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(20);
$pdf->SetX(15);
$pdf->Cell(13, 3, iconv('UTF-8', 'windows-1252', "NOME:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$nome"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(28);
$pdf->SetX(15);
$pdf->Cell(10, 3, iconv('UTF-8', 'windows-1252', "CPF:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.8, iconv('UTF-8', 'windows-1252', "$cpf"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(36);
$pdf->SetX(15);
$pdf->Cell(8, 3, iconv('UTF-8', 'windows-1252', "RG:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$rg"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(19.5);
$pdf->SetX(75);
$pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "GÊNERO:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 4, iconv('UTF-8', 'windows-1252', "$genero"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(29);
$pdf->SetX(75);
$pdf->Cell(31, 0, iconv('UTF-8', 'windows-1252', "ESTADO CIVIL:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(8, 1, iconv('UTF-8', 'windows-1252', "$estadoCivil"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(37.4);
$pdf->SetX(75);
$pdf->Cell(35, 0, iconv('UTF-8', 'windows-1252', "DATA DE NASCIMENTO:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(37.3);
$pdf->SetX(121);
$pdf->Cell(5, 1, iconv('UTF-8', 'windows-1252', $data), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(19.5);
$pdf->SetX(135);
$pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "PRIMEIRO EMPREGO:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(19.4);
$pdf->SetX(175);
$pdf->Cell(20, 4, iconv('UTF-8', 'windows-1252', "$primeiroEmprego"), 0, 0, "L", 0);

// $pdf->SetFont('Courier', 'B', 11);
// $pdf->SetY(19.5);
// $pdf->SetX(135);
// $pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "PRIMEIRO EMPREGO:"), 0, 0, "L", 0);
// $pdf->SetFont('Helvetica', '', 10);
// $pdf->SetY(19.4);
// $pdf->SetX(175);
// $pdf->Cell(20, 4, iconv('UTF-8', 'windows-1252', "$genero"), 0, 0, "L", 0);




// $pdf->MultiCell(170, 5, iconv('UTF-8', 'windows-1252', "Com a presente, levamos ao seu conhecimento que por motivos de ordem administrativa, estamos dispensando os seus serviços como funcionário desta empresa."), 0, "L");

$pdf->SetFont('Arial', '', 12);
$pdf->SetY(82);
$pdf->SetX(21);
// $pdf->MultiCell(170, 5, iconv('UTF-8', 'windows-1252', "Solicitamos a VSa, que dê seu ciente através de assinatura nas 02 (duas) vias deste aviso e que nos entregue a CTPS para que sejam feitas as devidas anotações."), 0, "J");

$pdf->SetFont('Arial', '', 12);
$pdf->SetY(102);
$pdf->SetX(21);
// $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', "Atenciosamente,"), 0, 0, "", 0);



$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(121);
$pdf->SetX(20);
// $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "NTL Nova Tecnologia "), 0, 0, "c", 0);

$pdf->SetFont('Arial', '', 12);
$pdf->SetY(145);
$pdf->SetX(21);
// $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Opção de cumprimento de aviso prévio:"), 0, 0, "L", 0);




$pdf->Output();
