<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/5/14
 * Time: 4:18 PM
 */

namespace Entity;


class Tenant extends System {
    protected $id;
    protected $tenName;
    protected $tenIdNo;
    protected $tenEmail;
    protected $tenPhone;

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
     * @param mixed $tenEmail
     */
    public function setTenEmail($tenEmail)
    {
        $this->tenEmail = $tenEmail;
    }

    /**
     * @return mixed
     */
    public function getTenEmail()
    {
        return $this->tenEmail;
    }

    /**
     * @param mixed $tenIdNo
     */
    public function setTenIdNo($tenIdNo)
    {
        $this->tenIdNo = $tenIdNo;
    }

    /**
     * @return mixed
     */
    public function getTenIdNo()
    {
        return $this->tenIdNo;
    }

    /**
     * @param mixed $tenName
     */
    public function setTenName($tenName)
    {
        $this->tenName = $tenName;
    }

    /**
     * @return mixed
     */
    public function getTenName()
    {
        return $this->tenName;
    }

    /**
     * @param mixed $tenPhone
     */
    public function setTenPhone($tenPhone)
    {
        $this->tenPhone = $tenPhone;
    }

    /**
     * @return mixed
     */
    public function getTenPhone()
    {
        return $this->tenPhone;
    }

    public function createTenant(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO tenant
        (ten_name,ten_idno,ten_phone,ten_email)
        values
        ('$this->tenName','$this->tenIdNo','$this->tenPhone','$this->tenEmail')
        ");
        if($result = $em->persist()){
            return "Record successfully added!";
        }

        return "Error".mysql_error();
    }

    public function updateTenant(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE tenant
        SET
        (ten_name='$this->tenName',ten_idno='$this->tenIdNo',ten_phone='$this->tenPhone',ten_email='$this->tenEmail')
        WHERE id = '$this->id'
        ");
        if($result = $em->persist()){
            return "Record successfully updated!";
        }

        return "Error".mysql_error();
    }

    public function deleteTenant(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM tenant
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 