<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/4/14
 * Time: 10:33 PM
 */

namespace Entity;


class Area extends System {
    protected $id;
    protected $arName;
    protected $arMinLat;
    protected $arMaxLat;
    protected $arMinLon;
    protected $arMaxLon;
    protected $arStatus;

    /**
     * @param mixed $arMaxLat
     */
    public function setArMaxLat($arMaxLat)
    {
        $this->arMaxLat = $arMaxLat;
    }

    /**
     * @return mixed
     */
    public function getArMaxLat()
    {
        return $this->arMaxLat;
    }

    /**
     * @param mixed $arMaxLon
     */
    public function setArMaxLon($arMaxLon)
    {
        $this->arMaxLon = $arMaxLon;
    }

    /**
     * @return mixed
     */
    public function getArMaxLon()
    {
        return $this->arMaxLon;
    }

    /**
     * @param mixed $arMinLat
     */
    public function setArMinLat($arMinLat)
    {
        $this->arMinLat = $arMinLat;
    }

    /**
     * @return mixed
     */
    public function getArMinLat()
    {
        return $this->arMinLat;
    }

    /**
     * @param mixed $arMinLon
     */
    public function setArMinLon($arMinLon)
    {
        $this->arMinLon = $arMinLon;
    }

    /**
     * @return mixed
     */
    public function getArMinLon()
    {
        return $this->arMinLon;
    }

    /**
     * @param mixed $arName
     */
    public function setArName($arName)
    {
        $this->arName = $arName;
    }

    /**
     * @return mixed
     */
    public function getArName()
    {
        return $this->arName;
    }

    /**
     * @param mixed $arStatus
     */
    public function setArStatus($arStatus)
    {
        $this->arStatus = $arStatus;
    }

    /**
     * @return mixed
     */
    public function getArStatus()
    {
        return $this->arStatus;
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

    public function createArea(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO area
        (ar_name,ar_min_lat,ar_max_lat,ar_min_lon,ar_max_lon)
        VALUES
        ('$this->arName','$this->arMinLat','$this->arMaxLat','$this->arMinLon','$this->arMaxLon')
        ");
        if($result = $em->persist()){
            return "Record successfully added";
        }

        return "Error".mysql_error();
    }

    public function updateArea(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE area
        SET
        ar_name='$this->arName',ar_min_lat='$this->arMinLat',ar_max_lat='$this->arMaxLat',
        ar_min_lon='$this->arMinLon',ar_max_lon='$this->arMaxLon')
        WHERE id='$this->id'
        ");
        if($result = $em->persist()){
            return "Record successfully updated";
        }

        return "Error".mysql_error();
    }

    public function deletArea(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM area
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }

} 