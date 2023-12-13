<?php
  session_start();

  require_once __DIR__ . "/../../../model/connection.php";

  if(!isset($_SESSION["username"]))
  {
  // Jika Benar salah
  header("Location: ../login/loginOwner.php");
  }

  // Jika tombol sumit ditekan
  if(isset($_POST["submit"]))
  {
    $empName = $_POST["nama"]; // URL nama
    $empUsername = $_POST["username"]; // URL Username 
    $empPassword = $_POST["password"]; // URL Password
    $empDate = $_POST["tanggal"]; // URL tanggal
  
    $newDate = date('Y-m-d', strtotime($empDate));

    // Melihat terlebih dahulu tabel username
    $sqlSelect = "SELECT * FROM employee WHERE employee_username = '$empUsername'";

    // Masukkan kueri
    $querySelect = mysqli_query(mySqlConnection(), $sqlSelect);

    // var_dump(mysqli_num_rows($querySelect));
    
    // Jika username untuk username lebih dari 0
    if(mysqli_num_rows($querySelect) > 0)
    {
      $error = true;
    }
    else
    {
      // Masukkan data
      $sqlInsert = "INSERT INTO employee (employee_name, employee_username, employee_password, employee_date_of_join) VALUES ('$empName', '$empUsername', '$empPassword', '$newDate')";

      // Jalankan
      $querySelect = mysqli_query(mySqlConnection(), $sqlInsert);

      header("Location: dataKaryawan.php");
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lobby</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CSS Vanilla -->
    <link rel="stylesheet" href="../../css/lobbyPengerjaan/style.css" />
  </head>
  <body>
    <nav class="navbar p-3 shadow">
      <div class="container-fluid">
        <a class="navbar-brand" href="">
          <img src="../../../assets/img/JPG/LOGO-W-300x300.png" alt="Shoes Reborn" width="40" height="40" />
        </a>
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
            <h6 class="borders p-2 mb-0"><a href="cekData.php"><?php echo $_SESSION["username"]; ?></a></h6>
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
                    <h6>Buat Akun Karyawan</h6>
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
              <h4 class="borders ms-3 mt-2"><strong>Buat Akun Karyawan</strong></h4>
            </div>
          </div>
          <!-- Tab Menu -->
          <div class="tabless mt-4 ps-4 pe-4 pb-4">
            <form action="" method="post">
              <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Masukkan Username Karyawan" autocomplete="off" name="username" required />
                <?php
                  if(isset($error))
                  {
                ?>
                <p style="color: red;">Username sudah digunakan, silahkan pilih yang lain.</p>
                <?php  
                  }
                ?>
              </div>
              <div class="mb-3">
                <label for="exampleInputNama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Masukkan Nama Karyawan" autocomplete="off" name="nama" required />
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp" placeholder="Masukkan Password" autocomplete="off" name="password" required />
              </div>
              <div class="mb-3">
                <label for="exampleInputTanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="exampleInputTanggal" aria-describedby="emailHelp" placeholder="Masukkan" autocomplete="off" name="tanggal" value="<?php echo date("Y-m-d") ?>" required />
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://kit.fontawesome.com/fe386f267a.js" crossorigin="anonymous"></script>
  </body>
</html>
