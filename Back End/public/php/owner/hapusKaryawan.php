<?php
    session_start();

    require_once __DIR__ . "/../../../model/connection.php";

    // Jika tidak ada data yang dikirimkan dari login Owner tidak ada key username dan id
    if(!isset($_SESSION["username"]))
    {
        // Jika Benar salah
        header("Location: ../login/loginOwner.php");
    }

    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        $sql = "DELETE FROM employee WHERE employee_id = $id";

        $query = mysqli_query(mySqlConnection(), $sql);

        header("Location: dataKaryawan.php");
    }
?>