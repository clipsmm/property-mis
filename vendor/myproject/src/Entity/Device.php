<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/4/14
 * Time: 9:42 PM
 */

namespace Entity;


class Device extends System{
    protected $id;
    protected $deviceSN;
    protected $deviceName;
    protected $deviceIssuedBy;

    /**
     * @param mixed $deviceIssuedBy
     */
    public function setDeviceIssuedBy($deviceIssuedBy)
    {
        $this->deviceIssuedBy = $deviceIssuedBy;
    }

    /**
     * @return mixed
     */
    public function getDeviceIssuedBy()
    {
        return $this->deviceIssuedBy;
    }

    /**
     * @param mixed $deviceName
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
    }

    /**
     * @return mixed
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @param mixed $deviceSN
     */
    public function setDeviceSN($deviceSN)
    {
        $this->deviceSN = $deviceSN;
    }

    /**
     * @return mixed
     */
    public function getDeviceSN()
    {
        return $this->deviceSN;
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

    public function createDevice(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO device
        (dev_sn, dev_name,dev_issued_by)
        VALUES
        ('$this->deviceSN','$this->deviceName','$this->deviceIssuedBy')
        ");

        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }

    public function updateDevice(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE device
        SET
        dev_sn='$this->deviceSN', dev_name='$this->deviceName',dev_issued_by='$this->deviceIssuedBy'
        WHERE id = '$this->id'
        ");

        if($result = $em->persist()){
            return "Record successfully updated";
        }

        return "Error".mysql_error();
    }

    public function deleteDevice(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM device
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 