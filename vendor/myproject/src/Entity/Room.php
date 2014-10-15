<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 8:07 PM
 */

namespace Entity;


class Room {
    protected $id;
    protected $propId;
    protected $typeId;
    protected $roomNo;
    protected $roomPrice;

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
     * @param mixed $roomNo
     */
    public function setRoomNo($roomNo)
    {
        $this->roomNo = $roomNo;
    }

    /**
     * @return mixed
     */
    public function getRoomNo()
    {
        return $this->roomNo;
    }

    /**
     * @param mixed $roomPrice
     */
    public function setRoomPrice($roomPrice)
    {
        $this->roomPrice = $roomPrice;
    }

    /**
     * @return mixed
     */
    public function getRoomPrice()
    {
        return $this->roomPrice;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    public function createRoom(){
        $man = $this->getDatabaseManager();
        $man->query("
        INSERT INTO room
        (prop_id,type_id,room_no,price)
        VALUES
        ('$this->prodId','$this->typeId','$this->roomNo','$this->roomPrice')
        ");

        if ($res = $man->persist()){
            return 'Successfully added';
        }

        return 'Error: '.mysql_error();
    }

    public function updateRoom(){
        $man = $this->getDatabaseManager();
        $man->query("
        UPDATE room
        SET
        (prop_id = '$this->propId',type_id = '$this->typeId',room_no = '$this->roomNo',price = '$this->roomPrice')
        WHERE id = '$this->id'
        ");

        if ($res = $man->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteRoom(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM room
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 