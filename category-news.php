<?php get_header(); ?>

	<div class="row">
		<h1 class="page-title bdr-bot"><?php single_cat_title(); ?></h1>
		<div class="col-md-12">
			<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-md-3 col-md-offset-1">
					<div class="image-wrapper">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
					</div>
				</div>
				<div class="col-md-7">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				    <p><em><?php the_time('l, F jS, Y'); ?></em> <span class="text-muted"><?php the_tags(); ?></span></p>
					<?php the_excerpt(); ?>
				</div>
				
				<div class="clearfix"></div>
	
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, there are no posts.'); ?></p>
			<?php endif; ?>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>