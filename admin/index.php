<?php
$enqobj=new Enquiryadmin();
if(isset($_POST['enq-setting'])) $enqobj->saveSettings($_POST['enq-setting']);

$settings=$enqobj->getSettings();
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

	$('.enq_page').click(function(){
		var pg=$(this).attr('data-page');
		var d=$(this).attr('data-isdeleted');
		var obj=$(this);
		var parent=obj.closest('.tab-pane');
		parent.find('.enq_page').removeClass('enq_current');	
		var enqcover=enq_show_loading();
		var data={ action: 'enquiry_list' , p: pg ,d : d};
		$.post(ajaxurl, data, function(response) {
			if(response.substr(response.length - 1)==Number(0)){
				response=response.slice(0, -1);
			} 
			parent.find('.enq_enquirytab').html(response);
			obj.addClass('enq_current');
			no=(Number(pg)*10)+1;
			len=((parent.find('.enq_enquirytab table tr').length-1)/2)-1;
			parent.find(".enq_pagination_no").html("Showing result from "+no+" to "+(no+len));
		}).fail(function(response) {
			
		  }).always(function() {
			enqcover.remove();
		});
		return false;
		
	});


	$(document).on('click','.enq_trash_app',function(){
		if(confirm("Are you sure ?")){
			var enqcover=enq_show_loading();
			var obj=$(this).closest('.tab-pane');
			var data={ action: 'enquiry_trash' , id: $(this).attr('data-id'), d: $(this).attr('data-isdeleted') };
			console.log(data);
			$.post(ajaxurl, data, function() {
				obj.find( ".enq_page.enq_current" ).trigger( "click" );					
			}).fail(function(response) {
				
			  }).always(function() {
				enqcover.remove();
			});
			
		}
		return false;
		});	

	$("#enq-settings1").click(function(){
		var eto=$('#eto').val();
		var ecc=$('#ecc').val();
		var ebcc=$('#ebcc').val();
		var enq_crm=$('#enq_crm').val();
		var phn=$('#phn').val();
		var obj=$(this);
		if(enq_validateemail(eto)&&enq_validateemail(ecc)&&enq_validateemail(ebcc)){

			var enqcover=enq_show_loading();
			
			var data={ action: 'enq_update_options' , field: 'alertdetails', to: eto, cc: ecc, bcc: ebcc, crm: enq_crm, phone: phn };	
			console.log(data);
			$.post(ajaxurl, data, function(response) {
				if(response.resp){
					enq_show_msg(obj.closest('.wrap'),"Settings updated successfully");
				}
			}).fail(function(response) {
				 
			  }).always(function() {
				enqcover.remove();
			});
			
		}
		else enq_show_msg(obj.closest('.wrap'),"Invalid Emails");
		
	});
	
	function enq_show_loading(){
		ph=$('.anvita-enq .tab-pane.active').height();	
		var enqcover=$('<div class="enq-cover-panel" style="height:'+ph+'px"><img src="'+enq_appo.pluginurl+'loading.gif"/></div>');			
		$('.anvita-enq .tab-pane.active').append(enqcover);
		return enqcover;
	}
	function enq_show_msg(obj,msg){
		$('.anvita-enq .timemsg').html("");
		$('.anvita-enq .timemsg').removeClass("enq-shown");
		var msgbox=obj.find('.timemsg');
		msgbox.addClass("enq-shown");
		msgbox.html(msg);
	}

	function enq_validateemail(email){
		if(email!=""){
		var emails=email.split(',');
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var validstatus=true;
		jQuery.each(emails,function(k,e){
			if(!regex.test(e)) validstatus=false;
		});
		return validstatus;	
		}
		else return true;
	}
	
})(jQuery);

</script>