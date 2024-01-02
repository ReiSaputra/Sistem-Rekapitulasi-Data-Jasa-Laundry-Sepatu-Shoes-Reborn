<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . "/../../../model/connection.php";

// Jika tidak ada data yang dikirimkan dari login Owner tidak ada key username dan id
if (!isset($_SESSION["usernameEmp"])) {
    // Jika Benar salah
    header("Location: ../login/loginEmployee.php");
}

$nowDate = date('Y-m-d');

$sql = "SELECT * FROM report WHERE report_date = '$nowDate'";

$query = mysqli_query(mySqlConnection(), $sql);

while ($row = mysqli_fetch_assoc($query)) {
    $item[] = $row;
    // var_dump($item);
}

$sqlAssignment = "SELECT COUNT(report_status) FROM report WHERE report_date = '$nowDate'";

$sqlAssignmentQuery = mysqli_query(mySqlConnection(), $sqlAssignment);
$numberData0 = mysqli_fetch_assoc($sqlAssignmentQuery);

$sqlProccess = "SELECT COUNT(report_status) FROM report WHERE report_status = 'Belum Dilihat' AND report_date = '$nowDate'";

$sqlProccessQuery = mysqli_query(mySqlConnection(), $sqlProccess);
$numberData1 = mysqli_fetch_assoc($sqlProccessQuery);

$sqlDone = "SELECT COUNT(report_status) FROM report WHERE report_status = 'Dilihat' AND report_date = '$nowDate'";

$sqlDoneQuery = mysqli_query(mySqlConnection(), $sqlDone);
$numberData2 = mysqli_fetch_assoc($sqlDoneQuery);
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
                        <h4 class="borders ms-3 mt-2"><strong>Buat Laporan</strong></h4>
                    </div>
                </div>
                <!-- Tab Menu -->
                <div class="container-fluid tab-menu">
                    <div class="row border">
                        <div class="col-4 border d-flex justify-content-start align-items-center">
                            <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                                <i class="y fa-regular fa-clipboard"></i>
                            </div>
                            <div class="tab-box-title ms-2">
                                <h6 class="tab-title"><strong>Data Laporan Harian</strong></h6>
                                <h6 class="tab-number">
                                    <?php
                                    foreach ($numberData0 as $dataProses0) {
                                        echo $dataProses0;
                                    }
                                    ?>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 border d-flex justify-content-start align-items-center">
                            <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                                <i class="r fa-solid fa-timeline"></i>
                            </div>
                            <div class="tab-box-title ms-2">
                                <h6 class="tab-title"><strong>Belum Dilihat</strong></h6>
                                <h6 class="tab-number">
                                    <?php
                                    foreach ($numberData1 as $dataProses1) {
                                        echo $dataProses1;
                                    }
                                    ?>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 border d-flex justify-content-start align-items-center">
                            <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                                <i class="g fa-solid fa-check"></i>
                            </div>
                            <div class="tab-box-title ms-2">
                                <h6 class="tab-title"><strong>Dibaca</strong></h6>
                                <h6 class="tab-number">
                                    <?php
                                    foreach ($numberData2 as $dataProses2) {
                                        echo $dataProses2;
                                    }
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabless mt-4 ps-4 pe-4 pb-4">
                    <div class="insert-menu borders d-flex justify-content-end mb-3">
                        <a class="btn ps-5 pe-5 btn-outline-dark" href="tambahLaporan.php">Tambah
                            Laporan</a>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <?php foreach ($item as $rowItem) { ?>
                                <a href="cekLaporan.php?id=<?php echo $rowItem["report_id"]; ?>"
                                    class="col-12 border mt-3 p-3 bg-secondary-subtle rounded" style="color: #090927;">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <h4><strong>
                                                    <?php echo $rowItem["report_title"]; ?>
                                                </strong></h4>
                                            <p>
                                                <?php echo $rowItem["report_date"]; ?>
                                            </p>
                                        </div>
                                        <div class=" d-flex align-items-center">
                                            <?php echo $rowItem["report_status"]; ?>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
</body>

</html>