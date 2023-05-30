<?php
    // if( !isset($_SESSION["login"]) ) {
    //     header("Location: ./../auth");
    // }

    require_once __DIR__ . "./../conn/index.php";

    function userRegister($data)
    {
        // catch db connection and store data from parameter
        global $conn; 
        $username = strtolower(stripslashes($data["username"]));
        $passwd = pg_escape_string($conn, $data["password"]);

        // hash password
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);

        // check if uname is registered
        $check = pg_query($conn, "SELECT username FROM users WHERE username = '$username'");
        if( pg_fetch_assoc($check) ) {
            echo "<script>
                alert('Username sudah terdaftar');
            </script>";
            
            return false;
        }

        // prepare query
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$passwd')";
        // execute query
        $result = pg_query($conn, $query);

        // return value as flag whether the query succeed or not
        return pg_affected_rows($result);
    }

    function queryReadKategori()
    {
        // catch db connection and prepare query
        global $conn;
        $query = "SELECT * FROM kategori";

        // execute query and store the results in array
        $result = pg_query($conn, $query);
        $rows = [];
        while( $row = pg_fetch_assoc($result) ) {
            $row["kategori_id"] = intval($row["kategori_id"]); // convert the int column
            $rows[] = $row;
            
        }

        // return the array containing data
        return $rows;
    }

    function handleUploadGambar()
    {
        $nama_berkas = $_FILES['fotoproduk']['name'];
        $ukuran_berkas = $_FILES['fotoproduk']['size'];
        $error = $_FILES['fotoproduk']['error'];
        $tmpname = $_FILES['fotoproduk']['tmp_name'];

        // if error found
        if( $error === 4) {
            echo 
                    '<script> 
                    alert("Silahkan upload file gambar")
                    document.location.href = "./"
                    </script>
                ';
            return false;
        }

        // get extension
        $valid_extension = ['jpg', 'png', 'jpeg'];
        $berkas_extension = explode('.', $nama_berkas);
        $berkas_extension = strtolower(end($berkas_extension));

        // check for file extension
        if( !in_array($berkas_extension, $valid_extension) ) {
            echo 
                    '<script> 
                    alert("File harus berupa gambar")
                    document.location.href = "./"
                    </script>
                ';
            return false;
        }

        // check for filesize (max is 2mb)
        if( $ukuran_berkas > 2000000 ) {
            echo 
                    '<script> 
                    alert("gambar terlalu besar")
                    document.location.href = "./"
                    </script>
                ';
            return false;
        }

        // rename uploaded filename
        $nama_berkas_baru = uniqid();
        $nama_berkas_baru .= '.'; $nama_berkas_baru .= $berkas_extension; // append extension to renamed uploaded file

        // copy uploaded file to specified directory
        move_uploaded_file( $tmpname, __DIR__ . './../../public/img/' . $nama_berkas_baru );

        // return renamed file to uploaded in other function
        return $nama_berkas_baru;
    }

    function handleUploadFile()
    {
        $nama_berkas = $_FILES['fileproduk']['name'];
        $ukuran_berkas = $_FILES['fileproduk']['size'];
        $error = $_FILES['fileproduk']['error'];
        $tmpname = $_FILES['fileproduk']['tmp_name'];

        // if error found
        if( $error === 4) {
            echo 
                    '<script> 
                    alert("Silahkan upload file valid")
                    document.location.href = "./"
                    </script>
                ';
            return false;
        }

        // get extension
        $valid_extension = ['zip', 'rar'];
        $berkas_extension = explode('.', $nama_berkas);
        $berkas_extension = strtolower(end($berkas_extension));

        // check for file extension
        if( !in_array($berkas_extension, $valid_extension) ) {
            echo 
                    '<script> 
                    alert("File harus berupa gambar")
                    document.location.href = "./"
                    </script>
                ';
            return false;
        }

        // check for filesize (max is 10mb)
        if( $ukuran_berkas > 10000000 ) {
            echo 
                    '<script> 
                    alert("file terlalu besar")
                    document.location.href = "./
                    </script>
                ';
            return false;
        }

        // rename uploaded filename
        $nama_berkas_baru = uniqid();
        $nama_berkas_baru .= '.'; $nama_berkas_baru .= $berkas_extension; // append extension to renamed uploaded file

        // copy uploaded file to specified directory
        move_uploaded_file( $tmpname, __DIR__ . './../../public/file/' . $nama_berkas_baru );

        // return renamed file to uploaded in other function
        return $nama_berkas_baru;
    }

    function queryCreateProduk($data)
    {
        //catch db connection and store data from parameter
        global $conn;
        $kategori = $data["kategori"];
        $namaproduk = htmlspecialchars($data["produk"]);
        $gratis = $data["gratis"] === "t" ? "TRUE" : "FALSE";
        $fotoproduk = handleUploadGambar();
        $fileproduk = handleUploadFile();
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $harga = $data["harga"];
        $userid = $data["userid"];
        

        // check for files
        if( !$fotoproduk && !$fileproduk ) {
            return false;
        }

        // prepare query
        $query = "INSERT INTO produk (kategori_id, user_id, gratis, nama, foto, file_produk, deskripsi, harga) VALUES ($kategori, $userid, $gratis, '$namaproduk', '$fotoproduk', '$fileproduk', '$deskripsi', $harga)";
        // execute query
        $result = pg_query($conn, $query);

        // return value as flag whether the query succeed or not
        return pg_affected_rows($result);
    }

    function queryRead($query)
    {
        // catch db connection and execute query
        global $conn;
        $result = pg_fetch_assoc( pg_query($conn, $query) );

        // return the row fetched
        return $result;
    }

    function queryReadListingProduk()
    {
        // catch db connection and prepare query
        global $conn;
        $query = "SELECT produk.*, kategori.nama AS kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.kategori_id WHERE user_id = '{$_SESSION["user_id"]}'"; // joining produk and kategori to get kategori name inside produk table

        // execute query and store the results in array
        $result = pg_query($conn, $query);
        $rows = [];
        while( $row = pg_fetch_assoc($result) ) {
            $row['gratis'] = $row['gratis'] === 'true' ? 'freebie' : 'premium'; // convert product type
            $rows[] = $row;
            
        }

        // return the array containing data
        return $rows;
    }

    // TODO: HANDLE UPDATE LISTING
    function queryUpdateListingProduk($data)
    {
        // catch db connection and prepare data
        global $conn;
        $files = pg_fetch_assoc(pg_query($conn, "SELECT * FROM produk WHERE produk_id = '{$data["userid"]}'"));
    }

    function deleteListingProduk($id)
    {
        // catch db connection
        global $conn;

        // delete corresponding files from local directory
        $row = pg_fetch_assoc(pg_query($conn, "SELECT * FROM produk WHERE produk_id = $id"));
        unlink( __DIR__ . './../../public/img/' . $row['foto'] );
        unlink( __DIR__ . './../../public/file/' . $row['file_produk'] );

        // execute delete query
        $result = pg_query($conn, "DELETE FROM produk WHERE produk_id = $id");

        // return value as flag whether the query succeed or not
        return pg_affected_rows($result);
    }

    function getRowCount($query)
    {
        // catch db connection and execute
        global $conn;
        $rowcount = pg_num_rows( pg_query($conn, $query) );

        // return the field count
        return $rowcount;
    }

    
?>
