<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 7:40 PM
 */

namespace Entity;


class Feature extends System{
    protected $id;
    protected $fetName;

    /**
     * @param mixed $fetName
     */
    public function setFetName($fetName)
    {
        $this->fetName = $fetName;
    }

    /**
     * @return mixed
     */
    public function getFetName()
    {
        return $this->fetName;
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

    public function createFeature(){
        $man = $this->getDatabaseManager();
        $man->query("
        INSERT INTO features
        (feature_name)
        VALUES
        ('$this->fetName')
        ");

        if ($res = $man->persist()){
            return 'Record successfully added!';
        }

        return 'Error: '.mysql_error();
    }

    public function updateFeature(){
        $man = $this->getDatabaseManager();
        $man->query("
        UPDATE features
        SET
        feature_name = '$this->fetName'
        WHERE id = '$this->id'
        ");

        if ($res = $man->persist()){
            return 'Record successfully added!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteFeature(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM features
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }


} 