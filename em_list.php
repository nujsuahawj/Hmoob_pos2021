<table width="100%" style="margin-top:10px;" class="table-hover">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="70">ລຳດັບ</td>
            <td>ລາຍຊື່ພະນັກງານ</td>
            <td width="170">ເບີໂທລະສັບ</td>
            <td width="170">ສະຖານະ</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");

        $sql="
            select
                em_id,
                em_name,
                em_phone,
                is_leave,
                case is_leave
                    when 'n' then 'ພວມເຄື່ອນໄຫວ'
                    when 'y' then 'ອອກແລ້ວ'
                end as my_leave
            from tb_em
                order by em_name
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->em_name;?></td>
        <td><?php echo $rs->em_phone;?></td>
        <td><?php echo $rs->my_leave;?></td>
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:100%"
            data-em_id="<?php echo $rs->em_id;?>"
            data-em_name="<?php echo $rs->em_name;?>"
            data-my_leave="<?php echo $rs->my_leave;?>"
            data-em_phone="<?php echo $rs->em_phone;?>"
            data-is_leave="<?php echo $rs->is_leave;?>"
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
            let em_id=$(this).attr("data-em_id");
            let em_name=$(this).attr("data-em_name");
            let em_phone=$(this).attr("data-em_phone");
            let is_leave=$(this).attr("data-is_leave");

            $("#em_id").val(em_id);
            $("#em_name").val(em_name);
            $("#em_phone").val(em_phone);
            $("#is_leave").val(is_leave);
        });
    });
</script>