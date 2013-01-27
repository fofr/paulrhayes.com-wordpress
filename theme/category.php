<?php get_header(); ?>
    <section class="clearfix listing listing--category">
        <nav>
            <ul class="xoxo">
                <?php wp_list_categories('title_li=&show_count=0&hierarchical=0&hide_empty=0') ?>
            </ul>
        </nav>
        <h2 class="swing"><?php single_cat_title() ?></h2>
        <?php if(is_category('1')) {
            get_template_part('bookshelf');
        } else {
            get_template_part('listing');
        } ?>
        <?php /* <footer>
            <nav>
                <?php previous_posts_link(__( '&larr; Prev')) ?> <?php next_posts_link(__( 'Next &rarr;')); ?>
            </nav>
        </footer> */ ?>
    </section>
<?php get_footer(); ?>