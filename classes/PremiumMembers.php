<?php


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