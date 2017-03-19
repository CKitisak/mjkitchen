<?php get_header(); ?>

	<div class="row">
		<div class="col-md-8">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
						
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria. try again'); ?></p>
			<?php endif; ?>
		</div> <!-- /.col-md-8 -->
		
		<div class="col-md-3">
			<div id="sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- /.col-md-3 -->
	</div> <!-- /.row -->

<?php get_footer(); ?>