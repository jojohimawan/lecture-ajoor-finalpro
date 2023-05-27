<?php
  session_start();

  require_once __DIR__ . "./php/conn/index.php";
  require_once __DIR__ . "./php/func/index.php";

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
    <link rel="icon"  href="./Assets/favicon.jpg" />
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Ajoor - Home</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="#">
              <img src="./Assets/Logo.jpg" alt="" width="48" height="60">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto text-end">
              <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="kategori.html">UI Kit</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="premium.html">Premium</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="freebie.html">Freebie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="success_checkout.html">Checkout</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dokumentasi.html">Dokumentasi</a>
              </li>
              <li class="nav-item">
                <?php if( isset($_SESSION["login"]) ) : ?> <!-- if logged in, show username -->
                  <div class="dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Halo, <?= $_SESSION["loggeduser"] ?>
                    </a>

                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Dashboard</a></li>
                      <li><a class="dropdown-item" href="#">Transaksi</a></li>
                      <li><a class="dropdown-item text-danger" href="./auth/logout/index.php">Logout</a></li>
                    </ul>
                  </div>
                <?php else : ?> <!-- if not, show cta instead -->
                  <a href="./auth" class="nav-item">
                  <button class="btn" type="submit">Masuk</button>
                  </a>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Navbar End -->

    <!-- Hero -->
    <section class="hero mb-5">
      <div class="container col-xxl-12 mt-5 mb-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-lg-6 col-sm-1">
            <img src="./Assets/Group 3.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="480" height="480" loading="lazy">
          </div>
          <div class="col-lg-6">
            <p class="title">Halo, Designer</p>
            <h1 class="display-5 fw-bold lh-1 mb-3">Pilih. Unduh. Modifikasi. Mulai Project Dengan Cepat</h1>
            <p class="lead">Ajoor menyediakan pilihan aset desain terbaik siap pakai untuk kebutuhan project anda.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
              <button type="button" class="btn btn-primary btnhero me-md-2">Jelajahi Ajoor</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Hero End -->
    
    <!-- Keunggulan -->
    <section class="keunggulan mt-5 mb-5 p-5">
      <div class="container">
        <div class="text-center">
        <h2 class="fw-bold col-lg-6 col-sm-1 mx-auto mb-5">Percepat Pengerjaan Project
          Hanya Dengan 3 Langkah Mudah
        </h2>
      </div>
      <div class="row mt-5">
        <div class="col-lg-4 col-sm-1 text-center">
          <figure class="figure">
            <img src="./Assets/Group 7.png" class="figure-img img-fluid">
            <figcaption class="figure-caption text-center">
              <h5 class="mt-4 mb-2">1. Pilih</h5>
              <p>Pilih aset desain yang<br>
                akan digunakan.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-1 text-center">
        <figure class="figure">
          <img src="./Assets/Group 10.png" class="figure-img img-fluid">
            <figcaption class="figure-caption text-center">
              <h5 class="mt-4 mb-2">2. Unduh</h5>
              <p>Unduh aset pilihan<br>
                pada device.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-1 text-center">
        <figure class="figure">
          <img src="./Assets/Group 9.png" class="figure-img img-fluid">
          <figcaption class="figure-caption text-center">
            <h5 class="mt-4 mb-2">3. Gunakan/Modifikasi</h5>
            <p>Siap diaplikasikan pada<br>
              project atau dimodifikasi.</p>
          </figcaption>
        </figure>
        </div>
      </div>
      </div>
    </section>
    <!-- Keunggulan End -->

    <!-- Aset Pilihan -->
    <section class="produk mt-5 mb-5 p-5">
      <div class="container">
        <div class="text-start">
          <h2 class="fw-bold col-lg-6 col-sm-1 mx-start mb-5">
            Beberapa Aset Pilihan
          </h2>
        </div>
        <div class="row"> <!-- Contents Start Here -->
          <div class="col-lg-4 col-sm-1">
            <div class="card"> <!-- Content Item 1 Start-->
              <div class="cardhead">
              <img src="./Assets/telemedic.png" class="card-img-top" alt="...">
              <a href="" class="d-flex justify-content-center overlay">
                <img src="./Assets/download.png" class="align-self-center">
              </a>
              </div>
              <div class="card-body">
              <div class="row">
              <div class="col">
                <h5 class="card-title">Telemedic App</h5>
                <p class="card-text">UI Kit</p>
              </div>
              <div class="col text-end">
                <a href="#">
                  <button class="btn btn-primary freebie">FREEBIE</button>  
                </a>
              </div>
              </div>
            </div>
            </div> <!-- Content Item 1 End-->
          </div>
          <div class="col-lg-4 col-sm-1">
            <div class="card"> <!-- Content Item 2 Start-->
              <div class="cardhead">
              <img src="./Assets/healthico.png" class="card-img-top" alt="...">
              <a href="" class="d-flex justify-content-center overlay">
                <img src="./Assets/download.png" class="align-self-center">
              </a>
              </div>
              <div class="card-body">
              <div class="row">
              <div class="col">
                <h5 class="card-title">Health Icon</h5>
                <p class="card-text">Icon Set</p>
              </div>
              <div class="col text-end">
                <a href="#" class="btn btn-primary freebie">FREEBIE</a>
              </div>
              </div>
            </div>
            </div> <!-- Content Item 2 End-->
          </div>
          <div class="col-lg-4 col-sm-1">
            <div class="card"> <!-- Content Item 3 Start-->
              <div class="cardhead">
              <img src="./Assets/edutech.png" class="card-img-top" alt="...">
              <a href="" class="d-flex justify-content-center overlay">
                <img src="./Assets/download.png" class="align-self-center">
              </a>
              </div>
              <div class="card-body">
              <div class="row">
              <div class="col">
                <h5 class="card-title">Edutech App</h5>
                <p class="card-text">Template</p>
              </div>
              <div class="col text-end">
                <a href="#" class="btn btn-primary premium">PREMIUM</a>
              </div>
              </div>
            </div>
            </div> <!-- Content Item 3 End-->
          </div>
        </div> <!-- Contents End Here-->
      </div>
    </section>
    <!-- Aset Pilihan End -->

    <!-- Mengapa -->
    <section class="mengapa mt-5 mb-5 p-5">
      <div class="container">
        <div class="row mb-5">
          <div class="text-center">
            <h2 class="fw-bold col-lg-6 col-sm-1 mx-auto mb-5">Mengapa Pakai Aset Desain Dari Ajoor?
            </h2>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-lg-6 col-sm-1">
            <img src="./Assets/whyimage.png" class="img-fluid" alt="...">
          </div> 
            <div class="col-lg-5 col-sm-1 why">
              <div class="row mb-3">
                <h5 class="mt-4 mb-2">Up To Date</h5>
                <p>Ratusan aset desain terbaik yang siap digunakan pada project</p>
              </div>
              <div class="row mb-3">
                <h5 class="mt-4 mb-2">Well Organized</h5>
                <p>Sangat mudah dimodifikasi dan seluruh layer tersusun rapih sehingga mudah dimengerti</p>
              </div>
              <div class="row mb-3">
                <h5 class="mt-4 mb-2">Tersedia Bantuan</h5>
                <p>Gabung ke grup privat untuk konsultasi desain supaya project anda lebih aesthetic.</p>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- Mengapa End -->

    <!-- Data -->
    <section class="dataajoor mt-5 mb-5 p-5">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-3 stats">
            <div class="text-start">
              <h2 class="fw-bold">Statistik Ajoor</h2>
            </div>
          </div>
          <div class="col-lg-5 data">
            <div class="row">
              <div class="col col-lg-4 col-sm-1 border-end border-1 text-center">
                <h2 class="fw-bold">1500+</h2>
                <p>Download</p>
              </div>
              <div class="col col-lg-4 col-sm-1 border-end border-1 text-center">
                <h2 class="fw-bold">45+</h2>
                <p>Negara</p>
              </div>
              <div class="col col-lg-4 col-sm-1 text-center">
                <h2 class="fw-bold">500+</h2>
                <p>Aset</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Data End -->

    <!-- Footer -->
    <section class="footer mt-5 p-5">
      <div class="container border-top border-1">
        <div class="text-center mt-5 footertext">
          <p>©2021 Ajoor by Jordan.</p>
        </div>
      </div>
    </section>
    <!-- Footer End -->

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