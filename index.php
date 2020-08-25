<?php
/**
 * @package Post_Listing_map
 * @version 1.0.0
 */
/*
Plugin Name: Post Listing Map
Plugin URI: http://github.com
Description: List Post on map with MapBox and Google.
Author: Tom Hikari
Version: 1.0.0
Author URI: http://github.com/hktom
*/

include plugin_dir_path( __FILE__ ) . 'public/mapboxGL.php';
include plugin_dir_path( __FILE__ ) . 'public/listPost.php';
//add_action("admin_menu", "addMenu");



//mapBox();

//display mapbox
function render(){
    listPost();
    mapBox();
}   
add_shortcode("listing-post-map", "render");