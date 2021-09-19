<?php include("sup_modal.php");?>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
            <u><h4><i class="fas fa-address-book" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການຜູ້ສະໜອງ</h4></u><hr>
        <form action="" id="myform" method="post">
            <input type="hidden" name="sup_id" id="sup_id">
                <table width="100%">
                    <tr>
                        <td width="110">ຊື່ຜູ້ສະໜອງ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="sup_name" id="sup_name"></td>
                    </tr>
                    <tr>
                        <td>ເບີໂທລະສັບ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="sup_phone" id="sup_phone"></td>
                    </tr>
                    <tr>
                        <td>ຊື່ຜູ້ຕິດຕໍ່ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="sup_contact_name" id="sup_contact_name"></td>
                    </tr>
                    <tr>
                        <td>ທີ່ຢູ່ :</td>
                        <td><input autocomplete="off" type="text" class="form-control" name="sup_address" id="sup_address"></td>
                    </tr>
                </table>
                <hr>
                
                <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                <button data-toggle="modal" data-target="#sup_modal" type="button" class="btn btn-primary"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                <button onclick="ajax('sup','mainpage');" type="button" class="btn btn-primary"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    $(document).ready(function(){
        $("#sup_name").focus();
        $("#sup_name").keydown(function(e){
            if(e.which==13){
                $("#sup_phone").focus();
            }
        });
        $("#sup_phone").keydown(function(e){
            if(e.which==13){
                $("#sup_contact_name").focus();
            }
        });
        $("#sup_contact_name").keydown(function(e){
            if(e.which==13){
                $("#sup_address").focus();
            }
        });
        $("#sup_address").keydown(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let sup_name=$("#sup_name").val();
            let sup_phone=$("#sup_phone").val();

            if(sup_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }
            if(sup_phone==""){
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
                    url:"sup_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('sup','mainpage');
                    }
                })
            }
            })
        });
    });
</script>