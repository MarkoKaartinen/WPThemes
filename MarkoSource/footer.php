		<hr />
		<?php
		$markosource_info = get_theme_data(get_stylesheet_uri());
		$markosource_version = $markosource_info['Version'];
		?>
		<footer>
			<p>&copy; <?php bloginfo( 'name' ); ?> - Powered by <a href="http://wordpress.org" target="_blank">WordPress</a> - MarkoSource <?php echo $markosource_version; ?> by <a href="http://markokaartinen.net" target="_blank">Marko Kaartinen</a></p>
		</footer>
		
	</div> <!-- /container -->

<?php wp_footer(); ?>
</body>
</html>