<?php
class Login_setting {
        
        public function __construct(){
	        //login page back remove action hook
	        add_action('login_enqueue_scripts', array($this, 'bb_login_page_remove_back_to_link'));
	        //login page logo change action hook
	        add_action('login_head', array($this, 'bb_loginlogo'));
	        //login page hide password change link filter hook
	        add_filter( 'show_password_fields', array( $this, 'bb_disable' ) );
		    add_filter( 'allow_password_reset', array( $this, 'bb_disable' ) );
		    add_filter( 'gettext',              array( $this, 'bb_remove' ) );
	}
	     
	//login page back remove callback function
	public function bb_login_page_remove_back_to_link(){ ?>
	    <style type="text/css">
	        body.login div#login p#backtoblog{
	          display: none;
	        }
	        body{
		    background: #5353c6 !important;
		    min-width: 0;
		    color: #3c434a;
		    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
		    font-size: 13px;
		    line-height: 1.4;
		}
               .login #backtoblog a, .login #nav a{
                    text-decoration: none;
		    color: #fff !important;
		    font-weight: bold;

		}
                .login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover{
                    color: #121213 !important;
		    font-weight: bold;

		}
		
		
	    </style>
        <?php }

        //login page logo change callback function
        public function bb_loginlogo() {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		echo '<style type="text/css">
		h1 a {background-image: url('.$image[0].') !important; }
		</style>';
		}

		//login page hide password change callback functions
		public function bb_disable(){
		    if ( is_admin() ) {
		      $userdata = wp_get_current_user();
		      $user = new WP_User($userdata->ID);
		      if ( !empty( $user->roles ) && is_array( $user->roles ) && $user->roles[0] == 'administrator' )
		        return true;
		    }
		    return false;
		}
		 
		public function bb_remove($text){
		    return str_replace( array('Lost your password?', 'Lost your password'), '', trim($text, '?') ); 
		}
	

		
}