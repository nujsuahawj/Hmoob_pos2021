<table width="100%" style="margin-top: 10px;">
    <tr style="border-top:#0099ff 4px solid;border-bottom:lightgrey 1px solid;">
        <td width="100">ລຳດັບ</td>
        <td width="140">ປະຈຳວັນທີ</td>
        <td width="140">ຊ່ວງເວລາທີ່ຂາຍ</td>
        <td width="150" align="right">ຍອດຂາຍທັງໝົດ</td>
        <td></td>
    </tr>
</table>
<?php
    include("config.php");
    $date_start=$_REQUEST["date_start"];
    $date_end=$_REQUEST["date_end"];

    $sql="
        select 
            date(sale_date)as sale_date,
            concat(hour(sale_date),':00-',concat(hour(sale_date),':59'))as hour,
            sum(total-total_dc)as total
        from tb_sale
        where date(sale_date) between '".$date_start."' and '".$date_end."'
        group by date(sale_date),hour(sale_date)
        order by date(sale_date),hour(sale_date)
    ";
    $qry=$conn->query($sql);
?>
<table class="table-hover">
    <?php
        if(mysqli_num_rows($qry)>0){
            $n=1;
            while($rs=mysqli_fetch_object($qry)){
    ?>
    <tbody>
    <tr style="border-bottom:lightgray 1px solid;">
        <td width="100"><?php echo $n++;?></td>
        <td width="140"><?php echo date("d-m-Y",strtotime($rs->sale_date));?></td>
        <td width="140"><?php echo $rs->hour;?></td>
        <td width="150" align="right"><?php echo number_format($rs->total);?></td>
        <td></td>
    </tr>
    </tbody>
    <?php }}?>
</table>