<?php
    include("config.php");

    $sup_id=$_POST["sup_id"];
    $sup_name=$_POST["sup_name"];
    $sup_phone=$_POST["sup_phone"];
    $sup_contact_name=$_POST["sup_contact_name"];
    $sup_address=$_POST["sup_address"];
    $sup_date=date("Y-m-d H:i:s");
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($sup_id>0){
            $sql="
                update tb_sup set
                    sup_name='".$sup_name."',
                    sup_phone='".$sup_phone."',
                    sup_contact_name='".$sup_contact_name."',
                    sup_address='".$sup_address."',
                    sup_date='".$sup_date."',
                    us_id='".$us_id."'
                    where sup_id='".$sup_id."'
            ";
        }else{
            $sql="
                insert into tb_sup set
                    sup_name='".$sup_name."',
                    sup_phone='".$sup_phone."',
                    sup_contact_name='".$sup_contact_name."',
                    sup_address='".$sup_address."',
                    sup_date='".$sup_date."',
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