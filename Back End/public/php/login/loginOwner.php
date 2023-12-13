<?php
  session_start();

  require_once __DIR__ . "/../../../model/connection.php";

  if(isset($_POST["submit"]))
  {
    mySqlConnection();

    $usnOwn = $_POST["usn"];
    $passOwn = $_POST["pass"];

    // Menyeleksi Username Owner yang telah diinputkan oleh user
    $checkLogOwn = "SELECT owner_id, owner_username, owner_password FROM owner WHERE owner_username = '$usnOwn'";

    // Melakukan Query
    $queryCheckUsnOwn = mysqli_query(mySqlConnection(), $checkLogOwn);

    // Cek jika terdapat Username Owner dan Password lebih dari 1 (berarti ada)
    if(mysqli_num_rows($queryCheckUsnOwn) > 0)
    {
      // Fetching data
      $fetch = mysqli_fetch_assoc($queryCheckUsnOwn);
      // Id
      $idVerif = $fetch["owner_id"];
      // Owner 
      $ownerVerif = $fetch["owner_username"];
      // Password hash
      $passVerif = $fetch["owner_password"];

      // Cek jika password hash sama dengan password yang telah diinputkan oleh user
      if(password_verify($passOwn, $passVerif))
      {
        // Jika benar halaman dipindahkan ke owner sekalian membawa
        $_SESSION["username"] = $ownerVerif;
        header("Location: ../owner/LobbyOwner.php?");
      }
      else
      {
        // Jika salah akan menset error menjadi true
        $error = true;
      }
    }
    else
    {
      // Jika salah akan menset error menjadi true
      $error = true;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CSS Vanilla -->
    <link rel="stylesheet" href="../css/choose/style.css" />
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
    <div class="div-container container-fluid">
      <h2 class="text-center">
        <strong>Selamat Datang<br />Owner!</strong>
      </h2>
      <h6 class="text-center mt-3">
        Untuk tetap terhubung dengan kami silahkan login dengan<br />
        informasi pribadi Anda dengan akun dan kata sandi
      </h6>
      <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" method="post">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" autocomplete="off" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usn" required/>
            <?php if(isset($error)) { ?>
              <div id="emailHelp" class="form-text text-danger">Username atau Password salah!</div>
            <?php } ?>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required/>
          </div>
          <button type="submit" class="btn btn-primary px-4" name="submit">Login</button>
          <a href="registrasiOwner.php" class="btn px-4 btn-outline-primary">Buat Akun</a>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
