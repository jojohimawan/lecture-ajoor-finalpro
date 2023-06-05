<?php
    session_start();

    require_once __DIR__ . "./../../../../php/conn/index.php";
    require_once __DIR__ . "./../../../../php/func/index.php";

    // get transaksi id
    $transaksi_id = intval($_GET["transaksi_id"]);

    // approve transaksi
    if(queryApproveTransaksi($transaksi_id) > 0) {
        echo 
        '<script> 
        alert("Sukses menyetujui transaksi")
        document.location.href = "./../"
        </script>
        ';
    } else {
        echo 
        '<script> 
        alert("Gagal menyetujui transaksi")
        document.location.href = "./../"
        </script>
        ';
    }

?>