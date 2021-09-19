<?php 
    include("sale_cus_modal.php");
    include("sale_pro_modal.php");
?>

<div class="row">
    <div class="col-sm-6">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <table width="100%">
            <input type="hidden" name="cus_id" id="cus_id">
                <tr>
                    <td width="100">ຊື່ລູກຄ້າ :</td>
                    <td><input readonly class="form-control" type="text" name="cus_name" id="cus_name"></td>
                    <td width="30"><button data-toggle="modal" data-target="#sale_cus_modal" style="width:100%" type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></td>
                </tr>
                <tr>
                    <td>ເບີໂທລະສັບ :</td>
                    <td><input readonly class="form-control" type="text" name="cus_phone" id="cus_phone"></td>
                </tr>
                <tr>
                    <td>ຊື່ຜູ້ຕິດຕໍ່ :</td>
                    <td><input readonly class="form-control" type="text" name="cus_contact_name" id="cus_contact_name"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-3">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <table width="100%">
                <tr>
                    <td width="140">ສາງຈັດເກັບສິນຄ້າ :</td>
                    <td>
                        <select class="form-control" name="st_id" id="st_id" onchange="clear_all_data();">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ປະເພດລາຄາຂາຍ :</td>
                    <td>
                        <select onchange="clear_all_data();" name="price_type" id="price_type" class="form-control">
                            <option value="normal">ລາຄາຂາຍສົ່ງ</option>
                            <option value="vip">ລາຄາຂາຍ VIP</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ປະເພດການຊຳລະ :</td>
                    <td>
                        <select name="paid_status" id="paid_status" class="form-control">
                            <option value="n">ຕິດໜີ້</option>
                            <option value="c">ຮັບເປັນເງິນສົດ</option>
                            <option value="b">ຮັບເປັນເງິນຝາກ</option>
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
                    <td width="140">ມູນຄ່າຂາຍ :</td>
                    <td><input value="0" readonly style="text-align:right;" class="form-control" type="text" name="t1" id="t1"></td>
                </tr>
                <tr>
                    <td>ສ່ວນລຸດ :</td>
                    <td><input style="text-align:right" value=0 type="text" 
                    onkeyup="dokeyup(this);cal_net();" onchange="dokeyup(this);" onkeypress="checknumber();"
                    class="form-control" name="t2" id="t2"></td>
                </tr>
                <tr>
                    <td>ມູນຄ່າຂາຍຕົວຈິງ :</td>
                    <td><input value="0" readonly style="text-align:right;" class="form-control" type="text" name="t3" id="t3"></td>
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
                    <td>ລາຍລະອຽດສິນຄ້າ</td>
                    <td width="130">ໜ່ວຍຈັດເກັບ</td>
                    <td width="100">ຄ້າງສາງ</td>
                    <td width="90" align="center">ຈຳນວນ</td>
                    <td width="130" align="right">ລາຄາຂາຍ</td>
                    <td width="130" align="right">ມູນຄ່າຂາຍ</td>
                    <td style="display:none;">pro_id</td>
                    <td style="display:none;">st_id</td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" autocomplete="off" name="pro_code" id="pro_code"></td>
                    <td><button data-toggle="modal" data-target="#sale_pro_modal" style="width:100%;" type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></td>
                    <td><input readonly type="text" class="form-control" name="pro_name" id="pro_name"></td>
                    <td><input readonly type="text" class="form-control" name="un_name" id="un_name"></td>
                    <td><input readonly type="text" class="form-control" name="qty_in_stock" id="qty_in_stock"></td>
                    <td>
                        <input autocomplete="off" style="text-align:right" value=1 type="text" class="form-control"
                        name="qty" id="qty" onkeyup="dokeyup(this);cal_total();" 
                        onchange="dokeyup(this);" onkeypress="checknumber();" autocomplete="off">
                    </td>
                    <td>
                        <input autocomplete="off" style="text-align:right" value=0 type="text" class="form-control" 
                        name="sale_price" id="sale_price" autocomplete="off"
                        onkeyup="dokeyup(this);cal_total();" onchange="dokeyup(this);" onkeypress="checknumber();">
                    </td>
                    <td><input style="text-align: right;" value="0" readonly type="text" class="form-control" name="total" id="total"></td>
                    <td style="display:none;"><input type="hidden" name="pro_id" id="pro_id"></td>
                </tr>
            </table>

            <table width="100%" style="margin-top:10px;">
            <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                            <td width="60">ລຳດັບ</td>
                            <td width="150">ລະຫັດສິນຄ້າ</td>
                            <td width="30"></td>
                            <td>ລາຍລະອຽດສິນຄ້າ</td>
                            <td width="140">ໜ່ວຍຈັດເກັບ</td>
                            <td width="110" align='right'>ຈຳນວນ</td>
                            <td width="140" align='right'>ລາຄາຂາຍ</td>
                            <td width="140" align='right'>ມູນຄ່າຂາຍ</td>
                        </tr>
                    </table>
                    <div style="width:100%; border:lightgrey 1px solid; height:360px; overflow:auto;">
                        <table class="table-hover" width="100%" id="mytable"><tbody></tbody></table>
                    </div>

                    <table width="100%" style="margin-top:10px;">
                        <tr>
                            <td width="100">ໝາຍເຫດ :</td>
                            <td><input type="text" class="form-control" name="sale_note" id="sale_note"></td>
                            <td width="200"><input style="margin-right:4px;margin-left:4px; cursor:pointer;" checked type="checkbox" name="barcode" id="barcode">ນຳໃຊ້ເຄື່ອງສະແກນບາໂຄດ</td>
                        </tr>
                    </table>
                
            </div>
            <div class="col-sm-1">
                <button id="add" type="button" style="width:100%; margin-bottom:4px;" class="btn btn-primary"><i class="fas fa-plus"></i><br>ເພີ່ມ</button>
                <button id="save" type="button" style="width:100%; margin-bottom:4px;" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກ</button>
                <button onclick="ajax('sale','mainpage');" type="button" style="width:100%; margin-bottom:4px;" class="btn btn-primary"><i class="fas fa-sync"></i><br>ລ້າງໃໝ່</button>
                <button onclick="ajax('mainpage','mainpage');" type="button" style="width:100%;" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i><br>ອອກ</button>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    show_stock();

    function clear_all_data(){
        $("#mytable").empty();
        $("#sale_pro_list").empty();
        cal_net();
        clear_pro();
        $("#pro_code").focus();
    }

    function delete_row(e){
        $(e).parent().parent().remove();
        cal_net();
        newcount();
    };
    function newcount(){
        let newcount=0;
        $("#mytable tbody tr").each(function(){
            newcount+=1;
            $(this).find("td:eq(0)").text(newcount);
        });
    }

    function clear_pro(){
        $("#pro_id").val("");
        $("#pro_code").val("");
        $("#pro_name").val("");
        $("#un_name").val("");
        $("#qty").val(1);
        $("#sale_price").val(0);
        $("#qty_in_stock").val(0);
        $("#total").val(0);
    };

    function add_data(){
        let pro_id=$("#pro_id").val();
        let pro_code=$("#pro_code").val();
        let pro_name=$("#pro_name").val();
        let st_id=$("#st_id").val();
        let un_name=$("#un_name").val();
        let qty=$("#qty").val();
        let qty_row=$("#mytable tr").length;
        let qty_in_stock=$("#qty_in_stock").val();
        let sale_price=$("#sale_price").val();
        let total=$("#total").val();

        if(pro_id=="" || pro_code=="" || pro_name==""){
            swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າກ່ອນ!!!","error");
            return;
        }
        if(qty=="" || sale_price==""){
            swal.fire("","ກະລຸນາລະບຸຈຳນວນ ແລະ ລາຄາສິນຄ້າກ່ອນ!!!","error");
            return;
        }
        qty=qty.replace(/,/g,"");
        qty_in_stock=qty_in_stock.replace(/,/g,"");

        if(parseInt(qty)>parseInt(qty_in_stock)){
            swal.fire("","ຈຳນວນສິນຄ້າມີບໍ່ພຽງພໍ!!!","error");
            return;
        }
        $("#mytable tr").each(function(){
            if(pro_code==$(this).find("td:eq(1)").text().trim()){
                qty_row=$(this).find("td:eq(5)").text().trim();
                qty_row=qty_row.replace(/,/g,"");
                qty_row=parseFloat(qty_row)+parseFloat(qty);

                if(parseInt(qty_row)>parseInt(qty_in_stock)){
                    swal.fire("","ຈຳນວນສິນຄ້າມີບໍ່ພຽງພໍ!!!","error");
                    exit();
                }else{
                    $(this).find("td:eq(5)").text(qty_row.toLocaleString());
                    $(this).find("td:eq(6)").text(sale_price.toLocaleString());
                    sale_price=sale_price.replace(/,/g,"");
                    total=(parseFloat(qty_row)*parseFloat(sale_price));
                    $(this).find("td:eq(7)").text(total.toLocaleString());
                    cal_net();
                    clear_pro();
                    $("#pro_code").focus();
                    exit();
                }
            }
        });
            let count=$("#mytable tr").length;
            count++;
            let tr=$("<tr style='border-bottom:lightgrey 1px solid;'></tr>");
            let td1=$("<td width='70'>"+count+"</td>");
            let td2=$("<td width='130'>"+pro_code+"</td>");
            let td3=$("<td width='30'><button onclick='delete_row(this);' style='width:100%' type='button' class='btn btn-primary'><i class='fas fa-times'></i></button></td>");
            let td4=$("<td style='padding-left:10px;'>"+pro_name+"</td>");
            let td5=$("<td width='140'>"+un_name+"</td>");
            let td6=$("<td width='120' align='right' style='padding-right:20px;'>"+qty+"</td>");
            let td7=$("<td width='140' align='right' style='padding-right:15px;'>"+sale_price+"</td>");
            let td8=$("<td width='130' align='right' style='padding-right:10px;'>"+total+"</td>");
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
    };

    $(document).ready(function(){
        $("#pro_code").focus();
        $("#save").click(function(){
            let cus_id=$("#cus_id").val();
            let st_id=$("#st_id").val();
            let sale_date=$("#sale_date").val();
            let total=$("#t1").val();
            let total_dc=$("#t2").val();
            let sale_note=$("#sale_note").val();
            let price_type=$("#price_type").val();
            let paid_status=$("#paid_status").val();
            
            if(cus_id==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການລູກຄ້າກ່ອນ!!!","error");
                return;
            };
            if(sale_date==""){
                swal.fire("","ກະລຸນາລະບຸວັນທີຊື້ສິນຄ້າກ່ອນ!!!","error");
                return;
            };

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
                        sale_price:$(tr).find("td:eq(6)").text()
                    }
                    mydata.push(sub);
                });

                $.ajax({
                    type: "post",
                    url: "sale_save.php",
                    data: {
                        cus_id:cus_id,
                        paid_status:paid_status,
                        price_type:price_type,
                        sale_date:sale_date,
                        total:total,
                        total_dc:total_dc,
                        sale_note:sale_note,
                        st_id:st_id,
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
                        window.open("sale_print.php?sale_code="+data);
                        ajax('sale','mainpage');
                    }
                    })
                        // ajax('general_book','mainpage');
                    }
                });
            }
            })
        });
        $("#add").click(function(){
            add_data();
        });
        
        $("#qty").keyup(function(e){
            if(e.which==13){
                $("#sale_price").focus();
                $("#sale_price").select();
            }
        });
        $("#sale_price").keyup(function(e){
            if(e.which==13){
                $("#add").focus();
            }
        });
        $("#pro_code").keyup(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code").val();
                let price_type=$("#price_type").val();
                let st_id=$("#st_id").val();

                if(pro_code!=""){
                    $.ajax({
                    url:"sale_search_pro.php",
                    type:"get",
                    data:{
                        pro_code:pro_code,
                        st_id:st_id
                    },
                    dataType:"json",
                    success:function(data){
                        if(data=="n"){
                            swal.fire("","ບໍ່ພົບລາຍການທີ່ທ່ານຊອກຫາ!!!","error");
                        }else{
                            $("#pro_id").val(data.pro_id);
                            let pro_id=$("#pro_id").val();
                            $("#pro_code").val(data.pro_code);
                            $("#pro_name").val(data.pro_name+"-"+data.pro_detail);
                            $("#un_name").val(data.un_name);
                            $("#qty_in_stock").val(data.qty);

                            if(price_type=="normal"){
                                $("#sale_price").val(data.pro_sale_price_2);
                            }else if(price_type=="vip"){
                                $("#sale_price").val(data.pro_sale_price_vip);
                            }

                            $("#qty").focus();
                            $("#qty").select();
                            cal_total();
                            // cal_qty(pro_id,st_id);

                            if($("#barcode").is(':checked')){
                                add_data();
                                // cal_net();
                                // clear_pro();
                            }
                        }
                    }
                })
                }
            }
        });
    });

    function cal_net(){
        let total=0;
        let all_total=0;
        let total_dc=0;
        let net=0;
        let qty=0;
        let all_qty=0;

        total_dc=parseFloat($("#t2").val().replace(/,/g,""));

        $("#mytable tr").each(function(){
            total=$(this).find("td:eq(7)").text().trim();
            total=parseFloat(total.replace(/,/g,""));
            all_total+=parseFloat(total);
        });

        net=parseFloat(all_total)-parseFloat(total_dc);
        $("#t1").val(all_total.toLocaleString());
        $("#t3").val(net.toLocaleString());
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

    function cal_total(){
        let total=0;
        let qty=0;
        let sale_price=0;

        qty=$("#qty").val()
        sale_price=$("#sale_price").val()

        qty=qty.replace(/,/g,"");
        sale_price=sale_price.replace(/,/g,"");

        total=qty*sale_price;
        $("#total").val(total.toLocaleString(2));
    }

    function show_stock(){
        $.ajax({
            url:"sale_stock.php",
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