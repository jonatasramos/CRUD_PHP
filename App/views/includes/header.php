<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Cadastro</title>

    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <?= self::view('includes/include.css') ?>
</head>

<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
<body class="no-skin">

    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="/" class="navbar-brand">
                <small>
                    <i class="fa fa-cogs"></i>
                </small>
            </a>
        </div>
    </div><!-- /.navbar-container -->
</div>
<div class="main-container ace-save-state container" id="main-container">
    <?= self::view('includes/navigation', isset($data) ? $data : []) ?>
