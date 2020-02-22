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
    function home(){
        $view = new Template();
        echo $view->render("views/home.html");
    }

    /**
     * Builds a path to the persons info page
     */
    function personalInfo(){
        $view = new Template();
        echo $view->render("views/personalInfo.html");
    }

    /**
     * Builds a path to the persons personal info page
     */
    function profile(){
        $view = new Template();
        echo $view->render("views/profile.html");
    }

    /**
     * Builds a path to the persons interest page
     */
    function interests(){
        $view = new Template();
        echo $view->render("views/interests.html");
    }

    /**
     * Builds a path to the persons summary page
     */
    function results(){
        $view = new Template();
        echo $view->render("views/results.html");
    }
}