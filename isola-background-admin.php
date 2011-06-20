<div class="wrap">
	<h2>Isola Hero Carousel <a class="button add-new-h2" href="?page=Isola_Background_Carousel&action=create">Add New</a> </h2>
</div>
<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(document).ready(function() {

	  $j('a.delete').click(function(e) {
	    var deleteAnchor = $j(this),
					parent = deleteAnchor.parent().parent(),
					deleteUrl = deleteAnchor.attr('href');
			

			var forceDelete = confirm("Are you sure you want to delete the Hero?");
			
			if (forceDelete) {

				$j.ajax({
					type: 'get',
					url: 'options-general.php' + deleteUrl,
					data: 'ajax=1&action=delete&id=' + parent.attr('id').replace('record-',''),
					beforeSend: function() {
					  parent.animate({'backgroundColor':'#fb6c6c'},300);
					},
					success: function() {
					  parent.slideUp(300,function() {
					    parent.remove();
					  });
					}
				});
		    
			};
			
			return false;
	    // 			
	    // 			
	  });
	});
</script>
<?php
	global $wpdb;
	if(isset($_GET['id'])) {
		$id = $_GET["id"];
	}
	$action = null;
	if(isset($_GET['action'])) {
		$action = $_GET["action"];
	}
	
	switch ($action) {
		case 'create': 
			if(isset($_POST['carousel_hidden'])) { 
		 			$carouseltitle = $_POST['title'];
		 			$carouseldescription = $_POST['description'];  
		 			$carouselimage_url = $_POST['imageurl'];
		 			$carouselmore_link = $_POST['morelink'];
		 			
		 			global $wpdb;
					$wpdb->insert( "wp_custom_carousel", array( 'title' => $carouseltitle, 'description' => $carouseldescription, 'image_url' => $carouselimage_url, 'more_link' => $carouselmore_link ));
					
		}
			?>
				<div class="wrap">
					<div id="poststuff">
					<div class="postbox">
						<div title="Click to toggle" class="handlediv"><br></div>
						<h3 class="hndle"><span>Create new hero image</span></h3>
						<div class="inside">
							<form name="carousel_form" class="form-table" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
				          <input type="hidden" name="carousel_hidden" value="Y">
									<table border="0" cellspacing="5" cellpadding="5">
										<tr><td><?php _e("Title: " ); ?></td><td><input id="title" type="text" name="title" value="" size="24"></td></tr>
										<tr><td><?php _e("Description: " ); ?></td><td><textarea rows="2" cols="20" name="description" rows="2" cols="20"></textarea></td></tr>
										<tr><td><?php _e("Image URL: " ); ?></td><td><input id="upload_image" type="text" name="imageurl" value="" size="24"></td></tr>
										<tr><td><?php _e("Browse/Upload Image: " ); ?></td><td><a onclick="return false;" title="Upload image" class="thickbox button" id="add_image" href="media-upload.php?type=image&amp;TB_iframe=true&amp;width=640&amp;height=105">Upload Image</a></td></tr>
										<tr><td><?php _e("More Link: " ); ?></td><td><input type="text" name="morelink" value="" size="24"></td></tr>
									</table>
									<p class="submit">  
									<input class="button-primary" type="submit" name="Submit" value="<?php _e('Create Hero', 'oscimp_trdom' ) ?>" />  
									</p>
				      </form>
						</div>
					</div>      
				</div>
			</div>
				
			<?php break;
			
		case 'edit':
			$results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "custom_carousel WHERE ID = $id", OBJECT);
			 foreach ( $results as $result ) {
			 	    $title = $result->title;
			 			$description = $result->description;
			 			$image_url = $result->image_url;
			 			$more_link = $result->more_link;
			 }
			 	if(isset($_POST['carousel_hidden'])) { 
			 			$carouseltitle = $_POST['title'];
			 			$carouseldescription = $_POST['description'];  
			 			$carouselimage_url = $_POST['imageurl'];
			 			$carouselmore_link = $_POST['morelink'];
			 			
			 			global $wpdb;
			 			$wpdb->update( "wp_custom_carousel", array( 'title' => $carouseltitle, 'description' => $carouseldescription, 'image_url' => $carouselimage_url, 'more_link' => $carouselmore_link ), array( 'ID' => $id ) );
			}
			?>
			<div class="wrap">
				<div id="poststuff">
					<div class="postbox">
						<div title="Click to toggle" class="handlediv"><br></div>
						<h3 class="hndle"><span>Edit hero image</span></h3>
							<div class="inside">
					      <form name="carousel_form" class="form-table" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
					          <input type="hidden" name="carousel_hidden" value="Y">
										<table border="0" cellspacing="5" cellpadding="5">
											<tr><td><?php _e("Title: " ); ?></td><td><input type="text" name="title" value="<?php echo $title; ?>" size="24"></td></tr>
											<tr><td><?php _e("Description: " ); ?></td><td><textarea rows="2" cols="20" name="description" rows="2" cols="20"><?php echo $description; ?></textarea></td></tr>
											<tr><td><?php _e("Image URL: " ); ?></td><td><input  id="upload_image" type="text" name="imageurl" value="<?php echo $image_url; ?>" size="24"></td></tr>
											<tr><td><?php _e("Browse/Upload Image: " ); ?></td><td><a onclick="return false;" title="Upload image" class="button thickbox button" id="add_image" href="media-upload.php?type=image&amp;TB_iframe=true&amp;width=640&amp;height=105">Upload Image</a></td></tr>
											<tr><td><?php _e("More Link: " ); ?></td><td><input type="text" name="morelink" value="<?php echo $more_link; ?>" size="24"></td></tr>
										</table>
					          <p class="submit">  
					          <input class="button-primary" type="submit" name="Submit" value="<?php _e('Edit Hero', 'oscimp_trdom' ) ?>" />  
					          </p>  
					      </form>
							</div>
						</div>      
					</div>
				</div>
			<?php
			break;
		
		case 'delete':
			$wpdb->query("DELETE FROM " . $wpdb->prefix . "custom_carousel WHERE ID = $id", OBJECT);
			break;
			
		default: ?>
		
			<?php break;
	}	
	
	?>
	<div class="wrap">
	<table class="wp-list-table widefat fixed posts" border="0" cellspacing="5" cellpadding="5">
		<thead>
			<tr>
				<th>Title</th>
				<th>Description</th>
				<th>Image</th>
				<th>Options</th>
			</tr>
		</thead>
		<?php
		global $wpdb;

		$results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "custom_carousel", OBJECT);

			foreach ( $results as $result ) {
					$id = $result->id;
			    $title = $result->title;
					$description = $result->description;
					$image_url = $result->image_url;
		?>
		<tr id="record-<?php echo $id; ?>">
			<td><?php echo $title; ?></td>
			<td><?php echo $description; ?></td>
			<td><?php echo $image_url; ?></td>
			<td>
				<span class="edit"><a title="Edit this item" href="?page=Isola_Background_Carousel&id=<?php echo $id ?>&action=edit">Edit</a> | </span>
				<a href="?page=Isola_Background_Carousel&id=<?php echo $id ?>&action=delete" title="Move this item to the Trash" class="delete submitdelete">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>