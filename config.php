<?php
    error_reporting(0);
    session_start();
    
    $conn=new mysqli("localhost","root","","trading2021v1");
    $conn->query("set NAMES UTF8");
    date_default_timezone_set("Asia/Bangkok");

    // include("function.php");
    
    $purl="trading2021v1/";
    $url="http://".$_SERVER["HTTP_HOST"]."/".$purl;

    // $mode="";
    // if(isset($_GET["mode"]))$mode=$_GET["mode"];
?>
<style>
        body{
            font-family: Phetsarath OT;
        }
</style>