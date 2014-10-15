<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 7:20 PM
 */

namespace Entity;



class Type extends System {
    protected $id;
    protected $typeName;

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
     * @param mixed $typeName
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
    }

    /**
     * @return mixed
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    public function createType(){
        $man = $this->getDatabaseManager();
        $man->query("
        INSERT INTO proptype
        (type_name)
        VALUES
        ('$this->typeName')
        ");

        if($res = $man->persist()){
            return 'Record successfully added!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteClient(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM proptype
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }

    public function updateType(){
        $man = $this->getDatabaseManager();
        $man->query("
        UPDATE proptype
        SET
        type_name = '$this->typeName'
        WHERE id = '$this->id'
        ");

        if($res = $man->persist()){
            return 'Record successfully added!';
        }

        return 'Error: '.mysql_error();
    }
} 