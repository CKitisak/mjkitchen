<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php if( is_front_page() ) : ?>
	    <title><?php bloginfo('name'); ?> | <?php bloginfo('description');?></title>
	<?php else : ?>
	    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
	<?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php echo mytheme_option('favicon'); ?>" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <?php wp_head(); ?>
    
    <?php if(mytheme_option('custom_css')!="") : ?>
	    <style>
			<?php echo mytheme_option('custom_css'); ?>
		</style>
	<?php endif; ?>
	
	<script>
		// Use full jQuery function name to reference jQuery.
		jQuery(document).ready(function() {
    		jQuery('#s-toggle').click(function() {
				jQuery('.s-form').animate({
					width: "toggle",
					opacity: "toggle"
				}, 100);
			});
			
			jQuery(window).scroll(function() {
              if (jQuery(this).scrollTop()) {
                    jQuery('.toTop:hidden').stop(true, true).fadeIn();
              } else {
                    jQuery('.toTop').stop(true, true).fadeOut();
               }
          });
		});
	</script>
  </head>
  <body <?php body_class($class); ?>>
  <header id="header">
  	<div class="container-fluid">
  		<div class="row">
	  		<div class="container">
		  		<?php if(mytheme_option('site_logo')) : ?>
		  			<div class="col-md-5">
		  				<div class="site-logo-box">
					  		<a href="<?php echo site_url(); ?>"><img class="site-logo" src="<?php echo mytheme_option('site_logo'); ?>" alt="<?php bloginfo('description'); ?>" width="100%" /></a>
		  				</div>	  				
		  			</div>
		  			<div class="col-md-5 col-md-offset-2">
		  				<?php echo qtrans_generateLanguageSelectCode('image'); ?>
		  				
		  				<div class="clearfix"></div>
		  				<div class="social-box">
		  					<?php if(mytheme_option('mj_facebook')=="") : else : ?>
			  					<a href="<?php echo mytheme_option('mj_facebook'); ?>" target="_blank"><span class="social fb-icon"></span></a>
		  					<?php endif; ?>
		  					<?php if(mytheme_option('mj_twitter')=="") : else : ?>
			  					<a href="<?php echo mytheme_option('mj_twitter'); ?>" target="_blank"><span class="social tw-icon"></span></a>
		  					<?php endif; ?>
		  					<?php if(mytheme_option('mj_googleplus')=="") : else : ?>
			  					<a href="<?php echo mytheme_option('mj_googleplus'); ?>" target="_blank"><span class="social gp-icon"></span></a>
		  					<?php endif; ?>
		  					
		  					<form action="<?php bloginfo('siteurl'); ?>" id="searchform" class="s-form" method="get">
						         <input type="search" id="s" name="s" />
							</form>
		  					<a id="s-toggle"><span class="social search-icon"></span></a>
		  					
		  				</div>
		  			</div>
	  			<?php else : ?>
	  				<div class="col-md-4">
		  				<div class="site-logo-box">
					  		<a class="navbar-brand" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
		  				</div>	  				
		  			</div>
		  			<div class="col-md-4 col-md-offset-4">
		  				<div class="social-box">
		  					<?php if(mytheme_option('mj_facebook')=="") : else : ?>
			  					<a href="<?php echo mytheme_option('mj_facebook'); ?>" target="_blank"><span class="social fb-icon"></span></a>
		  					<?php endif; ?>
		  					<?php if(mytheme_option('mj_twitter')=="") : else : ?>
			  					<a href="<?php echo mytheme_option('mj_twitter'); ?>" target="_blank"><span class="social tw-icon"></span></a>
		  					<?php endif; ?>
		  					<?php if(mytheme_option('mj_googleplus')=="") : else : ?>
			  					<a href="<?php echo mytheme_option('mj_googleplus'); ?>" target="_blank"><span class="social gp-icon"></span></a>
		  					<?php endif; ?>
		  				</div>
		  			</div>
  				<?php endif; ?>
  			</div><!-- /.container -->
  		</div><!-- /.row -->
  		<div class="row">
	  		<div class="menu-header-wrap">
	  			<div class="col-md-12">
		  			<div class="container">
			  			<?php if(qtrans_getLanguage() == "en") : ?>
							<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'menu-eng', 'fallback_cb' => '' ) ); ?>
						<?php elseif(qtrans_getLanguage() == "th") : ?>
							<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'menu-thai', 'fallback_cb' => '' ) ); ?>
						<?php endif; ?>
		  			</div><!-- /.container -->
	  			</div><!-- /.col-md-12 -->
  			</div><!-- /.menu-header-wrap -->
  		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
  </header>
  
  <a href="#"  class="toTop" class="btn btn-default btn-lg" role="button"><span class="glyphicon glyphicon-chevron-up"></span></a>
  
  <div class="background"><img src="<?php echo mytheme_option('background_image'); ?>" width="100%" /></div>
  
  <div id="main">
	  <div class="container">