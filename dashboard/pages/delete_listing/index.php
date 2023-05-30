<?php
    require_once __DIR__ . "./../../../php/conn/index.php";
    require_once __DIR__ . "./../../../php/func/index.php";

    // get the produk id from dashboard
    $produk_id = $_GET['produk_id'];
    
    if(deleteListingProduk($produk_id) > 0) {
        echo 
        '<script> 
        alert("Sukses menghapus listing")
        document.location.href = "./../../index.php"
        </script>
        ';
    } else {
        echo 
        '<script> 
        alert("Sukses menghapus listing")
        document.location.href = "./../../index.php"
        </script>
        ';
    }
?>