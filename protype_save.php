<?php
    include("config.php");

    $pt_id=$_POST["pt_id"];
    $pt_name=$_POST["pt_name"];
    $pt_date=date("Y-m-d H:i:s");
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($pt_id>0){
            $sql="
                update tb_protype set
                    pt_name='".$pt_name."',
                    pt_date='".$pt_date."',
                    us_id='".$us_id."'
                    where pt_id='".$pt_id."'
            ";
        }else{
            $sql="
                insert into tb_protype set
                    pt_name='".$pt_name."',
                    pt_date='".$pt_date."',
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