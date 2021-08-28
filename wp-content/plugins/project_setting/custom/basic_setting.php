<?php
class Basic_setting {
        
        public function __construct(){
	        //set default color action hook
	        add_action('user_register', array($this, 'bb_set_default_admin_color'));
	        // removes the `profile.php` admin color scheme options
                remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker' );
                add_action('admin_head',array($this, 'bb_hide_personal_options') );
                add_action('admin_bar_menu',array($this, 'bb_shapeSpace_remove_toolbar_nodes') ,999);
                add_action( 'admin_menu', array($this, 'bb_change_post_label') );
                add_action( 'init',array($this, 'bb_change_post_object'));
                add_action( 'admin_init',array($this, 'bb_remove_menu_pages') );
                //customize role
                add_action( 'init',array($this, 'bb_set_capabilities'));
                add_action( 'customize_register',array($this, 'bb_remove_customizer_options'), 30 );
                

                
	        
        }
	//set default color callback function     
	public function bb_set_default_admin_color($user_id){
		    $user_meta=get_userdata($user_id);
		    $user_roles=$user_meta->roles;
		    if ( in_array( 'administrator', $user_roles, true ) ) {
			$admin_color='modern';
		    }else{
		    	$admin_color='midnight';
		    }
		    $args = array(
		        'ID' => $user_id,
		        'admin_color' => $admin_color
		    );
		    wp_update_user( $args );
	}

	// Remove fields from Admin profile page

	public function bb_hide_personal_options(){
	echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) { $(\'form#your-profile > h3:first\').hide(); $(\'form#your-profile > table:first\').hide(); $(\'form#your-profile\').show(); });</script>' . "\n";
	}
	public function bb_shapeSpace_remove_toolbar_nodes($wp_admin_bar) {
	
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('customize');
	$wp_admin_bar->remove_node('customize-background');
	$wp_admin_bar->remove_node('customize-header');
	
        }
       public function bb_change_post_label() {
	    global $menu;
	    global $submenu;
	    $userdata = wp_get_current_user();
            $user = new WP_User($userdata->ID);
	    /*echo '<pre>';
	    print_r($menu);
	    echo '</pre>';*/
	    $menu[10][0] = 'Media Management';
	    $menu[20][0] = 'Page Management';
	    $menu[60][0] = 'Content Management';
	    if ( !empty( $user->roles ) && is_array( $user->roles ) && $user->roles[0] == 'administrator' ){
	    	$menu[70][0] = 'Users Management';
	    }else{
	    	$menu[70][0] = 'Profile Management';
	    }


	    
	    $menu[80][0] = 'Site Setting';
	    $menu[5][0] = 'Blogs Management';
	    $submenu['edit.php'][5][0] = 'Blogs';
	    $submenu['edit.php'][10][0] = 'Add Blog';
	    $submenu['edit.php'][16][0] = 'Blog Tags';
	}
	public function bb_change_post_object() {
	    global $wp_post_types;
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = 'Blogs';
	    $labels->singular_name = 'Blog';
	    $labels->add_new = 'Add Blog';
	    $labels->add_new_item = 'Add Blog';
	    $labels->edit_item = 'Edit Blog';
	    $labels->new_item = 'Blog';
	    $labels->view_item = 'View Blog';
	    $labels->search_items = 'Search Blogs';
	    $labels->not_found = 'No Blog found';
	    $labels->not_found_in_trash = 'No News found in Trash';
	    $labels->all_items = 'All Blogs';
	    $labels->menu_name = 'Blogs';
	    $labels->name_admin_bar = 'Blogs';
       }

       public function bb_remove_menu_pages() {
       	   $userdata = wp_get_current_user();
           $user = new WP_User($userdata->ID);
           
           
	   remove_menu_page('edit-comments.php'); // Comments
	   remove_menu_page('tools.php'); // Tools
	   remove_submenu_page( 'themes.php', 'themes.php' ); //theme page
	   remove_submenu_page( 'themes.php', 'nav-menus.php' ); //menu page
	   remove_submenu_page( 'themes.php', 'theme-editor.php' ); //theme editer page
	   remove_submenu_page( 'plugins.php', 'plugin-editor.php' ); //plugin editer page
	   remove_submenu_page( 'plugins.php', 'plugin-install.php' ); //plugin install page
	   remove_submenu_page( 'options-general.php', 'options-writing.php' ); //plugin install page
	   remove_submenu_page( 'options-general.php', 'options-reading.php' ); //plugin install page
	   remove_submenu_page( 'options-general.php', 'options-discussion.php' ); //plugin install page
	   remove_submenu_page( 'options-general.php', 'options-media.php' ); //plugin install page
	   remove_submenu_page( 'options-general.php', 'options-privacy.php' ); //plugin install page
	   if ( !empty( $user->roles ) && is_array( $user->roles ) && $user->roles[0] != 'administrator' ){
	   remove_menu_page('edit.php?post_type=page');
	   } 

	   
	  /*global $user_ID;

	  if ( $user_ID != 1 ) {
	   
	  }*/
     }
     public function bb_set_capabilities() {
 
	    // Get the role object.
	    $editor = get_role( 'editor' );
	 
	    // A list of capabilities to remove from editors.
	    $caps = array(
	        'delete_published_pages',
	        'publish_pages',
	        'edit_others_pages',
	        'publish_posts',

	    );
	 
	    foreach ( $caps as $cap ) {
	     
	        // Remove the capability.
	        $editor->remove_cap( $cap );
	    }
    }

    public function bb_remove_customizer_options( $wp_customize ) {
    	   $wp_customize->remove_section('themes');
	   $wp_customize->remove_panel('nav_menus');
	   $wp_customize->remove_section('colors');
	   $wp_customize->remove_section('options');
	   $wp_customize->remove_section('cover_template_options');
	   $wp_customize->remove_section('background_image');
	   $wp_customize->remove_panel('widgets');
	   $wp_customize->remove_section('static_front_page');

    }
     

}


