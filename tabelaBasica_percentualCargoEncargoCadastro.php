<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");
// $condicaoAcessarOK = (in_array('POSTO_ACESSAR', $arrayPermissao, true));
// $condicaoGravarOK = (in_array('POSTO_GRAVAR', $arrayPermissao, true));
// $condicaoExcluirOK = (in_array('POSTO_EXCLUIR', $arrayPermissao, true));

// if ($condicaoAcessarOK == false) {
//     unset($_SESSION['login']);
//     header("Location:login.php");
// }

// $esconderBtnGravar = "";
// if ($condicaoGravarOK === false) {
//     $esconderBtnGravar = "none";
// }

// $esconderBtnExcluir = "";
// if ($condicaoExcluirOK === false) {
//     $esconderBtnExcluir = "none";
// }

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Posto";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["tabelaBasica"]["sub"]['prototipoValorPosto']['sub']["percentualPostoEncargo"]["active"] = true;

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
                            <h2>Percentual Encargo Posto</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formPosto" method="post">
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
                                                        <input id="codigo" name="codigo" type="text" class="hidden">
                                                            <section class="col col-5">
                                                                <label class="label">Posto</label>
                                                                <label class="select">
                                                                    <select id="posto" name="posto" class="required">
                                                                        <option></option>
                                                                        <?php
                                                                        $sql =  "SELECT codigo, descricao FROM Ntl.posto where ativo = 1 order by codigo";
                                                                        $reposit = new reposit();
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach($result as $row) { 
                                                                            $codigo = $row['codigo'];
                                                                            $descricao = ($row['descricao']);
                                                                            echo '<option value=' . $codigo . '>' . $descricao . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                        </div>
                                                            <input id="jsonEncargo" name="jsonEncargo" type="hidden" value="[]">
                                                            <div id="formEncargo" class="col-sm-6">
                                                                <input id="encargoId" name="encargoId" type="hidden" value="">
                                                                <input id="descricaoEncargoPrincipal" name="descricaoEncargoPrincipal" type="hidden" value="">
                                                                <input id="descricaoEncargoWhatsApp" name="descricaoInsumosWhatsApp" type="hidden" value="">
                                                                <input id="sequencialEncargo" name="sequencialEncargo" type="hidden" value="">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <section class="col col-md-6">
                                                                            <label class="label">Encargo</label>
                                                                            <label class="select">
                                                                                <select id="encargo">
                                                                                    <option> </option>
                                                                                    <option>ISS</option>
                                                                                    <option>FGTS</option>
                                                                                    <option>Encargo governamental</option>
                                                                                </select><i></i>
                                                                            </label>
                                                                        </section>
                                                                        <!-- <section class="col col-4">
                                                                            <label class="label">Percentual</label>
                                                                            <label class="input"><i class="icon-append fa fa-percent"></i>
                                                                                <input id="percentual" name="percentual" style="text-align: right;" type="text" autocomplete="off" maxlength="100">
                                                                            </label>
                                                                        </section> -->
                                                                        <section class="col col-md-2">
                                                                            <label class="label">&nbsp;</label>
                                                                            <button id="btnAddEncargo" type="button" class="btn btn-primary">
                                                                                <i class="fa fa-plus"></i>
                                                                            </button>
                                                                            <button id="btnRemoverEncargo" type="button" class="btn btn-danger">
                                                                                <i class="fa fa-minus"></i>
                                                                            </button>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                    <table id="tableEncargo" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                        <thead>
                                                                            <tr role="row">
                                                                                <th style="width: 2px"></th>
                                                                                <th class="text-center" style="min-width: 500%;">Encargo</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <input id="jsonInsumos" name="jsonInsumos" type="hidden" value="[]">
                                                            <div id="formInsumos" class="col-sm-6">
                                                                <input id="insumosId" name="insumosId" type="hidden" value="">
                                                                <input id="descricaoInsumosPrincipal" name="descricaoInsumosPrincipal" type="hidden" value="">
                                                                <input id="descricaoInsumosWhatsApp" name="descricaoInsumosWhatsApp" type="hidden" value="">
                                                                <input id="sequencialInsumos" name="sequencialInsumos" type="hidden" value="">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <section class="col col-md-6">
                                                                            <label class="label">Insumos</label>
                                                                            <label class="select">
                                                                                <select id="insumos">
                                                                                    <option> </option>
                                                                                    <option>Uniforme</option>
                                                                                    <option>Capacete</option>
                                                                                    <option>Computador</option>
                                                                                </select><i></i>
                                                                            </label>
                                                                        </section>
                                                                        <!-- <section class="col col-4">
                                                                            <label class="label">Percentual</label>
                                                                            <label class="input"><i class="icon-append fa fa-percent"></i>
                                                                                <input id="percentual" name="percentual" style="text-align: right;" type="text" autocomplete="off" maxlength="100">
                                                                            </label>
                                                                        </section> -->
                                                                        <section class="col col-md-2">
                                                                            <label class="label">&nbsp;</label>
                                                                            <button id="btnAddInsumos" type="button" class="btn btn-primary">
                                                                                <i class="fa fa-plus"></i>
                                                                            </button>
                                                                            <button id="btnRemoverInsumos" type="button" class="btn btn-danger">
                                                                                <i class="fa fa-minus"></i>
                                                                            </button>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                    <table id="tableInsumos" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                        <thead>
                                                                            <tr role="row">
                                                                                <th style="width: 2px"></th>
                                                                                <th class="text-center" style="min-width: 500%;">Insumos</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer>
                                        <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtnExcluir ?>">
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

<script src="<?php echo ASSETS_URL; ?>/js/business_tabelaBasicaPosto.js" type="text/javascript"></script>

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
        jsonEncargoArray = JSON.parse($("#jsonEncargo").val());
        jsonInsumosArray = JSON.parse($("#jsonInsumos").val());
        carregaPagina();
        
        $('#dlgSimpleExcluir').dialog({
            autoOpen: false,
            width: 400,
            resizable: false,
            modal: true,
            title: "Atenção",
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
            var id = $("#codigo").val();

            if (id === 0) {
                smartAlert("Atenção", "Selecione um registro para excluir !", "error");
                $("#nome").focus();
                return;
            }

            if (id !== 0) {
                $('#dlgSimpleExcluir').dialog('open');
            }
        });

        $("#btnGravar").on("click", function() {
            gravar();
        });
        $("#btnNovo").on("click", function() {
            novo();
        });
        $("#btnVoltar").on("click", function() {
            voltar();
        });
        $('#percentual').focusout(function() {
            var percentual, element;
            element = $(this);
            element.unmask();
            percentual = element.val().replace(/\D/g, '');
            if (percentual.length > 3) {
                element.mask("99.99?9");
            } else {
                element.mask("9.99?9");
            }
        }).trigger('focusout');
        $("#btnAddEncargo").on("click", function() {
                addEncargo();
        });

        $("#btnRemoverEncargo").on("click", function() {
                excluirEncargo();
        });

        $("#btnAddInsumos").on("click", function() {
                addInsumos();
        });

        $("#btnRemoverInsumos").on("click", function() {
                excluirInsumos();
        });

   

    });

    function gravar() {

        var descricao = $("#descricao").val();

        if (descricao == "" || descricao === " ") {
            smartAlert("Atenção", "Insira uma Descrição", "error")
            return false;
        }

        let posto = $('#formPosto').serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        gravaPosto(posto,
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
        $(location).attr('href', 'tabelaBasica_postoCadastro.php');
    }

    function voltar() {
        $(location).attr('href', 'tabelaBasica_postoFiltro.php');
    }

    function excluir() {
        var id = +$("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }

        excluirPosto(id, function(data) {
            if (data.indexOf('failed') > -1) {
                var piece = data.split("#");
                var mensagem = piece[1];

                if (mensagem !== "") {
                    smartAlert("Atenção", mensagem, "error");
                } else {
                    smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                }
            } else {
                smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                voltar();
            }
        });
    }

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            if (idd !== "") {
                recuperaPosto(idd,
                    function(data) {
                        if (data.indexOf('failed') > -1) {} else {
                            data = data.replace(/failed/g, '');
                            var piece = data.split("#");
                            var mensagem = piece[0];
                            var out = piece[1];

                            piece = out.split("^");
                            codigo = piece[0];
                            descricao = piece[1];
                            ativo = piece[2];

                            $("#codigo").val(codigo);
                            $("#descricao").val(descricao);
                            $("#ativo").val(ativo);

                        }
                    }
                );
            }
        }
    }

    function addEncargo() {
        var item = $("#FormEncargo").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTel
        });

        if (!item["sequencialEncargo"]) {
            if (jsonEncargoArray.length === 0) {
                item["sequencialEncargo"] = 1;
            } else {
                item["sequencialEncargo"] = Math.max.apply(Math, jsonEncargoArray.map(function(o) {
                    return o.sequencialEncargo;
                })) + 1;
            }
            item["faturamentoId"] = 0;
        } else {
            item["sequencialEncargo"] = +item["sequencialEncargo"];
        }

        item.encargoText = $('#encargo option:selected').text().trim();

        var index = -1;
        $.each(jsonEncargoArray, function(i, obj) {
            if (+$('#sequencialEncargo').val() === obj.sequencialEncargo) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonEncargoArray.splice(index, 1, item);
        else
            jsonEncargoArray.push(item);

        $("#jsonEncargo").val(JSON.stringify(jsonEncargoArray));
        fillTableEncargo();
        clearFormEncargo();

    }

    function fillTableEncargo() {
        $("#tableEncargo tbody").empty();
        for (var i = 0; i < jsonEncargoArray.length; i++) {
            var row = $('<tr />');
            $("#tableEncargo tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonEncargoArray[i].sequencialEncargo + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaTelefone(' + jsonEncargoArray[i].sequencialEncargo + ');">' + jsonEncargoArray[i].encargoText + '</td>'));
            // row.append($('<td class="text-center">' + jsonEncargoArray[i].percentual + '</td>'));
        }
    }

    function processDataTel(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';

        if (fieldName !== '' && (fieldId === "encargo")) {
            var valorTel = $("encargo").val().trim();
            if (encargo !== '') {
                fieldName = "encargo";
            }
            return {
                name: fieldName,
                value: encargo
            };
        }
        if (fieldName !== '' && (fieldId === "percentual")) {
            var percentual = $("#percentual").val();
            if (percentual !== '') {
                fieldName = "percentual";
            }
            return {
                name: fieldName,
                value: percentual
            };
        }

        return false;
    }

    function clearFormEncargo() {
        $("#encargo").val('');
        $("#encargoId").val('');
        $("#sequencialEncargo").val('');
        $('#percentual').val('');
    }

    function excluirEncargo() {
        var arrSequencial = [];
        $('#tableEncargo input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonEncargoArray.length - 1; i >= 0; i--) {
                var obj = jsonEncargoArray[i];
                if (jQuery.inArray(obj.sequencialEncargo, arrSequencial) > -1) {
                    jsonEncargoArray.splice(i, 1);
                }
            }
            $("#JsonEncargo").val(JSON.stringify(jsonEncargoArray));
            fillTableEncargo();
        } else {
            smartAlert("Erro", "Selecione pelo menos um encargo para excluir.", "error");
        }
    }


    function carregaTelefone(sequencialEncargo) {
        var arr = jQuery.grep(jsonEncargoArray, function(item, i) {
            return (item.sequencialEncargo === sequencialEncargo);
        });

        clearFormEncargo();

        if (arr.length > 0) {
            var item = arr[0];
            $("#encargo").val(item.encargo);
            // $("#percentual").val(item.percentual);
            $("#sequencialEncargo").val(item.sequencialEncargo);
            function addTelefone() {
        var item = $("#FormEncargo").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTel
        });

        if (item["sequencialEncargo"] === '') {
            if (jsonEncargoArray.length === 0) {
                item["sequencialEncargo"] = 1;
            } else {
                item["sequencialEncargo"] = Math.max.apply(Math, jsonEncargoArray.map(function(o) {
                    return o.sequencialEncargo;
                })) + 1;
            }
            item["encargoId"] = 0;
        } else {
            item["sequencialEncargo"] = +item["sequencialEncargo"];
        }

        var index = -1;
        $.each(jsonEncargoArray, function(i, obj) {
            if (+$('#sequencialEncargo').val() === obj.sequencialEncargo) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonEncargoArray.splice(index, 1, item);
        else
            jsonEncargoArray.push(item);

        $("#jsonEncargo").val(JSON.stringify(jsonEncargoArray));
        fillTableEncargo();
        clearFormEncargo();

    }
}
    }


    // insumos

    function addInsumos() {
        var item = $("#FormInsumos").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataInsumos
        });

        if (!item["sequencialInsumos"]) {
            if (jsonInsumosArray.length === 0) {
                item["sequencialInsumos"] = 1;
            } else {
                item["sequencialInsumos"] = Math.max.apply(Math, jsonInsumosArray.map(function(o) {
                    return o.sequencialInsumos;
                })) + 1;
            }
            item["faturamentoId"] = 0;
        } else {
            item["sequencialInsumos"] = +item["sequencialInsumos"];
        }

        item.insumosText = $('#insumos option:selected').text().trim();

        var index = -1;
        $.each(jsonInsumosArray, function(i, obj) {
            if (+$('#sequencialInsumos').val() === obj.sequencialInsumos) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonInsumosArray.splice(index, 1, item);
        else
            jsonInsumosArray.push(item);

        $("#jsonInsumos").val(JSON.stringify(jsonInsumosArray));
        fillTableInsumos();
        clearFormInsumos();

    }

    function fillTableInsumos() {
        $("#tableInsumos tbody").empty();
        for (var i = 0; i < jsonInsumosArray.length; i++) {
            var row = $('<tr />');
            $("#tableInsumos tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonInsumosArray[i].sequencialInsumos + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaInsumos(' + jsonInsumosArray[i].sequencialInsumos + ');">' + jsonInsumosArray[i].insumosText + '</td>'));
            // row.append($('<td class="text-center">' + jsonInsumosArray[i].percentual + '</td>'));
        }
    }

    function processDataInsumos(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';

        if (fieldName !== '' && (fieldId === "insumos")) {
            var valorTel = $("insumos").val().trim();
            if (insumos !== '') {
                fieldName = "insumos";
            }
            return {
                name: fieldName,
                value: insumos
            };
        }
        if (fieldName !== '' && (fieldId === "percentual")) {
            var percentual = $("#percentual").val();
            if (percentual !== '') {
                fieldName = "percentual";
            }
            return {
                name: fieldName,
                value: percentual
            };
        }

        return false;
    }

    function clearFormInsumos() {
        $("#insumos").val('');
        $("#insumosId").val('');
        $("#sequencialInsumos").val('');
        $('#percentual').val('');
    }

    function excluirInsumos() {
        var arrSequencial = [];
        $('#tableInsumos input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonInsumosArray.length - 1; i >= 0; i--) {
                var obj = jsonInsumosArray[i];
                if (jQuery.inArray(obj.sequencialInsumos, arrSequencial) > -1) {
                    jsonInsumosArray.splice(i, 1);
                }
            }
            $("#JsonInsumos").val(JSON.stringify(jsonInsumosArray));
            fillTableInsumos();
        } else {
            smartAlert("Erro", "Selecione pelo menos insumos para excluir.", "error");
        }
    }


    function carregaInsumos(sequencialInsumos) {
        var arr = jQuery.grep(jsonInsumosArray, function(item, i) {
            return (item.sequencialInsumos === sequencialInsumos);
        });

        clearFormInsumos();

        if (arr.length > 0) {
            var item = arr[0];
            $("#encargo").val(item.encargo);
            // $("#percentual").val(item.percentual);
            $("#sequencialInsumos").val(item.sequencialInsumos);
            function addTelefone() {
        var item = $("#FormEncargo").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTel
        });

        if (item["sequencialInsumos"] === '') {
            if (jsonInsumosArray.length === 0) {
                item["sequencialInsumos"] = 1;
            } else {
                item["sequencialInsumos"] = Math.max.apply(Math, jsonInsumosArray.map(function(o) {
                    return o.sequencialInsumos;
                })) + 1;
            }
            item["insumosId"] = 0;
        } else {
            item["sequencialInsumos"] = +item["sequencialInsumos"];
        }

        var index = -1;
        $.each(jsonInsumosArray, function(i, obj) {
            if (+$('#sequencialInsumos').val() === obj.sequencialInsumos) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonInsumosArray.splice(index, 1, item);
        else
            jsonInsumosArray.push(item);

        $("#jsonInsumos").val(JSON.stringify(jsonInsumosArray));
        fillTableInsumos();
        clearFormInsumos();

    }
}

    }

        
    


</script>