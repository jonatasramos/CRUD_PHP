<?php

namespace App\Models;

use \App\Models\MedicSpecialty;

/**
 * Classe MedicSpecialtyModel
 *
 * @author Jonatas Ramos
 *
 * Model de integração com a tabela medic_specialty
 */
final class MedicSpecialtyModel extends BaseModel
{
    /**
     * @var $table - nome da tabela do model
     */
    private $table = 'medic_specialty';

    /**
     * Pega as especialidades do médico
     *
     * @param { Int } $medic_id
     * @return { Array }
     */
    public function findWithSpecialty($medic_id)
    {
        $MedicSpecialty = new MedicSpecialty();
        $MedicSpecialty->setId($medic_id);

        return self::query('SELECT s.id FROM medic_specialty ms 
        INNER JOIN specialty s ON s.id = ms.specialty_id
        WHERE ms.medic_id = :id', "id={$MedicSpecialty->getId()}");
    }

    /**
     * Cadastra uma nova especialidade do médico
     *
     * @param { Array } $data
     * @return { Bool }
     */
    public function save($data)
    {
        try {
            $MedicSpecialty = new MedicSpecialty();
            $MedicSpecialty->setMedicId($data['medic_id']);
            $MedicSpecialty->setSpecialtyId($data['specialty_id']);

            $data_insert = [
                'medic_id' => $MedicSpecialty->getMedicId(),
                'specialty_id' => $MedicSpecialty->getSpecialtyId()
            ];
            return self::insert($this->table, $data_insert);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Remove uma especialidade do médico
     *
     * @param { Number } $medic_id
     */
    public function destroy($medic_id)
    {
        try {
            $MedicSpecialty = new MedicSpecialty();
            $MedicSpecialty->setId($medic_id);
            return self::delete($this->table, 'WHERE medic_id = :id', "id={$MedicSpecialty->getId()}");
        } catch (Exception $e) {
            return false;
        }
    }
}