<?php include("user_modal.php");?>

<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
                <u><h4><i class="fas fa-user-check" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ຈັດການຜູ້ນຳໃຊ້ລະບົບ</h4></u><hr>
        
                <form action="" method="post" id="myform">
                    <table width="100%">
                        <tr>
                            <td width="170">user name :</td>
                            <input type="hidden" name="us_id" id="us_id">
                            <td><input type="text" class="form-control" name="us_name" id="us_name"></td>
                            <td width="40"><button data-toggle="modal" data-target="#user_modal" style="width:100%;" type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></td>
                        </tr>
                        <tr>
                            <td>password :</td>
                            <td><input type="password" class="form-control" name="us_pass" id="us_pass"></td>
                        </tr>
                        <tr>
                            <td>confirm password :</td>
                            <td><input type="password" class="form-control" name="us_pass_2" id="us_pass_2"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-top:10px;"><input type="checkbox" style="cursor:pointer; margin-right: 6px;" name="is_cancel" id="is_cancel" value="y">ຍົກເລີກການນຳໃຊ້</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr>
                                <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                                <button onclick="ajax('user_add','mainpage');" type="button" class="btn btn-primary"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
                            </td>
                        </tr>
                    </table>
                </form>
        </div>
    <div class="col-sm-4"></div>
</div>  

<script>
    $(document).ready(function(){
        $("#us_name").focus();
        $("#us_name").keyup(function(e){
            if(e.which==13){
                $("#us_pass").focus();
            }
        });
        $("#us_pass").keyup(function(e){
            if(e.which==13){
                $("#us_pass_2").focus();
            }
        });
        $("#us_pass_2").keyup(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let us_name=$("#us_name").val();
            let us_pass=$("#us_pass").val();
            let us_pass_2=$("#us_pass_2").val();

            if(us_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }
            if(us_pass!=us_pass_2){
                swal.fire("","ກະລຸນາລະບຸລະຫັດຜ່ານໃຫ້ຖືກຕ້ອງກ່ອນ!!!","error");
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
            cancelButtonText: 'Ok'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"user_add_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('user_add','mainpage');
                    }
                })
            }
            })
        });
    });
</script>