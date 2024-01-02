<?php
session_start();

require_once __DIR__ . "/../../../model/connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT * FROM report WHERE report_id = '$id'";

    $query = mysqli_query(mySqlConnection(), $sql);

    while ($fetch = mysqli_fetch_assoc($query)) {
        $row[] = $fetch;
    }

}


$nowDate = date('Y-m-d');

$sqlTreatment = "SELECT * FROM treatment_detail";

$queryTrt = mysqli_query(mySqlConnection(), $sqlTreatment);
while ($queryTrtAssoc = mysqli_fetch_assoc($queryTrt)) {
    $item[] = $queryTrtAssoc;
}

$newDate = date("Y-m-d");
// Jika tidak ada data yang dikirimkan dari login Owner tidak ada key username dan id
if (!isset($_SESSION["usernameEmp"])) {
    // Jika Benar salah
    header("Location: ../login/loginEmployee.php");
}

if (isset($_POST["submit2"])) {

    $id = $_POST["id"];
    $judul = $_POST["judul"];
    $tanggal = $_POST["date"];
    $detail = $_POST["detail"];

    $sql = "UPDATE report
            SET report_title = '$judul',
            report_date = '$tanggal',
            report_detail = '$detail'
            WHERE report_id = $id";

    $query = mysqli_query(mySqlConnection(), $sql);

    header("Location: lobbyLaporan.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lobby</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CSS Vanilla -->
    <link rel="stylesheet" href="../../css/lobbyPengerjaan/style.css" />
</head>

<body>
    <nav class="navbar p-3 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="lobbyPengerjaan.php">
                <img src="../../../assets/img/JPG/LOGO-W-300x300.png" alt="Shoes Reborn" width="40" height="40" />
            </a>
            <h6 class="text-light">
                <?php echo $nowDate; ?>
            </h6>
        </div>
    </nav>
    <!-- Div-Container -->
    <div class="div-container container-fluid borders">
        <!-- Grid -->
        <div class="grid row borders borders-danger">
            <!-- Menu -->
            <div class="menu col-3 borders shadow">
                <!-- Profile -->
                <div class="profile p-3">
                    <h6 class="borders p-2 mb-0"><a href="cekData.html">
                            <?php echo $_SESSION["usernameEmp"]; ?>
                        </a></h6>
                    <h6 class="borders mb-0 p-2">Karyawan</h6>
                </div>
                <!-- Board -->
                <div class="board borders p-3">
                    <!-- Dashboard -->
                    <div class="dashboard borders">
                        <h6 class="title-dashboard borders p-2"><strong>DASHBOARD</strong></h6>
                        <!-- Dashboard-Child -->
                        <ul class="dashboard-child borders ps-4">
                            <a href="lobbyPengerjaan.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Data Pengerjaan</h6>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <!-- Report -->
                    <div class="report borders">
                        <h6 class="title-report borders p-2"><strong>LAPORAN</strong></h6>
                        <!-- Report-Child -->
                        <ul class="report-child borders ps-4">
                            <a href="lobbyLaporan.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Buat Laporan</h6>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <a href="../logout/logout2.php" class="text-danger">
                        <h6 class="title-report borders p-2"><strong>LOGOUT</strong></h6>
                    </a>
                </div>
            </div>
            <!-- Data-Table -->
            <div class="data-table col-9 borders">
                <!-- Tab -->
                <div>
                    <div class="tab borders d-flex align-items-center p-3">
                        <i class="fa fa-search ms-3"></i>
                        <h4 class="borders ms-3 mt-2"><strong>Cek Laporan</strong></h4>
                    </div>
                </div>
                <div class="div-forms p-5">
                    <!-- Form -->
                    <form method="post">
                        <div class="mb-3">
                            <!-- Item ID -->
                            <input type="hidden" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Sepatu" autocomplete="off"
                                name="id" value="<?php echo $row[0]["report_id"]; ?>" />

                            <label for="exampleInputEmail1" class="form-label">Nama Judul</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Masukkan Nama Sepatu" autocomplete="off" name="judul"
                                value="<?php echo $row[0]["report_title"]; ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputJenis" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="exampleInputJenis" aria-describedby="emailHelp"
                                placeholder="Masukkan Nama Sepatu" autocomplete="off" name="date"
                                value="<?php echo $row[0]["report_date"]; ?>" />
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Detail Barang" id="floatingTextarea"
                                    name="detail"><?php echo $row[0]["report_detail"]; ?></textarea>
                                <label for="floatingTextarea">Alamat</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pegawai</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="<?php echo $_SESSION["usernameEmp"] ?>" autocomplete="off" disabled />
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit2">Update</button>
                    </form>

                    <a href="lobbyPengerjaan.php" class="btn btn-outline-primary">Cancel</a>

                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
</body>

</html>