<?php
// Hubungkan ke database
require_once __DIR__ . "/../../../model/connection.php";
$nowDate = date('Y-m-d');

if (isset($_POST["tambah"])) {

  mySqlConnection();

  $nama_barang = $_POST['purchase_item_name'];
  $tanggal = $_POST['purchase_date'];
  $total = $_POST['purchase_total'];
  $harga = $_POST['purchase_price'];


  // Query untuk menyimpan data ke dalam database
  $sql = "INSERT INTO purchasing_item (purchase_item_name, purchase_date, purchase_total, purchase_price) VALUES ('$nama_barang', '$tanggal', $total, $harga)";

  $query = mysqli_query(mySqlConnection(), $sql);


  // if ($conn->query($sql) === TRUE) {
  // echo "Tambah pembelian berhasil ditambahkan.";
  // Lakukan commit transaksi
  // $conn->commit();
// } else {
  // echo "Error: " . $sql . "<br>" . $conn->error;
  // Rollback transaksi jika terjadi kesalahan
  // $conn->rollback();
// }


  // Tutup koneksi
// $conn->close();
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
        <img src="/../../../assets/img/JPG/LOGO-W-300x300.png" alt="Shoes Reborn" width="40" height="40" />
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
          <h6 class="borders p-2 mb-0"><a href="cekData.php">Muhammad Fathurraihan Saputra</a></h6>
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
              <a href="lobbyPembelian.php">
                <li class="list borders d-flex p-2">
                  <img src="" alt="" />
                  <h6>Data Pembelian</h6>
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
        </div>
      </div>
      <!-- Data-Table -->
      <div class="data-table col-9 borders">
        <!-- Tab -->
        <div>
          <div class="tab borders d-flex align-items-center p-3">
            <i class="fa fa-search ms-3"></i>
            <h4 class="borders ms-3 mt-2"><strong>Tambah Pembelian</strong></h4>
          </div>
        </div>
        <div class="div-forms p-5">
          <form action="" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Masukkan Nama Barang" autocomplete="off" name="purchase_item_name" />
            </div>
            <div class="mb-3">
              <label for="exampleInputDate" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="exampleInputDate" aria-describedby="emailHelp" value=""
                autocomplete="off" name="purchase_date" />
            </div>
            <div class="mb-3">
              <label for="exampleInputTotal" class="form-label">Total</label>
              <input type="number" class="form-control" id="exampleInputDate" aria-describedby="emailHelp" value=""
                autocomplete="off" name="purchase_total" />
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Harga</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value=""
                autocomplete="off" name="purchase_price" />
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Pegawai</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value=""
                autocomplete="off" disabled name="purchase_id_employee" />
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
</body>

</html>