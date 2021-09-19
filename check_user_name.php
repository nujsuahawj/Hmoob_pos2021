<?php
    include("config.php");

    $sql="
        select us_name,us_pass
        from tb_user
        where is_cancel='n'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)<1){
        echo json_encode("user name ຫຼື password ບໍ່ຖືກຕ້ອງ!!!");
        exit();
    }
?>