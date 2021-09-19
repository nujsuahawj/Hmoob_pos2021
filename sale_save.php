<?php
    include("config.php");
    $my_year=date("Y");
    $mydata=$_POST["mydata"];
    $st_id=$_POST["st_id"];

    $sql="
        select
            sale_code
        from tb_sale
            order by sale_id desc limit 1
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        $pro_last=$rs->sale_code;
        $pro_first=$rs->sale_code;

        $pro_last=substr($pro_last,4,6);
        $pro_first=substr($pro_first,0,4);

        if($pro_first!=$my_year){
            $sale_code=date("Y")."000001";
        }else{
            $pro_last++;
            $sale_code=$pro_first.sprintf("%06d",$pro_last);
        }
    }else{
        $sale_code=date("Y")."000001";
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();

    try{
        for($i=0;$i<count($mydata);$i++){
            $qty_sale=str_replace(",","",$mydata[$i]["qty"]);

            $sql="
                select pro_buy_price
                from tb_pro
                where pro_id='".$mydata[$i]["pro_id"]."'
            ";

            $qry_buy_price=$conn->query($sql);
            $buy_price=0;

            if(mysqli_num_rows($qry_buy_price)>0){
                $rs=mysqli_fetch_object($qry_buy_price);
                $buy_price=$rs->pro_buy_price;
            }

            $sql="
                insert into tb_sale_detail set
                sale_code='".$sale_code."',
                pro_id='".$mydata[$i]["pro_id"]."',
                qty='".$qty_sale."',
                sale_price='".str_replace(",","",$mydata[$i]["sale_price"])."',
                buy_price='".$buy_price."'
            ";

            $conn->query($sql);

            $sql="
                select qty 
                    from tb_pro_in_stock 
                    where st_id='".$st_id."' 
                    and pro_id='".$mydata[$i]["pro_id"]."'
            ";
            
            $qry=$conn->query($sql);
            $old_qty=0;

            if(mysqli_num_rows($qry)>0){
                $rs=mysqli_fetch_object($qry);
                $old_qty=$rs->qty;
                $new_qty=$old_qty-$qty_sale;

                $sql="
                    update tb_pro_in_stock set
                    qty='".$new_qty."'
                    where st_id='".$st_id."'
                    and pro_id='".$mydata[$i]["pro_id"]."'
                ";

                $conn->query($sql);
            }
        };

        $sale_date=date("Y-m-d H;i:s");
        $cus_id=$_POST["cus_id"];
        $price_type=$_POST["price_type"];
        $total=str_replace(",","",$_POST["total"]);
        $total_dc=str_replace(",","",$_POST["total_dc"]);
        $sale_note=$_POST["sale_note"];
        $us_id=$_SESSION["us_id"];
        $paid_status=$_POST["paid_status"];
        $price_type=$_POST["price_type"];
        $time=date("H:i:s");
        $net=$total-$total_dc;

        $sql="
            insert into tb_sale set
                sale_date='".$sale_date."',
                sale_code='".$sale_code."',
                cus_id='".$cus_id."',
                price_type='".$price_type."',
                total='".str_replace(",","",$total)."',
                total_dc='".str_replace(",","",$total_dc)."',
                sale_note='".$sale_note."',
                us_id='".$us_id."',
                sale_type='back',
                st_id='".$st_id."',
        ";

        if($paid_status=="n"){
            $sql.=" is_paid='n'";
        }else{
            $sql.=" is_paid='y'";
        }

        $conn->query($sql);
        $sale_id=mysqli_insert_id($conn);

        if($paid_status!="n"){
            $sql="
                insert into tb_recieve_money set
                re_date='".$sale_date."',
                sale_id='".$sale_id."',
                t1='".$net."',
                t2='".$net."',
                recieve_type='".$paid_status."',
                us_id='".$us_id."'
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