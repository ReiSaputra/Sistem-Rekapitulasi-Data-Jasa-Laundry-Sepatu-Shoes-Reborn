<?php
// Lakukan session
session_start();
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . "/../../../model/connection.php";

$nowDate = date('Y-m-d');

// Jika tidak ada data yang dikirimkan dari login Owner tidak ada key username dan id
if (!isset($_SESSION["username"])) {
    // Jika Benar salah
    header("Location: ../login/loginOwner.php");
    exit();
}

$sql = "SELECT p.*, c.*, e.*, t.* FROM production_detail AS p
        INNER JOIN client AS c ON p.production_id_client = c.client_id
        INNER JOIN employee AS e ON p.production_id_employee = e.employee_id
        INNER JOIN treatment_detail AS t ON p.production_id_treatment_dtl = t.treatment_id
        ORDER BY p.production_nama ASC";

$query = mysqli_query(mySqlConnection(), $sql);

while ($row = mysqli_fetch_assoc($query)) {
    $item[] = $row;
}

$sqlAssignment = "SELECT COUNT(production_id) FROM production_detail";

$sqlAssignmentQuery = mysqli_query(mySqlConnection(), $sqlAssignment);
$numberData0 = mysqli_fetch_assoc($sqlAssignmentQuery);

$sqlProccess = "SELECT COUNT(production_status)FROM production_detail
                WHERE production_status = 'Tidak Selesai'";


$sqlProccessQuery = mysqli_query(mySqlConnection(), $sqlProccess);
$numberData1 = mysqli_fetch_assoc($sqlProccessQuery);

$sqlDone = "SELECT COUNT(production_status) FROM production_detail
            WHERE production_status = 'Selesai'";

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
            <a class="navbar-brand" href="#">
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
                    <h6 class="borders p-2 mb-0"><a href="cekData.php">
                            <?php echo $_SESSION["username"]; ?>
                        </a></h6>
                    <h6 class="borders mb-0 p-2">Owner</h6>
                </div>
                <!-- Board -->
                <div class="board borders p-3">
                    <!-- Dashboard -->
                    <div class="dashboard borders">
                        <h6 class="title-dashboard borders p-2"><strong>LAPORAN KARYAWAN</strong></h6>
                        <!-- Dashboard-Child -->
                        <ul class="dashboard-child borders ps-4">
                            <a href="lobbyOwner.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Dashboard</h6>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <!-- Report -->
                    <div class="report borders">
                        <h6 class="title-report borders p-2"><strong>HISTORI</strong></h6>
                        <!-- Report-Child -->
                        <ul class="report-child borders ps-4">
                            <a href="historiPengerjaan.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Histori Pengerjaan</h6>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <div class="report borders">
                        <h6 class="title-report borders p-2"><strong>KARYAWAN</strong></h6>
                        <!-- Report-Child -->
                        <ul class="report-child borders ps-4">
                            <a href="dataKaryawan.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Data Karyawan</h6>
                                </li>
                            </a>
                            <a href="tambahKaryawan.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Buat Akun</h6>
                                </li>
                            </a>
                            <a href="laporanKaryawan.php">
                                <li class="list borders d-flex p-2">
                                    <img src="" alt="" />
                                    <h6>Laporan Karyawan</h6>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <a href="../logout/logout.php" class="text-danger">
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
                        <h4 class="borders ms-3 mt-2"><strong>Histori Pengerjaan</strong></h4>
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
                                <h6 class="tab-title"><strong>Total Pengerjaan</strong></h6>
                                <h6 class="tab-number">
                                    <?php echo $numberData0["COUNT(production_id)"]; ?>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 border d-flex justify-content-start align-items-center">
                            <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                                <i class="r fa-solid fa-timeline"></i>
                            </div>
                            <div class="tab-box-title ms-2">
                                <h6 class="tab-title"><strong>Total Tidak Selesai</strong></h6>
                                <h6 class="tab-number">
                                    <?php echo $numberData1["COUNT(production_status)"]; ?>
                                </h6>
                            </div>
                        </div>
                        <div class="col-4 border d-flex justify-content-start align-items-center">
                            <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                                <i class="g fa-solid fa-check"></i>
                            </div>
                            <div class="tab-box-title ms-2">
                                <h6 class="tab-title"><strong>Total Selesai</strong></h6>
                                <h6 class="tab-number">
                                    <?php echo $numberData2["COUNT(production_status)"]; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabless mt-4 ps-4 pe-4 pb-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Client</th>
                                <th scope="col">Karyawan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($item as $rowItem) { ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $i; ?>
                                    </th>
                                    <td>
                                        <?php echo $rowItem["production_nama"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowItem["client_name"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowItem["employee_username"]; ?>
                                    </td>
                                    <?php if ($rowItem["production_status"] == "Proses") { ?>
                                        <td style="color: #edc511;">
                                        <?php } else if ($rowItem["production_status"] == "Selesai") { ?>
                                            <td style="color: #198754;">
                                        <?php } else if ($rowItem["production_status"] == "Tidak Selesai") { ?>
                                                <td style="color: #b40d0d;">
                                        <?php } ?>
                                        <?php echo $rowItem["production_status"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowItem["production_deadline"]; ?>
                                    </td>
                                    <td>
                                        <div>
                                            <a class="btn btn-primary"
                                                href="detailPengerjaanAlt.php?id=<?php echo $rowItem["production_id"]; ?>"><i
                                                    class="fa-solid fa-magnifying-glass me-2"></i>Detail</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
</body>

</html>