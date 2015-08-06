<div class="anvita-enq large">
	<form method='post' enctype='multipart/form-data' name='enqform'>
		<input type="hidden" class="enq-type" name="enq-type" value="large"/>
		<div class="enq_msg" style="width:100%;"></div>
			<div class='lightbg'><span class='red'>*</span>Describe Your Requirements in Detail</div>
			<textarea Placeholder='Message' class='form-control enq-input enq-address' name='enq-msg'></textarea>
			<div class='lightbg'>Please Fill Your Contact Information</div>
			
			<div class="anv_row">
			<div class="anv_30"><span class='red'>*</span>Name:</div>
			<div class="anv_70"><input type='text' name='enq-name' class='form-control enq-name enq-input' placeholder='Name'/></div>
			</div>
			
			<div class="anv_row">
			<div class="anv_30">Age :</div>
			<div class="anv_70"><input type='text' name='enq-age' class="form-control enq-age enq-input"/></div>
			</div>
			
			<div class="anv_row">
			<div class="anv_30"><span class='red'>*</span>Email:</div>
			<div class="anv_70"><input type='text' name='enq-email' class='form-control enq-input enq-email' placeholder='Email'/></div>
			</div>
			
			<div class="anv_row">
			<div class="anv_30">Address</div>
			<div class="anv_70"><textarea  name='enq-address' class='enq-input enq-address form-control'></textarea></div>
			</div>
			
			<div class="anv_row">
			<div class="anv_30"><span class='red'>*</span>Country:</div>
			<div class="anv_70">
			<select name='enq-country' class="enq-country anv_select_country select form-control enq-input">
				<option disabled selected>Select Country</option>
			</select>
			<input type='hidden' class='enq-selectedCountry' name='enq-selectedCountry'/><br/>
			</div>
			</div>
			
			<div class="anv_row">
			<div class="anv_30">City</div>
			<div class="anv_70"><input type='text' name='enq-city' id='enqs-city' class='form-control enq-input enq-city' placeholder='City'/></div>
			<div class="anv_clear"></div>
			</div>
			
			<div class="anv_phone">
			
			<div class="mobile_box anv_row">
				<div class="anv_30">Mobile</div>
				<div class="anv_70">
				<input name='phonecode' style='width:40%; float:left;' id='phonecode' type='text' class='form-control enq-newval enq-input phonecode'>	
				<input style='width:58%; float:left;' name='phone' id='phone1' type='text' class='quickenqfield form-control mobi enq-newval enq-input enq-phone' placeholder='Phone'/>
				</div>
			</div>
			
			<div class="mobile_box anv_row">
				<div class="anv_30">Landline</div>
				<div class="anv_70">
				<input style='width:20%; float:left;' type='text' class='form-control land enq-input enq-newval phonecode2' id='phonecode2' name='phonecode2' />
				<input style='width:20%; float:left;' type='text' id='areacode' class='form-control land enq-newval enq-input enq-area' name='areacode' placeholder='Area Code'/>
				<input style='width:57%; float:left;' type='text' id='phone2' class='form-control land enq-newval enq-input enq-phone2' name='phone2' placeholder='Phone'/>
				</div>
				<div class="anv_clear"></div>
			</div>
			</div>
			
<<<<<<< HEAD
			
			
=======
>>>>>>> origin/master
			<div class="anv_row">
			<div class="anv_30">Attach Document:</div>
			<div class="anv_70"><input required data-extensions="doc,odt,docx,pdf,jpg,jpeg,png,xls,xlsx" class="enq-file enq-input enq-file form-control" name='enq-att' type='file' id='file'/></div>
			</div>
			
			<div class="anv_row">
			<div class="anv_30">Attach Document:</div>
			<div class="anv_70"><input data-extensions="doc,odt,docx,pdf,jpg,jpeg,png,xls,xlsx" class="enq-file enq-input enq-file form-control" name='enq-att2' type='file' id='file'/></div>
			</div>
			
			<div class="anv_row">
				<div class="anv_30"><span class='red'>*</span>Enter the code:</div>
				
				<div class="captcha">
				<?php $enq_rand='enq-'.rand(0,999); ?>
				<input type="hidden" class="enq-captchavar" name="enq-var" value="<?php echo $enq_rand; ?>"/>
				<input type="text" style="width:30%; float:left;" class="enq-captcha enq-input form-control" placeholder="Captcha" name="enq-captcha"/>
				<img class="enq-captchaimg" style="float:left;" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL.'captcha.php?var='.$enq_rand; ?>"/>
				<img class="enq-refresh" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>refresh.png"/>
				</div>
				<div class="anv_clear"></div>
			</div>	
			<div>
				<div class="enq-submit"><button type="button" class="enq-button enq-btn-active">Submit</button></div><br/>
				<div align='left'> (<span class='red'>*</span> represents compulsory fields )</div>
			</div>
			
	</form>
</div>