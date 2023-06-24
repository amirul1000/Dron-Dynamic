<?php
       //$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	  
       $cmd = $_REQUEST['cmd'];
	  
	   switch($cmd)
	   { 
	       case "read":
		               // echo $parse_uri[0] . 'wp-load.php';
					   global $wpdb;
					   //echo json_encode($wpdb);
		               $drone_data = get_post_meta($_REQUEST['post_id'], 'drone_data', true);
					   echo "hello";
					   //echo json_encode($drone_data);
					  // $post = get_post( $_REQUEST['post_id'] ); 
						 
						/*  if ( isset( $drone_data['site'] ) ) 
						 {
							for( $i = 0; $i < count( $drone_data['site'] ); $i++ ) 
							{
								$data_type = $_REQUEST['data_type'];
								$link =  $drone_data[$data_type][$i];
								echo $link;
								echo $data_type;
							}
						 }*/
				 break;	
	   }
?>