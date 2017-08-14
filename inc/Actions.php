<?php

namespace ET_Force_Login;

class Actions {

	public function __construct() {
		add_action( 'init', array( $this, 'force_user_to_be_logged_in' ) );
		add_filter( 'login_redirect', array( $this, 'login_redirect' ), 10, 3 );
	}

	public function force_user_to_be_logged_in() {

		if ( is_admin() || ( strpos( $_SERVER['REQUEST_URI'], 'wp-cron.php?doing_wp_cron' ) !== false ) ) {
			return;
		}


		//only logged in users can see the site
		if ( ! is_user_logged_in() && ( strpos( $_SERVER['PHP_SELF'], 'wp-login.php' ) === false && strpos( $_SERVER['PHP_SELF'], 'wp-register.php' ) === false ) ) {
			$site_url      = site_url( '/' );
			$requested_url = ( ! empty( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			//added for ManageWP - it was complaining about the redirect on the home page
			if ( $requested_url == $site_url ) {
				add_action( 'wp_loaded', function () {
					require_once ABSPATH . 'wp-login.php';
					die();
				} );
			} else {
				wp_safe_redirect( site_url( 'wp-login.php' ) );
				die();
			}
		}
	}

	/**
	 * Redirect user after successful login.
	 *
	 * @param string $redirect_to URL to redirect to.
	 * @param string $request URL the user is coming from.
	 * @param object $user Logged user's data.
	 *
	 * @return string
	 */

	public function login_redirect( $redirect_to, $request, $user ) {
		//is there a user to check?
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			//check for admins
			if ( in_array( 'administrator', $user->roles ) ) {
				// redirect them to the default place
				return $redirect_to;
			} else if ( ! empty( $request ) ) {
				return $request;
			} else {
				return home_url();
			}
		} else {
			return home_url();
		}
	}

}

new Actions();
