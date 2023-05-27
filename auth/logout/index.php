<?php
    // delete session
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    // redirect
    header("Location: ./../../index.php");
    exit;
?>