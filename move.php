<?php include("move_pro_modal.php");?>

<div class="row">
    <div class="col-sm-4">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                            
            <table width="100%">
                <tr>
                    <td width="210px;">ວັນທີເຄື່ອນຍ້າຍ :</td>
                    <td><input value="<?php echo date("Y-m-d");?>" type="date" class="form-control" name="mov_date" id="mov_date"></td>
                </tr>
                <tr>
                    <td>ສາງຈັດເກັບສິນຄ້າຕົ້ນທາງ :</td>
                    <td><select class="form-control" name="st_id_1" id="st_id_1"></select></td>
                </tr>
                <tr>
                    <td>ສາງຈັດເກັບສິນຄ້າປາຍທາງ :</td>
                    <td>
                        <select class="form-control" name="st_id_2" id="st_id_2">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ພະນັກງານທີ່ຂໍເບີກ :</td>
                    <td>
                        <select class="form-control" name="em_id" id="em_id">
                            <option value="">ລະບຸລາຍການ</option>
                        </select>
                    </td>
                </tr>
            </table>
            <hr>

            <button id="save" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
            <button onclick="ajax('move','mainpage');" type="button" class="btn btn-primary"><i class="fas fa-sync"></i><br>ລ້າງລາຍການ</button>
            <button onclick="ajax('mainpage','mainpage');" type="button" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
        </div>
    </div>
    <div class="col-sm-8">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">

        <table width="100%">
            <thead>
            <tr>
                <td width="160">ລະຫັດສິນຄ້າ</td>
                <td width="30"></td>
                <td>ລາຍລະອຽດສິນຄ້າ</td>
                <td width="140">ໜ່ວຍນັບ</td>
                <td width="90">ຄ້າງສາງ</td>
                <td width="120">ຈຳນວນເບີກອອກ</td>
                <td width="30"></td>
            </tr>
            </thead>
            <tr>
                <td>
                    <input type="hidden" name="pro_id" id="pro_id">
                    <input autocomplete="off" type="text" class="form-control" name="pro_code" id="pro_code">
                </td>
                <td><button data-toggle="modal" data-target="#move_pro_modal" style="width:100%;" type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></td>
                <td><input type="text" class="form-control" readonly name="pro_name" id="pro_name"></td>
                <td><input type="text" class="form-control" readonly name="un_name" id="un_name"></td>
                <td><input type="text" autocomplete="off" class="form-control" readonly name="qty_in_stock" id="qty_in_stock"></td>
                <td>
                    <input type="text" class="form-control" name="qty" id="qty"
                    value=1 onkeyup="dokeyup(this);" onchange="dokeyup(this);" 
                    onkeypress="checknumber();" style="text-align: right;">
                </td>
                <td><button id="add" style="width:100%;" type="button" class="btn btn-info"><i class="fas fa-plus"></i></button></td>
            </tr>
        </table>
        <table width="100%" style="margin-top: 10px;">
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                <td width="60">ລຳດັບ</td>
                <td width="120">ລະຫັດສິນຄ້າ</td>
                <td width="30"></td>
                <td>ລາຍລະອຽດສິນຄ້າ</td>
                <td width="120">ໜ່ວຍນັບ</td>
                <td width="120">ຈຳນວນເບີກອອກ</td>
                <td style="display: none;"></td>
            </tr>
        </table>
        <div style="height:500px; overflow:auto;">
            <table width="100%" id="mytable"></table>
        </div>
        <table width="100%" style="margin-top: 30px; ">
            <tr>
                <td width="90">ໝາຍເຫດ :</td>
                <td><input type="text" class="form-control" name="mov_note" id="mov_note"></td>
                <td width="200"><input style="margin-right:4px;margin-left:4px; cursor:pointer;" checked type="checkbox" name="barcode" id="barcode">ນຳໃຊ້ເຄື່ອງສະແກນບາໂຄດ</td>
            </tr>
        </table>
    </div>
</div>

