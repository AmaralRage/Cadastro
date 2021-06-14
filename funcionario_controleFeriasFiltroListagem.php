<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <th class="text-center" style="min-width:30px;">Funcionário</th>
                    <th class="text-center" style="min-width:30px;">Projeto</th>
                    <th class="text-center" style="min-width:30px;">Período Aquisitivo - Início</th>
                    <th class="text-center" style="min-width:30px;">Período Aquisitivo - Fim</th>
                    <th class="text-center" style="min-width:30px;">Situação Férias</th>
                    <th class="text-center" style="min-width:30px;">Dias Vencidos</th>
                    <th class="text-center" style="min-width:30px;">Décimo Terceiro</th>
                    <th class="text-center" style="min-width:30px;">Abono</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $where = " WHERE (0=0) ";
                $projeto = (int) $_GET["projeto"];
                $funcionario = $_GET["funcionario"];

                $feriasSolicitadasInicio = $_GET["feriasSolicitadasInicio"];

                if ($feriasSolicitadasInicio != "") {
                    $aux = explode(' ', $feriasSolicitadasInicio);
                    $data = $aux[1] . ' ' . $aux[0];
                    $data = $aux[0];
                    $data =  trim($data);
                    $aux = explode('/', $data);
                    $data = $aux[2] . '-' . $aux[1] . '-' . $aux[0];
                    $data =  trim($data);
                    $feriasSolicitadasInicio = $data;
                } else {
                    $feriasSolicitadasInicio = '';
                };
                $feriasSolicitadasFim = $_GET["feriasSolicitadasFim"];
                if ($feriasSolicitadasFim != "") {
                    $aux = explode(' ', $feriasSolicitadasFim);
                    $data = $aux[1] . ' ' . $aux[0];
                    $data = $aux[0];
                    $data =  trim($data);
                    $aux = explode('/', $data);
                    $data = $aux[2] . '-' . $aux[1] . '-' . $aux[0];
                    $data =  trim($data);
                    $feriasSolicitadasFim = $data;
                } else {
                    $feriasSolicitadasFim = '';
                };

                $feriasVencidas = (int)$_GET["feriasVencidas"];


                if ($projeto != 0) {

                    $where = $where . " AND CF.projeto = " . $projeto;
                }

                if ($funcionario != "") {

                    $where = $where . " AND CF.funcionario = " . $funcionario;
                }
                if ($feriasSolicitadasInicio != '') {

                    $where = $where . " AND CS.feriasSolicitadasInicio = " . "'" . $feriasSolicitadasInicio . "'";
                }
                if ($feriasSolicitadasFim != '') {

                    $where = $where . " AND CS.feriasSolicitadasFim = " . "'" . $feriasSolicitadasFim . "'";
                }



                $reposit = new reposit();
                $sql = "SELECT CF.codigo, CF.funcionario, F.nome, CF.projeto, P.descricao, CS.situacaoFerias,CS.periodoAquisitivoInicio, CS.adiantamentoDecimo, CS.abono
                FROM funcionario.controleFerias CF
                   INNER JOIN funcionario.controleFeriasSolicitacao CS ON controleFeriasSolicitacao = CF.codigo
                   INNER JOIN ntl.funcionario F ON F.codigo = CF.funcionario
                   INNER JOIN ntl.projeto P ON P.codigo = CF.projeto";
                $sql = $sql . $where;

                $result = $reposit->RunQuery($sql);
                foreach ($result as $row) {

                    $codigo = (int) $row['codigo'];
                    $projeto = $row['descricao'];
                    $funcionario = $row['nome'];

                    $feriasAgendadasInicio = $row['feriasAgendadasInicio'];
                    if ($feriasAgendadasInicio != "" && $feriasAgendadasInicio != "1900-01-01 00:00:00.000") {
                        $aux = explode(' ', $feriasAgendadasInicio);
                        $data = $aux[1] . ' ' . $aux[0];
                        $data = $aux[0];
                        $data =  trim($data);
                        $aux = explode('-', $data);
                        $data = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                        $data =  trim($data);
                        $feriasAgendadasInicio = $data;
                    } else {
                        $feriasAgendadasInicio = '';
                    };

                    $feriasAgendadasFim = $row['feriasAgendadasFim'];
                    if ($feriasAgendadasFim != "" && $feriasAgendadasFim != "1900-01-01 00:00:00.000") {
                        $aux = explode(' ', $feriasAgendadasFim);
                        $data = $aux[1] . ' ' . $aux[0];
                        $data = $aux[0];
                        $data =  trim($data);
                        $aux = explode('-', $data);
                        $data = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                        $data =  trim($data);
                        $feriasAgendadasFim = $data;
                    } else {
                        $feriasAgendadasFim = '';
                    };


                    $situacaoFerias = (int)$row['situacaoFerias'];
                    $adiantamentoDecimo = (int)$row['adiantamentoDecimo'];
                    $abono = (int)$row['abono'];


                    $periodoAquisitivoInicio = $row['periodoAquisitivoInicio'];
                    $periodoAquisitivoFim = $row['periodoAquisitivoFim'];

                    //Início da conta de validade
                    $aux = explode(' ',  $periodoAquisitivoInicio);
                    $data = $aux[1] . ' ' . $aux[0];
                    $periodoAquisitivo = $aux[0];

                    $dataAtual = date('Y-m-d');
                    $diferenca = strtotime($dataAtual) - strtotime($periodoAquisitivo);
                    $validade = floor($diferenca / (1000 * 60 * 60 * 24));


                    //Fim da conta de validade

                    if ($periodoAquisitivoInicio != "" && $periodoAquisitivoInicio != "1900-01-01 00:00:00.000") {
                        $aux = explode(' ', $periodoAquisitivoInicio);
                        $data = $aux[1] . ' ' . $aux[0];
                        $data = $aux[0];
                        $data =  trim($data);
                        $aux = explode('-', $data);
                        $data = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                        $data =  trim($data);
                        $periodoAquisitivoInicio = $data;
                    } else {
                        $periodoAquisitivoInicio = '';
                    };

                    if ($dataAtual != "" && $dataAtual != "1900-01-01 00:00:00.000") {
                        $aux = explode(' ', $dataAtual);
                        $data = $aux[1] . ' ' . $aux[0];
                        $data = $aux[0];
                        $data =  trim($data);
                        $aux = explode('-', $data);
                        $data = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                        $data =  trim($data);
                        $dataAtual = $data;
                    } else {
                        $dataAtual = '';
                    };


                    if ($feriasVencidas == 1 && $validade > 0) {
                        echo '<tr >';
                        echo '<td class="text-center"><a href="funcionario_controleFerias.php?codigo=' . $codigo . '">' . $funcionario . '</a></td>';
                        echo '<td class="text-center">' .  $projeto . '</td>';
                        echo '<td class="text-center">' .  $periodoAquisitivoInicio . '</td>';
                        echo '<td class="text-center">' .  $dataAtual . '</td>';
                        if ($situacaoFerias == 1) {
                            echo '<td class="text-center" style="color:red; font-weight: bold;">' . '' . '</td>';
                        } else {
                            echo '<td class="text-center"  style="color:red; font-weight: bold;">' . 'Vencida' . '</td>';
                        }
                        echo '<td class="text-center">' .  $validade . '</td>';

                        if ($adiantamentoDecimo == 1) {
                            echo '<td class="text-center">' . 'Sim' . '</td>';
                        } else {
                            echo '<td class="text-center">' . 'Não' . '</td>';
                        }
                        if ($abono == 1) {
                            echo '<td class="text-center">' . 'Sim' . '</td>';
                        } else {
                            echo '<td class="text-center">' . 'Não' . '</td>';
                        }

                        echo '</tr >';
                    }
                    if ($feriasVencidas == 0 && $validade <= 0) {
                        echo '<tr >';
                        echo '<td class="text-center"><a href="funcionario_controleFerias.php?codigo=' . $codigo . '">' . $funcionario . '</a></td>';
                        echo '<td class="text-center">' .  $projeto . '</td>';
                        echo '<td class="text-center">' .  $periodoAquisitivoInicio . '</td>';
                        echo '<td class="text-center">' .  $dataAtual . '</td>';
                        if ($situacaoFerias == 1) {
                            echo '<td class="text-center" style="color:red; font-weight: bold;">' . '' . '</td>';
                        } else {
                            echo '<td class="text-center"  style="color:red; font-weight: bold;">' . 'Vencida' . '</td>';
                        }
                        echo '<td class="text-center">' .  $validade . '</td>';

                        if ($adiantamentoDecimo == 1) {
                            echo '<td class="text-center">' . 'Sim' . '</td>';
                        } else {
                            echo '<td class="text-center">' . 'Não' . '</td>';
                        }
                        if ($abono == 1) {
                            echo '<td class="text-center">' . 'Sim' . '</td>';
                        } else {
                            echo '<td class="text-center">' . 'Não' . '</td>';
                        }

                        echo '</tr >';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/plugin/Buttons-1.5.2/css/buttons.dataTables.min.css" />

<script type="text/javascript" src="js/plugin/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="js/plugin/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="js/plugin/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="js/plugin/Buttons-1.5.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* TABLETOOLS */
        $('#tableSearchResult').dataTable({

            // Tabletools options:
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'B'l'C>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                //"sLengthMenu": "_MENU_ Resultados por página",
                "sLengthMenu": "_MENU_",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "buttons": [
                //{extend: 'copy', className: 'btn btn-default'},
                //{extend: 'csv', className: 'btn btn-default'},
                {
                    extend: 'excel',
                    className: 'btn btn-default'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-default'
                },
                //{extend: 'print', className: 'btn btn-default'}
            ],
            "autoWidth": true,

            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($(
                        '#tableSearchResult'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });

        /* END TABLETOOLS */
    });
</script>