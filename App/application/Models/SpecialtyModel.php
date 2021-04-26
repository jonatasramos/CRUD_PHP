<?php

namespace App\Models;

/**
 * Classe SpecialtyModel
 *
 * @author Jonatas Ramos
 *
 * Model de integração com a tabela specialty
 */

final class SpecialtyModel extends BaseModel
{
    /**
     * @var $table - nome da tabela do model
     */
    private $table = 'specialty';

    /**
     * Busca todos os dados da tabela specialty
     */
    public function find()
    {
        return self::read($this->table);
    }
}