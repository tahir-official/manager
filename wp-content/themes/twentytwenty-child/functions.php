<?php
    add_action( 'wp_enqueue_scripts', 'bb_child_enqueue_parent_styles' );

	function bb_child_enqueue_parent_styles() {
	   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}
	
	

?>