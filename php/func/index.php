<?php

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
        $check = pg_query($conn, "SELECT username FROM users WHERE username'$username'");
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
                    document.location.href = "./../../dashbord/pages/add_listing"
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
                    document.location.href = "../index.php"
                    </script>
                ';
            return false;
        }

        // check for filesize (max is 2mb)
        if( $ukuran_berkas > 2000000 ) {
            echo 
                    '<script> 
                    alert("gambar terlalu besar")
                    document.location.href = "./../../dashbord/pages/add_listing"
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
                    document.location.href = "./../../dashboard/pages/add_listing"
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
                    document.location.href = "./../../dashboard/pages/add_listing"
                    </script>
                ';
            return false;
        }

        // check for filesize (max is 10mb)
        if( $ukuran_berkas > 10000000 ) {
            echo 
                    '<script> 
                    alert("file terlalu besar")
                    document.location.href = "./../../dashboard/pages/add_listing"
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
?>
