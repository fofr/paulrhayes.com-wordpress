<?php get_header(); ?>
	<section class="clearfix listing">
		<nav>
			<ul class="xoxo">
				<?php wp_list_categories('title_li=&show_count=0&hierarchical=0&hide_empty=0') ?>
			</ul>
		</nav>
		<h2 class="swing">tag: <?php single_tag_title() ?></h2>
		<?php get_template_part('listing'); ?>
		<footer>
			<nav>
				<?php previous_posts_link(__( '&larr; Prev' )) ?> <?php next_posts_link(__( 'Next &rarr;' )) ?>
			</nav>
		</footer>
	</section>
<?php get_footer(); ?>