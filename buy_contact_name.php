<?php
    include("config.php");

    $sup_id=$_GET["sup_id"];

    $sql="
        select
            sup_contact_name,
            sup_phone
        from tb_sup
            where sup_id='".$sup_id."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }else{
        $rs="";
    }

    echo json_encode($rs);
?>