<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . "/../../../model/connection.php";

$nowDate = date('Y-m-d');

if (!isset($_SESSION["username"])) {
  // Jika Benar salah
  header("Location: ../login/loginOwner.php");
  exit();
}

// Jika tombol sumit ditekan
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $sql = "SELECT * FROM employee WHERE employee_id = $id";
  $query = mysqli_query(mySqlConnection(), $sql);
}

if (isset($_POST["submit"])) {
  $empId = $_POST["id"]; // URL id
  $empName = $_POST["nama"]; // URL nama
  $empUsername = $_POST["username"]; // URL Username 
  $empPassword = $_POST["password"]; // URL Password
  $empDate = $_POST["tanggal"]; // URL tanggal

  $sql = "UPDATE employee SET
                employee_name = '$empName',
                employee_username = '$empUsername',
                employee_password = '$empPassword',
                employee_date_of_join = '$empDate'
                WHERE employee_id = $empId";

  $query = mysqli_query(mySqlConnection(), $sql);

  header("Location: dataKaryawan.php");
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
      <a class="navbar-brand" href="">
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
              <a href=".php">
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
            <h4 class="borders ms-3 mt-2"><strong>Detail Akun Karyawan</strong></h4>
          </div>
        </div>
        <!-- Tab Menu -->
        <div class="tabless mt-4 ps-4 pe-4 pb-4">
          <form action="" method="post">
            <?php while ($fetch = mysqli_fetch_assoc($query)) {
              ?>
              <div class="mb-3">
                <input type="hidden" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp"
                  placeholder="Masukkan Username Karyawan" autocomplete="off" name="id" required
                  value="<?php echo $fetch['employee_id']; ?>" />
              </div>
              <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp"
                  placeholder="Masukkan Username Karyawan" autocomplete="off" name="username" required
                  value="<?php echo $fetch['employee_username']; ?>" />
              </div>
              <div class="mb-3">
                <label for="exampleInputNama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleInputNama" aria-describedby="emailHelp"
                  placeholder="Masukkan Nama Karyawan" autocomplete="off" name="nama" required
                  value="<?php echo $fetch['employee_name']; ?>" />
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp"
                  placeholder="Masukkan Password" autocomplete="off" name="password" required
                  value="<?php echo $fetch['employee_password']; ?>" />
              </div>
              <div class="mb-3">
                <label for="exampleInputTanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="exampleInputTanggal" aria-describedby="emailHelp"
                  placeholder="Masukkan" autocomplete="off" name="tanggal"
                  value="<?php echo $fetch['employee_date_of_join']; ?>" required />
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
              </div>
              <?php
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
</body>

</html>