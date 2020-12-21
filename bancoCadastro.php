<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");
$condicaoAcessarOK = (in_array('BANCO_ACESSAR', $arrayPermissao, true));
$condicaoGravarOK = (in_array('BANCO_GRAVAR', $arrayPermissao, true));
$condicaoExcluirOK = (in_array('BANCO_EXCLUIR', $arrayPermissao, true));

if ($condicaoAcessarOK == false) {
    unset($_SESSION['login']);
    header("Location:login.php");
}

$esconderBtnGravar = "";
if ($condicaoGravarOK === false) {
    $esconderBtnGravar = "none";
}

$esconderBtnExcluir = "";
if ($condicaoExcluirOK === false) {
    $esconderBtnExcluir = "none";
}

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Banco";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["tabelaBasica"]["sub"]["banco"]["active"] = true;

include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Tabela Básica"] = "";
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
                            <h2>Banco</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formBanco" method="post">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseCadastro" class="" id="accordionCadastro">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Cadastro
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseCadastro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <input id="codigo" name="codigo" type="text" class="hidden">

                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label">Código do Banco </label>
                                                                <label class="input">
                                                                    <input id="codigoBanco" name="codigoBanco" type="text" autocomplete="new-password" maxlength="10">
                                                                </label>
                                                            </section>
                                                            <section class="col col-6">
                                                                <label class="label">Nome do banco</label>
                                                                <label class="input">
                                                                    <input id="nomeBanco" name="nomeBanco" type="text" autocomplete="new-password" maxlength="100">
                                                                </label>
                                                            </section>

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer>
                                        <!-- <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtnExcluir ?>">
                                            <span class="fa fa-trash"></span>
                                        </button> -->
                                        <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable" tabindex="-1" role="dialog" aria-describedby="dlgSimpleExcluir" aria-labelledby="ui-id-1" style="height: auto; width: 600px; top: 220px; left: 262px; display: none;">
                                            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                                                <span id="ui-id-2" class="ui-dialog-title">
                                                </span>
                                            </div>
                                            <div id="dlgSimpleExcluir" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 0px; max-height: none; height: auto;">
                                                <p>CONFIRMA A EXCLUSÃO ? </p>
                                            </div>
                                            <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                                                <div class="ui-dialog-buttonset">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar" style="display:<?php echo $esconderBtnGravar ?>">
                                            <span class="fa fa-floppy-o"></span>
                                        </button>
                                        <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo" style="display:<?php echo $esconderBtnGravar ?>">
                                            <span class="fa fa-file-o"></span>
                                        </button>
                                        <button type="button" id="btnVoltar" class="btn btn-default" aria-hidden="true" title="Voltar">
                                            <span class="fa fa-backward "></span>
                                        </button>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
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

<script src="<?php echo ASSETS_URL; ?>/js/businessBanco.js" type="text/javascript"></script>

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
<!--<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>-->


<!-- Form to json -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/form2js.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/jquery.toObject.js"></script>


