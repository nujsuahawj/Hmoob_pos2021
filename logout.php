<?php
    include("config.php");
    session_start();
    session_destroy();
    header("location:http://localhost/trading2021v1");
?>