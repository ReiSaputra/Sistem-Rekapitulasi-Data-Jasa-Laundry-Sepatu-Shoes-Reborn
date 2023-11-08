<?php
    function getConnection(): PDO
    {
        $host = "localhost";
        $port = 3306;
        $dbname = "shoes_reborn";
        $user = "root";
        $pass = "";

        return new PDO("mysql:host=$host:$port;dbname=$dbname", $user, $pass);
    }

    // try {
    //     //code...
    //     getConnection();
    //     echo "berhasil masuk";
    // } catch (\Throwable $th) {
    //     echo "gagal: {$th->getMessage()}";
    // }

    // try {
    //     $sql = <<<SQL
    //     INSERT INTO employee VALUES
    //     ("Jojo", "Pura", "uwak", "547", "desember");
    //     SQL;
    //     getConnection()->exec($sql);
    //     echo "berhasil";
    // } catch (\Throwable $th) {
    //     echo "gagal: {$th->getMessage()}";
    // }

    $connection = getConnection();

    $username = "admin";
    $pass= "123";

    // // SQL Injection
    // $sql = "INSERT INTO employee VALUES
    // ('wori', 'inab', :username, :pass, 'juli')"; //atau :username dan :pass diganti ? 
    // $result = $connection->prepare($sql); 
    // $result->bindParam("username", $username); //username diganti index 1
    // $result->bindParam("pass", $username); //pass diganti index 2
    // $result->execute();

    // Query untuk return seperti select
    $sqlshow = "SELECT * FROM employee";
    $result = $connection->query($sqlshow);
    // foreach($result as $row) {
    // var_dump($row);
    // }

    
    while($row = $result->fetchAll(PDO::FETCH_ASSOC))
    {
        var_dump($row["employee_name"]) . PHP_EOL; 
    }

    // if($row = $result->fetch())
    // {
    //     echo $row["employee_username"];
    // } else 
    // {
    //     echo "gagal";
    // }
?>