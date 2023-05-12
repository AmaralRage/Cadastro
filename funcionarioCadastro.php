<?php
//initilize the pagee
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Cadastro/Funcionario";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

$page_nav["cadastro"]["sub"]["funcionario"]["active"] = true;

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
                            <h2>Funcionario</h2>
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
                                                                    <select id="genero" name="genero" class="required">
                                                                        <option value="0"></option>
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
                                                                    <select id="estadoCivil" name="estadoCivil" class="required">
                                                                        <option value="hidden"></option>
                                                                        <option value="1">Solteiro(a)</option>
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
                                                            <section class="col col-1.5">
                                                                <label class="label">Primeiro Emprego</label>
                                                                <label class="select">
                                                                    <select id="primeiroEmprego" name="primeiroEmpreogo" class="required">
                                                                        <option value="0" selected>Não</option>
                                                                        <option value="1" >Sim</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label">PIS:PASEP</label>
                                                                <label class="input">
                                                                    <input id="pispasep" class="required" type="text">
                                                                </label>
                                                            </section>
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
                                            <div id="collapseContato" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-sm-6 required">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneWhatsApp" name="descricaoTelefoneWhatsApp" type="hidden" value="">
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
                                                        <div id="formEmail" class="col-sm-6">
                                                            <input id="jsonEmail" name="jsonEmail" type="hidden" value="[]">
                                                            <input id="emailId" name="Id" type="hidden" value="">
                                                            <input id="descricaoEmailPrincipal" name="descricaoEmailPrincipal" type="hidden" value="">
                                                            <input id="sequencialEmail" name="sequencialEmail" type="hidden" value="">
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
                                                                    <section class="col col-auto">
                                                                        <label class="label">&nbsp;</label>
                                                                        <button id="btnAddEmail" type="button" class="btn btn-primary">
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
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ACCORDION ACIMA -->

                                        <!--ACCORDION CEP ABAIXO -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseEndereco" class="" id="accordionEndereco">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Endereço
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEndereco" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <section class="col col-2">
                                                                    <label class="label">CEP</label>
                                                                    <label class="input">
                                                                        <input id="cep" name="cep" type="text" class="form-control required" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">Logradouro</label>
                                                                    <label class="input">
                                                                        <input id="logradouro" name="logradouro" type="text" class="form-control required" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">Bairro</label>
                                                                    <label class="input">
                                                                        <input id="bairro" name="bairro" type="text" class="form-control required" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">Número</label>
                                                                    <label class="input">
                                                                        <input id="numero" name="numero" type="text" class="form-control required" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">Complemento</label>
                                                                    <label class="input">
                                                                        <input id="complemento" name="complemento" type="text" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">UF</label>
                                                                    <label class="input">
                                                                        <input id="uf" name="uf" type="text" class="form-control required" value="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-2">
                                                                    <label class="label">Cidade</label>
                                                                    <label class="input">
                                                                        <input id="cidade" name="cidade" type="text" class="form-control required" value="">
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <!--accordion de Dependentes-->

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseDependente" class="" id="accordionDependente">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Dependentes
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseDependente" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <input id="jsonDependente" name="jsonDependente" type="hidden" value="[]">
                                                        <div id="formDependente" class="col-sm-10 required">
                                                            <input id="descricaoDependente" type="hidden" value="">
                                                            <input id="sequencialDependente" type="hidden" value="">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <section class="col col-3">
                                                                        <label class="label">Nome do Dependente:</label>
                                                                        <label class="input">
                                                                            <input id="dependente" maxlength="255" name="dependente" class="required" value="">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-2">
                                                                        <label class="label">CPF:</label>
                                                                        <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                            <input id="cpfDependente" name="cpfDependente" class="required cpf-mask" type="text" value="">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-2">
                                                                        <label class="label">Data de Nascimento:</label>
                                                                        <label class="input">
                                                                            <input id="dataNascimentoDependente" name="dataNascimentoDependente" type="text" placeholder="dd/mm/aaaa" data-dateformat="dd/mm/yy" class="datepicker required" value="" data-mask="99/99/9999" data-mask-placeholder="_" style="text-align: center" autocomplete="off">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-2 col-auto">
                                                                        <label class="label">Tipo de Dependente:</label>
                                                                        <label class="select">
                                                                            <select id="tipoDependente" class="required">
                                                                                <option value="hidden"></option>
                                                                                <?php
                                                                                $reposit = new reposit();
                                                                                $sql = "SELECT tipoDependente, codigo FROM dbo.tipoDependentes WHERE dependenteAtivo = 1";
                                                                                $result = $reposit->RunQuery($sql);
                                                                                foreach ($result as $row) {
                                                                                    $codigo = $row['codigo'];
                                                                                    $tipoDependente = $row['tipoDependente'];
                                                                                    echo '<option value=' . $codigo . '>' . $tipoDependente . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select><i></i>
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-md-3">
                                                                        <label class="label">&nbsp;</label>
                                                                        <button id="btnAddDependente" type="button" class="btn btn-primary">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <button id="btnRemoverDependente" type="button" class="btn btn-danger">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive" style="min-height: 115px;  border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableDependentes" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th></th>
                                                                            <th class="text-left">Nome</th>
                                                                            <th class="text-left">CPF</th>
                                                                            <th class="text-left">Data de Nascimento</th>
                                                                            <th class="text-left">Tipo</th>
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
        jsonDependenteArray = JSON.parse($("#jsonDependente").val());

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

        $("#primeiroEmprego").on("change", function() {

            verificaPrimeiroEmprego();
        });

        $("#nome").on("change", function() {
            if (/[0-9\!\#\$\&\*\-\_\/\\\^\~\+\?\.\;\,\:\]\[\(\)]/g.test(this.value)) {
                smartAlert("Atenção", "Nome Inválido, apenas Letras!", "error");
                $("#nome").val('');
            }
        })

        $("#dependente").on("change", function() {
            if (/[0-9\!\#\$\&\*\-\_\/\\\^\~\+\?\.\;\,\:\]\[\(\)]/g.test(this.value)) {
                smartAlert("Atenção", "Dependente Inválido, apenas Letras!", "error");
                $("#dependente").val('');
            }
        })

        $("#dataNascimentoDependente").on("change", function() {
            var dataNascimentoDependente = $("#dataNascimentoDependente").val();
            if (validarDataDependente(dataNascimentoDependente) == false) {
                smartAlert("Atenção", "Data Inválida!", "error");
                $("#idade").val("");
                $("#dataNascimentoDependente").val("");
            }
        });

        $("#cpf").on("change", function() {
            // var data = $("#cpf").val();
            validarCPF();
        });

        $("#cpfDependente").on("change", function() {
            // var data = $("#cpfDependente").val();
            validarCPFDependente();
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
        $("#cpfDependente").mask('999.999.999-99');
        $("#rg").mask('99.999.999-9');
        $("#telefone").mask('(99) 99999-9999');
        $("#dataNascimentoDependente").mask('99/99/9999');

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

    $("#btnAddDependente").on("click", function() {
        addDependente();
    });

    $("#btnRemoverDependente").on("click", function() {
        excluiDependenteTabela();
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

    //================================================================================= VALIDA DEPENDENTE =============================================================================================

    function validaDependente() {
        var achouDependente = false;
        var achouDependentePrincipal = false;
        var dependentePrincipal = '';

        if ($('#dependentePrincipal').is(':checked')) {
            dependente = true;
        } else {
            dependente = false;
        }

        var sequencial = +$('#sequencialDependente').val();
        var dependente = $('#dependente').val();

        for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
            if (dependente == true) {
                if ((jsonDependenteArray[i].dependente == dependente) && (jsonDependenteArray[i].sequencialDependente !== sequencial)) {
                    achouDependente = true;
                    break;
                }
            }
            if (dependente !== "") {
                if ((jsonDependenteArray[i].dependente === dependente) && (jsonDependenteArray[i].sequencialDependente !== sequencial)) {
                    achouDependente = true;
                    break;
                }
            }
        }
        if (achouDependente === true) {
            smartAlert("Erro", "Este Dependente já está na lista.", "error");
            clearFormDependente();
            return false;
        }
        if (achouDependentePrincipal === true) {
            smartAlert("Erro", "Já existe um Dependente Principal na lista.", "error");
            clearFormDependente();
            return false;
        }
        return true;
    }

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

    function addDependente() {

        var dependente = $("#dependente").val();
        var cpfDependente = $("#cpf").val();
        var dataNascimentoDependente = $("#dataNascimentoDependente").val();
        var tipoDependente = $("#tipoDependente").val();
        if (dependente === "") {
            smartAlert("Atenção", "Informe o Dependente !", "error");
            $("#dependente").focus();
            return;
        }

        var item = $("#formDependente").toObject({
            mode: 'combine',
            skipEmpty: false
        });

        item["sequencialDependente"] = $("#sequencialDependente").val();

        if (item["sequencialDependente"] === '') {
            if (jsonDependenteArray.length === 0) {
                item["sequencialDependente"] = 1;
            } else {
                item["sequencialDependente"] = Math.max.apply(Math, jsonDependenteArray.map(function(o) {
                    return o.sequencialDependente;
                })) + 1;
            }
        } else {
            item["sequencialDependente"] = +item["sequencialDependente"];
        }

        // linha de sinalização dos if e else 

        item["dependente"] = $('#dependente').val()
        item["cpfDependente"] = $('#cpfDependente').val()
        item["dataNascimentoDependente"] = $('#dataNascimentoDependente').val()
        item["tipoDependente"] = $('#tipoDependente').val()

        var index = -1;
        $.each(jsonDependenteArray, function(i, obj) {
            if (+$('#sequencialDependente').val() === obj.sequencialDependente) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonDependenteArray.splice(index, 1, item);
        else
            jsonDependenteArray.push(item);

        $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));

        fillTableDependente();
    }


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

    function fillTableDependente() {
        $("#tableDependentes tbody").empty();
        for (var i = 0; i < jsonDependenteArray.length; i++) {
            var row = $('<tr />');

            $("#tableDependentes tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonDependenteArray[i].sequencialDependente + '"><i></i></label></td>'));


            row.append($('<td class="text-left" onclick="carregaDependente(' + jsonDependenteArray[i].sequencialDependente + ');">' + jsonDependenteArray[i].dependente + '</td>'));
            // row.append($('<td class="text-left" >' + jsonDependenteArray[i].Dependente + '</td>'));
            row.append($('<td class="text-left" >' + jsonDependenteArray[i].cpfDependente + '</td>'));
            row.append($('<td class="text-left" >' + jsonDependenteArray[i].dataNascimentoDependente + '</td>'));
            row.append($('<td class="text-left" >' + jsonDependenteArray[i].tipoDependente + '</td>'));
        }
    }

    function clearFormTelefone() {
        $("#telefone").val('');
        $("#sequencialTelefone").val('');
        $("#telefonePrincipal").prop('checked', false);
        $("#telefoneWhatsApp").prop('checked', false);
    }

    function clearFormDependente() {
        $("#dependente").focus('');
        $("#dependente").val('');
        $("#cpfDependente").val('');
        $("#dataNascimentoDependente").val('');
        $("#tipoDependente").val('');
        $("#sequencialDependente").val('');
    }

    function clearFormEmail() {
        $("#email").val('');
        $("#sequencialEmail").val('');
        $("#emailPrincipal").prop('checked', false);
    }

    //================================================================================== EXCLUIR =============================================================================================


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

    function excluiDependenteTabela() {
        var arrSequencial = [];
        $('#tableDependentes input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
                var obj = jsonDependenteArray[i];
                if (jQuery.inArray(obj.sequencialDependente, arrSequencial) > -1) {
                    jsonDependenteArray.splice(i, 1);
                }
            }
            $("#jsonDependentes").val(JSON.stringify(jsonDependenteArray));
            fillTableDependente();
        } else
            smartAlert("Erro", "Selecione pelo menos um Projeto para excluir.", "error");
    }

    //================================================================================== FIM EXCLUIR =============================================================================================


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

    function carregaDependente(sequencialDependente) {
        var arr = jQuery.grep(jsonDependenteArray, function(item, i) {
            return (item.sequencialDependente === sequencialDependente);
        });
        if (arr.length > 0) {
            var item = arr[0];

            $("#dependente").val(item.dependente);
            $("#cpfDependente").val(item.cpfDependente);
            $("#tipoDependente").val(item.tipoDependente);
            $("#sequencialDependente").val(item.sequencialDependente);

            if (item.dependentePrincipal == 1) {
                $('#dependentePrincipal').prop('checked', true);
                item["dependentePrincipal"] = true;

            } else {
                item['dependentePrincipal'] = false;
                ($('#dependentePrincipal').prop('checked', false));
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
                            var cpf = piece[3];
                            var rg = piece[4];
                            var dataNascimento = piece[5];
                            var genero = piece[6];
                            var estadoCivil = piece[7];
                            var primeiroEmprego = piece[8];
                            var pispasep = piece[9];

                            //Associa as varíaveis recuperadas pelo javascript com seus respectivos campos html.
                            $("#codigo").val(id);
                            $("#nome").val(nome);
                            $("#cpf").val(cpf);
                            $("#rg").val(rg);
                            $("#dataNascimento").val(dataNascimento);
                            $("#genero").val(genero);
                            $("#estadoCivil").val(estadoCivil);
                            $("#primeiroEmprego").val(primeiroEmprego);
                            $("#pispasep").val(pispasep);


                            validarDataDependente();


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

    function verificaPrimeiroEmprego() {
        let primeiroEmprego = ($("#primeiroEmprego").val())

        if (primeiroEmprego == 1) {
            $("#pispasep").addClass("readonly");
            $("#pispasep").prop("disabled", true);
            $("#pispasep").val('');
        } else if (primeiroEmprego == 0) {
            $("#pispasep").val('');
            $("#pispasep").prop("disabled", false);
            $("#pispasep").removeAttr("disabled");
            $("#pispasep").removeClass("readonly");
            $("#pispasep").addClass("required");
        }
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
        var cpf = $("#cpf").val();
        validaCPF(cpf);
    }

    function validarCPFDependente() {
        var cpfDependente = $("#cpfDependente").val();
        validaCPFDependente(cpfDependente);
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
        var genero = $("#genero").val();
        var estadoCivil = $("#estadoCivil").val();
        var dataNascimento = $("#dataNascimento").val();
        var cep = $("#cep").val();
        var logradouro = $("#logradouro").val();
        var bairro = $("#bairro").val();
        var numero = $("#numero").val();
        var complemento = $("#complemento").val();
        var uf = $("#uf").val();
        var cidade = $("#cidade").val();
        var primeiroEmprego = $("#primeiroEmprego").val();
        var pispasep = $("#pispasep").val();
        var jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
        var jsonEmailArray = JSON.parse($("#jsonEmail").val());
        var jsonDependenteArray = JSON.parse($("#jsonDependente").val());

        if (!nome) {
            smartAlert("Atenção", "Informe o nome", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (nome.length === 0 || !nome.trim()) {
            smartAlert("Atenção", "Informe o nome!", "error");
            $("#nome").focus();
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

        gravaFuncionario(id, ativo,
            nome,
            cpf,
            rg,
            genero,
            estadoCivil,
            dataNascimento,
            cep,
            logradouro,
            bairro,
            numero,
            complemento,
            uf,
            cidade,
            primeiroEmprego,
            pispasep,
            jsonTelefoneArray,
            jsonEmailArray,
            jsonDependenteArray);
    }
</script>