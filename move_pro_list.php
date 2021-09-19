<table width="100%" class="table-hover" style="margin-top:10px;" id="table_move_pro_list">
    <thead>
    <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="120">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="170">ໜ່ວຍຈັດເກັບ</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");
        $txt_search="";
        $cb_search="";
        $st_id_1="";

        if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];
        if(isset($_REQUEST["cb_search"]))$cb_search=$_REQUEST["cb_search"];
        if(isset($_REQUEST["st_id_1"]))$st_id_1=$_REQUEST["st_id_1"];

        $sql="
        select 
            p.pro_code,
            s.pro_id,
            p.pro_name,
            p.pro_detail,
            u.un_name,
            s.qty
        from tb_pro p,tb_unit u,tb_pro_in_stock s
            where s.st_id='".$st_id_1."'
            and p.pro_is_cancel='n'
            and u.un_id=p.un_id
            and p.pro_id=s.pro_id
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
            data-pro_id="<?php echo $rs->pro_id;?>"
            data-qty_in_stock="<?php echo $rs->qty;?>"
            data-pro_code="<?php echo $rs->pro_code;?>"
            data-pro_name="<?php echo $rs->pro_name;?>"
            data-un_name="<?php echo $rs->un_name;?>"
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
            let qty_in_stock=$(this).attr("data-qty_in_stock");
            let un_name=$(this).attr("data-un_name");

            $("#pro_id").val(pro_id);
            $("#pro_code").val(pro_code);
            $("#pro_name").val(pro_name);
            $("#un_name").val(un_name);
            $("#qty_in_stock").val(qty_in_stock);
        });
    });
</script>