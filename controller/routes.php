<?php

/**
 * Class Routes
 * This class manages all the routes for all my views.
 * Basically this class builds the paths to make a friendly user interface
 * @author Oleg Rovinskiy
 * @version 1.0
 */
class Routes
{
    private $_f3;

    /**
     * Routes constructor.
     * this constructor initiates a fat free object to itself.
     * @param $f3 fat free object
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    /**
     * Builds a path to the home page of the website
     */
    function home()
    {
        $view = new Template();
        echo $view->render("views/home.html");
    }

    /**
     * Builds a path to the persons info page
     */
    function personalInfo()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $isValid = true;

            //this sets all the variables for stickyness
            //I decided not to use sessions since i would have to
            //put incorrect data in them if the user would mess up
            $this->_f3->set('firstName', $_POST['firstName']);
            $this->_f3->set('lastName', $_POST['lastName']);
            $this->_f3->set('age', $_POST['age']);
            $this->_f3->set('genders', $_POST['genders']);
            $this->_f3->set('number', $_POST['number']);
            $this->_f3->set('prem', $_POST['premium']);

            //checks if first name is valid
            if (!validName($_POST['firstName'])) {
                $this->_f3->set('error["fName"]', 'Only letters are allowed');
                $isValid = false;
            }

            //checks if last name is valid
            if (!validName($_POST['lastName'])) {
                $this->_f3->set('error["lName"]', 'Only letters are allowed');
                $isValid = false;
            }

            //checks if age is valid
            if (!validAge($_POST['age'])) {
                $this->_f3->set('error["age"]', 'Please enter a valid age');
                $isValid = false;
            }

            //checks if phone number is valid
            if (!validNumber($_POST['number'])) {
                $this->_f3->set('error["number"]', 'Please enter a valid Phone Number');
                $isValid = false;
            }

            //checks to see if gender is set
            if (!validGender($_POST['genders'], $this->_f3->get('gender'))) {
                $this->_f3->set('error["gender"]', 'Please enter a your Gender');
                $isValid = false;
            }

            if ($isValid) {
                if ($_POST['premium'] == 'premium') {
                    $_SESSION['member'] = new PremiumMembers($_POST['firstName'], $_POST['lastName'],
                        $_POST['age'], $_POST['genders'], $_POST['number']);
                    $_SESSION['premium'] = true;
                } else {
                    $_SESSION['member'] = new Members($_POST['firstName'], $_POST['lastName'],
                        $_POST['age'], $_POST['genders'], $_POST['number']);
                    $_SESSION['premium'] = false;
                }
                $this->_f3->reroute('/profile');
            }
        }
        $view = new Template();
        echo $view->render("views/personalInfo.html");
    }

    /**
     * Builds a path to the persons personal info page
     */
    function profile()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sets certain variables for a sticky form
            $this->_f3->set('email', $_POST['email']);
            $this->_f3->set('stateVar', $_POST['state']);
            $this->_f3->set('seeking', $_POST['seeking']);
            $this->_f3->set('bio', $_POST['bio']);

            //checks to see if seeking is set
            if (isset($seeking)) {
                $_SESSION['member']->setSeeking($_POST['seeking']);
            }

            //checks to see if bio is set
            if (!empty($bio)) {
                $_SESSION['member']->setBio($_POST['bio']);
            }

            //captures the state variable
            $_SESSION['member']->setState($_POST['state']);

            //checks if the email is valid
            if (validMail($_POST['email'])) {
                $_SESSION['member']->setEmail($_POST['email']);
                if ($_SESSION['premium']) {
                    $this->_f3->reroute('/interests');
                } else {
                    $this->_f3->reroute('/results');
                }
            } else {
                $this->_f3->set('error["mail"]', 'Please enter a valid email');
            }
        }
        $view = new Template();
        echo $view->render("views/profile.html");
    }

    /**
     * Builds a path to the persons interest page
     */
    function interests()
    {
        $arrayJ = array();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (validCheckboxes($_POST['doorInter'], $this->_f3->get('inDoor'), $this->_f3->get('outDoor'))) {
                if (isset($_POST['doorInter'])) {
                    $_SESSION['member']->setInterestArray($_POST['doorInter']);
                    $arrayJ = $_POST['doorInter'];
                }
                $this->_f3->reroute('/results');
            } else {
                $this->_f3->set('error["illegal"]', 'WARNING: It is a felony to data spoof');
                if (isset($_POST['doorInter'])) {
                    $arrayJ = $_POST['doorInter'];
                }
            }
        }

        $this->_f3->set('joke', $arrayJ);


        $view = new Template();
        echo $view->render("views/interests.html");
    }

    /**
     * Builds a path to the persons summary page
     */
    function results()
    {
        $view = new Template();
        echo $view->render("views/results.html");
    }
}