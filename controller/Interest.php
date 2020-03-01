<?php


class Interest
{
    private $_f3;
    private $_dbh;

    function __construct($f3,$dbh)
    {
        $this->_f3 = $f3;
        $this->_dbh = $dbh;
    }

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