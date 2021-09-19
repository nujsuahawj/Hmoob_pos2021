<div style="height:296px; overflow:auto;">
<u><h4>ປະຫວັດການຊຳລະໜີ້</h4></u>
<table class="table-hover table-bordered" width="100%">
    <thead>
    <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
        <td width="80">ລຳດັບ</td>
        <td width="160">ວັນທີຊຳລະ</td>
        <td width="100">ເລກທີຊື້</td>
        <td align="right" width="160">ຍອດຍົກມາ</td>
        <td align="right" width="160">ຍອດຊຳລະແລ້ວ</td>
        <td align="right" width="160" style="padding-right:20px;">ຍອດທີ່ຍັງເຫຼືອ</td>
        <td>ຜູ້ບັນທຶກບັນຊີ</td>
    </tr>
    </thead>
    <?php
        include("config.php");
        $buy_id="";

        if(isset($_REQUEST["buy_id"]))$buy_id=$_REQUEST["buy_id"];

        $sql="
            select p.*,b.buy_code
            from tb_paid_money p,tb_buy b
            where p.buy_id=b.buy_id
            and p.buy_id='".$buy_id."'
            order by p.paid_id asc
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>
    <tr style="border-bottom: lightgray 1px solid;">
        <td style="padding-top:6px;"><?php echo $n++;?></td>
        <td style="padding-top:6px;"><?php echo date("d-m-Y H:i:s",strtotime($rs->paid_date));?></td>
        <td style="padding-top:6px;"><?php echo $rs->buy_code;?></td>
        <td style="padding-top:6px;" align="right"><?php echo number_format($rs->t1,2);?></td>
        <td style="padding-top:6px;" align="right"><?php echo number_format($rs->t2,2);?></td>
        <td align="right" style="padding-right:20px; padding-top:6px;"><?php echo number_format($rs->t1-$rs->t2,2);?></td>
        <td><?php echo "ທ. ສູນທອນ ພິມມະສານ";?></td>
    </tr>
    <?php }}?>
</table>
</div>