<?php
/*
File Name: ravi-form.php
Description: Create a contact form and handle form submission.
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Shortcode to display the contact form
add_shortcode('ravi_contact_form', 'ravi_contact_form_shortcode');

function ravi_contact_form_shortcode() {
    ob_start();
    ravi_display_success_message(); // Display success message if form is submitted

    echo '
    <form id="ravi-contact-form" action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="input" required>

        <label for="email">Email:</label>
        <input id="input" type="email" name="email" required>

        <label for="mobile">Mobile:</label>
        <input type="tel" name="mobile" id="input" required>

        <label for="description">Description:</label>
        <textarea id="input" name="description" required></textarea>

        <input id="btn" type="submit" value="Submit">
    </form>';
    
    return ob_get_clean();
}

// Handle form submission
add_action('init', 'ravi_handle_form_submission');

function ravi_handle_form_submission() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['mobile'], $_POST['description'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $mobile = sanitize_text_field($_POST['mobile']);
        $description = sanitize_textarea_field($_POST['description']);

        global $wpdb;

        // Define table name
        $table_name = $wpdb->prefix . 'ravi_plug';

        // Insert form data into the table
        $wpdb->insert($table_name, array(
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'description' => $description,
        ));

        // Redirect to the same page with a success parameter
        $redirect_url = add_query_arg('ravi_form_success', '1', $_SERVER['HTTP_REFERER']);
        wp_redirect($redirect_url);
        exit;
    }
}

// Display success message if form is submitted
function ravi_display_success_message() {
    if (isset($_GET['ravi_form_success']) && $_GET['ravi_form_success'] === '1') {
        echo '<p class="success-message">Form submitted successfully!</p>';
    }
}

?>