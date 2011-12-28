<h2>Tervetuloa!</h2>
<?php while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; // End the loop. Whew. ?>

<hr />

<h2>Viimeisimmät jutut</h2>
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
		$komtext = "Ei kommentteja";
	}elseif($kommentit == 1){
		$komtext = "1 kommentti";
	}else{
		$komtext = "$kommentit kommenttia";
	}

	if($x == 1 OR $x == 3){
		echo '<div class="row">';
	}

		echo '<div class="span5">';
			echo '<h3><a href="' . get_permalink($recent["ID"]) . '" title="Look '.$recent["post_title"].'" >' .   $recent["post_title"].'</a></h3>
			<p>' . $sisalto . '</p>
			<p><a class="btn" href="' . get_permalink($recent["ID"]) . '#comments">'.$komtext.'</a> <a class="btn" href="' . get_permalink($recent["ID"]) . '">Lue lis&auml;&auml; &raquo;</a></p>';
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