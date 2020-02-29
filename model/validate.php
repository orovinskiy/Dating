<?php
/**
 * Class Validate
 * This class is to use the validationDating file and communicate with the controller by
 * validating multiple things inside a single function. This class also reroutes to a
 * different page when all the data is validated.
 * @author Oleg Rovinskiy
 * @version 1.0
 */

class Validate
{
    private $_f3;

    /**
     * Validate constructor.
     * This constructor sets all the variables I will need for validation
     * and also intiates the fat free object into its own variable
     * @param $f3 the fat free object
     */

    /**
     * This method validates the profile section of my dating website.
     * After the form is validated and everything follows the standards it will
     * reroute to the personal info page.
     * @param $firstName first name input box.
     * @param $lastName last name input box.
     * @param $age gets the age from input box.
     * @param $gender gets the gender from radio buttons.
     * @param $phoneNumber gets the number from input box.
     * @param $prem checks to see if the user is a premium member.
     */

    /**
     * This method validates the persons personal info
     * for the dating website and throws errors if anything is incorrect.
     * if everything is correct then it looks if the user is a premium member or not
     * and directs them to the appropriate page.
     * @param $email the users email from the input box.
     * @param $state the users location from a select drop down.
     * @param $seeking the gender of the mate the user is looking for.
     * @param $bio a little info about the user.
     */


    /**
     * Validates the interest of the user. This page is only available
     * to premium users and only seen by premium users.
     * @param $interest the array full of the interests the user has.
     */


}