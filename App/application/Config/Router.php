<?php

namespace App\Config;

/**
 * Classe de responsável pela adiminstração das rotas
 *
 * @author Jônatas Ramos
 */
class Router
{
    private $routes = [];
    private static $params = [];

    /**
     * Verifica se método chamado é GET ou POST
     *
     * @param { String } $method
     * @return { Bool }
     */
    private function validate(string $method)
    {
        return in_array($method, ['get', 'post']);
    }

    /**
     * Chamado sempre que existe uma chamada nessa classe, caso a chamada
     * seja válida, irá separar e validar os argumentos recebidos, devendo receber
     * uma string e uma função. E por fim armazena no array de rotas, com a estrutura:
     *   array(2) {
     *       ["get"]=> array(3) {
     *          ["/"]=> object(Closure)#2 (0) { }
     *          ...
     *       }
     *       ["post"]=> array(1) {
     *          ["/list"]=> object(Closure)#5 (0) { }
     *          ...
     *       }
     *   }
     *
     * @param { String } $method
     * @param { Array } $args
     * @return { Bool }
     */
    public function __call(string $method, array $args)
    {
        $method = strtolower($method);

        if (!$this->validate($method)) {
            return false;
        }

        [$route, $action] = $args;

        if (!isset($action) or !is_callable($action)) {
            return false;
        }

        $this->routes[$method][$route] = $action;
        return true;
    }

    /**
     *   Dá início a aplicação, verificando se existem rotas
     *   com o método HTTP atual (post ou get), se existe a rota definida pelo
     *   parâmetro GET r. E por fim chamando o callable da rota correspondente,
     *   finalizando a aplicação exibindo o seu retorno (a resposta do Controller).
    */
    public function run()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
        $route = $_GET['r'] ?? '/';

        if (!isset($this->routes[$method])) {
            die('405 Método desconhecido');
        }

        if (!isset($this->routes[$method][$route])) {
            die('404 Error');
        }

        self::$params = $this->getParams($method);

        die($this->routes[$method][$route]());
    }

    /**
     *  Pega as variáveis correspondente ao método atual.
     *
     * @param  { String } $method
     * @return { Object }
    */
    private function getParams(string $method)
    {
        if ($method == 'get') {
            return $_GET;
        }

        return $_POST;
    }

    /**
     *  Getter para que controlador possa pegar os dados da requisição
    */
    public static function getRequest()
    {
        return self::$params;
    }
}
