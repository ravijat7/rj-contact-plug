<?php
// rj-style.php

// Function to add submenu item in WordPress admin
function rj_add_style_submenu() {
    add_submenu_page(
            'themes.php', // Parent menu slug
                    'RJ-Style', // Page title
                            'RJ-Style', // Menu title
                                    'manage_options', // Capability
                                            'rj_style_settings', // Menu slug
                                                    'rj_display_style_page' // Function to display the page content
                                                        );
                                                        }

                                                        // Hook to add submenu
                                                        add_action('admin_menu', 'rj_add_style_submenu');

                                                        // Function to display the style page
                                                        function rj_display_style_page() {
                                                            ?>
                                                                <div class="wrap">
                                                                        <h1 class="wp-heading-inline">RJ-Style</h1>
                                                                                <form method="post" action="">
                                                                                            <label for="rj_css_code">CSS Code:</label>
                                                                                                        <textarea id="rj_css_code" name="rj_css_code"  value="#rj-contact-form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#rj-contact-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

#rj-contact-form input[type="text"],
#rj-contact-form input[type="email"],
#rj-contact-form input[type="tel"],
#rj-contact-form textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#rj-contact-form textarea {
    resize: vertical; /* Allow vertical resizing of textarea */
}

#rj-contact-form input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

#rj-contact-form input[type="submit"]:hover {
    background-color: #45a049;
}
" rows="8" cols="50"><?php echo esc_textarea(get_option('rj_css_code', '')); ?></textarea>

                                                                                                                    <p><input type="submit" name="save_changes" class="button button-primary" value="Save Changes"></p>
                                                                                                                            </form>
                                                                                                                                </div>
                                                                                                                                    <?php
                                                                                                                                    }

                                                                                                                                    // Handle form submission
                                                                                                                                    if (isset($_POST['save_changes'])) {
                                                                                                                                        $css_code = sanitize_text_field($_POST['rj_css_code']);
                                                                                                                                            update_option('rj_css_code', $css_code);
                                                                                                                                            }

                                                                                                                                            // Enqueue the saved CSS code in the header
                                                                                                                                            function rj_enqueue_custom_css() {
                                                                                                                                                $css_code = get_option('rj_css_code', '');
                                                                                                                                                    if (!empty($css_code)) {
                                                                                                                                                            echo '<style type="text/css">' . $css_code . '</style>';
                                                                                                                                                                }
                                                                                                                                                                }
                                                                                                                                                                add_action('wp_head', 'rj_enqueue_custom_css');
                                                                                                                                                                ?>
                                                                                       
