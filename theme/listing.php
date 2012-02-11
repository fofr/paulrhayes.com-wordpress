<div class="g">
	<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID() ?>" <?php post_class('g3'); ?>>
		<h3 class="entry-title">
			<a href="<?php the_permalink() ?>" rel="bookmark">
				<?php 
					$img = get_post_meta($post->ID, "listing-image", true);
					if($img != null) {
						echo '<img src="'.$img.'" alt="'.get_the_title($post->ID).'" width="218" height="76" />';	
					} else {
						echo '<img src="/images/empty.png" class="empty" alt="'.get_the_title($post->ID).'" width="218" height="76" />';	
					}
				?>
				<span><?php the_title(); ?></span>
			</a>
		</h3>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</article>
	<?php endwhile; ?>
</div>