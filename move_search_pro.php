<?php
    include("config.php");

    $st_id=$_GET["st_id_1"];
    $pro_code=trim($_GET["pro_code"]);

    $sql="
        select 
            p.pro_code,
            s.pro_id,
            p.pro_name,
            p.pro_detail,
            u.un_name,
            s.qty
        from tb_pro p,tb_unit u,tb_pro_in_stock s
            where p.pro_code='".$pro_code."'
            and s.st_id='".$st_id."'
            and p.pro_is_cancel='n'
            and u.un_id=p.un_id
            and p.pro_id=s.pro_id
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs="n";
    }
    echo json_encode($rs);
?>