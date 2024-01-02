<?php
session_start();

require_once __DIR__ . "/../../../model/connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT p.*, c.*, e.*, t.* FROM production_detail AS p INNER JOIN client AS c ON p.production_id_client = c.client_id
          INNER JOIN employee AS e ON p.production_id_employee = e.employee_id
          INNER JOIN treatment_detail AS t ON p.production_id_treatment_dtl = t.treatment_id
          WHERE p.production_id = $id";

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

    $itemId = $_POST["itemId"];
    $itemName = $_POST["itemName"]; //String
    $detail = $_POST["detail"]; //String

    $sql = "UPDATE production_detail
            SET production_nama = '$itemName',
            production_detail = '$detail' WHERE production_id = $itemId";

    $query = mysqli_query(mySqlConnection(), $sql);

    header("Location: lobbyPengerjaan.php");
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
                            <!-- Item ID -->
                            <input type="hidden" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Sepatu" autocomplete="off"
                                name="itemId" value="<?php echo $row[0]["production_id"]; ?>" />

                            <label for="exampleInputEmail1" class="form-label">Nama Sepatu</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Masukkan Nama Sepatu" autocomplete="off" name="itemName"
                                value="<?php echo $row[0]["production_nama"]; ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputJenis" class="form-label">Jenis Perawatan</label>
                            <input type="text" class="form-control" id="exampleInputJenis" aria-describedby="emailHelp"
                                disabled placeholder="Masukkan Nama Sepatu" autocomplete="off" name="itemName"
                                value="<?php echo $row[0]["treatment_name"]; ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputHarga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="exampleInputHarga" aria-describedby="emailHelp"
                                disabled placeholder="Masukkan Nama Sepatu" autocomplete="off" name="itemName"
                                value="Rp. <?php echo $row[0]["treatment_price"]; ?>" />
                        </div>
                        <!-- Hidden Date Begin -->
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="<?php echo date("Y-m-d") ?>" autocomplete="off"
                                name="begin" />
                        </div>
                        <div class="mb-3">
                            <label for="date1" class="form-label">Tanggal Mulai Pengerjaan</label>
                            <input type="date" class="form-control" id="date1" aria-describedby="emailHelp"
                                value="<?php echo date("Y-m-d") ?>" autocomplete="off" name="date" disabled />
                        </div>
                        <!-- Hidden Date Deadline -->
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                value="<?php echo date("Y-m-d", strtotime($newDate . " + 1 Day")) ?>" autocomplete="off"
                                name="deadline" />
                        </div>
                        <!-- Tampilan -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="<?php echo date("Y-m-d", strtotime($newDate . " + 1 Day")) ?>" autocomplete="off"
                                disabled />
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Detail Barang" id="floatingTextarea"
                                    name="detail"><?php echo $row[0]["production_detail"]; ?></textarea>
                                <label for="floatingTextarea">Detail</label>
                            </div>
                        </div>
                        <!-- Hidden Pegawai -->
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="<?php echo $_SESSION["usernameEmp"] ?>"
                                autocomplete="off" name="namaPegawai" />
                        </div>
                        <!-- Tampilan -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pegawai</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="<?php echo $_SESSION["usernameEmp"] ?>" autocomplete="off" disabled />
                        </div>
                        <!-- Tampilan -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Client</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="<?php echo $row[0]["client_name"]; ?>" autocomplete="off" disabled />
                        </div>
                        <!-- Hidden -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor Telpon</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="<?php echo $row[0]["client_telephone_num"]; ?>" autocomplete="off" disabled />
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Detail Barang" id="floatingTextarea"
                                    name="detail" disabled><?php echo $row[0]["client_address"]; ?></textarea>
                                <label for="floatingTextarea">Alamat</label>
                            </div>
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