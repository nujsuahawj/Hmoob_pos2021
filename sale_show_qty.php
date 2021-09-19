<?php
    include("config.php");
    $st_id=$_GET["st_id"];
    $pro_id=$_GET["pro_id"];

    $sql="
        select
            qty
        from tb_pro_in_stock
            where pro_id='".$st_id."'
            and st_id='".$pro_id."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs=0;
    }

    echo json_encode($rs);
?>