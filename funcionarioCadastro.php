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
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Usuário</h2>
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
                                                            <section class="hidden" class="col col-1">
                                                                <label class="label">Código</label>
                                                                <label class="input">
                                                                    <input id="codigo" name="codigo" type="text" class="readonly" readonly>
                                                                </label>
                                                            </section>
                                                            <section class="hidden" class="col col-2">
                                                                <label class="label">&nbsp;</label>
                                                                <label id="labelAtivo" class="checkbox ">
                                                                    <input checked="checked" id="ativo" name="ativo" type="checkbox" value="true"><i></i>
                                                                    Ativo
                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label">Nome</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nome" maxlength="255" name="nome" class="required" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">CPF</label>
                                                                <label class="input">
                                                                    <input id="cpf" name="senha" type="text" class="required" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">RG</label>
                                                                <label class="input">
                                                                    <input id="rg" name="rg" type="text" class="required" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Gênero</label>
                                                                <label class="select">
                                                                    <select id="descricao" name="descricao">
                                                                        <option>Todos</option>
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo,descricao, generoAtivo
                                                                        FROM dbo.genero where generoAtivo = 1 ORDER BY codigo";
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach ($result as $row) {
                                                                            $codigo = $row['codigo'];
                                                                            $descricao = $row['descricao'];
                                                                            echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Estado Civil</label>
                                                                <label class="select">
                                                                    <select id="estadoCivil" name="estadoCivil">
                                                                        <option value="1" selected>Solteiro(a)</option>
                                                                        <option value="2">Casado(a)</option>
                                                                        <option value="3">Divorciado(a)</option>
                                                                        <option value="4">Separado(a)</option>
                                                                        <option value="5">Viúvo(a)</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">Data Nascimento</label>
                                                                <label class="input">
                                                                    <i class="icon-append fa fa-calendar"></i>
                                                                    <input id="dataNascimento" name="dataNascimento" type="text" placeholder="dd/mm/aaaa" data-dateformat="dd/mm/yy" class="datepicker required" value="" data-mask="99/99/9999" data-mask-placeholder="_" style="text-align: center" autocomplete="off">
                                                                </label>
                                                            </section>
                                                            <section class="col col-1">
                                                                <label class="label">Idade</label>
                                                                <label class="input">
                                                                    <input id="idade" maxlength="255" class="readonly" readonly name="idade" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <!-- <section class="col col-1">
                                                            <label for="cor">Cor Favorita</label>
                                                            <br>
                                                            <input type='color' id='CorFavorita' name='cor'>
                                                            </section> -->
                                                            <!-- <section class="col col-2 col-auto">
                                                                <label class="label " for="Cargo">Cargo</label>
                                                                <label class="input">
                                                                    <input type="text" class="required" id="Cargo">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Possui filhos ?</label>
                                                                <label class="select">
                                                                    <select id="possuiFilhos" name="possuiFilhos">
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section> -->

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseContato" class="" id="accordionContato">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Contatos
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseContato" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">

                                                    <fieldset>
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-sm-6 required">
                                                            <input id="telefoneId" name="telefoneId" type="hidden" value="">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneWhatsApp" name="descricaoTelefoneWhatsApp" type="hidden" value="">
                                                            <input id="descricaoTelefoneCorporativo" name="descricaoTelefoneCorporativo" type="hidden" value="">
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <section class="col col-md-3">
                                                                        <label class="label">Telefone</label>
                                                                        <label class="input"><i class="icon-prepend fa fa-phone"></i>
                                                                            <input id="telefone" name="telefone" type="text" class="form-control required" value="">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-md-2">
                                                                        <label class="label">&nbsp;</label>
                                                                        <label class="checkbox ">
                                                                            <input id="telefonePrincipal" name="telefonePrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                            Principal
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-md-2">
                                                                        <label class="label">&nbsp;</label>
                                                                        <label class="checkbox">
                                                                            <input id="telefoneWhatsApp" name="telefoneWhatsApp" type="checkbox" value="true" checked="checked"><i></i>
                                                                            WhatsApp
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-md-3">
                                                                        <label class="label">&nbsp;</label>
                                                                        <button id="btnAddTelefone" type="button" class="btn btn-primary">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <button id="btnRemoverTelefone" type="button" class="btn btn-danger">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width:90%; border: 1px solid #ddd;">
                                                                <table id="tableTelefone" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th></th>
                                                                            <th class="text-left" style="min-width: 500%;">Telefone</th>
                                                                            <th class="text-left">Principal</th>
                                                                            <th class="text-left">WhatsApp</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="formTelefone" class="col-sm-6">
                                                            <input id="TelefoneId" name="TelefoneId" type="hidden" value="">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneCorporativo" name="descricaoTelefoneCorporativo" type="hidden" value="">
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <section class="col col-md-6">
                                                                        <label class="label">Email</label>
                                                                        <label class="input"><i class="icon-prepend fa fa-at"></i>
                                                                            <input id="email" maxlength="50" name="email" type="text" class="required" value="">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-md-2">
                                                                        <label class="label">&nbsp;</label>
                                                                        <label class="checkbox ">
                                                                            <input id="emailPrincipal" name="emailPrincipal" type="checkbox" value="true" checked><i></i>
                                                                            Principal
                                                                        </label>
                                                                    </section>
                                                                    <!-- <section class="col col-md-2">
                                                                        <label class="label">&nbsp;</label>
                                                                        <label class="checkbox ">
                                                                            <input id="TelefoneCorporativo" name="TelefoneCorporativo" type="checkbox" value="false"><i></i>
                                                                            Corporativo
                                                                        </label>
                                                                    </section> -->
                                                                    <section class="col col-auto">
                                                                        <label class="label">&nbsp;</label>
                                                                        <button id="btnAddTelefone" type="button" class="btn btn-primary">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <button id="btnRemoverEmail" type="button" class="btn btn-danger">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px; width:90%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableEmail" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th></th>
                                                                            <th class="text-left" style="min-width: 100px;">Email</th>
                                                                            <th class="text-left">Principal</th>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                </div>
                                                </fieldset>
                                            </div>

                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <!-- ACCORDION ACIMA -->


                                    <!-- FOOTER ABAIXO -->

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

<script src="<?php echo ASSETS_URL; ?>/js/businessFuncionario.js" type="text/javascript"></script>

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

        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());

        carregaPagina();
        carregaTelefone();

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

        //ON CHANGES

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

        //MASKS

        $("#cpf").mask('999.999.999-99');
        $("#rg").mask('99.999.999-9');
        $("#telefone").mask('(99) 99999-9999');

        // JSON ABAIXO

        $("#btnAddTelefone").on("click", function() {
            if (validaTelefone())
                addTelefone();
        });

        $("#btnRemoverTelefone").on("click", function() {
            excluiTelefoneTabela();
        });
    });

    //FUNCTIONS

    function validaTelefone() {
        var achouTelefone = false;
        var limiteFuncionario = false;
        var departamentoId = +$('#departamentoProjetoId').val();
        var sequencial = +$('#sequencialTelefone').val();
        var funcionariosTelefone = +$("#funcionarioSimultaneosTelefone").val();
        var funcionarios = +$("#funcionarioSimultaneos").val();

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (departamentoId !== "") {
                if ((jsonTelefoneArray[i].departamentoProjetoId === departamentoId) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achouTelefone = true;
                    break;
                }
            }
        }

        if (achouTelefone === true) {
            smartAlert("Erro", "Já existe um Departamento na lista.", "error");
            $('#departamentoProjeto').val("");
            return false;
        }

        //-------------------------------- Validação de funcionarios da Telefone -----------------------------------
        //OBS:O numero de funcionarios por projeto não pode passar o numero de funcionarios simultaneos da Telefone

        for (i = jsonTelefoneArray.length; i >= 0; i--) {
            if (funcionariosTelefone < funcionarios) {
                limiteFuncionario = true;
                $("#funcionarioSimultaneos").val('');
                break;
            }
        }

        if (limiteFuncionario === true) {
            smartAlert("Atenção", `A Telefone tem o limite de ${funcionariosTelefone} funcionarios simultaneos`, "warning");
            return false;
        }
        //------------------------------------------------------------------------------------------

        return true;
    }


    function addTelefone() {

        var telefone = $("#telefone").val();
        if (telefone === "") {
            smartAlert("Atenção", "Informe o Telefone !", "error");
            $("#telefone").focus();
            return;
        }

        var item = $("#formTelefone").toObject({
            mode: 'combine',
            skipEmpty: false
        });

        if (item["sequencialTelefone"] === '') {
            if (jsonTelefoneArray.length === 0) {
                item["sequencialTelefone"] = 1;
            } else {
                item["sequencialTelefone"] = Math.max.apply(Math, jsonTelefoneArray.map(function(o) {
                    return o.sequencialTelefone;
                })) + 1;
            }
            item["TelefoneId"] = 0;
        } else {
            item["sequencialTelefone"] = +item["sequencialTelefone"];
        }

        if (item["telefonePrincipal"]) {
            item["descricaoTelefonePrincipal"] = "Sim"
        } else {
            item["descricaoTelefonePrincipal"] = "Não"
        }
        
        if (item["telefoneWhatsApp"]) {
            item["descricaoTelefoneWhatsApp"] = "Sim"
        } else {
            item["descricaoTelefoneWhatsApp"] = "Não"
        } 

        // linha de sinalização dos if e else 

        var index = -1;
        $.each(jsonTelefoneArray, function(i, obj) {
            if (+$('#sequencialTelefone').val() === obj.sequencialTelefone) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonTelefoneArray.splice(index, 1, item);
        else
            jsonTelefoneArray.push(item);

        $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));

        fillTableTelefone();
        clearFormTelefone();
    }

    function fillTableTelefone() {
        $("#tableTelefone tbody").empty();
        for (var i = 0; i < jsonTelefoneArray.length; i++) {
            var row = $('<tr />');

            $("#tableTelefone tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonTelefoneArray[i].sequencialTelefone + '"><i></i></label></td>'));


            row.append($('<td class="text-left" onclick="carregaTelefone(' + jsonTelefoneArray[i].sequencialTelefone + ');">' + jsonTelefoneArray[i].telefone + '</td>'));
            // row.append($('<td class="text-left" >' + jsonTelefoneArray[i].telefone + '</td>'));
            row.append($('<td class="text-left" >' + jsonTelefoneArray[i].descricaoTelefonePrincipal + '</td>'));
            row.append($('<td class="text-left" >' + jsonTelefoneArray[i].descricaoTelefoneWhatsApp + '</td>'));


        }
    }

    function clearFormTelefone() {
        $("#telefone").val('');
        $("#sequencialTelefone").val('');
        $("#telefonePrincipal").prop('checked', false);
        $("#telefoneWhatsApp").prop('checked', false);
    }

    function excluiTelefoneTabela() {
        var arrSequencial = [];
        $('#tableTelefone input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
                var obj = jsonTelefoneArray[i];
                if (jQuery.inArray(obj.sequencialTelefone, arrSequencial) > -1) {
                    jsonTelefoneArray.splice(i, 1);
                }
            }
            $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
            fillTableTelefone();
        } else
            smartAlert("Erro", "Selecione pelo menos um Projeto para excluir.", "error");
    }

    function carregaTelefone(sequencialTelefone) {
        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTelefone === sequencialTelefone);
        });
        if (arr.length > 0) {
            var item = arr[0];

            $("#telefone").val(item.telefone);
            $("#sequencialTelefone").val(item.sequencialTelefone);

            if ($("#telefonePrincipal").is(':checked')) {
                item["telefonePrincipal"] = true;
            } else {
                item["telefonePrincipal"] = false;
            }
            $("#telefonePrincipal").val(item.telefonePrincipal);
            $("#telefoneWhatsApp").val(item.telefoneWhatsApp);
        }
    }

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
                            var nome = piece[2];
                            var cpf = piece[4];
                            var rg = piece[5];
                            var dataNascimento = piece[6];
                            var genero = piece[7];

                            //Associa as varíaveis recuperadas pelo javascript com seus respectivos campos html.
                            $("#codigo").val(id);
                            $("#cpf").val(cpf);
                            $("#nome").val(nome);
                            $("#dataNascimento").val(dataNascimento);
                            $("#genero").val(genero);

                            return;

                        }
                    }
                );
            }
        }
        $("#nome").focus();

    }

    function VerificaRG() {
        var rg = $("#rg").val();
        RGverificado(rg);
        return;
    }

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

    //CONTINUAR A PARTIR DAQUI

    function validaData(data) {
        var data = document.getElementById("dataNascimento").value; // pega o valor do input
        data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
        var data_array = data.split("-"); // quebra a data em array

        // para o IE onde será inserido no formato dd/MM/yyyy
        if (data_array[0].length != 4) {
            data = data_array[2] + "-" + data_array[1] + "-" + data_array[0];
        }

        // compara as datas e calcula a idade
        var hoje = new Date();
        var nasc = new Date(data);
        var idade = hoje.getFullYear() - nasc.getFullYear();
        var m = hoje.getMonth() - nasc.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) idade--;

        if (idade <= 14) {
            smartAlert("Atenção", "Informe a data correta", "error");
            $("#idade").val(idade)
            $("#btnGravar").prop('disabled', false);
            return false;

        }

        if (idade >= 18 && idade <= 95) {
            smartAlert("Atenção", "Data Valida !", "success");
            $("#idade").val(idade)
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (hoje)
            //se for maior que 60 não vai acontecer nada!
            return false;

    }

    function validarCPF() {
        // var id = +($("#codigo").val());
        var cpf = $("#cpf").val();

        validaCPF(cpf);
    }


    //FUNCTION GRAVAR

    function gravar() {
        var id = +($("#codigo").val());
        var ativo = 0;
        if ($("#ativo").is(':checked')) {
            ativo = 1;
        }
        J
        var nome = $("#nome").val();
        var cpf = $("#cpf").val();
        var rg = $("#rg").val();
        var genero = $("#descricao").val();
        var estadoCivil = $("#estadoCivil").val();
        var dataNascimento = $("#dataNascimento").val();

        if (!nome) {
            smartAlert("Atenção", "Informe o nome", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!genero) {
            smartAlert("Atenção", "Informe seu genero", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!cpf) {
            smartAlert("Atenção", "Informe o cpf", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!rg) {
            smartAlert("Atenção", "Informe o RG", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!dataNascimento) {
            smartAlert("Atenção", "Informe a data valida", "error");
            $("#btnGravar").prop('disabled', false);
            return;
            $dataNascimento = '1988-12-20';
            $date = new DateTime($dataNascimento);
            $interval = $date > diff(new DateTime(date('Y-m-d')));
            $interval > format('%Y anos');
        }

        gravaFuncionario(id, ativo, nome, cpf, rg, genero, estadoCivil, dataNascimento,);
    }
</script>