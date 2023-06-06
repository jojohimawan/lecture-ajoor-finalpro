<?php
    session_start();

    require_once __DIR__ . "./../../php/conn/index.php";
    require_once __DIR__ . "./../../php/func/index.php";


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
    <link rel="icon"  href="./../../assets/favicon.jpg" />
    <link rel="stylesheet" href="./../../css/style.css">
    <title>Dokumentasi</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="#">
              <img src="./../../assets/Logo.jpg" alt="" width="48" height="60">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto text-end">
              <li class="nav-item">
                <a class="nav-link" href="./../../">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./../browse">Jelajah</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Dokumentasi</a>
              </li>
              <li class="nav-item">
                <?php if( isset($_SESSION["login"]) ) : ?> <!-- if logged in, show username -->
                  <div class="dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Halo, <?= $_SESSION["loggeduser"] ?>
                    </a>

                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./../../dashboard">Dashboard</a></li>
                      <li><a class="dropdown-item" href="./../../dashboard/pages/transaksi">Transaksi</a></li>
                      <li><a class="dropdown-item text-danger" href="./../../auth/logout">Logout</a></li>
                    </ul>
                  </div>
                <?php else : ?> <!-- if not, show cta instead -->
                  <a href="./../../auth" class="nav-item">
                  <button class="btn" type="submit">Masuk</button>
                  </a>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Navbar End -->

     <!-- Header -->
        <section class="uikit-header mt-5 mb-5 p-5">
            <div class="container">
                <div class="text-center">
                     <h1 class="display-5 fw-bold lh-1 mb-3">Pelajari Dokumentasi Ajoor</h1>
                    <p class="lead">Membantu kamu untuk mempelajari knowledge base Ajoor<br>
                        supaya maksimal dalam menggunakan produk Ajoor</p>
                </div>
            </div>
        </section>    
    <!-- Header End -->

    <!-- Docs -->
        <section class="docs p-5">
            <div class="container">
                <div class="row justify-content-between mb-5">
                    <div class="col-lg-5 col-sm-1">
                        <h2 class="fw-bold mb-3 freebie-card-title">Boleh digunakan untuk<br>
                            projek apa saja?</h2>
                        <h5 class="freebie-card-docs">Semua tipe produk Ajoor bisa digunakan<br>untuk semua projek baik komersil ataupun<br>
                            non komersil tanpa harus<br>
                            menyertakan atribusi.</h5>
                    </div>
                    <div class="col-lg-5 col-sm-1">
                        <h2 class="fw-bold mb-3 freebie-card-title">Apakah Boleh Diperjual<br>Belikan Kembali?</h2>
                        <h5 class="freebie-card-docs">Diperbolehkan untuk menjual belikan<br> kembali produk dari Ajoor dengan syarat<br> harus dimodifikasi minimal 50% dari<br> desain original.</h5>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-5 col-sm-1">
                        <h2 class="fw-bold mb-3 freebie-card-title">Bagaimana Cara Berterima<br>
                            Kasih?</h2>
                        <h5 class="freebie-card-docs">Dengan membeli dan menggunakan<br> produk Ajoor secara semestinya. Serta<br>tidak melakukan pembajakan :)</h5>
                    </div>
                    <div class="col-lg-5 col-sm-1">
                        <h2 class="fw-bold mb-3 freebie-card-title">Apakah Ada Rencana Untuk<br>Kedepannya?</h2>
                        <h5 class="freebie-card-docs">Ajoor akan menambahkan lebih banyak produk untuk designer, developer, maupun business owner. Kami juga akan terus mengimprove fitur supaya nyaman digunakan oleh pengguna kami.</h5>
                    </div>
                </div>
            </div>
        </section>
    <!-- Docs End -->

     <!-- Header -->
         <section class="uikit-header mt-5 mb-5 p-5">
            <div class="container">
                <div class="text-center">
                     <h1 class="display-5 fw-bold lh-1 mb-3">Pricelist Ajoor</h1>
                    <p class="lead">Detail Tipe Produk dan Range Harga Produk Ajoor</p>
                </div>
            </div>
        </section>    
    <!-- Header End -->

    <!-- Pricing Card -->
        <section class="pricingcard p-5">
          <div class="container">
            <div class="row justify-content-around">
              <div class="col-lg-4 sol-sm-1">
                <div class="card pricing-card p-3">
                  <div class="card-body">
                    <button class="btn btn-primary freebie mb-5">FREEBIE</button>
                    <h5 class="mb-1">Mulai dari</h5>
                    <h1 class="mb-4 fw-bold">IDR 0,-</h1>
                    <h5 class="mb-1">Benefit</h5>
                    <ul class="list-group freebie-benefit-list">
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Project Master</p></li>
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Quick Start Guide</p></li>
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Ready to Use</p></li>
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square Disabled.png" alt=""><p class="ms-2 fw-normal freebie-benefit-list-disabled">Grid System Design</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square Disabled.png" alt=""><p class="ms-2 fw-normal freebie-benefit-list-disabled">Private Group (Design Consulting)</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square Disabled.png" alt=""><p class="ms-2 fw-normal freebie-benefit-list-disabled">Free Design Updates</p></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 sol-sm-1">
                <div class="card pricing-card pricing-premium p-3">
                  <div class="card-body">
                    <button class="btn btn-primary premium mb-5">PREMIUM</button>
                    <h5 class="mb-1">Mulai dari</h5>
                    <h1 class="mb-4 fw-bold">IDR 10K,-</h1>
                    <h5 class="mb-1">Benefit</h5>
                    <ul class="list-group freebie-benefit-list">
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Project Master</p></li>
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Quick Start Guide</p></li>
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Ready to Use</p></li>
                      <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Grid System Design</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Private Group (Design Consulting)</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 fw-normal">Free Design Updates</p></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    <!-- Pricing Card End -->

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