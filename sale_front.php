<?php include("sale_front_pro_modal.php");?>

<div class="row">
    <div class="col-sm-3">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
         
            <table width="100%">
                <tr>
                    <input type="hidden" name="pro_id" id="pro_id">
                    <input type="hidden" name="qty_in_stock" id="qty_in_stock">
                    <td><input type="text" placeholder="ລະບຸລະຫັດສິນຄ້າ" autocomplete="off" class="form-control form-control-lg" name="pro_code" id="pro_code"></td>
                    <td width="20"><button data-toggle="modal" data-target="#sale_front_pro_modal" style="width:100%;" type="button" class="btn btn-primary btn-lg"><i class="fas fa-search"></i></button></td>
                    <td width="90"><input type="number" autocomplete="off" value=1 class="form-control form-control-lg" name="qty" id="qty"></td>
                </tr>
            </table>
        </div>
        <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <table width="100%">
                <tr>
                    <td width="160">ຍອດຂາຍທັງໝົດ :</td>
                    <td><input style="text-align: right;" readonly value="0" type="text" class="form-control form-control-lg" name="t1" id="t1"></td>
                </tr>
                <tr>
                    <td>ຍອດຮັບຊຳລະ :</td>
                    <td><input style="text-align: right;" value=0 onkeyup="dokeyup(this); cal_total();" onchange="dokeyup(this);" onkeypress="checknumber();" type="text" class="form-control form-control-lg" name="t2" id="t2"></td>
                </tr>
                <tr>
                    <td>ເງິນທອນ :</td>
                    <td><input style="text-align: right;" readonly value="0" type="text" class="form-control form-control-lg" name="t3" id="t3"></td>
                </tr>
                <tr>
                    <td>ປະເພດການຮັບຊຳລະ :</td>
                    <td>
                        <select name="recieve_type" id="recieve_type" class="form-control form-control-lg">
                            <option value="c">ຮັບເປັນເງິນສົດ</option>
                            <option value="b">ຮັບເປັນເງິນຝາກ</option>
                        </select>
                    </td>
                </tr>
            </table><hr>

            <button id="save" type="button" style="width:100%;" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
        </div>
    </div>
    <div class="col-sm-9">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            
        <div class="row">
            <div class="col-sm-8">
                <u><h4>ລາຍການຂາຍໜ້າຮ້ານ</h4></u>
            </div>
            <div class="col-sm-4">
                <button onclick="ajax('mainpage','mainpage');" type="button" style="width:90px;" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>ອອກ</button>
            </div>
        </div>
            
            <table width="100%" style="margin-top: 10px;">
                <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                    <td width="70">ລຳດັບ</td>
                    <td width="130">ລະຫັດສິນຄ້າ</td>
                    <td width="30"></td>
                    <td >ລາຍລະອຽດສິນຄ້າ</td>
                    <td width="125">ໜ່ວຍນັບ</td>
                    <td width="100" align="center">ຈຳນວນຂາຍ</td>
                    <td width="140" align="center">ລາຄາຕໍ່ໜ່ວຍ</td>
                    <td width="140" align="center">ມູນຄ່າຂາຍ</td>
                </tr>
            </table>
            <div style="height:590px; overflow:auto;">
                <table id="mytable" width="100%" class="table-hover"><tbody></tbody></table>
            </div>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function(){
        $("#pro_code").focus();
        $("#t2").keydown(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        });
        $("#save").click(function(){
            let count=$("#mytable tr").length;
            let t1=$("#t1").val();
            let t2=$("#t2").val();
            let t3=$("#t3").val();
            let recieve_type=$("#recieve_type").val();
            t3=t3.replace(/,/g,"");

            if(count<1){
                swal.fire("","ກະລຸນາລະບຸລາຍການຊື້ສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(t3>0){
                swal.fire("","ທ່ານລະບຸຈຳນວນເງິນບໍ່ຖືກຕ້ອງ!!!","error");
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
            $("#mytable tr").each(function(row,tr){
        
            let sub={
                pro_id:$(tr).find("td:eq(8)").text(),
                qty:$(tr).find("td:eq(5)").text(),
                sale_price:$(tr).find("td:eq(6)").text()
            }
            mydata.push(sub);
            });

            $.ajax({
                url:"sale_front_save.php",
                type:"post",
                data:{
                    t1:t1,
                    t2:t2,
                    recieve_type:recieve_type,
                    mydata:mydata
                },
                success:function(data){
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
                        window.open("sale_front_print.php?sale_code="+data+"&t2="+t2);
                        ajax('sale_front','mainpage');
                    }
                    })
                    
                }
            })
            }
            })
        });
        $("#pro_code").keydown(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code").val();
                if(pro_code!=""){
                    show_qty(pro_code);
                }
            }
        });
    });
    function show_qty(pro_code){
        if(pro_code!=""){
            $.ajax({
            url:"sale_front_search_pro.php",
            type:"get",
            data:{
                pro_code:pro_code
            },
            dataType:"json",
            success:function(data){
                if(data=="n"){
                    swal.fire("","ບໍ່ພົບລາຍການທີ່ທ່ານຊອກຫາ!!!","error");
                    clear_pro();
                    return;
                }
                let pro_name_2="";
                let un_name="";
                let qty=1;
                let pro_sale_price=0;
                let total=0;
                let pro_id="";
                let qty_in_stock=0;
                let qty_row=0;

                $("#pro_code").val(data.pro_code);
                $("#pro_id").val(data.pro_id);
                pro_id=$("#pro_id").val();
                pro_code=$("#pro_code").val();
                pro_sale_price=(data.pro_sale_price);
                pro_name_2=(data.pro_name_2);
                un_name=(data.un_name);
                $("#qty_in_stock").val(data.qty);
                qty_in_stock=$("#qty_in_stock").val();
                qty=$("#qty").val();

                if(qty=="" || qty=="0"){
                    qty=1;
                }

                if(parseInt(qty)>parseInt(qty_in_stock)){
                    swal.fire("","ຈຳນວນສິນຄ້າມີບໍ່ພຽງພໍ!!!","error");
                    clear_pro();
                    $("#pro_code").focus();
                    exit();
                }

                $("#mytable tr").each(function(){
                    if(pro_code==$(this).find("td:eq(1)").text().trim()){
                        qty_row=$(this).find("td:eq(5)").text().trim();
                        pro_sale_price=$(this).find("td:eq(6)").text().trim();
                        pro_sale_price=pro_sale_price.replace(/,/g,"");

                        qty_row=qty_row.replace(/,/g,"");
                        qty=qty.replace(/,/g,"");

                        qty_row=parseFloat(qty_row)+parseFloat(qty);
                        total=qty_row*pro_sale_price;

                        if(parseInt(qty_row)>parseInt(qty_in_stock)){
                            swal.fire("","ຈຳນວນສິນຄ້າມີບໍ່ພຽງພໍ!!!","error");
                            clear_pro();
                            $("#pro_code").focus();
                            exit();
                        }else{
                            $(this).find("td:eq(5)").text(qty_row.toLocaleString());
                            $(this).find("td:eq(6)").text(pro_sale_price.toLocaleString());
                            $(this).find("td:eq(7)").text(total.toLocaleString());
                        }
                        
                        cal_net();
                        clear_pro();
                        $("#pro_code").focus();
                        exit();
                    }
                });

                let count=$("#mytable tr").length;
                count++;
                let tr=$("<tr style='border-bottom:lightgrey 1px solid;'></tr>");
                let td1=$("<td width='60'>"+count+"</td>");
                let td2=$("<td width='120'>"+pro_code+"</td>");
                let td3=$("<td width='30'><button onclick='delete_row(this);' style='width:100%' type='button' class='btn btn-primary'><i class='fas fa-times'></i></button></td>");
                let td4=$("<td style='padding-left:10px;'>"+pro_name_2+"</td>");
                let td5=$("<td width='100'>"+un_name+"</td>");
                let td6=$("<td width='100' align='right'>"+qty+"</td>");
                let td7=$("<td width='140' align='right'>"+pro_sale_price+"</td>");

                pro_sale_price=pro_sale_price.replace(/,/g,"");
                total=qty*pro_sale_price;

                let td8=$("<td width='140' align='right'>"+total.toLocaleString()+"</td>");
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

                $("#mytable").prepend(tr);
                cal_net();
                clear_pro();
                $("#pro_code").focus();
            }
        })
        }
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
        let total_paid=0;
        let net=0;

        total=$("#t1").val()
        total_paid=$("#t2").val()

        total=total.replace(/,/g,"");
        total_paid=total_paid.replace(/,/g,"");

        net=total-total_paid;
        $("#t3").val(net.toLocaleString(2));
    }
    function clear_pro(){
        $("#pro_code").val("");
        $("#qty").val("1");
    };
    function cal_net(){
        let total=0;
        let all_total=0;
        let total_paid=0;
        let net=0;

        total_paid=parseFloat($("#t2").val().replace(/,/g,""));

        $("#mytable tr").each(function(){
            total=$(this).find("td:eq(7)").text().trim();
            total=parseFloat(total.replace(/,/g,""));
            all_total+=parseFloat(total);
        });

        net=parseFloat(all_total)-parseFloat(total_paid);
        $("#t1").val(all_total.toLocaleString());
        $("#t3").val(net.toLocaleString());
    }
</script>