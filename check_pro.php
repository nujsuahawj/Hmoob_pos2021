<div class="row">
    <div class="col-sm-12">
    <div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
            <div class="row">
                <div class="col-sm-9">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="">ຄົ້ນຫາລາຍການສິນຄ້າຕາມ :</label>
                            <select name="cb_search" id="cb_search" class="form-control">
                                <option value="pro_code">ລະຫັດສິນຄ້າ</option>
                                <option value="pro_name">ຊື່ສິນຄ້າ</option>
                            </select>
                            <input type="text" name="" id="" class="form-control" onkeyup="
                            if(this.value!='')ajax('check_pro_check&txt_search='+this.value+'&cb_search='+
                            document.getElementById('cb_search').value,'check_pro_check');
                            ">
                        </div>
                        <!-- <button type="button" class="btn btn-primary" style="width:90px; margin-left:10px;"><i class="fas fa-print" style="margin-right:6px;"></i>ພິມ</button> -->
                    </form>
                </div>
                <div class="col-sm-3">
                    <button type="button" onclick="ajax('mainpage','mainpage');" class="btn btn-primary float-right" style="width:90px;"><i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>ອອກ</button>
                </div>
            </div>
            <div id="check_pro_check"><?php include("check_pro_check.php");?></div>
        </div>
    </div>
</div>

<!-- onclick="window.open('check_pro_print.php');" -->