<?php
    include("config.php");

    $un_id=$_POST["un_id"];
    $un_name=$_POST["un_name"];
    $un_qty=str_replace(",","",$_POST["un_qty"]);
    $un_date=date("Y-m-d H:i:s");
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        if($un_id>0){
            $sql="
                update tb_unit set
                    un_name='".$un_name."',
                    un_qty='".$un_qty."',
                    un_date='".$un_date."',
                    us_id='".$us_id."'
                    where un_id='".$un_id."'
            ";
        }else{
            $sql="
                insert into tb_unit set
                    un_name='".$un_name."',
                    un_qty='".$un_qty."',
                    un_date='".$un_date."',
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