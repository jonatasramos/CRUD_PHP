<?php

namespace App\Models;

use App\Models\Medic;
use App\Models\MedicSpecialtyModel;
use function \App\Helpers\onlyNumbers;

/**
 * Classe MedicModel
 * @author Jonatas Ramos
 *
 * Model de integração com a tabela medic
 */
final class MedicModel extends BaseModel
{
    /**
     * @var $table - nome da tabela do model
     */
    private $table = 'medic';

    /**
     * Busca todos os dados da tabela medic
     */
    public function find()
    {
        return self::read($this->table);
    }

    /**
     * Busca os dados de um médico por id
     *
     * @param { Number } - $id
     * @return { Array } - médicos
     */
    public function findById($id)
    {
        return self::read($this->table, 'WHERE id = :id', "id={$id}");
    }

    /**
     * Salva um registro de médico
     *
     * @param { Array } - $data
     */
    public function save($data)
    {
        try {
            $Medic = new Medic();
            $Medic->setName($data['name']);
            $Medic->setCRM($data['crm']);
            $Medic->setPhone($data['phone']);
            $Medic->setCreatedAt(date('Y-m-d H:i:s'));

            $data_insert = [
                'name' => $Medic->getName(),
                'crm' => $Medic->getCrm(),
                'phone' => $Medic->getPhone(),
                'created_at' => $Medic->getCreatedAt()
            ];

            $medic_id = self::insert($this->table, $data_insert);
            if ($medic_id) {
                foreach ($data['specialty'] as $specialty_id) {
                    $MedicSpecialtyModelNew = new MedicSpecialtyModel();
                    $MedicSpecialtyModelNew->save([
                        'medic_id' => $medic_id,
                        'specialty_id' => $specialty_id
                    ]);
                }
            }
            return $medic_id;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Edita o registro de médico
     *
     * @param { Array } - $data
     */
    public function edit($data)
    {
        try {
            $Medic = new Medic();
            $Medic->setId($data['id']);

            if ($Medic->getId()) {
                $Medic->setName($data['name']);
                $Medic->setCRM($data['crm']);
                $Medic->setPhone($data['phone']);

                $data_update = [
                    'name' => $Medic->getName(),
                    'crm' => $Medic->getCrm(),
                    'phone' => $Medic->getPhone()
                ];

                $update_medic = self::update($this->table, $data_update, 'WHERE id = :id', "id={$Medic->getId()}");
                if ($update_medic) {
                    $MedicSpecialtyModel = new MedicSpecialtyModel();
                    $MedicSpecialtyModel->destroy($Medic->getId());

                    foreach ($data['specialty'] as $specialty_id) {
                        $MedicSpecialtyModelNew = new MedicSpecialtyModel();
                        $MedicSpecialtyModelNew->save([
                            'medic_id' => $Medic->getId(),
                            'specialty_id' => $specialty_id
                        ]);
                    }
                }
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Deleta um Médico
     *
     * @param { Number } $id
     */
    public function destroy($id)
    {
        try {
            if ($id) {
                $Medic = new Medic();
                $Medic->setId($id);

                $MedicSpecialtyModel = new MedicSpecialtyModel();
                $MedicSpecialtyModel->destroy($Medic->getId());

                return self::delete($this->table, 'WHERE id = :id', "id={$Medic->getId()}");
            }
        } catch (Exception $e) {
            return false;
        }
    }
}