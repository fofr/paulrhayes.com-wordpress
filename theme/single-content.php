<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('article') ?> role="main">
    <header class="article-header">
        <h1 class="main-content-title entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="article-meta" role="contentinfo">
        <time datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>" class="entry-date published" pubdate>
            <span class="day"><?php the_time('jS'); ?></span>
            <span class="month"><?php the_time('F'); ?></span>
            <a href="/<?php the_time('Y') ?>/" class="year" title="<?php the_time('Y') ?> archive"><?php the_time('Y'); ?></a>
        </time>
        <?php
            $nepo = get_next_post();
            if($nepo) {
                $nepoid = $nepo->ID;
                $next_post_url = get_permalink($nepoid);
                $next_post_title = $nepo->post_title;
            }
            $prpo = get_previous_post();
            if($prpo) {
                $prpoid = $prpo->ID;
                $prev_post_url = get_permalink($prpoid);
                $prev_post_title = $prpo->post_title;
            }
        ?>
        <nav>
            <?php if ($prpo != null) { ?>
                <a href="<?php echo $prev_post_url; ?>" title="<?php echo $prev_post_title; ?>" rel="prev">&larr; Prev</a>
            <?php } ?>
            <?php if ($prpo != null && $nepo != null) { ?> | <?php } ?><?php if ($nepo != null) { ?>
                <a href="<?php echo $next_post_url; ?>" title="<?php echo $next_post_title; ?>" rel="next">Next &rarr;</a>
            <?php } ?>
        </nav>
    </div>
    <div class="article-content entry-content">
        <?php the_content(); ?>
    </div>
    <footer class="article-footer media">
        <img src="http://1.gravatar.com/avatar/71f534a5deac2c9aa23b1a9c6de4f2e1?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G" alt="Paul Hayes" class="media-pull-left paul-avatar" />
        <p class="media-body">
            <strong>Paul Hayes</strong> is a developer at <a href="http://www.last.fm/user/fofr">Last.fm</a>. You should <a href="http://twitter.com/fofr">follow him on Twitter</a>, where he talks about UX, HTML, CSS and JavaScript, amongst other cool stuff.
        </p>
    </footer>
</article>
<?php endwhile; ?>
<?php comments_template(); ?>