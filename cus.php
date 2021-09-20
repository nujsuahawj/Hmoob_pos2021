<?php include("cus_modal.php");?>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
        <form action="" id="myform" method="post">
            <u><h4><i class="fas fa-users" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການລູກຄ້າ</h4></u><hr>
            <input type="hidden" name="cus_id" id="cus_id">
                <table width="100%">
                    <tr>
                        <td width="110">ຊື່ລູກຄ້າ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="cus_name" id="cus_name"></td>
                    </tr>
                    <tr>
                        <td>ເບີໂທລະສັບ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="cus_phone" id="cus_phone"></td>
                    </tr>
                    <tr>
                        <td>ຊື່ຜູ້ຕິດຕໍ່ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="cus_contact_name" id="cus_contact_name"></td>
                    </tr>
                    <tr>
                        <td>ທີ່ຢູ່ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="cus_address" id="cus_address"></td>
                    </tr>
                </table><hr>
                
                <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                <button data-toggle="modal" data-target="#cus_modal" type="button" class="btn btn-primary" id="nrhiav"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                <button onclick="ajax('cus','mainpage');" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary " id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    $(document).ready(function(){
        $("#cus_name").focus();
        $("#cus_name").keydown(function(e){
            if(e.which==13){
                $("#cus_phone").focus();
            }
        });
        $("#cus_phone").keydown(function(e){
            if(e.which==13){
                $("#cus_contact_name").focus();
            }
        });
        $("#cus_contact_name").keydown(function(e){
            if(e.which==13){
                $("#cus_address").focus();
            }
        });
        $("#cus_address").keydown(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let cus_name=$("#cus_name").val();
            let cus_phone=$("#cus_phone").val();

            if(cus_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }
            if(cus_phone==""){
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
                    url:"cus_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('cus','mainpage');
                    }
                })
            }
            })
        });
    });
</script>