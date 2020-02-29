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
$f3->set('DEBUG', 3);


$f3->set('states', array('none', 'Washington', 'California', 'Oregon',
    'New York', 'North Dakota', 'South Dakota'));
$f3->set('gender', array('Male', 'Female'));

$f3->set('outDoor', array('Hiking', 'Biking', 'Swimming', 'Collecting', 'Walking',
    'Climbing'));

$f3->set('inDoor', array('TV', 'Movies', 'Board Games', 'Cooking', 'Puzzles',
    'Reading', 'Playing Cards', 'Video Games'));

$routes = new Routes($f3);
$dbConnect = new DatabaseDate();

//Define a default route
$f3->route("GET /", function(){
    $_SESSION = array();
    $GLOBALS['routes']->home();
});

//Route to the personal info page
$f3->route("GET|POST /personal-info", function(){
    $_SESSION = array();
    $GLOBALS['routes']->personalInfo();
});


//Route to the profile info page
$f3->route("POST|GET /profile", function($f3){
    //var_dump($_SESSION);
    $GLOBALS['routes']->profile();
});

//Route to the interests info page
$f3->route("POST|GET /interests", function($f3){
    $GLOBALS['routes']->interests();
});

//Route to the result info page
$f3->route("POST|GET /results", function(){
    $GLOBALS['dbConnect']->insertMember();
    $GLOBALS['routes']->results();
});

//Run f3
$f3->run();