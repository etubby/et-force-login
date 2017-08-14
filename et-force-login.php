<?php

/**
 *  Plugin Name: ET Force Login
 *  Plugin URI: http://erictubby.ca/
 *  Description: Forces all visitors to be logged in
 *  Version: 1.0.1
 *  Author: Eric Tubby
 *  Author URI: http://erictubby.ca/
 *  License: GPLv2 or later (license.txt)
 *  GitHub Plugin URI: https://github.com/etubby/et-force-login
 *
 **/

namespace ET_Force_Login;

class Force_Login {

	public function __construct() {

		require_once dirname( __FILE__ ) . "/inc/includes.php";

		//on activation of plugin
		register_activation_hook( __FILE__, array( $this, "activate" ) );

		//on deactivation of plugin
		register_deactivation_hook( __FILE__, array( $this, "deactivate" ) );

	}

	public function activate() {


	}

	public function deactivate() {


	}


}

new Force_Login();