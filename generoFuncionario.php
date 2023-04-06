<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Funcionario";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

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
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false" style="">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Usuário</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form action="javascript:gravar()" class="smart-form client-form" id="formUsuario" method="post">
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
                                                    <section class="hidden" class="col col-2">
                                                                <label class="label">&nbsp;</label>
                                                                <label id="labelAtivo" class="checkbox ">
                                                                    <input checked="checked" id="ativo" name="ativo" type="checkbox" value="true"><i></i>
                                                                    Ativo
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Gênero</label>
                                                                <label class="input">
                                                                    <input id="genero" maxlength="255" name="genero" class="required" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <label class="label " for="projeto" style="text-align: center;font-size: 23px;font-weight: bold;margin-top: 10px;">Projeto</label>
                                                            <label class="select projetoTf">
                                                                <select id="projeto" name="projeto" class="projetoTf" disabled style="text-align: center;" value="" onchange="projetoMudar()">
                                                                    <option></option>
                                                                    <?php
                                                                    $reposit = new reposit();
                                                                    $sql = "SELECT codigo, genero FROM dbo.funcionarios BP 
                                                                                WHERE ativo = 1 order by genero";
                                                                    $result = $reposit->RunQuery($sql);
                                                                    foreach ($result as $row) {
                                                                        $id = $row['codigo'];
                                                                        $genero = $row['genero'];
                                                                        echo '<option value=' . $id . '>' . $genero . ' </option>';
                                                                    }
                                                                    ?>
                                                                </select><i></i>
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <footer>
                                                                <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir">
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
                                                                <button type="submited" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar">
                                                                    <span class="fa fa-floppy-o"></span>
                                                                </button>
                                                                <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo">
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

<script src="<?php echo ASSETS_URL; ?>/js/businessGeneroFuncionario.js" type="text/javascript"></script>

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
            var id = +$("#codigo").val();

            gravar()

            if (id !== 0) {
                $('#dlgSimpleExcluir').dialog('open');
            }
        });

        $("#btnNovo").on("click", function() {
            novo();
        });

        $("#dataNascimento").on("change", function() {
            var data = $("#dataNascimento").val();
            validaData(data);
        });

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

        $("#cpf").mask('999.999.999-99');
        $("#rg").mask('99.999.999-9');
    });



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
                            var genero = piece[1];

                            //Associa as varíaveis recuperadas pelo javascript com seus respectivos campos html.
                            $("#codigo").val(id);
                            $("#genero").val(genero);

                            return;

                        }
                    }
                );
            }
        }
        $("#nome").focus();

    }

    // function VerificaRG() {
    //     var rg = $("#rg").val();
    //     RGverificado(rg);
    //     return;
    // }

    function novo() {
        $(location).attr('href', 'usuarioCadastro.php');
    }

    function voltar() {
        $(location).attr('href', 'usuarioFiltro.php');
    }

    function excluir() {
        var id = +$("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }

        excluirUsuario(id);
    }

    // function idade(dia, mes, ano) {
    // return new Date().getFullYear() - ano;
    // }

    // idade(11, 12, 1980); //  33
    // idade(15, 2, 2011);  // 2
    // idade(5, 31, 1993);  // 20

    // function getAge(dateString) {
    //     const today = new Date();
    //     const birthDate = new Date(dateString);
    //     let age = today.getFullYear() - birthDate.getFullYear();
    //     const m = today.getMonth() - birthDate.getMonth();

    //     if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    //         age--;
    //     }

    //     return age;
    // }

    //CONTINUAR A PARTIR DAQUI

    // function validaData(data) {
    //     var data = document.getElementById("dataNascimento").value; // pega o valor do input
    //     data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
    //     var data_array = data.split("-"); // quebra a data em array

    //     // para o IE onde será inserido no formato dd/MM/yyyy
    //     if (data_array[0].length != 4) {
    //         data = data_array[2] + "-" + data_array[1] + "-" + data_array[0];
    //     }

    //     // compara as datas e calcula a idade
    //     var hoje = new Date();
    //     var nasc = new Date(data);
    //     var idade = hoje.getFullYear() - nasc.getFullYear();
    //     var m = hoje.getMonth() - nasc.getMonth();
    //     if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) idade--;

    //     if (idade <= 14) {
    //         smartAlert("Atenção", "Informe a data correta", "error");
    //         $("#idade").val(idade)
    //         $("#btnGravar").prop('disabled', false);
    //         return false;

    //     }

    //     if (idade >= 18 && idade <= 95) {
    //         smartAlert("Atenção", "A Data está Correta !", "success");
    //         $("#idade").val(idade)
    //         $("#btnGravar").prop('disabled', false);
    //         return;
    //     }
    //     if (hoje)
    //         //se for maior que 60 não vai acontecer nada!
    //         return false;

    // }

    // function validarCPF() {
    // var id = +($("#codigo").val());
    // var cpf = $("#cpf").val();

    // validaCPF(cpf);
    // }




    function gravar() {
        var id = +($("#codigo").val());
        var ativo = 0;
        if ($("#ativo").is(':checked')) {
            ativo = 1;
        }
        var genero = $("#genero").val();

        if (!genero) {
            smartAlert("Atenção", "Informe seu genero", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        gravaGenero(id, ativo, genero);
    }
</script>