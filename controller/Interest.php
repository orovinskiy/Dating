<?php
/**
 * Class Interest
 * This class is mainly for use in the view
 * it comunnicates between the controller and database
 * to get the interests for a specific member
 * @author Oleg Rovinskiy
 * @version 1.0
 */

class Interest
{
    private $_f3;
    private $_dbh;

    /**
     * Interest constructor.
     * @param $f3 = fat free object
     * @param $dbh = DatabaseDat class
     */
    function __construct($f3,$dbh)
    {
        $this->_f3 = $f3;
        $this->_dbh = $dbh;
    }

    /**
     * This function returns a string with all
     * the interests connected from a certain member
     * @param $memID = member id
     * @return string = all the interests of the user
     */
    function allInterest($memID){
        $holder = $this->_dbh->getMemInterest($memID);
        $array = array();

        foreach ($holder as $temp){
            foreach ($temp as $inter){
                $array[] = $inter;
            }
        }

        return implode(", ",$array);
    }

}