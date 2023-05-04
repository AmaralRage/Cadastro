<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Cadastro Dependentes";

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
                                                                <label class="label">Dependentes</label>
                                                                <label class="select">
                                                                    <select id="descricao" name="descricao" class="required">
                                                                        <option value="0"></option>
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo,descricao, dependentesAtivo
                                                                        FROM dbo.genero where dependentesAtivo = 1 ORDER BY codigo";
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
                                                        </div>
                                                    </fieldset>
                                                    <!-- <section class="col col-2">
                                                                <label class="label">Dependentes</label>
                                                                <label class="input">
                                                                    <input id="dependentes" maxlength="255" name="dependentes" class="required" type="text" value="">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">&nbsp;</label>
                                                                <label class="checkbox ">
                                                                    <input checked="checked" id="dependenteAtivo" name="ativo" type="checkbox" value="true"><i></i>
                                                                    Ativo
                                                                </label>
                                                            </section>
                                                        </div> -->

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
        jsonEmailArray = JSON.parse($("#jsonEmail").val());

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
            gravar()
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

    //================================================================================= VALIDA TELEFONE ====================================================================================================

    function validaTelefone() {
        var achouTelefone = false;
        var achouTelefonePrincipal = false;
        var telefonePrincipal = '';

        if ($('#telefonePrincipal').is(':checked')) {
            telefonePrincipal = true;
        } else {
            telefonePrincipal = false;
        }

        var sequencial = +$('#sequencialTelefone').val();
        var telefone = $('#telefone').val();

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (telefonePrincipal == true) {
                if ((jsonTelefoneArray[i].telefonePrincipal == telefonePrincipal) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achouTelefonePrincipal = true;
                    break;
                }
            }
            if (telefone !== "") {
                if ((jsonTelefoneArray[i].telefone === telefone) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achouTelefone = true;
                    break;
                }
            }
        }
        if (achouTelefone === true) {
            smartAlert("Erro", "Este número já está na lista.", "error");
            clearFormTelefone();
            return false;
        }
        if (achouTelefonePrincipal === true) {
            smartAlert("Erro", "Já existe um Telefone Principal na lista.", "error");
            clearFormTelefone();
            return false;
        }
        return true;
    }

    //================================================================================= VALIDA TELEFONE =============================================================================================

    //=================================================================================== VALIDA EMAIL ====================================================================================================

    function validaEmail() {
        var achouEmail = false;
        var achouEmailPrincipal = false;
        var emailPrincipal = '';

        if ($('#emailPrincipal').is(':checked')) {
            emailPrincipal = true;
        } else {
            emailPrincipal = false;
        }

        var sequencial = +$('#sequencialEmail').val();
        var email = $('#email').val();

        for (i = jsonEmailArray.length - 1; i >= 0; i--) {
            if (emailPrincipal == true) {
                if ((jsonEmailArray[i].emailPrincipal == emailPrincipal) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                    achouEmailPrincipal = true;
                    break;
                }
            }
            if (achouEmail !== "") {
                if ((jsonEmailArray[i].email === email) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                    achouEmailPrincipal = true;
                    break;
                }
            }
        }
        if (achouEmail === true) {
            smartAlert("Erro", "Este número já está na lista.", "error");
            clearFormEmail();
            return false;
        }
        if (achouEmailPrincipal === true) {
            smartAlert("Erro", "Já existe um Email Principal na lista.", "error");
            clearFormEmail();
            return false;
        }
        return true;
    }

    //================================================================================== VALIDA EMAIL =============================================================================================

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

    //================================================================================== ADD EMAIL =============================================================================================


    function addEmail() {

        var email = $("#email").val();
        if (email === "") {
            smartAlert("Atenção", "Informe o Email !", "error");
            $("#email").focus();
            return;
        }

        var item = $("#formEmail").toObject({
            mode: 'combine',
            skipEmpty: false
        });

        if (item["sequencialEmail"] === '') {
            if (jsonEmailArray.length === 0) {
                item["sequencialEmail"] = 1;
            } else {
                item["sequencialEmail"] = Math.max.apply(Math, jsonEmailArray.map(function(o) {
                    return o.sequencialEmail;
                })) + 1;
            }
            item["EmailId"] = 0;
        } else {
            item["sequencialEmail"] = +item["sequencialEmail"];
        }

        if (item["emailPrincipal"]) {
            item["descricaoEmailPrincipal"] = "Sim"
        } else {
            item["descricaoEmailPrincipal"] = "Não"
        }

        // linha de sinalização dos if e else 

        var index = -1;
        $.each(jsonEmailArray, function(i, obj) {
            if (+$('#sequencialEmail').val() === obj.sequencialEmail) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonEmailArray.splice(index, 1, item);
        else
            jsonEmailArray.push(item);

        $("#jsonEmail").val(JSON.stringify(jsonEmailArray));

        fillTableEmail();
        clearFormEmail();
    }

    function carregaEmail(sequencialEmail) {
        var arr = jQuery.grep(jsonEmailArray, function(item, i) {
            return (item.sequencialEmail === sequencialEmail);
        });
        if (arr.length > 0) {
            var item = arr[0];

            $("#email").val(item.email);
            $("#sequencialEmail").val(item.sequencialEmail);
            $("#emailPrincipal").val(item.emailPrincipal);

            if (item.EmailPrincipal == 1) {
                $('#emailPrincipal').prop('checked', true);
                item["emailPrincipal"] = true;

            } else {
                item['emailPrincipal'] = false;
                ($('#emailPrincipal').prop('checked', false));
            }
        }
    }

    function fillTableEmail() {
        $("#tableEmail tbody").empty();
        for (var i = 0; i < jsonEmailArray.length; i++) {
            var row = $('<tr />');

            $("#tableEmail tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonEmailArray[i].sequencialEmail + '"><i></i></label></td>'));

            row.append($('<td class="text-left" onclick="carregaEmail(' + jsonEmailArray[i].sequencialEmail + ');">' + jsonEmailArray[i].email + '</td>'));
            // row.append($('<td class="text-left" >' + jsonEmailArray[i].Email + '</td>'));
            row.append($('<td class="text-left" >' + jsonEmailArray[i].descricaoEmailPrincipal + '</td>'));

        }
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



    function clearFormEmail() {
        $("#email").val('');
        $("#sequencialEmail").val('');
        $("#emailPrincipal").prop('checked', false);
    }

    //================================================================================== EXCLUIR EMAIL =============================================================================================


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

    //================================================================================== FIM EXCLUIR EMAIL =============================================================================================


    function carregaTelefone(sequencialTelefone) {
        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTelefone === sequencialTelefone);
        });
        if (arr.length > 0) {
            var item = arr[0];

            $("#telefone").val(item.telefone);
            $("#sequencialTelefone").val(item.sequencialTelefone);
            $("#telefonePrincipal").val(item.telefonePrincipal);
            $("#telefoneWhatsApp").val(item.telefoneWhatsApp);

            if (item.telefonePrincipal == 1) {
                $('#telefonePrincipal').prop('checked', true);
                item["telefonePrincipal"] = true;

            } else {
                item['telefonePrincipal'] = false;
                ($('#telefonePrincipal').prop('checked', false));
            }

            if (item.telefoneWhatsApp == 1) {
                $('#telefoneWhatsApp').prop('checked', true);
                item["telefoneWhatsApp"] = true;

            } else {
                item['telefoneWhatsApp'] = false;
                ($('#telefoneWhatsApp').prop('checked', false));
            }
        }
    }

    function excluiEmailTabela() {
        var arrSequencial = [];
        $('#tableEmail input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonEmailArray.length - 1; i >= 0; i--) {
                var obj = jsonEmailArray[i];
                if (jQuery.inArray(obj.sequencialEmail, arrSequencial) > -1) {
                    jsonEmailArray.splice(i, 1);
                }
            }
            $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
            fillTableEmail();
        } else
            smartAlert("Erro", "Selecione pelo menos um Projeto para excluir.", "error");
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
            smartAlert("Atenção", "Informe uma data válida", "error");
            $("#idade").val(idade)
            $("#btnGravar").prop('disabled', false);
            return false;

        }

        if (idade >= 18 && idade <= 95) {
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
        var nome = $("#nome").val();
        var cpf = $("#cpf").val();
        var rg = $("#rg").val();
        var genero = $("#descricao").val();
        var estadoCivil = $("#estadoCivil").val();
        var dataNascimento = $("#dataNascimento").val();
        var cep = $("#cep").val();
        var logradouro = $("#logradouro").val();
        var bairro = $("#bairro").val();
        var numero = $("#numero").val();
        var complemento = $("#complemento").val();
        var uf = $("#uf").val();
        var cidade = $("#cidade").val();
        var jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());

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

        gravaFuncionario(id, ativo, nome, cpf, rg, genero, estadoCivil, dataNascimento, cep, logradouro, bairro, numero, complemento, uf, cidade, jsonTelefoneArray);
    }
</script>