<?php
    include("config.php");
    $mov_code="";
    $st_name_1="";
    $st_name_2="";

    if(isset($_REQUEST["mov_code"]))$mov_code=$_REQUEST["mov_code"];
    if(isset($_REQUEST["st_name_1"]))$st_name_1=$_REQUEST["st_name_1"];
    if(isset($_REQUEST["st_name_2"]))$st_name_2=$_REQUEST["st_name_2"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @page{
            size: auto;
            margin: 0mm 5mm 0mm 5mm;
        }
        body{
            font-family:Phetsarath OT;
            font-size:14px;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td style="font-family:Lao_classic3; width:60%"><u><h3>ລາຍການເຄື່ອນຍ້າຍສິນຄ້າ</h3></u></td>
            <td style="font-family:Lao_classic3;"><u><h3 style="text-align:right;">ເລກທີເຄື່ອນຍ້າຍ :<?php echo $mov_code;?></h3></u></td>
        </tr>
    </table>
    <table width="100%" style="margin-top: -10px;">
        <tr>
            <td>ປະຈຳວັນທີ :<?php echo date("d-m-Y H:i:s");?></td>
            <td align="right">ຜູ້ບັນທຶກບັນຊີ :<?php echo $_SESSION["us_name"];?></td>
        </tr>
        <tr>
            <td>ສາງສິນຄ້າຕົ້ນທາງ :<?php echo $st_name_1;?></td>
            <td align="right">ສາງສິນຄ້າປາຍທາງ :<?php echo $st_name_2;?></td>
        </tr>
    </table>
    
    <table width="100%" style="border: 1px solid grey; border-collapse: collapse; margin-left:2px; margin-top:4px;">
        <tr align="center" style="border: black 1px solid; border-collapse: collapse;">
            <td width="40" style="border-right: black 1px solid; border-collapse: collapse;">ລຳດັບ</td>
            <td width="105" style="border-right: black 1px solid; border-collapse: collapse;">ລະຫັດສິນຄ້າ</td>
            <td style="border-right: black 1px solid; border-collapse: collapse;">ລາຍລະອຽດສິນຄ້າ</td>
            <td width="90" style="border-right: black 1px solid; border-collapse: collapse;">ໜ່ວຍນັບ</td>
            <td width="60">ຈຳນວນ</td>
        </tr>
        <?php
            $sql="
                select p.pro_code,p.pro_name,p.pro_detail,u.un_name,m.qty
                from tb_move_detail m,tb_pro p,tb_unit u
                where m.pro_id=p.pro_id
                and p.un_id=u.un_id
                and m.mov_code='".$mov_code."'
                order by m.mov_id
            ";
            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>
        <tr>
            <td align="center" style="border-right: black 1px solid; border-collapse: collapse;"><?php echo $n++;?></td>
            <td align="center" style="border-right: black 1px solid; border-collapse: collapse;"><?php echo $rs->pro_code;?></td>
            <td style="border-right: black 1px solid; border-collapse: collapse;"><?php echo $rs->pro_name."-".$rs->pro_detail;?></td>
            <td align="center" style="border-right: black 1px solid; border-collapse: collapse;"><?php echo $rs->un_name;?></td>
            <td align="center"><?php echo number_format($rs->qty);?></td>
        </tr>
        <?php }}?>
    </table>
    <table width="100%">
        <tr>
            <td width="30%"><u>ເຊັນພະນັກງານເບີກເຄື່ອງ</u></td>
            <td width="40%" align="center"><u>ເຊັນພະນັກງານຮັບເຄື່ອງ</u></td>
            <td align="right"><u>ຜູ້ອຳນວຍການ</u></td>
        </tr>
    </table>

    <script>
        window.print();
        setTimeout(window.close, 0);
    </script>
</body>
</html>