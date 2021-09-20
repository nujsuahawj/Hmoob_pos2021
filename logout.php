<?php
    include("config.php");
    session_start();
    session_destroy();
    header("location:http://localhost/Hmoob_pos2021");
?>