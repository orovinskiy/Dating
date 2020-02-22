<?php

/**
 * Class PremiumMembers
 * This class builds up a premium member object and
 * has a getter and a setter for each variable.
 * the only functions provided are getters and setters.
 * this class extends the member class
 * @author Oleg Rovinskiy
 * @version 1.0
 */
class PremiumMembers extends Members
{
    private $_interestArray;

    function __construct($fName, $lName, $age, $gender, $phone)
    {
        parent::__construct($fName, $lName, $age, $gender, $phone);
        $this->_interestArray = "Not Specified";
    }

    /**
     * @return mixed
     */
    public function getInterestArray()
    {
        return $this->_interestArray;
    }

    /**
     * @param mixed $interestArray
     */
    public function setInterestArray($interestArray)
    {
        $this->_interestArray = $interestArray;
    }


}