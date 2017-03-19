<?php get_header(); ?>

		<div class="row">
			<h1 class="page-title bdr-bot"><?php single_cat_title(); ?></h1>
		</div>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4 bdr-right">
							<div class="service-menu">
								<a class="image-wrapper" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail(); ?>
									<h3><?php the_title(); ?></h3>
								</a>
							</div>
						</div><!-- /.col-md-4 -->
						
						<div class="col-md-8">
							<div class="page-content">
								
							</div>
						</div><!-- /.col-md-8 -->
					</div><!-- /.row -->
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, there are no posts.'); ?></p>
		<?php endif; ?>

<?php get_footer(); ?>