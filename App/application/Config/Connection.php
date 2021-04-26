<?php

namespace App\Config;

use PDO;
use PDOException;

/**
 * Classe abstrata de conexão. Padrão SingleTon.
 * Retorna um objeto PDO pelo método estático getConn();
 *
 * @author Jonatas Ramos
 */
class Connection
{
    /**
     * @var $host - nome do servidor
     */
    private static $host;
    /**
     * @var $user - usuário do banco de dados
     */
    private static $user;
    /**
     * @var $pass - senha usuário do banco de dados
     */
    private static $pass;
    /**
     * @var $db - nome do banco de dados
     */
    private static $db;
    /**
     * @var $port - porta para a conexão
     */
    private static $port;

    /**
     * @var PDO
     */
    private static $Conn = null;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        self::$host = $_ENV['DB_HOST'];
        self::$user = $_ENV['DB_USER'];
        self::$pass = $_ENV['DB_PASS'];
        self::$db = $_ENV['DB_DATABASE'];
        self::$port = $_ENV['DB_PORT'];
    }

    /**
     * Conecta com o banco de dados com o pattern singleton.
     * Retorna um objeto PDO!
     */
    private static function Connect()
    {
        try {
            if (self::$Conn == null) {
                $dsn = 'mysql:port=' . self::$port . ';host=' . self::$host . ';dbname=' . self::$db;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$Conn = new \PDO($dsn, self::$user, self::$pass, $options);
            }
        } catch (PDOException $e) {
            echo $e->getCode() . ', ' . $e->getMessage() . ', ' . $e->getFile() . ', ' . $e->getLine();
            die;
        }

        self::$Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Conn;
    }

    /**
     * Retorna um objeto PDO Singleton Pattern.
     */
    public static function getConn()
    {
        return self::Connect();
    }
}
