<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 8/30/14
 * Time: 12:54 AM
 */

namespace Entity;


class Client extends System {
    protected $id;
    protected $clientFirstName;
    protected $clientLastName;
    protected $clientGender;
    protected $clientEmail;
    protected $clientPhone;
    protected $clientAddress;
    protected $clientTown;
    protected $clientIdNo;

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

    /**
     * @param mixed $clientAddress
     */
    public function setClientAddress($clientAddress)
    {
        $this->clientAddress = $clientAddress;
    }

    /**
     * @return mixed
     */
    public function getClientAddress()
    {
        return $this->clientAddress;
    }

    /**
     * @param mixed $clientEmail
     */
    public function setClientEmail($clientEmail)
    {
        $this->clientEmail = $clientEmail;
    }

    /**
     * @return mixed
     */
    public function getClientEmail()
    {
        return $this->clientEmail;
    }

    /**
     * @param mixed $clientFirstName
     */
    public function setClientFirstName($clientFirstName)
    {
        $this->clientFirstName = $clientFirstName;
    }

    /**
     * @return mixed
     */
    public function getClientFirstName()
    {
        return $this->clientFirstName;
    }

    /**
     * @param mixed $clientGender
     */
    public function setClientGender($clientGender)
    {
        $this->clientGender = $clientGender;
    }

    /**
     * @return mixed
     */
    public function getClientGender()
    {
        return $this->clientGender;
    }

    /**
     * @param mixed $clientIdNo
     */
    public function setClientIdNo($clientIdNo)
    {
        $this->clientIdNo = $clientIdNo;
    }

    /**
     * @return mixed
     */
    public function getClientIdNo()
    {
        return $this->clientIdNo;
    }

    /**
     * @param mixed $clientLastName
     */
    public function setClientLastName($clientLastName)
    {
        $this->clientLastName = $clientLastName;
    }

    /**
     * @return mixed
     */
    public function getClientLastName()
    {
        return $this->clientLastName;
    }

    /**
     * @param mixed $clientPhone
     */
    public function setClientPhone($clientPhone)
    {
        $this->clientPhone = $clientPhone;
    }

    /**
     * @return mixed
     */
    public function getClientPhone()
    {
        return $this->clientPhone;
    }

    /**
     * @param mixed $clientTown
     */
    public function setClientTown($clientTown)
    {
        $this->clientTown = $clientTown;
    }

    /**
     * @return mixed
     */
    public function getClientTown()
    {
        return $this->clientTown;
    }

    public function createClient(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO client
        (client_first_name,client_last_name,client_email,client_phone,client_address,client_town,client_gender,client_id_no)
        VALUES
        ('$this->clientFirstName','$this->clientLastName','$this->clientEmail','$this->clientPhone','$this->clientAddress',
        '$this->clientTown','$this->clientGender','$this->clientIdNo')
        ");
        if($result = $em->persist()){
            return "Record successfully added!";
        }

        return "Error: ".mysql_error();
    }

    public function updateClient(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE client
        SET
        client_first_name='$this->clientFirstName',client_last_name='$this->clientLastName',client_email='$this->clientEmail',
        client_phone='$this->clientPhone',client_address='$this->clientAddress',client_town='$this->clientTown',
        client_gender='$this->clientGender',client_id_no='$this->clientIdNo'
        WHERE id = '$this->id'
        ");
        if($result = $em->persist()){
            return "Record successfully updated!";
        }

        return "Error: ".mysql_error();
    }
    public function deleteClient(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM client
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 