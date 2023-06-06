<?php
    session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: ./../../../../../auth");
    }

    require_once __DIR__ . "./../../../../php/conn/index.php";
    require_once __DIR__ . "./../../../../php/func/index.php";

    // get transaksi id and produk id
    $transaksi_id = intval($_GET["transaksi_id"]);
    $produk_id = intval($_GET["produk_id"]);

    // prepare query and get file from db
    $query = "SELECT produk.file_produk FROM produk JOIN transaksi ON produk.produk_id = $produk_id WHERE transaksi.transaksi_id = $transaksi_id";
    $result = queryRead($query);

    // get filename
    $filepath = __DIR__ . "./../../../../public/file/{$result['file_produk']}";

    // download
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize("./../../../../public/file/{$result['file_produk']}"));
        readfile("./../../../../public/file/{$result['file_produk']}");
    }

?>