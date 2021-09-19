<?php
    include("config.php");

    $sql="
        select 
            un_id,
            un_name
        from tb_unit
            order by un_name
    ";

    $qry=$conn->query($sql);
    
    if(mysqli_num_rows($qry)>0){
        while($rs=mysqli_fetch_object($qry)){
            $output[]=array(
                "un_id"=>$rs->un_id,
                "un_name"=>$rs->un_name
            );
        }

        echo json_encode($output);
    }
?>