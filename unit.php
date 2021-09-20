<?php include("unit_modal.php");?>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
           
            <u><h4><i class="fas fa-box" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການໜ່ວຍນັບ</h4></u><hr>
            <form action="" method="post" id="myform">
                <input type="hidden" name="un_id" id="un_id">
                <table width="100%">
                    <tr>
                        <td width="80%">ຊື່ໜ່ວຍນັບສິນຄ້າ</td>
                        <td>ຈຳນວນ</td>
                    </tr>
                    <tr>
                        <td><input autocomplete="off" type="text" class="form-control" name="un_name" id="un_name"></td>
                        <td><input autocomplete="off" type="text" class="form-control" 
                        value=1 onkeyup="dokeyup(this);" onchange="dokeyup(this);" 
                        onkeypress="checknumber();" name="un_qty" id="un_qty"
                        style="text-align:center;"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                            <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                            <button data-toggle="modal" data-target="#unit_modal" type="button" class="btn btn-primary" id="nrhiav"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                            <button onclick="ajax('unit','mainpage');" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                            <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary" id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    function dokeyup( obj ){
        var key = event.keyCode;
        if( key != 37 & key != 39 & key != 110 )
        {
        var value = obj.value;
        var svals = value.split( "." ); //แยกทศนิยมออก
        var sval = svals[0]; //ตัวเลขจำนวนเต็ม

        var n = 0;
        var result = "";
        var c = "";
        for ( a = sval.length - 1; a >= 0 ; a-- )
        {
        c = sval.charAt(a);
        if ( c != ',' )
        {
        n++;
        if ( n == 4 )
        {
        result = "," + result;
        n = 1;
        };
        result = c + result;
        };
        };

        if ( svals[1] )
        {
        result = result + '.' + svals[1];
        };

        obj.value = result;
        };
    };

        //ให้ text รับค่าเป็นตัวเลขอย่างเดียว
        function checknumber(){
            key = event.keyCode;
            if ( key != 46 & ( key < 48 || key > 57 ) )
            {
            event.returnValue = false;
            };
    };
    $(document).ready(function(){
        $("#un_name").focus();
        $("#un_name").keyup(function(e){
            if(e.which==13){
                $("#un_qty").focus();
            }
        });
        $("#un_qty").keyup(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let un_name=$("#un_name").val();
            let un_qty=$("#un_qty").val();

            if(un_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }
            if(un_qty=="" || un_qty<1){
                swal.fire("","ກະລຸນາລະບຸຈຳນວນໃຫ້ຖືກຕ້ອງກ່ອນ!!!","error");
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
                    url:"unit_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('unit','mainpage');
                    }
                })
            }
            })
        });
    });
</script>