<?php
/*
 *  Author: Markon 
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

function category_has_children($term_id)
{
    $children = get_term_children($term_id, "category");
    if (is_array($children)) {
        return $children;
    } else {
        return false;
    }
}

function silici()
{
    if (!is_admin()) {
        wp_deregister_script('wp-embed');
        wp_deregister_script('wp-polyfill');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('init', 'silici');
function css_silici()
{
    if (is_page_template('home.php')) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style');
    }
}
add_action('wp_enqueue_scripts', 'css_silici', 100);

function contactform()
{
    wp_dequeue_script('contact-form-7');
    wp_dequeue_style('contact-form-7');
}
add_action('wp_enqueue_scripts', 'contactform');


function diwp_menu_shortcode($attr)
{

    $args = shortcode_atts(array(

        'name'  => '',
        'class' => ''

    ), $attr);

    return wp_nav_menu(array(
        'menu'             => $args['name'],
        'menu_class'    => $args['class']
    ));
}
add_shortcode('addmenu', 'diwp_menu_shortcode');

// upload button 
add_action('admin_print_scripts', function () {
    // I'm using NOWDOC notation to allow line breaks and unescaped quotation marks.
    echo <<<'EOT'
<script type="text/javascript">
    jQuery(document).ready(function ($) {
  function media_upload(button_selector) {
    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;
    $('body').on('click', button_selector, function () {
      var button_id = $(this).attr('id');
      wp.media.editor.send.attachment = function (props, attachment) {
        if (_custom_media) {
          $('.' + button_id + '_img').attr('src', attachment.url);
          $('.' + button_id + '_url').val(attachment.url);
        } else {
          return _orig_send_attachment.apply($('#' + button_id), [props, attachment]);
        }
      }
      wp.media.editor.open($('#' + button_id));
      return false;
    });
  }
  media_upload('.js_custom_upload_media');

 
    $(".js_custom_upload_media").click(function(event){
      event.preventDefault();
      $(".widget-control-save").prop("disabled", false);
      $(".widget-control-save").val("Kaydet");
   });



});

</script>
EOT;
}, PHP_INT_MAX);


function example_theme_support()
{
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'example_theme_support');

//anasayfa slider widget

class Custom_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'custom_widget', // Base ID
            esc_html__('Anasayfa Card Yapısı', 'text_domain'), // Name
            array('description' => esc_html__('Anasayfa Card Yapısı', 'text_domain'),) // Args
        );
    }
    /**
     * Front-end display of the widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from the database.
     *
     * @see WP_Widget::widget()
     *
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget']; ?>
        <div class="fourth-section-card-wrap">
            <a href="<?php echo esc_url($instance['link']); ?>">
                <div class="fourth-section-card ">
                    <div class="fourth-section-ikon">
                        <img class="lazy" lodaing="lazy" src="<?php echo esc_url($instance['image_uri']); ?>" />
                    </div>
                    <h2 class="fourth-section-title">
                        <?php
                        if (!empty($instance['title'])) { ?>
                            <?php echo nl2br(esc_html($instance['title'])) ?>
                    </h2>
                    <div class="fourth-section-text harf-siniri">
                    <?php }
                        if (!empty($instance['text'])) { ?>
                        <p><?php echo nl2br(esc_html($instance['text'])) ?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php }
                        if (!empty($instance['link'])) { ?>

    <?php }
                        echo $args['after_widget'];
                    }
                    /**
                     * Back-end widget form.
                     *
                     * @param array $instance Previously saved values from the database.
                     *
                     * @see WP_Widget::form()
                     *
                     */
                    public function form($instance)
                    {
                        $image_uri = !empty($instance['image_uri']) ? $instance['image_uri'] : '';
                        $title = !empty($instance['title']) ? $instance['title'] : '';
                        $text = !empty($instance['text']) ? $instance['text'] : '';
                        $link = !empty($instance['link']) ? $instance['link'] : '';
                        $link_target = !empty($instance['link_target']) ? $instance['link_target'] : '_blank';
    ?>
    <p>
        <label for="<?= $this->get_field_id('image_uri'); ?>">Card İkon</label>
        <img class="<?= $this->id ?>_img lazy" src="<?= (!empty($instance['image_uri'])) ? $instance['image_uri'] : ''; ?>" />
        <input type="text" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name('image_uri'); ?>" value="<?= $instance['image_uri'] ?? ''; ?>" />
        <input type="button" id="<?= $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
    </p>
    <!-- Title -->
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
            Mini Başlık
        </label>
        <input placeholder="Başlık" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <!-- Text -->
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('text')); ?>">
            Mini Açıklama
        </label>

        <textarea type="text" rows="5" cols="20" class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>">
