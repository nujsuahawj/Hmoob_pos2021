<table width="100%" style="margin-top:10px;" class="table-hover table-bordered">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="70">ລຳດັບ</td>
            <td>ລາຍຊື່ປະເພດສິນຄ້າ</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");

        $sql="
            select
                pt_id,
                pt_name
            from tb_protype
                order by pt_name
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:#bfbfbf 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->pt_name;?></td>
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:100%"
            data-pt_id="<?php echo $rs->pt_id;?>"
            data-pt_name="<?php echo $rs->pt_name;?>"
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
            let pt_id=$(this).attr("data-pt_id");
            let pt_name=$(this).attr("data-pt_name");

            $("#pt_id").val(pt_id);
            $("#pt_name").val(pt_name);
        });
    });
</script>