<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        carregaPagina();

        $("#btnGravar").on("click", function() {
            gravar();
        });
        $("#btnNovo").on("click", function() {
            novo();
        });
        $("#btnExcluir").on("click", function() {
            excluir();
        });
        $("#btnVoltar").on("click", function() {
            voltar();
        });
        $("#municipioNascimento").on("change", function() {
            let valor = $("#municipioNascimento option:selected").val();
            $("#numeroMunicipio").val(valor);
        });

        $("#ufNascimento").on("change", function() {
            let valor = $("#ufNascimento option:selected").text();
            if (valor != "EX.") {

                $("#numeroMunicipio").val(" ");
                $("#naturalidade").val(" ");
                const comboMunicipio = document.getElementById("municipioNascimento");
                let campoMunicipio = document.createElement("option");
                while (comboMunicipio.length > 0) {
                    comboMunicipio.remove(0);
                }
                comboMunicipio.add(campoMunicipio);
                getMunicipioPorUf();
                getSiglaUf();

            }
        });


        $("#paisNascimento").on("change", function() {
            let valor = $("#paisNascimento").val();
            $("#numeroPais").val(valor);

            if (valor != 105) { //Código do Brasil

                $("#nacionalidade").val("EX.");
                $("#naturalidade").val("EX.");

                //Limpa tudo da combo de Município e atribui EX. pra ela.
                const comboMunicipio = document.getElementById("municipioNascimento");
                let campoMunicipio = document.createElement("option");
                while (comboMunicipio.length > 0) {
                    comboMunicipio.remove(0);
                }
                campoMunicipio.text = "EX."
                campoMunicipio.value = "EX."
                comboMunicipio.add(campoMunicipio);
                comboMunicipio.selectedIndex = "0";
                $("#numeroMunicipio").val(campoMunicipio.value);

                const comboUf = document.getElementById("ufNascimento");
                let campoUf = document.createElement("option");
                while (comboUf.length > 0) {
                    comboUf.remove(0);
                }
                campoUf.text = "EX."
                campoUf.value = "EX."
                comboUf.add(campoUf);
                comboUf.selectedIndex = "0";


            } else {

                $("#nacionalidade").val("Brasil");
                $("#naturalidade").val("");
                $("#municipioNascimento").val("");
                $("#numeroMunicipio").val("");
                const comboUf = document.getElementById("ufNascimento");
                let campoUf = document.createElement("option");
                for (var i = 0; i < comboUf.length; i++) {
                    if (comboUf.options[i].value == 'EX.')
                        comboUf.remove(i);
                }
                comboUf.add(campoUf);
                getUf();
            }
        });

    });




    function gravar() {
        let banco = $('#formBanco').serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        gravaBanco(banco,
            function(data) {
                if (data.indexOf('sucess') < 0) {
                    var piece = data.split("#");
                    var mensagem = piece[1];
                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                        return false;
                    } else {
                        smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR !", "error");
                        return false;
                        //                                                            return;
                    }
                } else {
                    var piece = data.split("#");
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                    novo();
                }
            }
        );
    }


    function novo() {
        $(location).attr('href', 'bancoCadastro.php');
    }

    function voltar() {
        $(location).attr('href', 'tabelaBasica_bancoFiltro.php');
    }

    function excluir() {
        var id = +$("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }

        excluirBanco(id, function(data) {
            if (data.indexOf('failed') > -1) {
                var piece = data.split("#");
                var mensagem = piece[1];

                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }
                voltar();
            } else {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                voltar();
            }
        });
    }

    /*Funções que vão até o IBGE */
    async function getUf() {
        const api_ibge_url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/';
        const resposta = await fetch(api_ibge_url);
        const data = await resposta.json(); //Transforma os dados em JSON
        const comboUf = document.getElementById("ufNascimento");

        for (let i in data) { // Para cada linha em JSON, é criado uma nova opção na combo ufNascimento.

            let campoUf = document.createElement("option");
            campoUf.text = data[i].nome;
            campoUf.value = data[i].id;
            comboUf.add(campoUf);
        }

        sortSelect(comboUf); //Arruma o select em ordem alfabética

    }

    async function getMunicipioPorUf() {

        let valor = $("#ufNascimento option:selected").val();
        const api_municipioPorUf_ibge_url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/" + valor + "/municipios";
        const resposta = await fetch(api_municipioPorUf_ibge_url);
        const data = await resposta.json();
        const comboMunicipio = document.getElementById("municipioNascimento");

        for (let i in data) { // Para cada linha em JSON, é criado uma nova opção na combo municipioNascimento.

            let campoMunicipio = document.createElement("option");
            campoMunicipio.text = data[i].nome;
            campoMunicipio.value = data[i].id;
            comboMunicipio.add(campoMunicipio);
        }

        sortSelect(comboMunicipio); //Arruma o select em ordem alfabética
    }


    async function getSiglaUf() {
        let valor = $("#ufNascimento option:selected").val();
        const api_ibge_url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/" + valor;
        const resposta = await fetch(api_ibge_url);
        const data = await resposta.json();

        console.log(data);
        let sigla = data.sigla;
        $("#naturalidade").val(sigla);

    }


    function sortSelect(selElem) {
        var tmpAry = new Array();
        for (var i = 0; i < selElem.options.length; i++) {
            tmpAry[i] = new Array();
            tmpAry[i][0] = selElem.options[i].text;
            tmpAry[i][1] = selElem.options[i].value;
        }
        tmpAry.sort();
        while (selElem.options.length > 0) {
            selElem.options[0] = null;
        }
        for (var i = 0; i < tmpAry.length; i++) {
            var op = new Option(tmpAry[i][0], tmpAry[i][1]);
            selElem.options[i] = op;
        }
        return;
    }

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            debugger;
            if (idd !== "") {
                recuperaBanco(idd,
                    function(data) {
                        if (data.indexOf('failed') > -1) {} else {
                            data = data.replace(/failed/g, '');
                            var piece = data.split("#");
                            var mensagem = piece[0];
                            var out = piece[1];

                            piece = out.split("^");
                            codigo = piece[0];
                            codigoBanco = piece[1];
                            nomeBanco = piece[2];

                            $("#codigo").val(codigo);
                            $("#codigoBanco").val(codigoBanco);
                            $("#nomeBanco").val(nomeBanco);

                        }
                    }
                );
            }
        }
    }
</script>