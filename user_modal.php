

<!-- Modal -->
<div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="padding:10px;">
            <div class="row">
                <div class="col-sm-9">
                    <u><h4><i class="fas fa-list-ol" style="margin-right:6px;"></i> ລາຍຊື່ຜູ້ນຳໃຊ້ລະບົບ</h4></u>
                </div>
                <div class="col-sm-3">
                    <button type="button" data-dismiss="modal" class="btn btn-primary float-right" style="width:90px;"><i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>ອອກ</button>
                </div>
            </div>

            <table width="100%" style="margin-top:10px;" class="table-hover">
                <thead>
                    <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                        <td>ລາຍຊື່ຜູ້ນຳໃຊ້ລະບົບ</td>
                        <td width="90">ເລືອກ?</td>
                    </tr>
                </thead>
                <?php
                    include("config.php");
                    $sql="
                        select us_id,us_name
                        from tb_user
                        where is_cancel='n'
                        and us_name<>'admin'
                    ";
                    $qry=$conn->query($sql);
                    if(mysqli_num_rows($qry)>0){
                        $n=1;
                        while($rs=mysqli_fetch_object($qry)){
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $rs->us_name;?></td>
                        <td>
                            <button style="width:100%;" type="button" class="btn btn-primary bt_this"
                            data-us_id="<?php echo $rs->us_id;?>"
                            data-us_name="<?php echo $rs->us_name;?>"
                            data-dismiss="modal"
                            >
                                <i class="fas fa-check" style="margin-right:6px;"></i>ເລືອກ
                            </button>
                        </td>
                    </tr>
                </tbody>
                <?php }}?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".bt_this").click(function(){
            $("#us_name").val($(this).attr("data-us_name"));
            $("#us_id").val($(this).attr("data-us_id"));
            $('#us_name').prop('readonly', true);
        });
    });
</script>