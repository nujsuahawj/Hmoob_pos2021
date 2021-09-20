<?php include("config.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.5.0-dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.14.0-web/css/all.min.css">
    <script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
    <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.5.0-dist/js/sweetalert2.all.min.js"></script>
    <style>
        body{
            font-family: Lao_classic3;
            background-color: #e6e6e6;
        }
        .form-control:focus{
            border:#0099cc 1px solid;
            box-shadow: 0 0 #0099cc;
        }
        button{
            width:140px;
        }
    </style>
</head>
<body>
    <?php
        $ndate=date("Y-m-d");
        if($_SESSION["us_id"]<1){
            include("login.php");
        }else{
            include("nav.php");
        }
    ?>

    <div class="container-fluid" id="mainpage">
    <?php
            if($_SESSION["us_id"]>0){
                $sql="
                    select count(sale_id) as sale_id
                    from tb_sale
                    where date(sale_date)='".$ndate."'
                ";

                $qry=$conn->query($sql);
                if(mysqli_num_rows($qry)>0){
                    $rs=mysqli_fetch_object($qry);
                    $reg_total=disk_total_space("D:")/1024;
                    
                    if($rs->sale_id>5){
                        $sql_reg="
                            select reg_id
                            from tb_reg
                            where (reg_free+reg_num)='".$reg_total."'
                        ";
                        $qry_reg=$conn->query($sql_reg);
                        if(mysqli_num_rows($qry_reg)>0){
                            include("mainpage.php");
                        }else{
                            include("reg.php");
                        }
                    }else{
                        include("mainpage.php");
                    }
                }
            }
        ?>
    </div><br><br><br>
    <?php include("footer.php"); ?>

    <script>
        function ajax(Vr,Div){
            var ran = Math.random();
            Vr += "&ran="+ran;
            $("#"+Div).load("_.php?fls="+encodeURI(Vr), function(responseTxt, statusTxt, xhr){
            if(statusTxt == "error")
                response.write("Error: " + xhr.status + ": " + xhr.statusTxt);
            });
        }
    </script>
</body>
</html>