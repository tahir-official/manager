<?php

class Menu_page_setting {
      public function __construct(){
      	 add_action('admin_menu',array($this, 'register_custom_menu_page'));
      }
      public function register_custom_menu_page() {
	    add_menu_page('custom menu title', 'custom menu', 'add_users', 'custompage', '_custom_menu_page', null, null ); 
	    add_menu_page('custom menu title2', 'custom menu2', 'add_users', 'custompage2', '_custom_menu_page2', null, null ); 
	  }
	  

}

  function _custom_menu_page2(){
	   echo "Admin Page Test";  
  }
  function _custom_menu_page(){
		   echo "Admin Page Test";  
}