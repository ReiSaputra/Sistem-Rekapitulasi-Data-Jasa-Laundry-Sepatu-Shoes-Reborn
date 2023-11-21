<?php
  require_once __DIR__ . "/../../../model/connection.php";

  if(isset($_POST["createAccountOwner"]))
  {
    mySqlConnection();

    $usernameOwn = $_POST["usn"];
    $nameOwn = $_POST["name"];
    $passwordOwn = $_POST["pass"];

    $passwordOwnHash = password_hash($passwordOwn, PASSWORD_DEFAULT);

    $sqlInsert = "SELECT owner_username FROM owner WHERE owner_username = '$usernameOwn'";
    $queryCheckOwn = mysqli_query(mySqlConnection(), $sqlInsert);

    if(mysqli_num_rows($queryCheckOwn) > 0)
    {
      $errorCheckOwn = true;
    } else 
    {
      mysqli_query(mySqlConnection(), "INSERT INTO owner (owner_name, owner_username, owner_password) VALUES ('$nameOwn', '$usernameOwn', '$passwordOwnHash')");
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
        <a class="navbar-brand" href="#">
          <img src="../../../assets/img/JPG/LOGO-B-300x300.png" alt="Shoes Reborn" width="40" height="40" />
        </a>
      </div>
    </nav>
    <!-- Div-Container -->
    <div class="div-container container-fluid">
      <h2 class="text-center">
        <strong>Registrasi<br />Owner</strong>
      </h2>
      <h6 class="text-center mt-3">
        Buat Akun Ownermu sendiri
      </h6>
      <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" method="post">
          <div class="mb-3">
            <label for="exampleInputUsn" class="form-label">Username</label>
            <input type="text" autocomplete="off" class="form-control" id="exampleInputUsn" aria-describedby="emailHelp" name="usn" required/>
            <div id="emailHelp" class="form-text">
              <?php if(isset($errorCheckOwn)) { ?>
                <p class="text-danger">Username telah dibuat! Silahkan cari Username lain.</p>
              <?php } ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nama Lengkap</label>
            <input type="text" autocomplete="off" class="form-control" id="exampleInputName" aria-describedby="emailHelp" name="name" required/>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required/>
          </div>
          <button type="submit" class="btn btn-primary px-4 mb-4" name="createAccountOwner">Buat Akun</button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
