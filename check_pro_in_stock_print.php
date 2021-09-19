<?php
    include("config.php");
    $st_id="";
    if(isset($_REQUEST["st_id"]))$st_id=$_REQUEST["st_id"];

    $st_id=$_REQUEST["st_id"];
    $sql="
        select
            st_name
        from tb_stock
            where st_id='".$st_id."'
    ";
    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
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
            size: portrait;
            margin: 10px;
        }
    </style>

</head>
<body>
    <u><h2 style="font-family: Lao_classic3;">
        <?php 
            date_default_timezone_set("Asia/Bangkok");
            echo "ລາຍການສິນຄ້າຄ້າງສາງປະຈຳວັນທີ :". date("d-m-Y")." (".$rs->st_name.")";
        ?>
    </h2></u>

    <table width="100%" width="100%" style="border: 0.1px solid black;
    border-collapse:collapse; margin-top:-10px;">
        <thead>
            <tr style="border-bottom: 0.1px solid black;" align="center">
                <td width="45" style="border-right: 0.1px solid black;">ລຳດັບ</td>
                <td width="110" style="border-right: 0.1px solid black;">ລະຫັດສິນຄ້າ</td>
                <td style="border-right: 0.1px solid black;">ລາຍລະອຽດສິນຄ້າ</td>
                <td width="110" style="border-right: 0.1px solid black;">ໜ່ວຍນັບ</td>
                <td width="80" style="border-right: 0.1px solid black;">ຄ້າງສາງ</td>
            </tr>
        </thead>
        <?php
            $sql="
                select
                    p.pro_code,
                    p.pro_name,
                    p.pro_detail,
                    u.un_name,
                    s.qty
                from 
                    tb_pro_in_stock s,
                    tb_pro p,
                    tb_unit u
                where
                    s.pro_id=p.pro_id
                and
                    p.un_id=u.un_id
                and
                    p.pro_is_cancel='n'
                and 
                    s.st_id='".$st_id."'
                order by p.pro_name
            ";

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>
        <tr>
            <td style="border-right: 0.1px solid black;" align="center"><?php echo $n++;?></td>
            <td style="border-right: 0.1px solid black;" align="center"><?php echo $rs->pro_code;?></td>
            <td style="border-right: 0.1px solid black;"><?php echo $rs->pro_name." ".$rs->pro_detail;?></td>
            <td style="border-right: 0.1px solid black;" align="center"><?php echo $rs->un_name;?></td>
            <td align="center"><?php echo number_format($rs->qty);?></td>
        </tr>
        <?php }}?>
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