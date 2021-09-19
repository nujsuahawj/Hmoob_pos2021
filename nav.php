<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown active">
                <?php if($_SESSION["us_type"]=="admin"){?>
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">1. ຂໍ້ມູນຫຼັກ</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#" onclick="ajax('protype','mainpage');">1-1 ລາຍການປະເພດສິນຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('unit','mainpage');">1-2 ລາຍການໜ່ວຍນັບ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('pro','mainpage');">1-3 ລາຍການສິນຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('em','mainpage');">1-4 ລາຍການພະນັກງານ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('cus','mainpage');">1-5 ລາຍການລູກຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('sup','mainpage');">1-6 ລາຍການຜູ້ສະໜອງ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('stock','mainpage');">1-7 ລາຍການສາງຈັດເກັບສິນຄ້າ</a>
                </div>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">2. ວຽກງານປະຈຳວັນ</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#" onclick="ajax('buy','mainpage');">2-1 ລາຍການຊື້ສິນຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('sale','mainpage');">2-2 ລາຍການຂາຍສົ່ງ</a>
                    <?php }?>
                    <a class="dropdown-item" href="#" onclick="ajax('sale_front','mainpage');">2-3 ລາຍການຂາຍໜ້າຮ້ານ</a>
                    <?php if($_SESSION["us_type"]=="admin"){?>
                    <a class="dropdown-item" href="#" onclick="ajax('move','mainpage');">2-4 ລາຍການເຄື່ອນຍ້າຍສິນຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('re_move','mainpage');">2-5 ລາຍການຮັບສິນຄ້າທີ່ເຄື່ອນຍ້າຍ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('paid','mainpage');">2-6 ລາຍການຊຳລະໜີ້ໃຫ້ແກ່ຜູ້ສະໜອງ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('recieve_money','mainpage');">2-7 ລາຍການຮັບຊຳລະໜີ້ຈາກລູກຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('my_explode','mainpage');">2-8 ລາຍການແຍກຍ່ອຍສິນຄ້າ</a>
                </div>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">3. ລາຍງານ</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#" onclick="ajax('check_buy','mainpage');">3-1 ລາຍການຊື້ສິນຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_sale','mainpage');">3-2 ລາຍການຂາຍສິນຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_recieve_money','mainpage');">3-3 ລາຍການຮັບຊຳລະໜີ້ຈາກລູກຄ້າ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_paid_money','mainpage');">3-4 ລາຍການຊຳລະໜີ້ໃຫ້ຜູ້ສະໜອງ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_pro_in_stock','mainpage');">3-5 ລາຍການສິນຄ້າຄ້າງສາງ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_pro_must_buy','mainpage');">3-6 ລາຍການສິນຄ້າທີ່ຕ້ອງສັ່ງຊື້</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_sale_good','mainpage');">3-7 ລາຍການຊ່ວງເວລາທີ່ຂາຍດີ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('check_pro','mainpage');">3-8 ລາຍການສິນຄ້າທັງໝົດ</a>
                </div>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">4. ຕັ້ງຄ່າລະບົບ</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#" onclick="ajax('com','mainpage');">4-1 ກຳນົດຂໍ້ມູນສຳນັກງານ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('user_add','mainpage');">4-2 ເພີ່ມຜູ້ນຳໃຊ້ລະບົບ</a>
                    <a class="dropdown-item" href="#" onclick="ajax('reg','mainpage');">4-3 ລົງທະບຽນເພື່ອນຳໃຊ້ລະບົບ</a>
                </div>
            </li>
            <?php }?>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">5. ອອກຈາກລະບົບ</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="logout.php">5-1 ອອກຈາກລະບົບ</a>
                </div>
            </li>
        </ul>
    </div>
</nav>