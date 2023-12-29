<?php
// rj-data.php

// Function to add menu item in WordPress admin
function rj_add_admin_menu() {
    add_menu_page(
        'RJ-Plug',
        'RJ-Plug',
        'manage_options',
        'rj_plugin_data',
        'rj_display_data_page',
        'dashicons-email', // Use appropriate dashicon for the contact icon
        30 // Set a priority for the menu item
    );
}

// Hook to add admin menu
add_action('admin_menu', 'rj_add_admin_menu');

// Function to display data page in WordPress admin
function rj_display_data_page() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">RJ-Plug Data</h1>
        <?php rj_display_data_table(); ?>
    </div>
    <?php
}

// Function to display data table
function rj_display_data_table() {
    global $wpdb;

    // Fetch data from the table (sorted by static id in descending order)
    $table_name = $wpdb->prefix . 'rj_plug';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC", ARRAY_A);

    if (!empty($results)) {
        echo '<table class="widefat striped">';
        echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Mobile</th><th>Description</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . esc_html($row['id']) . '</td>';
            echo '<td>' . esc_html($row['name']) . '</td>';
            echo '<td>' . esc_html($row['email']) . '</td>';
            echo '<td>' . esc_html($row['mobile']) . '</td>';
            echo '<td>' . esc_html($row['description']) . '</td>';
            echo '<td><a href="?page=rj_plugin_data&action=delete&id=' . esc_attr($row['id']) . '">Delete</a></td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No data available.</p>';
    }

    // Check if delete action is triggered
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id_to_delete = intval($_GET['id']);

        // Delete the row from the database
        $wpdb->delete($table_name, array('id' => $id_to_delete));

        // Redirect to refresh the page after deletion
        wp_redirect(admin_url('admin.php?page=rj_plugin_data'));
        exit();
    }
}
?>

