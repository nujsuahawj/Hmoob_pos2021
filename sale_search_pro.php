<?php
    include("config.php");

    $pro_code=$_GET["pro_code"];
    $st_id=$_GET["st_id"];

    $sql="select s.pro_id,p.pro_code,p.pro_name,p.pro_detail,u.un_name,s.qty,
        format(p.pro_sale_price_2,0)as pro_sale_price_2, 
        format(p.pro_sale_price_vip,0)as pro_sale_price_vip
        from tb_pro p,tb_unit u,tb_pro_in_stock s
        where p.pro_code='".$pro_code."'
        and s.st_id='".$st_id."'
        and s.pro_id=p.pro_id
        and p.un_id=u.un_id
        and p.pro_is_cancel='n'
        ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs="n";
    }

    echo json_encode($rs);
?>