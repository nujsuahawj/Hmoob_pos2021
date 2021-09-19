<?php
    include("config.php");
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
            /* size: auto; */
            margin: 10px;
            size: landscape;
        }
        /* table, th, td {
            border: 0.1px solid black;
            border-collapse: collapse;
        } */
    </style>

</head>
<body>
    <u><h4 style="font-family: Lao_classic3; font-size:20px;">ລາຍການຊື້ສິນຄ້າຕັ້ງແຕ່ວັນທີ :
    <?php echo date("d-m-Y",strtotime($date_start))." : ຫາວັນທີ : 
    ".date("d-m-Y",strtotime($date_end));?></h4></u>
    <table width="100%" style="border: 0.1px solid black; border-collapse: collapse;
    margin-top:-10px; border-bottom:none;">
        <thead>
            <tr align="center" style="border:black 0.1px solid;">
                <td width="40" style="border:black 0.1px solid;">ລຳດັບ</td>
                <td width="90" style="border:black 0.1px solid;">ເລກທີຊື້</td>
                <td width="140" style="border:black 0.1px solid;">ວັນທີຊື້</td>
                <td style="border:black 0.1px solid;">ຊື້ຈາກຜູ້ສະໜອງ</td>
                <td width="120" style="border:black 0.1px solid;">ສາງຈັດເກັບ</td>
                <td width="100" style="border:black 0.1px solid;">ມູນຄ່າຊື້</td>
                <td width="90" style="border:black 0.1px solid;">ສ່ວນລຸດ</td>
                <td width="110" style="border:black 0.1px solid;">ມູນຄ່າຊື້ຕົວຈິງ</td>
            </tr>
        </thead>
            <?php
                $sql="
                    select
                        b.buy_code,
                        b.buy_date,
                        s.sup_name,
                        st.st_name,
                        b.total,
                        b.total_dc
                    from
                        tb_buy b,
                        tb_sup s,
                        tb_stock st
                    where
                        b.sup_id=s.sup_id
                    and
                        b.is_cancel='n'
                    and 
                        b.st_id=st.st_id
                    and 
                        date(b.buy_date) between '".$date_start."' and '".$date_end."'
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
                <td width="60" align="center" style="border-right: 0.1px solid black;"><?php echo $n++;?></td>
                <td align="left" style="padding-left:4px;border-right: 0.1px solid black;"><?php echo $rs->buy_code;?></td>
                <td style="border-right: 0.1px solid black;"><?php echo date("d-m-Y H:i:s",strtotime($rs->buy_date));?></td>
                <td style="border-right: 0.1px solid black;"><?php echo $rs->sup_name;?></td>
                <td style="border-right: 0.1px solid black;" align="center"><?php echo $rs->st_name;?></td>
                <td style="border-right: 0.1px solid black;" align="right"><?php echo number_format($rs->total);?></td>
                <td style="border-right: 0.1px solid black;" align="right"><?php echo number_format($rs->total_dc);?></td>
                <td align="right"><?php echo number_format($rs->total-$rs->total_dc);?></td>
            </tr>
            <?php }}?>
        </table>
        <table width="100%" style="border:black 0.1px solid;border-collapse: collapse;
        margin-bottom:5px;">
            <tr>
                <td colspan="3"></td>
                <td width="100" align="right">ລວມຍອດ :</td>
                <td style="border:black 0.1px solid;" width="100" align="right"><?php echo number_format($total);?></td>
                <td style="border:black 0.1px solid;" width="90" align="right"><?php echo number_format($total_dc);?></td>
                <td style="border:black 0.1px solid;" width="110" align="right"><?php echo number_format($net);?></td>
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

    <script>
        window.print();
        setTimeout(window.close, 0);
    </script>
</html>
    
</div>

