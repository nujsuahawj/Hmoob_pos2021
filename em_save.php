<?php
    include("config.php");

    $em_id=$_POST["em_id"];
    $em_name=$_POST["em_name"];
    $em_phone=$_POST["em_phone"];
    $is_leave=$_POST["is_leave"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($em_id>0){
            $sql="
                update tb_em set
                em_name='".$em_name."',
                em_phone='".$em_phone."',
                is_leave='".$is_leave."'
                where em_id='".$em_id."'
            ";
        }else{
            $sql="
                insert into tb_em set
                em_name='".$em_name."',
                em_phone='".$em_phone."',
                is_leave='".$is_leave."'
            ";
        }
    
        $conn->query($sql);
        $conn->commit();
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>