<?php
session_start();

// Hubungkan ke database
require_once __DIR__ . "/../../../model/connection.php";

// Jika tidak ada data yang dikirimkan dari login Owner tidak ada key username dan id
if (!isset($_SESSION["usernameEmp"])) {
    // Jika Benar salah
    header("Location: ../login/loginEmployee.php");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Status Cleared 
    $sql = "UPDATE production_detail
            SET production_status = 'Selesai'
            WHERE production_id = $id";

    $query = mysqli_query(mySqlConnection(), $sql);

    header("Location: lobbyPengerjaan.php");
}
?>