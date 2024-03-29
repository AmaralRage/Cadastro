<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");


/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Usuário";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["cadastro"]["sub"]["funcionario"]["active"] = true;

include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Cadastro"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable centerBox">
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Usuário</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form action="javascript:gravar()" class="smart-form client-form" id="formUsuarioFiltro" method="post">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFiltro" class="">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Filtro
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFiltro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label">Nome</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nome" maxlength="50" name="nome" type="text" value="" placeholder="Nome">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">CPF</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="cpf" maxlength="50" name="nome" type="text" value="" placeholder="XXX.XXX.XXX-XX">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Data Nascimento</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="data_Nascimento" name="data_Nascimento" type="text" placeholder="dd/mm/aaaa" data-dateformat="dd/mm/yy" class="datepicker" value="" data-mask="99/99/9999" data-mask-placeholder="_" style="text-align: center" autocomplete="off">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Data Inicio</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="dataInicio" name="dataInicio" type="text" placeholder="dd/mm/aaaa" data-dateformat="dd/mm/yy" class="datepicker" value="" data-mask="99/99/9999" data-mask-placeholder="_" style="text-align: center" autocomplete="off">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Data Final</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="dataFim" name="dataFim" type="text" placeholder="dd/mm/aaaa" data-dateformat="dd/mm/yy" class="datepicker" value="" data-mask="99/99/9999" data-mask-placeholder="_" style="text-align: center" autocomplete="off">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">RG</label>
                                                                <label class="input">
                                                                    <input id="rg" name="rg" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">CEP</label>
                                                                <label class="input">
                                                                    <input id="cep" name="cep" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Gênero</label>
                                                                <label class="input">
                                                                    <input id="genero" name="genero" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Primeiro Emprego</label>
                                                                <label class="input">
                                                                    <input id="primeiroEmprego" name="primeiroEmprego" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label" for="ativo">Ativo</label>
                                                                <label class="select">
                                                                    <select id="ativo" name="ativo">
                                                                        <option></option>
                                                                        <option value="1" selected>Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                            </section>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <footer>
                                                <button id="btnSearch" type="button" class="btn btn-primary pull-right" title="Buscar">
                                                    <span class="fa fa-search"></span>
                                                </button>
                                                    <button id="btnNovo" type="button" class="btn btn-primary pull-left" title="Novo">
                                                        <span class="fa fa-file"></span>
                                                    </button>
                                                    <button id="btnPDF" type="button" class="btn btn-danger pull-left" title="PDF">
                                                        <span class="fa fa-file-pdf-o"></span>
                                                    </button>
                                            </footer>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <div id="resultadoBusca"></div>
                    </div>
            </div>
            </article>
    </div>
    </section>

    <?php if ($condicaoGravarOK) {} ?>
    <!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>
<!--script src="<?php echo ASSETS_URL; ?>/js/businessTabelaBasica.js" type="text/javascript"></script-->
<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- Full Calendar -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>
<!--<script src="/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>-->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/fullcalendar.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>


<script>
    $(document).ready(function() {
        $('#btnSearch').on("click", function() {
            listarFiltro();
        });
        $('#btnNovo').on("click", function() {
            novo();
        });
            $('#btnPDF').on("click", function() {
            PDF();
        });
        $("#cpf").mask('999.999.999-99');
        $("#rg").mask('99.999.999-9');
    });

    function listarFiltro() {
        var nome = $('#nome').val();
        var cpf = $('#cpf').val();
        var rg = $('#rg').val();
        var genero = $('#genero').val();
        var dataInicio = $('#dataInicio').val();
        var dataFim = $('#dataFim').val();
        var ativo = $('#ativo').val();

        $('#resultadoBusca').load('usuarioFiltroListagem.php?', {
            nomeFiltro: nome,
            cpf: cpf,
            rg: rg,
            genero: genero,
            dataInicio: dataInicio,
            dataFim: dataFim,
            ativo: ativo
        });
    }

    function novo() {
        $(location).attr('href', 'funcionarioCadastro.php');
    }
    
    function PDF() {
        $(location).attr('href', 'RelatoriosFuncionario.php');
    }
</script>