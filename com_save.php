<?php
    include("config.php");

    $com_id=$_POST["com_id"];
    $com_name=$_POST["com_name"];
    $com_phone=$_POST["com_phone"];
    $com_address=$_POST["com_address"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        $sql="
            update tb_com set
            com_name='".$com_name."',
            com_phone='".$com_phone."',
            com_address='".$com_address."'
            where com_id='".$com_id."'
        ";
    
        $conn->query($sql);
        $conn->commit();
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>