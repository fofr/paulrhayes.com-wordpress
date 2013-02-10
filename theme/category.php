<?php get_header(); ?>
    <section class="clearfix listing listing--category">
        <nav class="listing-navigation">
            <ul class="xoxo">
                <?php wp_list_categories('title_li=&show_count=0&hierarchical=0&hide_empty=0') ?>
            </ul>
        </nav>
        <h2 class="main-content-title"><?php single_cat_title() ?></h2>
        <?php get_template_part('listing'); ?>
    </section>
<?php get_footer(); ?>