<?php
/**
 * Event Achive page
 */
get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="event-content-tomo">
                <?php do_action('tomochain_heading');?>
                <div class="container">
                    <?php
                    $event_filter = get_field('event_filter','options');
                    if($event_filter)
                        tomochain_category_filter('event');
                    ?>
                    <div class="tomo-main-archive">
                        <div class="spinner">
                            <div class="rect1"></div>
                            <div class="rect2"></div>
                            <div class="rect3"></div>
                            <div class="rect4"></div>
                            <div class="rect5"></div>
                        </div>
                        <div class="archive-posts">
                            <div class="row">
                                <?php
                                if ( have_posts() ) :
                                    /* Start the Loop */
                                    while ( have_posts() ) :
                                        the_post();
                                        tomochain_get_template( 'content-event.php' );
                                    endwhile;
                                else :
                                    tomochain_get_template( 'no-events-found.php' );
                                endif;
                            ?>
                            </div>
                            <?php tomochain_pagination(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
