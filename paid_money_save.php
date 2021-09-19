<?php
    include("config.php");

    // SELECT `paid_id`, ``, ``, ``, `t2`, `` FROM `` WHERE 1

    $buy_id=$_POST["buy_id"];
    $paid_date=date("Y-m-d H:i:s");
    $t1=str_replace(",","",$_POST["t1"]);
    $t2=str_replace(",","",$_POST["t2"]);
    $t3=$_POST["t3"];
    $buy_code=$_POST["buy_code"];
    $paid_type=$_POST["paid_type"];
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        $sql="
            insert into tb_paid_money set
            buy_id='".$buy_id."',
            paid_date='".$paid_date."',
            t1='".$t1."',
            t2='".$t2."',
            paid_type='".$paid_type."',
            us_id='".$us_id."'
        ";

        $conn->query($sql);

        if($t3<1){
            $sql="
                update tb_buy set
                    is_paid='y'
                where buy_id='".$buy_id."'
            ";

            $conn->query($sql);
        }
    
        $conn->commit();
        echo json_encode($buy_code);
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>