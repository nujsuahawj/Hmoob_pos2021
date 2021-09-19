<table width="100%" style="margin-top:10px;" class="table-hover">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="70">ລຳດັບ</td>
            <td>ລາຍຊື່ລູກຄ້າ</td>
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
                cus_id,
                cus_name,
                cus_phone,
                cus_contact_name,
                cus_address
            from tb_cus
                where cus_name like '%".$txt_search."%'
                and can_edit='y'
                order by cus_name
                limit 12
        ";

        $qry=$conn->query($sql);
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->cus_name;?></td>
        <td><?php echo $rs->cus_phone;?></td>
        <td><?php echo $rs->cus_contact_name;?></td>
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:100%"
            data-cus_id="<?php echo $rs->cus_id;?>"
            data-cus_name="<?php echo $rs->cus_name;?>"
            data-cus_phone="<?php echo $rs->cus_phone;?>"
            data-cus_contact_name="<?php echo $rs->cus_contact_name;?>"
            data-cus_address="<?php echo $rs->cus_address;?>"
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
            let cus_id=$(this).attr("data-cus_id");
            let cus_name=$(this).attr("data-cus_name");
            let cus_phone=$(this).attr("data-cus_phone");
            let cus_contact_name=$(this).attr("data-cus_contact_name");
            let cus_address=$(this).attr("data-cus_address");

            $("#cus_id").val(cus_id);
            $("#cus_name").val(cus_name);
            $("#cus_phone").val(cus_phone);
            $("#cus_contact_name").val(cus_contact_name);
            $("#cus_address").val(cus_address);
        });
    });
</script>