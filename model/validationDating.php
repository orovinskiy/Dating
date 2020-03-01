<?php
/**This validates the name of the user
 * @param $name = input name
 * @return bool = if it was correctly entered
 */
function validName($name){
    $name = trim($name);
    if(!isset($name) || !ctype_alpha($name) || $name != htmlspecialchars($name)){
        return false;
    }
    return true;
}

/**Checks if the user entered a correct age and if
 * they are minors
 * @param $age = age of the user
 * @return bool = if it was correctly entered
 */
function validAge($age){
    $age = trim($age);
    if(!isset($age) || !ctype_digit($age) || $age != htmlspecialchars($age) || $age > 118 ||
    $age < 18){
        return false;
    }
    return true;
}

/**Validates the gender and makes sure it wasn't data spoofed
 * @param $gender = users gender
 * @param $searchArray = array of correct answers
 * @return bool = if it was correctly entered
 */
function validGender($gender,$searchArray){
    if(!isset($gender) || !in_array($gender,$searchArray)){
        return false;
    }
    return true;
}

/**Validates if the user entered a correct number
 * @param $number = users number
 * @return bool = if it was correctly entered
 */
function validNumber($number){
    if(trim($number) === "" || $number !== htmlspecialchars($number) ||
        !ctype_digit($number) || strlen($number) != 10){

        return false;

    }
    return true;
}

/**Checks if the user entered a valid email
 * @param $email = users email
 * @return bool = if it was correctly entered
 */
function validMail($email){
    if(trim($email) === "" || $email !== htmlspecialchars($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)){

        return false;

    }
    return true;
}

/**checks if the user spoofed with the data
 * @param $userArray = users chooses
 * @param $searchArray = outdoor options
 * @param $searchArray2 = indoor options
 * @return bool = if it was correctly entered
 */
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