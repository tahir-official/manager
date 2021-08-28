<?php
/**
* Plugin Name: Project Setting Plugin
* Plugin URI: https://www.linkedin.com/in/tahir-mansuri-b7310a94
* Description: In this plugin we are added all the custom code and functionality.
* Version: 1.0
* Author: Tahir Mansuri
* Author URI: https://www.linkedin.com/in/tahir-mansuri-b7310a94
**/
$plugin_dir_path = plugin_dir_path( __FILE__ );
include('custom/htaccess_setting.php');
include('custom/login_setting.php');
include('custom/basic_setting.php');
include('custom/menu_page_setting.php');
$Htaccess_setting = new Htaccess_setting();
$Login_setting = new Login_setting();
$Basic_setting = new Basic_setting();
$Menu_page_setting = new Menu_page_setting();



 





 