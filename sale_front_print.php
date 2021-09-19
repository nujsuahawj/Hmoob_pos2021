<?php
    $sale_code="";
    $t2="";
    include("config.php");

    if(isset($_REQUEST["sale_code"]))$sale_code=$_REQUEST["sale_code"];
    if(isset($_REQUEST["t2"]))$t2=$_REQUEST["t2"];

    $t2=str_replace(",","",$t2);

    $sql="
        select * from tb_com
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs_com=mysqli_fetch_object($qry);
        $com_name=$rs_com->com_name;
        $com_phone=$rs_com->com_phone;
        $com_address=$rs_com->com_address;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            font-family:Phetsarath OT;
            font-size:14px;
        }
        @page{
            size: auto;
            margin: 0px;
        }
    </style>
</head>
<body>
    <center>
        ຊື່ຮ້ານ : <?php echo $com_name;?><br>
        ເບີໂທລະສັບ : <?php echo $com_phone;?><br>
        ທີ່ຢູ່ : <?php echo $com_address;?><br>
        ປະຈຳວັນທີ :<?php echo date("d-m-Y H:i:s");?><br>
        ບິນເລກທີ :<?php echo $sale_code;?><br>
        ຜູ້ບັນທຶກລາຍການ :<?php echo $_SESSION["us_name"];?>
    </center>

    <table width="100%">
        <tr style="border-bottom:grey 1px solid;">
            <td>ຊື່ສິນຄ້າ</td>
            <td width="20%" align="right">ມູນຄ່າ</td>
        </tr>
        <?php
            $sql="select 
                    p.pro_code,
                    p.pro_name_2,
                    u.un_name,
                    sum(s.qty)as qty,
                    s.sale_price
                from 
                    tb_pro p,
                    tb_unit u,
                    tb_sale_detail s
                where
                    s.pro_id=p.pro_id
                and
                    p.un_id=u.un_id
                and
                    s.sale_code='".$sale_code."'
                group by
                    p.pro_code,
                    p.pro_name_2,
                    u.un_name,
                    s.sale_price
                order by p.pro_name_2
            ";

            $qry_pro=$conn->query($sql);
            if(mysqli_num_rows($qry_pro)>0){
                $n=0;
                $total=0;
                while($rs_pro=mysqli_fetch_object($qry_pro)){
                    $n++;
                    $total+=$rs_pro->qty*$rs_pro->sale_price;
        ?>
        <tr>
            <td>
                <?php echo $n."-".$rs_pro->pro_name_2;?><br>
                <?php echo "(".number_format($rs_pro->qty).")"."x(".number_format($rs_pro->sale_price).")";?><br>
            </td>
            <td align="right"><?php echo number_format($rs_pro->qty*$rs_pro->sale_price);?></td>
        </tr>
        <?php }}?>
        <tr>
            <td>ລວມຍອດ :</td>
            <td align="right"><?php echo number_format($total);?></td>
        </tr>
        <tr>
            <td>ຮັບຊຳລະ :</td>
            <td align="right"><?php echo number_format($t2);?></td>
        </tr>
        <tr>
            <td>ເງິນທອນ :</td>
            <td align="right"><?php echo number_format($total-$t2,0);?></td>
        </tr>
        <tr>
            <td colspan="2" align="center">ຂໍຂອບໃຈທີ່ໃຊ້ບໍລິການ</td>
        </tr>
    </table>

    <script>
        window.print();
        setTimeout(window.close, 0);
    </script>
</body>
</html>