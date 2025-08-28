<?php

/*** Child Theme Function  ***/

function backpacktraveler_mikado_child_theme_enqueue_scripts()
{

    $parent_style = 'backpacktraveler-mikado-default-style';

    wp_enqueue_style('backpacktraveler-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action('wp_enqueue_scripts', 'backpacktraveler_mikado_child_theme_enqueue_scripts');
function modify_read_more_link()
{
    return '<a class="more-link" href="' . get_permalink() . '">Plus d infos</a>';
}

add_filter('the_content_more_link', 'modify_read_more_link');

//Google Analytics Code
add_action('wp_head', 'add_google_analytics');
function add_google_analytics()
{
?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156540950-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-156540950-1');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TK5FBNWR6J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-TK5FBNWR6J');
    </script>

<?php } ?>
<?php

/*Disable Youtube Embed Plugs Plugin in home page*/
$is_home_page = ($_SERVER['REQUEST_URI'] === "/");

if ($is_home_page && !is_admin()) {
    add_filter('option_active_plugins', 'disable_plugins');
}


function disable_plugins($plugins)
{

    //De Register JS File of Youtube Embed Plus in home Page
    // Disable Youtube Embed Plugs Plugin in home page
    $is_home_page = ($_SERVER['REQUEST_URI'] === "/");

    if ($is_home_page && !is_admin()) {
        wp_dequeue_script('__ytprefsfitvids__');
        wp_dequeue_script('__jquery_cookie__');
        wp_dequeue_script('__ytprefs__');
        wp_dequeue_script('wp_insert_vi_gdpr_js');


        $key = array_search('youtube-embed-plus/youtube.php', $plugins); //Plugin path within /wp-content/plugins/
        if (false !== $key) unset($plugins[$key]);
        return $plugins;
    }
}


/* Jquery Calendar Integration with Contact Form 7 */
add_action('wp_enqueue_scripts', 'add_jquery_calendar_cf7');

function add_jquery_calendar_cf7()
{
    global $post;

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'contact-form-7')) {

        // Load WP built-in jQuery UI Datepicker (no need for external link)
        wp_enqueue_script('jquery-ui-datepicker');

        // Load jQuery UI CSS for styling
        wp_enqueue_style(
            'jquery-ui-css',
            'https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css'
        );

        // Load your custom script
        wp_enqueue_script(
            'custom-js-jquery-calendar',
            get_stylesheet_directory_uri() . '/custom.js',
            array('jquery', 'jquery-ui-datepicker'),
            null,
            true
        );
    }
}

/*Trust Pilot*/
add_action('wp_head', function () {
    echo '<meta name="trustpilot-one-time-domain-verification-id" content="5f9294c5-561a-4da1-b06f-0b1e22caf8dd"/>';
}, '-1000');


/*Disable Testimonial Single Page View  */
/*Redirect Single Testimonial Page To Home Page */

if (is_plugin_active('testimonial-rotator/testimonial-rotator.php')) {

    add_action('template_redirect', 'single_testimonial_redirect');

    function single_testimonial_redirect()
    {
        $queried_post_type = get_post_type();

        if (is_single() && 'testimonial' == $queried_post_type) {
            wp_redirect(home_url(), 301);
            exit;
        }
    }
}

add_filter('wpcf7_form_autocomplete', function ($autocomplete) {
    $autocomplete = 'off';
    return $autocomplete;
}, 10, 1);



function my_enqueue_monthpicker_assets()
{
    // WP’s own jQuery + jQuery UI pieces
    wp_enqueue_script('jquery-ui-button');
    wp_enqueue_script('jquery-ui-datepicker');


    // MonthPicker 3.0.4
    wp_enqueue_style(
        'monthpicker-css',
        'https://cdn.jsdelivr.net/npm/jquery-ui-month-picker@3.0.4/src/MonthPicker.min.css',
        [],
        '3.0.4'
    );
    wp_enqueue_script(
        'monthpicker-js',
        'https://cdn.jsdelivr.net/npm/jquery-ui-month-picker@3.0.4/src/MonthPicker.min.js',
        ['jquery', 'jquery-ui-core', 'jquery-ui-button', 'jquery-ui-datepicker'],
        '3.0.4',
        true
    );

    // Your initializer
    wp_enqueue_script(
        'monthpicker-init',
        get_stylesheet_directory_uri() . '/js/monthpicker-init.js',
        ['monthpicker-js'],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'my_enqueue_monthpicker_assets');
