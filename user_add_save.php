<?php
    include("config.php");

    $us_id=$_POST["us_id"];
    $us_name=$_POST["us_name"];
    $is_cancel=$_POST["is_cancel"];
    $us_pass=base64_encode($_POST["us_pass"]);

    if($is_cancel==""){
        $is_cancel="n";
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($us_id>0){
            $sql="
                update tb_user set
                    us_pass='".$us_pass."',
                    is_cancel='".$is_cancel."'
                where us_id='".$us_id."'
            ";
        }else{
            $sql="
                insert into tb_user set
                    us_type='em',
                    us_name='".$us_name."',
                    us_pass='".$us_pass."',
                    is_cancel='n'
            ";
        }
    
        $conn->query($sql);
        $conn->commit();
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>