<pre><?
print_r($settings);
?></pre>
<div class="form-div wrap">
	<div class="timemsg"></div>
	<table class="form-table">
		<tbody>
			<tr><th scope="row"><label>Email Alert To:</label> </th><td><input type="text" class="regular-text code" id="eto" name="enq-setting[email]" value="<?php echo $settings['email']['to']; ?>"/>
				<p class="description">seperate emails with comma (,)</p>
			</td></tr>
			<tr><th scope="row">CC: </th><td><input type="text" class="regular-text code" id="ecc" name="enq-setting[cc]" value="<?php echo $settings['email']['cc']; ?>"/> </td></tr>
			<tr><th scope="row">BCC: </th><td><input type="text" class="regular-text code" id="ebcc" name="enq-setting[bcc]" value="<?php echo $settings['email']['bcc']; ?>"/> </td></tr>
			<tr><th scope="row">CRM ID: </th><td><input type="text" class="regular-text code" id="enq_crm" name="anvita-crmid" value="<?php echo $settings['crm'];?>"/> </td></tr>
			<tr><th scope="row">Phone: </th><td><input type="text" class="regular-text code" id="phn" name="phne" value="<?php echo $settings['phone'];?>"/> </td></tr>
		</tbody>
	</table>
	<p class="submit"><input type="button" name="submit" id="enq-settings1" class="button button-primary" value="Save Changes"></p>
</div>