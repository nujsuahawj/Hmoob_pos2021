<table width="100%" style="margin-top:10px;" class="table-hover">
    <thead>
    <tr style="border-top:#00ace6 4px solid;border-radius:8px; border-bottom:lightgrey 1px solid;">
            <td width="70">ລຳດັບ</td>
            <td>ຊື່</td>
            <td width="150">ຈຳນວນ</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");
        $txt_search="";

        if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];

        $sql="
            select
                un_id,
                un_name,
                un_qty
            from tb_unit
                where un_name like '%".$txt_search."%'
                order by un_name
                limit 12
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->un_name;?></td>
        <td style="padding-right:40px;" align="right"><?php echo number_format($rs->un_qty);?></td>
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:100%"
            data-un_id="<?php echo $rs->un_id;?>"
            data-un_name="<?php echo $rs->un_name;?>"
            data-un_qty="<?php echo number_format($rs->un_qty);?>"
            data-dismiss="modal"
            >
            <i class="fas fa-check" style="margin-right:6px;"></i>ເລືອກ</button>
        </td>
    </tr>

    <?php }}?>
</table>

<script>
    $(document).ready(function(){
        $(".bt_this").click(function(){
            let un_id=$(this).attr("data-un_id");
            let un_name=$(this).attr("data-un_name");
            let un_qty=$(this).attr("data-un_qty");

            $("#un_id").val(un_id);
            $("#un_name").val(un_name);
            $("#un_qty").val(un_qty);
        });
    });
</script>