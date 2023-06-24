<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link href="<?=plugins_url( 'carousel-owl-carousel/owl-carousel/owl.carousel.css', __FILE__ )?>" rel="stylesheet">
<script src="<?=plugins_url( 'carousel-owl-carousel/assets/js/jquery-1.9.1.min.js', __FILE__ )?>"></script> 
<script src="<?=plugins_url( 'carousel-owl-carousel/owl-carousel/owl.carousel.min.js', __FILE__ )?>" type="text/javascript"></script><!-- slider for products -->


<style>
#sub-header
{
  display:none;	
}
.wpv-main {
     background-color: #FFC !important;
}
</style>



<?php
  $drone_data = get_post_meta($atts['id'], 'drone_data', true);
?>
 <script language="javascript">
 
	var droneArr = ['site','capture_date','2d_model','3d_model','360_photo','stills','ndvi','elevation_map','pdf','blueprint'];
	droneArr["site"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["capture_date"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["2d_model"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["3d_model"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["360_photo"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["stills"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["ndvi"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["elevation_map"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["pdf"] = new Array(<?=count($drone_data['site'])?>);
	droneArr["blueprint"] = new Array(<?=count($drone_data['site'])?>);
 </script>
<?php  
  if ( isset( $drone_data['site'] ) ) 
	{
		for( $i = 0; $i < count( $drone_data['site'] ); $i++ ) 
		{
			echo '<script>droneArr["site"]['.$i.'] = 	"'.$drone_data['site'][$i].'";</script>';
			echo '<script>droneArr["capture_date"]['.$i.'] = 	"'.$drone_data['capture_date'][$i].'";</script>';
			echo '<script>droneArr["2d_model"]['.$i.'] = 	"'.$drone_data['2d_model'][$i].'";</script>';
			echo '<script>droneArr["3d_model"]['.$i.'] = 	"'.$drone_data['3d_model'][$i].'";</script>';
			echo '<script>droneArr["360_photo"]['.$i.'] = 	"'.$drone_data['360_photo'][$i].'";</script>';
			echo '<script>droneArr["stills"]['.$i.'] = 	"'.$drone_data['stills'][$i].'";</script>';
			echo '<script>droneArr["ndvi"]['.$i.'] = 	"'.$drone_data['ndvi'][$i].'";</script>';
			echo '<script>droneArr["elevation_map"]['.$i.'] = 	"'.$drone_data['elevation_map'][$i].'";</script>';
			echo '<script>droneArr["pdf"]['.$i.'] = 	"'.$drone_data['pdf'][$i].'";</script>';
			echo '<script>droneArr["blueprint"]['.$i.'] = 	"'.$drone_data['blueprint'][$i].'";</script>';
		
		}
	}
?>
<script language="javascript">
   function set_mon(value)
   {
	 $("#month").val(value);      
   }
   
   function set_data_type(value)
   {
	 $("#data_type").val(value);      
   }
   function read_data()
   {
	   for(i=0;i<droneArr["site"].length;i++)
	   {
		  
		   
		   year1 = $("#year").val();
		   month1 = $("#month").val();
		   data_type = $("#data_type").val();
		
		   arr_data = droneArr["capture_date"][i].split("-");
		   year     =  arr_data[0];
		   month    =  arr_data[1]; 
		   
		   
		   if(month1=='Jan')
			{
				month1 = 1;
			}
			if(month1=='Feb')
			{
				month1 = 2;
			}
			if(month1=='Mar')
			{
				month1 = 3;
			}
			if(month1=='Apr')
			{
				month1 = 4;
			}
			if(month1=='May')
			{
				month1 = 5;
			}
			if(month1=='June')
			{
				month1 = 6;
			}
			if(month1=='July')
			{
				month1 = 7;
			}
			if(month1=='Aug')
			{
				month1 = 8;
			}
			if(month1=='Sep')
			{
				month1 = 9;
			}
			if(month1=='Oct')
			{
				month1 = 10;
			}
			if(month1=='Nov')
			{
				month1 = 11;
			}
			if(month1=='Dec')
			{
				month1 = 12;
			}
			
			
			for (var key in droneArr) {
				
				if(key==data_type)
				{
					current_key = key;
					break;
				}
			}
   
		   
		  if(year == year1.trim() && parseInt(month) == month1 && data_type==current_key)
			{
			   data_link = droneArr[data_type][i];
			   
			   //alert(data_link);
			   
			   // $("#id_link").html(data_link);
				$("#ifrmae_id").attr('src',data_link);
			   
			   
			}
	   }
	   
	   
   }
    
</script>
<b>
<?php
    $id = $atts['id'];
	//echo $id;
?>
</b>
<br />
<!--<div id="id_link"></div>
<b>Selected data</b>-->
<div class="row">
   <div class="col-md-12">
       Year<select name="year" id="year" value="" class="form-control-static" style="width:220px;" />
            <!--<option value=""></option>-->
            <?php
             for($i=date("Y");$i>=2010;$i--)
             {
            ?>
             <option value="<?=$i?>"><?=$i?></option>
            <?php
             }
            ?>
           </select> 
   
        <input type="text" name="post_id" id="post_id" value="<?=$id?>"  class="form-control-static"  style="display:none;"/>
  	 Mon<input type="text" name="month" id="month" value="" class="form-control-static" style="width:220px;" />
   
 	  Data Type<input type="text" name="data_type" id="data_type" value=""  class="form-control-static"   style="width:220px;" />
  
  	 <input type="button"  style="background-color:#378FC9;color:#FFF;width:220px;" value="Read Data"   onclick="read_data();" />
   </div>      <!--class="ajax-link"-->
</div>
<div class="container">
 <div class="row">
     <div id="map" class="col-md-8 col-sm-8 col-xs-8">
        <div class="row">
         <div id="map" class="col-md-12 col-sm-12 col-xs-12">
             <iframe  id="ifrmae_id" width='100%' height='500' src=''></iframe>
            <!-- <img src="<?=plugins_url( 'images/cimgpsh_orig.png', __FILE__ )?>">-->
         </div> 
       </div>
        
        <div class="row">
         <style>
		    .owl-item{
				 text-align:center !important;
				 background-color:#333 !important;
				 color:#FFF !important;
				 border-radius:5px;
				 border:1px solid #FFF;
				 padding:inherit;
			}
			.button_d_type {
					 text-align:center;
					 background-color:#378FC9 !important;
					 color:#FFF !important;
					 border-radius:5px;
					 border:1px solid #FFF;
					 width:170px !important;
					 margin-bottom: 3px  !important;
				}
		 </style>
          <div id="map" class="col-md-12 col-sm-12 col-xs-12">
             
             
               <div class="owl-carousel owl-carousel6-brands">
                  <a href="javascript:void();" onclick="set_mon('Jan');"><h3>January</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Feb');"><h3>February</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Mar');"><h3>March</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Apr');"><h3>April</h3></a>
                  <a href="javascript:void();" onclick="set_mon('May');"><h3>May</h3></a>
                  <a href="javascript:void();" onclick="set_mon('June');"><h3>June</h3></a>
                  <a href="javascript:void();" onclick="set_mon('July');"><h3>July</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Aug');"><h3>Aug</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Sep');"><h3>Sep</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Oct');"><h3>Oct</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Nov');"><h3>Nov</h3></a>
                  <a href="javascript:void();" onclick="set_mon('Dec');"><h3>Dec</h3></a>
               </div>
            <script language="javascript">
				
				jQuery(document).ready(function () {
					
							$(".owl-carousel6-brands").owlCarousel({
								pagination: false,
								navigation: true,
								items: 6,
								/*addClassActive: true,
								itemsCustom : [
									[0, 1],
									[320, 1],
									[480, 2],
									[700, 3],
									[975, 5],
									[1200, 6],
									[1400, 6],
									[1600, 6]
								],*/
							});
							
				});
			</script>
                <script src="<?=plugins_url( 'carousel-owl-carousel/assets/js/bootstrap-collapse.js', __FILE__ )?>"></script>
				<script src="<?=plugins_url( 'carousel-owl-carousel/assets/js/bootstrap-transition.js', __FILE__ )?>"></script>
                <script src="<?=plugins_url( 'carousel-owl-carousel/assets/js/bootstrap-tab.js', __FILE__ )?>"></script>
            
                <script src="<?=plugins_url( 'carousel-owl-carousel/assets/js/google-code-prettify/prettify.js', __FILE__ )?>"></script>
                <script src="<?=plugins_url( 'carousel-owl-carousel/assets/js/application.js', __FILE__ )?>"></script>
             
         </div>
         
        </div>
    
     </div>
     <div id="rightbar"  class="col-md-4 col-sm-4 col-xs-4"   style="background-color:#3C9CDD;">
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-24"  style="background-color:#3182B9;">
                   <div align="left" style="color:#FFF"><h4>Data Types</h4></div>
             </div>
           </div>
           <div class="row">  
             <div class="col-md-12 col-sm-12 col-xs-24">
                <input type="button" class="button_d_type" value="2D Map (Ortho)"  onclick="set_data_type('2d_model');">
                <input type="button" class="button_d_type"  value="3D Model"  onclick="set_data_type('3d_model');">
                <input type="button" class="button_d_type"   value="360 Photo"  onclick="set_data_type('360_photo');">
                <input type="button" class="button_d_type"  value="Stills"  onclick="set_data_type('stills');">
                <input type="button" class="button_d_type"  value="NDVI"  onclick="set_data_type('ndvi');">
                <input type="button" class="button_d_type"  value="Elevation"  onclick="set_data_type('elevation_map');">
             </div>
          </div>
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-24"  style="background-color:#3182B9;">
                   <div align="left" style="color:#FFF"><h4>Overlay</h4></div>
             </div>
           </div>
           <div class="row">  
             <div class="col-md-12 col-sm-12 col-xs-24">
                <input type="button" class="button_d_type" value="PDF"  onclick="set_data_type('pdf');">
                <input type="button" class="button_d_type"  value="Blueprint"  onclick="set_data_type('blueprint');">
                <input type="button" class="button_d_type"   value="Other"  onclick="set_data_type('other');">
             </div>
          </div>
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-24"  style="background-color:#3182B9;">
                   <div align="left" style="color:#FFF"><h4>Download</h4></div>
             </div>
           </div>
           <div class="row">  
             <div class="col-md-12 col-sm-12 col-xs-24">
              Digital surface Model (TIF)
             </div>
             <div class="col-md-12 col-sm-12 col-xs-24">
              3D Mesh (OBJ) 
             </div>
             <div class="col-md-12 col-sm-12 col-xs-24">
             Orthomosaic(TIF)
             </div>
             <div class="col-md-12 col-sm-12 col-xs-24">
             Point Cloud (LAS)
             </div>
             <div class="col-md-12 col-sm-12 col-xs-24">
              Print Screen (PDF)
             </div>
          </div>
            <a class="btn-large waves-effect waves-light red" 
             style="margin-top:15px;"  id="add_more"><i class="material-icons">add</i></a>
       
     </div>
 </div>
</div>


