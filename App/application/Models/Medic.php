<?php
namespace App\Models;

/**
 * Classe Medic
 *
 * @author Jonatas Ramos
 */

class Medic
{
    /**
     * @var $id
     */
    private $id;
    /**
     * @var $name
     */
    private $name;
    /**
     * @var $crm
     */
    private $crm;
    /**
     * @var $phone
     */
    private $phone;
    /**
     * @var $created_at
     */
    private $created_at;

    /**
     * getId
     *
     * @return { Int } - id
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
     * getName
     *
     * @return { String } - name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * seName
     *
     * @param { String } $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * getCrm
     *
     * @return { String } crm
     */
    public function getCrm()
    {
        return $this->crm;
    }

    /**
     * setCrm
     *
     * @param { String } $crm
     */
    public function setCrm($crm)
    {
        $this->crm = $crm;
    }

    /**
     * getPhone
     *
     * @return { String } phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * setPhone
     *
     * @param { String } $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * getCreatedAt
     *
     * @return { String } created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * setCreatedAt
     *
     * @param { String } $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}