<?php echo esc_attr($text); ?>
</textarea>
    </p>
    <!-- Link URL -->
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('link')); ?>">
            Link (Boş kalacaksa # yazınız.)
        </label>
        <input class="widefat" placeholder="/ornek-sayfa-linki" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>">
    </p>

<?php
                    }
                    /**
                     * Sanitize widget form values as they are saved.
                     *
                     * @param array $new_instance Values just sent to be saved.
                     * @param array $old_instance Previously saved values from the database.
                     *
                     * @return array Updated safe values to be saved.
                     * @see WP_Widget::update()
                     *
                     */
                    public function update($new_instance, $old_instance)
                    {
                        $instance = array();
                        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
                        if (current_user_can('unfiltered_html')) {
                            $instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
                        } else {
                            $instance['text'] = (!empty($new_instance['text'])) ? sanitize_text_field($new_instance['text']) : '';
                        }
                        $instance['link'] = (!empty($new_instance['link'])) ? sanitize_text_field($new_instance['link']) : '';
                        $instance['link_target'] = (!empty($new_instance['link_target'])) ? sanitize_text_field($new_instance['link_target']) : '';
                        $instance['image_uri'] = (!empty($new_instance['image_uri'])) ? sanitize_text_field($new_instance['image_uri']) : '';
                        return $instance;
                    }
                } // class Custom_Widget
                // register Custom_Widget widget
                function register_custom_widget()
                {
                    register_widget('Custom_Widget');
                }
                add_action('widgets_init', 'register_custom_widget');
                // iç widget

                class Custom_Widgetd extends WP_Widget
                {

                    function __construct()
                    {
                        parent::__construct(
                            'custom_widgetd', // Base ID
                            esc_html__('Anasayfa Slider', 'text_domain'), // Name
                            array('description' => esc_html__('Anasayfa Slider', 'text_domain'),) // Args
                        );
                    }
                    /**
                     * Front-end display of the widget.
                     *
                     * @param array $args Widget arguments.
                     * @param array $instance Saved values from the database.
                     *
                     * @see WP_Widget::widget()
                     *
                     */
                    public function widget($args, $instance)
                    {
                        echo $args['before_widget']; ?>
    <li class="slide showing ">
        <img src="<?php echo esc_url($instance['image_uri']); ?>" />


    </li>





    <?php echo $args['after_widget']; ?><?php
                                    }
                                    /**
                                     * Back-end widget form.
                                     *
                                     * @param array $instance Previously saved values from the database.
                                     *
                                     * @see WP_Widget::form()
                                     *
                                     */
                                    public function form($instance)
                                    {
                                        $image_uri = !empty($instance['image_uri']) ? $instance['image_uri'] : '';
                                        $title = !empty($instance['title']) ? $instance['title'] : '';
                                        $title2 = !empty($instance['title2']) ? $instance['title2'] : '';
                                        $titleb = !empty($instance['titleb']) ? $instance['titleb'] : '';
                                        $text = !empty($instance['text']) ? $instance['text'] : '';
                                        $link = !empty($instance['link']) ? $instance['link'] : '';
                                        $link_target = !empty($instance['link_target']) ? $instance['link_target'] : '/ornek-sayfa-linki';
                                        ?>
    <p>
        <label for="<?= $this->get_field_id('image_uri'); ?>">Slider Resim</label>
        <img style="width:100%" class="<?= $this->id ?>_img lazy" src="<?= (!empty($instance['image_uri'])) ? $instance['image_uri'] : ''; ?>" />
        <input type="text" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name('image_uri'); ?>" value="<?= $instance['image_uri'] ?? ''; ?>" />
        <input type="button" id="<?= $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
    </p>

<?php
                                    }
                                    /**
                                     * Sanitize widget form values as they are saved.
                                     *
                                     * @param array $new_instance Values just sent to be saved.
                                     * @param array $old_instance Previously saved values from the database.
                                     *
                                     * @return array Updated safe values to be saved.
                                     * @see WP_Widget::update()
                                     *
                                     */
                                    public function update($new_instance, $old_instance)
                                    {
                                        $instance = array();
                                        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
                                        $instance['title2'] = (!empty($new_instance['title2'])) ? sanitize_text_field($new_instance['title2']) : '';
                                        $instance['titleb'] = (!empty($new_instance['titleb'])) ? sanitize_text_field($new_instance['titleb']) : '';
                                        if (current_user_can('unfiltered_html')) {
                                            $instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
                                        } else {
                                            $instance['text'] = (!empty($new_instance['text'])) ? sanitize_text_field($new_instance['text']) : '';
                                        }
                                        $instance['link'] = (!empty($new_instance['link'])) ? sanitize_text_field($new_instance['link']) : '';
                                        $instance['link_target'] = (!empty($new_instance['link_target'])) ? sanitize_text_field($new_instance['link_target']) : '';
                                        $instance['image_uri'] = (!empty($new_instance['image_uri'])) ? sanitize_text_field($new_instance['image_uri']) : '';
                                        return $instance;
                                    }
                                } // class Custom_Widget
                                // register Custom_Widget widget
                                function register_custom_widgetd()
                                {
                                    register_widget('Custom_Widgetd');
                                }
                                add_action('widgets_init', 'register_custom_widgetd');
                                // iç widget


                                //anasayfa slider widget

                                class Custom_Widgets extends WP_Widget
                                {

                                    function __construct()
                                    {
                                        parent::__construct(
                                            'custom_widgets', // Base ID
                                            esc_html__('Anasayfa Parallax Section', 'text_domain'), // Name
                                            array('description' => esc_html__('Anasayfa Parallax', 'text_domain'),) // Args
                                        );
                                    }
                                    /**
                                     * Front-end display of the widget.
                                     *
                                     * @param array $args Widget arguments.
                                     * @param array $instance Saved values from the database.
                                     *
                                     * @see WP_Widget::widget()
                                     *
                                     */
                                    public function widget($args, $instance)
                                    {
                                        echo $args['before_widget']; ?>
    <div class="parallax-section lazy" style="background-image:url('<?php echo esc_url($instance['image_uri']); ?>');">
        <div class="parallax-overlay"></div>
        <div class="parallax-inner">
            <div class="parallax-h2">
                <?php
                                        if (!empty($instance['title2'])) { ?>
                    <?php echo nl2br(esc_html($instance['title2'])) ?>
            </div>
            <div class="parallax-button">
                <a href="<?php echo esc_url($instance['link']); ?>">
                <?php }
                                        if (!empty($instance['titleb'])) { ?>
                    <?php echo nl2br(esc_html($instance['titleb'])) ?>
                </a>
            </div>
        </div>

    </div>

<?php }
                                        if (!empty($instance['link'])) { ?>

    <?php }
                                        echo $args['after_widget']; ?><?php
                                                                        }
                                                                        /**
                                                                         * Back-end widget form.
                                                                         *
                                                                         * @param array $instance Previously saved values from the database.
                                                                         *
                                                                         * @see WP_Widget::form()
                                                                         *
                                                                         */
                                                                        public function form($instance)
                                                                        {
                                                                            $image_uri = !empty($instance['image_uri']) ? $instance['image_uri'] : '';
                                                                            $title = !empty($instance['title']) ? $instance['title'] : '';
                                                                            $title2 = !empty($instance['title2']) ? $instance['title2'] : '';
                                                                            $titleb = !empty($instance['titleb']) ? $instance['titleb'] : '';
                                                                            $text = !empty($instance['text']) ? $instance['text'] : '';
                                                                            $link = !empty($instance['link']) ? $instance['link'] : '';
                                                                            $link_target = !empty($instance['link_target']) ? $instance['link_target'] : '/ornek-sayfa-linki';
                                                                            ?>
    <p>
        <label for="<?= $this->get_field_id('image_uri'); ?>">Section Arkaplan</label>
        <img style="width:100%" class="<?= $this->id ?>_img lazy" src="<?= (!empty($instance['image_uri'])) ? $instance['image_uri'] : ''; ?>" />
        <input type="text" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name('image_uri'); ?>" value="<?= $instance['image_uri'] ?? ''; ?>" />
        <input type="button" id="<?= $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
    </p>
    <!-- Title -->
    <!-- Title -->
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title2')); ?>">
            Ana Başlık
        </label>
        <input placeholder="Başlık" class="widefat" id="<?php echo esc_attr($this->get_field_id('title2')); ?>" name="<?php echo esc_attr($this->get_field_name('title2')); ?>" type="text" value="<?php echo esc_attr($title2); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title2')); ?>">
            Buton Başlık
        </label>
        <input placeholder="Başlık" class="widefat" id="<?php echo esc_attr($this->get_field_id('titleb')); ?>" name="<?php echo esc_attr($this->get_field_name('titleb')); ?>" type="text" value="<?php echo esc_attr($titleb); ?>">
    </p>
    <!-- Link URL -->
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('link')); ?>">
            Link (Boş kalacaksa # yazınız.)
        </label>
        <input class="widefat" placeholder="/ornek-sayfa-linki" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>">
    </p>
<?php
                                                                        }
                                                                        /**
                                                                         * Sanitize widget form values as they are saved.
                                                                         *
                                                                         * @param array $new_instance Values just sent to be saved.
                                                                         * @param array $old_instance Previously saved values from the database.
                                                                         *
                                                                         * @return array Updated safe values to be saved.
                                                                         * @see WP_Widget::update()
                                                                         *
                                                                         */
                                                                        public function update($new_instance, $old_instance)
                                                                        {
                                                                            $instance = array();
                                                                            $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
                                                                            $instance['title2'] = (!empty($new_instance['title2'])) ? sanitize_text_field($new_instance['title2']) : '';
                                                                            $instance['titleb'] = (!empty($new_instance['titleb'])) ? sanitize_text_field($new_instance['titleb']) : '';
                                                                            if (current_user_can('unfiltered_html')) {
                                                                                $instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
                                                                            } else {
                                                                                $instance['text'] = (!empty($new_instance['text'])) ? sanitize_text_field($new_instance['text']) : '';
                                                                            }
                                                                            $instance['link'] = (!empty($new_instance['link'])) ? sanitize_text_field($new_instance['link']) : '';
                                                                            $instance['link_target'] = (!empty($new_instance['link_target'])) ? sanitize_text_field($new_instance['link_target']) : '';
                                                                            $instance['image_uri'] = (!empty($new_instance['image_uri'])) ? sanitize_text_field($new_instance['image_uri']) : '';
                                                                            return $instance;
                                                                        }
                                                                    } // class Custom_Widget
                                                                    // register Custom_Widget widget
                                                                    function register_custom_widgets()
                                                                    {
                                                                        register_widget('Custom_Widgets');
                                                                    }
                                                                    add_action('widgets_init', 'register_custom_widgets');
                                                                    // iç widget

                                                                    //anasayfa slider widget


                                                                    if (!isset($content_width)) {
                                                                        $content_width = 900;
                                                                    }

                                                                    if (function_exists('add_theme_support')) {
                                                                        // Add Menu Support
                                                                        add_theme_support('menus');

                                                                        // Add Thumbnail Theme Support
                                                                        add_theme_support('post-thumbnails');
                                                                        add_image_size('large', 700, '', true); // Large Thumbnail
                                                                        add_image_size('medium', 250, '', true); // Medium Thumbnail
                                                                        add_image_size('small', 120, '', true); // Small Thumbnail
                                                                        add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

                                                                        // Add Support for Custom Backgrounds - Uncomment below if you're going to use
                                                                        /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

                                                                        // Add Support for Custom Header - Uncomment below if you're going to use
                                                                        /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

                                                                        // Enables post and comment RSS feed links to head
                                                                        add_theme_support('automatic-feed-links');

                                                                        // Localisation Support
                                                                        load_theme_textdomain('html5blank', get_template_directory() . '/languages');
                                                                    }

                                                                    /*------------------------------------*\
	Functions
\*------------------------------------*/

                                                                    // HTML5 Blank navigation
                                                                    function html5blank_nav()
                                                                    {
                                                                        wp_nav_menu(
                                                                            array(
                                                                                'theme_location'  => 'header-menu',
                                                                                'menu'            => '',
                                                                                'container'       => 'div',
                                                                                'container_class' => 'menu-{menu slug}-container',
                                                                                'container_id'    => '',
                                                                                'menu_class'      => 'menu',
                                                                                'menu_id'         => '',
                                                                                'echo'            => true,
                                                                                'fallback_cb'     => 'wp_page_menu',
                                                                                'before'          => '',
                                                                                'after'           => '',
                                                                                'link_before'     => '',
                                                                                'link_after'      => '',
                                                                                'items_wrap'      => '<ul>%3$s</ul>',
                                                                                'depth'           => 0,
                                                                                'walker'          => ''
                                                                            )
                                                                        );
                                                                    }

                                                                    // Load HTML5 Blank scripts (header.php)
                                                                    function html5blank_header_scripts()
                                                                    {
                                                                        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

                                                                            wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
                                                                            wp_enqueue_script('conditionizr'); // Enqueue it!

                                                                            wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
                                                                            wp_enqueue_script('modernizr'); // Enqueue it!

                                                                            wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
                                                                            wp_enqueue_script('html5blankscripts'); // Enqueue it!
                                                                        }
                                                                    }

                                                                    // Load HTML5 Blank conditional scripts
                                                                    function html5blank_conditional_scripts()
                                                                    {
                                                                        if (is_page('pagenamehere')) {
                                                                            wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
                                                                            wp_enqueue_script('scriptname'); // Enqueue it!
                                                                        }
                                                                    }

                                                                    // Load HTML5 Blank styles
                                                                    function html5blank_styles()
                                                                    {
                                                                        wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
                                                                        wp_enqueue_style('normalize'); // Enqueue it!

                                                                        wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
                                                                        wp_enqueue_style('html5blank'); // Enqueue it!
                                                                    }

                                                                    // Register HTML5 Blank Navigation
                                                                    function register_html5_menu()
                                                                    {
                                                                        register_nav_menus(array( // Using array to specify more menus if needed
                                                                            'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
                                                                            'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
                                                                            'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
                                                                        ));
                                                                    }

                                                                    // Remove the <div> surrounding the dynamic navigation to cleanup markup
                                                                    function my_wp_nav_menu_args($args = '')
                                                                    {
                                                                        $args['container'] = false;
                                                                        return $args;
                                                                    }

                                                                    // Remove Injected classes, ID's and Page ID's from Navigation <li> items
                                                                    function my_css_attributes_filter($var)
                                                                    {
                                                                        return is_array($var) ? array() : '';
                                                                    }

                                                                    // Remove invalid rel attribute values in the categorylist
                                                                    function remove_category_rel_from_category_list($thelist)
                                                                    {
                                                                        return str_replace('rel="category tag"', 'rel="tag"', $thelist);
                                                                    }

                                                                    // Add page slug to body class, love this - Credit: Starkers Wordpress Theme
                                                                    function add_slug_to_body_class($classes)
                                                                    {
                                                                        global $post;
                                                                        if (is_home()) {
                                                                            $key = array_search('blog', $classes);
                                                                            if ($key > -1) {
                                                                                unset($classes[$key]);
                                                                            }
                                                                        } elseif (is_page()) {
                                                                            $classes[] = sanitize_html_class($post->post_name);
                                                                        } elseif (is_singular()) {
                                                                            $classes[] = sanitize_html_class($post->post_name);
                                                                        }

                                                                        return $classes;
                                                                    }

                                                                    // If Dynamic Sidebar Exists
                                                                    if (function_exists('register_sidebar')) {
                                                                        // Define Sidebar Widget Area 1
                                                                        register_sidebar(array(
                                                                            'name' => __('Anasayfa Slider Bölümü', 'html5blank'),
                                                                            'description' => __('Anasayfa Slider', 'html5blank'),
                                                                            'id' => 'widget-area-1',
                                                                            'before_widget' => '<div id="%1$s" class="%2$s">',
                                                                            'after_widget' => '</div>',
                                                                            'before_title' => '<h3>',
                                                                            'after_title' => '</h3>'
                                                                        ));

                                                                        // Define Sidebar Widget Area 2
                                                                        register_sidebar(array(
                                                                            'name' => __('Anasayfa Parallax', 'html5blank'),
                                                                            'description' => __('Description for this widget-area...', 'html5blank'),
                                                                            'id' => 'widget-area-2',
                                                                            'before_widget' => '<div id="%1$s" class="%2$s">',
                                                                            'after_widget' => '</div>',
                                                                            'before_title' => '<h3>',
                                                                            'after_title' => '</h3>'
                                                                        ));
                                                                        register_sidebar(array(
                                                                            'name' => __('Anasayfa Card', 'html5blank'),
                                                                            'description' => __('Description for this widget-area...', 'html5blank'),
                                                                            'id' => 'anasayfa-card',
                                                                            'before_widget' => '<div id="%1$s" class="%2$s">',
                                                                            'after_widget' => '</div>',
                                                                            'before_title' => '<h3>',
                                                                            'after_title' => '</h3>'
                                                                        ));
                                                                    }

                                                                    // Remove wp_head() injected Recent Comment styles
                                                                    function my_remove_recent_comments_style()
                                                                    {
                                                                        global $wp_widget_factory;
                                                                        remove_action('wp_head', array(
                                                                            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
                                                                            'recent_comments_style'
                                                                        ));
                                                                    }

                                                                    // Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
                                                                    function html5wp_pagination()
                                                                    {
                                                                        global $wp_query;
                                                                        $big = 999999999;
                                                                        echo paginate_links(array(
                                                                            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                                                                            'format' => '?paged=%#%',
                                                                            'current' => max(1, get_query_var('paged')),
                                                                            'total' => $wp_query->max_num_pages
                                                                        ));
                                                                    }

                                                                    // Custom Excerpts
                                                                    function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
                                                                    {
                                                                        return 20;
                                                                    }

                                                                    // Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
                                                                    function html5wp_custom_post($length)
                                                                    {
                                                                        return 40;
                                                                    }

                                                                    // Create the Custom Excerpts callback
                                                                    function html5wp_excerpt($length_callback = '', $more_callback = '')
                                                                    {
                                                                        global $post;
                                                                        if (function_exists($length_callback)) {
                                                                            add_filter('excerpt_length', $length_callback);
                                                                        }
                                                                        if (function_exists($more_callback)) {
                                                                            add_filter('excerpt_more', $more_callback);
                                                                        }
                                                                        $output = get_the_excerpt();
                                                                        $output = apply_filters('wptexturize', $output);
                                                                        $output = apply_filters('convert_chars', $output);
                                                                        $output = '<p>' . $output . '</p>';
                                                                        echo $output;
                                                                    }

                                                                    // Custom View Article link to Post
                                                                    function html5_blank_view_article($more)
                                                                    {
                                                                        global $post;
                                                                        return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
                                                                    }

                                                                    // Remove Admin bar
                                                                    function remove_admin_bar()
                                                                    {
                                                                        return false;
                                                                    }

                                                                    // Remove 'text/css' from our enqueued stylesheet
                                                                    function html5_style_remove($tag)
                                                                    {
                                                                        return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
                                                                    }

                                                                    // Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
                                                                    function remove_thumbnail_dimensions($html)
                                                                    {
                                                                        $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
                                                                        return $html;
                                                                    }

                                                                    // Custom Gravatar in Settings > Discussion
                                                                    function html5blankgravatar($avatar_defaults)
                                                                    {
                                                                        $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
                                                                        $avatar_defaults[$myavatar] = "Custom Gravatar";
                                                                        return $avatar_defaults;
                                                                    }

                                                                    // Threaded Comments
                                                                    function enable_threaded_comments()
                                                                    {
                                                                        if (!is_admin()) {
                                                                            if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
                                                                                wp_enqueue_script('comment-reply');
                                                                            }
                                                                        }
                                                                    }

                                                                    // Custom Comments Callback
                                                                    function html5blankcomments($comment, $args, $depth)
                                                                    {
                                                                        $GLOBALS['comment'] = $comment;
                                                                        extract($args, EXTR_SKIP);

                                                                        if ('div' == $args['style']) {
                                                                            $tag = 'div';
                                                                            $add_below = 'comment';
                                                                        } else {
                                                                            $tag = 'li';
                                                                            $add_below = 'div-comment';
                                                                        }
?>
<!-- heads up: starting < for the html tag (li or div) in the next line: -->
<<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['180']); ?>
            <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
                <?php
                                                                        printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
                                                                                                                                                    ?>
        </div>

        <?php comment_text() ?>

        <div class="reply">
            <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
