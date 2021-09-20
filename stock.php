<?php include("stock_modal.php");?>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
            <u><h4><i class="fas fa-building" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການສາງຈັດເກັບສິນຄ້າ</h4></u><hr>
            <form action="" method="post" id="myform">
                <input type="hidden" name="st_id" id="st_id">
                <label for="">ຊື່ສາງຈັດເກັບສິນຄ້າ</label>
                <input autocomplete="off" type="text" class="form-control" name="st_name" id="st_name"><hr>
                <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                <button data-toggle="modal" data-target="#stock_modal" type="button" class="btn btn-primary" id="nrhiav"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                <button onclick="ajax('stock','mainpage');" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary" id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    $(document).ready(function(){
        $("#st_name").focus();
        $("#save").click(function(){
            let st_name=$("#st_name").val();

            if(st_name==""){
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
                    url:"stock_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('stock','mainpage');
                    }
                })
            }
            })
        });
    });
</script>