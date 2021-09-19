<div style="background-color:white; box-shadow:0 -4px #00ccff; border-radius:6px; margin-top:10px;">
    <table width="100%" class="table-hover">
        <thead>
        <tr style="border-bottom: lightsteelblue 2px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="120">ເລກທີຊື້</td>
            <td width="120">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="140">ໜ່ວຍນັບ</td>
            <td width="100" align="center">ຈຳນວນ</td>
            <td width="140" align="right">ລາຄາ</td>
            <td width="140" align="right">ມູນຄ່າຂາຍ</td>
        </tr>
        </thead>
        <?php 
            include("config.php");
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
                    un.un_id=p.un_id
            ";
            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>
        <tr style="border-bottom: lightgrey 1px solid;">
            <td style="padding-top:14px;"><?php echo $n++;?></td>
            <td style="padding-top:14px;"><?php echo $rs->buy_code;?></td>
            <td style="padding-top:14px;"><?php echo $rs->pro_code;?></td>
            <td style="padding-top:14px;"><?php echo $rs->pro_name."-".$rs->pro_detail;?></td>
            <td style="padding-top:14px;"><?php echo $rs->un_name;?></td>
            <td style="padding-top:14px;" align="center"><?php echo number_format($rs->qty,2);?></td>
            <td style="padding-top:14px;" align="right"><?php echo number_format($rs->buy_price,2);?></td>
            <td style="padding-top:14px;" align="right"><?php echo number_format($rs->qty*$rs->buy_price,2);?></td>
        </tr>
        <?php }}?>
    </table>
</div>