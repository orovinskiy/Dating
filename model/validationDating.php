<?php

function validName($name){
    $name = trim($name);
    if(!isset($name) || !ctype_alpha($name) || $name != htmlspecialchars($name)){
        return false;
    }
    return true;
}

function validAge($age){
    $age = trim($age);
    if(!isset($age) || !ctype_digit($age) || $age != htmlspecialchars($age) || $age > 118 ||
    $age < 18){
        return false;
    }
    return true;
}

function validNumber($number){
    if(trim($number) === "" || $number !== htmlspecialchars($number) ||
        !ctype_digit($number) || strlen($number) != 10){

        return false;

    }
    return true;
}

function validMail($email){
    if(trim($email) === "" || $email !== htmlspecialchars($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)){

        return false;

    }
    return true;
}

function validCheckboxes($userArray, $searchArray, $searchArray2){
    if(isset($userArray)){
        foreach ($userArray as $value) {
            if(!in_array($value,$searchArray) && !in_array($value,$searchArray2)){
                return false;
            }
        }
    }
    return true;
}