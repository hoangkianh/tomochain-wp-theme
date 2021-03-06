<?php
/**
 * Shortcode attributes
 *
 * @var $loop
 * @var $auto_play
 * @var $auto_play_speed
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_TomoChain_Blog
 */
wp_enqueue_script( 'slick-carousel' );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = array(
    'tomochain-shortcode',
    'tomochain-blog',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
    implode( ' ', $css_class ),
    $this->settings['base'],
    $atts );

$posts = get_posts(
    array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page
    )
);

?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
    <div class="blog-carousel" data-atts="<?php echo esc_attr( json_encode( $atts ) ); ?>">
        <?php foreach($posts as $post):
            $custom_url = get_field('custom_url', $post);
            $open_new_tab = get_field('open_in_new_tab', $post) ? '__blank' : '';
            ?>
            <div class="col-sm-6 col-lg-3 tomochain-blog-item">
                <div class="blog-thumbnail">
                    <a href="<?php echo $custom_url ? esc_url($custom_url) : get_permalink($post); ?>" target="<?php echo esc_attr($open_new_tab); ?>">
                        <?php
                        if (get_field('image', $post)) {
                            echo wp_get_attachment_image(get_field('image', $post), 'tomo-post-small-thumbnail');
                        }elseif(has_post_thumbnail($post)) {
                            echo get_the_post_thumbnail($post, 'tomo-post-small-thumbnail');
                        }else{
                            $img_url = get_template_directory_uri() . '/assets/images/image-shortcode.jpg';
                        ?>
                            <img src="<?php echo esc_url($img_url);?>" alt="<?php echo esc_attr(get_the_title());?>">
                        <?php }?>
                    </a>
                    <div class="blog-date">
                        <?php
                            echo get_the_date(get_option('date_format'));
                        ?>
                    </div>
                </div>
                <div class="blog-info">
                    <h4 class="blog-title text-truncate">
                        <a href="<?php echo $custom_url ? esc_url($custom_url) : get_permalink($post); ?>" target="<?php echo esc_attr($open_new_tab); ?>">
                            <?php echo get_the_title($post); ?>
                        </a>
                    </h4>
                    <?php if($excerpt) : 
                        $excerpt = $post->post_content;
                        if($excerpt_length && !empty($excerpt)){
                            $excerpt = wp_trim_words( $excerpt, $excerpt_length );
                            $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
                        }
                    ?>
                        <p class="excerpt"><?php echo esc_html($excerpt); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="see-all-blog">
                <a href="<?php echo esc_url(get_permalink(get_option( 'page_for_posts' )))?>"><?php esc_html_e('See all our news', 'tomochain-addons'); ?></a>
            </p>
        </div>
    </div>
</div>
