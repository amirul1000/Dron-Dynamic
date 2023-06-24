<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- END THEME STYLES -->
    <?php
		// Noncename needed to verify where the data originated
		echo '<input type="hidden" name="productmeta_noncename" id="productmeta_noncename" value="' .wp_create_nonce(  PLUGIN_PATH . '/includes/drone-general.php' ) . '" />';
		 
	?>
    <div class="tab-pane active" id="tab_general">
    <div class="form-body">
       <div class="well">
         <div class="form-group">
            <label class="col-md-2 control-label">Client Name: <span class="required">
            </span>
            </label>
            <div class="col-md-10">
                <?php
				    $client = get_post_meta($post->ID, 'client', true);
					$blogusers = get_users(  );
					// Array of WP_User objects.
				?>
                <select name="client" id="client" class="form-control-static">
                <?php		
				   foreach ( $blogusers as $user ) 
				   {
				?>	  
					<option value="<?=$user->display_name?>" <?php if($client==$user->display_name){?> selected <?php }?>><?=$user->display_name?></option>
				<?php	
					}
				?>
                </select>
            </div>
        </div>
        </div>
        <div id="form_set">
             <?php 
				 error_reporting(0);
				 $drone_data = get_post_meta($post->ID, 'drone_data', true);
				 
				 /*echo "<pre>";
				  print_r($drone_data);
				 echo "</pre>";*/ 
                
				if ( isset( $drone_data['site'] ) ) 
				{
					for( $i = 0; $i < count( $drone_data['site'] ); $i++ ) 
					{
					?>
                     <div  class="well">
                         <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 control-label">site: <span class="required">
                                </span>
                                </label>
                                <div class="col-md-4">
                                   <input type="text" name="drone[site][]" value="<?php esc_html_e( $drone_data['site'][$i] ); ?>" />   
                                </div>
                            
                                <label class="col-md-2 control-label">Capture date: <span class="required">
                                </span>
                                </label>
                                <div class="col-md-4">
                                   <input type="date" name="drone[capture_date][]" value="<?php esc_html_e( $drone_data['capture_date'][$i] ); ?>" />   
                                </div>
                           </div> 
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <label class="col-md-2 control-label">2d model: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[2d_model][]" value="<?php  esc_html_e( $drone_data['2d_model'][$i] ); ?>" />   
                            </div>
                        
                            <label class="col-md-2 control-label">3d model: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[3d_model][]" value="<?php esc_html_e( $drone_data['3d_model'][$i] ); ?>" />   
                            </div>
                          </div>  
                        </div>
                        <div class="form-group">
                           <div class="row">
                            <label class="col-md-2 control-label">360 photo: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[360_photo][]"  value="<?php esc_html_e( $drone_data['360_photo'][$i] ); ?>" />   
                            </div>
                        
                            <label class="col-md-2 control-label">stills: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[stills][]" value="<?php esc_html_e( $drone_data['stills'][$i] ); ?>" />   
                            </div>
                           </div> 
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <label class="col-md-2 control-label">ndvi: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[ndvi][]" value="<?php esc_html_e( $drone_data['ndvi'][$i] ); ?>" />   
                            </div>
                       
                            <label class="col-md-2 control-label">elevation map: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[elevation_map][]" value="<?php esc_html_e( $drone_data['elevation_map'][$i] ); ?>"/>   
                            </div>
                           </div> 
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <label class="col-md-2 control-label">pdf: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[pdf][]" value="<?php esc_html_e( $drone_data['pdf'][$i] ); ?>" class="pdf" />   
                                <input type="button" class="button" value="Choose File" onclick="add_image(this,'pdf')" />
                             	  <!--<img src="<?php esc_html_e( $drone_data['pdf'][$i] ); ?>" height="48" width="48" />-->
                            </div>
                            <label class="col-md-2 control-label">blueprint: <span class="required">
                            </span>
                            </label>
                            <div class="col-md-4">
                               <input type="text" name="drone[blueprint][]" value="<?php esc_html_e( $drone_data['blueprint'][$i] ); ?>" class="blueprint"/>   
                               <input type="button" class="button" value="Choose File" onclick="add_image(this,'blueprint')" />
                             	  <!--<img src="<?php esc_html_e( $drone_data['blueprint'][$i] ); ?>" height="48" width="48" />-->
                            </div>
                         </div>   
                        </div>
                        <div class="form-group">
                          <a href="javascript:void();" onclick="remove_field(this);">Remove</a>
                        </div>
                     </div>    
                        
              <?php
					} // endif
				} // endforeach
				?>
         
       </div> 
       <a href="javascript:void();"  id="add_more" class="btn">add more</a>
        
       </div>
    </div> 

<div id="empty_form"  style="display:none">
        
        <div  class="well">
         <div class="form-group">
            <div class="row">
                <label class="col-md-2 control-label">site: <span class="required">
                </span>
                </label>
                <div class="col-md-4">
                   <input type="text" name="drone[site][]" />   
                </div>
            
                <label class="col-md-2 control-label">Capture date: <span class="required">
                </span>
                </label>
                <div class="col-md-4">
                   <input type="date" name="drone[capture_date][]" />   
                </div>
           </div> 
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-md-2 control-label">2d model: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[2d_model][]" />   
            </div>
        
            <label class="col-md-2 control-label">3d model: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[3d_model][]" />   
            </div>
          </div>  
        </div>
        <div class="form-group">
           <div class="row">
            <label class="col-md-2 control-label">360 photo: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[360_photo][]" />   
            </div>
        
            <label class="col-md-2 control-label">stills: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[stills][]" />   
            </div>
           </div> 
        </div>
        <div class="form-group">
            <div class="row">
            <label class="col-md-2 control-label">ndvi: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[ndvi][]" />   
            </div>
       
            <label class="col-md-2 control-label">elevation map: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[elevation_map][]" />   
            </div>
           </div> 
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-md-2 control-label">pdf: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[pdf][]" />   
            </div>
            <label class="col-md-2 control-label">blueprint: <span class="required">
            </span>
            </label>
            <div class="col-md-4">
               <input type="text" name="drone[blueprint][]" />   
            </div>
         </div>   
        </div>
        <div class="form-group">
          <a href="javascript:void();" onclick="remove_field(this);">Remove</a>
        </div>
     </div>   
     
     
</div>

<script>
   function add_image(obj,css) {
	      // tb_show('', 'media-upload.php?TB_iframe=true');
			var parent=jQuery(obj).parent.parent.parent.parent('div.well');
			//var inputField = jQuery(parent).find("input.meta_image_url");
			var inputField;
			if(css=="pdf")
			{
				 inputField = jQuery(parent).find("input.pdf");
			
			}
			else
			{
				 inputField = jQuery(parent).find("input.blueprint");
			}
		   
			tb_show('', 'media-upload.php?TB_iframe=true');
		
			window.send_to_editor = function(html) {
				var url = jQuery(html).find('img').attr('src');
				inputField.val(url);
				/*jQuery(parent)
				.find("div.more_form_wrap")
				.html('<img src="'+url+'" height="48" width="48" />');*/
		
				// inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 
		
				tb_remove();
			};
		
			return false;  
		}
                        
   function remove_field(obj) {
			var parent = $(obj).parent().parent();
			//console.log(parent)
			parent.remove();
		}
  

  $(document).ready(function() {
	$('#form_set').append($('#empty_form').html());   
    $('#add_more').click( function (e) {
        e.preventDefault();
        $('#form_set').append($('#empty_form').html());
    });
 });   
</script>     




