<?php
<?php
/*
Plugin Name: RJ Contact Form
Description: A free WordPress plugin that allows you to seamlessly add customizable contact forms to your website without watermark.
Version: 1.0
Author: Ravi Jakhar
Author URI:https://www.linkedin.com/in/ravi-jat
Plugin URI:https://bit.ly/Ravi-Jakhar-7
License:GPL v2 or later
License URI:https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 5.2
Requires PHP:7.2
Text Domain:rj-contact-form
Icon: /assets/icon.png
Banner: /assets/banner.png
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Include additional files
include_once(plugin_dir_path(__FILE__) . 'set.php');
include_once(plugin_dir_path(__FILE__) . 'form.php');
include_once(plugin_dir_path(__FILE__) . 'data.php');

// Activation hook
register_activation_hook(__FILE__, 'ravi_contact_activation');

// Function to run on activation
function ravi_contact_activation() {
    global $wpdb;

        // Define table name
            $table_name = $wpdb->prefix . 'ravi_plug';

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
                                                                      wp_enqueue_script('ravi-ajax-script', plugin_dir_url(__FILE__) . 'ravi-ajax-script.js', array('wp-ajax-response'), null, true);

// Enqueue style.css for styling the form
function ravi_enqueue_styles() {
    wp_enqueue_style('ravi-contact-style', plugin_dir_url(__FILE__) . 'style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'ravi_enqueue_styles');
        
