<?php
    include("config.php");
    $my_year=date("Y");
    $mydata=$_POST["mydata"];
    $recieve_type=$_POST["recieve_type"];

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
                qty='".str_replace(",","",$mydata[$i]["qty"])."',
                sale_price='".str_replace(",","",$mydata[$i]["sale_price"])."',
                buy_price='".$buy_price."'
            ";

            $conn->query($sql);

            $sql="
                select qty 
                    from tb_pro_in_stock 
                    where st_id=1 
                    and pro_id='".$mydata[$i]["pro_id"]."'
            ";
            
            $qry=$conn->query($sql);
            $old_qty=0;

            if(mysqli_num_rows($qry)>0){
                $rs=mysqli_fetch_object($qry);
                $old_qty=$rs->qty;
                $new_qty=$old_qty-$mydata[$i]["qty"];

                $sql="
                    update tb_pro_in_stock set
                    qty='".$new_qty."'
                    where st_id=1
                    and pro_id='".$mydata[$i]["pro_id"]."'
                ";

                $conn->query($sql);
            }
        };

        $sale_date=date("Y-m-d H:i:s");
        $cus_id=1;
        $price_type="front";
        $total=str_replace(",","",$_POST["t1"]);
        $sale_note="-";
        $us_id=$_SESSION["us_id"];
        // $paid_status="";
        // $price_type="front";
        // $time=date("H:i:s");
        $net=$total;

        $sql="
            insert into tb_sale set
                sale_date='".$sale_date."',
                sale_code='".$sale_code."',
                cus_id='".$cus_id."',
                price_type='".$price_type."',
                total='".str_replace(",","",$total)."',
                total_dc=0,
                sale_note='".$sale_note."',
                us_id='".$us_id."',
                sale_type='front',
                is_paid='y',
                st_id=1
        ";

        $conn->query($sql);
        $sale_id=mysqli_insert_id($conn);

        $sql="
            insert into tb_recieve_money set
            re_date='".$sale_date."',
            sale_id='".$sale_id."',
            t1='".$net."',
            t2='".$net."',
            recieve_type='".$recieve_type."',
            us_id='".$us_id."'
        ";

        $conn->query($sql);
        $conn->commit();
        echo json_encode($sale_code);
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }

?>