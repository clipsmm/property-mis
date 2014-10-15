<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 9/1/14
 * Time: 10:01 PM
 */

namespace Entity;


class RentPayment extends System {
    protected $id;
    protected $rentId;
    protected $rentAmount;
    protected $rentPaid;
    protected $rentBalance;
    protected $rentDate;

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
     * @param mixed $rentAmount
     */
    public function setRentAmount($rentAmount)
    {
        $this->rentAmount = $rentAmount;
    }

    /**
     * @return mixed
     */
    public function getRentAmount()
    {
        return $this->rentAmount;
    }

    /**
     * @param mixed $rentBalance
     */
    public function setRentBalance($rentBalance)
    {
        $this->rentBalance = $rentBalance;
    }

    /**
     * @return mixed
     */
    public function getRentBalance()
    {
        return $this->rentBalance;
    }

    /**
     * @param mixed $rentDate
     */
    public function setRentDate($rentDate)
    {
        $this->rentDate = $rentDate;
    }

    /**
     * @return mixed
     */
    public function getRentDate()
    {
        return $this->rentDate;
    }

    /**
     * @param mixed $rentId
     */
    public function setRentId($rentId)
    {
        $this->rentId = $rentId;
    }

    /**
     * @return mixed
     */
    public function getRentId()
    {
        return $this->rentId;
    }

    /**
     * @param mixed $rentPaid
     */
    public function setRentPaid($rentPaid)
    {
        $this->rentPaid = $rentPaid;
    }

    /**
     * @return mixed
     */
    public function getRentPaid()
    {
        return $this->rentPaid;
    }

    public function createRentPayment(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO rentpayment
        (rent_id,rent_amount,rent_paid,rent_balance,rent_date)
        VALUES
        ('$this->rentId','$this->rentAmount','$this->rentPaid','$this->rentBalance','$this->rentDate')
        ");

        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function updatePayment(){
        $em = $this->getDatabaseManager();
        $em->query("
        INSERT INTO rentpayment
        rent_id='$this->rentId',rent_amount='$this->rentAmount',rent_paid='$this->rentPaid',
        rent_balance='$this->rentBalance',rent_date='$this->rentDate'
        WHERE id='$this->id'
        ");

        if($res = $em->persist()){
            return 'Successfully updated!';
        }

        return 'Error: '.mysql_error();
    }

    public function deleteRentPayment(){
        $em = $this->getDatabaseManager();
        $em->query("
        DELETE
        FROM rentpayment
        WHERE id IN ('$this->id')
        ");
        if($result = $em->persist()){
            $em->flush();

            return "Record successfully deleted!";
        };
        return "Error occured. Try again";
    }

} 