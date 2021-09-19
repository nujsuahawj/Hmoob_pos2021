<?php
    include("config.php");

    $time=date("H:i:s");
    $n_year=date("Y");
    $my_year=date("Y");

    $sql="
        select
            mov_code
        from tb_move
            order by mov_id desc limit 1
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        $pro_last=$rs->mov_code;
        $pro_first=$rs->mov_code;

        $pro_last=substr($pro_last,4,6);
        $pro_first=substr($pro_first,0,4);

        if($pro_first!=$my_year){
            $mov_code=date("Y")."000001";
        }else{
            $pro_last++;
            $mov_code=$pro_first.sprintf("%06d",$pro_last);
        }
    }else{
        $mov_code=date("Y")."000001";
    }

    // SELECT `mov_id`, `mov_date`, `mov_code`, `st_id_1`, `st_id_2`, `em_id`, `is_recieve`, `mov_note`, `us_id` FROM `tb_move` WHERE 1
    
    $mov_date=$_POST["mov_date"]." ".$time;
    $st_id_1=$_POST["st_id_1"];
    $st_id_2=$_POST["st_id_2"];
    $em_id=$_POST["em_id"];
    $mov_note=$_POST["mov_note"];
    $is_recieve="n";
    $us_id=$_SESSION["us_id"];
    $mydata=$_POST["mydata"];
    $new_qty=0;
    $old_qty=0;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    
    try{
        for($i=0;$i<count($mydata);$i++){
            
            $sql="
                insert into tb_move_detail set
                mov_code='".$mov_code."',
                pro_id='".$mydata[$i]["pro_id"]."',
                qty='".str_replace(",","",$mydata[$i]["qty"])."'
            ";
            $conn->query($sql);
            $sql="
                select qty
                from tb_pro_in_stock 
                where st_id='".$st_id_1."'
                and pro_id='".$mydata[$i]["pro_id"]."'
            ";
            $qry=$conn->query($sql);

            if(mysqli_num_rows($qry)>0){
                $rs=mysqli_fetch_object($qry);
                $old_qty=$rs->qty;
                $new_qty=$old_qty-str_replace(",","",$mydata[$i]["qty"]);

                $sql="
                    update tb_pro_in_stock set
                    qty='".$new_qty."'
                    where st_id='".$st_id_1."'
                    and pro_id='".$mydata[$i]["pro_id"]."'
                ";

                $conn->query($sql);
            }
        }

        $sql="
            insert into tb_move set
            mov_date='".$mov_date."',
            mov_code='".$mov_code."',
            st_id_1='".$st_id_1."',
            st_id_2='".$st_id_2."',
            em_id='".$em_id."',
            is_recieve='".$is_recieve."',
            mov_note='".$mov_note."',
            us_id='".$us_id."'
        ";

        $conn->query($sql);
        $conn->commit();
        echo json_encode($mov_code);
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }

    
?>