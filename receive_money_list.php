<?php
    include("config.php");
    $sale_id="";
    if(isset($_REQUEST["sale_id"]))$sale_id=$_REQUEST["sale_id"];

    $sql="
        select
            r.re_date,
            r.t1,
            r.t2,
            r.us_id,
            s.sale_code
        from tb_recieve_money r,tb_sale s
        where 
            r.sale_id='".$sale_id."'
        and
            r.sale_id=s.sale_id
    ";
    
    $qry=$conn->query($sql);
?>

<div class="row">
    <div class="col-sm-12">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <h4><u>ປະຫວັດການຮັບຊຳລະໜີ້</u></h4>    
            <table width="100%" class="table-hover">
                <thead>
                <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                        <td width="70">ລຳດັບ</td>
                        <td width="180">ວັນທີຮັບຊຳລະ</td>
                        <td width="110">ເລກທີຂາຍ</td>
                        <td width="140" align="right">ຍອດຍົກມາ</td>
                        <td width="140" align="right">ຮັບຊຳລະແລ້ວ</td>
                        <td width="140" align="right" style="padding-right:10px;">ຍອດເຫຼືອ</td>
                        <td style="padding-left:20px;">ຜູ້ບັນທຶກບັນຊີ</td>
                    </tr>
                </thead>
                <?php
                    if(mysqli_num_rows($qry)>0){
                        $n=1;
                        while($rs=mysqli_fetch_object($qry)){
                ?>
                <tr style="border-bottom:lightgray 1px solid;">
                    <td style="padding-top:5px; padding-bottom:5px;"><?php echo $n++;?></td>
                    <td style="padding-top:5px; padding-bottom:5px;"><?php echo date("d-m-Y H:i:s",strtotime($rs->re_date));?></td>
                    <td style="padding-top:5px; padding-bottom:5px;"><?php echo $rs->sale_code;?></td>
                    <td style="padding-top:5px; padding-bottom:5px;" align="right"><?php echo number_format($rs->t1);?></td>
                    <td style="padding-top:5px; padding-bottom:5px;" align="right"><?php echo number_format($rs->t2);?></td>
                    <td style="padding-top:5px; padding-bottom:5px; padding-right:10px;" align="right"><?php echo number_format($rs->t1-$rs->t2);?></td>
                    <td style="padding-top:5px; padding-bottom:5px; padding-left:20px;"><?php echo "ທ. ສູນທອນ ພິມມະສານ";?></td>
                </tr>
                <?php }}?>
            </table>
        </div>
    </div>
</div>