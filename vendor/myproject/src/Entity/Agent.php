<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/4/14
 * Time: 9:54 PM
 */

namespace Entity;


class Agent extends  System{
    protected $id;
    protected $agName;
    protected $agIdNo;
    protected $agPhone;
    protected $agAddress;
    protected $agEmail;

    /**
     * @param mixed $agAddress
     */
    public function setAgAddress($agAddress)
    {
        $this->agAddress = $agAddress;
    }

    /**
     * @return mixed
     */
    public function getAgAddress()
    {
        return $this->agAddress;
    }

    /**
     * @param mixed $agEmail
     */
    public function setAgEmail($agEmail)
    {
        $this->agEmail = $agEmail;
    }

    /**
     * @return mixed
     */
    public function getAgEmail()
    {
        return $this->agEmail;
    }

    /**
     * @param mixed $agIdNo
     */
    public function setAgIdNo($agIdNo)
    {
        $this->agIdNo = $agIdNo;
    }

    /**
     * @return mixed
     */
    public function getAgIdNo()
    {
        return $this->agIdNo;
    }

    /**
     * @param mixed $agName
     */
    public function setAgName($agName)
    {
        $this->agName = $agName;
    }

    /**
     * @return mixed
     */
    public function getAgName()
    {
        return $this->agName;
    }

    /**
     * @param mixed $agPhone
     */
    public function setAgPhone($agPhone)
    {
        $this->agPhone = $agPhone;
    }

    /**
     * @return mixed
     */
    public function getAgPhone()
    {
        return $this->agPhone;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function createAgent(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO agent
        (ag_name,ag_idno,ag_phone,ag_email,ag_address)
        values
        ('$this->agName','$this->agIdNo','$this->agPhone','$this->agEmail','$this->agAddress')
        ");
        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }
    public function updateAgent(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE agent
        SET
        ag_name='$this->agName',ag_idno='$this->agIdNo',ag_phone='$this->agPhone',ag_email='$this->agEmail',
        ag_address='$this->agAddress'
        WHERE id = '$this->id'
        ");
        if($result = $em->persist()){
            return "Record successfully udpated";
        }

        return "Error".mysql_error();
    }
    public function deleteAgent(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM agent
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 