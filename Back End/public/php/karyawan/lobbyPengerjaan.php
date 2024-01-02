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

$sql = "SELECT p.*, c.*, e.*, t.* FROM production_detail AS p
        INNER JOIN client AS c ON p.production_id_client = c.client_id
        INNER JOIN employee AS e ON p.production_id_employee = e.employee_id
        INNER JOIN treatment_detail AS t ON p.production_id_treatment_dtl = t.treatment_id
        WHERE e.employee_username = '{$_SESSION['usernameEmp']}' AND p.production_begin = '$nowDate' ORDER BY p.production_nama ASC";

$query = mysqli_query(mySqlConnection(), $sql);

while ($row = mysqli_fetch_assoc($query)) {
  $item[] = $row;
}

$sqlAssignment = "SELECT COUNT(production_status), e.employee_username FROM production_detail AS p
                  INNER JOIN employee AS e ON p.production_id_employee = e.employee_id
                  WHERE p.production_begin = '$nowDate' AND e.employee_username = '{$_SESSION['usernameEmp']}'";

$sqlAssignmentQuery = mysqli_query(mySqlConnection(), $sqlAssignment);
$numberData0 = mysqli_fetch_assoc($sqlAssignmentQuery);

$sqlProccess = "SELECT COUNT(production_status), e.employee_username FROM production_detail AS p
                INNER JOIN employee AS e ON p.production_id_employee = e.employee_id
                WHERE p.production_begin = '$nowDate' AND p.production_status = 'Proses' AND e.employee_username = '{$_SESSION['usernameEmp']}'";

$sqlProccessQuery = mysqli_query(mySqlConnection(), $sqlProccess);
$numberData1 = mysqli_fetch_assoc($sqlProccessQuery);

$sqlDone = "SELECT COUNT(production_status), e.employee_username FROM production_detail AS p
            INNER JOIN employee AS e ON p.production_id_employee = e.employee_id
            WHERE p.production_begin = '$nowDate' AND p.production_status = 'Selesai' AND e.employee_username = '{$_SESSION['usernameEmp']}'";

$sqlDoneQuery = mysqli_query(mySqlConnection(), $sqlDone);
$numberData2 = mysqli_fetch_assoc($sqlDoneQuery);

// Mekanisme Deadline
$dateString = date("Y-m-d");
$timestamp = strtotime($nowDate);
$integerDate = (int) $timestamp;

$sqlDeadlineChanger = "SELECT production_deadline FROM production_detail";

$queryDeadline = mysqli_query(mySqlConnection(), $sqlDeadlineChanger);

while ($fetch = mysqli_fetch_assoc($queryDeadline)) {
  foreach ($fetch as $row) {
    $dateIntoTime = strtotime($row);
    $timeIntoInt = (int) $dateIntoTime;
  }
}

if ($integerDate >= $timeIntoInt) {
  $sqlDeadlineChanging = "UPDATE production_detail
                          SET production_status = 'Tidak Selesai' WHERE production_status = 'Proses'";

  $queryChanger = mysqli_query(mySqlConnection(), $sqlDeadlineChanging);
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
            <h4 class="borders ms-3 mt-2"><strong>Data Pengerjaan</strong></h4>
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
                <h6 class="tab-title"><strong>Data Pengerjaan Hari Ini</strong></h6>
                <h6 class="tab-number">
                  <?php
                  echo $numberData0["COUNT(production_status)"];
                  ?>
                </h6>
              </div>
            </div>
            <div class="col-4 border d-flex justify-content-start align-items-center">
              <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                <i class="r fa-solid fa-timeline"></i>
              </div>
              <div class="tab-box-title ms-2">
                <h6 class="tab-title"><strong>Sedang Berjalan</strong></h6>
                <h6 class="tab-number">
                  <?php
                  echo $numberData1["COUNT(production_status)"];
                  ?>
                </h6>
              </div>
            </div>
            <div class="col-4 border d-flex justify-content-start align-items-center">
              <div class="tab-icon me-2 d-flex justify-content-center align-items-center">
                <i class="g fa-solid fa-check"></i>
              </div>
              <div class="tab-box-title ms-2">
                <h6 class="tab-title"><strong>Selesai</strong></h6>
                <h6 class="tab-number">
                  <?php
                  echo $numberData2["COUNT(production_status)"];
                  ?>
                </h6>
              </div>
            </div>
          </div>
        </div>
        <div class="tabless mt-4 ps-4 pe-4 pb-4">
          <div class="insert-menu borders d-flex justify-content-end mb-3">
            <a class="btn ps-5 pe-5 btn-outline-dark" href="tambahPengerjaanClient.php"> <img src="" alt="" />Tambah
              Pengerjaan</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Client</th>
                <th scope="col">Jenis Treatment</th>
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
                    <?php echo $rowItem["treatment_name"]; ?>
                  </td>
                  <?php if ($rowItem["production_status"] == "Proses") { ?>
                    <td style="color: #edc511;">
                    <?php } else if ($rowItem["production_status"] == "Selesai") { ?>
                      <td style="color: #198754;">
                    <?php } ?>
                    <?php echo $rowItem["production_status"]; ?>
                  </td>
                  <td>
                    <?php echo $rowItem["production_deadline"]; ?>
                  </td>
                  <td>
                    <div>
                      <?php if ($rowItem["production_status"] == "Proses") { ?>
                        <a class="btn btn-success" href="donePengerjaan.php?id=<?php echo $rowItem["production_id"]; ?>"><i
                            class="fa-solid fa-check me-2"></i>Selesai</a>
                        <a class="btn btn-primary"
                          href="detailPengerjaan.php?id=<?php echo $rowItem["production_id"]; ?>"><i
                            class="fa-solid fa-magnifying-glass me-2"></i>Detail</a>
                      <?php } else if ($rowItem["production_status"] == "Selesai") { ?>
                          <a class="btn btn-primary"
                            href="detailPengerjaanAlt.php?id=<?php echo $rowItem["production_id"]; ?>"><i
                              class="fa-solid fa-magnifying-glass me-2"></i>Detail</a>
                      <?php } ?>
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