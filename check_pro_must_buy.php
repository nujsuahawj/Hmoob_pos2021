<div style="border-radius: 6px; box-shadow:0 -6px #0099cc, 0 0 20px lightgrey;
                            padding:10px; border:1px solid #d9d9d9; margin-top:20px; background-color:white;">

    <div class="row">
        <div class="col-sm-10">
        <u><h4><i class="fas fa-clipboard-list" style="margin-right:6px; font-size:30px; color:#0099ff;"></i>ລາຍງານສິນຄ້າທີ່ຕ້ອງສັ່ງຊື້</h4></u><hr>
 
        </div>
        <div class="col-sm-2">
            <button type="button" style="width:90px;" class="btn btn-primary 
            float-right" onclick="ajax('mainpage','mainpage');"><i class="fas fa-sign-out-alt"
            style="margin-right:4px;"></i>ອອກ</button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table width="100%" style="margin-top:10px;" class="table-hover">
               <thead>
               <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
                        <td width="70">ລຳດັບ</td>
                        <td width="130">ລະຫັດສິນຄ້າ</td>
                        <td>ລາຍລະອຽດສິນຄ້າ</td>
                        <td width="130">ໜ່ວຍຈັດເກັບ</td>
                        <td width="130" align="right">ຈຸດທີ່ຕ້ອງສັ່ງຊື້</td>
                        <td width="180" align="right">ຈຳນວນລວມຄ້າງສາງ</td>
                        <td width="10"></td>
                    </tr>
               </thead>
               <?php
                    include("config.php");
                    $sql="
                        select 
                            p.pro_code,
                            p.pro_name,
                            p.pro_detail,
                            u.un_name,
                            p.pro_low_to_order,
                            sum(s.qty)as qty
                        from 
                            tb_pro p,
                            tb_unit u,
                            tb_pro_in_stock s
                        where
                            p.un_id=u.un_id
                        and 
                            p.pro_id=s.pro_id
                        and 
                            p.pro_is_cancel='n'
                        group by
                            p.pro_code,
                            p.pro_name,
                            p.pro_detail,
                            u.un_name,
                            p.pro_low_to_order
                        having sum(s.qty)as qty<=p.pro_low_to_order
                        order by 
                            p.pro_name
                    ";

                    $qry=$conn->query($sql);
                    if(mysqli_num_rows($qry)>0){
                        $n=1;
                        while($rs=mysqli_fetch_object($qry)){
               ?>
                <tr style="border-bottom:#bfbfbf 1px solid; ">
                   <td style="padding-top: 10px;"><?php echo $n++;?></td>
                   <td style="padding-top: 10px;"><?php echo $rs->pro_code;?></td>
                   <td style="padding-top: 10px;"><?php echo $rs->pro_name." ".$rs->pro_detail;?></td>
                   <td style="padding-top: 10px;"><?php echo $rs->un_name;?></td>
                   <td align="right" style="padding-top: 10px;"><?php echo number_format($rs->pro_low_to_order);?></td>
                   <td align="right" style="padding-top: 10px;"><?php echo number_format($rs->qty);?></td>
               </tr>
               <?php }}?>
            </table>
        </div>
    </div>
</div>