<div class="row">
    <div class="col-sm-12">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
        <div class="row">
            <div class="col-sm-10">
                <h4><u>ລາຍການລູກຄ້າຕິດໜີ້</u></h4>
            </div>
            <div class="col-sm-2">
                <button type="button" onclick="ajax('mainpage','mainpage');" style="width:90px;" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt" style="margin-right:4px;"></i> ອອກ</button>
            </div>
        </div>
            <table width="100%" style="margin-top:10px;" class="table-hover">
                <thead>
                <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                        <td width="70">ລຳດັບ</td>
                        <td width="170">ວັນທີຂາຍ</td>
                        <td width="120">ເລກທີຂາຍ</td>
                        <td>ລາຍຊື່ລູກຄ້າ</td>
                        <td width="140" align="right">ຍອດຂາຍ</td>
                        <td width="140" align="right">ສ່ວນລຸດ</td>
                        <td width="140" align="right">ຂາຍຕົວຈິງ</td>
                        <td width="140" align="right">ຮັບຊຳລະແລ້ວ</td>
                        <td width="140" align="right">ຍອດທີ່ຍັງຄ້າງ</td>
                        <td width="120" align="right" style="padding-right:20px;">ເລືອກ?</td>
                    </tr>
                </thead>
                <?php
                    include("config.php");

                    $sql="
                        select
                            s.sale_date,
                            s.sale_code,
                            s.sale_id,
                            s.total,
                            s.total_dc,
                            (select sum(ifnull(t2,0)) from tb_recieve_money where sale_id=s.sale_id)
                            as total_paid,
                            c.cus_name
                        from 
                            tb_sale s,
                            tb_cus c
                        where 
                            is_paid='n'
                        and 
                            s.cus_id=c.cus_id
                    ";

                    $qry=$conn->query($sql);
                    if(mysqli_num_rows($qry)>0){
                        $n=1;
                        while($rs=mysqli_fetch_object($qry)){
                ?>
                <tr style="border-bottom: lightsteelblue 1px solid;">
                    <td><?php echo $n++;?></td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($rs->sale_date));?></td>
                    <td><?php echo $rs->sale_code;?></td>
                    <td><?php echo $rs->cus_name;?></td>
                    <td align="right"><?php echo number_format($rs->total);?></td>
                    <td align="right"><?php echo number_format($rs->total_dc);?></td>
                    <td align="right"><?php echo number_format($rs->total-$rs->total_dc);?></td>
                    <td align="right"><?php echo number_format($rs->total_paid);?></td>
                    <td align="right" style="color:red;"><?php echo number_format($rs->total-$rs->total_dc-$rs->total_paid);?></td>
                    <td align="right">
                        <button onclick="ajax('receive_money_list&sale_id='+<?php echo $rs->sale_id;?>,'receive_money_list');" style="width:90px;" type="button" class="btn btn-primary bt_this"
                        data-sale_id="<?php echo $rs->sale_id;?>"
                        data-sale_code="<?php echo $rs->sale_code;?>"
                        data-t1="<?php echo number_format($rs->total-
                        $rs->total_dc-$rs->total_paid);?>"
                        ><i class="fas fa-check" style="margin-right: 4px;"></i>ເລືອກ</button>
                    </td>
                </tr>

                <?php }}?>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-9">
        <div id="receive_money_list"><?php include("receive_money_list.php");?></div>
    </div>
    <div class="col-sm-3">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <h4><u>ລາຍການຮັບຊຳລະໜີ້</u></h4>
            <form action="" id="myform" method="post">
                <input type="hidden" name="sale_id" id="sale_id">
            <table width="100%" class="table-bordered">
                <tr>
                    <td width="160">ເລກທີຂາຍ :</td>
                    <td><input style="text-align:right;" readonly type="text" class="form-control" name="sale_code" id="sale_code"></td>
                </tr>
                <tr>
                    <td>ຍອດທີ່ຍັງຄ້າງ :</td>
                    <td><input style="text-align:right;" value="0" readonly type="text" class="form-control" name="t1" id="t1"></td>
                </tr>
                <tr>
                    <td>ຍອດຮັບຊຳລະ :</td>
                    <td>
                        <input style="text-align:right;" value="0" type="text" 
                        onkeyup="dokeyup(this);cal_total();" onchange="dokeyup(this);" onkeypress="checknumber();"
                        class="form-control" name="t2" id="t2">
                    </td>
                </tr>
                <tr>
                    <td>ຍອດທີ່ຍັງຄ້າງຕົວຈິງ :</td>
                    <td><input style="text-align:right;" value="0" readonly type="text" class="form-control" name="t3" id="t3"></td>
                </tr>
                <tr>
                    <td>ປະເພດການຮັບຊຳລະ :</td>
                    <td>
                        <select class="form-control" name="recieve_type" id="recieve_type">
                            <option value="c">ຮັບເປັນເງິນສົດ</option>
                            <option value="b">ຮັບເປັນເງິນຝາກ</option>
                        </select>
                    </td>
                </tr>
            </table><hr>

            <button id="save" style="width:100%;" type="button" class="btn btn-primary"><i class="fas fa-save"></i><br>ບັນທຶກລາຍການ</button>
            </form>
        </div>
    </div>
</div>

<script>
     function cal_total(){
        let t1=0;
        let t2=0;
        let t3=0;

        t1=$("#t1").val()
        t2=$("#t2").val()

        t1=t1.replace(/,/g,"");
        t2=t2.replace(/,/g,"");

        t3=t1-t2;
        $("#t3").val(t3.toLocaleString(2));
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
    $(document).ready(function(){
        $("#t2").keyup(function(e){
            if(e.which==13){
                $("#save").focus();
            }
        })
        $("#save").click(function(){
            let t1=0;
            let t2=0;
            let t3=0;

            t1=$("#t1").val()
            t2=$("#t2").val()

            t1=t1.replace(/,/g,"");
            t2=t2.replace(/,/g,"");

            t3=t1-t2;

            if(t2<1){
                swal.fire("","ກະລຸນາລະບຸຈຳນວນເງິນຮັບຊຳລະກ່ອນ!!!","warning");
                return;
            }
            if(t3<0){
                swal.fire("","ທ່ານລະບຸຈຳນວນເງິນບໍ່ຖືກຕ້ອງ!!!","warning");
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
                    url:"recieve_money_save.php",
                    type:"post",
                    data:$("#myform").serialize(),
                    dataType:"json",
                    success:function(data){
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
                        window.open("recieve_money_print.php?sale_code="+data);
                        ajax('recieve_money','mainpage');
                    }
                    })
                    }
                })
            }
            })
        });
        $(".bt_this").click(function(){
            let sale_code=$(this).attr("data-sale_code");
            let t1=$(this).attr("data-t1");
            let sale_id=$(this).attr("data-sale_id");

            $("#sale_id").val(sale_id);
            $("#sale_code").val(sale_code);
            $("#t1").val(t1);
            $("#t2").focus();

            cal_total();
        });
    });
</script>