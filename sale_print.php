

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
        
    $sale_code="";
    if(isset($_REQUEST["sale_code"]))$sale_code=$_REQUEST["sale_code"];
    // echo $sale_code;

    $sql="
        select
            s.sale_date,
            s.sale_code,
            s.sale_note,
            s.total_dc,
            c.cus_name,
            c.cus_phone,
            st.st_name,
            c.cus_contact_name
        from 
            tb_sale s,
            tb_cus c,
            tb_stock st
        where
            s.cus_id=c.cus_id
        and s.st_id=st.st_id
        and
            s.sale_code='".$sale_code."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }
?>

<body style="padding:20px;">
    <table width="100%">
        <tr>
            <td width="50%">
                <div style="font-family:Lao_classic3; font-size:24px;"><u>ລາຍການຂາຍສິນຄ້າ</u><br>
                </div>
                <label for="">ປະຈຳວັນທີ :<?php echo date("d-m-Y H:i:s",strtotime($rs->sale_date));?></label>
            </td>
            <td align="right">
                <div style="font-family:Lao_classic3; font-size:24px;"><u>ເລກທີຂາຍ :<?php echo $sale_code;?></u><br>
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
                    <label for="">ຊື່ລູກຄ້າ :<?php echo $rs->cus_name;?></label><br>
                    <label for="">ເບີໂທລະສັບ :<?php echo $rs->cus_phone;?></label><br>
                    <label for="">ຊື່ຜູ້ຕິດຕໍ່ :<?php echo $rs->cus_contact_name;?></label>
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" style="border: 1px solid grey; border-collapse: collapse; margin-left:2px; margin-top:4px;">
        <tr style="text-align:center; border: 1px solid grey; border-collapse: collapse;">
            <td width="30" style="border: 1px solid grey; border-collapse: collapse;">ລຳດັບ</td>
            <td width="100" style="border: 1px solid grey; border-collapse: collapse;">ລະຫັດສິນຄ້າ</td>
            <td style="border: 1px solid grey; border-collapse: collapse;">ລາຍລະອຽດສິນຄ້າ</td>
            <td width="90" style="border: 1px solid grey; border-collapse: collapse;">ໜ່ວຍນັບ</td>
            <td width="60" style="border: 1px solid grey; border-collapse: collapse;">ຈຳນວນ</td>
            <td width="80" style="border: 1px solid grey; border-collapse: collapse;">ລາຄາຂາຍ</td>
            <td width="90" style="border: 1px solid grey; border-collapse: collapse;">ມູນຄ່າຂາຍ</td>
        </tr>

        <?php
            $sql="select 
                    p.pro_code,
                    p.pro_name,
                    p.pro_detail,
                    u.un_name,
                    s.qty,
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

            ";

            $qry_pro=$conn->query($sql);
    
            if(mysqli_num_rows($qry_pro)>0){
                $n=1;
                $real_total=0;
                while($rs_pro=mysqli_fetch_object($qry_pro)){
                    $total=$rs_pro->qty*$rs_pro->sale_price;
                    $real_total+=$total;
        ?>

        <tr>
            <td style="border-right:grey 1px solid; text-align:center"><?php echo $n++;?></td>
            <td style="border-right:grey 1px solid;" align="center"><?php echo $rs_pro->pro_code;?></td>
            <td style="border-right:grey 1px solid;"><?php echo $rs_pro->pro_name." ".$rs_pro->pro_detail;?></td>
            <td style="border-right:grey 1px solid; text-align:center"><?php echo $rs_pro->un_name;?></td>
            <td style="border-right:grey 1px solid; text-align:center"><?php echo number_format($rs_pro->qty);?></td>
            <td style="border-right:grey 1px solid; text-align:right"><?php echo number_format($rs_pro->sale_price);?></td>
            <td style="border-right:grey 1px solid; text-align:right"><?php echo number_format($total);?></td>
        </tr>

        <?php }}?>

        <tr style="border-top:grey 1px solid;">
            <td colspan="4" valign="top">
            <label for="">ສາງຈັດເກັບ :<?php echo $rs->st_name;?></label><br>
            ໝາຍເຫດ :<?php echo $rs->sale_note;?></td>
            <td colspan="2" align="right" style="border-right:grey 1px solid;">
                <label for="">ມູນຄ່າຂາຍ :</label><br>
                <label for="">ສ່ວນລຸດ :</label><br>
                <label for="">ມູນຄ່າຂາຍຕົວຈິງ :</label>
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
            <td width="32%"><u>ເຊັນຊຳລະຄ່າສິນຄ້າ</u></td>
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