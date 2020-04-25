<?php

class City
{
    private $id;

     function __construct( $id ) {
        $this->id = $id;
    }

    public function read(){
        $id = $this->id;
        if($id == 12){
            $query = "SELECT * FROM user WHERE id >= 12";//Choose where id is greater than 12
        }
        else {
            $query = "SELECT * FROM user WHERE id = $id";
        }

        $db_con = new DBConnector;
        $mysqli = $db_con->conn;
        $result = $mysqli->query($query);//Execute the query
        if(!$result){
            echo("Error description: " . $mysqli -> error);
        }
        return $result;

    }

}
?>