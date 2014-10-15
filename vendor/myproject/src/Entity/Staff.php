<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 8/29/14
 * Time: 8:46 PM
 */

namespace Entity;

use Entity\System as System;
class Staff extends System{
    protected $id;
    protected $staffFirstName;
    protected $staffLastName;
    protected $staffPhone;
    protected $staffGender;
    protected $staffIdNo;
    protected $staffDeptId;
    protected $staffDob;
    protected $staffDoh;

    protected $department;

    /**
     * @param mixed $staffDeptId
     */
    public function setStaffDeptId($staffDeptId)
    {
        $this->staffDeptId = $staffDeptId;
    }

    /**
     * @return mixed
     */
    public function getStaffDeptId()
    {
        return $this->staffDeptId;
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
     * @param mixed $staffDob
     */
    public function setStaffDob($staffDob)
    {
        $this->staffDob = $staffDob;
    }

    /**
     * @return mixed
     */
    public function getStaffDob()
    {
        return $this->staffDob;
    }

    /**
     * @param mixed $staffDoh
     */
    public function setStaffDoh($staffDoh)
    {
        $this->staffDoh = $staffDoh;
    }

    /**
     * @return mixed
     */
    public function getStaffDoh()
    {
        return $this->staffDoh;
    }

    /**
     * @param mixed $staffFirstName
     */
    public function setStaffFirstName($staffFirstName)
    {
        $this->staffFirstName = $staffFirstName;
    }

    /**
     * @return mixed
     */
    public function getStaffFirstName()
    {
        return $this->staffFirstName;
    }

    /**
     * @param mixed $staffGender
     */
    public function setStaffGender($staffGender)
    {
        $this->staffGender = $staffGender;
    }

    /**
     * @return mixed
     */
    public function getStaffGender()
    {
        return $this->staffGender;
    }

    /**
     * @param mixed $staffIdNo
     */
    public function setStaffIdNo($staffIdNo)
    {
        $this->staffIdNo = $staffIdNo;
    }

    /**
     * @return mixed
     */
    public function getStaffIdNo()
    {
        return $this->staffIdNo;
    }

    /**
     * @param mixed $staffLastName
     */
    public function setStaffLastName($staffLastName)
    {
        $this->staffLastName = $staffLastName;
    }

    /**
     * @return mixed
     */
    public function getStaffLastName()
    {
        return $this->staffLastName;
    }

    /**
     * @param mixed $staffPhone
     */
    public function setStaffPhone($staffPhone)
    {
        $this->staffPhone = $staffPhone;
    }

    /**
     * @return mixed
     */
    public function getStaffPhone()
    {
        return $this->staffPhone;
    }
    public function createStaff(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO staff
        (staff_first_name,staff_last_name,staff_phone,staff_gender,staff_dept_id,staff_id_no,staff_dob,staff_doh)
        VALUES
        ('$this->staffFirstName','$this->staffLastName','$this->staffPhone','$this->staffGender','$this->staffDeptId',
        '$this->staffIdNo','$this->staffDob','$this->staffDoh')
        ");

        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }

    public function updateStaff(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE staff
        SET
        staff_first_name ='$this->staffFirstName',staff_last_name='$this->staffLastName',staff_phone='$this->staffPhone',
        staff_gender ='$this->staffGender' ,staff_dept_id='$this->staffDeptId',staff_id_no='$this->staffIdNo',
        staff_dob='$this->staffDob',staff_doh='$this->staffDoh'
        WHERE id = '$this->id'
        ");

        if($result = $em->persist()){
            return "Record successfully updated!";
        }

        return "Error".mysql_error();
    }

    public function deleteStaff(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM staff
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            return "Record successfully deleted!";
        }

        return "Error".mysql_error();
    }

    public function getDepartment($id){
        $em = $this->getDatabaseManager();
        $code = $em->getEntityDetail('department',$id,'dept_code');
        return $code;
    }
} 