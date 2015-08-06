<?php
$res=$enqobj->load_enquiry(0);
$dbtable =  $wpdb->prefix . 'anvitaenq';
$enq_count = $wpdb->get_var( "SELECT count(*) from $dbtable where isdeleted=0" );
$enq_forign = $wpdb->get_var( "SELECT count(*) from $dbtable  where country!='India' and isdeleted=0" );
$enq_domestic = $wpdb->get_var( "SELECT count(*) from $dbtable where country='India' and isdeleted=0" );
echo "<h4 style='display:inline-block;'>Total Enquires : {$enq_count}</h4>
<h4 style='margin-left:10px; display:inline-block;'>Domestic Enquires : {$enq_domestic}</h4>
<h4 style='margin-left:10px; display:inline-block;'>Foreign Enquires : {$enq_forign}</h4>";
?>
<div class="enq_pagination_no">Showing result from <?php echo $res['f']+1; ?> to <?php echo $res['c']+$res['f']; ?></div>
<div class="enq_enquirytab">
<?php 
$enqobj->enquiry_list($res);
?>

</div>
<?php 
$enqobj->load_pagination($res['f'],$res['c'],$res['no'],0);
?>