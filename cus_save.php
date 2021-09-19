<?php
    include("config.php");

    $cus_id=$_POST["cus_id"];
    $cus_name=$_POST["cus_name"];
    $cus_phone=$_POST["cus_phone"];
    $cus_contact_name=$_POST["cus_contact_name"];
    $cus_address=$_POST["cus_address"];
    $cus_date=date("Y-m-d H:i:s");
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($cus_id>0){
            $sql="
                update tb_cus set
                    cus_name='".$cus_name."',
                    cus_phone='".$cus_phone."',
                    cus_contact_name='".$cus_contact_name."',
                    cus_address='".$cus_address."',
                    cus_date='".$cus_date."',
                    us_id='".$us_id."'
                    where cus_id='".$cus_id."'
            ";
        }else{
            $sql="
                insert into tb_cus set
                    cus_name='".$cus_name."',
                    cus_phone='".$cus_phone."',
                    cus_contact_name='".$cus_contact_name."',
                    cus_address='".$cus_address."',
                    cus_date='".$cus_date."',
                    can_edit='y',
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