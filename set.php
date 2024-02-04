<?php
/*
File Name: ravi-style.php
Description: CSS styling for the contact form with a code editor in WordPress admin.
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Add admin menu for style settings
add_action('admin_menu', 'ravi_style_menu');

function ravi_style_menu() {
    add_theme_page('ravi Style', 'ravi Style', 'manage_options', 'ravi_style_settings', 'ravi_style_settings_page');
}

// Settings page content
function ravi_style_settings_page() {
    $css_file_path = plugin_dir_path(__FILE__) . 'style.css';
    $css_code = file_get_contents($css_file_path); // Get CSS code from style.css

    // Handle form submission
    if (isset($_POST['save_changes'])) {
        $new_css_code = sanitize_textarea_field($_POST['css_code']); // Sanitize and get the new CSS code
        file_put_contents($css_file_path, $new_css_code); // Save the new CSS code to style.css
    }
    ?>
    <div class="wrap">
        <h2>ravi Style Settings</h2>
        <form method="post" action="">
            <label for="css_code">CSS Code:</label>
            <textarea id="css_code" name="css_code" rows="10" style="width: 100%;"><?php echo esc_textarea($css_code); ?></textarea>
            <p><em>Edit the CSS code for styling the contact form.</em></p> <p style="color:red;"><em>This CSS code will be applied to the contact form on the frontend.<b>Copy css for future mistake ;)</b></em></p>
            
            <input type="submit" class="button-primary" name="save_changes" value="Save Changes">
        </form>
    </div>
    <?php
}
?>
