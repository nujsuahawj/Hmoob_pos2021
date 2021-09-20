<table width="100%" class="table-hover" style="margin-top:10px;">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="70">ລດ</td>
            <td width="130">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="140">ໜ່ວຍຈັດເກັບ</td>
            <td width="140" align="right" style="padding-right:20px;">ລາຄາຊື້</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");
        $txt_search="";
        $cb_search="";

        if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];
        if(isset($_REQUEST["cb_search"]))$cb_search=$_REQUEST["cb_search"];

        $sql="
            select
                p.*,
                u.un_name
            from 
                tb_pro p,
                tb_unit u
            where
                p.un_id=u.un_id
            and p.pro_is_cancel='n'
        ";

        if($cb_search=="pro_code"){
            $sql.=" 
                and p.pro_code like '%".$txt_search."%' 
                order by p.pro_code limit 12
            ";
        }elseif($cb_search=="pro_name"){
            $sql.=" 
                and p.pro_name like '%".$txt_search."%' 
                order by p.pro_name limit 12
            ";
        }

        $qry=$conn->query($sql);

        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->pro_code;?></td>
        <td>
            <?php echo $rs->pro_name." ".$rs->pro_detail;?>
        </td>
        <td><?php echo $rs->un_name;?></td>
        <td align="right" style="padding-right:20px;"><?php echo number_format($rs->pro_buy_price);?></td>
        
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:90px;"
            data-pro_id="<?php echo $rs->pro_id;?>"
            data-pro_code="<?php echo $rs->pro_code;?>"
            data-pro_name="<?php echo $rs->pro_name." ".$rs->pro_detail;?>"
            data-un_name="<?php echo $rs->un_name;?>"
            data-pro_buy_price="<?php echo number_format($rs->pro_buy_price);?>"
            data-dismiss="modal"
            >
            <i class="fas fa-check" style="margin-right:4px;"></i>ເລືອກ</button>
        </td>
    </tr>

    <?php }}?>
</table>

<script>
    $(document).ready(function(){
        $(".bt_this").click(function(){

            let pro_id=$(this).attr("data-pro_id");
            let pro_code=$(this).attr("data-pro_code");
            let pro_name=$(this).attr("data-pro_name");
            let un_name=$(this).attr("data-un_name");
            let pro_buy_price=$(this).attr("data-pro_buy_price");
            let st_id=$("#st_id").val();

            $("#pro_id").val(pro_id);
            $("#pro_code").val(pro_code);
            $("#pro_name").val(pro_name);
            $("#un_name").val(un_name);
            $("#buy_price").val(pro_buy_price);
            $("#qty").focus();

            cal_total();
            cal_qty(pro_id,st_id);

            if($("#barcode").is(':checked')){
                add_data();
                clear_pro();
            }
        });
    });
</script>