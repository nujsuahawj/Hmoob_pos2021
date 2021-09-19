<?php include("check_buy_list_modal.php");?>
    <table width="100%" class='table-hover' style="margin-top: 10px;">
        <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="120">ເລກທີຊື້</td>
            <td width="170">ວັນທີຊື້</td>
            <td>ຊື້ຈາກຜູ້ສະໜອງ</td>
            <td width="140">ສາງຈັດເກັບ</td>
            <td width="130" align="right">ມູນຄ່າຊື້</td>
            <td width="130" align="right">ສ່ວນລຸດ</td>
            <td width="130" align="right">ມູນຄ່າຊື້ຕົວຈິງ</td>
            <td width="130" style="padding-left:20px;">ຜູ້ບັນທຶກບັນຊີ</td>
            <td width="130" align="center">ເລືອກ?</td>
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
                    b.buy_code,
                    b.buy_date,
                    s.sup_name,
                    st.st_name,
                    b.total,
                    b.total_dc,
                    u.us_name
                from
                    tb_buy b,
                    tb_sup s,
                    tb_stock st,
                    tb_user u
                where
                    b.sup_id=s.sup_id
                and
                    b.is_cancel='n'
                and 
                    b.st_id=st.st_id
                and b.us_id=u.us_id
                and 
                    date(b.buy_date) between '".$date_start."' and '".$date_end."'
            ";

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>
        <tr style="border-bottom: lightgrey 1px solid;">
            <td width="60"><?php echo $n++;?></td>
            <td><?php echo $rs->buy_code;?></td>
            <td><?php echo date("d-m-Y H:i:s",strtotime($rs->buy_date));?></td>
            <td><?php echo $rs->sup_name;?></td>
            <td><?php echo $rs->st_name;?></td>
            <td align="right"><?php echo number_format($rs->total);?></td>
            <td align="right"><?php echo number_format($rs->total_dc);?></td>
            <td align="right"><?php echo number_format($rs->total-$rs->total_dc);?></td>
            <td style="padding-left:20px;"><?php echo $rs->us_name;?></td>
            <td align="right">
                <button style="width:90px;" type="button" class="btn btn-primary bt_this"
                data-buy_code="<?php echo $rs->buy_code;?>">
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
            let buy_code=$(this).attr("data-buy_code");
            $.ajax({
                url:"check_buy_select_detail.php",
                type:"get",
                data:{buy_code:buy_code},
                success:function(data){
                    $("#modal_detail").html(data);
                    $("#check_buy_list_modal").modal("show");
                }
            })
        });
    });
</script>

