<?php get_header(); ?>
    <section class="clearfix listing listing--archive">
        <nav class="listing-navigation">
            <ul>
                <?php wp_get_archives('type=yearly'); ?>
            </ul>
        </nav>
        <?php if ( is_day() ) : ?>
        <h2 class="main-content-title"><?php printf( __('%s'), get_the_time(get_option('date_format')) ); ?></h2>
<?php elseif ( is_month() ) : ?>
        <h2 class="main-content-title"><?php printf( __('%s'), get_the_time('F Y') ); ?></h2>
<?php elseif ( is_year() ) : ?>
        <h2 class="main-content-title"><?php printf( __('%s'), get_the_time('Y') ); ?></h2>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
        <h2 class="page-title"><?php _e( 'Blog Archives'); ?></h2>
<?php endif; ?>
        <?php the_post(); ?>
        <?php rewind_posts(); ?>
        <?php get_template_part('listing'); ?>
    </section>
<?php get_footer(); ?>