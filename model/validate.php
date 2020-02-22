<?php


class Validate
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3=$f3;
        //set a couple of arrays
        $this->_f3->set('states',array('none','Washington','California','Oregon',
            'New York','North Dakota','South Dakota'));
        $this->_f3->set('gender',array('Male','Female'));

        $this->_f3->set('outDoor',array('Hiking','Biking','Swimming','Collecting','Walking',
            'Climbing'));

        $this->_f3->set('inDoor',array('TV','Movies','Board-Games','Cooking','Puzzles',
            'Reading','Playing-Cards','Video-Games'));
    }

    function validPerson($firstName, $lastName, $age, $gender, $phoneNumber, $prem)
    {
        $isValid = true;

        //this sets all the variables for stickyness
        //I decided not to use sessions since i would have to
        //put incorrect data in them if the user would mess up

        $this->_f3->set('firstName',$firstName);
        $this->_f3->set('lastName',$lastName);
        $this->_f3->set('age',$age);
        $this->_f3->set('method',$gender);
        $this->_f3->set('number',$phoneNumber);
        $this->_f3->set('prem',$prem);

        //checks if first name is valid
        if(!validName($firstName)){
            $this->_f3->set('error["fName"]','Only letters are allowed');
            $isValid = false;
        }

        //checks if last name is valid
        if(!validName($lastName)){
            $this->_f3->set('error["lName"]','Only letters are allowed');
            $isValid = false;
        }

        //checks if age is valid
        if(!validAge($age)){
            $this->_f3->set('error["age"]','Please enter a valid age');
            $isValid = false;
        }

        //checks if phone number is valid
        if(!validNumber($phoneNumber)){
            $this->_f3->set('error["number"]','Please enter a valid Phone Number');
            $isValid = false;
        }

        //checks to see if gender is set
        if(!validGender($gender, $this->_f3->get('gender'))){
            $this->_f3->set('error["gender"]','Please enter a your Gender');
            $isValid = false;
        }

        if($isValid){
            if($prem == 'premium'){
                $_SESSION['member'] = new PremiumMembers($firstName,$lastName,$age,$gender,$phoneNumber);
                $_SESSION['premium'] = true;
            }
            else{
                $_SESSION['member'] = new Members($firstName,$lastName,$age,$gender,$phoneNumber);
                $_SESSION['premium'] = false;
            }
            $this->_f3->reroute('/profile');
        }
    }

    function validPersonInfo($email,$state,$seeking,$bio)
    {

        //sets certain variables for a sticky form
        $this->_f3->set('email',$email);
        $this->_f3->set('stateVar',$state);
        $this->_f3->set('seeking',$seeking);
        $this->_f3->set('bio',$bio);

        //checks to see if seeking is set
        if(isset($seeking)){
            $_SESSION['member']->setSeeking($seeking);
        }

        //checks to see if bio is set
        if(!empty($bio)){
            $_SESSION['member']->setBio($bio);
        }

        //captures the state variable
        $_SESSION['member']->setState($state);

        //checks if the email is valid
        if(validMail($email)){
            $_SESSION['member']->setEmail($email);
            if($_SESSION['premium']){
                $this->_f3->reroute('/interests');
            }
            else{
                $this->_f3->reroute('/results');
            }
        }
        else{
            $this->_f3->set('error["mail"]','Please enter a valid email');
        }
    }

    function validInterest($interest)
    {
        if(validCheckboxes($interest,$this->_f3->get('inDoor'),$this->_f3->get('outDoor'))){
            if(isset($interest)){
                $_SESSION['member']->setInterestArray(implode(', ',$interest));
                $arrayJ = $interest;
            }
            $this->_f3->reroute('/results');
        }
        else{
            $this->_f3->set('error["illegal"]','WARNING: It is a felony to data spoof');
            if(isset($interest)){
                $arrayJ = $interest;
            }
        }

        $this->_f3->set('joke',$arrayJ);
    }

}