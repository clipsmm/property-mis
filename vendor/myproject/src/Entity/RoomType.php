<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 8:02 PM
 */

namespace Entity;


class RoomType extends System {
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

    public function createRoomType(){
        $man = $this->getDatabaseManager();
        $man->query("
        INSERT INTO roomtype
        (type_name)
        VALUES
        ('$this->typeName;')
        ");

        if ($res = $man->persist()){
            return 'Successfully added';
        }

        return 'Error: '.mysql_error();
    }

    public function updateRoomType(){
        $man = $this->getDatabaseManager();
        $man->query("
        UPDATE roomtype
        SET
        (type_name = '$this->typeName')
        WHERE id = '$this->id'
        ");

        if ($res = $man->persist()){
            return 'Successfully added';
        }

        return 'Error: '.mysql_error();
    }
    public function deleteRoomType(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM roomtype
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 