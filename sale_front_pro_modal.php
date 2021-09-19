
<div class="modal fade" id="sale_front_pro_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="padding:8px;">
        <div class="row">
                <div class="col-sm-8">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="">ຄົ້ນຫາລາຍການຕາມ :</label>
                            <select name="cb_search" id="cb_search" class="form-control">
                                <option value="pro_code">ລະຫັດສິນຄ້າ</option>
                                <option value="pro_name">ຊື່ສິນຄ້າ</option>
                            </select>
                            <input type="text" name="" id="" class="form-control" onkeyup="
                            if(this.value!='')ajax('sale_front_pro_list&txt_search='+this.value+'&cb_search='+
                            document.getElementById('cb_search').value,'sale_front_pro_list');
                            ">
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <button type="button" data-dismiss="modal" class="btn btn-primary float-right" style="width:90px;"><i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>ອອກ</button>
                </div>
            </div>

            <div id="sale_front_pro_list"></div>
        </div>
    </div>
</div>