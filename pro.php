<?php include("pro_modal.php");?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
            <u><h4><i class="fas fa-coffee" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍການສິນຄ້າ</h4></u><hr>
        <form action="" id="myform" method="post">
            <input type="hidden" name="pro_id" id="pro_id">
                <div class="row">
                    <div class="col-sm-7">
                        <table width="100%">
                            <tr>
                                <td width="150">ລະຫັດສິນຄ້າ :</td>
                                <td><input autocomplete="off" type="text" class="form-control" name="pro_code" id="pro_code"></td>
                            </tr>
                            <tr>
                                <td>ຊື່ສິນຄ້າ :</td>
                                <td><input autocomplete="off" type="text" class="form-control" name="pro_name" id="pro_name"></td>
                            </tr>
                            <tr>
                                <td>ຊື່ສິນຄ້າ (ຊື່ຫຍໍ້) :</td>
                                <td><input autocomplete="off" type="text" class="form-control" name="pro_name_2" id="pro_name_2"></td>
                            </tr>
                            <tr>
                                <td>ລາຍລະອຽດ :</td>
                                <td><input autocomplete="off" type="text" class="form-control" name="pro_detail" id="pro_detail"></td>
                            </tr>
                            <tr>
                                <td>ປະເພດສິນຄ້າ :</td>
                                <td>
                                    <select name="pt_id" id="pt_id" class="form-control">
                                        <option value="">ລະບຸລາຍການ</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>ໜ່ວຍນັບ :</td>
                                <td>
                                    <select name="un_id" id="un_id" class="form-control">
                                        <option value="">ລະບຸລາຍການ</option>
                                    </select>
                                </td>
                            </tr>
                        </table>    
                    </div>
                    <div class="col-sm-5">
                        <table width="100%">
                            <tr>
                                <td width="170">ລາຄາຊື້ :</td>
                                <td>
                                    <input value=0 autocomplete="off" style="text-align:right" type="text" 
                                    onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                                    class="form-control" name="pro_buy_price" id="pro_buy_price">
                                </td>
                            </tr>
                            <tr>
                                <td>ລາຄາຂາຍໜ້າຮ້ານ :</td>
                                <td>
                                    <input value=0 autocomplete="off" style="text-align:right" type="text" 
                                    onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                                    class="form-control" name="pro_sale_price" id="pro_sale_price">
                                </td>
                            </tr>
                            <tr>
                                <td>ລາຄາຂາຍສົ່ງ :</td>
                                <td>
                                    <input value=0 autocomplete="off" style="text-align:right" type="text" 
                                    onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                                    class="form-control" name="pro_sale_price_2" id="pro_sale_price_2">
                                </td>
                            </tr>
                            <tr>
                                <td>ລາຄາຂາຍ VIP :</td>
                                <td>
                                    <input value=0 autocomplete="off" style="text-align:right" type="text" 
                                    onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                                    class="form-control" name="pro_sale_price_vip" id="pro_sale_price_vip">
                                </td>
                            </tr>
                            <tr>
                                <td>ຈຸດທີ່ຕ້ອງສັ່ງຊື້ :</td>
                                <td>
                                    <input value=0 autocomplete="off" style="text-align:right" type="text" 
                                    onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                                    class="form-control" name="pro_low_to_order" id="pro_low_to_order">
                                </td>
                            </tr>
                            <tr>
                                <td>ສະຖານະ :</td>
                                <td>
                                    <select name="pro_is_cancel" id="pro_is_cancel" class="form-control">
                                        <option value="n">ພວມເຄື່ອນໄຫວ</option>
                                        <option value="y">ຍົກເລີກລາຍການເຄື່ອນໄຫວ</option>
                                    </select>
                                </td>
                            </tr>
                        </table> 
                    </div>
                </div>

                <hr>

                <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                <button data-toggle="modal" data-target="#pro_modal" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
                <button onclick="ajax('pro','mainpage');" type="button" class="btn btn-primary" id="nrhiav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary" id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
            </form>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

