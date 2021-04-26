<?php

use function App\Helpers\getError;
use function App\Helpers\getSuccess;

self::view('includes/header');
extract($medic);
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1><?= $title ?></h1>
            </div>
            <?php
            getError();
            getSuccess();
            ?>
            <div class="row col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <fieldset>
                        <form enctype="multipart/form-data" method="post" action="?r=/update_medic" class="">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="form-group col-md-12">
                                <label for="name">Nome:</label>
                                <input data-parsley-minlength="3" value="<?= $name ?>" type="text" required
                                       class="form-control" id="name" name="name" placeholder="Nome do Médico">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="crm">CRM:</label>
                                <input value="<?= $crm ?>" type="text" maxlength="8" required class="form-control"
                                       id="crm" name="crm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Telefone:</label>
                                <input value="<?= $phone ?>" type="text" required class="form-control phone" id="phone"
                                       name="phone">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="specialty">Especialidades:</label>
                                <select multiple="" class="chosen-select form-control tag-input-style" id="specialty"
                                        name="specialty[]" data-placeholder="Selecione">
                                    <?php
                                    foreach ($specialty as $item) {
                                        $selected = false;
                                        foreach ($medic_specialty as $specialty) {
                                            if ($specialty['id'] == $item['id']) {
                                                $selected = true;
                                            }
                                        }
                                        echo "<option " . ($selected ? 'selected' : '') . " value='" . $item['id'] . "'> " . $item['name'] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <br><br>
                                <a href="?r=/">
                                    <button type="button" name="button" class="btn btn-info">
                                        Voltar
                                    </button>
                                </a>
                                <button type="submit" class="btn btn-success pull-right">
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
            <br>
            <!-- /.page-header -->
        </div>
        <!-- /.page-content -->
    </div>
</div>
<!-- /.main-content -->
<!-- basic scripts -->
</div>
<!--[if !IE]> -->
<?= self::view('includes/footer') ?>
