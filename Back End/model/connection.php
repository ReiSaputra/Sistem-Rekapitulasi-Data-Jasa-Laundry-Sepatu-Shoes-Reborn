<?php
    function mySqlConnection(): mysqli
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "shoes_reborn";
        
        return mysqli_connect($host, $user, $password, $dbname);
    }
?>