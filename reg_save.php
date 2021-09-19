<?php
    include("config.php");
    $reg_total=disk_total_space("C:")/1024;
    $reg_free=$_POST["reg_free"];
    $reg_num=$_POST["reg_num"];
    $register_num=$reg_free+$reg_num;

    if($reg_total!=$register_num){
        echo "n";
        exit();
    }
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        $sql="
            insert into tb_reg set
            reg_free='".$reg_free."',
            reg_num='".$reg_num."'
        ";

        $conn->query($sql);
        $conn->commit();
        echo "<script>window.location='login.php';<script>";
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
    
?>