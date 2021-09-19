<?php
    $date_start="";
    $date_end="";

    if(isset($_REQUEST["date_start"]))$date_start=$_REQUEST["date_start"];
    if(isset($_REQUEST["date_end"]))$date_end=$_REQUEST["date_end"];
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
            size: portrait;
            margin: 10px;
        }
    </style>

</head>
<body>
    <u><h2 style="font-family: Lao_classic3;">
        ລາຍການຊຳລະໜີ້ຕັ້ງແຕ່ວັນທີ :<?php echo date("d-m-Y",strtotime($date_start))." : ຫາວັນທີ : 
        ".date("d-m-Y",strtotime($date_end));?>
    </h2></u>

    <table width="100%" width="100%" style="border: 0.1px solid black;
    border-collapse:collapse; margin-top:-10px;">
        <thead>
        <tr style="border-bottom: 0.1px solid black;" align="center">
            <td width="45" style="border-right: 0.1px solid black;">ລຳດັບ</td>
            <td width="140" style="border-right: 0.1px solid black;">ວັນທີຊຳລະ</td>
            <td width="90" style="border-right: 0.1px solid black;">ເລກທີຊື້</td>
            <td style="border-right: 0.1px solid black;">ລາຍຊື່ຜູ້ສະໜອງ</td>
            <td align="right" width="110">ມູນຄ່າຊຳລະ</td>
        </tr>
        </thead>

        <?php
            include("config.php");
            $date_start="";
            $date_end="";

            if(isset($_REQUEST["date_start"]))$date_start=$_REQUEST["date_start"];
            if(isset($_REQUEST["date_end"]))$date_end=$_REQUEST["date_end"];

            $sql="
                select
                    p.paid_date,
                    b.buy_code,
                    s.sup_name,
                    p.t2
                from tb_paid_money p,tb_sup s,tb_buy b
                where p.buy_id=b.buy_id
                and b.sup_id=s.sup_id
                and date(p.paid_date) between '".$date_start."' and '".$date_end."'
                order by p.paid_date, p.paid_id
            ";

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                $total=0;
                while($rs=mysqli_fetch_object($qry)){
                    $total+=$rs->t2;
        ?>

        <tr>
            <td style="border-right: 0.1px solid black;" align="center"><?php echo $n++;?></td>
            <td style="border-right: 0.1px solid black;"><?php echo date("d-m-Y H:i:s",strtotime($rs->paid_date));?></td>
            <td style="border-right: 0.1px solid black; padding-left:4px;"><?php echo $rs->buy_code;?></td>
            <td style="border-right: 0.1px solid black;"><?php echo $rs->sup_name;?></td>
            <td align="right"><?php echo number_format($rs->t2);?></td>
        </tr>
        <?php }}?>
        <tr style="border-top: 0.1px solid black;">
            <td colspan="3"></td>
            <td align="right" style="border-right: 0.1px solid black;">ລວມຍອດ :</td>
            <td align="right"><?php echo number_format($total);?></td>
        </tr>
    </table>

    <table width="100%" style="margin-top:5px;">
        <tr>
            <td width="32%"><u>ເຊັນຜູ້ສະຫຼຸບບັນຊີ</u></td>
            <td width="32%" align="center"><u>ເຊັນຜູ້ກວດສອບ</u></td>
            <td width="30%" align="right"><u>ເຊັນຜູ້ອຳນວຍການ</u></td>
        </tr>
    </table>

    <script>
        window.print();
        setTimeout(window.close, 0);
    </script>
</body>
</html>