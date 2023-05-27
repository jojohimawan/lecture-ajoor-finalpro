<?php

  session_start();

  // redirect user to landing page if logged in
  if( isset($_SESSION["login"]) ) {
    header("Location: ./../index.php");
  }

  require_once __DIR__ . "./../php/conn/index.php";
  require_once __DIR__ . "./../php/func/index.php";

  // handle registration
  if( isset($_POST["register"]) ) {
    if( userRegister($_POST) > 0 ) {
      echo "<script>
                alert('Berhasil daftar');
            </script>";
    } else {
      echo "<script>
                alert('Gagal daftar');
            </script>";
    }
  }

  // handle login
  if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = pg_query($conn, "SELECT * FROM users WHERE username='$username'");
    if( pg_num_rows($result) === 1 ) {
      $row = pg_fetch_assoc($result);
      if( password_verify($password, $row["password"]) ) { 
        // create session if password verified
        $_SESSION["login"] = true;
        $_SESSION["loggeduser"] = $row["username"];

        // redirect if password verified
        header("Location: ./../index.php");
        exit;
      }

      // return error if password is false
      $error = true;

    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="icon"  href="./../assets/favicon.jpg" />
    <link rel="stylesheet" href="./../css/style.css">
    <title>Login to Ajoor</title>
  </head>
  <body>
    <section class="login-user">
      <div class="left p-5">
        <a class="" href="home.html">
          <img src="./../assets/Logo.jpg" alt="" width="48" height="60">
        </a>
        <h2 class="fw-bold mt-5 mb-2 freebie-card-title text-start">Masuk Akun</h2>
        <p class="text-start mb-5">Masuk untuk unduh aset.</p>
        <?php if( isset($error) ) : ?>
          <div class="alert alert-danger" role="alert">
          Username atau password Anda salah!
        </div>
        <?php endif; ?>
        <form action="" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" placeholder="Masukkan email anda" class="form-control" id="username" aria-describedby="emailHelp">
          </div>
          <div class="mb-5">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" placeholder="Masukkan password anda" class="form-control" id="password">
          </div>
          <div class="d-grid gap-2">
              <button type="submit" name="login" class="btn btn-success freebie-card-dl-btn mb-3" >Masuk Akun</button>
              <button type="submit" name="register" class="btn btn-success freebie-card-dl-btn register-btn">Daftar</button>
            </div>
        </form>
      </div>
      <div class="right">
        <img src="./../assets/Group 3.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="480" height="480" loading="lazy">
        <h2 class="fw-bold mt-5 mb-3 freebie-card-title text-center">Design Less,<br>Develop More</h2>
        <p class="text-center mb-5">Kami menyediakan ratusan aset desain pilihan<br>
          untuk project terbaik para desainer,<br> 
          developer, dan business owner.</p>
      </div>
  </section>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>

