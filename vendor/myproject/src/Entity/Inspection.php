<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 10:05 PM
 */

namespace Entity;


class Inspection extends  System {
    protected $id;
    protected $propId;
    protected $staffId;
    protected $insDescription;
    protected $insDate;
    protected $insStatus;

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
     * @param mixed $insDate
     */
    public function setInsDate($insDate)
    {
        $this->insDate = $insDate;
    }

    /**
     * @return mixed
     */
    public function getInsDate()
    {
        return $this->insDate;
    }

    /**
     * @param mixed $insDescription
     */
    public function setInsDescription($insDescription)
    {
        $this->insDescription = $insDescription;
    }

    /**
     * @return mixed
     */
    public function getInsDescription()
    {
        return $this->insDescription;
    }

    /**
     * @param mixed $insStatus
     */
    public function setInsStatus($insStatus)
    {
        $this->insStatus = $insStatus;
    }

    /**
     * @return mixed
     */
    public function getInsStatus()
    {
        return $this->insStatus;
    }

    /**
     * @param mixed $propId
     */
    public function setPropId($propId)
    {
        $this->propId = $propId;
    }

    /**
     * @return mixed
     */
    public function getPropId()
    {
        return $this->propId;
    }

    /**
     * @param mixed $staffId
     */
    public function setStaffId($staffId)
    {
        $this->staffId = $staffId;
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staffId;
    }

    public function createInspection(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO inspection
        (prop_id,staff_id,report,ins_status,ins_date)
        VALUES
        ('$this->propId','$this->staffId','$this->insDescription','$this->insStatus','$this->insDate')
        ");

        if($res = $em->persist()){
            return 'Successfully added!';
        }

        return 'Error: '.mysql_error();
    }

    public function updateInspection(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE  inspection
        SET
        prop_id='$this->propId',staff_id='$this->staffId',report='$this->insDescription',ins_status='$this->insStatus',
        ins_date='$this->insDate'
        WHERE id= '$this->id'
        ");

        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteInspection(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM inspection
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 