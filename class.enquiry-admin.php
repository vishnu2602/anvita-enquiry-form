<?php
class Enquiryadmin{
	private static $initiated = false;
	
	private static $settings = [];
	
	private static $largeenq_settings = [];
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
			self::$settings=json_decode(get_option('anv_setting'),true);
			self::$largeenq_settings=json_decode(get_option('anv_setting_large'),true);
		}	
	}
	
	public function getSettings(){
		return self::$settings;
	}
	
	public function getlargeenqSettings(){
		return self::$largeenq_settings;
	}
	
	public static function init_hooks() {
		self::$initiated = true;
		add_action( 'admin_init', array( 'Enquiryadmin', 'admin_init' ) );
		add_action( 'admin_menu', array( 'Enquiryadmin', 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( 'Enquiryadmin', 'load_resources' ) );
		add_action('wp_ajax_aw_update_options', array('Enquiryadmin','enq_update_options'));
		add_action('wp_ajax_enquiry_list', array('Enquiryadmin','enquiry_list'));
		add_action('wp_ajax_enquiry_trash', array('Enquiryadmin','enquiry_trash'));
	}
	
	private static function enquirytable(){
		global $wpdb;
		return $wpdb->prefix . 'anvitaenq';
	}
	
	public static function admin_init() {
		load_plugin_textdomain( 'anvita-enquiry-form' );
	}
	
	public static function admin_menu() {
		add_menu_page('Enquiry', 'Enquiry', 2,'anvita-enquiry-form/admin/index.php','','dashicons-backup', 4.55);
	}
	
	public static function load_resources(){	
		wp_register_style( 'anv-enq-admin', ANVITA_ENQUIRY_PLUGIN_URL . 'admin/style.css', array(), ANVITA_ENQUIRY_VERSION );
		wp_register_style( 'jqueryui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css', array(), 1.8 );
		wp_enqueue_style( 'anv-enq-admin');
		wp_enqueue_style( 'jqueryui');
	}
	
	public static function load_enquiry($isdeleted=0){
		
		$f=0;
		global $wpdb;
		if(isset($_POST['p'])){
			$f=$_POST['p']*10;			
		}
		
		
		$c=10;		
		
		$return['no'] = $wpdb->get_var("SELECT COUNT(*) FROM ".self::enquirytable()."
				WHERE isdeleted = ".$isdeleted);
		
		$return['result'] = $wpdb->get_results(
				"SELECT * FROM ".self::enquirytable()."
				WHERE isdeleted = ".isdeleted." order by id desc LIMIT ".$f.",".$c
		);
		$return['f']=$f;
		$return['c']=$c;
		return $return;
	}
	
	public static function load_pagination($f,$c,$n,$isdeleted=0){
		$nop=$n/$c;
		$i=0;
		echo "<div class='enq_pagination'>";
		while($i<$nop){
			$class="";
			if($i==$f) $class="enq_current";
			echo '<a href="#" data-isdeleted="'.$isdeleted.'" class="enq_page '.$class.'" data-page="'.$i.'">'.($i+1).'</a>';
			$i++;
		}
		echo "</div>";		
	}
	
	public static function enquiry_list($res=""){
		if($res==""){
			 $res=self::load_enquiry($_POST['d']);
		}
		
		
		$html[0]='<table class="enq-schedule">
		<tbody>
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Country</th>
		<th>City</th>
		<th>Message</th>
		<th>Enquiry Type</th>
		<th>Enquiry Date</th>
		</tr>';
		

		$remove=['enq-name',
				'enq-email',
				'enq-selectedCountry',
				'enq-city',
				'enq-var',
				'enq-captcha',
				'enq-msg',
				'enq-type',
		];
		$class="odd";
		foreach($res['result'] as $r){
			if($r->isdeleted==1) {
				$isdeleted="dashicons-undo";
				$deltitle="Restore";
			}
			else{
				$isdeleted="dashicons-trash";
				$deltitle="Delete";
			}
				
			//$details=json_decode($r->aw_details,true);			
			array_push($html, '<tr class="'.$class.'">');
			array_push($html, "<td>".$_POST['enq-name']."</td>");
			array_push($html, "<td>".$_POST['enq-email']."</td>");
			array_push($html, "<td>".$_POST['enq-selectedCountry']."</td>");
			array_push($html, "<td>".$_POST['enq-city']."</td>");
			array_push($html, "<td>".$_POST['enq-msg']."</td>");
			if($r->enq_type==0)	array_push($html, "<td>Normal</td>");
			elseif($r->enq_type==1)	array_push($html, "<td>Large Form</td>");
			array_push($html, "<td>".date('d-m-Y H:i:s',current_time( 'mysql' ))."</td>");
			array_push($html,"<td><a title='$deltitle' class='enq_trash_app dashicons $isdeleted' data-isdeleted='".$r->isdeleted."' data-id='".$r->id."' href='#'></a></td>");
			array_push($html,"</tr>");
			array_push($html,'<tr class="'.$class.'">');
			array_push($html,"<td colspan='6'>");
			foreach ($_POST as $dk=>$dv){
				if(!in_array($dk, $remove)){
					array_push($html, "<span class='enq_more'>".str_replace("enq-", "", $dk)." : ". $dv."</span>");
				}
			}
			array_push($html,"</td>");
			array_push($html,"</tr>");
			if($class=="odd") $class="even";
			else $class="odd";		
		}
		array_push($html,"</tbody></table>");
		echo join($html);
		
		return "";		
	}
	
	public static function enquiry_trash(){
		if(isset($_POST['id'])){
			global $wpdb;
			
			if($_POST['d']==0) $wpdb->query("UPDATE ".self::enquirytable()." SET isdel = 1 WHERE ID = ".$_POST['id']);
			else  $wpdb->query("UPDATE ".self::enquirytable()." SET isdel = 0 WHERE ID = ".$_POST['id']);
			
		}
		
	}
	
	public function saveSettings($vals){		
		$settings=self::$settings;
		$settings['email']['to']=$vals['email'];
		$settings['email']['cc']=$vals['cc'];
		$settings['email']['bcc']=$vals['bcc'];
		
		self::$settings=$settings;
		update_option('anv_setting', json_encode($settings));
	}
	
}
?>