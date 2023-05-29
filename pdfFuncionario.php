<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');


session_start();

$codigo = $_GET['id'];

// $sql = " SELECT codigo as codigoFuncionario, nome, cpf, rg, data_nascimento, ativo, genero, estadoCivil, primeiroEmprego, email,
//                 cep, logradouro, uf, complemento,  numero, bairro, cidade 
//              FROM dbo.funcionarios USU WHERE codigo = $codigo";

$sql = " SELECT F.nome, F.codigo, F.ativo, F.cpf, F.data_Nascimento,F.pispasep, F.estadoCivil, F.pispasep, F.primeiroEmprego, F.rg, G.descricao as genero
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


$sql2 = "SELECT telefone, whatsapp, principal FROM dbo.telefone WHERE funcionarioId = $codigo";
$reposit = new reposit();
$result = $reposit->RunQuery($sql2);

$reposit = new reposit();
$result = $reposit->RunQuery($sql);
foreach ($result as $row) {
    $telefone = $row['telefone'];
    $principal = $row['principal'];
    $whatsapp =  $row['whatsapp'];
}

$jsonTelefone = json_encode($arrayTelefone);


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
// $pdf->Line(12, 12, 200, 12);

$pdf->Cell(3, 35, iconv('UTF-8', 'windows-1252', ""), 0, 0, "C", 0);
// $pdf->Line(19, 19, 200, 19);

$pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
$pdf->SetY(16);
$pdf->SetX(95);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "INFORMAÇÕES DO FUNCIONÁRIO"), 0, 0, "C", 0);
$pdf->Line(9.5, 25, 200, 25);


$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(32.5);
$pdf->SetX(15);
$pdf->Cell(13, 3, iconv('UTF-8', 'windows-1252', "NOME:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$nome"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(42.3);
$pdf->SetX(14.6);
$pdf->Cell(10, 3, iconv('UTF-8', 'windows-1252', "CPF:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.8, iconv('UTF-8', 'windows-1252', "$cpf"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(52.5);
$pdf->SetX(15);
$pdf->Cell(8, 3, iconv('UTF-8', 'windows-1252', "RG:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.6, iconv('UTF-8', 'windows-1252', "$rg"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(32.5);
$pdf->SetX(75);
$pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "GÊNERO:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(20, 3.5, iconv('UTF-8', 'windows-1252', "$genero"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(43.5);
$pdf->SetX(75);
$pdf->Cell(31, 0, iconv('UTF-8', 'windows-1252', "ESTADO CIVIL:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetX(105.5);
$pdf->Cell(8, 0.5, iconv('UTF-8', 'windows-1252', "$estadoCivil"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(53.5);
$pdf->SetX(75);
$pdf->Cell(35, 0, iconv('UTF-8', 'windows-1252', "DATA DE NASC.:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(51);
$pdf->SetX(108);
$pdf->Cell(3, 5.5, iconv('UTF-8', 'windows-1252', $data), 0, 0, "L", 0);

// $pdf->SetFillColor(255, 0, 0);
$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(29.5);
$pdf->SetX(140); // TAMANHO EM X, TAMANHO EM Y                        HABILITAR CAXA    //       //ORIENTAÇÃO    //COR
$pdf->Cell(40, 8, iconv('UTF-8', 'windows-1252', "PRIMEIRO EMPREGO:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(29.4);
$pdf->SetX(180);
$pdf->Cell(20, 8.3, iconv('UTF-8', 'windows-1252', "$primeiroEmprego"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(41.5);
$pdf->SetX(140);
$pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "PIS:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(27.2);
$pdf->SetX(150);
$pdf->Cell(10, 32.3, iconv('UTF-8', 'windows-1252', "Nenhum"), 0, 0, "L", 0);

$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(51.5);
$pdf->SetX(140);
$pdf->Cell(17.5, 3, iconv('UTF-8', 'windows-1252', "ATIVO:"), 0, 0, "L", 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(37.5);
$pdf->SetX(155);
$pdf->Cell(10, 31.3, iconv('UTF-8', 'windows-1252', "Sim"), 0, 0, "L", 0);

$pdf->Line(9.5, 62.9, 200, 62.9);

$pdf->SetFont($tipoDeFonte, 'B', $tamanhoFonte);
$pdf->SetY(68.5);
$pdf->SetX(95);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "CONTATO"), 0, 0, "C", 0);
$pdf->Line(9.5, 79, 200, 79);

$pdf->SetFillColor(144, 238, 144);
$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(90);
$pdf->SetX(37);
$pdf->Cell(45, 8, iconv('UTF-8', 'windows-1252', "TELEFONE"), 1, 0, "C", 1);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(98);
$pdf->SetX(37);
$pdf->Cell(45, 8.6, iconv('UTF-8', 'windows-1252', $telefone), 1, 0, "C", 0);

$pdf->SetFillColor(240, 230, 140);
$pdf->SetFont('Courier', 'B', 11);
$pdf->SetY(90);
$pdf->SetX(120);
$pdf->Cell(45, 8, iconv('UTF-8', 'windows-1252', "EMAIL"), 1, 0, "C", 1);
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetY(98);
$pdf->SetX(120);
$pdf->Cell(45, 8.6, iconv('UTF-8', 'windows-1252', "NÚMERO"), 1, 0, "C", 0);
















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