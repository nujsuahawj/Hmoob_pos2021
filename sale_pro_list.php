<table width="100%" class="table-hover" style="margin-top:10px;" id="sale_pro_list">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="120">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="170">ໜ່ວຍຈັດເກັບ</td>
            <td width="120" align="right" style="padding-right:20px;">ລາຄາຂາຍສົ່ງ</td>
            <td width="120" align="right" style="padding-right:20px;">ລາຄາ vip</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");
        $txt_search="";
        $cb_search="";
        $st_id="";

        if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];
        if(isset($_REQUEST["cb_search"]))$cb_search=$_REQUEST["cb_search"];
        if(isset($_REQUEST["st_id"]))$st_id=$_REQUEST["st_id"];

        $sql="
            select
                p.pro_id,
                p.pro_code,
                p.pro_name,
                p.pro_detail,
                u.un_name,
                p.pro_sale_price_2,
                p.pro_sale_price_vip,
                s.qty
            from 
                tb_pro p,
                tb_unit u,
                tb_pro_in_stock s
            where
                p.un_id=u.un_id
            and s.pro_id=p.pro_id
            and s.st_id='".$st_id."'
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
        <td align="right" style="padding-right:20px;"><?php echo number_format($rs->pro_sale_price_2);?></td>
        <td align="right" style="padding-right:20px;"><?php echo number_format($rs->pro_sale_price_vip);?></td>
        
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:90px;"
            data-pro_id="<?php echo $rs->pro_id;?>"
            data-pro_code="<?php echo $rs->pro_code;?>"
            data-pro_name="<?php echo $rs->pro_name." ".$rs->pro_detail;?>"
            data-un_name="<?php echo $rs->un_name;?>"
            data-sale_price="<?php echo number_format($rs->sale_price);?>"
            data-qty_in_stock="<?php echo number_format($rs->qty);?>"
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
            let st_id=$("#st_id").val();
            let price_type=$("#price_type").val();

                if(pro_code!=""){
                    $.ajax({
                    url:"sale_search_pro.php",
                    type:"get",
                    data:{
                        pro_code:pro_code,
                        st_id:st_id,
                    },
                    dataType:"json",
                    success:function(data){
                        $("#pro_id").val(data.pro_id);
                        let pro_id=$("#pro_id").val();
                        $("#pro_code").val(data.pro_code);
                        $("#pro_name").val(data.pro_name+"-"+data.pro_detail);
                        $("#un_name").val(data.un_name);
                        $("#qty_in_stock").val(data.qty);

                        if(price_type=="normal"){
                            $("#sale_price").val(data.pro_sale_price_2);
                        }else if(price_type=="vip"){
                            $("#sale_price").val(data.pro_sale_price_vip);
                        }

                        $("#qty").focus();
                        $("#qty").select();
                        cal_total();
                        // cal_qty(pro_id,st_id);

                        if($("#barcode").is(':checked')){
                            add_data();
                            clear_pro();
                        }
                        
                    }
                })
                }
        });
    });
</script>