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

//Instantiate F3
$f3 = Base::instance();

//Define a default route
$f3->route("GET /", function(){
    $view = new Template();
    echo $view->render("views/home.html");
});

//Route to the personal info page
$f3->route("GET /personal-info", function(){
    $view = new Template();
    echo $view->render("views/personalInfo.html");
});

//Route to the profile info page
$f3->route("POST /profile", function(){
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['method'] = $_POST['method'];
    $_SESSION['number'] = $_POST['number'];
    $view = new Template();
    echo $view->render("views/profile.html");
});

//Route to the interests info page
$f3->route("POST /interests", function(){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];
    $view = new Template();
    echo $view->render("views/interests.html");
});

//Route to the result info page
$f3->route("POST /results", function(){
    $string = "";
    for($i = 0; $i < count($_POST['doorInter']); $i++){
        $string .= $_POST['doorInter'][$i]." ";
    }
    $_SESSION['doorInter'] = $string;
    $view = new Template();
    echo $view->render("views/results.html");
});

//Run f3
$f3->run();