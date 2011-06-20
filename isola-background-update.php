<?php
global $wpdb;
$id = $_GET["id"];
$action = $_GET["action"];

$results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "custom_carousel" WHERE ID = $id, OBJECT);

			$id = $result->id;
	    $title = $result->title;
			$description = $result->description;
			$image_url = $result->image_url;
?>
<div class="wrap">  
      <form name="carousel_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
          <input type="hidden" name="carousel_hidden" value="Y">
					<input type="hidden" name="id" value="echo $id;">    
          <p><?php _e("Title: " ); ?><input type="text" name="title" value="<?php echo $title; ?>" size="20"></p>  
          <p><?php _e("Description: " ); ?><textarea rows="2" cols="20" name="description" rows="2" cols="20"><?php echo $description; ?></textarea></p>  
          <p><?php _e("Image: " ); ?><input type="text" name="imageurl" value="<?php echo $image_url; ?>" size="20"></p>
					<p><?php _e("More Link: " ); ?><input type="text" name="morelink" value="<?php echo $more_link; ?>" size="20"></p>
          <p class="submit">  
          <input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />  
          </p>  
      </form>
  </div>