<?php include("em_modal.php");?>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
            <u><h4><i class="fas fa-id-card" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການພະນັກງານ</h4></u><hr>
            <form action="" method="post" id="myform">
                <input type="hidden" name="em_id" id="em_id">
                <table width="100%">
                    <tr>
                        <td width="160">ຊື່ພະນັກງານ :</td>
                        <td><input type="text" class="form-control" name="em_name" id="em_name"></td>
                    </tr>
                    <tr>
                        <td>ເບີໂທລະສັບ :</td>
                        <td><input type="text" class="form-control" name="em_phone" id="em_phone"></td>
                    </tr>
                    <tr>
                        <td>ສະຖານະການເຮັດວຽກ :</td>
                        <td>
                            <select name="is_leave" id="is_leave" class="form-control">
                                <option value="n">ພວມເຄື່ອນໄຫວ</option>
                                <option value="y">ອອກແລ້ວ</option>
                            </select>
                        </td>
                    </tr>
                </table><hr>

                <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                <button data-toggle="modal" data-target="#em_modal" type="button" class="btn btn-primary" id="nrhiav"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                <button onclick="ajax('em','mainpage');" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary " id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    $(document).ready(function(){
        $("#em_name").focus();
        $("#em_name").keydown(function(e){
            if(e.which==13){
                $("#em_phone").focus();
            }
        });
        $("#em_phone").keydown(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let em_id=$("#em_id").val();
            let em_name=$("#em_name").val();

            if(em_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }

            Swal.fire({
            title: '',
            text: "ທ່ານຕ້ອງການບັນທຶກລາຍການແມ່ນ ຫຼື ບໍ່?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"em_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('em','mainpage');
                    }
                })
            }
            })
        });
    });
</script>