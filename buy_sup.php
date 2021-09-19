<?php
    include("config.php");

    $sql="
        select
            sup_id,
            sup_name
        from tb_sup
            order by sup_name
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        while($rs=mysqli_fetch_object($qry)){
            $output[]=array(
                "sup_id"=>$rs->sup_id,
                "sup_name"=>$rs->sup_name
            );
        }

        echo json_encode($output);
    }
?>