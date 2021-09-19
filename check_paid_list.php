<?php include("check_sale_list_modal.php");?>

<table width="100%" width="100%" class='table-hover' style="margin-top: 10px;">
    <thead>
    <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
        <td width="60">ລຳດັບ</td>
        <td width="170">ວັນທີຊຳລະ</td>
        <td width="110">ເລກທີຊື້</td>
        <td>ລາຍຊື່ຜູ້ສະໜອງ</td>
        <td align="right" width="130">ມູນຄ່າຊຳລະ</td>
        <td style="padding-left:20px;" width="190">ຜູ້ບັນທຶກບັນຊີ</td>
    </tr>
    </thead>

    <?php
        include("config.php");
        $date_start="";
        $date_end="";

        if(isset($_REQUEST["date_start"]))$date_start=$_REQUEST["date_start"];
        if(isset($_REQUEST["date_end"]))$date_end=$_REQUEST["date_end"];

        $sql="
            select
                p.paid_date,
                b.buy_code,
                s.sup_name,
                p.t2,
                u.us_name
            from tb_paid_money p,tb_sup s,tb_buy b,tb_user u
            where p.buy_id=b.buy_id
            and b.sup_id=s.sup_id
            and p.us_id=u.us_id
            and date(p.paid_date) between '".$date_start."' and '".$date_end."'
            order by p.paid_date, p.paid_id
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom: lightsteelblue 1px solid;">
        <td style="padding-top: 14px;"><?php echo $n++;?></td>
        <td style="padding-top: 14px;"><?php echo date("d-m-Y H:i:s",strtotime($rs->paid_date));?></td>
        <td style="padding-top: 14px;"><?php echo $rs->buy_code;?></td>
        <td style="padding-top: 14px;"><?php echo $rs->sup_name;?></td>
        <td style="padding-top: 14px;" align="right"><?php echo number_format($rs->t2);?></td>
        <td style="padding-top: 14px; padding-left:20px;"><?php echo $rs->us_name;?></td>
    </tr>
    <?php }}?>
</table>

<script>
    $(document).ready(function(){
        $(".bt_this").click(function(){
            let sale_code=$(this).attr("data-sale_code");
            $.ajax({
                url:"check_sale_list_detail.php",
                type:"get",
                data:{sale_code:sale_code},
                success:function(data){
                    $("#modal_detail").html(data);
                    $("#check_sale_list_modal").modal("show");
                }
            })
        });
    });
</script>