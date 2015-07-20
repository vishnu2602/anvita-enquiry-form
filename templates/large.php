<div class="anvita-enq basic">
	<form method='post' enctype='multipart/form-data' name='enqform'>
		<input type="hidden" class="enq-type" name="enq-type" value="large"/>
		<div class="enq_msg" style="width:100%;"></div>
			<div class='lightbg'><span class='red'>*</span>Describe Your Requirements in Detail</div>
			<textarea Placeholder='Message' class='form-control enq-input enq-address' name='enq-msg'></textarea>
			<div class='lightbg'>Please Fill Your Contact Information</div>
			<div class="sects-1">
				<span class='red'>*</span>Name:<br/>
				<select name='salute' style='width:20%;'>
					<option value='Mr.' selected ='SELECTED'>Mr. </option>
					<option value='Ms.'>Ms. </option>
					<option value='Mrs.'>Mrs. </option>
					<option value='Dr.'>Dr. </option>
				</select>
				<input type='text' name='enq-name' style="width:80%;" class='form-control enq-name enq-input' placeholder='Name'/><br/>
				Age:<br/><input type='text' name='enq-age' class="form-control enq-age enq-input"/><br/>
				<span class='red'>*</span>Email:<br/><input type='text' name='enq-email' class='form-control enq-input enq-email' placeholder='Email'/><br/>
				Appoinment Date:<br/><input type='text' name='enq-date' class='enq-input enq-date form-control datepicker'/><br/>
				Address<br/><textarea  name='enq-address' class='enq-input enq-address form-control'></textarea>
			</div>
			<div class="sects-1">
				<span class='red'>*</span>Country:<br/>
				<select name='enq-country' class="enq-country select form-control enq-input" onChange='getSelectedCountry()'>
					<option disabled selected>Select Country</option>
				</select>
				<input type='hidden' class='enq-selectedCountry' name='enq-selectedCountry'/><br/>
				<div class="mobile_box">
					<div style='width:20%;'><input name='phonecode' id='phonecode' type='text' class='form-control enq-newval enq-input phonecode'></div>	
					<div style='width:80%;'><input name='phone' id='phone1' type='text' class='quickenqfield form-control mobi enq-newval enq-input enq-phone' placeholder='Phone'/></div>
					<div style='width:20%;'><input type='text' class='form-control land enq-input enq-newval phonecode2' id='phonecode2' name='phonecode2' /></div>
					<div style='width:25%;'><input type='text' id='areacode' class='form-control land enq-newval enq-input enq-area' name='areacode' placeholder='Area Code'/></div>
					<div style='width:55%;'><input type='text' id='phone2' class='form-control land enq-newval enq-input enq-phone2' name='phone2' placeholder='Phone'/></div>
				</div>
				Attach Document:<br/>
				<input class="enq-file enq-input form-control" name='enq-att' type='file' id='file' size='13'/><br/>
				<span class='red'>*</span>Enter the code:<br/>
				<div class="captcha">
				<?php $enq_rand='enq-'.rand(0,999); ?>
				<input type="hidden" class="enq-captchavar" name="enq-var" value="<?php echo $enq_rand; ?>"/>
				<input type="text" class="enq-captcha enq-input form-control" placeholder="Captcha" name="enq-captcha"/>
				<img class="enq-captchaimg" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL.'captcha.php?var='.$enq_rand; ?>"/>
				<br/><img class="enq-refresh" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>refresh.png"/>
				</div>
				<div class="enq-msg"></div>
			</div>
			<div style='width:100%;'>
				<div class="enq-submit"><button type="button" class="enq-button enq-btn-active">Submit</button></div><br/>
				<div align='left'> (<span class='red'>*</span> represents compulsory fields )</div>
			</div>
	</form>
</div>