<?php
    include("config.php");
    
    $pro_id=$_POST["pro_id"];
    $pro_code=trim($_POST["pro_code"]);
    $pro_name=trim($_POST["pro_name"]);
    $pro_name_2=trim($_POST["pro_name_2"]);
    $pro_detail=trim($_POST["pro_detail"]);
    $pt_id=$_POST["pt_id"];
    $un_id=$_POST["un_id"];
    $pro_buy_price=str_replace(",","",$_POST["pro_buy_price"]);
    $pro_sale_price=str_replace(",","",$_POST["pro_sale_price"]);
    $pro_sale_price_2=str_replace(",","",$_POST["pro_sale_price_2"]);
    $pro_sale_price_vip=str_replace(",","",$_POST["pro_sale_price_vip"]);
    $pro_low_to_order=str_replace(",","",$_POST["pro_low_to_order"]);
    $pro_is_cancel=$_POST["pro_is_cancel"];
    $pro_date=date("Y-m-d H:i:s");
    $us_id=$_SESSION["us_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();

    try{
        if($pro_id>0){
            $sql="
                update tb_pro set
                    pro_code='".$pro_code."',
                    pro_name='".$pro_name."',
                    pro_name_2='".$pro_name_2."',
                    pro_detail='".$pro_detail."',
                    pt_id='".$pt_id."',
                    un_id='".$un_id."',
                    pro_buy_price='".$pro_buy_price."',
                    pro_sale_price='".$pro_sale_price."',
                    pro_sale_price_2='".$pro_sale_price_2."',
                    pro_sale_price_vip='".$pro_sale_price_vip."',
                    pro_low_to_order='".$pro_low_to_order."',
                    pro_is_cancel='".$pro_is_cancel."',
                    pro_date='".$pro_date."',
                    us_id='".$us_id."'
                    where pro_id='".$pro_id."'
            ";
        }else{
            $sql="
                insert into tb_pro set
                    pro_code='".$pro_code."',
                    pro_name='".$pro_name."',
                    pro_name_2='".$pro_name_2."',
                    pro_detail='".$pro_detail."',
                    pt_id='".$pt_id."',
                    un_id='".$un_id."',
                    pro_buy_price='".$pro_buy_price."',
                    pro_sale_price='".$pro_sale_price."',
                    pro_sale_price_2='".$pro_sale_price_2."',
                    pro_sale_price_vip='".$pro_sale_price_vip."',
                    pro_low_to_order='".$pro_low_to_order."',
                    pro_is_cancel='".$pro_is_cancel."',
                    pro_date='".$pro_date."',
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