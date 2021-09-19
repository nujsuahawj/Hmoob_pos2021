<table width="100%" style="margin-top:10px;" class="table-hover">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="70">ລຳດັບ</td>
            <td>ລາຍຊື່ຜູ້ສະໜອງ</td>
            <td width="200">ໝາຍເລກໂທລະສັບ</td>
            <td width="250">ລາຍຊື່ຜູ້ຕິດຕໍ່</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");
        $txt_search="";

        if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];

        $sql="
            select
                sup_id,
                sup_name,
                sup_phone,
                sup_contact_name,
                sup_address
            from tb_sup
                where sup_name like '%".$txt_search."%'
                order by sup_name
                limit 12
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->sup_name;?></td>
        <td><?php echo $rs->sup_phone;?></td>
        <td><?php echo $rs->sup_contact_name;?></td>
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:100%"
            data-sup_id="<?php echo $rs->sup_id;?>"
            data-sup_name="<?php echo $rs->sup_name;?>"
            data-sup_phone="<?php echo $rs->sup_phone;?>"
            data-sup_contact_name="<?php echo $rs->sup_contact_name;?>"
            data-sup_address="<?php echo $rs->sup_address;?>"
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
            let sup_id=$(this).attr("data-sup_id");
            let sup_name=$(this).attr("data-sup_name");
            let sup_phone=$(this).attr("data-sup_phone");
            let sup_contact_name=$(this).attr("data-sup_contact_name");
            let sup_address=$(this).attr("data-sup_address");

            $("#sup_id").val(sup_id);
            $("#sup_name").val(sup_name);
            $("#sup_phone").val(sup_phone);
            $("#sup_contact_name").val(sup_contact_name);
            $("#sup_address").val(sup_address);
        });
    });
</script>