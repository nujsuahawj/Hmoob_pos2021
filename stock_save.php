<?php
    include("config.php");

    $st_id=$_POST["st_id"];
    $st_name=$_POST["st_name"];
    $st_date=date("Y-m-d H:i:s");
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($st_id>0){
            $sql="
                update tb_stock set
                    st_name='".$st_name."',
                    st_date='".$st_date."',
                    us_id='".$us_id."'
                    where st_id='".$st_id."'
            ";
        }else{
            $sql="
                insert into tb_stock set
                    st_name='".$st_name."',
                    st_date='".$st_date."',
                    st_can_edit='y',
                    us_id='".$us_id."'
            ";
        }
    
        $conn->query($sql);
        $conn->commit();
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>