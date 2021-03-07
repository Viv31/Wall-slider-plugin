<style type="text/css">
	#Slider-form{
		background-color:lightgrey;
		margin-top: 100px;
		margin-left: 100px;
		width: 400px;
		padding: 20px;
		border-radius: 5%;

	}
	td{
		padding: 5px;
	}
	.submit_btn{
		height: 50px;
		width: 100px;
		background-color:#b0b1b2;
		padding: 2px;
		border-radius: 5%;
		cursor: pointer;
}
</style>
<?php
//Updating slider settings 

if(isset($_POST['update'])){
	global $wpdb;
	/*if(wp_verify_nonce($_POST['_nonce'],'update-settings')){*/
	$slider_title = $_POST['slider_title'];
	$slider_description = $_POST['slider_description'];
	$slider_time = $_POST['slider_time'];

	if(!empty($slider_title) && !empty($slider_description) && !empty($slider_time)){
		$update_UI_settings = $wpdb->update('slider_settings',
		    array(
		    	'id'=>1,
		      'slider_title' => $slider_title,
		      'slider_description' => $slider_description,
		      'slider_time' => $slider_time,
		      ),
    			array('id'=>1));
   if(is_wp_error($update_UI_settings)){
    echo "error occure";
   }
   else{   echo "Setting Updated Successfully";
         //echo"<script>location.reload();</script>";
   }
}
/*}*/
	else{
		echo "<p style='color:red;'>All fields are required</p>";
	}
	
}

//Getting default settings value which is inserted on plugin activation

 global $wpdb;
   $update_positions_and_posts ="SELECT * FROM slider_settings WHERE id = 1";
   $Post_Setting_data = $wpdb->get_results($update_positions_and_posts);
     //print_r($Post_Setting_data);
     foreach ($Post_Setting_data as $settingData) {
     	# code...
     }


?>
<!--Default settings of slider -->
<div class="setting_div">

<form action="" method="POST"  id="Slider-form">
	<h4>Slider Setting</h4>
	<label>Slider Title:</label><br>
	<input type="text" name="slider_title" id="slider_title" placeholder="Enter Slider Title" value="<?php echo $settingData->slider_title; ?>">
	<br><br>
	<label>Slider Description:</label><br>
	<textarea name="slider_description" id="slider_description" placeholder="Enter Slider Description" ><?php echo $settingData->slider_description; ?></textarea><br><br>
	<label>Slider Timer:</label><br>
	<input type="text" name="slider_time" id="slider_time" placeholder="Enter Slider Timer" value="<?php echo $settingData->slider_time; ?>"><br><br>
	<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('update-settings') ?>">
	
	<input type="submit" name="update" value="Update" class="submit_btn">
	
</form>
</div>
<!--
Insert images by form
-->
<?php wp_enqueue_media();  ?>
<?php
/*if(isset($_POST['insert'])){
	$slider_image_name = $_FILES['slider_image']['name'];
	
	 
	$slider_order = $_POST['slider_order'];
		global $wpdb;
       $table_name = 'slider_images';
       $slider_image = $_FILES['slider_image']['name'];
       $slider_order = $_POST['slider_order'];
      	$created_date =date('Y-m-d h:i:s');
       
       
     $insert_setting =  $wpdb->insert($table_name, array(
		  'slider_image' => $slider_image,
          'slider_order'=> $slider_order,
         'created_date'=> $created_date
        ));
     if(is_wp_error($insert_setting)){
     	//echo "Error";
     }
     else{
     	$path = plugins_url()."/custom-slider/uploads/";
	 //echo $path;
	 	$target_file = $path.basename($_FILES["slider_image"]["name"]);
		//echo $target_file;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		 move_uploaded_file($_FILES["slider_image"]["name"], $target_file);
		
		 	
     }
}*/

?>

