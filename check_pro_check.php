<div style="box-shadow:0px -3px #0099ff; margin-top:10px;">
    <table width="100%" class="table-hover table-bordered">
        <thead>
        <tr style="border-bottom: lightgray 2px solid;" align="center">
            <td width="80">ລຳດັບ</td>
            <td width="150">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="130">ໜ່ວຍນັບ</td>
            <td width="130">ລາຄາຊື້</td>
            <td width="130">ລາຄາໜ້າຮ້ານ</td>
            <td width="130">ລາຄາສົ່ງ</td>
            <td width="130">ລາຄາ VIP</td>
        </tr>
        </thead>
        <?php
            include("config.php");
            $txt_search="";
            $cb_search="";
            
            if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];
            if(isset($_REQUEST["cb_search"]))$cb_search=$_REQUEST["cb_search"];

            $sql="
                select p.pro_code,p.pro_name,p.pro_detail,u.un_name,p.pro_buy_price,
                p.pro_sale_price,p.pro_sale_price_2,p.pro_sale_price_vip
                from tb_pro p,tb_unit u
                where p.un_id=u.un_id
            ";

            if($cb_search=="pro_code"){
                $sql.=" and p.pro_code like '%".$txt_search."%'
                order by p.pro_code";
            }else{
                $sql.=" and p.pro_name like '%".$txt_search."%'
                order by p.pro_name";
            }

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>
        <tr>
            <td align="center" style="padding-top:6px;"><?php echo $n++;?></td>
            <td align="center" style="padding-top:6px;"><?php echo $rs->pro_code;?></td>
            <td style="padding-top:6px;"><?php echo $rs->pro_name."-".$rs->pro_detail;?></td>
            <td align="center" style="padding-top:6px;"><?php echo $rs->un_name;?></td>
            <td align="right" style="padding-top:6px;"><?php echo number_format($rs->pro_buy_price);?></td>
            <td align="right" style="padding-top:6px;"><?php echo number_format($rs->pro_sale_price);?></td>
            <td align="right" style="padding-top:6px;"><?php echo number_format($rs->pro_sale_price_2);?></td>
            <td align="right" style="padding-top:6px;"><?php echo number_format($rs->pro_sale_price_vip);?></td>
        </tr>
        <?php }}?>
    </table>
</div>