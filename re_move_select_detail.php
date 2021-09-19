<?php
    include("config.php");
    $mov_code=$_GET["mov_code"];
    // SELECT `mov_id`, `mov_code`, ``, `qty` FROM `` WHERE 1
    
    $sql="
        select
            m.pro_id,
            p.pro_code,
            p.pro_name,
            p.pro_detail,
            u.un_name,
            m.qty
        from tb_pro p,tb_move_detail m,tb_unit u
            where m.pro_id=p.pro_id
            and p.un_id=u.un_id
            and m.mov_code='".$mov_code."'
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $n=1;
        $ouput="
            <table width='100%' class='table-hover' style='margin-top:10px;'>
                <thead>
                <tr style='border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;'>
                    <td width='60'>ລຳດັບ</td>
                    <td width='140'>ລະຫັດສິນຄ້າ</td>
                    <td>ລາຍລະອຽດສິນຄ້າ</td>
                    <td width='130'>ໜ່ວຍຈັດເກັບ</td>
                    <td width='60'>ຈຳນວນ</td>
                </tr>
                </thead>";
            while($rs=mysqli_fetch_object($qry)){
        $ouput.="<tr style='border-bottom:#bfbfbf 1px solid;'>";
        $ouput.="<td width='60' style='padding-top:10px;'>".$n++;"</td>";
        $ouput.="<td width='140' style='padding-top:10px;'>".$rs->pro_code;"</td>";
        $ouput.="<td style='padding-top:10px;'>".$rs->pro_name." ".$rs->pro_detail;"</td>";
        $ouput.="<td width='150' style='padding-top:10px;'>".$rs->un_name;"</td>";
        $ouput.="<td width='60' style='padding-top:10px;'>".number_format($rs->qty);"</td>";
        $ouput.="</tr>";
    }}
        $ouput.="</table>
        ";

    echo $ouput;
?>