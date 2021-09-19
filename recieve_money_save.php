<?php
    include("config.php");

    $re_date=date("Y-m-d H:i:s");
    $sale_id=$_POST["sale_id"];
    $sale_code=$_POST["sale_code"];
    $recieve_type=$_POST["recieve_type"];
    $t2=str_replace(",","",$_POST["t2"]);
    $t1=str_replace(",","",$_POST["t1"]);
    $us_id=$_SESSION["us_id"];
    $t3=$_POST["t3"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        $sql="
            insert into tb_recieve_money set
            re_date='".$re_date."',
            sale_id='".$sale_id."',
            t1='".$t1."',
            t2='".$t2."',
            recieve_type='".$recieve_type."',
            us_id='".$us_id."'
        ";

        $conn->query($sql);

        if($t3<1){
            $sql="
                update tb_sale set
                    is_paid='y'
                where sale_id='".$sale_id."'
            ";

            $conn->query($sql);
        }
    
        $conn->commit();
        echo json_encode($sale_code);
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>