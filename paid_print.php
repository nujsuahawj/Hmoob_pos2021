<?php
    include("config.php");
    $buy_code=$_REQUEST["buy_code"];

    $sql="
        select s.sup_name
        from tb_buy b,tb_sup s
        where buy_code='".$buy_code."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
        $sup_name=$rs->sup_name;
    }

    $sql_paid="
        select t1,t2
        from tb_paid_money
        where buy_id in(
            select buy_id
            from tb_buy
            where buy_code='".$buy_code."'
        )
        order by paid_id desc limit 1
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
        <label for="">ເລກທີຊື້</label><br>
            <?php echo $buy_code;?><br>
        <label for="">ຊຳລະໃຫ້ຜູ້ສະໜອງ</label><br>
            <?php echo $sup_name;?>
    </center>
    <table width="100%">
        <tr>
            <td width="70%">ຍອດຍົກມາ :</td>
            <td align="right"><?php echo number_format($t1);?></td>
        </tr>
        <tr>
            <td>ຊຳລະແລ້ວ :</td>
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