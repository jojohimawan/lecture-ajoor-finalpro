<?php
  session_start();

  require_once __DIR__ . "./../../php/conn/index.php";
  require_once __DIR__ . "./../../php/func/index.php";

  // get produk id from url
  $id = $_GET['id'];

  // prepare essential data
  $product = queryRead("SELECT produk.*, kategori.nama AS kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.kategori_id WHERE produk_id = $id");
  $product['gratis'] = $product['gratis'] === 't' ? 'freebie' : 'premium';
  $benefit = $product['gratis'] == 'freebie' ? 'freebie-benefit-list-disabled' : '';
  
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
    <title><?= $product['nama'] ?></title>
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
                <a class="nav-link active" href="./../browse">Jelajah</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./../doc">Dokumentasi</a>
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

    <!-- Breadcrumb -->
    <section class="<?= $product['gratis'] ?>-detail-bk mt-3 mb-5 p-4">
          <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item h5 bk-freebie"><a href="#">Home</a></li>
                  <li class="breadcrumb-item h5 bk-freebie"><a href="#"><?= $product['kategori'] ?></a></li>
                  <li class="breadcrumb-item h5 active bk-freebie-aktif" aria-current="page"><?= $product['nama'] ?></li>
                </ol>
              </nav>
          </div>
    </section>
    <!-- Breadcrumb End -->

    <!-- Product Detail -->
    <section class="<?= $product['gratis'] ?>-product mt-5 mb-5 p-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6"> <!-- img-->
                    <div class="row mb-4">
                        <img src="./../../public/img/<?= $product['foto'] ?>" class="img-fluid" alt="...">
                    </div>
                    <div class="row lead">
                      <?= $product['deskripsi'] ?>
                    </div>
                </div> <!-- img-->
                <div class="col-lg-5"> <!-- Product Detail Card -->
                    <div class="card <?= $product['gratis'] ?>-card p-3 freebie-benefit">
                        <div class="card-body">
                          <button class="btn btn-primary <?= $product['gratis'] ?> mb-5"><?= $product['gratis'] ?></button>
                          <h2 class="fw-bold mb-2 <?= $product['gratis'] ?>-card-title"><?= $product['nama'] ?></h2>
                          <h2 class="mb-5 <?= $product['gratis'] ?>-card-subtitle"><?= $product['kategori'] ?></h2>
                          <h2 class="mb-5 fw-bold <?= $product['gratis'] ?>-card-price">IDR <?= $product['harga'] ?></h2>
                          <a href="./../payment/index.php?id=<?= $product['produk_id'] ?>" class="card-link d-grid mb-5">
                              <button class="btn btn-success freebie-card-dl-btn">BELI</button>
                          </a>
                          <a href="dokumentasi.html" class="freebie-card-docs text-center">
                              <h5 class="">Pelajari Lisensi Produk</h5>
                          </a>
                        </div>
                      </div>
                </div> <!-- Product Detail Card -->
            </div>
    </section>
    <!-- Product Detail End -->

    <!-- Benefit -->
    <section class="freebie-benefit mt-5 p-5">
        <div class="container">
            <div class="row mb-3">
                <h5 class="fw-bold mx-start freebie-benefit-title">Benefit Aset <?= $product['gratis'] ?></h5>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-1">
                  <ul class="list-group freebie-benefit-list">
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2">Project Master</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2">Quick Start Guide</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2">Ready to Use</p></li>
                  </ul>
                </div>
                <div class="col-lg-6 col-sm-1">
                  <ul class="list-group freebie-benefit-list">
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 <?= $benefit ?>">Grid System Design</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 <?= $benefit ?>">Private Group (Design Consulting)</p></li>
                    <li class="list-group-item ps-0"><img src="./../../assets/Tick Square.png" alt=""><p class="ms-2 <?= $benefit ?>">Free Design Updates</p></li>
                  </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Benefit End -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
