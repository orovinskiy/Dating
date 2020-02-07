<?php
/**
 * @author Oleg Rovinskiy
 * @date 1/18/2020
 * @url https://github.com/orovinskiy/Dating
 * This is a Dating Website
 */
session_start();
//error reporting..
ini_set("display_errors",1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");
require("model/validationDating.php");

//Instantiate F3
$f3 = Base::instance();

//set a couple of arrays
$f3->set('states',array('none','Washington','California','Oregon',
    'New York','North Dakota','South Dakota'));
$f3->set('gender',array('Male','Female'));
$outdoor = array('Hiking','Biking','Swimming','Collecting','Walking',
    'Climbing');
$f3->set('outDoor',$outdoor);
$indoor = array('TV','Movies','Board-Games','Cooking','Puzzles',
    'Reading','Playing-Cards','Video-Games');
$f3->set('inDoor',$indoor);

//Define a default route
$f3->route("GET /", function(){
    $view = new Template();
    echo $view->render("views/home.html");
});

//Route to the personal info page
$f3->route("GET|POST /personal-info", function($f3){
    $_SESSION = array();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $isValid = true;

        //this sets all the variables for stickyness
        //I decided not to use sessions since i would have to
        //put incorrect data in them if the user would mess up

        $f3->set('firstName',$_POST['firstName']);
        $f3->set('lastName',$_POST['lastName']);
        $f3->set('age',$_POST['age']);
        $f3->set('method',$_POST['method']);
        $f3->set('number',$_POST['number']);

        //checks if first name is valid
        if(validName($_POST['firstName'])){
            $_SESSION['firstName'] = $_POST['firstName'];
        }
        else{
            $f3->set('error["fName"]','Only letters are allowed');
            $isValid = false;
        }

        //checks if last name is valid
        if(validName($_POST['lastName'])){
            $_SESSION['lastName'] = $_POST['lastName'];
        }
        else{
            $f3->set('error["lName"]','Only letters are allowed');
            $isValid = false;
        }

        //checks if age is valid
        if(validAge($_POST['age'])){
            $_SESSION['age'] = $_POST['age'];
        }
        else{
            $f3->set('error["age"]','Please enter a valid age');
            $isValid = false;
        }

        //checks if phone number is valid
        if(validNumber($_POST['number'])){
            $_SESSION['number'] = $_POST['number'];
        }
        else{
            $f3->set('error["number"]','Please enter a valid Phone Number');
            $isValid = false;
        }

        //checks to see if gender is set
        if(!isset($_POST['method'])){
            $_SESSION['method'] = 'Not Specified';
        }
        else{
            $_SESSION['method'] = $_POST['method'];
        }

        if($isValid){
            $f3->reroute('/profile');
        }

    }
    $view = new Template();
    echo $view->render("views/personalInfo.html");
});


//Route to the profile info page
$f3->route("POST|GET /profile", function($f3){

    $f3->set('email',$_POST['email']);
    $f3->set('stateVar',$_POST['state']);
    $f3->set('seeking',$_POST['seeking']);
    $f3->set('bio',$_POST['bio']);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //checks to see if seeking is set
        if(!isset($_POST['seeking'])){
            $_SESSION['seeking'] = 'Not Specified';
        }
        else{
            $_SESSION['seeking'] = $_POST['seeking'];
        }

        //checks to see if bio is set
        if(empty($_POST['bio'])){
            $_SESSION['bio'] = 'Not Specified';
        }
        else{
            $_SESSION['bio'] = $_POST['bio'];
        }

        //captures the state variable
        $_SESSION['state'] = $_POST['state'];

        //checks if the email is valid
        if(validMail($_POST['email'])){
            $_SESSION['email'] = $_POST['email'];
            $f3->reroute('/interests');
        }
        else{
            $f3->set('error["mail"]','Please enter a valid email');
        }
    }

    $view = new Template();
    echo $view->render("views/profile.html");
});

//Route to the interests info page
$f3->route("POST|GET /interests", function($f3){
    $arrayJ = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(validCheckboxes($_POST['doorInter'],$f3->get('inDoor'),$f3->get('outDoor'))){
            if(isset($_POST['doorInter'])){
                $_SESSION['doorInter'] = implode(', ',$_POST['doorInter']);
                $arrayJ = $_POST['doorInter'];
            }
            else{
                $_SESSION['doorInter']= 'Not Specified';
            }
            $f3->reroute('/results');
        }
        else{
            $f3->set('error["illegal"]','WARNING: It is a felony to data spoof');
            if(isset($_POST['doorInter'])){
                $arrayJ = $_POST['doorInter'];
            }
        }

        $f3->set('joke',$arrayJ);
    }


    $view = new Template();
    echo $view->render("views/interests.html");
});

//Route to the result info page
$f3->route("POST|GET /results", function(){
    $view = new Template();
    echo $view->render("views/results.html");
});

//Run f3
$f3->run();