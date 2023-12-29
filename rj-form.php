<?php
// rj-form.php

// Function to render the contact form
function rj_contact_form() {
    ob_start(); ?>

    <form id="rj-contact-form" action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="mobile">Mobile:</label>
        <input type="tel" name="mobile" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <input type="submit" value="Submit">
    </form>

    <?php
    return ob_get_clean();
}

// Shortcode to display the contact form
function rj_contact_form_shortcode() {
    ob_start();
    echo rj_contact_form();
    return ob_get_clean();
}

// Hook the shortcode
add_shortcode('rj_contact_form', 'rj_contact_form_shortcode');

// Function to handle form submissions
function rj_handle_form_submission() {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"], $_POST["email"], $_POST["mobile"], $_POST["description"])) {
        global $wpdb;

        // Sanitize input data
        $name = sanitize_text_field($_POST["name"]);
        $email = sanitize_email($_POST["email"]);
        $mobile = sanitize_text_field($_POST["mobile"]);
        $description = sanitize_textarea_field($_POST["description"]);

        // Insert data into the table
        $table_name = $wpdb->prefix . 'rj_plug';
        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'description' => $description,
            )
        );

        // Redirect with success message
        $redirect_url = add_query_arg('rj_form_success', '1', $_SERVER['HTTP_REFERER']);
        wp_redirect($redirect_url);
        exit();
    }
}

// Function to display success message
function rj_display_success_message() {
    if (isset($_GET['rj_form_success']) && $_GET['rj_form_success'] === '1') {
        echo '<p class="rj-success-message">Form submitted successfully!</p>';
    }
}

// Hook the form submission handler
add_action('init', 'rj_handle_form_submission');

// Hook to display success message
add_action('wp_footer', 'rj_display_success_message');

?>
