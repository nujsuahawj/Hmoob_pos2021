<?php
    include("config.php");
    $mov_code=$_POST["mov_code"];
    $st_id_2=$_POST["st_id_2"];
    $old_qty=0;
    $new_qty=0;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();
    try{
        $sql="
            update tb_move set
            is_recieve='y'
            where mov_code='".$mov_code."'
        ";

        $conn->query($sql);  

        $sql="
            select
                pro_id,
                qty
            from tb_move_detail
                where mov_code='".$mov_code."'
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            while($rs=mysqli_fetch_object($qry)){
                $pro_id_move=$rs->pro_id;
                $qty_move=$rs->qty;
    
                $sql_pro_in_stock="
                    select 
                        qty
                    from tb_pro_in_stock
                        where st_id='".$st_id_2."'
                        and pro_id='".$pro_id_move."'
                ";
                $qry_pro_in_stock=$conn->query($sql_pro_in_stock);
                if(mysqli_num_rows($qry_pro_in_stock)>0){
                    $rs_old_qty=mysqli_fetch_object($qry_pro_in_stock);
                    $old_qty=$rs_old_qty->qty;
                    $new_qty=$old_qty+$qty_move;
    
                    $sql_update="
                        update tb_pro_in_stock set
                        qty='".$new_qty."'
                        where st_id='".$st_id_2."'
                        and pro_id='".$pro_id_move."'
                    ";
                    $conn->query($sql_update);
                }else{
                    $sql_insert="
                        insert into tb_pro_in_stock set
                        qty='".$qty_move."',
                        st_id='".$st_id_2."',
                        pro_id='".$pro_id_move."'
                    ";
                    $conn->query($sql_insert);
                }

            }
        }

        $conn->commit();
    }catch(mysqli_sql_exception $exception){
        $conn->rollback();
        throw $exception;
    }
?>