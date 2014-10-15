<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 9:53 PM
 */

namespace Entity;


class Assignment extends System {
    protected $id;
    protected $staffId;
    protected $propId;
    protected $dateAssigned;
    protected $status;

    //relation atttributes
    protected $staff; #the person who is assigned
    public function getStaff(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('staff',$this->id);

        return $enties;
    }

    protected $property;
    public function getProperty(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('property',$this->id);

        return $enties;
    }

    /**
     * @param mixed $dateAssigned
     */
    public function setDateAssigned($dateAssigned)
    {
        $this->dateAssigned = $dateAssigned;
    }

    /**
     * @return mixed
     */
    public function getDateAssigned()
    {
        return $this->dateAssigned;
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

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function createAssignment(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO assignment
        (staff_id,prop_id,date_assigned,status)
        VALUES
        ('$this->staffId','$this->propId','$this->dateAssigned','$this->status')
        ");

        if($res = $em->persist()){
            return 'Successfully added!';
        }

        return 'Error: '.mysql_error();


    }

    public function updateAssignment(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE assignment
        SET
        (staff_id='$this->staffId',prop_id='$this->propId',date_assigned='$this->dateAssigned',status='$this->status')
        WHERE id = '$this->id'
        ");

        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();


    }

    public function deleteAssignment(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM assignment
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 