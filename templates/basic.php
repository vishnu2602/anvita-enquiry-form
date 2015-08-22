<div class="anvita-enq basic">
	<form method='post' role='form' name='quickcontact' id='quickcontact'>
		<div style="width:100%;" class="enq_msg"></div>
		<input type="hidden" class="enq-type" name="enq-type" value="normal"/>
<textarea Placeholder='Your Requirement' class='form-control enq-input enq-address' name='enq-msg' id='enq-msg'></textarea>
		
		<input type='text' name='enq-name' id='enqs-name' class='form-control enq-name enq-input' placeholder='Name'/>
		<input type='text' name='enq-email' id='enqs-email' class='form-control enq-input enq-email' placeholder='Email'/>
		<select name='enq-country' class="enq-country anv_select_country form-control enq-input select" id='enq-country'>
			<option disabled selected>Select Country</option>
		</select>
		<input type='hidden' class='enq-selectedCountry' name='enq-selectedCountry' id='enq-selectedCountry'/>
		
		<input type='text' name='enq-city' id='enqs-city' class='form-control enq-input enq-city' placeholder='City'/>
		
		<div class="anv_phone">
		<div class="mobile_box">
			<div style="width:20%; float:left;"><input name='phonecode' id='phonecode' type='text' class='form-control enq-newval enq-input phonecode'></div>	
			<div style="width:79%; float:left;"><input style="margin-left:3px;" name='phone' id='phone1' type='text' class='quickenqfield form-control mobi enq-newval enq-input enq-phone' placeholder='Phone'/></div>
			<div class="anv_clear"></div>
		</div>	
		<div class="mobile_box">
			<div style="width:20%; float:left;"><input type='text' class='form-control land enq-input enq-newval phonecode2' id='phonecode2' name='phonecode2' /></div>
			<div style="width:29%; float:left;"><input style="margin-left:2px;" type='text' id='areacode' class='form-control land enq-newval enq-input enq-area' name='areacode' placeholder='Area Code'/></div>
			<div style="width:50%; float:left;"><input style="margin-left:3px;" type='text' id='phone2' class='form-control land enq-newval enq-input enq-phone2' name='phone2' placeholder='Phone'/></div>
			<div class="anv_clear"></div>
		</div>
		</div>
		
		<div class="captcha">
		<?php $enq_rand='enq-'.rand(0,999); ?>
		<input type="hidden" class="enq-captchavar" name="enq-var" value="<?php echo $enq_rand; ?>"/>
			<div style="width:40%; float:left;"><input type="text" class="enq-captcha enq-input form-control" placeholder="Captcha" name="enq-captcha"/></div>
			<div style="width:60%; float:left; margin:5px 0;"><img style="width:90px;" class="enq-captchaimg" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL.'captcha.php?var='.$enq_rand; ?>"/>
			<img class="enq-refresh" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>refresh.png"/>
			</div>
		<div style="clear:both;"></div>
		</div>

		<div class="enq-submit"><button type="button" class="enq-button enq-btn-active">Submit</button></div>
	</form>


</div>