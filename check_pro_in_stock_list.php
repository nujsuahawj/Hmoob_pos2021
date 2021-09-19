<div style="margin-top:10px; ">
    <table width="100%" class="table-hover">
        <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                <td width="80">ລຳດັບ</td>
                <td width="140">ລະຫັດສິນຄ້າ</td>
                <td>ລາຍລະອຽດສິນຄ້າ</td>
                <td width="140">ໜ່ວຍຈັດເກັບ</td>
                <td width="140" align="right">ຈຳນວນຄ້າງສາງ</td>
                <td width="20"></td>
            </tr>
        </thead>
        <?php
            include("config.php");
            $st_id="";
            if(isset($_REQUEST["st_id"]))$st_id=$_REQUEST["st_id"];

            $sql="
                select
                    p.pro_code,
                    p.pro_name,
                    p.pro_detail,
                    u.un_name,
                    s.qty
                from 
                    tb_pro_in_stock s,
                    tb_pro p,
                    tb_unit u
                where
                    s.pro_id=p.pro_id
                and
                    p.un_id=u.un_id
                and
                    p.pro_is_cancel='n'
                and 
                    s.st_id='".$st_id."'
                order by p.pro_name
            ";

            $qry=$conn->query($sql);
            if(mysqli_num_rows($qry)>0){
                $n=1;
                while($rs=mysqli_fetch_object($qry)){
        ?>
        <tr style="border-bottom: #bfbfbf 1px solid;">
            <td style="padding-top: 10px;"><?php echo $n++;?></td>
            <td style="padding-top: 10px;"><?php echo $rs->pro_code;?></td>
            <td style="padding-top: 10px;"><?php echo $rs->pro_name." ".$rs->pro_detail;?></td>
            <td style="padding-top: 10px;"><?php echo $rs->un_name;?></td>
            <td align="right" style="padding-top: 10px;"><?php echo number_format($rs->qty);?></td>
        </tr>
        <?php }}?>
    </table>
</div>