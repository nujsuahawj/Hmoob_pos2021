<table width="100%" class="table-hover" style="margin-top:10px;">
    <thead>
        <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
            <td width="60">ລຳດັບ</td>
            <td width="120">ລະຫັດສິນຄ້າ</td>
            <td>ລາຍລະອຽດສິນຄ້າ</td>
            <td width="170">ໜ່ວຍຈັດເກັບ</td>
            <td width="92">ເລືອກ?</td>
        </tr>
    </thead>

    <?php
        include("config.php");
        $txt_search="";
        $cb_search="";

        if(isset($_REQUEST["txt_search"]))$txt_search=$_REQUEST["txt_search"];
        if(isset($_REQUEST["cb_search"]))$cb_search=$_REQUEST["cb_search"];

        $sql="
            select
                st.pro_id,
                p.pro_code,
                p.pro_name_2,
                p.pro_sale_price,
                u.un_name
            from 
                tb_pro p,
                tb_unit u,
                tb_pro_in_stock st
            where
                p.un_id=u.un_id
            and st.pro_id=p.pro_id
            and st.st_id=1
            and p.pro_is_cancel='n'
        ";

        if($cb_search=="pro_code"){
            $sql.=" 
                and p.pro_code like '%".$txt_search."%' 
                order by p.pro_code limit 12
            ";
        }elseif($cb_search=="pro_name"){
            $sql.=" 
                and p.pro_name_2 like '%".$txt_search."%' 
                order by p.pro_name_2 limit 12
            ";
        }

        $qry=$conn->query($sql);

        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>

    <tr style="border-bottom:lightgrey 1px solid;">
        <td><?php echo $n++;?></td>
        <td><?php echo $rs->pro_code;?></td>
        <td>
            <?php echo $rs->pro_name_2;?>
        </td>
        <td><?php echo $rs->un_name;?></td>
        
        <td>
            <button type="button" class="btn btn-primary bt_this" style="width:90px;"
            data-pro_id="<?php echo $rs->pro_id?>"
            data-pro_code="<?php echo $rs->pro_code?>"
            data-pro_name_2="<?php echo $rs->pro_name_2?>"
            data-un_name="<?php echo $rs->un_name?>"
            data-pro_sale_price="<?php echo number_format($rs->pro_sale_price,2);?>"
            data-dismiss="modal"
            >
            <i class="fas fa-check" style="margin-right:4px;"></i>ເລືອກ</button>
        </td>
    </tr>

    <?php }}?>
</table>

<script>
    function add_data(){
        // let pro_name_2="";
        // let un_name="";
        // let qty=1;
        // let pro_sale_price=0;
        // let total=0;
        // let pro_id="";

        // qty=$("#qty").val();
        // if(qty=="" || qty=="0"){
        //     qty=1;
        // }

        // $("#pro_code").val(data.pro_code);
        // $("#pro_id").val(data.pro_id);
        // pro_id=$("#pro_id").val();
        // pro_sale_price=(data.pro_sale_price);
        // pro_name_2=(data.pro_name_2);
        // un_name=(data.un_name);

        
    }
    $(document).ready(function(){
        $(".bt_this").click(function(){

            let pro_id=$(this).attr("data-pro_id");
            let pro_code=$(this).attr("data-pro_code");
            let pro_name_2=$(this).attr("data-pro_name_2");
            let un_name=$(this).attr("data-un_name");
            let pro_sale_price=$(this).attr("data-pro_sale_price");
            let qty=$("#qty").val();

            $("#pro_id").val(pro_id);
            $("#pro_code").val(pro_code);
            $("#pro_name_2").val(pro_name_2);
            $("#un_name").val(un_name);
            $("#pro_sale_price").val(pro_sale_price);

            show_qty(pro_code);
            
        //     let count=$("#mytable tr").length;
        // count++;
        // let tr=$("<tr style='border-bottom:lightgrey 1px solid;'></tr>");
        // let td1=$("<td width='60'>"+count+"</td>");
        // let td2=$("<td width='120'>"+pro_code+"</td>");
        // let td3=$("<td width='30'><button onclick='delete_row(this);' style='width:100%' type='button' class='btn btn-danger'><i class='fas fa-minus'></i></button></td>");
        // let td4=$("<td style='padding-left:10px;'>"+pro_name_2+"</td>");
        // let td5=$("<td width='100'>"+un_name+"</td>");
        // let td6=$("<td width='100' align='right'>"+qty+"</td>");
        // let td7=$("<td width='140' align='right'>"+pro_sale_price+"</td>");

        // pro_sale_price=pro_sale_price.replace(/,/g,"");
        // total=qty*pro_sale_price;

        // let td8=$("<td width='140' align='right'>"+total.toLocaleString()+"</td>");
        // let td9=$("<td style='display:none;'>"+pro_id+"</td>");

        // tr.append(td1);
        // tr.append(td2);
        // tr.append(td3);
        // tr.append(td4);
        // tr.append(td5);
        // tr.append(td6);
        // tr.append(td7);
        // tr.append(td8);
        // tr.append(td9);

        // $("#mytable").prepend(tr);
        // cal_net();
        // clear_pro();
        // $("#pro_code").focus();
        });
    });
</script>