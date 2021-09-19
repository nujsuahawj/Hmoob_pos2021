<div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
<u><h4><i class="fas fa-tablet-alt" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍງານສິນຄ້າຄ້າງສາງ</h4></u><hr>
  
    <div class="row">
        <div class="col-sm-2">
            <label for="">ສາງຈັດເກັບສິນຄ້າ</label>
            <select name="st_id" id="st_id" class="form-control"
            onchange="if(this.value!='')ajax('check_pro_in_stock_list&st_id='+this.value,'check_pro_in_stock_list');">
                <option value="">ລະບຸລາຍການ</option>
            </select>
        </div>
        <div class="col-sm-10">
            <button type="button" style="margin-top: 8px;" class="btn btn-primary"
            onclick="window.open('check_pro_in_stock_print.php?st_id='+document.getElementById('st_id').value);"
            ><i class="fas fa-print"></i><br>ພິມລາຍການ</button>
            <button type="button" style="margin-top: 8px;" class="btn btn-primary float-right" onclick="ajax('mainpage','mainpage');"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
        </div>
    </div>

    <div id="check_pro_in_stock_list"></div>
</div>

<script>
    show_stock();

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