<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 9:58 PM
 */

namespace Entity;


class Rent extends System{
    protected $id;
    protected $tenantId;
    protected $propId;
    protected $dateIn;
    protected $dateOut;

    /**
     * @param mixed $dateIn
     */
    public function setDateIn($dateIn)
    {
        $this->dateIn = $dateIn;
    }

    /**
     * @return mixed
     */
    public function getDateIn()
    {
        return $this->dateIn;
    }

    /**
     * @param mixed $dateOut
     */
    public function setDateOut($dateOut)
    {
        $this->dateOut = $dateOut;
    }

    /**
     * @return mixed
     */
    public function getDateOut()
    {
        return $this->dateOut;
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
     * @param mixed $tenantId
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
    }

    /**
     * @return mixed
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }


    public function createRent(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO rent
        (tenant_id,prop_id,date_in,date_out)
        VALUES
        ('$this->tenantId','$this->propId','$this->dateIn','$this->dateOut')
        ");

        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function updateRent(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT rent SET
        tenant_id='$this->tenantId',prop_id='$this->propId',date_in='$this->dateIn',
        date_out='$this->dateOut'
        WHERE id='$this->id'
        ");

        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteRent(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM rent
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 