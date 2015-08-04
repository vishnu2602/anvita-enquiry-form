<?php 
$to="";
$cc="";
$bcc="";
$crm="";
$ph="";
if(isset($settings['email']['to'])) $to=$settings['email']['to'];
if(isset($settings['email']['cc'])) $cc=$settings['email']['cc'];
if(isset($settings['email']['bcc'])) $bcc=$settings['email']['bcc'];
if(isset($settings['crm'])) $crm=$settings['crm'];
if(isset($settings['phone'])) $ph=$settings['phone'];

?>
<div class="form-div wrap">
	<div class="timemsg"></div>
	<table class="form-table">
		<tbody>
			<tr><th scope="row"><label>Email Alert To:</label> </th><td><input type="text" class="regular-text code" id="eto" name="enq-setting[email]" value="<?php echo $to; ?>"/>
				<p class="description">seperate emails with comma (,)</p>
			</td></tr>
			<tr><th scope="row">CC: </th><td><input type="text" class="regular-text code" id="ecc" name="enq-setting[cc]" value="<?php echo $cc; ?>"/> </td></tr>
			<tr><th scope="row">BCC: </th><td><input type="text" class="regular-text code" id="ebcc" name="enq-setting[bcc]" value="<?php echo $bcc; ?>"/> </td></tr>
			<tr><th scope="row">CRM ID: </th><td><input type="text" class="regular-text code" id="enq_crm" name="anvita-crmid" value="<?php echo $crm;?>"/> </td></tr>
			<tr><th scope="row">Phone: </th><td><input type="text" class="regular-text code" id="phn" name="phne" value="<?php echo $ph;?>"/> </td></tr>
		</tbody>
	</table>
	<p class="submit"><input type="button" name="submit" id="enq-settings1" class="button button-primary" value="Save Changes"></p>
</div>