<?php

    require_once __DIR__ . "./../conn/index.php";

    function userRegister($data)
    {
        // catch db connection
        global $conn; 

        // store data from parameter
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



?>
