<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/4/14
 * Time: 10:08 PM
 */

namespace Entity;


class DeviceIssue extends System {
    protected $id;
    protected $disEmployee;
    protected $disDevSN;
    protected $disArea;
    protected $disPIN;
    protected $disIssuedBy;
    protected $disStatus;

    /**
     * @param mixed $disArea
     */
    public function setDisArea($disArea)
    {
        $this->disArea = $disArea;
    }

    /**
     * @return mixed
     */
    public function getDisArea()
    {
        return $this->disArea;
    }

    /**
     * @param mixed $disIssuedBy
     */
    public function setDisIssuedBy($disIssuedBy)
    {
        $this->disIssuedBy = $disIssuedBy;
    }

    /**
     * @return mixed
     */
    public function getDisIssuedBy()
    {
        return $this->disIssuedBy;
    }

    /**
     * @param mixed $disDevSN
     */
    public function setDisDevSN($disDevSN)
    {
        $this->disDevSN = $disDevSN;
    }

    /**
     * @return mixed
     */
    public function getDisDevSN()
    {
        return $this->disDevSN;
    }

    /**
     * @param mixed $disEmployee
     */
    public function setDisEmployee($disEmployee)
    {
        $this->disEmployee = $disEmployee;
    }

    /**
     * @return mixed
     */
    public function getDisEmployee()
    {
        return $this->disEmployee;
    }

    /**
     * @param mixed $disPIN
     */
    public function setDisPIN($disPIN)
    {
        $this->disPIN = $disPIN;
    }

    /**
     * @return mixed
     */
    public function getDisPIN()
    {
        return $this->disPIN;
    }

    /**
     * @param mixed $disStatus
     */
    public function setDisStatus($disStatus)
    {
        $this->disStatus = $disStatus;
    }

    /**
     * @return mixed
     */
    public function getDisStatus()
    {
        return $this->disStatus;
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

    public function createDeviceIssue(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO deviceissue
        (dis_emp,dis_dev,dis_area,dis_pin,dis_status,dis_issued_by)
        VALUES
        ('$this->disEmployee','$this->disDevSN','$this->disArea','$this->disPIN','$this->disStatus','$this->disIssuedBy')
        ");
        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }

    public function updateDeviceIssue(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE deviceissue
        SET
        dis_emp='$this->disEmployee',dis_dev='$this->disDevSN',dis_area='$this->disArea',dis_pin='$this->disPIN',
        dis_status='$this->disStatus',dis_issued_by = '$this->disIssuedBy'
        WHERE id='$this->id'
        ");

        if($result = $em->persist()){
            return "Record successfully updated";
        }

        return "Error".mysql_error();
    }

    public function deleteDeviceIssue(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM deviceissue
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }


} 