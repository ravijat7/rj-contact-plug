<?php
// rj-style.php

// Function to add menu item in WordPress admin
function rj_style_menu() {
    add_theme_page(
        'RJ-Style',
        'RJ-Style',
        'manage_options',
        'rj_style_settings',
        'rj_style_settings_page'
    );
}

// Hook to add admin menu
add_action('admin_menu', 'rj_style_menu');

// Function to display style settings page in WordPress admin
function rj_style_settings_page() {
    if (isset($_POST['save_changes'])) {
        // Save the CSS code to the options table
        $css_code = sanitize_textarea_field($_POST['css_code']);
        update_option('rj_custom_css_code', $css_code);
    }

    // Retrieve the saved CSS code
    $default_css_code = "#rj-contact-form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        		box-shadow: 0 0 115px 1px black;
    }

    #rj-contact-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }
    #rj-contact-form label:hover {
        display: block;
        margin-bottom: 8px;
        font-weight: bolder;
        color: red;
    }
     

    #rj-contact-form #rj-input , 
    #rj-contact-form textarea {
        		width: 100%;
		padding: 8px;
		margin-bottom: 16px;
		border:none;
		outline:none;
		border-bottom: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
    }
    #rj-contact-form #rj-input:hover , 
    #rj-contact-form textarea:hover {
        		width: 100%;
		padding: 8px;
		margin-bottom: 16px;
		border:none;
		outline:none;
		border-bottom: 2px solid red;
		border-radius: 4px;
		box-sizing: border-box;
    }

    #rj-contact-form textarea {
        resize: vertical;
    }

    #rj-contact-form #rj-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight:bolder;
    }

    #rj-contact-form #rj-btn:hover {
        background-color: #000000;
    }";

    $saved_css_code = get_option('rj_custom_css_code', $default_css_code);
    ?>
    <div class="wrap">
        <p>
                To add the RJ-Contact Form to your post or page, you can use the shortcode: <br/><h2><code style="color:blue;">[rj_contact_form]</code></h2> 
                            Simply place this shortcode in the content area of your post or page where you want the contact form to appear. </p>
                                                            <h1 class="wp-heading-inline">RJ-Style Settings</h1>

        <form method="post">
            <label for="css_code">Custom CSS Code:</label>
            <textarea name="css_code" rows="10" style="width: 100%;"><?php echo esc_textarea($saved_css_code); ?></textarea>

            <p style="color:red;"><em>This CSS code will be applied to the contact form on the frontend.<b>Copy css for future mistake ;)</b></em></p>

            <p class="submit">
                <input type="submit" name="save_changes" id="submit" class="button button-primary" value="Save Changes">
            </p>
        </form>
    </div>
    <?php
}

// Enqueue the custom CSS code to style the contact form
function rj_enqueue_custom_css() {
    $css_code = get_option('rj_custom_css_code', '');
    echo '<style>' . $css_code . '</style>';
}

// Hook to enqueue custom CSS
add_action('wp_head', 'rj_enqueue_custom_css');
?>
            