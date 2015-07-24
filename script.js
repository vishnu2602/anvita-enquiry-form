 (function($){ 
				 $(".anv_select_country").select2({
				  tags: true,
				  createTag: function (params) {
					return {
					  id: params.term,
					  text: params.term,
					  newOption: true,
					  openOnEnter: false
					}
				  }
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
				enqwrap.find('.mobile_box').removeClass('enq-error');	
				return true;
			}
			else{
				enqwrap.find('.mobile_box').addClass('enq-error');	
			return false;			
			}
		}
		
		$('.enq-btn-active').click(function(){
		var formvalid=true;
		var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
		var obj=$(this).closest('.anvita-enq');
		var data=obj.find('form').serializeArray();
		console.log(data);
		var postdata='{ "action" : "anv_save_enquiry"';
		
			
		$.each(data,function(k,v){
			if (!obj.find('[name='+v.name+']').hasClass('enq-newval')) {
			valid=validateform(obj.find('[name='+v.name+']'),v.value); 
				console.log(v);
			if(valid){
				obj.find('[name='+v.name+']').removeClass("enq-error");
				}
			else{
				obj.find('[name='+v.name+']').addClass("enq-error");
				formvalid=false;
				console.log(v.name);
				}
			postdata+=',"'+v.name+'" : "'+ v.value + '"';	
			}			
		});
		var mob=obj.find('.phonecode').val()+'-'+obj.find('.enq-phone').val();
		var land=obj.find('.phonecode').val()+'-'+obj.find('.enq-area').val()+'-'+obj.find('.enq-phone2').val();
		
		formvalid=phonevalidate(mob,land);
		postdata+=',"enq-mobile" : "'+ mob + '","enq-phone" : "'+ land + '"';
		postdata+='}';
		console.log(postdata);
		postdata=JSON.parse(postdata);
		console.log(postdata);
		console.log("before"+formvalid);
		if(formvalid)
		{
				$(this).removeClass('enq-btn-active');
				$(this).addClass('enq-btn-deactive');									
				$.post(anv_options.ajax, postdata, function(response) {
					
					if(response.status){
						
					}
					console.log(response);
					enq_showmsg(obj,response.msg);					
				}).fail(function(response) {
					console.log(response);
			  }).always(function() {	
				
				changecaptcha(obj.find('.captcha'));			  
				var btn=obj.find('.enq-button');
				btn.removeClass('enq-btn-deactive');
				btn.addClass('enq-btn-active');
				});

							
			
		}
		
		});
		
		function enq_showmsg(obj,msg){
			obj=obj.find('.enq_msg');
			if(msg=='Thankyou... We will contact you soon...'){
				obj.addClass('enq-success');
				obj.closest('.anvita-enq').find('input[type=text],input[type=email],input[type=tel], textarea').val("");
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
 function getSelectedCountry()
	{

	var selected_index = $('.anvita-enq .enq-country option:selected').index();
	if(selected_index > 0)
	{
	  var selected_option_value = $('.anvita-enq .enq-country option:selected').val();
	   var selected_option_text = $('.anvita-enq .enq-country option:selected').html();
	   
	   console.log(selected_option_text);
	   $('.anvita-enq .enq-selectedCountry').val(selected_option_text);
	   $('.anvita-enq .phonecode').val(selected_option_value);
	   $('.anvita-enq .phonecode2').val(selected_option_value);
	   
		}
	else
		{
	   alert('Please select a country from the drop down list');
		}
	}