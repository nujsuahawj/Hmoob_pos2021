<?php include("check_sale_list_modal.php");?>

<div style="background-color:white; margin-top:10px;">
    <table width="100%" width="100%" class='table-hover'>
        <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="170">ວັນທີຂາຍ</td>
            <td width="110">ເລກທີຂາຍ</td>
            <td>ລາຍຊື່ລູກຄ້າ</td>
            <td align="right" width="130">ຍອດຂາຍ</td>
            <td align="right" width="130">ສ່ວນລຸດ</td>
            <td align="right" width="130">ຍອດຂາຍຕົວຈິງ</td>
            <td width="140" style="padding-left:20px;">ຜູ້ບັນທຶກບັນຊີ</td>
            <td align="center" width="100">ເລືອກ?</td>
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
                    s.sale_date,
                    s.sale_code,
                    s.total,
                    s.total_dc,
                    c.cus_name,
                    u.us_name
                from tb_sale s,tb_cus c,tb_user u
                where s.cus_id=c.cus_id
                and s.us_id=u.us_id
                and date(s.sale_date) between '".$date_start."' and '".$date_end."'
                order by s.sale_date
            ";

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>

        <tr style="border-bottom: lightsteelblue 1px solid;">
            <td><?php echo $n++;?></td>
            <td><?php echo date("d-m-Y H:i:s",strtotime($rs->sale_date));?></td>
            <td><?php echo $rs->sale_code;?></td>
            <td><?php echo $rs->cus_name;?></td>
            <td align="right" ><?php echo number_format($rs->total);?></td>
            <td align="right" ><?php echo number_format($rs->total_dc);?></td>
            <td align="right" ><?php echo number_format($rs->total-$rs->total_dc);?></td>
            <td style="padding-left:20px;"><?php echo $rs->us_name;?></td>
            <td align="right">
                <button style="width:90px;" type="button" class="btn btn-primary 
                bt_this" data-sale_code="<?php echo $rs->sale_code;?>">
                    <i class="fas fa-check" style="margin-right:4px;"></i>ເລືອກ
                </button>
            </td>
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