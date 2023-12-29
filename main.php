<?php
/*
Plugin Name: RJ-Contact Plugin 
Description: Enhance your website with one click contact form plugin free forever 
Version: 1.3.0
Author: Ravi Jakhar
Author URI: https://bit.ly/Ravi-Jakhar-7
*/
// Include additional files
 include_once(plugin_dir_path(__FILE__) . 'rj-set.php');
include_once(plugin_dir_path(__FILE__) . 'rj-form.php');
include_once(plugin_dir_path(__FILE__) . 'rj-data.php');
include_once(plugin_dir_path(__FILE__) . 'rj-style.php');

 
// Activation hook
register_activation_hook(__FILE__, 'rj_plugin_activation');

// Function to run on activation
function rj_plugin_activation() {
    global $wpdb;

    // Define table name
    $table_name = $wpdb->prefix . 'rj_plug';

    // SQL query to create table
    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        mobile VARCHAR(15) NOT NULL,
        description TEXT,
        PRIMARY KEY (id)
    )";

    // Include WordPress upgrade functions
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // Execute the query
    dbDelta($sql);
}
?>

