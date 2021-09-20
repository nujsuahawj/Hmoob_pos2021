<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:50px; background-color:white;">
        <u><h4>ລາຍການແຍກຍ່ອຍສິນຄ້າ</h4></u>
        <hr>

            <table width="100%">
                <tr>
                    <td width="150">ສາງຈັດເກັບສິນຄ້າ :</td>
                    <td>
                        <select name="st_id" id="st_id" class="form-control"
                        onchange="clear_all_data();">
                            <option value="">ລະບຸລາຍການ</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="170">ລະຫັດສິນຄ້າ :</td>
                    <input type="hidden" name="pro_id" id="pro_id">
                    <input type="hidden" name="pro_id_2" id="pro_id_2">
                    <input autocomplete="off" type="hidden" class="form-control"
                    value=0 onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                    name="qty_4" id="qty_4">
                    <td><input autocomplete="off" type="text" class="form-control" name="pro_code" id="pro_code"></td>
                </tr>
                <tr>
                    <td>ລາຍລະອຽດສິນຄ້າ :</td>
                    <td><input autocomplete="off" type="text" readonly class="form-control" name="pro_name" id="pro_name"></td>
                </tr>
                <tr>
                    <td>ໜ່ວຍນັບ :</td>
                    <td><input autocomplete="off" type="text" readonly class="form-control" name="un_name" id="un_name"></td>
                </tr>
                <tr>
                    <td>ຈຳນວນຄ້າງສາງ :</td>
                    <td><input readonly autocomplete="off" type="text" class="form-control"
                    value=0 onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                    name="qty" id="qty"></td>
                </tr>
                <tr>
                    <td>ຈຳນວນແຍກຍ່ອຍ :</td>
                    <td><input value="1" autocomplete="off" type="text" class="form-control"
                    onkeyup="dokeyup(this);" onchange="dokeyup(this);" onkeypress="checknumber();"
                    name="qty_2" id="qty_2"></td>
                </tr>
                <tr>
                    <td>ລະຫັດສິນຄ້າຍ່ອຍ :</td>
                    <td><input autocomplete="off" type="text" class="form-control" name="pro_code_2" id="pro_code_2"></td>
                </tr>
                <tr>
                    <td>ຊື່ສິນຄ້າຍ່ອຍ :</td>
                    <td><input autocomplete="off" type="text" class="form-control" readonly name="pro_name_2" id="pro_name_2"></td>
                </tr>
                <tr>
                    <td>ໜ່ວຍນັບຍ່ອຍ :</td>
                    <td><input autocomplete="off" type="text" class="form-control" readonly name="un_name_2" id="un_name_2"></td>
                </tr>
                <tr>
                    <td>ຈຳນວນທີ່ຍັງຄ້າງຍ່ອຍ :</td>
                    <td><input autocomplete="off" type="text" class="form-control" readonly name="qty_in_stock_2" id="qty_in_stock_2"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
                        <button onclick="ajax('my_explode','mainpage');" type="button" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
                        <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary" id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
    show_stock();

    $(document).ready(function(){
        $("#pro_code").keyup(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code").val();
                let st_id=$("#st_id").val();

                if(pro_code!=""){
                    cal_qty(pro_code,st_id);
                }
            }
        });
        $("#pro_code_2").keyup(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code_2").val();
                let st_id=$("#st_id").val();

                if(pro_code!=""){
                    cal_qty_2(pro_code,st_id);
                }
            }
        });
        $("#save").click(function(){
            let st_id=$("#st_id").val();
            let pro_id=$("#pro_id").val();
            let pro_id_2=$("#pro_id_2").val();
            let pro_name=$("#pro_name").val();
            let pro_code=$("#pro_code").val();
            let pro_name_2=$("#pro_name").val();
            let pro_code_2=$("#pro_code").val();
            let qty=$("#qty").val();
            let qty_2=$("#qty_2").val();
            let qty_4=$("#qty_4").val();
            let qty_in_stock_2=$("#qty_in_stock_2").val();

            qty=parseFloat(qty.replace(/,/g,""));
            qty_2=parseFloat(qty_2.replace(/,/g,""));
            qty_4=parseFloat(qty_4.replace(/,/g,""));
            qty_in_stock_2=parseFloat(qty_in_stock_2.replace(/,/g,""));

            if(st_id==""){
                swal.fire("","ກະລຸນາລະບຸສາງຈັດເກັບສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(pro_id=="" || pro_code=="" || pro_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(pro_id_2=="" || pro_code_2=="" || pro_name_2==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າຍ່ອຍກ່ອນ!!!","error");
                return;
            }
            if(parseInt(qty_2)>parseInt(qty)){
                swal.fire("","ກະລຸນາລະບຸຈຳນວນບໍ່ຖືກຕ້ອງ!!!","error");
                return;
            }
            Swal.fire({
            title: '',
            text: "ທ່ານຕ້ອງການບັນທຶກລາຍການແມ່ນ ຫຼື ບໍ່?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"my_explode_save.php",
                    type:"post",
                    data:{
                        pro_id:pro_id,
                        pro_id_2:pro_id_2,
                        st_id:st_id,
                        qty:qty,
                        qty_2:qty_2,
                        qty_4:qty_4,
                        qty_in_stock_2:qty_in_stock_2
                    },
                    success:function(){
                        swal.fire("","ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!","success");
                        ajax('my_explode','mainpage');
                    }
                })
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

    function clear_all_data(){
        $("#pro_id_2").val("");
        $("#pro_name_2").val("");
        $("#qty_in_stock_2").val("");
        $("#un_name_2").val("");
        $("#qty_in_stock_2").val(0);
        $("#pro_id").val("");
        $("#pro_name").val("");
        $("#qty").val(0);
        $("#un_name").val("");
        $("#pro_code").val("");
        $("#pro_code_2").val("");
    }

    function cal_qty_2(pro_code,st_id){
        $.ajax({
            url:"my_ex_plode_search_qty.php",
            type:"get",
            data:{
                pro_code:pro_code,
                st_id:st_id
            },
            dataType:"json",
            success:function(data){
                if(data.length!=0){
                    $("#pro_id_2").val(data.pro_id);
                    $("#pro_name_2").val(data.pro_name+" "+data.pro_detail);
                    $("#un_name_2").val(data.un_name);
                    $("#qty_in_stock_2").val(data.qty);
                }else{
                    $("#pro_id_2").val("");
                    $("#pro_name_2").val("");
                    $("#un_name_2").val("");
                    $("#qty_in_stock_2").val(0);
                }
            }
        })
    }

    function cal_qty(pro_code,st_id){
        $.ajax({
            url:"my_ex_plode_search_qty.php",
            type:"get",
            data:{
                pro_code:pro_code,
                st_id:st_id
            },
            dataType:"json",
            success:function(data){
                if(data!=""){
                    $("#pro_id").val(data.pro_id);
                    $("#pro_name").val(data.pro_name+" "+data.pro_detail);
                    $("#qty").val(data.qty);
                    $("#un_name").val(data.un_name);
                    $("#qty_4").val(data.un_qty);
                    $("#qty_2").focus();
                    $("#qty_2").select();
                }else{
                    swal.fire("","ບໍ່ພົບລາຍການທີ່ທ່ານຊອກຫາ!!!","error");
                    $("#pro_name").val("");
                    $("#qty").val(0);
                    $("#un_name").val("");
                    $("#qty_4").val(0);
                }
            }
        })
    }

    function show_stock(){
        $.ajax({
            url:"buy_stock.php",
            type:"get",
            dataType:"json",
            success:function(data){
                for(let i=0;i<data.length;i++){
                    $("#st_id").append($("<option/>",{
                        value:data[i].st_id,
                        text:data[i].st_name
                    }))
                }
            }
        })
    }
</script>