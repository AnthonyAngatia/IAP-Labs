<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'IAPLAB');


class DBConnector
{
    public $conn;

    function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER,DB_PASS) or die("Error:".mysql_error());
        mysqli_select_db($this->conn, DB_NAME);
    }

    public function closeDatabase()
    {
        echo "closed db";
        mysqli_close($this->conn);
    }
}

?>