<?php
    include("config.php");
    $sale_code=$_REQUEST["sale_code"];

    $sql="
        select s.cus_name
        from tb_sale b,tb_cus s
        where sale_code='".$sale_code."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        $cus_name=$rs->cus_name;
    }

    $sql_paid="
        select t1,t2
        from tb_recieve_money
        where sale_id in(
            select sale_id
            from tb_sale
            where sale_code='".$sale_code."'
        )
        order by re_id desc limit 1
    ";

    $qry_paid=$conn->query($sql_paid);
    if(mysqli_num_rows($qry_paid)>0){
        $rs_paid=mysqli_fetch_object($qry_paid);
        $t1=$rs_paid->t1;
        $t2=$rs_paid->t2;
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
        <label for="">ປະຈຳວັນທີ</label><br>
            <?php echo date("d-m-Y H:i:s");?><br>
        <label for="">ເລກທີຂາຍ</label><br>
            <?php echo $sale_code;?><br>
        <label for="">ຮັບຈາກລູກຄ້າ</label><br>
            <?php echo $cus_name;?>
    </center>
    <table width="100%">
        <tr>
            <td width="70%">ຍອດຍົກມາ :</td>
            <td align="right"><?php echo number_format($t1);?></td>
        </tr>
        <tr>
            <td>ຮັບຊຳລະແລ້ວ :</td>
            <td align="right"><?php echo number_format($t2);?></td>
        </tr>
        <tr>
            <td>ຍອດທີ່ຍັງຄ້າງ :</td>
            <td align="right"><?php echo number_format($t1-$t2);?></td>
        </tr>
        <tr>
            <td align="center" colspan="2"><u>ເຊັນຜູ້ຊຳລະ</u><br><br><br><br><u>ເຊັນຜູ້ຮັບຊຳລະ</u></td>
        </tr>
    </table>

    <script>
        window.print();
        setTimeout(window.close, 0);
    </script>

</body>
</html>