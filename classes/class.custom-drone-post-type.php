<?php
	class Drone{
		public function __construct() {
					add_action( 'init', array( $this, 'create_post_type' ));
					add_action( 'add_meta_boxes',  array( $this,'add_drone_metaboxes') );
					add_action('save_post', array( $this,'wpt_save_drone_meta'), 1, 2); // save the custom fields
					add_filter( 'manage_edit-drone_columns', array( $this,'my_edit_drone_columns') ) ;
					add_action('manage_drone_posts_custom_column',  array( $this,'manage_drone_columns'), 10, 2);
				}
		function create_post_type() {
		  register_post_type( 'drone',array(
								 'labels' => array(
													'name'               => __( 'drone' ),
													'singular_name'      => __( 'drone' ),
													'add_new'            => __( 'Add New', 'book', 'your-plugin-textdomain' ),
													'add_new_item'       => __( 'Add New drone', 'your-plugin-textdomain' ),
													'new_item'           => __( 'New drone', 'your-plugin-textdomain' ),
													'edit_item'          => __( 'Edit drone', 'your-plugin-textdomain' ),
													'view_item'          => __( 'View drone', 'your-plugin-textdomain' ),
													'all_items'          => __( 'All drones', 'your-plugin-textdomain' ),
													'search_items'       => __( 'Search drones', 'your-plugin-textdomain' ),
													'parent_item_colon'  => __( 'Parent drones:', 'your-plugin-textdomain' ),
													'not_found'          => __( 'No drones found.', 'your-plugin-textdomain' ),
													'not_found_in_trash' => __( 'No drones found in Trash.', 'your-plugin-textdomain' )
												),
								 'description'   => 'Description',				
								 'public' => true,
								 'has_archive' => true,
								 'menu_position' => 20,
								 //'supports' => array( 'title', 'editor','thumbnail','comments','page-attributes'),
								 'supports' => array( 'title'),
								 'capability_type' => 'post',
								 'register_meta_box_cb' => array($this,'add_drone_metaboxes')
							 )
			  );
		}
		
	// Add the Events Meta Boxes

		function add_drone_metaboxes() {
			add_meta_box('wpt_drone_general', 'Drone', array($this,'wpt_drone_general'), 'drone', 'side', 'default');
			//add_meta_box('wpt_drone_general', 'General Info', 'wpt_drone_general', 'drone', 'normal', 'high');
		}
		// Add the Events Meta Boxes
		
		// The Event Location Metabox
		
		function wpt_drone_general() {
			global $post;
			
			ob_start();
			include_once( PLUGIN_PATH . '/includes/drone-meta.php');
			$content = ob_get_clean();
			echo $content;
		}
		// Save the Metabox Data
		
		function wpt_save_drone_meta($post_id, $post) {

			// verify this came from the our screen and with proper authorization,
			// because save_post can be triggered at other times
			/*if ( !wp_verify_nonce( $_POST['dronemeta_noncename'],  PLUGIN_PATH . '/includes/product-general.php' )) {
			
			return $post->ID;
			}*/
		
			// Is the user allowed to edit the post or page?
			if ( !current_user_can( 'edit_post', $post->ID ))
				return $post->ID;
		   
			// OK, we're authenticated: we need to find and save the data
			// We'll put it into an array to make it easier to loop though.
			
			$drone_meta['client']  =  $_POST['client'];
			
			
			// Add values of $drone_meta as custom fields
			
			foreach ($drone_meta as $key => $value) { // Cycle through the $drone_meta array!
				if( $post->post_type == 'revision' ) return; // Don't store custom data twice
				$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
				if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
					update_post_meta($post->ID, $key, $value);
				} else { // If the custom field doesn't have a value
					add_post_meta($post->ID, $key, $value);
				}
				if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
			}
			
			
			
			///////////Save image//////////////
			if ( $_POST['drone'] ) 
			{
				// Build array for saving post meta
				$drone_data = array();
				for ($i = 0; $i < count( $_POST['drone']['site'] ); $i++ ) 
				{
					if ( '' != $_POST['drone']['site'][ $i ] ) 
					{
						$drone_data['site'][]  = $_POST['drone']['site'][ $i ];
						$drone_data['capture_date'][]  = $_POST['drone']['capture_date'][ $i ];
						$drone_data['2d_model'][]  = $_POST['drone']['2d_model'][ $i ];
						$drone_data['3d_model'][]  = $_POST['drone']['3d_model'][ $i ];
						$drone_data['360_photo'][]  = $_POST['drone']['360_photo'][ $i ];
						$drone_data['stills'][]  = $_POST['drone']['stills'][ $i ];
						$drone_data['ndvi'][]  = $_POST['drone']['ndvi'][ $i ];
						$drone_data['elevation_map'][]  = $_POST['drone']['elevation_map'][ $i ];
						$drone_data['pdf'][]  = $_POST['drone']['pdf'][ $i ];
						$drone_data['blueprint'][]  = $_POST['drone']['blueprint'][ $i ];
					}
				}
		
				if ( $drone_data ) 
					update_post_meta( $post_id, 'drone_data', $drone_data );
				else 
					delete_post_meta( $post_id, 'drone_data' );
			} 
			// Nothing received, all fields are empty, delete option
			else 
			{
				delete_post_meta( $post_id, 'drone_data' );
			}
		
		}
	
	function my_edit_drone_columns( $columns ) {
	
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'id' => __('ID'),
			'title' => __( 'title' ),
			'short_code' => __( 'Short code' ),
			'client' => __( 'client' ),
			'site' => __( 'site' ),
			'capture_date' => __('capture_date'),
			'author' => __( 'author' ),
			'date' => __( 'Date' )
		);
	
		return $columns;
	}
	
		// Add to admin_init function
	 
	function manage_drone_columns($column_name, $id) {
		global $wpdb;
		switch ($column_name) {
		case 'id':
			echo $id;
				break;
	    case 'short_code':
			        echo "[drone id=$id]";
				break;
		case 'client':
				  $custom_fields = get_post_custom($id);
				  $my_custom_field = $custom_fields[$column_name];
				  
				  if( $my_custom_field)
				  {
					  foreach ( $my_custom_field as $key => $value ) {
						echo $value;
					  }
				  }
			break;
		case 'site':
				  $drone_data = get_post_meta($id, 'drone_data', true);
				 
					if ( isset( $drone_data['site'] ) ) 
					{
						for( $i = 0; $i < count( $drone_data['site'] ); $i++ ) 
						{
							echo $drone_data['site'][$i].' ';
						}
					}
			break;
		 case 'capture_date':
				  $drone_data = get_post_meta($id, 'drone_data', true);
				 
					if ( isset( $drone_data['capture_date'] ) ) 
					{
						for( $i = 0; $i < count( $drone_data['capture_date'] ); $i++ ) 
						{
							echo $drone_data['capture_date'][$i].' ';
						}
					}
			break;	
		default: 
			break;
		} // end switch
	} 

 }

?>