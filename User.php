<?php
include "Crud.php";
// include 'DBConnector.php';

class User  implements Crud
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;


 function __construct($first_name, $last_name,$city_name) {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->city_name = $city_name;
    // $this->db ;
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
    $db_con = new DBConnector;
    $mysqli = $db_con->conn;
    //!Style 1
    // $res = mysqli_query($db_con, "INSERT INTO user(first_name,last_name,user_city) VALUES ('$fn','$ln','$city')")
    //  or die("Error".mysqli_error($db_con));
    //  $db_con->closeDatabase();
     //!Style 2
     $res = $mysqli -> query("INSERT INTO user(first_name,last_name,user_city) VALUES ('$fn','$ln','$city')");
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


}

?>