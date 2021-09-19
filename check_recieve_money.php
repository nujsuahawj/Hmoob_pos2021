<div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
<u><h4><i class="fas fa-coins" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍງານການຮັບຊຳລະໜີ້ຈາກລູກຄ້າ</h4></u><hr>
   
    <div class="row">
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <td width="50%">ຕັ້ງແຕ່ວັນທີ</td>
                    <td>ຫາວັນທີ</td>
                </tr>
                <tr>
                    <td><input value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="date_start" id="date_start"></td>
                    <td><input value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="date_end" id="date_end"></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-9">
            <button style="margin-left:6px;" type="button" class="btn btn-primary"
            onclick="ajax('check_recieve_list&date_start='+document.getElementById('date_start').value+'&date_end='+document.getElementById('date_end').value,'check_recieve_list');">
            <i class="fas fa-search"></i><br>ຄົ້ນຫາລາຍການ</button>
            <button onclick="window.open('check_recieve_list_print.php?date_start='+document.getElementById('date_start').value+'&date_end='+document.getElementById('date_end').value);" type="button" class="btn btn-primary"><i class="fas fa-print"></i><br>ພິມລາຍການ</button>
            <button type="button" class="btn btn-primary float-right" onclick="ajax('mainpage','mainpage');"><i class="fas fa-sign-out-alt"></i><br>ອອກລາຍການ</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="check_recieve_list"></div>
        </div>
    </div>
</div>

