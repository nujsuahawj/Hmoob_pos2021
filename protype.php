<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/bynuj.css">
</head>
<body>
<?php include("protype_modal.php");?>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
        <u><h4><i class="fas fa-tags" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການປະເພດສິນຄ້າ</h4></u><hr>
            <form action="" method="post" id="myform">
                <input type="hidden" name="pt_id" id="pt_id">
                <label for="">ຊື່ປະເພດສິນຄ້າ</label>
                <input autocomplete="off" type="text" class="form-control" name="pt_name" id="pt_name"><hr>
                <button id="save" type="button" class="btn btn-primary "><i class="fas fa-save" ></i><br>ບັນທຶກລາຍການ</button>
                <button data-toggle="modal" data-target="#protype_modal" type="button" class="btn btn-primary" id="nrhiav"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                <button onclick="ajax('protype','mainpage');" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary " id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
            </form>

        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    $(document).ready(function(){
        $("#pt_name").focus();
        $("#save").click(function(){
            let pt_name=$("#pt_name").val();

            if(pt_name==""){
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
                    url:"protype_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","success");
                        ajax('protype','mainpage');
                    }
                })
            }
            })
        });
    });
</script>
</body>
</html>