<?php
    include("config.php");
    $sql="
        select *
        from tb_com
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $rs=mysqli_fetch_object($qry);
    }
?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">

            <u><h4><i class="fas fa-building" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ຂໍ້ມູນສຳນັກງານ</h4></u><hr>

            <form action="" method="post" id="myform">
                <table width="100%">
                    <tr>
                        <input value="<?php echo $rs->com_id;?>" type="hidden" name="com_id" id="com_id">
                        <td width="130">ຊື່ສຳນັກງານ :</td>
                        <td><input value="<?php echo $rs->com_name;?>" type="text" class="form-control" name="com_name" id="com_name"></td>
                    </tr>
                    <tr>
                        <td>ເບີໂທລະສັບ :</td>
                        <td><input type="text" value="<?php echo $rs->com_phone;?>" class="form-control" name="com_phone" id="com_phone"></td>
                    </tr>
                    <tr>
                        <td>ທີ່ຢູ່ :</td>
                        <td><input type="text" value="<?php echo $rs->com_address;?>" class="form-control" name="com_address" id="com_address"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                            <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                            <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

<script>
    $(document).ready(function(){
        $("#com_name").focus();
        $("#com_name").select();
        $("#com_name").keyup(function(e){
            if(e.which==13){
                $("#com_phone").focus();
            }
        });
        $("#com_phone").keyup(function(e){
            if(e.which==13){
                $("#com_address").focus();
            }
        });
        $("#com_address").keyup(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let com_name=$("com_name").val();
            let com_phone=$("com_phone").val();
            let com_address=$("com_address").val();

            if(com_name=="" || com_phone=="" || com_address==""){
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
                    url:"com_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                    Swal.fire({
                    title: '',
                    text: "ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    if (result.value) {
                        ajax('com','mainpage');
                    }
                    })
                        
                    }
                })
            }
            })
        });
    });
</script>