<script>
    show_protype();
    show_unit();

    $(document).ready(function(){
        $("#pro_code").focus();
        $("#pro_code").keyup(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code").val();
                if(pro_code!=""){
                    $.ajax({
                        url:"pro_search_pro.php",
                        type:"get",
                        data:{pro_code:pro_code},
                        dataType:"json",
                        success:function(data){
                            $("#pro_id").val(data.pro_id);
                            // $("#pro_code").val(data.pro_code);
                            $("#pro_name").val(data.pro_name);
                            $("#pro_name_2").val(data.pro_name_2);
                            $("#pro_detail").val(data.pro_detail);
                            $("#pt_id").val(data.pt_id);
                            $("#un_id").val(data.un_id);
                            $("#pro_buy_price").val(data.pro_buy_price);
                            $("#pro_sale_price").val(data.pro_sale_price);
                            $("#pro_sale_price_2").val(data.pro_sale_price_2);
                            $("#pro_sale_price_vip").val(data.pro_sale_price_vip);
                            $("#pro_low_to_order").val(data.pro_low_to_order);
                            $("#pro_is_cancel").val(data.pro_is_cancel);
                            if($("#pro_id").val()>0){
                                $('#pro_code').prop('readonly', true);
                            }else{
                                $('#pro_code').prop('readonly', false);
                            }
                            $("#pro_name").focus();
                        }
                    })
                }
            }
        });
        $("#pro_name").keyup(function(e){
            if(e.which==13){
                $("#pro_name_2").focus();
            }
        });
        $("#pro_name_2").keyup(function(e){
            if(e.which==13){
                $("#pro_detail").focus();
            }
        });
        $("#pro_detail").keyup(function(e){
            if(e.which==13){
                $("#pro_buy_price").focus();
                $("#pro_buy_price").select();
            }
        });
        $("#pro_buy_price").keyup(function(e){
            if(e.which==13){
                $("#pro_sale_price").focus();
                $("#pro_sale_price").select();
            }
        });
        $("#pro_sale_price").keyup(function(e){
            if(e.which==13){
                $("#pro_sale_price_2").focus();
                $("#pro_sale_price_2").select();
            }
        });
        $("#pro_sale_price_2").keyup(function(e){
            if(e.which==13){
                $("#pro_sale_price_vip").focus();
                $("#pro_sale_price_vip").select();
            }
        });
        $("#pro_sale_price_vip").keyup(function(e){
            if(e.which==13){
                $("#pro_low_to_order").focus();
                $("#pro_low_to_order").select();
            }
        });
        $("#pro_low_to_order").keyup(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){

            let pro_code=$("#pro_code").val();
            let pro_name=$("#pro_name").val();
            let pro_name_2=$("#pro_name_2").val();
            let pro_buy_price=$("#pro_buy_price").val();
            let pro_sale_price=$("#pro_sale_price").val();
            let pro_sale_price_2=$("#pro_sale_price_2").val();
            let pro_sale_price_vip=$("#pro_sale_price_vip").val();
            let pro_low_to_order=$("#pro_low_to_order").val();
            let pt_id=$("#pt_id").val();
            let un_id=$("#un_id").val();
            
            if(pro_code=="" || pro_name=="" || pro_name_2==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }
            if(pt_id=="" || un_id==""){
                swal.fire("","ກະລຸນາລະບຸປະເພດສິນຄ້າ ແລະ ໜ່ວຍນັບກ່ອນ!!!","error");
                return;
            }
            if(pro_buy_price=="" || pro_sale_price=="" || pro_sale_price_2=="" || pro_sale_price_vip==""){
                swal.fire("","ກະລຸນາລະບຸລາຄາຊື້-ຂາຍໃຫ້ຄົບຖ້ວນກ່ອນ!!!","error");
                return;
            }
            if(pro_low_to_order==""){
                swal.fire("","ກະລຸນາລະບຸຈຸດທີ່ຕ້ອງສັ່ງຊື້ກ່ອນ!!!","error");
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
                    type: "post",
                    url: "pro_save.php",
                    data: $("#myform").serialize(),
                    success: function () {
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('pro','mainpage');
                    }
                });
            }
            })
        });
    });

    function dokeyup( obj )
        {
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
        function checknumber()
        {
        key = event.keyCode;
        if ( key != 46 & ( key < 48 || key > 57 ) )
        {
        event.returnValue = false;
        };
         };

    function show_protype(){
        $.ajax({
            url:"pro_protype.php",
            type:"get",
            dataType:"json",
            success:function(data){
                for(let i=0;i<data.length;i++){
                    $("#pt_id").append($("<option/>",{
                        value:data[i].pt_id,
                        text:data[i].pt_name
                    }));
                }
            }
        })
    }
    function show_unit(){
        $.ajax({
            url:"pro_unit.php",
            type:"get",
            dataType:"json",
            success:function(data){
                for(let i=0;i<data.length;i++){
                    $("#un_id").append($("<option/>",{
                        value:data[i].un_id,
                        text:data[i].un_name
                    }));
                }
            }
        })
    }
</script>