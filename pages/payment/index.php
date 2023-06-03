<?php
  session_start();
  if( !isset($_SESSION["login"]) ) {
    header("Location:./../../auth");
  }

  require_once __DIR__ . "./../../php/conn/index.php";
  require_once __DIR__ . "./../../php/func/index.php";

  // get produk id from url
  $id = intval($_GET['id']);
  

  // prepare essential data
  $product = queryRead("SELECT produk.*, kategori.nama AS kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.kategori_id WHERE produk_id = $id");
  $product['gratis'] = $product['gratis'] === 't' ? 'freebie' : 'premium';

  // execute query
  if( isset($_POST["checkout"]) ) {
    if(queryCreateTransaksiPremium($_POST) > 0) {
        echo 
                '<script> 
                alert("Sukses checkout")
                document.location.href = "./../success_checkout.html"
                </script>
        ';
    } else {
        echo 
                '<script> 
                alert("Gagal checkout")
                document.location.href = "./../success_checkout.html"
                </script>
        ';
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
                <a class="nav-link" href="home.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="./../browse">Jelajah</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Premium</a>
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
                      <li><a class="dropdown-item" href="./dashboard">Dashboard</a></li>
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

    <!-- Header -->
    <section class="uikit-header mt-5 mb-5 p-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-5 fw-bold lh-1 mb-3">Checkout</h1>
                <p class="lead">Konfirmasi Transaksi Anda</p>
            </div>
        </div>
    </section>  
    <!-- Header -->

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
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-5">
                                <?php if($product['gratis'] === 'premium') : ?>
                                <label for="foto" class="form-label">Upload Pembayaran</label>
                                <input type="file" name="foto" placeholder="Bukti dalam bentuk foto" class="form-control" id="foto">
                                <?php else : ?>
                                <label for="foto" class="form-label">Upload Pembayaran</label>
                                <input type="hidden" name="foto" value="" placeholder="Bukti dalam bentuk foto" class="form-control" id="foto">
                                <?php endif; ?>
                            </div>
                            <div class="mb-5">
                                <input type="hidden" name="produkid" value="<?= $id ?>" class="form-control" id="produkid">
                            </div>
                            <div class="mb-5">
                                <input type="hidden" name="userid" value="<?= $_SESSION["user_id"] ?>" class="form-control" id="userid">
                            </div>
                            <div class="mb-5">
                                <input type="hidden" name="harga" value=" <?= $product['harga'] ?>" class="form-control" id="harga">
                            </div>
                            <div class="d-grid mb-5">
                                <button type="submit" name="checkout" class="btn btn-success freebie-card-dl-btn w-full">CHECKOUT</button>
                            </div>
                          </form>
                          <a href="dokumentasi.html" class="freebie-card-docs text-center">
                              <h5 class="">Pelajari Lisensi Produk</h5>
                          </a>
                        </div>
                      </div>
                </div> <!-- Product Detail Card -->
            </div>
    </section>
    <!-- Product Detail End -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
