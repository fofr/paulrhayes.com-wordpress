<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('listing-item') ?>>
    <header class="article-header">
        <h1 class="listing-item-title entry-title">
            <a href="<?php the_permalink() ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h1>
    </header>
    <div class="listing-item-meta" role="contentinfo">
        <time datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>" class="entry-date published" pubdate>
            <span class="day"><?php the_time('jS'); ?></span>
            <span class="month"><?php the_time('F'); ?></span>
            <span class="year"><?php the_time('Y'); ?></span>
        </time>
        &mdash;
        <a href="<?php the_permalink() ?>" rel="bookmark" class="align-center">
            Read More
        </a>
    </div>
    <div class="listing-item-summary entry-summary">
        <?php the_excerpt(); ?>
    </div>
</article>
<?php endwhile; ?>

<nav class="listing-pagination">
    <span class="previous"><?php next_posts_link(__( '&larr; Prev')) ?></span>
    <span class="next"><?php previous_posts_link(__( 'Next &rarr;')) ?></span>
</nav>