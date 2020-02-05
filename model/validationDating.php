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
        preg_match("/^\(\d{3}\)\s\d{3}-\d{4}/",$number)){

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

function validCheckboxes($userArray, $searchArray){
    foreach ($userArray as $value) {
        if(!in_array($value,$searchArray)){
            return false;
        }
    }
    return true;
}