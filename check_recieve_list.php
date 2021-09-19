<?php include("check_sale_list_modal.php");?>

<div style="background-color:white; margin-top:10px;">
    <table width="100%" width="100%" class='table-hover'>
        <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="170">ວັນທີຮັບຊຳລະ</td>
            <td width="110">ເລກທີຂາຍ</td>
            <td>ລາຍຊື່ລູກຄ້າ</td>
            <td align="right" width="130">ມູນຄ່າຮັບຊຳລະ</td>
            <td width="190" style="padding-left:20px;">ຜູ້ບັນທຶກບັນຊີ</td>
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
                    r.re_date,
                    s.sale_code,
                    c.cus_name,
                    r.t2,
                    u.us_name
                from tb_recieve_money r,tb_cus c,tb_sale s,tb_user u
                where s.cus_id=c.cus_id
                and r.sale_id=s.sale_id
                and r.us_id=u.us_id
                and date(r.re_date) between '".$date_start."' and '".$date_end."'
                order by r.re_date
            ";

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>

        <tr style="border-bottom: lightsteelblue 1px solid;">
            <td style="padding-top: 14px;"><?php echo $n++;?></td>
            <td style="padding-top: 14px;"><?php echo date("d-m-Y H:i:s",strtotime($rs->re_date));?></td>
            <td style="padding-top: 14px;"><?php echo $rs->sale_code;?></td>
            <td style="padding-top: 14px;"><?php echo $rs->cus_name;?></td>
            <td style="padding-top: 14px;" align="right"><?php echo number_format($rs->t2);?></td>
            <td style="padding-top: 14px; padding-left:20px;"><?php echo $rs->us_name;?></td>
        </tr>
        <?php }}?>
    </table>
</div>

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