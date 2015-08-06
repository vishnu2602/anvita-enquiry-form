 (function($){

 $('.anv_select_country').change(function(){
	var selected_index = $(this).closest('.anvita-enq ').find('.enq-country option:selected').index();
	if(selected_index > 0)
	{
	  var selected_option_value = $(this).closest('.anvita-enq ').find('.enq-country option:selected').val();
	   var selected_option_text = $(this).closest('.anvita-enq ').find('.enq-country option:selected').html();
	    $(this).closest('.anvita-enq ').find('.enq-selectedCountry').val(selected_option_text);
	    $(this).closest('.anvita-enq ').find('.phonecode').val(selected_option_value);
	    $(this).closest('.anvita-enq ').find('.phonecode2').val(selected_option_value);	   
		}
	else
		{
	   alert('Please select a country from the drop down list');
		}
});
 
$(".anv_select_country").select2({
tags: true,				 
});
				
$(function(){	
	$.ajax({
		url:'http://tours2health.org/tools/json/country.json',
		success:function(data){
			data.forEach(function(v,k){
				for(var j in v)
				$(".select").append('<option value="+'+j+'">'+v[j]+'</option>');
			});
		},
		error:function(eror){

		}
	})
});
					
					//ends
					
		
		
		
		function phonevalidate(m,p,enqwrap){
			var mob=false;
			var land=false;
			var pregL=/^\+?([0-9]{2,4})\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{4,7})$/;
			var pregM=/^\+?([0-9]{2,4})\)?[-. ]?([0-9]{7,11})$/;
					
					if(pregL.test(p)){
						land=true;
					}
					if(pregM.test(m)){
						mob=true;
					}
					
			if(mob||land){
				$(enqwrap).closest('.anvita-enq ').find('.anv_phone').removeClass('enq-error');	
				return true;
			}
			else{
			$(enqwrap).closest('.anvita-enq ').find('.anv_phone').addClass('enq-error');	
			return false;			
			}
		}
		
		
		
		$('.enq-input').change(function(){
			var obj=$(this).closest('.anvita-enq');
			if ($(this).hasClass('enq-newval')) {
				var mob=obj.find('.phonecode').val()+'-'+obj.find('.enq-phone').val();
				var land=obj.find('.phonecode').val()+'-'+obj.find('.enq-area').val()+'-'+obj.find('.enq-phone2').val();
				phonevalidate(mob,land,$(this));
			}
			else{
				var x=validateform($(this),$(this).val());
				if(x){
					$(this).removeClass("enq-error");
				}
				else{
					$(this).addClass("enq-error");
				}
			}
			
		});
		
		
		$('.enq-btn-active').click(function(){
		var formvalid=true;
		var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
		var obj=$(this).closest('.anvita-enq');
		var data=obj.find('form').serializeArray();
	
		var postdata= new FormData();
		postdata.append('action', "anv_save_enquiry");
		var curobj;
		$.each(data,function(k,v){
			curobj=obj.find('[name='+v.name+']');
			if (!curobj.hasClass('enq-newval')) {
			valid=validateform(curobj,v.value); 
			if(valid){
				curobj.removeClass("enq-error");
				}
			else{
				curobj.addClass("enq-error");
				formvalid=false;
				}
			postdata.append(v.name, v.value);	
			}			
		});
		var mob=obj.find('.phonecode').val()+'-'+obj.find('.enq-phone').val();
		var land=obj.find('.phonecode').val()+'-'+obj.find('.enq-area').val()+'-'+obj.find('.enq-phone2').val();
		
		var x=true;
		x=phonevalidate(mob,land,$(this));
		if(!x) formvalid=x;
		postdata.append("enq-mobile", mob);
		postdata.append("enq-phone", land);
		
		
		/*
		File Upload
		*/
		var hasfile=obj.find('input[type=file]');
		var file_st=true;
		if(hasfile.length>0){
		var anv_file;
			$.each(hasfile,function(k,v){
				anv_file=obj.find('[name='+v.name+']');
				file_st=fileValidate(anv_file);
				if(formvalid) formvalid=file_st;
				if(v.files.length>0){ postdata.append(v.name, v.files[0]); }
								
			});		
		}
		
				
		/***   Gender validation start ***/
		
		var hasradio=obj.find('input[type="radio"]');
	
		var radio_st=true;
		if(hasradio.length>0){
			$.each(hasradio,function(k,v){
				radio_st=radiovalidate(obj,v.name);
				if(formvalid) formvalid=radio_st;	
				if(radio_st) postdata.append(v.name, v.value);	
					
			});
		}
			
	
		/***   Gender validation End ***/

		if(formvalid)
		{
				$(this).removeClass('enq-btn-active');
				$(this).addClass('enq-btn-deactive');
				$.ajax({
					url: anv_options.ajax, // point to server-side PHP script 
					cache: false,
					contentType: false,
					processData: false,
					data: postdata,                         
					type: 'POST',
					success: function(response){
					  if(response.status){
						  $('.enq-input').val('');						
					}
					enq_showmsg(obj,response.msg);
				}
				}).fail(function(response) {
			  }).always(function() {
				changecaptcha(obj.find('.captcha'));			  
				var btn=obj.find('.enq-button');
				btn.removeClass('enq-btn-deactive');
				btn.addClass('enq-btn-active');
				});
		}
		
		});
		
		
		

		function fileValidate(v){
			var st=true;
			var req=false;
			var exts_str=v.attr('data-extensions').toLowerCase();
			var exts=[];
			var f_val=v.val();
			
			if(v.attr('required')=="required"){
				req=true;
			}
			
			if(f_val!=""){
				if(exts_str!=''){
					exts=exts_str.split(',');			
					if ($.inArray(f_val.split('.').pop().toLowerCase(), exts) == -1) {
						console.log(v.val().split('.').pop().toLowerCase());
						console.log("Only "+exts_str+" formats are allowed.");
						st=false;
					}
				}
				console.log(f_val);
				console.log(v);
			}
			else{
				if(req) st=false;				
			}
			
			
			if(st){
				v.removeClass('enq-error');
			}
			else v.addClass('enq-error');
			
			return st;

		}
		function radiovalidate(obj,radioname){
			var anv_radio=obj.find('[name='+radioname+']:checked');
			
			if (anv_radio.length > 0) {
				obj.find('.enq-radiowrap').removeClass('enq-error');	
				return true;
			}
			else{
			obj.find('.enq-radiowrap').addClass('enq-error');	
			return false;			
			}
		}

		function enq_showmsg(obj,msg){
			obj=obj.find('.enq_msg');
			if(msg=='Thankyou... We will contact you soon...'){
				obj.addClass('enq-success');
				obj.closest('.anvita-enq').find('input[type=text],input[type=email],input[type=tel],textarea').val("");
			 }
			else{
				obj.removeClass('enq-success');
			}		
			obj.html(msg);
			obj.addClass('enq-shown');		
		}
		
		function validateform(obj,inputval){
			var valid=true;
			if(obj.hasClass('enq-name')){
					if(inputval.length<4){ valid=false; }
					else{ valid=true; }
				}
			else if(obj.hasClass('enq-age')){
				var preg4=/^\(?([0-9]{1,3})$/;
				if(!preg4.test(inputval)){ valid=false; }
				else{ valid=true; }
			}
				else if(obj.hasClass('enq-email')){
					var eregx = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(!eregx.test(inputval)){ valid=false; }
					else{ valid=true; }
				}
				else if(obj.hasClass('enq-country')){
					if(inputval.length<3) valid=false;
					else valid=true;
				}
				else if(obj.hasClass('enq-city')){
					if(inputval.length<3) valid=false;
					else valid=true;
				} 
				else if(obj.hasClass('enq-street')){
					if(inputval.length<2) valid=false;
					else valid=true;
					}				
			
				else if(obj.hasClass('enq-phone')){
					var preg=/^\+?([0-9]{2,3})\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{4,7})$/;
					var preg1=/^\(?([0-9]{3,4})\)?[-. ]?([0-9]{4,7})$/;
					var preg2=/^\(?([0-9]{2,3})\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{4,7})$/;
					var preg3=/^\d{9,10}$/;
					if(preg.test(inputval)||preg1.test(inputval)||preg2.test(inputval)||preg3.test(inputval)){
						valid=true;
					}
					else{ valid=false; }
				}
				else if(obj.hasClass('enq-address')){
					if(inputval.length<5||inputval.length>200) valid=false;
					else valid=true;
				}
				else if(obj.hasClass('enq-captcha')){
					if(inputval.length<4) valid=false;
					else valid=true;
				}
				

			return valid;

		}
		$('.enq-refresh').click(function(){
			changecaptcha($(this).closest('.captcha'));
		 });

		function changecaptcha(obj){
			var cap=obj.find('.enq-captchaimg');
			var src=cap.attr('src');
        	src=src.substring(0, src.indexOf('?'));
            src=src+'?var='+obj.find('.enq-captchavar').val()+'&r='+(Math.floor(Math.random()*90000) + 10000);
            cap.attr('src',src);

		   }
})(jQuery);



