<?php

use function \App\Helpers\formatPhone;
use function App\Helpers\getError;
use function App\Helpers\getSuccess;

self::view('includes/header');
?>

<script type="text/javascript">
    try {
        ace.settings.loadState('main-container')
    } catch (e) {
    }
</script>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <?php
            getError();
            getSuccess();
            ?>
            <div class="page-header">
                <h1><?= $title ?></h1>
                <a href="?r=/create_medic">
                    <button type="button" name="button" class="btn btn-info btn-sm pull-right">
                        <i class="fa fa-plus-square-o"></i> Novo Médico
                    </button>
                </a>
            </div><!-- /.page-header -->
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <div class="pull-right tableTools-container">
                            <div class="dt-buttons btn-overlap btn-group">
                            </div>
                        </div>
                    </div>
                    <div class="table-header">
                        Médicos Cadastrados
                    </div>
                    <!-- div.table-responsive -->
                    <!-- div.dataTables_borderWrap -->
                    <div>
                        <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_length" id="dynamic-table_length">
                                    </div>
                                </div>
                            </div>
                            <table id="dynamic-table"
                                   class="table table-striped table-bordered table-hover dataTable no-footer"
                                   role="grid" aria-describedby="dynamic-table_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1"
                                        colspan="1">
                                        #
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1"
                                        colspan="1">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1"
                                        colspan="1">
                                        CRM
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1"
                                        colspan="1">
                                        Telefone
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1"
                                        colspan="1">
                                        Data/Cadastro
                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($medics as $medic) {
                                    extract($medic);
                                    ?>
                                    <tr role="row">
                                        <td class="center">
                                            <?= $id ?>
                                        </td>
                                        <td class="center">
                                            <?= $name ?>
                                        </td>

                                        <td class="center">
                                            <?= $crm ?>
                                        </td>

                                        <td class="center">
                                            <?= formatPhone($phone) ?>
                                        </td>

                                        <td class="center">
                                            <?= date('d/m/Y H:i:s', strtotime($created_at)) ?>
                                        </td>

                                        <td class="center" style='width: 16%;'>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="green"
                                                   href="?r=/edit_medic&i=<?= strrev(base64_encode($id)) ?>">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" onclick="Main.open('#delete-<?= $id ?>')">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>

                                            <div id="delete-<?= $id ?>" style="display: none;">
                                                <strong>Confirmar ?</strong><br>
                                                <a href="?r=/delete_medic&i=<?= strrev(base64_encode($id)) ?>"
                                                   class="btn btn-sm btn-success">Sim</a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="Main.close('#delete-<?= $id ?>')">Não
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<!-- basic scripts -->
</div>
<!--[if !IE]> -->
<?= self::view('includes/footer') ?>
