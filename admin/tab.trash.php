<?php
$res=$enqobj->load_enquiry(1);
?>

<div class="enq_pagination_no">Showing result from <?php echo $res['f']+1; ?> to <?php echo $res['c']+$res['f']; ?></div>
<div class="enq_enquirytab">
<?php 
$enqobj->enquiry_list($res);
?>

</div>
<?php 
$enqobj->load_pagination($res['f'],$res['c'],$res['no'],1);
?>