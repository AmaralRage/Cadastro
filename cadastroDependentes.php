<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Cadastro/Dependentes";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

$page_nav["tabelaBasica"]["sub"]["dependentes"]["active"] = true;


//include left panel (navigation)
//follow the tree in inc/config.ui.php
include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
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
                            <h2>Dependentes</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formUsuario" method="post">
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
                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label">Descrição de Dependente</label>
                                                                <label class="input">
                                                                    <input id="tipoDependente" maxlength="255" name="tipoDependente" class="required" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="hidden" class="col col-2">
                                                                <label class="label">&nbsp;</label>
                                                                <label class="checkbox ">
                                                                    <input checked="checked" id="dependenteAtivo" name="ativo" type="checkbox" value="true"><i></i>
                                                                    Ativo
                                                                </label>
                                                            </section>
                                                            <section class="hidden" class="col col-1">
                                                                <label class="label">Código</label>
                                                                <label class="input">
                                                                    <input id="codigo" name="codigo" type="text" class="readonly" readonly>
                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FOOTER ABAIXO -->

                                    <?php
                                        $url = explode("?", $_SERVER["REQUEST_URI"]); ////essas linhas fazem a leitura do codigo "id" na url
                                        $codigo = explode("=", $url[1]);
                                        $codigoBtn = (int)$codigo[1];
                                        $esconderBtn = "none";
                                        if ($codigoBtn != 0) {
                                            $esconderBtn = "block";
                                        }
                                        ?>

                                    <footer>
                                        <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtn ?>">
                                            <span class="fa fa-trash"></span>
                                        </button>
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
                                        <button type="button" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar">
                                            <span class="fa fa-floppy-o"> </span>
                                        </button>
                                        <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo" style="display:<?php echo $esconderBtn ?>">
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

<script src="<?php echo ASSETS_URL; ?>/js/businessDependente.js" type="text/javascript"></script>

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

        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                if (!this.options.title) {
                    title.html("&#160;");
                } else {
                    title.html(this.options.title);
                }
            }
        }));

        $('#dlgSimpleExcluir').dialog({
            autoOpen: false,
            width: 400,
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4><i class='fa fa-warning'></i> Atenção</h4></div>",
            buttons: [{
                html: "Excluir registro",
                "class": "btn btn-success",
                click: function() {
                    $(this).dialog("close");
                    excluir();
                }
            }, {
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-default",
                click: function() {
                    $(this).dialog("close");
                }
            }]
        });

        $("#btnExcluir").on("click", function() {
            var id = +$("#codigo").val();

            if (id !== 0) {
                $('#dlgSimpleExcluir').dialog('open');
            }
        });

        $("#btnGravar").on("click", function() {
            dependenteVerificado()
            document.getElementById("btnGravar").disabled = true;
            setTimeout(function() {
                document.getElementById("btnGravar").disabled = false
                gravar();
            }, 1500)            
        });

        $("#btnNovo").on("click", function() {
            novo();
        });

        //ON CHANGES

        $("#dataNascimento").on("change", function() {
            var data = $("#dataNascimento").val();
            validaData(data);
        });

        $("#tipoDependente").on("change", function() {
            var tipoDependente = $('#tipoDependente').val()
            verificaDependente();
        });

        $("#tipoDependente").on("change", function() {
            if (/[0-9\!\#\$\&\*\-\_\/\@\/""\^\~\+\?\.\;\,\:\]\[\(\)]/g.test(this.value)) {
                smartAlert("Atenção", "Dependente Inválido, apenas Letras!", "error");
                $("#tipoDependente").val('');
            }
        })


        $("#cpf").on("change", function() {
            var data = $("#cpf").val();
            validarCPF();
        });

        $("#rg").on("change", function() {
            var data = $("rg").val();
            VerificaRG();
        });

        $("#btnVoltar").on("click", function() {
            voltar();
        });

        $("#cep").on("change", function() {
            //Nova variável "cep" somente com dígitos.
            var cep = $("#cep").val().replace(/\D/g, '');
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#numero").focus();
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            console.log("CEP não encontrado.");
                        }

                    });
                } //end if.
                else {
                    console.log("Formato de CEP inválido.");
                }
            } //end if.
        });

        //MASKS

        $("#cpf").mask('999.999.999-99');
        $("#rg").mask('99.999.999-9');
        $("#telefone").mask('(99) 99999-9999');
        // $("#email").mask('');

        // JSON ABAIXO

        $("#btnAddTelefone").on("click", function() {
            if (validaTelefone())
                addTelefone();
        });

        $("#btnRemoverTelefone").on("click", function() {
            excluiTelefoneTabela();
        });

        $("#btnAddEmail").on("click", function() {
            if (validaEmail())
                addEmail();
        });

        $("#btnRemoverEmail").on("click", function() {
            excluiEmailTabela();
        });
    });

    //FUNCTIONS

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            if (idd !== "") {
                recupera(idd,
                    function(data) {
                        if (data.indexOf('failed') > -1) {
                            return;
                        } else {
                            data = data.replace(/failed/g, '');
                            var piece = data.split("#");
                            var mensagem = piece[0];
                            var out = piece[1];
                            piece = out.split("^");

                            // Atributos de vale transporte unitário que serão recuperados: 
                            var id = piece[0];
                            var ativo = piece[1];
                            var tipoDependente = piece[2];

                            $("#tipoDependente").val(tipoDependente);
                            $("#codigo").val(id);

                            return;

                        }
                    }
                );
            }
        }
        $("#nome").focus();

    }
    
    function verificaDependente() {
        var descricao = $("#tipoDependente").val();
        dependenteVerificado (descricao);
    }

    function novo() {
        $(location).attr('href', 'cadastroDependentes.php');
    }

    function voltar() {
        $(location).attr('href', 'TabelaBasicaDependentesFiltro.php');
    }

    function excluir() {
        var id = $("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }

        excluirDependente(id);
    }

    //CONTINUAR A PARTIR DAQUI



    function gravar() {
        $("#btnGravar")
        var tipoDependente = $("#tipoDependente").val();
        var ativo = 1;
        var codigo = $("#codigo").val();

        if ($("#ativo").is(':checked')) {
            ativo = 1;
        }

        if (tipoDependente == "") {
            smartAlert("Atenção", "Campo de descrição não pode ser vazio!", "error");
            $("#tipoDependente").focus();
            return;
        }
        gravaDependente(codigo, tipoDependente, ativo);
    }
</script>