<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CSS Vanilla -->
    <link rel="stylesheet" href="../../css/choose/style.css" />
    <title>IfOwner</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar p-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="choose.php">
          <img src="../../../assets/img/JPG/LOGO-B-300x300.png" alt="Shoes Reborn" width="40" height="40" />
        </a>
      </div>
    </nav>
    <!-- Div-Container -->
    <div class="div-container container-fluid ">
      <!-- Div-Body -->
      <div class="div-body text-center ">
        <h1 class="">Siapakah Anda?</h1>
        <img class="" src="../../../assets/img/SVG/The Team.svg" alt="" />
        <!-- Choose-Box -->
        <div class="choose-box d-flex justify-content-center ">
          <a href="./loginEmployee.php" class="karyawan text-decoration-none">
            <div class="employee p-1">
              <h3>Karyawan</h3>
            </div>
          </a>
          <a href="./loginOwner.php" class="pemilik text-decoration-none">
            <div class="owner p-1">
              <h3>Owner</h3>
            </div>
          </a>
        </div>
        <!-- Detail Box -->
        <div class="detail-box mt-4 d-flex justify-content-center align-items-center">
          <p class="p-3">Pilih Karyawan atau Owner dan klik untuk <br /><span>Masuk</span></p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
