<?php 
    include("config.php");

    $sql="
        select
            st_id,
            st_name
        from tb_stock 
        where st_id<>1
            order by 
            st_id
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        while($rs=mysqli_fetch_object($qry)){
            $output[]=array(
                "st_id"=>$rs->st_id,
                "st_name"=>$rs->st_name
            );
        }

        echo json_encode($output);
    }
?>