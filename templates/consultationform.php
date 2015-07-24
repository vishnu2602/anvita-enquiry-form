<div class="anvita-enq large">consult  
	<form method='post' enctype='multipart/form-data' name='enqform'>
		<input type="hidden" class="enq-type" name="enq-type" value="consult"/>
		<div class="enq_msg" style="width:100%;"></div>
			<div class='lightbg'><span class='red'>*</span>Describe Your Requirements in Detail</div>
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<textarea Placeholder='Messages' class='form-control enq-input enq-address' name='enq-msg'></textarea>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='lightbg'>Please Fill Your Contact Information</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>	
					<div><span class='red'>*</span>Name:</div>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<input type='text' name='enq-name' style="width:70%;" class='form-control enq-name enq-input' placeholder='Name'/>
				</div>
			</div>
					
			<div style="width:30%; float:left;">Age :</div><input type='text' style="width:70%;" name='enq-age' class="form-control enq-age enq-input"/><br/>
			<div style="width:30%; float:left;"><span class='red'>*</span>Email:</div>
			<input type='text' name='enq-email' style="width:70%;" class='form-control enq-input enq-email' placeholder='Email'/><br/>
			<div style="width:30%; float:left;">Address</div>
			<textarea  name='enq-address' style="width:70%;" class='enq-input enq-address form-control'></textarea>
			<div style="width:30%; float:left;"><span class='red'>*</span>Country:</div>
			<select name='enq-country' style="width:70%;" class="enq-country anv_select_country select form-control enq-input" onChange='getSelectedCountry()'>
				<option disabled selected>Select Country</option>
			</select>
			<input type='hidden' class='enq-selectedCountry' name='enq-selectedCountry'/><br/>
			<div class="mobile_box" style="float:left; width:100%;">
				<div style="width:30%; float:left;">Mobile</div>
				<div style="width:70%; float:left;">
				<input name='phonecode' style='width:40%; float:left;' id='phonecode' type='text' class='form-control enq-newval enq-input phonecode'>	
				<input style='width:60%; float:left;' name='phone' id='phone1' type='text' class='quickenqfield form-control mobi enq-newval enq-input enq-phone' placeholder='Phone'/>
				</div>
			</div>
			<div class="mobile_box" style="float:left;">
				<div style="width:30%; float:left;">Landline</div>
				<input style='width:20%; float:left;' type='text' class='form-control land enq-input enq-newval phonecode2' id='phonecode2' name='phonecode2' />
				<input style='width:20%; float:left;' type='text' id='areacode' class='form-control land enq-newval enq-input enq-area' name='areacode' placeholder='Area Code'/>
				<input style='width:30%; float:left;' type='text' id='phone2' class='form-control land enq-newval enq-input enq-phone2' name='phone2' placeholder='Phone'/>
			</div>
			<!--  Attach Document:<br/>
			<input class="enq-file enq-input form-control" name='enq-att' type='file' id='file' size='13'/><br/>-->
			<div style="width:30%; float:left;"><span class='red'>*</span>Enter the code:</div>
			<div class="captcha">
			<?php $enq_rand='enq-'.rand(0,999); ?>
			<input type="hidden" class="enq-captchavar" name="enq-var" value="<?php echo $enq_rand; ?>"/>
			<input type="text" style="width:30%; float:left;" class="enq-captcha enq-input form-control" placeholder="Captcha" name="enq-captcha"/>
			<img class="enq-captchaimg" style="float:left;" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL.'captcha.php?var='.$enq_rand; ?>"/>
			<br/><img class="enq-refresh" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>refresh.png"/>
			</div>
			<div class="enq-msg"></div>
			<div style='width:100%;'>
				<div class="enq-submit"><button type="button" class="enq-button enq-btn-active">Submit</button></div><br/>
				<div align='left'> (<span class='red'>*</span> represents compulsory fields )</div>
			</div>
	</form>
</div>