<?php
    include("config.php");

    $pro_code=trim($_GET["pro_code"]);

    $sql="
        select
            p.pro_id,
            p.pro_code,
            p.pro_name,
            p.pro_detail,
            format(p.pro_buy_price,0)as pro_buy_price,
            u.un_name
        from 
            tb_pro p,
            tb_unit u
        where
            p.un_id=u.un_id
        and 
            p.pro_code='".$pro_code."'
        and
            p.pro_is_cancel='n'
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        echo json_encode($rs);
    }else{
        echo json_encode("n");
    }
?>