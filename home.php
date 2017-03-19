<?php get_header(); ?>

	<div class="row">
		<div class="col-md-8">
			<h1>Blog</h1>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="row">
					<div class="col-md-3">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
					</div>
					<div class="col-md-9">
						<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					    <p><em><?php the_time('l, F jS, Y'); ?></em> <span class="text-muted"><?php the_tags(); ?></span></p>
						<?php the_excerpt(); ?>
						<p><?php the_tags(); ?></p>
					</div>
				    <hr>
				</div>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, there are no posts.'); ?></p>
			<?php endif; ?>
		</div>
		<div class="col-md-4">
			<?php get_sidebar(); ?>	
		</div>
	</div>
	
<?php get_footer(); ?>