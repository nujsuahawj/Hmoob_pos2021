<?php
    include("config.php");
    $sql="
        select
            em_id,em_name
        from tb_em
            where is_leave='n'
            order by em_name
    ";
    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        while($rs=mysqli_fetch_object($qry)){
            $output[]=array(
                "em_id"=>$rs->em_id,
                "em_name"=>$rs->em_name
            );
        }

        echo json_encode($output);
    }
?>