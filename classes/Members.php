<?php
/**
 * Class Members
 * This class builds up a member object and
 * has a getter and a setter for each variable.
 * the only functions provided are getters and setters
 * @author Oleg Rovinskiy
 * @version 1.0
 */

class Members
{
    private $_fName;
    private $_lName;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    function __construct($fName,$lName,$age,$gender,$phone)
    {
        $this->_fName = $fName;
        $this->_lName = $lName;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
        $this->_email = "Not Specified";
        $this->_state = "Not Specified";
        $this->_seeking = "Not Specified";
        $this->_bio = "Not Specified";
    }


    /**
     * @return mixed
     */
    public function getFName()
    {
        return $this->_fName;
    }

    /**
     * @param mixed $fName
     */
    public function setFName($fName)
    {
        $this->_fName = $fName;
    }

    /**
     * @return mixed
     */
    public function getLName()
    {
        return $this->_lName;
    }

    /**
     * @param mixed $lName
     */
    public function setLName($lName)
    {
        $this->_lName = $lName;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

}