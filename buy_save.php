<?php
    include("config.php");
    $n_year=date("Y");
    $my_year=date("Y");
    $time=date("H:i:s");

    $sql="
        select
            buy_code
        from tb_buy
            order by buy_id desc limit 1
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        $pro_last=$rs->buy_code;
        $pro_first=$rs->buy_code;

        $pro_last=substr($pro_last,4,6);
        $pro_first=substr($pro_first,0,4);

        if($pro_first!=$my_year){
            $buy_code=date("Y")."000001";
        }else{
            $pro_last++;
            $buy_code=$pro_first.sprintf("%06d",$pro_last);
        }
    }else{
        $buy_code=date("Y")."000001";
    }

    $buy_date=$_POST["buy_date"]." ".$time;
    $sup_id=$_POST["sup_id"];
    $st_id=$_POST["st_id"];
    $total=str_replace(",","",$_POST["total"]);
    $total_dc=str_replace(",","",$_POST["total_dc"]);
    $buy_note=$_POST["buy_note"];
    $is_paid=$_POST["is_paid"];
    $mydata=$_POST["mydata"];
    $us_id=$_SESSION["us_id"];
    $net=0;
    $net=$total-$total_dc;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        for($i=0;$i<count($mydata);$i++){
            $sql="
                update tb_pro set
                pro_buy_price='".str_replace(",","",$mydata[$i]["buy_price"])."'
                where pro_id='".$mydata[$i]["pro_id"]."'
            ";

            $conn->query($sql);
            $sql="
                insert into tb_buy_detail set
                buy_code='".$buy_code."',
                pro_id='".$mydata[$i]["pro_id"]."',
                qty='".str_replace(",","",$mydata[$i]["qty"])."',
                buy_price='".str_replace(",","",$mydata[$i]["buy_price"])."'
            ";
            
            $conn->query($sql);

            $sql="
                select
                    qty
                from tb_pro_in_stock
                    where st_id='".$st_id."'
                    and pro_id='".$mydata[$i]["pro_id"]."'
            ";

            $qry=$conn->query($sql);
            $old_qty=0;

            if(mysqli_num_rows($qry)>0){
                $rs=mysqli_fetch_object($qry);
                $old_qty=$rs->qty;
                $new_qty=$old_qty+str_replace(",","",$mydata[$i]["qty"]);

                $sql="
                    update tb_pro_in_stock set
                    qty='".$new_qty."'
                    where st_id='".$st_id."'
                    and pro_id='".$mydata[$i]["pro_id"]."'
                ";
            }else{
                $sql="
                    insert into tb_pro_in_stock set
                    st_id='".$st_id."',
                    pro_id='".$mydata[$i]["pro_id"]."',
                    qty='".str_replace(",","",$mydata[$i]["qty"])."'
                ";
            }

            $conn->query($sql);
        }

        if($is_paid=="n"){
            $sql="
                insert into tb_buy set
                    buy_code='".$buy_code."',
                    buy_date='".$buy_date."',
                    sup_id='".$sup_id."',
                    st_id='".$st_id."',
                    total='".$total."',
                    total_dc='".$total_dc."',
                    buy_note='".$buy_note."',
                    is_paid='n',
                    is_cancel='n',
                    us_id='".$us_id."'
            ";

            $conn->query($sql);
            $buy_id=mysqli_insert_id($conn);
        }else{
            $sql="
                insert into tb_buy set
                    buy_code='".$buy_code."',
                    buy_date='".$buy_date."',
                    sup_id='".$sup_id."',
                    st_id='".$st_id."',
                    total='".$total."',
                    total_dc='".$total_dc."',
                    buy_note='".$buy_note."',
                    is_paid='".$is_paid."',
                    is_cancel='n',
                    us_id='".$us_id."'
            ";

            $conn->query($sql);

            $sql="
                insert into tb_paid_money set
                    buy_id='".$buy_id."',
                    paid_date='".$buy_date."',
                    t1='".$net."',
                    t2='".$net."',
                    paid_type='".$is_paid."',
                    us_id='".$us_id."'
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