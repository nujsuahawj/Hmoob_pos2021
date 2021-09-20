<table width="100%" style="margin-top:10px;" class="table-hover">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="70">ລດ</td>
            <td>ລາຍຊື່</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");

        $sql="
            select
                st_id,
                st_name
            from tb_stock
                where st_can_edit='y'
                order by st_name
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->st_name;?></td>
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:100%"
            data-st_id="<?php echo $rs->st_id;?>"
            data-st_name="<?php echo $rs->st_name;?>"
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
            let st_id=$(this).attr("data-st_id");
            let st_name=$(this).attr("data-st_name");

            $("#st_id").val(st_id);
            $("#st_name").val(st_name);
        });
    });
</script>