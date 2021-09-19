<?php
    include("config.php");
    $sale_code=$_GET["sale_code"];
    $output="";

    $sql="
        select
            s.sale_code,
            p.pro_code,
            p.pro_name,
            p.pro_detail,
            u.un_name,
            s.qty,
            s.sale_price,
            st.st_name
        from tb_sale_detail s,tb_pro p,tb_unit u,tb_stock st,tb_sale ss
        where s.pro_id=p.pro_id
        and p.un_id=u.un_id
        and s.sale_code=ss.sale_code
        and st.st_id=ss.st_id
        and s.sale_code='".$sale_code."'
        order by s.sale_id
    ";

    $qry=$conn->query($sql);
    if(mysqli_num_rows($qry)>0){
        $output="
            <table width='100%' class='table-hover' style='margin-top:10px;'>
                <thead>
                    <tr style='border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;'>
                        <td width='60'>ລຳດັບ</td>
                        <td width='110'>ເລກທີຂາຍ</td>
                        <td width='120'>ລະຫັດສິນຄ້າ</td>
                        <td>ລາຍລະອຽດສິນຄ້າ</td>
                        <td width='120'>ໜ່ວຍນັບ</td>
                        <td width='140'>ສາງຈັດເກັບ</td>
                        <td align='right' width='140'>ມູນຄ່າລວມ</td>
                    </tr>
                </thead>
        ";
        $n=1;
        while($rs=mysqli_fetch_object($qry)){
            $output.="
                    <tr style='border-bottom:lightsteelblue 1px solid;'>
                        <td>".$n++."</td>
                        <td>".$rs->sale_code."</td>
                        <td>".$rs->pro_code."</td>
                        <td>"
                            .$rs->pro_name.'-'.$rs->pro_detail."<br>("
                            .number_format($rs->qty).") x (".number_format($rs->sale_price).")".
                        "</td>
                        <td>".$rs->un_name."</td>
                        <td>".$rs->st_name."</td>
                        <td align='right'>".number_format($rs->qty*$rs->sale_price)."</td>
                    </tr>
            ";
        }
        $output.="</table>";
        echo $output;
    }
?>