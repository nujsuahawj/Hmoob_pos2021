<?php
    include("config.php");
    $output="";

    $buy_code=$_GET["buy_code"];
    $sql="
        select
            p.pro_code,
            b.buy_code,
            p.pro_name,
            un.un_name,
            p.pro_detail,
            b.qty,
            b.buy_price
        from 
            tb_buy_detail b,
            tb_pro p,
            tb_unit un
        where
            b.pro_id=p.pro_id
        and
            b.buy_code='".$buy_code."'
        and 
            un.un_id=p.un_id";
    $qry=$conn->query($sql);

    if(mysqli_num_rows($qry)>0){
        $n=1;
        
        $output.="<table width='100%' class='table-hover'>";
        $output.="<thead>";
        $output.="<tr style='border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;'>";
            $output.="<td width='60'>ລຳດັບ</td>";
            $output.="<td width='100'>ເລກທີຊື້</td>";
            $output.="<td width='120'>ລະຫັດສິນຄ້າ</td>";
            $output.="<td>ລາຍລະອຽດສິນຄ້າ</td>";
            $output.="<td width='120'>ໜ່ວຍນັບ</td>";
            $output.="<td align='right' width='100'>ຈຳນວນຊື້</td>";
            $output.="<td align='right' width='130'>ລາຄາຊື້</td>";
            $output.="<td align='right' width='130'>ມູນຄ່າຊື້</td>";
        $output.="</tr>";
        $output.="</thead>";

        while($rs=mysqli_fetch_object($qry)){
            $output.="<tr style='border-bottom:lightsteelblue 1px solid;'>";
                $output.="<td style='padding-top:10px;'>".$n++;"</td>";
                $output.="<td style='padding-top:10px;'>".$rs->buy_code;"</td>";
                $output.="<td style='padding-top:10px;'>".$rs->pro_code;"</td>";
                $output.="<td style='padding-top:10px;'>".$rs->pro_name.'-'.$rs->pro_detail;"</td>";
                $output.="<td style='padding-top:10px;'>".$rs->un_name;"</td>";
                $output.="<td align='right' style='padding-top:10px;'>".number_format($rs->qty);"</td>";
                $output.="<td align='right' style='padding-top:10px;'>".number_format($rs->buy_price);"</td>";
                $output.="<td align='right' style='padding-top:10px;'>".number_format($rs->qty*$rs->buy_price);"</td>";
            $output.="</tr>";
        }

        $output.="</table>";
    }

    echo $output;
?>