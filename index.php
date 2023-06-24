<?php
	/*
	Plugin Name: Drone
	Plugin URI: 
	Description: Drone
	Version: 1.1
	Author: Amirul Momenin
	Author URI: 
	License: GPL
	*/
	//http://www.jqueryscript.net/demo/Simple-Clean-jQuery-Vertical-drone-drone/#
	ob_start(); // line 1
	session_start(); // line 2
	$PLUGIN_URL = plugin_dir_url(__FILE__);
	define('PLUGIN_URL',substr($PLUGIN_URL,0,strlen($PLUGIN_URL)-1));
	define('PLUGIN_PATH', str_replace('\\', '/', dirname(__FILE__)) );
	
	
	add_action( 'wp_ajax_the_ajax_hook', 'the_action_function' );
	add_action( 'wp_ajax_nopriv_the_ajax_hook', 'the_action_function' );
	
	function test_ajax_load_scripts() {
			// load our jquery file that sends the $.post request
			wp_enqueue_script( "ajax-test", plugin_dir_url( __FILE__ ) . '/ajax-test.js', array( 'jquery' ) );
			
			// make the ajaxurl var available to the above script
			wp_localize_script( 'ajax-test', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
			//wp_localize_script( 'ajax-test', 'the_ajax_script', array( 'ajaxurl' => plugin_dir_url( __FILE__ ) . '/admin-ajax.php'  ) );
				
		}
		add_action('wp_print_scripts', 'test_ajax_load_scripts');
	 
	
	include_once( PLUGIN_PATH . '/classes/class.custom-drone-post-type.php');
	
	$obj_drone = new Drone();
	
	register_activation_hook(__FILE__,'drone_install'); 
	register_deactivation_hook( __FILE__, 'drone_remove' );
	function drone_install()
	 {  
	
		
		global $drone_db_version;
		$drone_db_version = "1.0";
		global $wpdb;
		global $drone_db_version;
	
	
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	 
		
		
		add_option("drone_db_version", $drone_db_version);
		
		//create page
		//include_once dirname(__FILE__) . '/create-page.php';
		
	}
	
	function drone_remove()
	{
		global $wpdb;
		
		
		//remove page
		global $wpdb;
	
		$the_page_title = get_option( "my_plugin_page_title" );
		$the_page_name = get_option( "my_plugin_page_name" );
		$the_page_id = get_option( 'my_plugin_page_id' );
		if( $the_page_id ) {
			wp_delete_post( $the_page_id ); 
		}
		delete_option("my_plugin_page_title");
		delete_option("my_plugin_page_name");
		delete_option("my_plugin_page_id");
	}
	
	//short code drones
	function drone_sort_code_func( $atts ) {
		include_once dirname(__FILE__) . '/drone.php';
	}
	add_shortcode( 'drone', 'drone_sort_code_func' );
	
	function text_ajax_process_request() {
			 $drone_data = get_post_meta($_REQUEST['post_id'], 'drone_data', true);
			 
			 if ( isset( $drone_data['site'] ) ) 
			 {
				for( $i = 0; $i < count( $drone_data['site'] ); $i++ ) 
				{
					$data_type =  $_REQUEST['data_type'];
					$link      =  $drone_data[$data_type][$i];
					
					$capture_date = $drone_data['capture_date'][$i]; 
					
					$arr_data = explode("-",$capture_date);
					$year     =  $arr_data[0];
					$month    =  $arr_data[1]; 
					
				    //$arr = array(,'Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec');
					
					if($_REQUEST['month']=='Jan')
					{
						$month1 = 1;
					}
					if($_REQUEST['month']=='Feb')
					{
						$month1 = 2;
					}
					if($_REQUEST['month']=='Apr')
					{
						$month1 = 3;
					}
					if($_REQUEST['month']=='Mar')
					{
						$month1 = 4;
					}
					if($_REQUEST['month']=='May')
					{
						$month1 = 5;
					}
					if($_REQUEST['month']=='June')
					{
						$month1 = 6;
					}
					if($_REQUEST['month']=='July')
					{
						$month1 = 7;
					}
					if($_REQUEST['month']=='Aug')
					{
						$month1 = 8;
					}
					if($_REQUEST['month']=='Sep')
					{
						$month1 = 9;
					}
					if($_REQUEST['month']=='Oct')
					{
						$month1 = 10;
					}
					if($_REQUEST['month']=='Nov')
					{
						$month1 = 11;
					}
					if($_REQUEST['month']=='Dec')
					{
						$month1 = 12;
					}
					
					foreach($drone_data as $key=>$value)
					{
					   if($key==$_REQUEST['data_type'])
					   {
						  $current_key = $key;
						  break;  
					   }
					}

					if($year == $_REQUEST['year'] && (int)$month == $month1 && $_REQUEST['data_type']==$current_key)
					{
					   echo $link; 	
					   exit;
					}
				}
			 }
	}
	add_action('wp_ajax_test_response', 'text_ajax_process_request');
?>
