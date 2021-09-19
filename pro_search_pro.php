<?php
    include("config.php");
    $pro_code=$_GET["pro_code"];

    $sql="
        select pro_id,pro_code,pro_name,
        pro_name_2,pro_detail,pt_id,
        un_id,format(pro_buy_price,0)as pro_buy_price,
        format(pro_sale_price,0)as pro_sale_price,
        format(pro_sale_price_2,0)as pro_sale_price_2,
        format(pro_sale_price_vip,0)as pro_sale_price_vip,
        format(pro_low_to_order,0)as pro_low_to_order,
        pro_is_cancel
        from tb_pro
        where pro_code='".$pro_code."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }

    echo json_encode($rs);
?>