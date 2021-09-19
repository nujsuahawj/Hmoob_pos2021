
<div class="modal fade" id="sale_pro_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="padding: 10px;">
            <div class="row">
                <div class="col-sm-9">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="">ຄົ້ນຫາລາຍການຕາມ :</label>
                            <select name="cb_search" id="cb_search" class="form-control">
                                <option value="pro_code">ລະຫັດສິນຄ້າ</option>
                                <option value="pro_name">ຊື່ສິນຄ້າ</option>
                            </select>
                            <input type="text" name="" id="" class="form-control" onkeyup="
                            if(this.value!='')ajax('sale_pro_list&txt_search='+this.value+'&cb_search='+
                            document.getElementById('cb_search').value+'&st_id='+
                            document.getElementById('st_id').value,'sale_pro_list');
                            ">
                        </div>
                    </form>
                </div>
                <div class="col-sm-3">
                    <button data-dismiss="modal" style="width:90px;" type="button" class="btn btn-primary float-right"><i class="fas fa-sign-out-alt" style="margin-right: 4px;"></i>ອອກ</button>
                </div>
            </div>

            <div id="sale_pro_list"></div>
        </div>
    </div>
</div>