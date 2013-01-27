<?php get_header(); ?>
    <p>I design and build websites that are a pleasure to use. I work at <a href="http://last.fm/user/fofr">Last.fm</a> and live by the sea in Brighton. I love to experiment with CSS, HTML and JavaScript. The best place to find me is <a href="http://twitter.com/fofr" rel="external" title="@fofr">on Twitter</a>.</p>
    <section class="clearfix listing listing--index">
        <nav>
            <ul class="xoxo">
                <?php wp_list_categories('title_li=&show_count=0&hierarchical=0&hide_empty=0') ?>
            </ul>
        </nav>
        <?php get_template_part('listing'); ?>
    </section>
<?php get_footer(); ?>
