<?php
    include("config.php");

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

    $buy_code=$_REQUEST["buy_code"];
    ////SELECT `buy_id`, ``, ``, `sup_id`, `st_id`, `total`, `total_dc`, `buy_note`, `us_id` FROM `tb_buy` WHERE 1

    $sql="
        select 
            b.buy_code,
            b.buy_date,
            b.buy_note,
            st.st_name,
            s.sup_name,
            s.sup_phone,
            s.sup_contact_name,
            b.total_dc
        from
            tb_buy b,tb_stock st,tb_sup s
        where
            b.st_id=st.st_id
        and
            b.sup_id=s.sup_id
        and 
            b.buy_code='".$buy_code."'
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
            size: auto;
            margin: 0px;
        }
    </style>

</head>
<body style="padding:20px;">
    <!-- <label for="" style="font-size:20px; margin:5px; font-family:Lao_classic3;"><u></u></label> -->
    <table width="100%">
        <tr>
            <td width="50%">
                <div style="font-family:Lao_classic3; font-size:24px;"><u>ລາຍການຊື້ສິນຄ້າ</u><br>
                </div>
                <label for="">ປະຈຳວັນທີ :<?php echo date("d-m-Y H:i:s",strtotime($rs->buy_date));?></label>
            </td>
            <td align="right">
                <div style="font-family:Lao_classic3; font-size:24px;"><u>ເລກທີຊື້ :<?php echo $buy_code;?></u><br>
                </div>
                <label for="">ຜູ້ບັນທຶກບັນຊີ :<?php echo $_SESSION["us_name"];?></label>
            </td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td width="50%" style="padding:6px; border:grey 1px solid;">
                <div>
                    <label for="">ຊື່ສຳນັກງານ :<?php echo $com_name;?></label><br>
                    <label for="">ເບີໂທລະສັບ :<?php echo $com_phone;?></label><br>
                    <label for="">ທີ່ຢູ່ :<?php echo $com_address;?></label>
                </div>
            </td>
            <td width="50%" style="padding:10px; border:grey 1px solid;">
                <div>
                    <label for="">ຊື່ສິນຄ້າຈາກ :<?php echo $rs->sup_name;?></label><br>
                    <label for="">ເບີໂທລະສັບ :<?php echo $rs->sup_phone;?></label><br>
                    <label for="">ຊື່ຜູ້ຕິດຕໍ່ :<?php echo $rs->sup_contact_name;?></label>
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" style="border: 1px solid grey; border-collapse: collapse; margin-left:2px; margin-top:4px;">
        <tr style="text-align:center; border: 1px solid grey; border-collapse: collapse;">
            <td width="30" style="border: 1px solid grey; border-collapse: collapse;">ລຳດັບ</td>
            <td width="100" style="border: 1px solid grey; border-collapse: collapse;">ລະຫັດສິນຄ້າ</td>
            <td style="border: 1px solid grey; border-collapse: collapse;">ລາຍລະອຽດສິນຄ້າ</td>
            <td width="90" style="border: 1px solid grey; border-collapse: collapse;">ໜ່ວຍຈັດເກັບ</td>
            <td width="60" style="border: 1px solid grey; border-collapse: collapse;">ຈຳນວນ</td>
            <td width="85" style="border: 1px solid grey; border-collapse: collapse;">ລາຄາ</td>
            <td width="95" style="border: 1px solid grey; border-collapse: collapse;">ມູນຄ່າ</td>
        </tr>

        <?php
            $sql="select 
                    p.pro_code,
                    p.pro_name,
                    u.un_name,
                    b.qty,
                    b.buy_price
                from 
                    tb_pro p,
                    tb_unit u,
                    tb_buy_detail b
                where
                    b.pro_id=p.pro_id
                and
                    p.un_id=u.un_id
                and 
                    b.buy_code='".$buy_code."'
            ";

            $qry_pro=$conn->query($sql);
    
            if(mysqli_num_rows($qry_pro)>0){
                $n=1;
                $real_total=0;
                while($rs_pro=mysqli_fetch_object($qry_pro)){
                    $total=$rs_pro->qty*$rs_pro->buy_price;
                    $real_total+=$total;
        ?>

        <tr>
            <td style="border-right:grey 1px solid; text-align:center"><?php echo $n++;?></td>
            <td align="center" style="border-right:grey 1px solid;"><?php echo $rs_pro->pro_code;?></td>
            <td style="border-right:grey 1px solid;"><?php echo $rs_pro->pro_name;?></td>
            <td style="border-right:grey 1px solid; text-align:center"><?php echo $rs_pro->un_name;?></td>
            <td style="border-right:grey 1px solid; text-align:center"><?php echo number_format($rs_pro->qty);?></td>
            <td style="border-right:grey 1px solid; text-align:right"><?php echo number_format($rs_pro->buy_price);?></td>
            <td style="border-right:grey 1px solid; text-align:right"><?php echo number_format($total);?></td>
        </tr>

        <?php }}?>

        <tr style="border-top:grey 1px solid;">
            <td colspan="4" valign="top">
            <label for="">ສາງຈັດເກັບ :<?php echo $rs->st_name;?></label><br>    
            ໝາຍເຫດ :<?php echo $rs->buy_note;?></td>
            <td colspan="2" align="right" style="border-right:grey 1px solid;">
                <label for="">ລວມມູນຄ່າຊື້ :</label><br>
                <label for="">ສ່ວນລຸດ :</label><br>
                <label for="">ມູນຄ່າຊື້ຕົວຈິງ :</label>
            </td>
            <td align="right">
                <?php echo number_format($real_total);?><br>
                <?php echo number_format($rs->total_dc);?><br>
                <?php echo number_format($real_total-$rs->total_dc);?>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top:5px;">
        <tr>
            <td width="32%"><u>ເຊັນຜູ້ຊື້ສິນຄ້າ</u></td>
            <td width="32%" align="center"><u>ເຊັນຜູ້ຮັບເງິນ</u></td>
            <td width="30%" align="right"><u>ເຊັນຜູ້ອຳນວຍການ</u></td>
        </tr>
    </table>

    <script>
        window.print();
        setTimeout(window.close, 0);
    </script>
</body>
</html>