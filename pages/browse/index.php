<?php
  session_start();

  require_once __DIR__ . "./../../php/conn/index.php";
  require_once __DIR__ . "./../../php/func/index.php";

  $products = queryReadListingProduk("SELECT produk.*, kategori.nama AS kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.kategori_id");
  
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
    <title>UI Kit</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="home.html">
              <img src="./../../assets/Logo.jpg" alt="" width="48" height="60">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto text-end">
              <li class="nav-item">
                <a class="nav-link" href="./../../index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Jelajah</a>
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
                </a>
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
                <h1 class="display-5 fw-bold lh-1 mb-3">Jelajahi Asset Design</h1>
                <p class="lead">Pilihan assets untuk percepat project terbaik anda</p>
            </div>
        </div>
    </section>    
    <!-- Header End -->

    <!-- Products -->
    <section class="uikit-products mb-5 p-5">
      
        <div class="container">
        <!-- <div class="row"> -->
          <div class="row"> <!-- Content Row 1 Start Here -->
          <?php foreach($products as $prod) : ?>
            <div class="col-lg-4 col-sm-1">
              <div class="card"> <!-- Content Item 1 Start-->
                <div class="cardhead">
                <img src="./../../public/img/<?= $prod["foto"] ?>" class="card-img-top" alt="...">
                <a href="./../detail/index.php?id=<?= $prod['produk_id'] ?>" class="d-flex justify-content-center overlay"> <!-- TODO -->
                  <img src="./../../assets/download.png" class="align-self-center">
                </a>
                </div>
                <div class="card-body">
                <div class="row">
                <div class="col">
                  <h5 class="card-title"><?= $prod["nama"] ?></h5>
                  <p class="card-text"><?= $prod["kategori"] ?></p>
                </div>
                <div class="col text-end">
                  <a href=#>
                  <button class="btn btn-primary <?= $prod["gratis"]?>"><?= $prod["gratis"] ?></button>  
                  </a>
                </div>
                </div>
              </div>
              </div> <!-- Content Item 1 End-->
            </div>
          <?php endforeach; ?>
        
    </section>
    <!-- Products End -->

    <!-- Pagination -->
    <div class="uikit-pagination">
      <div class="container">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link pageicon" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item active"><a class="page-link aktif" href="#">1</a></li>
            <li class="page-item"><a class="page-link nonaktif" href="#">2</a></li>
            <li class="page-item"><a class="page-link nonaktif" href="#">3</a></li>
            <li class="page-item"><a class="page-link nonaktif" href="#">4</a></li>
            <li class="page-item"><a class="page-link nonaktif" href="#">5</a></li>
            <li class="page-item">
              <a class="page-link pageicon" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Pagination End -->

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