<script>
    show_stock();
    show_em();

    function add_data(){
        let pro_code=$("#pro_code").val();
            let pro_id=$("#pro_id").val();
            let pro_name=$("#pro_name").val();
            let un_name=$("#un_name").val();
            let qty=$("#qty").val();
            let qty_in_stock=$("#qty_in_stock").val();
            let qty_row=0;

            if(pro_code==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(pro_name==""){
                swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(qty<1 || qty==""){
                swal.fire("","ກະລຸນາລະບຸຈຳນວນກ່ອນ!!!","error");
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
                    }

                    $(this).find("td:eq(5)").text(qty_row.toLocaleString());
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
            let td7=$("<td style='display:none;'>"+pro_id+"</td>");

            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            tr.append(td5);
            tr.append(td6);
            tr.append(td7);

            $("#mytable").append(tr);
            clear_pro();
            $("#pro_code").focus();
    };

    $(document).ready(function(){
        $("#pro_code").focus();
        $("#st_id_1").change(function(){
            $("#mytable").empty();
            $("#table_move_pro_list").empty();
        });
        $("#pro_code").keyup(function(e){
            if(e.which==13){
                let pro_code=$("#pro_code").val();
                let st_id_1=$("#st_id_1").val();

                if(pro_code!=""){
                    search_pro(st_id_1,pro_code);
                }
            }
        });
        $("#qty").keyup(function(e){
            if(e.which==13){
                $("#add").focus();
            }
        });
        $("#add").click(function(){
            add_data();
        });

        $("#save").click(function(){
            let mov_date=$("#mov_date").val();
            let st_id_1=$("#st_id_1").val();
            let st_name_1=$("#st_id_1 option:selected").text();
            let st_id_2=$("#st_id_2").val();
            let st_name_2=$("#st_id_2 option:selected").text();
            let em_id=$("#em_id").val();
            let mov_note=$("#mov_note").val();
            let count=$("#mytable tr").length;

            if(count<1){
                swal.fire("","ກະລຸນາລະບຸລາຍການສິນຄ້າກ່ອນ!!!","error");
                return;
            }
            if(em_id==""){
                swal.fire("","ກະລຸນາລະບຸພະນັກງານເບີກກ່ອນ!!!","error");
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
                    pro_code:$(tr).find("td:eq(1)").text(),
                    qty:$(tr).find("td:eq(5)").text(),
                    pro_id:$(tr).find("td:eq(6)").text()
                }
                mydata.push(sub);
            });

            $.ajax({
                type: "post",
                url: "move_save.php",
                data: {
                    em_id:em_id,
                    mov_date:mov_date,
                    mov_note:mov_note,
                    st_id_1:st_id_1,
                    st_id_2:st_id_2,
                    mydata:mydata
                },
                success: function (data) {
                Swal.fire({
                title: '',
                text: "ການບັນທຶກລາຍການແມ່ນສຳເລັດແລ້ວ!!!",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
                }).then((result) => {
                if (result.value) {
                    data=data.replace(/\"/g, "");
                    window.open("move_print.php?mov_code="+data+"&st_name_1="+st_name_1+"&st_name_2="+st_name_2);
                    ajax('move','mainpage');
                }
                })
                    // ajax('general_book','mainpage');
                }
            });  
            }
            })
        });
    });
    function clear_pro(){
        $("#pro_code").val("");
        $("#pro_name").val("");
        $("#un_name").val("");
        $("#qty").val(1);
        $("#qty_in_stock").val("");
    };
    function delete_row(e){
        $(e).parent().parent().remove();
        // cal_net();
        newcount();
    };
    function newcount(){
        let newcount=0;
        $("#mytable tr").each(function(){
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
    function search_pro(st_id_1,pro_code){
        $.ajax({
            url:"move_search_pro.php",
            type:"get",
            data:{
                st_id_1:st_id_1,
                pro_code:pro_code
            },
            dataType:"json",
            success:function(data){
                if(data=="n"){
                    swal.fire("","ບໍ່ພົບລາຍການທີ່ທ່ານຊອກຫາ!!!","error");
                }else{
                    $("#pro_id").val(data.pro_id);
                    $("#pro_code").val(data.pro_code);
                    $("#pro_name").val(data.pro_name+" "+data.pro_detail);
                    $("#un_name").val(data.un_name);
                    $("#qty_in_stock").val(data.qty);
                    $("#qty").focus();
                    $("#qty").select();

                    if($("#barcode").is(':checked')){
                        add_data();
                    }
                }
            }
        })
    };
    
    function show_stock(){
        $.ajax({
            url:"buy_stock.php",
            type:"get",
            dataType:"json",
            success:function(data){
                for(let i=0;i<data.length;i++){
                    $("#st_id_1").append($("<option/>",{
                        value:data[i].st_id,
                        text:data[i].st_name
                    }))
                    $("#st_id_2").append($("<option/>",{
                        value:data[i].st_id,
                        text:data[i].st_name
                    }))
                }
            }
        })
    };
    function show_em(){
        $.ajax({
            url:"move_em.php",
            type:"get",
            dataType:"json",
            success:function(data){
                for(let i=0;i<data.length;i++){
                    $("#em_id").append($("<option/>",{
                        value:data[i].em_id,
                        text:data[i].em_name
                    }))
                }
            }
        })
    };
</script>