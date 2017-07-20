<?php

$plugin_prefix               = 'etfl_';
$plugin_prefix_for_constants = strtoupper( $plugin_prefix );

$plugin_abs_path          = plugin_dir_path( dirname( __FILE__ ) );
$plugin_directory_name    = basename( $plugin_abs_path );
$plugin_url               = plugins_url( $plugin_directory_name . '/' );
$plugin_prefix_const_name = strtoupper( str_replace( '-', '_', $plugin_directory_name ) . '_prefix' );

define( $plugin_prefix_const_name, $plugin_prefix );
define( $plugin_prefix_for_constants . 'ABS_PATH', $plugin_abs_path );
define( $plugin_prefix_for_constants . 'URL', $plugin_url );