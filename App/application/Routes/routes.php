<?php

/**
 * Arquivo com as rotas do sistema
 *
 * @author Jônatas Ramos
 */

use App\Config\Router;

$app = new Router();

/**
 * Medic index
 */
$app->get('/', function () {
  return \App\Controllers\MedicController::index();
});

/**
 * Page create medic
 */
$app->get('/create_medic', function () {
    return \App\Controllers\MedicController::create();
});

/**
 * Page edit medic
 */
$app->get('/edit_medic', function () {
    return \App\Controllers\MedicController::edit();
});

/**
 * Salva o médico
 */
$app->post('/save_medic', function () {
    return \App\Controllers\MedicController::save();
});

/**
 * Atualiza os dados médico
 */
$app->post('/update_medic', function () {
    return \App\Controllers\MedicController::update();
});

/**
 * Remove os dados médico
 */
$app->get('/delete_medic', function () {
    return \App\Controllers\MedicController::delete();
});

$app->run();
