<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix bar') ?> role="main">
    <header>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:') . '&after=</div>'); ?>
    </header>
    <?php
    $standoutImageUrl = get_post_meta($post->ID, "standout-image-url", true);
    $standoutImageText = get_post_meta($post->ID, "standout-image-text", true);
    if($standoutImageUrl != null && $standoutImageText != null) { ?>
        <div class="visual" style="background-image: url('<?php echo $standoutImageUrl; ?>')" /><?php echo $standoutImageText; ?></div>
    <?php } ?>
    <div class="meta" role="contentinfo">
        <time datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>" class="entry-date published" pubdate>
            <span class="day"><?php the_time('jS'); ?></span>
            <span class="month"><?php the_time('F'); ?></span>
            <a href="/<?php the_time('Y') ?>/" class="year" title="<?php the_time('Y') ?> archive"><?php the_time('Y'); ?></a>
        </time>
        <?php
            $nepo = get_next_post();
            $nepoid = $nepo->ID;
            $next_post_url = get_permalink($nepoid);
            $next_post_title = $nepo->post_title;
            $prpo = get_previous_post();
            $prpoid = $prpo->ID;
            $prev_post_url = get_permalink($prpoid);
            $prev_post_title = $prpo->post_title;
        ?>
        <nav>
            <ul class="xoxo">
                <?php
                    foreach((get_the_category()) as $category) {
                        echo '<li class="cat"><a href="/category/' . $category->category_nicename . '">' . $category->cat_name . '</a></li>';
                    }
                ?>
                <?php the_tags('<li class="tag">','</li><li class="tag">','</li>'); ?>
            </ul>

            <?php if ($prpo != null) { ?><a href="<?php echo $prev_post_url; ?>" title="<?php echo $prev_post_title; ?>" rel="prev">&larr; Prev</a><?php } ?><?php if ($prpo != null && $nepo != null) { ?> | <?php } ?><?php if ($nepo != null) { ?><a href="<?php echo $next_post_url; ?>" title="<?php echo $next_post_title; ?>" rel="next">Next &rarr;</a><?php } ?>
        </nav>
    </div>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:') . '&after=</div>'); ?>
    </div>
    <footer>
        <p>
            <img src="/images/profile.png" alt="Paul Hayes" />
            <strong>Paul Hayes</strong> is a developer at <a href="http://www.last.fm/user/fofr">Last.fm</a>. You should <a href="http://twitter.com/fofr">follow him on Twitter</a>, where he talks about UX, HTML, CSS and JavaScript, amongst other cool stuff.
        </p>
    </footer>
</article>
<?php endwhile; ?>
<?php comments_template(); ?>