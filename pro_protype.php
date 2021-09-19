<?php
    include("config.php");

    $sql="
        select
            pt_id,
            pt_name
        from tb_protype
            order by pt_name
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        while($rs=mysqli_fetch_object($qry)){
            $output[]=array(
                "pt_id"=>$rs->pt_id,
                "pt_name"=>$rs->pt_name
            );
        }

        echo json_encode($output);
    }
?>