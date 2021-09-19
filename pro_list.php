<table width="100%" class="table-hover" style="margin-top:10px;">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="80">ລຳດັບ</td>
            <td width="140">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="170">ໜ່ວຍຈັດເກັບ</td>
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
        
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:90px;"
            data-pro_id="<?php echo $rs->pro_id?>"
            data-pro_code="<?php echo $rs->pro_code?>"
            data-pro_name="<?php echo $rs->pro_name?>"
            data-pro_name_2="<?php echo $rs->pro_name_2?>"
            data-pro_detail="<?php echo $rs->pro_detail?>"
            data-pt_id="<?php echo $rs->pt_id?>"
            data-un_id="<?php echo $rs->un_id?>"
            data-pro_buy_price="<?php echo number_format($rs->pro_buy_price);?>"
            data-pro_sale_price="<?php echo number_format($rs->pro_sale_price);?>"
            data-pro_sale_price_2="<?php echo number_format($rs->pro_sale_price_2);?>"
            data-pro_sale_price_vip="<?php echo number_format($rs->pro_sale_price_vip);?>"
            data-pro_low_to_order="<?php echo number_format($rs->pro_low_to_order);?>"
            data-pro_is_cancel="<?php echo $rs->pro_is_cancel?>"
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
            let pro_name_2=$(this).attr("data-pro_name_2");
            let pro_detail=$(this).attr("data-pro_detail");
            let pt_id=$(this).attr("data-pt_id");
            let un_id=$(this).attr("data-un_id");
            let pro_buy_price=$(this).attr("data-pro_buy_price");
            let pro_sale_price=$(this).attr("data-pro_sale_price");
            let pro_sale_price_2=$(this).attr("data-pro_sale_price_2");
            let pro_sale_price_vip=$(this).attr("data-pro_sale_price_vip");
            let pro_low_to_order=$(this).attr("data-pro_low_to_order");
            let pro_is_cancel=$(this).attr("data-pro_is_cancel");

            $("#pro_id").val(pro_id);
            $("#pro_code").val(pro_code);
            $("#pro_name").val(pro_name);
            $("#pro_name_2").val(pro_name_2);
            $("#pro_detail").val(pro_detail);
            $("#pt_id").val(pt_id);
            $("#un_id").val(un_id);
            $("#pro_buy_price").val(pro_buy_price);
            $("#pro_sale_price").val(pro_sale_price);
            $("#pro_sale_price_2").val(pro_sale_price_2);
            $("#pro_sale_price_vip").val(pro_sale_price_vip);
            $("#pro_low_to_order").val(pro_low_to_order);
            $("#pro_is_cancel").val(pro_is_cancel);
            $('#pro_code').prop('readonly', true);

        });
    });
</script>