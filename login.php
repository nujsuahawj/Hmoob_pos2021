<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: #f2f2f2;
            font-family: Phetsarath OT;
        }
        .form-control:focus{
            border:#0099cc 1px solid;
            box-shadow: 0 0 #0099cc;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
                            <center>
                                <i class="fas fa-user-circle" style="font-size: 100px; color:#0099cc;"></i>
                                <h1><u>ເຂົ້າສູ່ລະບົບ</u></h1><hr>
                            </center>
                            <table width="100%">
                                <tr>
                                    <td>ຊື່ຜູ້ໃຊ້ :</td>
                                    <td><input autocomplete="off" type="text" class="form-control" name="us_name" id="us_name"></td>
                                </tr>
                                <tr>
                                    <td>ລະຫັດຜ່ານ :</td>
                                    <td><input autocomplete="off" type="password" class="form-control" name="us_pass" id="us_pass"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr>
                                        <button type="button" id="login" class="btn btn-primary" style="width:100%;"><i class="fas fa-key" style="margin-right:6px;"></i>ເຂົ້າສູ່ລະບົບ</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>

    <script>
        $(Document).ready(function(){
            $("#us_name").focus();
            $("#us_name").keyup(function(e){
                if(e.which==13){
                    $("#us_pass").focus();
                }
            });
            $("#us_pass").keyup(function(e){
                if(e.which==13){
                    $("#login").focus();
                }
            });
            $("#login").click(function(){
                let us_name=$("#us_name").val();
                let us_pass=$("#us_pass").val();

                if(us_name=="" || us_pass==""){
                    swal.fire("","ກະລຸນາລະບຸຂໍ້ມູນກ່ອນ!!!","error");
                    return;
                }
                $.ajax({
                    url:"login_check.php",
                    type:"get",
                    data:{
                        us_name:us_name,
                        us_pass:us_pass
                    },
                    success:function(data){
                        if(data=="n"){
                            swal.fire("","ທ່ານລະບຸຂໍ້ມູນບໍ່ຖືກຕ້ອງ!!!","error");
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
