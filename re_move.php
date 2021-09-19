<?php include("re_move_modal.php");?>

<div class="row">
    <div class="col-sm-12">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <div class="row">
                <div class="col-sm-10">
                    <u><h4>ລາຍການທີ່ພວມເຄື່ອນຍ້າຍ</h4></u>
                </div>
                <div class="col-sm-2">
                    <button style="width:90px;" onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt" style="margin-right:4px;"></i>ອອກ</button>
                </div>

            </div>

            <table width="100%" class="table-hover" style="margin-top:10px;">
                <thead>
                <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                    <td width="60">ລຳດັບ</td>
                    <td width="130">ເລກທີເຄື່ອນຍ້າຍ</td>
                    <td width="170">ວັນທີເຄື່ອນຍ້າຍ</td>
                    <td width="130">ເຄື່ອນຍ້າຍຈາກ</td>
                    <td width="220">ພະນັກງານທີ່ເຄື່ອນຍ້າຍ</td>
                    <td>ໝາຍເຫດ</td>
                    <td width="140">ຜູ້ບັນທຶກບັນຊີ</td>
                    <td width="160"></td>
                </tr>
                </thead>
                <!-- SELECT `mov_id`, ``, ``, ``, `st_id_2`, `em_id`, ``, `mov_note`, `` FROM `tb_move` WHERE 1
             -->
                <?php
                    include("config.php");
                    $sql="
                        select
                            m.mov_code,
                            s.st_name,
                            m.st_id_2,
                            e.em_name,
                            m.mov_note,
                            u.us_name,
                            m.mov_date
                        from tb_move m,tb_em e,tb_stock s,tb_user u
                        where m.st_id_1=s.st_id
                        and m.em_id=e.em_id
                        and m.us_id=u.us_id
                        and m.is_recieve='n'
                    ";

                    $qry=$conn->query($sql);
                    if(mysqli_num_rows($qry)>0){
                        $n=1;
                        while($rs=mysqli_fetch_object($qry)){
                ?>
                <tr style="border-bottom:1px solid #bfbfbf;">
                    <td><?php echo $n++;?></td>
                    <td><?php echo $rs->mov_code;?></td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($rs->mov_date));?></td>
                    <td><?php echo $rs->st_name;?></td>
                    <td><?php echo $rs->em_name;?></td>
                    <td><?php echo $rs->mov_note;?></td>
                    <td><?php echo $rs->us_name;?></td>
                    <td width="180">
                        <div class="btn-group float-right" role="group">
                            <button type="button" class="btn btn-info bt_this"
                            data-mov_code="<?php echo $rs->mov_code;?>"
                            style="width:100%;">
                            ເລືອກ
                            </button>
                            <button type="button" class="btn btn-primary save" 
                            data-mov_code="<?php echo $rs->mov_code;?>"
                            data-st_id_2="<?php echo $rs->st_id_2;?>"
                            style="width:100%;">
                            ບັນທຶກ
                            </button>
                        </div>
                    </td>
                </tr>
                <?php }}?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".bt_this").click(function(){
            let mov_code=$(this).attr("data-mov_code");
            $.ajax({
                url:"re_move_select_detail.php",
                type:"get",
                data:{mov_code:mov_code},
                success:function(data){
                    $("#modal_detail").html(data);
                    $("#re_move_modal").modal("show");
                }
            })
        });
        $(".save").click(function(){
            let mov_code=$(this).attr("data-mov_code");
            let st_id_2=$(this).attr("data-st_id_2");
            
            Swal.fire({
            title: '',
            text: "ຕ້ອງການບັນທຶກລາຍການເລກທີ: "+mov_code+" ແມ່ນ ຫຼື ບໍ່?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"re_move_save.php",
                    type:"post",
                    data:{
                        mov_code:mov_code,
                        st_id_2:st_id_2
                    },
                    success:function(){
                        swal.fire("","ບັນທຶກລາຍການສຳເລັດແລ້ວ!!!","success");
                        ajax('re_move','mainpage');
                    }
                })
            }
            })

        });
    });
</script>