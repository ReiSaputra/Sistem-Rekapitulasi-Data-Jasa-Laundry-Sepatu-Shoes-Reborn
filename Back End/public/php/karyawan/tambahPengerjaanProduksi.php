<?php
session_start();

require_once __DIR__ . "/../../../model/connection.php";

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

if (isset($_POST["submit"])) {
  $nama = $_POST["nama"];
  $wa = $_POST["wa"];
  $alamat = $_POST["alamat"];

  $sql = "INSERT INTO client (client_name, client_address, client_telephone_num) VALUES
            ('$nama', '$alamat', '$wa')";

  mysqli_begin_transaction(mySqlConnection());

  $query = mysqli_query(mySqlConnection(), $sql);

  if ($query) {
    $commit = true;
    mysqli_commit(mySqlConnection());
  } else {
    $commit = false;
    mysqli_rollback(mySqlConnection());
  }

}

if (isset($_POST["submit2"])) {
  // 6
  $itemName = $_POST["itemName"]; //String
  $jenis = $_POST["jenis"]; //Value 1, 2, 3
  $begin = $_POST["begin"];
  $deadline = $_POST["deadline"]; //Time
  $detail = $_POST["detail"]; //String
  $namaPegawai = $_POST["namaPegawai"]; //Return
  $klienRaw = $_POST["klien"];
  $klienWA = $_POST["klienWA"];

  $searchKlien = "SELECT * FROM client WHERE client_name = '$klienRaw' AND client_telephone_num = '$klienWA'";
  $klienId = mysqli_query(mySqlConnection(), $searchKlien);
  $klienIdAssoc = mysqli_fetch_assoc($klienId);
  $klien = $klienIdAssoc;
  $klienn = $klien["client_id"];

  $searchPegawai = "SELECT * FROM employee WHERE employee_username = '$namaPegawai'";
  $pegawaiId = mysqli_query(mySqlConnection(), $searchPegawai);
  $pegawaiIdAssoc = mysqli_fetch_assoc($pegawaiId);
  $pegawai = $pegawaiIdAssoc;
  $pegawaii = $pegawai["employee_id"];

  // var_dump($pegawai) . "<br />";
  // var_dump($klien);

  $sql = "INSERT INTO production_detail
            (production_nama, production_begin, production_deadline, production_detail, production_id_employee, production_id_client, production_id_treatment_dtl)
            VALUES ('$itemName', '$begin', '$deadline', '$detail', '$pegawaii', '$klienn', '$jenis')";
  $query = mysqli_query(mySqlConnection(), $sql);

  if ($query) {
    $commit = true;
    // echo "First query committed successfully.";
    mysqli_commit(mySqlConnection());
    header("Location: lobbyPengerjaan.php");
  } else {
    $commit = false;
    // echo "Error executing first query: " . mysqli_error(mySqlConnection());
    mysqli_rollback(mySqlConnection());
  }
} elseif (isset($_POST["submit3"])) {
  mysqli_rollback(mySqlConnection());
}

// if(isset($_GET["back"]))
// {
//   mysqli_rollback(mySqlConnection());
//   $commit = false;
//   // echo "Rolback bagus";
//   // header("Location: lobbyPengerjaan.php");
//   // exit();
// }

//   if ($commit) {
//     // Commit the transaction if the flag is set to true
//     mysqli_commit(mySqlConnection());
//     echo "Transaction committed successfully.";
// } else {
//     // Rollback the transaction if the flag is set to false
//     mysqli_rollback(mySqlConnection());
//     echo "Transaction rolled back.";
// }
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
              <a href="buatLaporan.php">
                <li class="list borders d-flex p-2">
                  <img src="" alt="" />
                  <h6>Buat Laporan</h6>
                </li>
              </a>
            </ul>
          </div>
        </div>
      </div>
      <!-- Data-Table -->
      <div class="data-table col-9 borders">
        <!-- Tab -->
        <div>
          <div class="tab borders d-flex align-items-center p-3">
            <i class="fa fa-search ms-3"></i>
            <h4 class="borders ms-3 mt-2"><strong>Tambah Pengerjaan</strong></h4>
          </div>
        </div>
        <div class="div-forms p-5">
          <!-- Form -->
          <form method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Sepatu</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Masukkan Nama Sepatu" autocomplete="off" name="itemName" />
            </div>
            <select class="form-select" aria-label="Default select example" name="jenis">
              <option disabled selected>Jenis Treatment</option>
              <?php foreach ($item as $row) { ?>
                <option value="<?php echo $row["treatment_id"]; ?>">
                  <?php echo $row["treatment_name"]; ?>
                </option>
              <?php } ?>
            </select>
            <!-- Hidden Date Begin -->
            <div class="mb-3">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo date("Y-m-d") ?>" autocomplete="off" name="begin" />
            </div>
            <!-- Hidden Date Deadline -->
            <div class="mb-3">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo date("Y-m-d", strtotime($newDate . " + 1 Day")) ?>" autocomplete="off"
                name="deadline" />
            </div>
            <!-- Tampilan -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Deadline</label>
              <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo date("Y-m-d", strtotime($newDate . " + 1 Day")) ?>" autocomplete="off" disabled />
            </div>
            <div class="mb-3">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Detail Barang" id="floatingTextarea"
                  name="detail"></textarea>
                <label for="floatingTextarea">Detail</label>
              </div>
            </div>
            <!-- Hidden Pegawai -->
            <div class="mb-3">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $_SESSION["usernameEmp"] ?>" autocomplete="off" name="namaPegawai" />
            </div>
            <!-- Tampilan -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Pegawai</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $_SESSION["usernameEmp"] ?>" autocomplete="off" disabled />
            </div>
            <!-- Hidden -->
            <div class="mb-3">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $wa; ?>" autocomplete="off" name="klienWA" />
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $nama; ?>" autocomplete="off" name="klien" />
            </div>
            <!-- Tampilan -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Client</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $nama; ?>" autocomplete="off" disabled />
            </div>
            <button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
          </form>
          <form action="" method="post">
            <button type="submit" class="btn btn-outline-primary" name="submit3">Batal</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
</body>

</html>