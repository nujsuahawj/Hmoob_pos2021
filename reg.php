

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.5.0-dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.14.0-web/css/all.min.css">
    <script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
    <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.5.0-dist/js/sweetalert2.all.min.js"></script>
    <style>
        body{
            font-family: Lao_classic3;
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
<?php include("config.php");?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
        
        <center>
            <i style="font-size:100px; color:#0099ff; margin-bottom:20px;" class="fas fa-key"></i><br>
            <label for="" style="font-family:Lao_classic3; font-size:30px;"><u>ລົງທະບຽນເພື່ອນຳໃຊ້ໂປຣແກຣມ</u></label>
            <label for="">ໂປຣແກຣມບໍລິຫານການຂາຍ trading 2021v1</label><br>
            <label for="">ໂທລະສັບ: 020-98981414 ຫຼື 020-22622266</label><br>
            <label for="">ທ. ສູນທອນ ພິມມະສານ</label>
        </center>
        <hr>
        <table width="100%">
            <tr>
                <td width="150">ລະຫັດທີ່ຕ້ອງແຈ້ງ :</td>
                <td><input type="text" class="form-control" readonly name="reg_free" id="reg_free"
                value="<?php echo diskfreespace("D:")/1024;?>"></td>
            </tr>
            <tr>
                <td>ລະຫັດລົງທະບຽນ :</td>
                <td><input type="text" class="form-control" name="reg_num" id="reg_num"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                    <button id="reg" type="button" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-key" style="margin-right:6px;"></i>ລົງທະບຽນ
                    </button>
                </td>
            </tr>
        </table>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>

<script>
    $(document).ready(function(){
        $("#reg").click(function(){
            let reg_free=$("#reg_free").val();
            let reg_num=$("#reg_num").val();

            if(reg_num==""){
                swal.fire("","ກະລຸນາລະບຸລະຫັດລົງທະບຽນກ່ອນ!!!","error");
                return;
            }

            $.ajax({
                url:"reg_save.php",
                type:"post",
                data:{
                    reg_free:reg_free,
                    reg_num:reg_num
                },
                success:function(data){
                    if(data=="n"){
                        swal.fire("","ລະຫັດລົງທະບຽນບໍ່ຖືກຕ້ອງ!!!","error");
                    }else{
                        window.location="";
                    }
                }
            })
        });
    });
</script>
</body>
</html>

