<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * : 8/30/14
 * Time: 10:21 AM
 */

namespace Entity;


class Property extends System{
    protected $id;
    protected $ownerId;
    protected $addressId;
    protected $typeId;
    protected $propName;
    protected $propDesc;
    protected $propRooms;
    protected $propDateSubmitted;
    protected $propSalePrice;
    protected $propSold;
    protected $propAgentId;
    protected $propRentPrice;
    protected $propArea;

    /**
     * @param mixed $propRentPrice
     */
    public function setPropRentPrice($propRentPrice)
    {
        $this->propRentPrice = $propRentPrice;
    }

    /**
     * @return mixed
     */
    public function getPropRentPrice()
    {
        return $this->propRentPrice;
    }

    /**
     * @param mixed $propArea
     */
    public function setPropArea($propArea)
    {
        $this->propArea = $propArea;
    }

    /**
     * @return mixed
     */
    public function getPropArea()
    {
        return $this->propArea;
    }

    /**
     * @param mixed $propAgentId
     */
    public function setPropAgentId($propAgentId)
    {
        $this->propAgentId = $propAgentId;
    }

    /**
     * @return mixed
     */
    public function getPropAgentId()
    {
        return $this->propAgentId;
    }


    //relation attribute
    protected $photos = array();
    public function getPhotos(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('photo',$this->id);

        return $enties;
    }

    protected $owner;
    public function getOwner(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('client',$this->id);

        return $enties;
    }

    protected $address;
    public function getAddress(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('address',$this->id);

        return $enties;
    }

    protected $type;
    public function getType(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('type',$this->id);

        return $enties;
    }

    /**
     * @param mixed $addressId
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
    }/**
 * @return mixed
 */
    public function getAddressId()
    {
        return $this->addressId;
    }/**
 * @param mixed $id
 */
    public function setId($id)
    {
        $this->id = $id;
    }/**
 * @return mixed
 */
    public function getId()
    {
        return $this->id;
    }/**
 * @param mixed $ownerId
 */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }/**
 * @return mixed
 */
    public function getOwnerId()
    {
        return $this->ownerId;
    }/**
 * @param mixed $propSold
 */
    public function setPropSold($propSold)
    {
        $this->propSold = $propSold;
    }/**
 * @return mixed
 */
    public function getPropSold()
    {
        return $this->propSold;
    }/**
 * @param mixed $propDateSubmitted
 */
    public function setPropDateSubmitted($propDateSubmitted)
    {
        $this->propDateSubmitted = $propDateSubmitted;
    }/**
 * @return mixed
 */
    public function getPropDateSubmitted()
    {
        return $this->propDateSubmitted;
    }/**
 * @param mixed $propDesc
 */
    public function setPropDesc($propDesc)
    {
        $this->propDesc = $propDesc;
    }/**
 * @return mixed
 */
    public function getPropDesc()
    {
        return $this->propDesc;
    }/**
 * @param mixed $propName
 */
    public function setPropName($propName)
    {
        $this->propName = $propName;
    }/**
 * @return mixed
 */
    public function getPropName()
    {
        return $this->propName;
    }/**
 * @param mixed $propRooms
 */
    public function setPropRooms($propRooms)
    {
        $this->propRooms = $propRooms;
    }/**
 * @return mixed
 */
    public function getPropRooms()
    {
        return $this->propRooms;
    }/**
 * @param mixed $propSalePrice
 */
    public function setPropSalePrice($propSalePrice)
    {
        $this->propSalePrice = $propSalePrice;
    }/**
 * @return mixed
 */
    public function getPropSalePrice()
    {
        return $this->propSalePrice;
    }/**
 * @param mixed $typeId
 */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }/**
 * @return mixed
 */
    public function getTypeId()
    {
        return $this->typeId;
    }

    public function createProperty(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO property
        (client_id,address_id,type_id,prop_name,prop_desc,prop_rooms,date_submitted,sale_price,prop_status,rent_price,
        prop_area,agent_id)
        VALUES
        ('$this->ownerId','$this->addressId','$this->typeId','$this->propName','$this->propDesc',
        '$this->propRooms','$this->propDateSubmitted','$this->propSalePrice','$this->propSold','$this->propRentPrice',
        '$this->propArea','$this->propAgentId')
        ");

        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }

    public function updateProperty(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE property
        SET
        client_id = '$this->ownerId',address_id = '$this->addressId',type_id ='$this->typeId',
        prop_name ='$this->propName',prop_desc ='$this->propDesc',prop_rooms ='$this->propRooms ,
        date_submitted ='$this->propDateSubmitted',sale_price = '$this->propSalePrice',prop_status ='$this->propSold',
        rent_price = '$this->propRentPrice',prop_area='$this->propArea',agent_id = '$this->propAgentId'
        WHERE id = '$this->id'
        ");

        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }

    public function deleteProperty(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM property
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
}
