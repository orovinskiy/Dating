<?php
/**
 * CREATE TABLE member(
    member_id INT(6) NOT NULL AUTO_INCREMENT,
    fname VARCHAR(40) NOT NULL,
    lname VARCHAR(60) NOT NULL,
    age INT(3) NOT NULL,
    gender VARCHAR(20),
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(60) NOT NULL,
    state VARCHAR(30),
    seeking VARCHAR(20),
    bio TEXT,
    premium TINYINT(1),
    image VARCHAR(300),
    PRIMARY KEY(member_id)
    );

    CREATE TABLE interests(
    interest_id INT(2) NOT NULL AUTO_INCREMENT,
    interest VARCHAR(60) NOT NULL,
    type VARCHAR(20) NOT NULL,
    PRIMARY KEY(interest_id)
    );

    CREATE TABLE member_interest(
    member_id INT(6) NOT NULL,
    interst_id INT(2) NOT NULL,

    FOREIGN KEY(member_id)
    REFERENCES member(member_id),

    FOREIGN KEY(interest_id)
    REFERENCES interests(interest_id)
    );
 *
    INSERT INTO interests VALUES
    (DEFAULT,'TV','indoor'),(DEFAULT,'Movies','indoor'),
    (DEFAULT,'Board Games','indoor'),(DEFAULT,'Cooking','indoor'),
    (DEFAULT,'Puzzles','indoor'),(DEFAULT,'Reading','indoor'),
    (DEFAULT,'Playing Cards','indoor'),(DEFAULT,'Video Games','indoor'),
    (DEFAULT,'Hiking','outdoor'),(DEFAULT,'Biking','outdoor'),
    (DEFAULT,'Swimming','outdoor'),(DEFAULT,'Collecting','outdoor'),
    (DEFAULT,'Walking','outdoor'),(DEFAULT,'Climbing','outdoor')
 *
 *
 * This class creates a connection between
 * the database and retreives all the required
 * data
 * @author Oleg Rovinskiy
 * @version 1.0
 */

require_once("/home2/orovinsk/connection.php");

class DatabaseDate
{
    private $_db;

    /**
     * DatabaseDate constructor.
     * Creates a new PDO connection
     */
    function __construct()
    {
        //This part checks if the connection was successful
        //Its commented out because it sends a header creating a problem
        //for sessions
        /*try{
            //Create a new PDO connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            echo "Connected";
        }catch (PDOException $e){
            echo $e->getMessage();
        }*/
        $this->_db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    /**
     * Inserts the users information into the members table and
     * inserts the correct ids into the member_insert table
     */
    function insertMember()
    {
        $memberObj = $_SESSION['member'];

        $sql = "INSERT INTO member VALUES(DEFAULT, :fname, :lname, :age , :gender,
                :pnumber, :mail , :state, :seeking , :bio, :prem ,null)";

        $statement = $this->_db->prepare($sql);

        $a = $memberObj->getFName();
        $b =$memberObj->getLName();
        $c =$memberObj->getAge();
        $d =$memberObj->getGender();
        $e =$memberObj->getPhone();
        $f =$memberObj->getEmail();
        $g =$memberObj->getState();
        $h =$memberObj->getSeeking();
        $i =$memberObj->getBio();

        $statement->bindParam(':fname',$a);
        $statement->bindParam(':lname',$b);
        $statement->bindParam(':age',$c);
        $statement->bindParam(':gender',$d);
        $statement->bindParam(':pnumber',$e);
        $statement->bindParam(':mail',$f);
        $statement->bindParam(':state',$g);
        $statement->bindParam(':seeking',$h);
        $statement->bindParam(':bio',$i);

        if($_SESSION['premium']){
            $var = 1;
            $statement->bindParam(':prem',$var);
        }
        else{
            $var = 0;
            $statement->bindParam(':prem',$var);
        }


        $statement->execute();

        if($_SESSION['premium']){
            $interArray = $memberObj->getInterestArray();
            $memId = $this->_db->lastInsertId();


            foreach ($interArray as $value){
                $interID = $this->getInterest($value);
                $this->insertInterest($memId,$interID['interest_id']);
            }


        }
    }

    /**
     * This methods gets all the possible members in the table
     * @return array = all the rows of
     * all the members information as a associate array
     */
    function getMembers()
    {
        $sql = 'SELECT * FROM member ORDER BY lname';

        $statement = $this->_db->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**This method gets the interst of the giving member id
     * @param $memID = member id
     * @return array = all the interest of the user
     */
    function getMemInterest($memID)
    {
        $sql = "SELECT interest FROM interests AS inter INNER JOIN member_interest 
                AS mem ON mem.interest_id = inter.interest_id
                INNER JOIN member ON member.member_id = mem.member_id WHERE member.member_id = :memID";

        $statement = $this->_db->prepare($sql);

        $statement->bindParam(':memID',$memID);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This gets a single interest based on the name of the
     * interest
     * @param $interest = interest name
     * @return mixed = array with one interest
     */
    function getInterest($interest)
    {
        $sql = "SELECT interest_id FROM interests WHERE interest = :interName";

        $statement = $this->_db->prepare($sql);

        $statement->bindParam(':interName',$interest);

        $statement->execute();

         return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**Inserts the specific interest a user selected
     * into the member_interest
     * @param $memId = member id
     * @param $interID = interest id
     */
    function insertInterest($memId, $interID)
    {
        $sql = 'INSERT INTO member_interest VALUES(:memberID,:interID)';

        $statement = $this->_db->prepare($sql);

        $statement->bindParam(':interID',$interID);
        $statement->bindParam(':memberID',$memId);

        $statement->execute();
    }

}