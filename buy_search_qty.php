<?php
    include("config.php");

    $pro_id=$_GET["pro_id"];
    $st_id=$_GET["st_id"];

    $sql="
        select qty from tb_pro_in_stock where pro_id='".$pro_id."' and st_id='".$st_id."'
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs="";
    }

    echo json_encode($rs);
?>