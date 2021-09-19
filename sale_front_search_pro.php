<?php
    include("config.php");

    $pro_code=trim($_GET["pro_code"]);

    $sql="select p.pro_id,p.pro_code,p.pro_name_2,u.un_name,s.qty,
        format(p.pro_sale_price,0)as pro_sale_price
        from tb_pro p,tb_unit u,tb_pro_in_stock s
        where p.pro_code='".trim($pro_code)."'
        and p.un_id=u.un_id
        and p.pro_is_cancel='n'
        and s.pro_id=p.pro_id
        and s.st_id=1
        ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs="n";
    }

    echo json_encode($rs);
?>