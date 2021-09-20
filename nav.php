<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <style>
            body{
                background-color: #f2f2f2;
            }
            .form-control:focus{
                border:#0099cc 1px solid;
                box-shadow: 0 0 #0099cc;
            }
        </style>
        <link rel="stylesheet" href="./bootstrap-4.5.0-dist/css/bynuj.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/Hmoob_pos2021/"><i class="fa fa-fw fa-home"></i> ໜ້າລັກ</a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-cogs"></i>
            </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown active">
                            <?php if($_SESSION["us_type"]=="admin"){?>
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ຂໍ້ມູນຫຼັກ</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#" onclick="ajax('protype','mainpage');">ລາຍການປະເພດສິນຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('unit','mainpage');">ລາຍການໜ່ວຍນັບ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('pro','mainpage');">ລາຍການສິນຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('em','mainpage');">ລາຍການພະນັກງານ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('cus','mainpage');">ລາຍການລູກຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('sup','mainpage');">ລາຍການຜູ້ສະໜອງ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('stock','mainpage');">ລາຍການສາງຈັດເກັບສິນຄ້າ</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ວຽກງານປະຈຳວັນ</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#" onclick="ajax('buy','mainpage');"> ລາຍການຊື້ສິນຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('sale','mainpage');">ລາຍການຂາຍສົ່ງ</a>
                                <?php }?>
                                <a class="dropdown-item" href="#" onclick="ajax('sale_front','mainpage');">ລາຍການຂາຍໜ້າຮ້ານ</a>
                                <?php if($_SESSION["us_type"]=="admin"){?>
                                <a class="dropdown-item" href="#" onclick="ajax('move','mainpage');"> ລາຍການເຄື່ອນຍ້າຍສິນຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('re_move','mainpage');">ລາຍການຮັບສິນຄ້າທີ່ເຄື່ອນຍ້າຍ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('paid','mainpage');">ລາຍການຊຳລະໜີ້ໃຫ້ແກ່ຜູ້ສະໜອງ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('recieve_money','mainpage');"> ລາຍການຮັບຊຳລະໜີ້ຈາກລູກຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('my_explode','mainpage');"> ລາຍການແຍກຍ່ອຍສິນຄ້າ</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ລາຍງານ</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#" onclick="ajax('check_buy','mainpage');">ລາຍການຊື້ສິນຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_sale','mainpage');"> ລາຍການຂາຍສິນຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_recieve_money','mainpage');"> ລາຍການຮັບຊຳລະໜີ້ຈາກລູກຄ້າ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_paid_money','mainpage');"> ລາຍການຊຳລະໜີ້ໃຫ້ຜູ້ສະໜອງ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_pro_in_stock','mainpage');">ລາຍການສິນຄ້າຄ້າງສາງ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_pro_must_buy','mainpage');"> ລາຍການສິນຄ້າທີ່ຕ້ອງສັ່ງຊື້</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_sale_good','mainpage');">ລາຍການຊ່ວງເວລາທີ່ຂາຍດີ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('check_pro','mainpage');"> ລາຍການສິນຄ້າທັງໝົດ</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ຕັ້ງຄ່າລະບົບ</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#" onclick="ajax('com','mainpage');"> ກຳນົດຂໍ້ມູນສຳນັກງານ</a>
                                <a class="dropdown-item" href="#" onclick="ajax('user_add','mainpage');"> ເພີ່ມຜູ້ນຳໃຊ້ລະບົບ</a>
                            </div>
                        </li>
                        <?php }?>
                        <li class="nav-item justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link active" href="logout.php">ອອກຈາກລະບົບ</a>
                            </li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
    <script>
        $('body').on('mouseenter mouseleave','.dropdown',function(e){
            var _d=$(e.target).closest('.dropdown');
            if (e.type === 'mouseenter')_d.addClass('show');
            setTimeout(function(){
                _d.toggleClass('show', _d.is(':hover'));
                $('[data-toggle="dropdown"]', _d).attr('aria-expanded',_d.is(':hover'));
            },300);
        });
        function toggleDropdown (e) {
            const _d = $(e.target).closest('.dropdown'),
                _m = $('.dropdown-menu', _d);
            setTimeout(function(){
                const shouldOpen = e.type !== 'click' && _d.is(':hover');
                _m.toggleClass('show', shouldOpen);
                _d.toggleClass('show', shouldOpen);
                $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
            }, e.type === 'mouseleave' ? 300 : 0);
        }

            $('body')
            .on('mouseenter mouseleave','.dropdown',toggleDropdown)
            .on('click', '.dropdown-menu a', toggleDropdown);
    </script>

</html>