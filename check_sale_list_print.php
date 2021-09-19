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
            size: landscape;
            margin: 10px;
        }
    </style>

</head>
<body>
    <u><h2 style="font-family: Lao_classic3;">
        ລາຍການຂາຍສິນຄ້າຕັ້ງແຕ່ວັນທີ :<?php echo date("d-m-Y",strtotime($date_start))." : ຫາວັນທີ : 
        ".date("d-m-Y",strtotime($date_end));?>
    </h2></u>
    <table width="100%" style="border: 0.1px solid black; border-collapse: collapse;
    margin-top:-10px; border-bottom:none;">
    <thead>
    <tr style="border-bottom:0.1px solid black;" align="center">
        <td width="50" style="border-right: 0.1px solid black; border-collapse: collapse;">ລຳດັບ</td>
        <td width="90" style="border-right: 0.1px solid black; border-collapse: collapse;">ເລກທີຂາຍ</td>
        <td width="140" style="border-right: 0.1px solid black; border-collapse: collapse;">ວັນທີຂາຍ</td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse;">ລາຍຊື່ລູກຄ້າ</td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse;" width="100">ຍອດຂາຍ</td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse;" width="100">ສ່ວນລຸດ</td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse;" width="100">ຍອດຂາຍຕົວຈິງ</td>
    </tr>
    </thead>

    <?php
        include("config.php");

        $sql="
            select
                s.sale_date,
                s.sale_code,
                s.total,
                s.total_dc,
                c.cus_name
            from tb_sale s,tb_cus c
            where s.cus_id=c.cus_id
            and date(s.sale_date) between '".$date_start."' and '".$date_end."'
            order by s.sale_code
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            $total=0;
            $total_dc=0;
            $net=0;

            while($rs=mysqli_fetch_object($qry)){
                $total+=$rs->total;
                $total_dc+=$rs->total_dc;
                $net+=$rs->total-$rs->total_dc;
    ?>

    <tr>
        <td align="center" style="border-right: 0.1px solid black; border-collapse: collapse;"><?php echo $n++;?></td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse; padding-left:4px; "><?php echo $rs->sale_code;?></td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse;"><?php echo date("d-m-Y H:i:s",strtotime($rs->sale_date));?></td>
        <td style="border-right: 0.1px solid black; border-collapse: collapse;"><?php echo $rs->cus_name;?></td>
        <td align="right" style="border-right: 0.1px solid black; border-collapse: collapse;"><?php echo number_format($rs->total);?></td>
        <td align="right" style="border-right: 0.1px solid black; border-collapse: collapse;"><?php echo number_format($rs->total_dc);?></td>
        <td align="right" style="border-right: 0.1px solid black; border-collapse: collapse;"><?php echo number_format($rs->total-$rs->total_dc);?></td>
    </tr>
    <?php }}?>
</table>

<table width="100%" style="border:black 0.1px solid;border-collapse: collapse;
    margin-bottom:5px;">
        <tr>
            <td colspan="3"></td>
            <td width="100" align="right">ລວມຍອດ :</td>
            <td style="border:black 0.1px solid;" width="100" align="right"><?php echo number_format($total);?></td>
            <td style="border:black 0.1px solid;" width="100" align="right"><?php echo number_format($total_dc);?></td>
            <td style="border:black 0.1px solid;" width="100" align="right"><?php echo number_format($net);?></td>
        </tr>
    </table>
    <table width="100%">
    <tr>
        <td width="32%"><u>ເຊັນສະຫຼຸບບັນຊີ</u></td>
        <td width="32%" align="center"><u>ຜຸ້ກວດສອບບັນຊີ</u></td>
        <td width="30%" align="right"><u>ຜູ້ອຳນວຍການ</u></td>
    </tr>
</table>
</body>
</html>

<script>
    window.print();
    setTimeout(window.close, 0);
</script>