<?php }

                                                                    /*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

                                                                    // Add Actions
                                                                    add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
                                                                    add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
                                                                    add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
                                                                    add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
                                                                    add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
                                                                    add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
                                                                    add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
                                                                    add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

                                                                    // Remove Actions
                                                                    remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
                                                                    remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
                                                                    remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
                                                                    remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
                                                                    remove_action('wp_head', 'index_rel_link'); // Index link
                                                                    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
                                                                    remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
                                                                    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
                                                                    remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
                                                                    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
                                                                    remove_action('wp_head', 'rel_canonical');
                                                                    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

                                                                    // Add Filters
                                                                    add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
                                                                    add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
                                                                    add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
                                                                    add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
                                                                    add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
                                                                    // add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
                                                                    // add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
                                                                    // add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
                                                                    add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
                                                                    add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
                                                                    add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
                                                                    add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
                                                                    add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
                                                                    add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
                                                                    add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
                                                                    add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

                                                                    // Remove Filters
                                                                    remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

                                                                    // Shortcodes
                                                                    add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
                                                                    add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

                                                                    // Shortcodes above would be nested like this -
                                                                    // [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

                                                                    /*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

                                                                    // Create 1 Custom Post type for a Demo, called HTML5-Blank
                                                                    function create_post_type_html5()
                                                                    {
                                                                        register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
                                                                        register_taxonomy_for_object_type('post_tag', 'html5-blank');
                                                                        register_post_type(
                                                                            'html5-blank', // Register Custom Post Type
                                                                            array(
                                                                                'labels' => array(
                                                                                    'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
                                                                                    'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'add_new' => __('Add New', 'html5blank'),
                                                                                    'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'edit' => __('Edit', 'html5blank'),
                                                                                    'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
                                                                                    'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
                                                                                    'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
                                                                                ),
                                                                                'public' => true,
                                                                                'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
                                                                                'has_archive' => true,
                                                                                'supports' => array(
                                                                                    'title',
                                                                                    'editor',
                                                                                    'excerpt',
                                                                                    'thumbnail'
                                                                                ), // Go to Dashboard Custom HTML5 Blank post for supports
                                                                                'can_export' => true, // Allows export in Tools > Export
                                                                                'taxonomies' => array(
                                                                                    'post_tag',
                                                                                    'category'
                                                                                ) // Add Category and Post Tags support
                                                                            )
                                                                        );
                                                                    }

                                                                    /*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

                                                                    // Shortcode Demo with Nested Capability
                                                                    function html5_shortcode_demo($atts, $content = null)
                                                                    {
                                                                        return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
                                                                    }

                                                                    // Shortcode Demo with simple <h2> tag
                                                                    function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
                                                                    {
                                                                        return '<h2>' . $content . '</h2>';
                                                                    }

?>