<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php global $data; ?>
	
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<?php if( $data['rsclean_favicon'] ) { ?>
		<link rel="shortcut icon" type="image/png" href="<?php echo $data['rsclean_favicon']; ?>" />
	<?php } ?>
	
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	
	<script>
		document.documentElement.className = 'js';
	</script>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<header id="header">
	
		<div class="container">
			<div class="row">
				<div class="col-md-push-4 col-sm-12 col-md-4">
					<div class="text-center">
						<hgroup>
							<?php
								$default_logo = get_stylesheet_directory_uri() . '/assets/images/logo.png';
								$new_logo = empty( $data['rsclean_logo'] ) ? $default_logo : $data['rsclean_logo']; 
							?>
							<h1 class="logo">
								<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>">
									<?php if( $default_logo ) { ?>
										<img src="<?php echo $new_logo; ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" />
									<?php } else { ?>
										<?php echo get_bloginfo('name'); ?>
									<?php } ?>
								</a>
							</h1>
							<h2 class="slogan mt0">
								<?php bloginfo('description'); ?>
							</h2>
						</hgroup>
					</div>
				</div>
				
				<div class="col-md-push-4 col-sm-12 col-md-4">
				
					<div class="row">
						<div class="col-md-push-2 col-xs-10">
							<?php get_search_form(); ?>
						</div>
						<div class="col-xs-2">
							<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>	
						</div>
					</div>
					
				</div>
			</div>
		</div>
	
	</header>
	
	<nav id="navigation" class="mt30" role="menu">
			
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-menu collapse navbar-collapse" id="navbar">
						<?php
							$menu_class = 'nav navbar-nav list-unstyled';
							$main_nav = '';
								
							if ( function_exists('wp_nav_menu') ) {
								$main_nav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menu_class, 'echo' => false ) );
							};
							if ($main_nav == '') : ?>
								<ul class="<?php echo $menu_class; ?>">	
									<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
								</ul> <?php
							else :
								echo( $main_nav );
							endif; 
						?>
					</div>
				</div>
			</div>
		</div>

	</nav>
	
	<!--start main content-->
	<main role="main" id="main">
		<div class="container">