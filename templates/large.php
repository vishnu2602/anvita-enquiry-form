<div class="anvita-enq large">
	<form method='post' enctype='multipart/form-data' name='enqform'>
		<input type="hidden" class="enq-type" name="enq-type" value="large"/>
		<div class="enq_msg" style="width:100%;"></div>
			<div class='lightbg'><span class='red'>*</span>Describe Your Requirements in Detail</div>
			<textarea Placeholder='Message' class='form-control enq-input enq-address' name='enq-msg'></textarea>
			<div class='lightbg'>Please Fill Your Contact Information</div>
			<div style="width:30%; float:left;"><span class='red'>*</span>Name:</div>
			<input type='text' name='enq-name' style="width:70%;" class='form-control enq-name enq-input' placeholder='Name'/>
			<div style="width:30%; float:left;">Age :</div><input type='text' style="width:70%;" name='enq-age' class="form-control enq-age enq-input"/>
			<div style="width:30%; float:left;"><span class='red'>*</span>Email:</div>
			<input type='text' name='enq-email' style="width:70%;" class='form-control enq-input enq-email' placeholder='Email'/>
			<div style="width:30%; float:left;">Address</div>
			<textarea  name='enq-address' style="width:70%;" class='enq-input enq-address form-control'></textarea>
			<div style="width:30%; float:left;"><span class='red'>*</span>Country:</div>
			<select name='enq-country' style="width:70%;" class="enq-country anv_select_country select form-control enq-input" onChange='getSelectedCountry(this)'>
				<option disabled selected>Select Country</option>
			</select>
			<input type='hidden' class='enq-selectedCountry' name='enq-selectedCountry'/>
			<div style="width:30%; float:left;">City</div>
			<input style="width:70%;" type='text' name='enq-city' id='enqs-city' class='form-control enq-input enq-city' placeholder='City'/>
			<div class="mobile_box" style="width:100%;">
				<div style="width:30%; float:left;">Mobile</div>
				<div style="width:70%; float:left;">
				<input name='phonecode' style='width:40%; float:left;' id='phonecode' type='text' class='form-control enq-newval enq-input phonecode'>	
				<input style='width:59%; margin-left:3px; float:left;' name='phone' id='phone1' type='text' class='quickenqfield form-control mobi enq-newval enq-input enq-phone' placeholder='Phone'/>
				</div>
			</div>
			<div class="mobile_box" style="float:left; width:100%;">
				<div style="width:30%; float:left;">Landline</div>
				<input style='width:20%; float:left;' type='text' class='form-control land enq-input enq-newval phonecode2' id='phonecode2' name='phonecode2' />
				<input style='width:19%; margin-left:4px; float:left;' type='text' id='areacode' class='form-control land enq-newval enq-input enq-area' name='areacode' placeholder='Area Code'/>
				<input style='width:29%; margin-left:6px; float:left;' type='text' id='phone2' class='form-control land enq-newval enq-input enq-phone2' name='phone2' placeholder='Phone'/>
			</div>
			<div style="width:30%; float:left;">Attach Document:</div><input style="width:70%; float:left;" class="enq-file enq-input form-control" name='enq-file' type='file' id='file' size='13'/><br/>
			<div style="width:100%;">
				<div style="width:30%; float:left;"><span class='red'>*</span>Enter the code:</div>
				<div class="captcha">
				<?php $enq_rand='enq-'.rand(0,999); ?>
				<input type="hidden" class="enq-captchavar" name="enq-var" value="<?php echo $enq_rand; ?>"/>
				<input type="text" style="width:30%; float:left;" class="enq-captcha enq-input form-control" placeholder="Captcha" name="enq-captcha"/>
				<img class="enq-captchaimg" style="float:left; margin:2px 10px;" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL.'captcha.php?var='.$enq_rand; ?>"/>
				<br/><img class="enq-refresh" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>refresh.png"/>
				</div>
				<div style="clear:both;">
			</div>
			<div class="enq-msg"></div>
			<div style='width:100%;'>
				<div class="enq-submit"><button type="button" class="enq-button enq-btn-active">Submit</button></div>
				<div align='left' style="background:#F3F3F3; padding:5px 10px;"> (<span class='red'>*</span> represents compulsory fields )</div>
			</div>
	</form>
</div>