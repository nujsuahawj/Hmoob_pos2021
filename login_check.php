<?php
    include("config.php");
    $us_name=$_GET["us_name"];
    $us_pass=base64_encode($_GET["us_pass"]);

    $sql="
        select *
        from tb_user
        where us_name='".$us_name."'
        and us_pass='".$us_pass."'
        and is_cancel='n'
    ";

    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        $_SESSION["us_id"]=$rs->us_id;
        $_SESSION["us_name"]=$rs->us_name;
        $_SESSION["us_type"]=$rs->us_type;
    }else{
        echo "n";
    }
?>