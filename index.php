<?php
/**
 * @author Oleg Rovinskiy
 * @date 1/18/2020
 * @url https://github.com/orovinskiy/Dating
 * This is a Dating Website
 */

//error reporting..
ini_set("display_errors",1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");
require("model/validationDating.php");

session_start();

//Instantiate F3
$f3 = Base::instance();

$routes = new Routes($f3);
$validation = new Validate($f3);

//Define a default route
$f3->route("GET /", function(){
    $GLOBALS['routes']->home();
});

//Route to the personal info page
$f3->route("GET|POST /personal-info", function(){
    $_SESSION = array();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Validates the form and makes it sticky
        $GLOBALS['validation']->validPerson($_POST['firstName'],$_POST['lastName'],$_POST['age'],
            $_POST['method'],$_POST['number'],$_POST['premium']);

    }
    $GLOBALS['routes']->personalInfo();
});


//Route to the profile info page
$f3->route("POST|GET /profile", function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $GLOBALS['validation']->validPersonInfo($_POST['email'],$_POST['state'],$_POST['seeking']
        ,$_POST['bio']);
    }
    //var_dump($_SESSION);
    $GLOBALS['routes']->profile();
});

//Route to the interests info page
$f3->route("POST|GET /interests", function($f3){
    $arrayJ = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $GLOBALS['validation']->validInterest($_POST['doorInter']);
    }

    $GLOBALS['routes']->interests();
});

//Route to the result info page
$f3->route("POST|GET /results", function(){
    //var_dump($_SESSION['member']);
    $GLOBALS['routes']->results();
});

//Run f3
$f3->run();