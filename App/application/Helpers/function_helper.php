<?php

namespace App\Helpers;

/**
 * Funções Auxiliares do sistema
 *
 * @author Jônatas Ramos
 */

/**
 * Redireciona para rota passada por parâmetro
 *
 * @param { String } $rota - rota a ser redirecionada
 */
function redirect(string $rota)
{
    $url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    $folders = explode('?', $_SERVER['REQUEST_URI'])[0];

    header('Location:' . $url . $folders . '?r=' . $rota);
    exit();
}

/**
 * Atribui uma mensagem de erro
 *
 * @param { String } $msg - Mensagem de erro
 */
function setError(string $msg)
{
    setcookie("error", $msg, time() + 2);
}

/**
 * Exibe a mensagem de erro
 *
 */
function getError()
{
    if (isset($_COOKIE['error'])) {
        $msg = $_COOKIE['error'];
        echo "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert'>
                <i class='ace-icon fa fa-times'></i>
            </button>
            <strong>
                {$msg}
            </strong>

        </div>";
    }
}

/**
 * Atribui uma mensagem de sucesso
 *
 * @param { String } $msg - Mensagem de sucesso
 */
function setSuccess(string $msg)
{
    setcookie("success", $msg, time() + 2);
}

/**
 * Exibe a mensagem de sucesso
 *
 */
function getSuccess()
{
    if (isset($_COOKIE['success'])) {
        $msg = $_COOKIE['success'];
        echo "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert'>
                <i class='ace-icon fa fa-times'></i>
            </button>
            <strong>
                {$msg}
            </strong>
        </div>";
    }
}

/**
 * Retorna uma string com apenas com números
 *
 * @param { String } - $str string para extrair os números
 * @return { Number }
 */
function onlyNumbers(string $str)
{
    return (int)preg_replace('/[^0-9]/', '', (string)$str);
}

/**
 * Retorna um telefone formatado
 *
 * @param { String } $phone - String com telefone
 * @return { String }
 */
function formatPhone(string $phone)
{
    return preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) \$2-\$3", $phone);
}
