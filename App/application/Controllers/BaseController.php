<?php
namespace App\Controllers;
use App\Config\Router;

/**
* Classe BaseController
* @author Jonatas Ramos
*
* Controller Base do sistema
*/

abstract class BaseController {

  /**
  * Realiza o inlcude do arquivo da view em aberto
  *
  * @param { String } $name  - nome da view
  * @param { Array }  $params - variáveis enviadas para view
  */
  protected final function view(string $name, array $params = []) {
      $_filename = __DIR__."/../../views/{$name}.php";
      if(!file_exists($_filename)) {
        die("Página {$name} não encontrada!");
      }

      extract($params);
      include_once $_filename;
  }

  /**
  * Retorna as variáveis enviadas na view
  *
  * @param { String } $name - nome da variável enviada
  */
  protected final function getParams(string $name) {
      $params = Router::getRequest();

      if(!isset($params[$name])) {
        return null;
      }

      return $params[$name];
  }
}
