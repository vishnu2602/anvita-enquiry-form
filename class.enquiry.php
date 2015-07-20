<?php
class Enquiry{
	
	private static $plugin_options=[
		'ver'=>'0',
		'to'=>'',
		'cc'=>'',
		'bcc'=>'',
		'crm'=>'',
		'phone'=>'',
		];
		
	private static $initiated = false;
	
	private static $settings = [];
	
	public static function init() {
		if ( ! self::$initiated ) {
			add_shortcode('anvitaenq', array('Enquiry', 'shortcode'));
			self::init_hooks();
			self::$settings=json_decode(get_option('enquiry'),true);
		}	
	}
	
	public static function init_hooks(){		
		self::$initiated = true;
		add_action( 'wp_enqueue_scripts', array( 'Enquiry', 'load_resources' ) );
		add_action('wp_ajax_save_enquiry', array('Enquiry','save_enquiry'));
		add_action( 'wp_ajax_nopriv_save_enquiry', array('Enquiry','save_enquiry'));
	}
	public static function load_resources(){
		wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', array(), 3.3 );
		wp_enqueue_style( 'bootstrap');
		
		wp_register_style( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css', array(), 4 );
		wp_enqueue_style( 'select2');
		
		wp_register_script( 'jquery_min', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), 1.11 );
		wp_enqueue_script( 'jquery_min' );
		
		wp_register_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js', array(), 4 );
		wp_enqueue_script( 'select2' );
		
	}
	public function getSettings()
	{
		return self::$settings;
	}
	private static function enquirytable(){
		global $wpdb;
		return $wpdb->prefix . 'anvitaenq';
	}
	public static function enq_style(){
		require_once 'style.php';
	}
	public static function save_enquiry(){
		ob_start();
		session_start();
		$response = array();
		$response['status']=false;
		$response['msg']="Invalid request";
		if(isset($_POST['enq-captcha'])&&isset($_POST['enq-var'])){
			$sess=$_POST['enq-var'];
		if(isset($_SESSION[$sess])&&($_POST['enq-captcha']==$_SESSION[$sess])){
			
		$settings=json_decode(get_option('enquiry'),true);
		$validate=self::validate_data($_POST,$settings);
		if($validate['status']){
			$vals=$_POST;
			$vals['ip']=self::get_client_ip();
			$now=current_time( 'mysql' );
			unset($vals['action']);
			
			if(isset($vals['enq-enqid'])){
				$enqid=$vals['enq-enqid'];
				unset($vals['enq-enqid']);
			}
			else $enqid=0;
			$date=date('Y-m-d',strtotime($vals['enq-date']));
			unset($vals['enq-date']);
		
		// $response['val']=$_POST;
		// if($response['val']['enq-captcha'] != '')
		// {
		// if($response['val']['enq-captcha']==$_SESSION[$response['val']['enq-var']]){
			
		// if(!preg_match('/[a-zA-Z]{2,}/', $response['val']['enq-name']))
		// {
			// $response['msg']="Invalid name";	
		// }
		// elseif(!filter_var($response['val']['enq-email'],FILTER_VALIDATE_EMAIL))
		// {
			// $response['msg']="Invalid email";	
		// }
		// elseif(!preg_match('/[a-zA-Z]{2,}/', $response['val']['enq-selectedCountry']))
		// {
			// $response['msg']="Invalid country";	
		// }	
		// elseif(!preg_match('/[a-zA-Z]{2,}/', $response['val']['enq-city']))
		// {
			// $response['msg']="Invalid city";	
		// }
			// else
			// {
				
				global $wpdb;
				$ret=$wpdb->insert( self::enquirytable(), 
					array( 
							'aw_date' => $date, 
							'enqid' => $enqid,
							'createdon'=> $now,
							'name' => $vals['enq-name'], 
							'email' => $vals['enq-email'],
							'country'=> $vals['enq-selectedCountry'],
							'city'=> $vals['enq-city'],
							'ip'=> $vals['ip'],
							'mobile'=> $vals['enq-mobile'],
							'phone'=> $vals['enq-phone'],
							'msg'=>$vals['enq-msg'],
							'isdel'=>'0'
			 ));
				
			if($ret){
				$response['status']=true;
				$response['msg']="<li>Thankyou. We will contact you soon...</li>";
				$response['data']=$_POST;
				$vals['enq-date']=$date;
				self::send_email_alert($vals,$settings);
				unset($_SESSION[$sess]);
				
			}
			else{
				$response['msg']="<li>Failed ...</li>";
			}
			}
			else{
				$response['msg']=$validate['msg'];
			}
		}
		else{
			$response['msg']="<li>Invalid Captcha</li>";
		}
		}
		else{
			$response['msg']="<li>Invalid Request</li>";
		}
		
				
		header( "Content-Type: application/json" );		
		echo json_encode($response);
		wp_die();
	}
	public static function send_email_alert($vals,$settings){
		$msg[0]='<table style="background-color:#fff; width:100%; max-width:500px;"><tbody>';
		$remove=['aw-var',
				'aw-captcha',
		];
		$i=1;
		foreach($vals as $k=>$v){
			if(!in_array($k, $remove)){
				$msg[$i]="<tr><td>".str_replace("enq-", "", $k)."</td><td>".$v."</td></tr>";
			}
			$i++;			
		}
		$headers=[];
		if($cc!="") $headers[] = 'Cc: '.$cc;
		if($bcc!="") $headers[] = 'Bcc: '.$bcc;		
		
		$sub="Enquiry";
		add_filter( 'wp_mail_content_type', 'set_html_content_type' );
		function set_html_content_type() { return 'text/html';}
		
		// if($settings['email']['to']!="") $to=explode(',',$settings['email']['to']);
		// else $to="";
		
		$message=join($msg);

		wp_mail( 'vishnu@tours2health.com', $sub, $message, $headers );
		
		if($vals['enq-email']!=""){
			$message="<p>Hi ".$vals['enq-name']."</p><p>Your appointment has been booked with the following details</p>".$message;
			wp_mail( $vals['enq-email'], $sub, $message );
		}
			
	}
	public static function validate_data($data,$settings){
		
		$return['status']=true;
		$return['msg']='';
		$msgs=[];		
			foreach($data as $key=>$value){
				if($key=="enq-email"){
					if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
						$return['status']=false;
						array_push($msgs, "<li>Invalid Email id</li>");						
					}					
				}
				// elseif($key=="aw-phone"){
					
					  
					 // if(!preg_match("/^\+?([0-9]{2,3})\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{4,7})$/", $value)){
						// if(!preg_match("/^\(?([0-9]{3,4})\)?[-. ]?([0-9]{4,7})$/", $value)){
							// if(!preg_match("/^\(?([0-9]{2,3})\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{4,7})$/", $value)){
								// if(!preg_match("/^\d{9,10}$/", $value)){
									// $return['status']=false;
									// array_push($msgs, "<li>Invalid Phone Number id</li>");
								// }		
							// }
						// }
						
					// }
					
				// }
				elseif($key=="enq-name"){
					if(!preg_match("/^[a-zA-Z ]*$/",$value)||strlen($value)<3){
						$return['status']=false;
						array_push($msgs, "<li>Only letters and white space allowed in name</li>");						
					}
				}
				elseif($key=="enq-selectedCountry"){
					if(!preg_match("/^[a-zA-Z ]*$/",$value)||strlen($value)<3){
						$return['status']=false;
						array_push($msgs, "<li>Only letters and white space allowed in country</li>");
					}
				}
				elseif($key=="enq-captcha"){
					if(strlen($value)<3){
						$return['status']=false;
						array_push($msgs, "<li>Invalid Captcha</li>");
					}
				
				
				
				}	
				
			
		}
		$return['msg']=join($msgs);
			
			
		return $return;
	}
	// public static function send_email_alert($vals,$settings){
		// $msg[0]='<table style="background-color:#fff; width:100%; max-width:500px;"><tbody>';
		
		// if($settings['email']['cc']!="") $headers[] = 'Cc: '.$settings['email']['cc'];
		// if($settings['email']['bcc']!="") $headers[] = 'Bcc: '.$settings['email']['bcc'];		
		
		// $sub="Enquiry through ".get_site_url();
		// add_filter( 'wp_mail_content_type', array('Enquiry','set_html_content_type') );
		
		
		//if($settings['email']['to']!="") $to=explode(',',$settings['email']['to']);
		//else $to="";
		
		// $message=join($msg);

		// wp_mail( $to, $sub, $message, $headers );
		
		//if($vals['enq-email']!=""){
		//	$message="<p>Hi ".$vals['enq-name']."</p><p>We received your enquiry with following details</p>".$message;
		//	wp_mail( $vals['enq-email'], $sub, $message );
		//}
		// self::send_email("vishnu@tours2health.com",$msg,$sub);
			
	// }
	private static function get_client_ip() 
	{
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		$ip = $_SERVER['REMOTE_ADDR'];
		}
		return apply_filters( 'wpb_get_ip', $ip );
	}	
	public static function shortcode($atts){
		$opt=self::$settings;
		
		require_once("templates/basic.php");
		add_action( 'wp_footer', array('Enquiry','enq_style'));
		add_action( 'wp_footer', array('Enquiry','enq_scripts'));
	}	
	
	public static function enq_scripts(){
		?>
		<script type="text/javascript">
			
			//select2 start
			
				 (function($){ 
				 $("select").select2({
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
				})(jQuery);
				
				//select2 ends
				//automated country selection
				
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
				//country code selection
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
					//end
					//form validation
					(function($){
		
		var ajaxurl='<?php echo admin_url( 'admin-ajax.php' ); ?>';
		
		function phonevalidate(m,p){
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
				$('.mobile_box').removeClass('enq-error');	
				return true;
			}
			else{
			$('.mobile_box').addClass('enq-error');	
			return false;			
			}
		}
		
		$('.enq-btn-active').click(function(){
		var formvalid=true;
		var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
		var obj=$(this).closest('.anvita-enq');
		var data=obj.find('form').serializeArray();
		console.log(data);
		var postdata='{ "action" : "save_enquiry"';
		
			
		$.each(data,function(k,v){
			var valid=true;
			if (!obj.find('[name='+v.name+']').hasClass('enq-newval')) {
			//if(=='enq-newval')
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
				$(this).removeClass('btn-active');
				$(this).addClass('btn-deactive');									
				$.post(ajaxurl, postdata, function(response) {
					
					if(response.status){
						
					}
					console.log(response);
					enq_showmsg(obj,response.msg);					
				}).fail(function(response) {
					console.log(response);
			  }).always(function() {	
				
				changecaptcha(obj);			  
				var btn=obj.find('.enq-btn');
				btn.removeClass('btn-deactive');
				btn.addClass('btn-active');
				});

							
			
		}
		
		});
		
		function enq_showmsg(obj,msg){
			obj=obj.find('.enq_msg');
			if(msg=='Thankyou... We will contact you soon...'){
				obj.addClass('enq-success');
				obj.closest('.anvita-enq').find('input[type=text],input[type=textbox]').val("");
			 }
			else{
				obj.removeClass('enq-success');
			}		
			obj.html(msg);
			obj.addClass('enq-shown');		
		}
		
		function validateform(obj,inputval){
			if(obj.hasClass('enq-name')){
					if(inputval.length<4){ valid=false; }
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
			var src=cap.attr('src')+'&r='+(Math.floor(Math.random()*90000) + 10000);
			
			cap.attr('src',src);

		   }
})(jQuery);
				
			</script>
		<?php
	}
	/**
	 * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
	 * @static
	 */
	public static function plugin_activation() {
		if ( version_compare( $GLOBALS['wp_version'], ANVITA_ENQUIRY_MINIMUM_WP_VERSION, '<' ) ) {
			load_plugin_textdomain( 'anvita-enquiry-form' );				
			$message = '<strong>'.sprintf(esc_html__( 'Anvita Enquiry Form %s requires WordPress %s or higher.' , 'anvita-enquiry-form'), ANVITA_ENQUIRY_VERSION, ANVITA_ENQUIRY_MINIMUM_WP_VERSION ).'</strong> '.sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version', 'anvita-enquiry-form'), 'https://codex.wordpress.org/Upgrading_WordPress', '');
			Enquiry::bail_on_activation( $message );
		}
		else{
			global $wpdb;
			$enquiry = get_option( "anv_setting" );
			$enquiry=json_decode($enquiry, true);			
			if($enquiry==NULL) $enquiry=self::$plugin_options;
			
			$oldopt=get_option('jal_db_version');
			if($oldopt!=NULL){
				$enquiry['to']=get_option('anvitaenq_to');
				$enquiry['crm']=get_option('anvitaenq_crmid');
				$enquiry['phone']=get_option('anvitaenq_phoneno');
			}
			
			$enqtable=self::enquirytable();
			
				/*
				 * update plugin
				 * 
				 */
				$sql = "CREATE TABLE ".$enqtable." (
				`enqid` MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
				`time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
				`name` TINYTEXT NOT NULL,
				`email` TINYTEXT NOT NULL,
				`country` TINYTEXT NOT NULL,
				`city` TINYTEXT NOT NULL,
				`ip` VARCHAR(20) NOT NULL,
				`mobile` VARCHAR(20) NULL DEFAULT NULL,
				`phone` VARCHAR(20) NULL DEFAULT NULL,
				`msg` MEDIUMTEXT NOT NULL,
				`age` TINYINT(4) NULL DEFAULT NULL,
				`appointmentdate` DATE NULL DEFAULT NULL,
				`address` VARCHAR(200) NULL DEFAULT NULL,
				`attachment` VARCHAR(1000) NULL DEFAULT NULL,
				`isdeleted` INT(2) NOT NULL DEFAULT '0',
				UNIQUE INDEX `id` (`enqid`)) ".$wpdb->get_charset_collate();
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				dbDelta( $sql );
				
				$enquiry['ver']=ANVITA_ENQUIRY_VERSION;
				$enquiry=json_encode($enquiry);
				update_option("anv_setting", $enquiry );			
		}
	}
	/**
	 * Removes all connection options
	 * @static
	 */
	public static function plugin_deactivation( ) {
		//tidy up
	}
	private static function bail_on_activation( $message, $deactivate = true ) {
		?>
	<!doctype html>
	<html>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<style>
	* {
		text-align: center;
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	}
	p {
		margin-top: 1em;
		font-size: 18px;
	}
	</style>
	<body>
	<p><?php echo esc_html( $message ); ?></p>
	</body>
	</html>
	<?php
			if ( $deactivate ) {
				$plugins = get_option( 'active_plugins' );
				$aw = plugin_basename( ANVITA_ENQUIRY_PLUGIN_DIR . 'anvita-enquiry-form.php' );
				$update  = false;
				foreach ( $plugins as $i => $plugin ) {
					if ( $plugin === $aw ) {
						$plugins[$i] = false;
						$update = true;
					}
				}
	
				if ( $update ) {
					update_option( 'active_plugins', array_filter( $plugins ) );
				}
			}
			exit;
	}
}
?>