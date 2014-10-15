<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 7:30 PM
 */

namespace Entity;


class Address extends System{
    protected $id;
    protected $addBuilding;
    protected $addStreet;
    protected $addArea;
    protected $addTown;
    protected $addCounty;

    /**
     * @param mixed $addArea
     */
    public function setAddArea($addArea)
    {
        $this->addArea = $addArea;
    }

    /**
     * @return mixed
     */
    public function getAddArea()
    {
        return $this->addArea;
    }

    /**
     * @param mixed $addBuilding
     */
    public function setAddBuilding($addBuilding)
    {
        $this->addBuilding = $addBuilding;
    }

    /**
     * @return mixed
     */
    public function getAddBuilding()
    {
        return $this->addBuilding;
    }

    /**
     * @param mixed $addCounty
     */
    public function setAddCounty($addCounty)
    {
        $this->addCounty = $addCounty;
    }

    /**
     * @return mixed
     */
    public function getAddCounty()
    {
        return $this->addCounty;
    }

    /**
     * @param mixed $addStreet
     */
    public function setAddStreet($addStreet)
    {
        $this->addStreet = $addStreet;
    }

    /**
     * @return mixed
     */
    public function getAddStreet()
    {
        return $this->addStreet;
    }

    /**
     * @param mixed $addTown
     */
    public function setAddTown($addTown)
    {
        $this->addTown = $addTown;
    }

    /**
     * @return mixed
     */
    public function getAddTown()
    {
        return $this->addTown;
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

    public function createAddress(){
        $man = $this->getDatabaseManager();
        $man->query("
        INSERT INTO address
        (building,street,area,town,county)
        VALUES
        ('$this->addBuilding','$this->addStreet','$this->addArea','$this->addTown','$this->addCounty')
        ");
        if ($res = $man->persist()){
            return "Record successfully added!";
        }

        return 'Error: '.mysql_error();
    }



    public function updateAddress(){
        $man = $this->getDatabaseManager();
        $man->query("
        UPDATE address
        SET
        building = '$this->addBuilding',street = '$this->addStreet',area = '$this->addArea',town = '$this->addTown',
        county = '$this->addCounty'
        WHERE id = '$this->id'
        ");
        if ($res = $man->persist()){
            return "Record successfully updated!";
        }

        return 'Error: '.mysql_error();
    }

    public function deleteAddress(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM address
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }

} 