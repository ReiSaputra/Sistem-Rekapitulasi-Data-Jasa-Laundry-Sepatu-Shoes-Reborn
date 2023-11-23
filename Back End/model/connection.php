<?php
    function mySqlConnection(): mysqli
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "reborn";
        
        return mysqli_connect($host, $user, $password, $dbname);
    }
?>