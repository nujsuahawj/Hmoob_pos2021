<?php
    include("config.php");

    $pro_code=$_GET["pro_code"];
    $st_id=$_GET["st_id"];

    $sql="
        select
            s.pro_id,
            p.pro_code,
            p.pro_name,
            p.pro_detail,
            s.qty,
            u.un_name,
            u.un_qty
        from tb_pro_in_stock s,tb_pro p,tb_unit u
            where s.st_id='".$st_id."'
            and p.pro_code='".$pro_code."'
            and s.pro_id=p.pro_id
            and p.pro_is_cancel='n'
            and p.un_id=u.un_id
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs="";
    }

    echo json_encode($rs);
?>