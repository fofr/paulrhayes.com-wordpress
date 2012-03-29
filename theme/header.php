<!DOCTYPE html>
<!--[if IE 8 ]><html lang="en" id="paulrhayes-com"  class="no-js ie ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" id="paulrhayes-com"  class="no-js ie ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" id="paulrhayes-com" class="no-js"><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset') ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php wp_title('-', true, 'right'); echo esc_html(bloginfo('name')); ?></title>
	<meta name="description" content="A design and code blog from UX developer Paul Hayes, specializing in CSS3, HTML5 and JavaScript." />	
	<meta name="google-site-verification" content="KXou1BjZqpDc9x8CuCA6epEKcxttO_EGrdhHSkqgEOI" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script>(function(d){d.className=d.className.replace(/^no-js\b/,'js');}(document.documentElement));</script>
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<link rel="stylesheet" href="/css/master.css?11" />
	<?php wp_head(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/prhayes" title="Paul Hayes RSS" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<link rel="icon" type="image/png" href="/favicon.png" />
	<script src="http://use.typekit.com/fdb0guo.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
</head>
<body <?php body_class('wordpress'); ?>>
<div id="wrapper" class="hfeed">
	<header id="header">
		<?php if (is_home()) { ?>
		<h1 class="title">
			I&#8217;m Paul Hayes
		</h1>
		<?php } else { ?>
		<div>
			<a class="title" rel="home" href="/">
				Paul Hayes
			</a>
		</div>
		<?php } ?>
	</header>