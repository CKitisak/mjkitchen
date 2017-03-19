<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<?php if(has_post_thumbnail()) { ?>
				<div class="image-wrapper">
					<?php the_post_thumbnail(); ?>
				</div>
				<h1 class="page-title bdr-top bdr-bot"><?php the_title(); ?></h1>	
			<?php } else { ?>
				<h1 class="page-title bdr-bot"><?php the_title(); ?></h1>
			<?php } ?>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4 bdr-right">
						<div class="service-menu">
							<?php
								$args = array ( 'category' => 13, 'posts_per_page' => 4);
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) :	setup_postdata($post);
							?>
								<a class="image-wrapper" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail(); ?>
									<h3><?php the_title(); ?></h3>
								</a>
							<?php endforeach; ?>
							<?php wp_reset_query(); ?>
						</div>
					</div><!-- /.col-md-4 -->
					<div class="col-md-8">
						<div class="page-content">
							<?php the_content(); ?>
						</div>
					</div><!-- /.col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria. try again'); ?></p>
	<?php endif; ?>

<?php get_footer(); ?>