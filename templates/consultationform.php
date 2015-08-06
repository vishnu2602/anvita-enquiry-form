<div class="anvita-enq large">
	<form method='post' enctype='multipart/form-data' name='enqform'>
		<input type="hidden" class="enq-type" name="enq-type" value="consult"/>
		<div class="enq_msg" style="width:100%;"></div>
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>	
					<div><span class='red'>*</span> Name:</div>
					<input type='text' name='enq-name' id='enqs-name' class='form-control enq-name enq-input'/>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div><span class='red'>*</span>Country:</div>
					<select name='enq-country' class="enq-country anv_select_country select form-control enq-input" >
						<option disabled selected>Select Country</option>
					</select>
					<input type='hidden' class='enq-selectedCountry' name='enq-selectedCountry'/>
					
				</div>
			</div>
			
			<div class='row'>	
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>	
				<div><span class='red'>*</span>City:</div>
					<input type='text' name='enq-city' id='enqs-city' class='form-control enq-input enq-city'/>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>	
					<div><span class='red'>*</span>Street:</div>
					<input type='text' name='enq-street' id='enq-street' class='form-control enq-input enq-street'/>
				</div>
			</div>
			
		
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='row'>
						<div class='col-xs-12 col-sm-7 col-md-7 col-lg-7 pad-right'>
							<div class='genter_sec'>
							<div ><span class='red'>*</span>Gender:</div>
								<div class='enq-radiowrap'>
								 <label for="male">Male</label><input type="radio" name="enq-genter"  id="enq-genter" class="enq-male  enq-radio enq-input" value="male"/>
								 <label for="female">Female</label><input type="radio" name="enq-genter" id="enq-genter" class="enq-female  enq-radio enq-input" value="female"/>
								</div>
							</div>
						</div>
						<div class='col-xs-12 col-sm-5 col-md-5 col-lg-5 pad-left'>
							<div ><span class='red'>*</span>Age :</div>
							<input type='number' name='enq-age' class="form-control enq-age enq-input"/>
						</div>
					</div>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div ><span class='red'>*</span>Email:</div>
					<input type='text' name='enq-email' class='form-control enq-input enq-email' placeholder='Email'/>
				</div>
			</div>

			
			
			
			<div class='row'>
				<div class="anv_phone">
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
						<div class="mobile_box anv_row">
							<div class="anv_301"><span class='red'>*</span> Mobile :</div>
							<div class="anv_701">
								<input name='phonecode' style='width:37%; float:left;' id='phonecode' type='text' class='form-control enq-newval enq-input phonecode'>	
								<input style='width:57%; float:left;' name='phone' id='phone1' type='text' class='quickenqfield form-control mobi enq-newval enq-input enq-phone' placeholder='Phone'/>
							</div>
						</div>
					</div>
					
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
						<div class="mobile_box anv_row">
							<div class="anv_301">Landline</div>
							<div class="anv_701">
								<input style='width:27%; float:left;' type='text' class='form-control land enq-input enq-newval phonecode2' id='phonecode2' name='phonecode2' />
								<input style='width:28%; float:left;' type='text' id='areacode' class='form-control land enq-newval enq-input enq-area' name='areacode' placeholder='Area Code'/>
								<input style='width:40%; float:left;' type='text' id='phone2' class='form-control land enq-newval enq-input enq-phone2' name='phone2' placeholder='Phone'/>
							</div>
							<div class="anv_clear"></div>
						</div>
					</div>
					<div style='clear:both;'></div>
				</div>
			</div>
			
			<div class='row'>
				<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<div ><span class='red'>*</span>Messages :</div>
					<textarea class='form-control enq-input enq-address' name='enq-msg'></textarea>
				</div>
			</div>
			
			<h3 class='consult_head'>Upload your photos.</h3>
			
						
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='sample_img_sec'><img class="image" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>images/upper_arch.jpg"/></div>
					<div ><span class='red'>*</span>Upload a photo of your upper jaw teeth :</div>
					
					<div class="anv_file"><input required data-extensions="doc,odt,docx,pdf,jpg,jpeg,png,xls,xlsx" class="enq-file enq-input enq-file form-control" name='enq-att1' type='file' id='file'/></div>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='sample_img_sec'><img class="image" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>images/lower_arch.jpg"/></div>
					<div ><span class='red'>*</span>Upload a photo of your lower jaw teeth :</div>
					<div class="anv_file"><input required data-extensions="doc,odt,docx,pdf,jpg,jpeg,png,xls,xlsx" class="enq-file enq-input enq-file form-control" name='enq-att2' type='file' id='file'/></div>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='sample_img_sec'><img class="image" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>images/front.jpg"/></div>
					<div ><span class='red'>*</span>Upload a photo of the front :</div>
					<div class="anv_file"><input required data-extensions="doc,odt,docx,pdf,jpg,jpeg,png,xls,xlsx" class="enq-file enq-input enq-file form-control" name='enq-att3' type='file' id='file'/></div>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='sample_img_sec'><img class="image" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>images/profile.jpg"/></div>
					<div ><span class='red'>*</span>Upload a photo of your profile :</div>
					<div class="anv_file"><input required data-extensions="doc,odt,docx,pdf,jpg,jpeg,png,xls,xlsx" class="enq-file enq-input enq-file form-control" name='enq-att4' type='file' id='file'/></div>
				</div>
			</div>
			
			<div class='row'>
				<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
					<div><span class='red'>*</span>Enter the code:</div>
				</div>
				<div class="captcha">
					<div class='col-xs-12 col-sm-7 col-md-7 col-lg-7'>
						
							<div class='row'>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
									
										<?php $enq_rand='enq-'.rand(0,999); ?>
										<input type="hidden" class="enq-captchavar" name="enq-var" value="<?php echo $enq_rand; ?>"/>
										<input type="text" style=" float:left;" class="enq-captcha enq-input form-control" placeholder="Captcha" name="enq-captcha"/>
									
								</div>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
									<img class="enq-captchaimg" style="float:left; width:100%; height:33px;" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL.'captcha.php?var='.$enq_rand; ?>"/>
								</div>
							</div>
						</div>
					
					<div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
						<img class="enq-refresh" src="<?php echo ANVITA_ENQUIRY_PLUGIN_URL; ?>refresh.png"/>
					</div>
				</div>
			</div>
			
			<div class="enq-msg"></div>
			<div style='width:100%;'>
				<div class="enq-submit"><button type="button" class="enq-button enq-btn-active">Submit</button></div><br/>
				<div align='left'> (<span class='red'>*</span> represents compulsory fields )</div>
			</div>
	</form>
</div>