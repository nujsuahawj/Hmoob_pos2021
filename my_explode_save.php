<?php
    include("config.php");

    $pro_id=$_POST["pro_id"];
    $pro_id_2=$_POST["pro_id_2"];
    $st_id=$_POST["st_id"];
    $qty=$_POST["qty"];
    $qty_2=$_POST["qty_2"];
    $qty_4=$_POST["qty_4"];
    $qty_3=0;
    $qty_in_stock_2=$_POST["qty_in_stock_2"];

    $qty=$qty-$qty_2;
    $qty_3=$qty_in_stock_2+($qty_2*$qty_4);

    $my_pro=array($pro_id,$pro_id_2);
    $my_qty=array($qty,$qty_3);

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        for($i=0;$i<count($my_pro);$i++){
            $sql="
                update tb_pro_in_stock set
                qty='".$my_qty[$i]."'
                where st_id='".$st_id."'
                and pro_id='".$my_pro[$i]."'
            ";
        
            $conn->query($sql);
        };
        
        $conn->commit();
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>