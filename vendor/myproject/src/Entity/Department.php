<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 8/29/14
 * Time: 7:31 PM
 */

namespace Entity;

use Entity\System as System;
class Department extends System{
    protected $id;
    protected $deptCode;
    protected $deptName;

    /**
     * @param mixed $deptCode
     */
    public function setDeptCode($deptCode)
    {
        $this->deptCode = $deptCode;
    }

    /**
     * @return mixed
     */
    public function getDeptCode()
    {
        return $this->deptCode;
    }

    /**
     * @param mixed $deptName
     */
    public function setDeptName($deptName)
    {
        $this->deptName = $deptName;
    }

    /**
     * @return mixed
     */
    public function getDeptName()
    {
        return $this->deptName;
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

    public function createDepartment(){
        $em  = $this->getDatabaseManager();
        $code = $this->getDeptCode();
        $name = $this->getDeptName();
        $em->query("
        INSERT INTO department
        (dept_code,dept_name)
        VALUES
        ('$code','$name')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully added!";
        };
        return "Error occured. Try again";
    }

    public function updateDepartment(){
        $em  = $this->getDatabaseManager();
        $id = $this->getId();
        $code = $this->getDeptCode();
        $name = $this->getDeptName();
        $em->query("
        UPDATE department SET
        (dept_code='$code',dept_name = '$name')
        WHERE id='$id'
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully added!";
        };
        return "Error occured. Try again";
    }

    public function deleteDepartment(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM department
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }

} 