<!-- Image insert form  -->
<div class="slider_image_div">
<form  action="#"  id="Slider-form">
	<h4>Slider Images</h4>
	<input type="button" name="insert_slider_image" id="insert_slider_image" value="Upload Image">
	<br><br>
	<label>Slides Order:</label><br>
	<input type="text" name="slider_order" id="slider_order" placeholder="Slider order">
	<br><br>
	<input type="submit" name="insert" id="insert" value="Insert">
</form>
</div>
<script type="text/javascript">
		jQuery(function(){
		jQuery("#insert_slider_image").on("click",function(){
		var images = wp.media({
			title:'Upload Image',
			multiple:false
			}).open().on("select",function(e){
			var uploadImages = images.state().get("selection").first();
			//console.log(uploadImages);
			var SelectedImages = uploadImages.toJSON();

			/*jQuery.each(SelectedImages,function(index,image){
				console.log(image.url);

			});*/

		});});});
</script>
<!-- Showing all inserted images -->
<div class="all_images_section">
	<h3 style="text-align: center;">All Iamges</h3>
	<table border="1" align="center">
		<tr>
			<th>Sno</th>
			<th>Slider Iamge</th>
			<th>SLide Order</th>
			<th>Created Date</th>
			<th colspan="2">Action</th>
		</tr>
		<?php
		 	global $wpdb;
		   $slider_images ="SELECT * FROM slider_images";
		   $slider_data = $wpdb->get_results($slider_images);
		   $sno=1;
		   foreach ($slider_data as $slideImages) {
   	 		$img_path = plugins_url()."/custom-slider/uploads/$slideImages->slider_image";
   			?><tr>
   			<td><?php echo $sno; ?></td>
			<td><img src="<?php echo $img_path; ?>" height="100px;" width="100px;"></td>
			<td><?php echo $slideImages->slider_order; ?></td>
			<td><?php echo $slideImages->created_date; ?></td>
			<td><form>
					<input type="hidden" name="img_id" value="<?php echo $slideImages->id; ?>">
				<input type="submit" name="update_image" value="update" id="update">
				</form>
			</td>
			<td><form method="POST">
				<input type="hidden" name="img_id" value="<?php echo $slideImages->id; ?>">
				<input type="submit" name="delete" value="Delete" id="delete">
			</form></td>
			</tr>
  <?php $sno++; }
   ?>
			
		
	</table>
</div>


<div class = "image_update_form" style="/*display: none;*/">
	<form  method="POST" action=""  id="Slider-form" enctype="multipart/form-data">
	<h4 style="text-align: center;">Slider Images Update</h4>
	<img src="<?php echo $img_path; ?>" height="100px;" width="100px;">
	<input type="file" name="update_slider_image" id="update_slider_image" value=""><br><br>
	<label>Slides Order:</label><br>
	<input type="text" name="slider_order" id="slider_order" value="<?php echo $slideImages->slider_order; ?>" placeholder="Slider order">
	<br><br>
	<input type="submit" name="insert" id="insert" value="Update Image">
</form>
</div>
<script type="text/javascript">
	
</script>
<?php 
//checking delete button is clicked or not
if(isset($_POST['delete'])){
	$img_id = @$_POST['img_id'];
	delete_image(@$img_id);
}

//function for deleting images
function delete_image($img_id){
	global $wpdb;
	$table_name = 'slider_images';
	$delete_query = $wpdb->delete($table_name,['id'=>$img_id]);
	if(is_wp_error($delete_query)){
		echo "Error";

	}
	else{
		//echo "Deleted Successfully";
	}


}


//checking button click
if(isset($_POST['update_image'])){
	$img_id = @$_POST['img_id'];
	//update_images(@$img_id);

}



//Update slider images data 
function update_images($img_id){
	global $wpdb;
	$table_name = 'slider_images';
	$update_image_slides = $wpdb->update($table_name,
		    array(
		    	'slider_image' => $slider_image,
		      'slider_order' => $slider_order,
		      'created_date' => $created_date,
		      ),
    			array('id'=>$img_id));
   if(is_wp_error($update_image_slides)){
    echo "error occure";
   }
   else{   echo "Setting Updated Successfully";
         //echo"<script>location.reload();</script>";
   }

}


?>