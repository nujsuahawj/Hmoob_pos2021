<?php 
    include("config.php");
    $n_date=date("Y-m-d");
    $n_month=date("m");

    $sql_month_buy="
        select sum(total-total_dc)as net
        from tb_buy
        where month(buy_date)='".$n_month."'
    ";
    $qry_moth_buy=$conn->query($sql_month_buy);
    $total_month_buy=0;
    if(mysqli_num_rows($qry_moth_buy)>0){
        $rs_month_buy=mysqli_fetch_object($qry_moth_buy);
        $total_month_buy=$rs_month_buy->net;
    }

    $sql_month="
        select sum(total-total_dc)as net
        from tb_sale
        where month(sale_date)='".$n_month."'
    ";
    $qry_moth=$conn->query($sql_month);
    $total_month=0;
    if(mysqli_num_rows($qry_moth)>0){
        $rs_month=mysqli_fetch_object($qry_moth);
        $total_month=$rs_month->net;
    }

    $sql_sale="
        select
            count(sale_code)as sale_code,
            sum(total-total_dc)as net
        from 
            tb_sale
        where
            date(sale_date)='".$n_date."'
    ";
    $qry_sale=$conn->query($sql_sale);
    
    $total_sale=0;
    $sale_count=0;

    if(mysqli_num_rows($qry_sale)>0){
        $rs_sale=mysqli_fetch_object($qry_sale);
        $total_sale=$rs_sale->net;
        $sale_count=$rs_sale->sale_code;
    }

    $sql_buy="
        select
            sum(total-total_dc)as net
        from 
            tb_buy
        where
            date(buy_date)='".$n_date."'
    ";
    $qry_buy=$conn->query($sql_buy);
    
    $total_buy=0;
    if(mysqli_num_rows($qry_buy)>0){
        $rs_buy=mysqli_fetch_object($qry_buy);
        $total_buy=$rs_buy->net;
    }

    $sql_total_net_month="
        select
            sum((d.qty*d.sale_price)-(d.qty*d.buy_price))as net
        from 
            tb_sale_detail d,tb_sale s
        where
            s.sale_code=d.sale_code
        and month(s.sale_date)='".$n_month."'
    ";
    $qry_total_net_month=$conn->query($sql_total_net_month);
    
    $total_total_net_month=0;

    if(mysqli_num_rows($qry_total_net_month)>0){
        $rs_total_net_month=mysqli_fetch_object($qry_total_net_month);
        $total_total_net_month=$rs_total_net_month->net;
    }

    $sql_total_net="
        select
            sum((d.qty*d.sale_price)-(d.qty*d.buy_price))as net
        from 
            tb_sale_detail d,tb_sale s
        where
            s.sale_code=d.sale_code
        and date(s.sale_date)='".$n_date."'
    ";
    $qry_total_net=$conn->query($sql_total_net);
    
    $total_total_net=0;

    if(mysqli_num_rows($qry_total_net)>0){
        $rs_total_net=mysqli_fetch_object($qry_total_net);
        $total_total_net=$rs_total_net->net;
    }

    $sql_money_recieve="
        select recieve_type,sum(t2)as t2
        from tb_recieve_money
        where date(re_date)='".$n_date."'
        group by recieve_type
    ";

    $qry_money_recieve=$conn->query($sql_money_recieve);
    $total_money_recieve_cash=0;
    $total_money_recieve_bank=0;

    if(mysqli_num_rows($qry_money_recieve)>0){
        while($rs_money_recieve=mysqli_fetch_object($qry_money_recieve)){
            $recieve_type=$rs_money_recieve->recieve_type;

            if($recieve_type=="c"){
                $total_money_recieve_cash=$rs_money_recieve->t2;
            }elseif($recieve_type=="b"){
                $total_money_recieve_bank=$rs_money_recieve->t2;
            }

        }
    }
    
    $sql_money_paid="
        select paid_type,sum(t2)as t2
        from tb_paid_money
        where date(paid_date)='".$n_date."'
        group by paid_type
    ";

    $qry_money_paid=$conn->query($sql_money_paid);
    
    $total_money_paid_cash=0;
    $total_money_paid_bank=0;

    if(mysqli_num_rows($qry_money_paid)>0){
        while($rs_money_paid=mysqli_fetch_object($qry_money_paid)){
            $paid_type=$rs_money_paid->paid_type;

            if($paid_type=="c"){
                $total_money_paid_cash=$rs_money_paid->t2;
            }elseif($paid_type=="b"){
                $total_money_paid_bank=$rs_money_paid->t2;
            }
        }
    }

    $total_money_recieve_cash=$total_money_recieve_cash-$total_money_paid_cash;
    $total_money_recieve_bank=$total_money_recieve_bank-$total_money_paid_bank;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home page</title>
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
<div class="container-fluid">
    <div class="row" style="margin-top:10px;">
        <div class="col">
        <div class="laib" style="border-radius: 6px; box-shadow:0 -6px #DE3163, 0 0 20px lightgrey;
                                padding-bottom:20px; padding-top:20px; border:1px solid #d9d9d9;
                                 margin-top:20px; background-color:white;">
                <center>
                <i class="fas fa-stopwatch-20"></i><br>
                    <label  class="laib1">
                    ຍອດຂາຍວັນນີ້
                    </label><br>
                    <label  class="laib2"><?php echo number_format($total_sale);?> </label>
                </center>
        </div>
        </div>
        <div class="col">
        <div class="laib" style="border-radius: 6px; box-shadow:0 -6px #DE3163, 0 0 20px lightgrey;
                padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fas fa-soap"></i><br><label  class="laib1">
                ຍອດຊື້ວັນນີ້
                </label><br>
                <label  class="laib2"><?php echo number_format($total_buy);?> </label></center>
            </div>
        </div>
        <div class="col">
        <div class="laib" style="border-radius: 6px; box-shadow:0 -6px #DE3163, 0 0 20px lightgrey;
                padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fas fa-trailer"></i><br><label  class="laib1">
                ຜົນໄດ້ຮັບວັນນີ້
                </label><br>
                <label  class="laib2"><?php echo number_format($total_total_net);?></label>
            </center>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;">
        <div class="col">
        <div class="xiav" style="border-radius: 6px; box-shadow:0 -6px Blue, 0 0 20px lightgrey;
                padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fab fa-ideal"></i><br><label class="xiav1" >ຈຳນວນລູກຄ້າວັນນີ້</label><br>
                <label class="xiav2"><?php echo $sale_count;?></label></center>
            </div>
        </div>
        <div class="col">
        <div class="xiav" style="border-radius: 6px; box-shadow:0 -6px Blue, 0 0 20px lightgrey;
                padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fas fa-stopwatch-20"></i><br><label class="xiav1">ຍອດເງິນສົດວັນນີ້</label><br>
                <label class="xiav2"><?php echo number_format($total_money_recieve_cash);?></label></center>
            </div>
        </div>
        <div class="col">
        <div class="xiav" style="border-radius: 6px; box-shadow:0 -6px Blue, 0 0 20px lightgrey;
                padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fas fa-box-tissue"></i><br><label class="xiav1">ຍອດເງິນຝາກວັນນີ້<br></label><br>
                <label class="xiav2"><?php echo number_format($total_money_recieve_bank);?></label></center>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;">
    <div class="col">
        <div class="nyuab" style="border-radius: 6px; box-shadow:0 -6px Green, 0 0 20px lightgrey;
            padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fab fa-shopify"></i><br><label class="nyuab1">ຍອດຂາຍໃນເດືອນນີ້<br></label><br>
                <label class="nyuab2"><?php echo number_format($total_month);?></label>
            </center>
            </div>
        </div>
        <div class="col">
        <div style="border-radius: 6px; box-shadow:0 -6px Green, 0 0 20px lightgrey;
            padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fas fa-pump-medical"></i><br><label class="nyuab1">ຍອດຊື້ໃນເດືອນນີ້</label><br>
                <label class="nyuab2"><?php echo number_format($total_month_buy);?></label></center>
            </div>
        </div>
        <div class="col">
        <div style="border-radius: 6px; box-shadow:0 -6px Green, 0 0 20px lightgrey;
            padding-bottom:20px; padding-top:20px;; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">
                <center><i class="fas fa-hand-holding-medical"></i><br><label class="nyuab1">ຜົນໄດ້ຮັບໃນເດືອນນີ້</label><br>
                <label class="nyuab2"><?php echo number_format($total_total_net_month);?></label>
                </center>
            </div>
        </div>
    </div>
</div>

</body>
</html>
