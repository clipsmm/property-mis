<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 9:55 PM
 */

namespace Entity;


class Complaint extends System{
    protected $id;
    protected $clientId;
    protected $cmpCat;
    protected $cmpTitle;
    protected $cmpDesc;
    protected $cmpDate;
    protected $cmpView;

    protected $client;
    public function getClient(){
        $man = $this->getDatabaseManager();
        $enties = $man->getEntityById('client',$this->id);

        return $enties;
    }

    /**
     * @param mixed $cat
     */
    public function setCmpCat($cat)
    {
        $this->cmpCat = $cat;
    }

    /**
     * @return mixed
     */
    public function getCmpCat()
    {
        return $this->cmpCat;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $cmpDate
     */
    public function setCmpDate($cmpDate)
    {
        $this->cmpDate = $cmpDate;
    }

    /**
     * @return mixed
     */
    public function getCmpDate()
    {
        return $this->cmpDate;
    }

    /**
     * @param mixed $cmpDesc
     */
    public function setCmpDesc($cmpDesc)
    {
        $this->cmpDesc = $cmpDesc;
    }

    /**
     * @return mixed
     */
    public function getCmpDesc()
    {
        return $this->cmpDesc;
    }

    /**
     * @param mixed $cmpTitle
     */
    public function setCmpTitle($cmpTitle)
    {
        $this->cmpTitle = $cmpTitle;
    }

    /**
     * @return mixed
     */
    public function getCmpTitle()
    {
        return $this->cmpTitle;
    }

    /**
     * @param mixed $cmpView
     */
    public function setCmpView($cmpView)
    {
        $this->cmpView = $cmpView;
    }

    /**
     * @return mixed
     */
    public function getCmpView()
    {
        return $this->cmpView;
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

    public function createComplaint(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO complaint
        (client_id,cmp_cat,cmp_title,cmp_desc,cmp_date,cmp_view)
        VALUES
        ('$this->clientId','$this->cmpCat','$this->cmpTitle','$this->cmpDesc','$this->cmpDate','$this->cmpView')
        ");
        if($res = $em->persist()){
            return 'Successfully added!';
        }

        return 'Error: '.mysql_error();
    }

    public function updateComplaint(){
        $em = $this->getDatabaseManager();
        $em->query("
        UPDATE complaint
        SET
        client_id='$this->clientId',cmp_cat='$this->cmpCat',cmp_title='$this->cmpTitle',cmp_desc='$this->cmpDesc',
        cmp_date='$this->cmpDate',cmp_view='$this->cmpView'
        WHERE id = '$this->id'
        ");
        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteComplaint(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM complaint
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }
}