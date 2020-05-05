<?php
include "Crud.php";
include "authenticator.php";
// include 'DBConnector.php';

class User  implements Crud
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    private $username;
    private $password;


 function __construct($first_name, $last_name,$city_name, $username, $password) {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->city_name = $city_name;
    $this->username = $username;
    $this->password = $password;
    // $this->db ;
}
/**
 * Static function to act as our constructor(dummy)
 */
public static function create(){
    $instance = new self();//?What does this line mean?
    return $instance;
}

public function setUsername($username){
    $this->username = $username;
}
public function getUsername()
{
    return $this->username;
}

public function setUserId($user_id){
    $this->user_id = $user_id;
}
public function getUserId()
{
    return $this->$user_id;
}

public function save()
{
    $fn = $this->first_name;
    $ln = $this->last_name;
    $city = $this->city_name;
    $uname = $this->username;
    $this->hashPassword();//!Do not understand this line
    $pass = $this->password;
    $db_con = new DBConnector;
    $mysqli = $db_con->conn;
    //!Style 1
    // $res = mysqli_query($db_con, "INSERT INTO user(first_name,last_name,user_city) VALUES ('$fn','$ln','$city')")
    //  or die("Error".mysqli_error($db_con));
    //  $db_con->closeDatabase();
     //!Style 2
     $res = $mysqli -> query("INSERT INTO user(first_name,last_name,user_city, username, password) VALUES ('$fn','$ln','$city','$uname','$pass')");
     if (!$res) {
        echo("Error description: " . $mysqli -> error);
      }
    
    return $res;
}
public function readAll(){
    return null;
}
    public function readUnique(){
        return null;
    }
    public function search(){
        return null;
    }
    public function update(){
        return null;
    }
    public function removeOne(){
        return null;
    }
    public function removeAll(){
        return null;
    }

    public function validateForm(){
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        if($fn == "" || $ln == "" || $city == ""){
            return false;
        }
        return true;
    }

    public function createFormErrorSessions(){
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
    }

    public  function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect(){
        $con = new DBConnector;
        $found = false;
        $res = $mysqli->query("SELECT * FROM user") or die("Error". mysqli_error());
//!A problem will arise here
        while($row = mysql_fetch_array($res)){
            if(password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row['username'] ){
                $found = true;
            }
        }
        //close database
        $con->closeDatabase();
        return $found;
    }

    public function login(){
        if($this->isPasswordCorrect()){
            header("Location:private_page.php");
        }
    }

    public function createUserSession(){
        session_start();
        $_SESSION['username'] = $this->getUsername();
    }
    public function logout(){
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    }

    public function isUserExist(){
        //get username from input field
        //Compare with the ones in db
        //return true or false
    }


}

?>