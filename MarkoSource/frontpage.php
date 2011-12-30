<h2><?php _e("Welcome", "markosource"); ?>!</h2>
<?php while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; // End the loop. Whew. ?>

<hr />

<h2><?php _e("Latest stories", "markosource"); ?></h2>
<?php
$recent_posts = wp_get_recent_posts( array( 'numberposts' => 4, 'post_status' => 'publish' ) );
$x = 1;
foreach( $recent_posts as $recent ){
	$sisalto = $recent['post_excerpt'];
	if($sisalto == ""){
		$kokojuttu = $recent['post_content'];
		$kokojuttu = strip_tags($kokojuttu);
		$kokojuttu = wordwrap($kokojuttu, 200, "|||");
		$osat = explode("|||", $kokojuttu);
		$sisalto = $osat[0];
		if(count($osat) > 1){
			$sisalto .= "…";
		}
	}
	
	$kommentit = $recent['comment_count'];
	if($kommentit == 0){
		$komtext = __("No comments", "markosource");
	}elseif($kommentit == 1){
		$komtext = __("1 comment", "markosource");
	}else{
		$komtext = sprintf( __("%s comments" , "markosource") , $kommentit );
	}

	if($x == 1 OR $x == 3){
		echo '<div class="row">';
	}

		echo '<div class="span5">';
			echo '<h3><a href="' . get_permalink($recent["ID"]) . '" title="Look '.$recent["post_title"].'" >' .   $recent["post_title"].'</a></h3>';
			if(get_bloginfo("language") == "fi"){
				$posttime = get_the_time('j. F', $recent["ID"]) . "ta " . get_the_time('Y', $recent["ID"]) . " kello " . get_the_time("H:i", $recent["ID"]);
			}else{
				$posttime = get_the_time("d.m.Y - H:i", $recent["ID"]);
			}
			echo '<div class="postinfo"><span class="label info">'.$posttime.'</span></div>';
			echo '<p>' . $sisalto . '</p>
			<p><a class="btn small" href="' . get_permalink($recent["ID"]) . '#comments">'.$komtext.'</a> <a class="btn small" href="' . get_permalink($recent["ID"]) . '">'.__("Read more", "markosource").' &raquo;</a></p>';
		echo "</div>";
		
	if($x == 2 OR $x == 4){
		echo '</div>';
	}
	if($x == 2){
		echo "<hr />";
	}
	$x++;
}
?>