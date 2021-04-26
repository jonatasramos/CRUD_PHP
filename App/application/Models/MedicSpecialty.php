<?php
namespace App\Models;

/**
 * Classe MedicSpecialty
 *
 * @author Jonatas Ramos
 */

class MedicSpecialty
{
    /**
     * @var $id
     */
    private $id;
    /**
     * @var $medic_id
     */
    private $medic_id;
    /**
     * @var $specialty_id
     */
    private $specialty_id;

    /**
     * getId
     *
     * @return { Int } id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setId
     *
     * @param { Int } $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getMedicId
     *
     * @return { Int } medic_id
     */
    public function getMedicId()
    {
        return $this->medic_id;
    }

    /**
     * setMedicId
     *
     * @param { Int } $medic_id
     */
    public function setMedicId($medic_id)
    {
        $this->medic_id = $medic_id;
    }

    /**
     * getSpecialtyId
     *
     * @return { Int } specialty_id
     */
    public function getSpecialtyId()
    {
        return $this->specialty_id;
    }

    /**
     * setSpecialtyId
     *
     * @param { Int } $specialty_id
     */
    public function setSpecialtyId($specialty_id)
    {
        $this->specialty_id = $specialty_id;
    }
}