<?php
/*
File Name: ravi-data.php
Description: Display and manage form data in WordPress admin with AJAX.
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Add admin menu
add_action('admin_menu', 'add_admin_menu');

function add_admin_menu() {
    add_menu_page(
    'Ravi Plug',
    '<span style="color:#ff8c00;font-weight:bold;">RJ-Contact</span>',
    'manage_options', 
    'ravi-data-page',
    'display_data_page',
    'dashicons-email',  
    20 
);

    // Enqueue JavaScript for AJAX
    add_action('admin_enqueue_scripts', 'enqueue_ajax_script');
}

// Enqueue JavaScript for AJAX
function enqueue_ajax_script() {
    wp_enqueue_script('ravi-ajax-script', plugin_dir_url(__FILE__) . 'ravi-ajax-script.js', array('wp-ajax-response'), null, true);

    // Pass the URL to the script
    wp_localize_script('ravi-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

// Display data page
function display_data_page() {
    echo '<div class="wrap">';
    echo '<p>
                To add the RJ-Contact Form to your post or page, you can use the shortcode: <br/><h2><code style="color:green;">[ravi_contact_form]</code></h2> 
                                        Simply place this shortcode in the content area of your post or page where you want the contact form to appear.</p><h2>Form Data</h2>';
    display_data_table();
    echo '</div>';
}

// Display data table
function display_data_table() {
    global $wpdb;

    // Define table name
    $table_name = $wpdb->prefix . 'ravi_plug';

    // Fetch data from the table
    $data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");

    // Display data in an HTML table
    echo '<table class="widefat">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Mobile</th><th>Description</th><th>Action</th></tr></thead>';
    echo '<tbody>';

    foreach ($data as $entry) {
        echo '<tr>';
        echo '<td>' . $entry->id . '</td>';
        echo '<td>' . esc_html($entry->name) . '</td>';
        echo '<td>' . esc_html($entry->email) . '</td>';
        echo '<td>' . esc_html($entry->mobile) . '</td>';
        echo '<td>' . esc_html($entry->description) . '</td>';
        echo '<td><a href="#" class="delete-link" style="color:red;" data-id="' . $entry->id . '">Delete</a></td>';
        echo '</tr>';
    }

    echo '</tbody></table>';

    // Enqueue JavaScript for AJAX delete
    echo '<script src="' . plugin_dir_url(__FILE__) . 'ravi-ajax-script.js"></script>';
}

// AJAX handler for delete
add_action('wp_ajax_ravi_delete_entry', 'delete_entry');

function delete_entry() {
    if (isset($_POST['entry_id'])) {
        global $wpdb;

        // Define table name
        $table_name = $wpdb->prefix . 'ravi_plug';

        // Delete entry from the table
        $wpdb->delete($table_name, array('id' => $_POST['entry_id']));

        wp_die(); // Required for AJAX to work properly
    }
}

?>
