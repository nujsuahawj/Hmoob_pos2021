<div class="row">
    <div class="col-sm-12">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
        <div class="row">
            <div class="col-sm-10">
                <u><h4>ລາຍການຕິດໜີ້ຜູ້ສະໜອງ</h4></u>
            </div>
            <div class="col-sm-2">
                <button onclick="ajax('mainpage','mainpage');" type="button" style="width:90px;" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt" style="margin-right:4px;"></i> ອອກ</button>
            </div>
        </div>   

        <div style="height:300px; overflow:auto;">
            <table width="100%" class="table-hover table-bordered" style="margin-top:10px;">
                <thead>
                <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                    <td width="80">ລຳດັບ</td>
                    <td width="180">ວັນທີຊື້ສິນຄ້າ</td>
                    <td width="120">ເລກທີຊື້</td>
                    <td>ຕິດໜີ້ຜູ້ສະໜອງ</td>
                    <td align="right" width="130">ຍອດຊື້ສິນຄ້າ</td>
                    <td align="right" width="130">ສ່ວນລຸດ</td>
                    <td align="right" width="130">ຍອດຊື້ຕົວຈິງ</td>
                    <td align="right" width="130">ຊຳລະແລ້ວ</td>
                    <td align="right" style="padding-right:20px;" width="150">ຍອດທີ່ຍັງຄ້າງ</td>
                    <td width="92">ເລືອກ?</td>
                </tr>
                </thead>
                <?php
                // SELECT ``, ``, ``, `sup_id`, `st_id`, ``, ``, `buy_note`, `us_id` FROM `` WHERE 1
                // SELECT `paid_id`, `buy_id`, `buy_date`, `t1`, `t2`, `us_id` FROM `` WHERE 1

                include("config.php");
                    $sql="
                        select
                            b.buy_code,
                            b.buy_id,
                            b.buy_date,
                            b.total,
                            b.total_dc,
                            s.sup_name,
                            (
                                select sum(ifnull(t2,0)) from tb_paid_money where buy_id=b.buy_id
                            )as total_paid
                        from 
                            tb_buy b,
                            tb_sup s
                        where
                            s.sup_id=b.sup_id
                        and 
                            b.is_paid='n'
                        and
                            b.is_cancel='n'
                    ";

                    $qry=$conn->query($sql);
                    if(mysqli_num_rows($qry)>0){
                        $n=1;
                        while($rs=mysqli_fetch_object($qry)){
                ?>
                <tr style="border-bottom: lightgrey 1px solid;">
                    <td><?php echo $n++;?></td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($rs->buy_date));?></td>
                    <td><?php echo $rs->buy_code;?></td>
                    <td><?php echo $rs->sup_name;?></td>
                    <td align="right"><?php echo number_format($rs->total);?></td>
                    <td align="right"><?php echo number_format($rs->total_dc);?></td>
                    <td align="right"><?php echo number_format($rs->total-$rs->total_dc);?></td>
                    <td align="right"><?php echo number_format($rs->total_paid);?></td>
                    <td align="right" style="padding-right:20px; color:red;"><?php echo number_format($rs->total-$rs->total_dc-$rs->total_paid);?></td>
                    <td>
                        <button onclick="ajax('paid_list&buy_id=<?php echo $rs->buy_id;?>','paid_list');"
                        style="width:90px;" type="button" class="btn btn-primary bt_this"
                        data-buy_id="<?php echo $rs->buy_id;?>"
                        data-buy_code="<?php echo $rs->buy_code;?>"
                        data-t1="<?php echo number_format($rs->total-$rs->total_dc-$rs->total_paid);?>"
                        >
                        <i class="fas fa-check" style="margin-right:4px;"></i> ເລືອກ</button>
                    </td>
                </tr>
                <?php }}?>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-9">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <div id="paid_list"></div>
        </div>
    </div>
    <div class="col-sm-3">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <form action="" method="post" id="myform">
                <input type="hidden" name="buy_id" id="buy_id">
                <u><h4>ຂໍ້ມູນການຊຳລະໜີ້</h4></u>
            <table width="100%">
                <tr>
                    <td width="120">ເລກທີຊື້ :</td>
                    <td><input type="text" style="text-align:right;" readonly value="0" class="form-control" name="buy_code" id="buy_code"></td>
                </tr>
                <tr>
                    <td>ຍອດທີ່ຍັງຄ້າງ :</td>
                    <td><input type="text" style="text-align:right;" readonly value="0" class="form-control" name="t1" id="t1"></td>
                </tr>
                <tr>
                    <td>ມູນຄ່າຊຳລະ :</td>
                    <td>
                        <input type="text" style="text-align:right;" value="0" 
                        onkeyup="dokeyup(this);cal_total();" 
                        onchange="dokeyup(this);" onkeypress="checknumber();"
                        class="form-control" name="t2" id="t2">
                    </td>
                </tr>
                <tr>
                    <td>ຍອດທີ່ຍັງເຫຼືອ :</td>
                    <td><input type="text" style="text-align:right;" readonly value="0" class="form-control" name="t3" id="t3"></td>
                </tr>
                <tr>
                    <td>ປະເພດການຊຳລະ :</td>
                    <td>
                        <select class="form-control" name="paid_type" id="paid_type">
                            <option value="c">ຊຳລະເປັນເງິນສົດ</option>
                            <option value="b">ຊຳລະເປັນເງິນຝາກ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                        <button id="save" style="width:100%;" type="button" class="btn btn-primary">
                            <i class="fas fa-save"></i><br>ບັນທຶກລາຍການ
                        </button>
                    </td>
                </tr>
            </table>
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
        });
        $(".bt_this").click(function(){
            $("#t1").val($(this).attr("data-t1"));
            $("#buy_id").val($(this).attr("data-buy_id"));
            $("#buy_code").val($(this).attr("data-buy_code"));
            $("#t2").focus();
            cal_total();
        });
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
                    url:"paid_money_save.php",
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
                        window.open("paid_print.php?buy_code="+data);
                        ajax('paid','mainpage');
                    }
                    })
                    }
                })
            }
            })
        });
    });
</script>