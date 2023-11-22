<?php
    function mySqlConnection(): mysqli
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "shoes_reborn004";
        
        return mysqli_connect($host, $user, $password, $dbname);
    }
?>