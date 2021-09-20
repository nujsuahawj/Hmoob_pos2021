<?php include("buy_pro_modal.php");?>

<div class="row">
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                            
            <table width="100%">
                <tr>
                    <td width="120">ຊື້ສິນຄ້າຈາກ :</td>
                    <td>
                        <select name="sup_id" id="sup_id" class="form-control" onchange="show_contact_name(this.value);">
                            <option value="">ລະບຸລາຍການ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ເບີໂທລະສັບ :</td>
                    <td><input readonly type="text" class="form-control" name="sup_phone" id="sup_phone"></td>
                </tr>
                <tr>
                    <td>ຊື່ຜູ້ຕິດຕໍ່ :</td>
                    <td><input readonly type="text" class="form-control" name="sup_contact_name" id="sup_contact_name"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-3">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                            
            <table width="100%">
                <tr>
                    <td width="160">ປະຈຳວັນທີ :</td>
                    <td><input type="date" value="<?php echo date("Y-m-d");?>" class="form-control" name="buy_date" id="buy_date"></td>
                </tr>
                <tr>
                    <td>ສາງຈັດເກັບສິນຄ້າ :</td>
                    <td>
                        <select name="st_id" id="st_id" class="form-control"
                        onchange="cal_qty(document.getElementById('pro_id').value,this.value);">
                            <option value="">ລະບຸລາຍການ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ປະເພດການຊຳລະ :</td>
                    <td>
                        <select name="is_paid" id="is_paid" class="form-control">
                            <option value="n">ຄ້າງຊຳລະ</option>
                            <option value="c">ຊຳລະເປັນເງິນສົດ</option>
                            <option value="b">ຊຳລະເປັນເງິນຝາກ</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-3">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                            
            <table width="100%">
                <tr>
                    <td width="140">ມູນຄ່າຊື້ :</td>
                    <td><input style="text-align:right" readonly value=0 type="text" class="form-control" name="t1" id="t1"></td>
                </tr>
                <tr>
                    <td>ສ່ວນລຸດ :</td>
                    <td><input style="text-align:right" value=0 type="text" 
                    onkeyup="dokeyup(this);cal_net();" onchange="dokeyup(this);" onkeypress="checknumber();"
                    class="form-control" name="t2" id="t2"></td>
                </tr>
                <tr>
                    <td>ມູນຄ່າຊື້ຕົວຈິງ :</td>
                    <td><input style="text-align:right;" readonly value=0 type="text" class="form-control" name="t3" id="t3"></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">

            <div class="row">
                <div class="col-sm-11">
                <table width="100%">
                <tr>
                    <td width="150">ລະຫັດສິນຄ້າ</td>
                    <td width="30"></td>
                    <td>ຊື່ ແລະ ລາຍລະອຽດສິນຄ້າ</td>
                    <td width="160">ໜ່ວຍຈັດເກັບ</td>
                    <td width="120" align="right">ຈຳນວນຊື້</td>
                    <td width="140" align="right">ລາຄາຕໍ່ໜ່ວຍ</td>
                    <td width="140" align="right">ມູນຄ່າລວມ</td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" class="form-control" name="pro_id" id="pro_id">
                        <input autocomplete="off" type="text" class="form-control" name="pro_code" id="pro_code">
                    </td>
                    <td><button onfocus="cal_total();" data-toggle="modal" data-target="#buy_pro_modal" style="width:100%" type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></td>
                    <td><input readonly type="text" class="form-control" name="pro_name" id="pro_name"></td>
                    <td><input readonly type="text" class="form-control" name="un_name" id="un_name"></td>
                    <td>
                        <input style="text-align:right" value=1 type="text" class="form-control"
                         name="qty" id="qty" onkeyup="dokeyup(this);cal_total();" 
                         onchange="dokeyup(this);" onkeypress="checknumber();" autocomplete="off">
                    </td>
                    <td>
                        <input style="text-align:right" value=0 type="text" class="form-control" 
                        name="buy_price" id="buy_price" autocomplete="off"
                        onkeyup="dokeyup(this);cal_total();" onchange="dokeyup(this);" onkeypress="checknumber();">
                    </td>
                    <td><input style="text-align:right" readonly value=0 type="text" class="form-control" name="total" id="total"></td>
                </tr>
            </table>
            <table width="100%" style="margin-top:10px;">
                <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                    <td width="70">ລຳດັບ</td>
                    <td width="180">ລະຫັດສິນຄ້າ</td>
                    <td>ຊື່ ແລະ ລາຍລະອຽດສິນຄ້າ</td>
                    <td width="140" align="center">ໜ່ວຍຈັດເກັບ</td>
                    <td width="120" align="right">ຈຳນວນຊື້</td>
                    <td width="140" align="right">ລາຄາຕໍ່ໜ່ວຍ</td>
                    <td width="140" align="right">ມູນຄ່າລວມ</td>
                    <td align="right" style='display:none;'>pro_id</td>
                </tr>
            </table>
                    <div style="border:lightgrey 1px solid; height:370px; overflow:auto; margin-bottom:10px;">
                        <table width="100%" id="mytable" class="table-hover">
                            <tbody></tbody>
                        </table>
                    </div>

                    <table width="100%">
                        <tr>
                            <td width="100">ໝາຍເຫດ :</td>
                            <td><input type="text" class="form-control" name="buy_note" id="buy_note"></td>
                            <td width="200"><input style="margin-right:4px;margin-left:4px; cursor:pointer;" checked type="checkbox" name="barcode" id="barcode">ນຳໃຊ້ເຄື່ອງສະແກນບາໂຄດ</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-1">
                    <button id="add" type="button" style="width:100%; margin-bottom:4px;" class="btn btn-primary"><i class="fas fa-plus"></i><br>ເພີ່ມ</button>
                    <button id="save" type="button" style="width:100%; margin-bottom:4px;" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກ</button>
                    <button onclick="ajax('buy','mainpage');" type="button" style="width:100%; margin-bottom:4px;" class="btn btn-primary" id="txuav"><i class="fas fa-sync"></i><br>ລ້າງໃໝ່</button>
                    <button onclick="ajax('mainpage','mainpage');" type="button" style="width:100%;" class="btn btn-primary" id="oos"><i class="fas fa-sign-out-alt"></i><br>ອອກ</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    show_sup();
    show_stock();

    function cal_qty(pro_id,st_id){
        $.ajax({
            url:"buy_search_qty.php",
            type:"get",
            data:{
                pro_id:pro_id,
                st_id:st_id
            },
            dataType:"json",
            success:function(data){
                if(data.length!=0){
                    $("#qty_in_stock").val(data.qty);
                }else{
                    $("#qty_in_stock").val(0);
                }
            }
        })
    }

    function cal_net(){
        let total=0;
        let all_total=0;
        let total_dc=0;
        let net=0;
        let qty=0;
        let all_qty=0;

        total_dc=parseFloat($("#t2").val().replace(/,/g,""));

        $("#mytable tbody tr").each(function(){
            total=$(this).find("td:eq(7)").text().trim();
            total=parseFloat(total.replace(/,/g,""));
            all_total+=parseFloat(total);
        });

        net=parseFloat(all_total)-parseFloat(total_dc);
        $("#t1").val(all_total.toLocaleString());
        $("#t3").val(net.toLocaleString());
    }

    function clear_pro(){
        $("#pro_id").val("");
        $("#pro_code").val("");
        $("#pro_name").val("");
        $("#un_name").val("");
        $("#qty").val(1);
        $("#buy_price").val(0);
        $("#total").val(0);
        $("#qty_in_stock").val(0);
    }

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

    function add_data(){
        let pro_id=$("#pro_id").val();
            let pro_code=$("#pro_code").val();
            let pro_name=$("#pro_name").val();
            let un_name=$("#un_name").val();
            let qty=$("#qty").val();
            let qty_row=$("#qty").val();
            let buy_price=$("#buy_price").val();
            let total=$("#total").val();

            if(pro_id=="" || pro_code=="" || pro_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(qty=="" || buy_price==""){
                swal.fire("","ກະລຸນາລະບຸຈຳນວນ ແລະ ລາຄາສິນຄ້າກ່ອນ!!!","error");
                return;
            }

            $("#mytable tbody tr").each(function(){
                if(pro_code==$(this).find("td:eq(1)").text().trim()){
                    qty_row=$(this).find("td:eq(5)").text().trim();
                    qty_row=qty_row.replace(/,/g,"");
                    qty=qty.replace(/,/g,"");
                    qty_row=parseFloat(qty_row)+parseFloat(qty);
                    $(this).find("td:eq(5)").text(qty_row.toLocaleString());
                    $(this).find("td:eq(6)").text(buy_price.toLocaleString());
                    buy_price=buy_price.replace(/,/g,"");
                    total=(parseFloat(qty_row)*parseFloat(buy_price));
                    $(this).find("td:eq(7)").text(total.toLocaleString());
                    cal_net();
                    clear_pro();
                    $("#pro_code").focus();
                    exit();
                }
            });

            let count=$("#mytable tr").length;
            count++;
            let tr=$("<tr style='border-bottom:#C9CACB 1px solid;'></tr>");
            let td1=$("<td width='70'>"+count+"</td>");
            let td2=$("<td width='130'>"+pro_code+"</td>");
            let td3=$("<td width='30'><button style='width:100%' onclick='delete_row(this);' type='button' class='btn btn-primary'><i class='fas fa-times'></i></button></td>");
            let td4=$("<td style='padding-left:10px;'>"+pro_name+"</td>");
            let td5=$("<td width='140'>"+un_name+"</td>");
            let td6=$("<td width='100' align='right'>"+qty+"</td>");
            let td7=$("<td width='140' align='right'>"+buy_price+"</td>");
            let td8=$("<td width='140' align='right'>"+total+"</td>");
            let td9=$("<td style='display:none;'>"+pro_id+"</td>");

            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            tr.append(td5);
            tr.append(td6);
            tr.append(td7);
            tr.append(td8);
            tr.append(td9);

            $("#mytable").append(tr);
            cal_net();
            clear_pro();
            $("#pro_code").focus();
    }

    $(document).ready(function(){
        $("#pro_code").focus();
        $("#save").click(function(){
            let sup_id=$("#sup_id").val();
            let st_id=$("#st_id").val();
            let buy_date=$("#buy_date").val();
            let total=$("#t1").val();
            let total_dc=$("#t2").val();
            total=total.replace(/,/g,"");
            total_dc=total_dc.replace(/,/g,"");
            let net=parseFloat(total)-parseFloat(total_dc);
            let buy_note=$("#buy_note").val();
            let is_paid=$("#is_paid").val();
            
            if(sup_id==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການຜູ້ສະໜອງກ່ອນ!!!","error");
                return;
            };
            if(st_id==""){
                swal.fire("","ກະລຸນາລະບຸສາງຈັດເກັບສິນຄ້າກ່ອນ!!!","error");
                return;
            };
            if(buy_date==""){
                swal.fire("","ກະລຸນາລະບຸວັນທີຊື້ສິນຄ້າກ່ອນ!!!","error");
                return;
            };
            if(parseFloat(net)<1){
                swal.fire("","ການລົບລາຍການບໍ່ຖືກຕ້ອງ!!!","error");
                return;
            }

            let count=$("#mytable tr").length;

            if(count<1){
                swal.fire("","ກະລຸນາລະບຸລາຍການຊື້ສິນຄ້າກ່ອນ!!!","error");
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
                let mydata=[];
                $("#mytable tbody tr").each(function(row,tr){
                    let sub={
                        pro_id:$(tr).find("td:eq(8)").text(),
                        qty:$(tr).find("td:eq(5)").text(),
                        buy_price:$(tr).find("td:eq(6)").text()
                    }
                    mydata.push(sub);
                });

                $.ajax({
                    type: "post",
                    url: "buy_save.php",
                    data: {
                        st_id:st_id,
                        sup_id:sup_id,
                        is_paid:is_paid,
                        buy_date:buy_date,
                        total:total,
                        total_dc:total_dc,
                        buy_note:buy_note,
                        mydata:mydata
                    },
                    success: function (data) {
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
                        data=data.replace(/\"/g, "");
                        window.open("buy_print.php?buy_code="+data);
                        ajax('buy','mainpage');
                    }
                    })
                        // ajax('general_book','mainpage');
                    }
                });
            }
            })
        });
        $("#buy_price").keyup(function(e){
            if(e.which==13){
                $("#add").focus();
            }
        });
        $("#add").click(function(){
            add_data();
        });
        $("#pro_code").keyup(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code").val();
                
                if(pro_code!=""){
                    search_pro(pro_code);

                    let pro_id=$("#pro_id").val();
                    let st_id=$("#st_id").val();
                    cal_qty(pro_id,st_id);
                }
            }
        });
        $("#qty").keyup(function(e){
            if(e.which==13){
                $("#buy_price").focus();
                $("#buy_price").select();
            }
        });
    })

    function delete_row(e){
        $(e).parent().parent().remove();
        cal_net();
        newcount();
    };

    function cal_total(){
        let total=0;
        let qty=0;
        let buy_price=0;

        qty=$("#qty").val()
        buy_price=$("#buy_price").val()

        qty=qty.replace(/,/g,"");
        buy_price=buy_price.replace(/,/g,"");

        total=qty*buy_price;
        $("#total").val(total.toLocaleString(2));
    }

    function search_pro(pro_code){
        $.ajax({
            url:"buy_search_pro.php",
            type:"get",
            data:{
                pro_code:pro_code
            },
            dataType:"json",
            success:function(data){
                if(data=="n"){
                    swal.fire("","ບໍ່ພົບລາຍການທີ່ທ່ານຊອກຫາ!!!","error");
                }else{
                    let qty=$("#qty").val();
                    qty=qty.replace(/,/g,"");

                    $("#pro_id").val(data.pro_id);
                    $("#pro_code").val(data.pro_code);
                    $("#pro_name").val(data.pro_name +'-'+ data.pro_detail);
                    $("#un_name").val(data.un_name);
                    $("#buy_price").val(data.pro_buy_price);
                    $("#qty").focus();
                    $("#qty").select();
                    cal_total();

                    if($("#barcode").is(':checked')){
                        add_data();
                    }
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

    function show_contact_name(sup_id){
        $.ajax({
            url:"buy_contact_name.php",
            type:"get",
            data:{
                sup_id:sup_id
            },
            dataType:"json",
            success:function(data){
                $("#sup_contact_name").val(data.sup_contact_name);
                $("#sup_phone").val(data.sup_phone);
            }
        })
    }

    function show_sup(){
        $.ajax({
            url:"buy_sup.php",
            type:"get",
            dataType:"json",
            success:function(data){
                for(let i=0;i<data.length;i++){
                    $("#sup_id").append($("<option/>",{
                        value:data[i].sup_id,
                        text:data[i].sup_name
                    }))
                }
            }
        })
    }
</script>