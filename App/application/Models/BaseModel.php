<?php

namespace App\Models;

use App\Config\Connection;
use PDO;

/**
 * Classe BaseModel
 * @author Jonatas Ramos
 *
 * Model base para manipulação do banco de dados
 */
abstract class BaseModel
{
    /**
     * @var PDO|null
     */
    public $conn;

    /**
     * BaseModel constructor.
     */
    public function __construct()
    {
        $conn = new Connection();
        $this->conn = $conn->getConn();
    }

    /**
     * Insere em uma tabela dinâmicamente
     *
     * @param { String }- $table
     * @param { Array } - $data
     */
    protected final function insert(string $table, array $data)
    {
        $conn = $this->conn;

        try {
            $fileds = implode(', ', array_keys($data));
            $places = ':' . implode(', :', array_keys($data));
            $stmt = $conn->prepare("INSERT INTO {$table} ({$fileds}) VALUES ({$places})");
            $stmt->execute($data);

            return $conn->lastInsertId();
        } catch (\Throwable $th) {
            return 0;
        }
    }

    /**
     * Busca dados no banco de dados de a cordo com os dados informados
     *
     * @param { String } $table - tabela do banco de dados
     * @param { String } $terms - WHERE | ORDER | LIMIT :limit | OFFSET :offset
     * @param { String } $data - link={$link}&link2={$link2}
     */
    protected final function read(string $table, string $terms = null, string $data = null)
    {
        $conn = $this->conn;

        try {
            $query = "SELECT * FROM {$table} {$terms}";
            $stmt = $conn->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            parse_str($data, $parse);
            if ($data) {
                foreach ($parse as $key => $value) {
                    if ($key == 'limit' || $key == 'offset') {
                        $value = (int)$value;
                    }
                    $stmt->bindValue(":{$key}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
                }
            }

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Atualiza registros no banco de dados de acordo com os dados informados
     *
     * @param { String } $table - Nome da tabela
     * @param { Array } $data - [ NomeDaColuna ] => Valor ( Atribuição )
     * @param { String } $termos - WHERE coluna = :link AND.. OR..
     * @param { String } $parseString - link={$link}&link2={$link2}
     */
    protected final function update(string $table, array $data, string $terms, string $parsestring)
    {
        $conn = $this->conn;

        try {
            parse_str($parsestring, $parse);

            foreach ($data as $key => $value) {
                $places[] = $key . ' = :' . $key;
            }

            $places = implode(', ', $places);
            $stmt = $conn->prepare("UPDATE {$table} SET {$places} {$terms}");
            $stmt->execute(array_merge($data, $parse));

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Deleta registros no banco de dados de acordo com os dados informados
     *
     * @param { String } $table - Nome da tabela
     * @param { String } $termos - WHERE coluna = :link AND.. OR..
     * @param { String } $parseString - link={$link}&link2={$link2}
     */
    protected final function delete(string $table, string $terms, string $parsestring)
    {
        $conn = $this->conn;

        try {
            parse_str($parsestring, $parse);

            $stmt = $conn->prepare("DELETE FROM {$table} {$terms}");
            $stmt->execute($parse);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Executa uma consulta genérica no banco de dados
     *
     * @param { String } $query - SELECT * FROM tabela WHERE id = :id
     * @param { String } $parseString - link={$link}&link2={$link2}
     */
    protected final function query(string $query, string $parsestring = null)
    {
        $conn = $this->conn;

        try {
            parse_str($parsestring, $parse);

            $stmt = $conn->prepare($query);
            $stmt->execute($parse);
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
