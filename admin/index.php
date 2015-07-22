<?php
$enqobj=new Enquiryadmin();
if(isset($_POST['enq-setting'])) $enqobj->saveSettings($_POST['enq-setting']);

$settings=$enqobj->getSettings();
$largeenq_settings=$enqobj->getlargeenqSettings();
?>
<div class="anvita-enq">
	<div class="panel panel-default">
		<div class="panel-heading">Enquiry <?php echo $settings['ver']; ?></div>
			<div class="panel-body">
				<ul class="nav-tabs" role="tablist" id="anvita-enq-tab">
  					<li role="presentation" class="active"><a href="#enq-applist" class="dashicons-before dashicons-backup" aria-controls="home" role="tab" data-toggle="tab">Enquiry</a></li>
 					<li role="presentation"><a href="#enq-settings" class="dashicons-before dashicons-admin-generic" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  					<li><a href="#enq-trash" aria-controls="trash" role="tab" data-toggle="tab">Trash</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="enq-applist">
						<?php require_once 'tab.enquiries.php';?>  
					</div>
					<div role="tabpanel" class="tab-pane" id="enq-settings">
						<?php require_once 'tab.settings.php';?>  
					</div>
					<div role="tabpanel" class="tab-pane" id="enq-trash">
						<?php require_once 'tab.trash.php';?>  
					</div>
				</div>
			</div>
	</div>
</div>

<script type="text/javascript">
var enq_appo={pluginurl:"<?php echo ANVITA_ENQUIRY_PLUGIN_URL;?>"};

(function($){
	$('#anvita-enq-tab li>a').click(function(){
		var obj=$(this).attr('href');
		$('.active').removeClass('active');
		$(this).parent().addClass('active');
		$(obj).addClass('active');
		return false;
	});

	
	
})(jQuery);

</script>