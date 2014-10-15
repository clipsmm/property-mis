<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 7:50 PM
 */

namespace Entity;


class Photo extends System {
    protected $id;
    protected $photoPropId;
    protected $photoTitle;
    protected $photoName;
    protected $photoDesc;

    /**
     * @param mixed $photoTitle
     */
    public function setPhotoTitle($photoTitle)
    {
        $this->photoTitle = $photoTitle;
    }

    /**
     * @return mixed
     */
    public function getPhotoTitle()
    {
        return $this->photoTitle;
    }

    /**
     * @param mixed $photoPropId
     */
    public function setPhotoPropId($photoPropId)
    {
        $this->photoPropId = $photoPropId;
    }

    /**
     * @return mixed
     */
    public function getPhotoPropId()
    {
        return $this->photoPropId;
    }

    /**
     * @param mixed $photoName
     */
    public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;
    }

    /**
     * @return mixed
     */
    public function getPhotoName()
    {
        return $this->photoName;
    }

    /**
     * @param mixed $photoDesc
     */
    public function setPhotoDesc($photoDesc)
    {
        $this->photoDesc = $photoDesc;
    }

    /**
     * @return mixed
     */
    public function getPhotoDesc()
    {
        return $this->photoDesc;
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

    public function createPhoto(){
        $man = $this->getDatabaseManager();
        $man->query("
        INSERT INTO photo
        (prop_id,photo_title,photo_desc,photo_name)
        VALUES
        ('$this->photoPropId','$this->photoTitle','$this->photoDesc','$this->photoName')
        ");

        if ($res = $man->persist()){
            return 'Successfully added';
        }

        return 'Error: '.mysql_error();
    }
    public function updatePhoto(){
        $man = $this->getDatabaseManager();
        $man->query("
        UPDATE  photo
        SET
        prop_id = '$this->photoPropId',photo_title = '$this->photoTitle',photo_desc = '$this->photoDesc',
        photo_name = '$this->photoName'
        WHERE id = '$this->id'
        ");

        if ($res = $man->persist()){
            return 'Successfully added';
        }

        return 'Error: '.mysql_error();
    }
    public function deletePhoto(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM photo
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
} 